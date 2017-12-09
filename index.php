<?php

echo'
<!DOCTYPE html>
<html lang="da">
<head>';

	# Include the meta/headers
	require_once('resources/meta.php');

echo'
</head>
<body class="w3-light-grey w3-content" style="max-width: 1600px;">';

# Left side navigation (menu) 
echo'
<nav class="w3-sidebar w3-bar-block w3-text-grey w3-collapse w3-top" style="z-index:3;width:300px;font-weight:bold; left:0; background-color: #262626; padding-left:2%;" id="sidebar"><br>
  <h3><b><a href="index.php" class="">sloa.dk</a></h3>
  <a href ="javascript:void(0)"   onclick="w3_close()" class="w3-bar-item w3-button w3-padding w3-hide-large">Luk</a>
  <a href ="?blog"                onclick="w3_close()" class="w3-bar-item w3-button">Blog</a> 
  <a href ="?guider"              onclick="w3_close()" class="w3-bar-item w3-button">Guider</a> 
  <a href ="?portfolio"           onclick="w3_close()" class="w3-bar-item w3-button">Portfolio</a> 
  <a href ="?info"                onclick="w3_close()" class="w3-bar-item w3-button">Infomation</a>
  <a href ="?kontakt"             onclick="w3_close()" class="w3-bar-item w3-button">Kontakt</a>';

  # External sources (socialmedia, github etc)
  echo'
  <div style="margin-top:60px; margin-left:-5%;">
    <a href="https://facebook.com/" title="Facebook" class="socialIcon"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
    <a href="https://linkedin.com/" title="Linkedin" class="socialIcon"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
    <a href="https://github.com/"   title="Github"   class="socialIcon"><i class="fa fa-github-square" aria-hidden="true"></i></a>
  </div>';

  # Contact information
  echo'
  <div style="margin-top:60px; margin-left:-5%;">
    <address itemscope itemtype="http://schema.org/Person" style="color:lightgrey; font-style: normal; line-height: 1.3rem;">
        <span itemprop="name"><b>Henrik Jeppesen</b></span>
        <br>
        <span itemprop="addres">Roskilde DK</span>
        <br>
        <abbr title="Telefon"><i class="fa fa-phone-square" aria-hidden="true"></i></abbr>
        <span itemprop="telephone"> (+45) 4248 3088</span> 
        <br>
        <abbr title="E-mail"><i class="fa fa-envelope-open" aria-hidden="true" style="font-size:90%;"></i></abbr>
        <a href="mailto:info@sloa.dk" title="Åbner din E-mail klient"><span itemprop="email"> info@sloa.dk</span></a> &nbsp;
        <br>
        <abbr title="Bitcoin"><i class="fa fa-btc" aria-hidden="true"></i></abbr>
        <small> 12D4tnvSJA68MxVQ8jovLJ8trksNumUPh4</small>
    </address>
  </div>';

  # Login Icon
  echo'
  <div style="margin-top:60px; margin-left:-5%;">
    <a href="?pregodmode" title="Administrativ Login" style="color:lightgrey;"><i class="fa fa-unlock-alt" aria-hidden="true"></i></a>
  </div>
</nav>';

# Small screen logo
echo'
<header class="w3-container w3-top w3-hide-large w3-xlarge w3-padding-16" style="background-color: #262626;">
  <span class="w3-left w3-padding"><a href="index.php" style="color:lightgrey;">sloa.dk</a></span>
  <a href="javascript:void(0)" class="w3-right w3-button w3-white" onclick="w3_open()">☰</a>
</header>';

# Darken background (overlay) when burger-menu (small screens menu)
echo'<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="overlay"></div>';

# Content
echo'
<div class="w3-main" id="main" style="margin-left:300px;">
  <div class="w3-hide-large" style="margin-top:83px"></div>
  <div class="w3-container w3-padding-32" style="position:absolute; min-height:100%;">';

    # This will load the appropriate view
    require_once('views/'.$singleton::$page.'.php');

echo'
  </div>
</div>';

# Include JavaScript/JQuery/Vue/Plugins
echo'<script src="js/vue.js"></script>';
echo'<script src="js/dynamics.js"></script>';
echo'<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js"></script>';

echo'
</body>
</html>';

?>
