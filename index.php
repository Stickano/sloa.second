<?php
echo '<!DOCTYPE html>';
echo '<html lang="da">';
echo '<head>';

	# Include the meta/headers
	require_once('resources/meta.php');

echo '</head>';
echo '<body>';

echo '<nav class="sidebarContainer" id="sidebar">';
    echo '<br>';
    echo '<h3>';
        echo '<a href="index.php" class="sloaButton">sloa.dk</a>';
        echo $singleton->spaces(4);
        echo '<span class="alphaTxt">| Alpha</span>';
    echo '</h3>';
    echo'<a href ="javascript:void(0)" onclick="closeSidebar()" class="sidebarButton mobile-only">Luk</a>';

    # Buttons
    $options = ['blog', 'guider', 'portfolio', 'info', 'kontakt'];
    foreach ($options as $key) {
        $color = null;
        $val = $key;
        if ($singleton::$page == $key)
          $color = 'style="color:darkgrey;"';
        if ($key == 'info')
          $val = 'information';

        echo'<a href ="?'.$key.'" onclick="sidebarClose()" class="sidebarButton" '.$color.'>'.ucfirst($val).'</a>';
    }

    # Admin panel, if logged in
    if ($session->isset('sloaLogged'))
        echo'<a href ="?godmode" onclick="sidebarClose()" class="sidebarButton" '.$color.'>Administrativ</a>';


    # External sources (socialmedia, github etc)
    # TODO: From db
    echo '<div style="margin-top:60px;">';
        echo '<a href="https://facebook.com/" title="Facebook" class="socialIcon"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>';
        echo '<a href="https://linkedin.com/" title="Linkedin" class="socialIcon"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>';
        echo '<a href="https://github.com/"   title="Github"   class="socialIcon"><i class="fa fa-github-square" aria-hidden="true"></i></a>';
    echo '</div>';


    # Contact information
    echo '<div style="margin-top:60px;">';
        echo '<address itemscope itemtype="http://schema.org/Person" class="sideContact">';
            echo '<span itemprop="name"><b>Henrik Jeppesen</b></span>';
            echo '<br>';
            echo '<span itemprop="addres">Roskilde DK</span>';
            echo '<br>';
            echo '<abbr title="Telefon"><i class="fa fa-phone-square" aria-hidden="true"></i></abbr>';
            echo '<span itemprop="telephone"> (+45) 4248 3088</span> ';
            echo '<br>';
            echo '<abbr title="E-mail"><i class="fa fa-envelope-open" aria-hidden="true" style="font-size:90%;"></i></abbr> ';
            echo '<a href="mailto:info@sloa.dk" title="Åbner din E-mail klient" style="color:lightgrey;"><span itemprop="email">info@sloa.dk</span></a> &nbsp;';
            echo '<br>';
            echo '<abbr title="Bitcoin"><i class="fa fa-btc" aria-hidden="true"></i></abbr>';
            echo '<small> 12D4tnvSJA68MxVQ8jovLJ8trksNumUPh4</small>';
        echo '</address>';
    echo '</div>';


    # Login Icon
    if (!$session->isset('sloaLogged')){
        echo '<div class="loginContainer">';
            echo '<a href="?pregodmode" title="Administrativ Login" style="color:lightgrey;"><i class="fa fa-unlock-alt" aria-hidden="true"></i></a>';
        echo '</div>';
    }
echo '</nav>';


echo '<div onclick="closeSidebar()" title="Luk side menuen" id="overlay" class="overlay animateOpacity"></div>';


echo '<div class="mainContainer" id="main">';
    echo '<div class="mobile-only" style="margin-top:83px"></div>';

    # This will load the appropriate view
    require_once('views/'.$singleton::$page.'.php');

    echo '</div>';
echo '</div>';


# Small screen logo/menu
echo '<header class="topBar mobile-only">';
    echo '<a href="index.php" class="sloaButton"><b>sloa.dk</b></a>';
    echo '<a href="javascript:void(0)" class="right topbarButton" onclick="openSidebar()">☰</a>';
echo '</header>';

# Acquire JS libraries
echo'<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>';
echo'<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js"></script>';
echo'<script src="js/vue.js"></script>';
echo'<script src="js/dynamics.js"></script>';

# Load page specific JS document
if (is_file('js/'.$singleton::$page.'.js'))
    echo'<script src="js/'.$singleton::$page.'.js"></script>';

echo'</body>';
echo'</html>';
?>