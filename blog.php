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

$result = $controller->getPosts();
$alt = "Article Image";
$br = 0;

# Content
echo'<div class="row content">';
    echo'<div class="col-2 no-mobile"></div>';
    echo'<div class="col-8">';

        echo'<div class="row">';

            # Individual articles
            if($key = $controller->checkId()){

                echo'<div class="col-12">';
                    echo'<a href="" title="Forrige side">Tilbage</a>';
                echo'</div>';

                echo'<div class="col-12">';
                    if(!empty($key['file'])){
                        echo'<img src="'.$key['file'].'" 
                                    class="articleImage" 
                                    alt="'.$key['imageAlt'].'"/>';
                    }

                    echo '<h1 class="headline">'.$key['headline'].'</h1>';
                    echo '<p class="paragraph">'.$key['txt'].'</p>';
                    echo'<br>';
                echo'</div>';
                
                // $idDec = $b64->decode($_GET['id']);
                // $postId = array_search($idDec, array_column($result, 'id'));
                // if($postId >= 0)
                //     $post = $result[$postId];
                // else
                //     header("location:blog.php");

                // echo $post['headline'];
                // echo $post['txt'];
                
            # All articles
            } else {
                
                # Fetch the articles
                foreach ($result as $key) { 

                    $br++;
                    $txt = strip_tags($key['txt']);
                    $txt = substr($txt, 0, 400);
                    
                    # Alternative image text (if any)
                    if (!empty($key['imageAlt']))
                        $alt = $key['imageAlt'];
                    
                    echo'<div class="col-6 blogPosts">';
                        echo'<div class="blogImageDiv">';
                            # Print the image (if any)
                            if (!empty($key['file']))
                                 echo'<img src="'.$key['file'].'" 
                                            alt="'.$alt.'" 
                                            class="blogImage"/>';
                        echo'</div>';

                        echo'<a href="blog.php?id='.$controller->encodeId($key['id']).'" 
                                title="Åben artikel">';
                            echo '<h4 class="headline">'.$key['headline'].'</h4>';
                        echo'</a>';
                        echo '<p class="paragraph">'.$txt.'</p>';
                    echo'</div>';

                    # start new row after 3 articles
                    if($br == 2){
                        $br = 0;
                        echo'</div><div class="row">';
                    }
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