<?php
echo'<!DOCTYPE html>';
echo'<html lang="da">';
echo'<head>';
    # The headers are read from below file
    require_once('resources/header.php');
echo'</head>';
echo'<body>';

# The top menu bar
require_once('resources/menu.php');

//TODO: Break up the txt (headline)

# Forward contact submit action
if(isset($_POST['send']))
    $controller->send();

# Nulstil (send ny besked)
if(isset($_POST['reset']))
    $session->unset("MailSuccess");
    #$controller->resetMail();

# Form values (send or reset)
$val = $controller->getFormValues();

# Content
echo'<div class="row content">';
    echo'<div class="col-2 no-mobile"></div>';
    echo'<div class="col-8">';

            echo'<div class="row">';
                # Show mail form (exclude PGP key)
                if(!isset($_GET['pgp'])){
                    echo'<div class="col-6 justify">';
                        echo $controller->getTxt();
                    echo'</div>';
                    echo'<div class="col-6">';

                        # Display error (if any)
                        if($session->isset('mailError'))
                            echo'<div class="warning bg-red">'.$controller->getError().'</div>';
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
                                        value="'.$controller->getMail().'" '.$val['disabled'].'>';
                            
                            echo'<input style="width:100%;" 
                                        type="text" 
                                        name="subject" 
                                        class="input-simple" 
                                        placeholder="Emne" 
                                        value="'.$controller->getSubject().'" '.$val['disabled'].'>';
                            
                            echo'<textarea class="input-textarea" 
                                            style="width:100%; height:400px;" 
                                            name="message"  '.$val['disabled'].'>'.$controller->getMessage().'</textarea>';
                            
                            //TODO: Icon
                            echo'<input type="submit" 
                                        value="'.$val['value'].'" 
                                        class="input-button bg-'.$val['color'].' right" 
                                        style="width:50%;" 
                                        name="'.$val['name'].'">';
                        echo'</form>';
                        
                    echo'</div>';

                # Show PGP key (exclude mail form)
                }else{
                    echo'<pre><code>';
                        echo $controller->getPgp();
                    echo'</code></pre>';
                }
            echo'</div>';
    
    echo'</div>';
    echo'<div class="col-2 no-mobile"></div>';
echo'</div>';

# Footer
require_once('resources/footer.php');

echo'</body>';
echo'</html>';
?>