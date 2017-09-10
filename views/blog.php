<?php

$result = $controller->getPosts();
$br = 0;

echo'<div class="row">';

# Individual articles
if($key = $controller->checkId()){

    # Back link
    echo'<div class="col-12">';
        echo'<a href="'.$session->get('prePage').'" title="Forrige side">Tilbage</a>';
    echo'</div>';

    # The article (Image first)
    echo'<div class="col-12">';
        if(!empty($key['file'])){
            echo'<img src="'.$key['file'].'" 
                        class="articleImage" 
                        alt="'.$key['imageAlt'].'"/>';
        }

        # The headline and paragraph
        echo '<h1 class="font-headline">'.$key['headline'].'</h1>';
        echo '<p class="font-paragraph">'.$key['txt'].'</p>';
        echo'<br>';
    echo'</div>';    
} 


# All articles
if (!$controller->checkId()) {

    $date = null;

    # Fetch the articles
    echo'<div class="col-8">';
    foreach ($result as $key) { 

        $encodedId = $controller->encodeId($key['id']);

        # For border (top/bottom)
        $borderTop = null;
        if ($br == 0) {
            $br++;
            $borderTop = "postDivTop";
        }

        # Places (and echoes) the articles in their created month/year section
        $month = $time->getMonth(substr($key['time'], 3, 2));
        $newDate = $month." ".substr($key['time'], 6, 4);
        if($date != $newDate){
            $date = $newDate;
            echo '<div class="col-12"><small>'.$date.'</small></div>';
            $borderTop = "postDivTop";
        }

        echo '<div class="col-12 postsDiv '.$borderTop.'">';
            echo'<a href="?blog&id='.$encodedId.'" title="Åben Artikel">';
                echo'<h4 class="font-headline">'.$key['headline'].'</h4>';
            echo'</a>';
            echo'<p class="font-paragraph">'.$key['teaser'].'</p>';
        echo'</div>';
    }
    echo'</div>';
}

echo'</div>';

?>