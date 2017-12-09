<?php

require_once('models/mailer.php');
require_once('models/emoji.php');

class KontaktController{

    private $conn;
    private $db;
    private $session;

    private $mailer;
    private $emoji;

    # Data from contact db
    private $used;
    private $txt;
    private $mailTo;
    private $pgp;

    # Variables to handle the values from the contact form
    private $mailFrom;
    private $subject;
    private $message;

    # Values for the view
    private $error;
    private $success;
    private $formValues = array();

    public function __construct(Connection $conn, Crud $db, SessionsHandler $session){
        
        $this->conn    = $conn;
        $this->db      = $db;
        $this->session = $session;
        
        $this->emoji   = new Emoji();

        # Get and define contact page information
        $select       = ['*' => 'contact'];
        $result       = $this->db->read($select);
        $this->used   = $result[0]['contacted'];
        $this->txt    = $result[0]['txt'];
        $this->mailTo = $result[0]['mail_to'];
        $this->pgp    = $result[0]['pgp'];

        # Mailer method and config
        $this->mailer = new Mailer($this->mailTo, $this->session);
        $this->mailer->setServerMail('noreply@sloa.dk');
        $this->mailer->setMissingFields('Der mangler noget!');
        $this->mailer->setIllegibleMail('Ugyldig Email!');
    }

    /**
     * Allows one to send a new message
     * @return  unsets the MailSuccess session
     */
    public function resetMail(){
        $this->mailer->resetMail();
    }

    /**
     * Text for the contact page (from db)
     * @return string  The message/txt
     */
    public function getTxt(){
        return $this->txt;
    }

    /**
     * The PGP key (from db)
     * @return string PGP public key
     */
    public function getPgp(){
        return $this->pgp;
    }

    /**
     * Changes the form values if MailSuccess is set
     * @return array values; name, value, color & disabled
     */
    public function getFormValues(){
        if($this->session->isset('MailSuccess')){
            $this->formValues["name"] = "reset";
            $this->formValues["value"] = "Send ny besked!";
            $this->formValues["color"] = "yellow";
            $this->formValues["disabled"] = "disabled";
        } else {
            $this->formValues["name"] = "send";
            $this->formValues["value"] = "Send!";
            $this->formValues["color"] = "blue";
            $this->formValues["disabled"] = null;
        }
        return $this->formValues;
    }

   /**
    * Return a mail error (unsuccessful attempt)
    * @return string The error
    */
    public function getError(){
        if($this->session->isset('mailError')){
            $this->error = $this->emoji->umoji(8).' '.$this->session->get('mailError');
            $this->session->unset('mailError');
        }
        return $this->error;
    }

    /**
     * The values typed in the form are saved and returned
     * @return array Values from previous attempts
     */
    public function getFailedValues() {
        $values = [
            'mail' => $this->session->get('mail'), 
            'subject' => $this->session->get('subject'), 
            'txt' => $this->session->get('message') 
        ]; 
    
        $this->session->unset('mail');
        $this->session->unset('subject');
        $this->session->unset('message');

        return $values;
    }

    /**
     * Sends the message via the contact form
     * @return null/Exception Returns exception on fail
     */
    public function send(){

        $mail = $_POST['mail'];
        $subject = $_POST['subject'];
        $txt = $_POST['message'];

        $this->session->set('mail', $mail);
        $this->session->set('subject', $subject);
        $this->session->set('message', $txt);

        try {
            # The mailer will sanitize and validate
            $this->mailer->mail($mail, $subject, $txt);
        } catch (Exception $e) {
            $this->session->set('mailError', $e->getMessage());
        }

        # Update the contacted value
        if (!$this->session->isset('mailError')){
            $this->used++;
            $this->db->update('contact', 'contacted='.$this->used, 'id=1');
        }

    }
}

?>