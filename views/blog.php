<?php

$result = $controller->getPosts();
$br = 0;

echo'<div class="row">';

# Individual articles
if($key = $controller->checkId()){

    echo'<div class="col-12">';
        echo'<a href="'.$session->get('prePage').'" title="Forrige side">Tilbage</a>';
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
    
    
# All articles
} else {
    
    # Fetch the articles
    foreach ($result as $key) { 

        $br++;
        $encodedId = $controller->encodeId($key['id']);
        $txt = substr($key['txt'], 0, 200);
        $txt = strip_tags($txt);
        $txt = $txt.'...<a href="?blog&id='.$encodedId.'" title="Åben artikel">læs videre</a>';
        
        echo'<div class="col-6 blogPosts">';
            echo'<div class="blogImageDiv">';
                # Print the image (if any)
                if (!empty($key['file'])){
                     echo'<img src="'.$key['file'].'" 
                                alt="'.$key['imageAlt'].'" 
                                class="blogImage"/>';
                }
            echo'</div>';

            echo'<a href="?blog&id='.$encodedId.'" 
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

?>