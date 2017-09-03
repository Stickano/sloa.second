<?php
echo'<!DOCTYPE html>';
echo'<html lang="da">';
echo'<head>';
	# Include the meta/headers
	require_once('resources/header.php');
echo'</head>';
echo'<body>';

# The top menu bar
require_once('resources/menu.php');

# Content
echo'<div class="row content">';
	echo'<div class="col-2 no-mobile"></div>';
	echo'<div class="col-8">';
        echo $controller->getMessage();
	echo'</div>';
	echo'<div class="col-2 no-mobile"></div>';
echo'</div>';

# Footer
require_once('resources/footer.php');

echo'</body>';
echo'</html>';
?>