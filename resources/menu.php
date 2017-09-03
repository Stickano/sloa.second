<?php

echo'<div class="row">';
    echo'<div class="col-2 no-mobile"></div>';
    echo'<div class="col-8 menuRow font-special">';

        # Logo (left)
        echo'<a href="/" class="sloaButton" title="Forsiden">sloa.dk</a>';
        echo $singleton->spaces(2);
        echo'<span style="opacity:.5;">| Alpha</span>';

        # Buttons (right)
        echo'<div class="no-mobile right" style="padding-top:.3%;">';
            echo'<a href="blog.php" title="" class="menuButton">Blog</a>';
            echo $singleton->spaces(4);
            echo'<a href="info.php" title="" class="menuButton">Info</a>';
            echo $singleton->spaces(4);
            echo'<a href="portfolio.php" title="" class="menuButton">Portfolio</a>';
            echo $singleton->spaces(4);
            echo'<a href="services.php" title="" class="menuButton">Services</a>';
            echo $singleton->spaces(4);
            echo'<a href="kontakt.php" title="" class="menuButton">Kontakt</a>';
        echo'</div>';

    echo'</div>';
    echo'<div class="col-2 no-mobile"></div>';
echo'</div>';

?>