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

# Content
echo'<div class="row content">';
    echo'<div class="col-2 no-mobile"></div>';
    echo'<div class="col-8">';

        echo'<div class="row">';
            # Fetch the articles
            $result = $controller->getPosts();
            $alt = "Article Image";
            $br = 0;
            foreach ($result as $key) {
                
                $br++;
                $txt = strip_tags($key['txt']);
                $txt = substr(($txt), 0, 400);

                # Fetch image (if any)
                $image = $controller->getImages($key['id']);

                echo'<div class="col-6 blogPosts">';
                    echo'<div class="blogImageDiv">';
                        # Place image (if any)
                        if($image) {
                            # Shorten the txt div
                            $col = 7;
                            # Change alt text if available
                            if($image['txt'])
                                $alt = $image['txt'];

                            echo'<img src="'.$image['file'].'" alt="'.$alt.'" class="blogImage"/>';
                        }
                    echo'</div>';

                    // TODO: Strip breaks

                    echo '<h4 class="headline">'.$key['headline'].'</h4>';
                    echo '<p class="paragraph">'.$txt.'</p>';
                echo'</div>';

                # start new row after 3 articles
                if($br == 2){
                    $br = 0;
                    echo'</div><div class="row">';
                }
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