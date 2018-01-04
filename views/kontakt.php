<?php

//TODO: Break up the txt (headline)

# Forward contact submit action
if(isset($_POST['send']))
    $controller->send();

# Nulstil (send ny besked)
if(isset($_POST['reset']))
    $controller->resetMail();

# Form values (send or reset)
$val = $controller->getFormValues();

# Stored values from failed attempts
$failed = $controller->getFailedValues();
$error = $controller->getError();

echo'<div class="row">';
    # Show mail form (exclude PGP key)
    if(!isset($_GET['pgp'])){
        echo'<div class="col-6 justify">';
            echo $controller->getTxt();
        echo'</div>';
        echo'<div class="col-6">';

            # Display error (if any)
            if($error)
                echo'<div class="warning bg-red">'.$error.'</div>';
            // TODO: Fix - maybe db message? Icon?
            # Display success (if any)
            elseif($session->isset('MailSuccess'))
                echo'<div class="warning bg-green">Det\' er modtaget!</div>';
            else
                echo'<div class="warning bg-lightblue"><b>Bemærk:</b> Alle felter skal udfyldes!</div>';

            # Contact formula
            echo'<form method="post">';
                echo'<input style="width:100%;"
                            type="text"
                            name="mail"
                            class="input-simple"
                            placeholder="Din E-mail"
                            value="'.$failed['mail'].'" '.$val['disabled'].'>';

                echo'<input style="width:100%;"
                            type="text"
                            name="subject"
                            class="input-simple"
                            placeholder="Emne"
                            value="'.$failed['subject'].'" '.$val['disabled'].'>';

                echo'<textarea class="input-textarea"
                                style="width:100%; height:400px;"
                                name="message"  '.$val['disabled'].'>'.$failed['txt'].'</textarea>';

                //TODO: Icon
                echo'<input type="submit"
                            value="'.$val['value'].'"
                            class="input-button bg-'.$val['color'].' right"
                            style="width:50%;"
                            name="'.$val['name'].'">';
            echo'</form>';

        echo'</div>';
    }


    # Show PGP key (exclude mail form)
    if(isset($_GET['pgp'])){
        echo'<pre><code>';
            echo $controller->getPgp();
        echo'</code></pre>';
    }
echo'</div>';

?>