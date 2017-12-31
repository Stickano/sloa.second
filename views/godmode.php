<?php

# Welcome, last login
echo'<div class="row">';
    echo'<div class="col-12">';
    echo'<h3>Velkommen '.$controller->getUsername().'</h3>';
    echo $singleton->spaces(3).'Sidste login: '.$controller->getLastLoggedIn();
    echo'</div>';
echo'</div>';

# Navigation
echo'<div class="row">';
    // $br = 0;
    // echo'<div class="flex-container">';
    // foreach ($controller->getPages() as $key => $value) {
    //     echo'<ul>';
    //         echo'<li style="list-style:none;">';
    //             echo '<h3 style="margin-bottom:0c;">'.$key.'</h3>';

    //             echo'<ul style="padding-left:5px;">';
    //             foreach ($value as $sub) {
    //                 echo'<li style="list-style:none;">'.$sub.'</li>';
    //             }
    //             echo'</ul>';

    //         echo'</li>';
    //     echo'</ul>';
    // }
    // echo'</div>';
echo'</div>';

?>