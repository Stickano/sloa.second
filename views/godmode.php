<?php

# Welcome, last login
echo'<div class="row" style="border:1px solid pink;">';
    echo'<div class="col-12">';
    echo'<h3>Velkommen '.$controller->getUsername().'</h3>';
    echo $singleton->spaces(3).'Sidste login: '.$controller->getLastLoggedIn();
    echo'</div>';
echo'</div>';

# Navigation
echo'<div class="row" style="border:1px solid blue;">';
    $br = 0;
    foreach ($controller->getPages() as $key => $value) {

        # New row after 3 categories
   

        echo'<ul>';
            echo'<li style="list-style:none;">';   
                echo '<h3>'.$key.'</h3>';
                
                echo'<ul style="padding-left:5px;">';
                foreach ($value as $sub) {
                    echo'<li style="list-style:none;">'.$sub.'</li>';
                }
                echo'</ul>';

            echo'</li>';
        echo'</ul>';

    }
echo'</div>';

?>