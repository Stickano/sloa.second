<?php

# Change the active page link color
$blogStyle = null;
$infoStyle = null;
$kontaktStyle = null;
$portfolioStyle = null;
$servicesStyle = null;

if($singleton::$page != 'index')
    ${$singleton::$page.'Style'} = "menuButtonSelected";

echo'<div class="row">';
    echo'<div class="col-2 no-mobile"></div>';
    echo'<div class="col-8 menuRow font-special">';

        # Logo (left)
        echo'<a href="/" class="sloaButton" title="Forsiden">sloa.dk</a>';
        echo $singleton->spaces(2);
        echo'<span style="opacity:.5;">| Alpha</span>';

        # Buttons (right)
        echo'<div class="no-mobile right" style="padding-top:.3%;">';
            echo'<a href="?blog" title="" class="menuButton '.$blogStyle.'">Blog</a>';
            echo $singleton->spaces(4);
            echo'<a href="?info" title="" class="menuButton '.$infoStyle.'">Info</a>';
            echo $singleton->spaces(4);
            echo'<a href="?portfolio" title="" class="menuButton '.$portfolioStyle.'">Portfolio</a>';
            echo $singleton->spaces(4);
            echo'<a href="?services" title="" class="menuButton '.$servicesStyle.'">Services</a>';
            echo $singleton->spaces(4);
            echo'<a href="?kontakt" title="" class="menuButton '.$kontaktStyle.'">Kontakt</a>';
        echo'</div>';

    echo'</div>';
    echo'<div class="col-2 no-mobile"></div>';
echo'</div>';

?>