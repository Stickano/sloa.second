<?php

require_once('models/mailer.php');
require_once('models/emoji.php');

class kontaktController{

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
    private $formValues = array("name" => "send",
                                "value" => "Send",
                                "color" => "blue",
                                "disabled" => null);

    public function __construct(connection $conn, crud $db, SessionsHandler $session){
        
        $this->conn = $conn;
        $this->db = $db;
        $this->session = $session;

        $this->emoji = new emoji();

        # Get and define contact page information
        $result = $this->db->recieve("*", "contact");
        $this->used = $result['contacted'];
        $this->txt = $result['txt'];
        $this->mailTo = $result['mail_to'];
        $this->pgp = $result['pgp'];

        # Mailer method and config
        $this->mailer = new mailer($this->mailTo, $this->session);
        $this->mailer->setServerMail('noreply@sloa.dk');
        $this->mailer->setMissingFields('Der mangler noget!');
        $this->mailer->setIllegibleMail('Ugyldig Email!');

        # View values
        self::getError();
        self::getFormValues();
        self::getMail();
        self::getSubject();
        self::getMessage();

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
            $this->formValues["name"] = "resset";
            $this->formValues["value"] = "Send ny besked!";
            $this->formValues["color"] = "yellow";
            $this->formValues["disabled"] = "disabled";
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
     * These next 3 are from storing the values once you use the contact form
     * so that you don't have to re-type the values in the form.
     */
    /**
     * Returns the senders address (if any)
     * @return strin The sender of the contact form
     */
    public function getMail(){
        if($this->session->isset('mail')){
            $this->mailFrom = $this->session->get('mail');
            $this->session->unset('mail');
        }
        return $this->mailFrom;
    }
    /**
     * Returns the subject of the contact form
     * @return string The subject
     */
    public function getSubject(){
        if($this->session->isset('subject')){
            $this->subject = $this->session->get('subject');
            $this->session->unset('subject');
        }
        return $this->subject;
    }
    /**
     * Returns the message from the contact form
     * @return string The message
     */
    public function getMessage(){
        if($this->session->isset('message')){
            $this->message = $this->session->get('message');
            $this->session->unset('message');
        }
        return $this->message;
    }

    /**
     * Allows one to send a new message
     * @return  unsets the MailSuccess session
     */
    public function resetMail(){
        $this->mailer->resetMail();
    }

    /**
     * Sends the message via the contact form
     * @return null/Exception Returns exception on fail
     */
    public function send(){

        $mail = $_POST['mail'];
        $subject = $_POST['subject'];
        $txt = $_POST['message'];

        if(!empty($mail))
            $_SESSION['mail'] = $mail;
        if(!empty($subject))
            $_SESSION['subject'] = $subject;
        if(!empty($txt))
            $_SESSION['message'] = $txt;

        try {
            # The mailer will sanitize and validate
            $this->mailer->mail($mail, $subject, $txt);
        }
        catch(Exception $e){
            $this->session->set('mailError', $e->getMessage());
        }

        # Update the contacted value
        $this->used++;
        $this->db->update('contact', 'contacted='.$this->used, 'id=1');

    }
}

?>