<?php

# Individual articles
if($key = $controller->checkId()){

    echo'<div class="row">';

        # Back link
        echo'<div class="col-12">';
            echo'<a href="'.$session->get('prePage').'" title="Forrige side">Tilbage</a>';
        echo'</div>';

        # The article (Image first)
        if ($key['file']){
            echo'<div class="col-3">';
                if(!empty($key['file'])){
                    echo'<img src="'.$key['file'].'" 
                                class="articleImage" 
                                alt="'.$key['imageAlt'].'"/>';
                }
            echo'</div>';
        }

        # The headline and paragraph
        echo'<div class="col-9" style="margin-top:-25px;">';
            echo '<h1 class="font-headline">'.$key['headline'].'</h1>';
            echo '<p class="font-paragraph">'.$key['txt'].'</p>';
        echo'</div>';
    echo'</div>';
} 


# All articles
if (!$controller->checkId()) {

    $result = $controller->getPosts();
    $date   = null;
    $br     = 0;

    # Amount of articles
    echo'<div class="row">';
        echo'<div class="col-12">';
            echo'<form method="get" action="?blog">';
                echo'<input type="hidden" name="blog">';
                echo'Vis'.$singleton->spaces(3);
                echo'<select name="antal" id="articleAmount">';
                    $values = [6, 12, 25, 50];
                    foreach ($values as $key) {
                        $selected = null;
                        if(isset($_GET['antal']) && in_array($_GET['antal'], $values) && $key == $_GET['antal'])
                            $selected = "selected";
                        echo'<option value="'.$key.'" '.$selected.'>'.$key.'</option>';
                    }
                echo'</select>';
                echo $singleton->spaces(3).'artikler per side.';
                echo'<input type="submit" class="hiddenSubmit" id="amountPerPage">';
            echo'</form>';
        echo'</div>';
    echo'</div>';

    echo'<ul>';
    foreach ($result as $key) { 
        $br++;
        $encodedId = $controller->encodeId($key['id']);

        # Places (and echoes) the articles in their created month/year section
        $month   = $time->getMonth(substr($key['time'], 3, 2));
        $newDate = $month." ".substr($key['time'], 6, 4);
        if($date != $newDate){
            $date      = $newDate;
            echo '</ul>';
            echo '<div class="col-12" style="padding-left:100px;"><small>'.$date.'</small></div>';
            echo'<ul>';
        }

        # The article headline and its teaser
        echo '<li class="col-12 postsDiv" id="'.$br.'">';
            echo'<a href="'.$singleton->getUrl().'&id='.$encodedId.'" title="Åben Artikel">';
                echo'<h4 class="font-headline">'.$key['headline'].'</h4>';
            echo'</a>';
            echo'<p class="font-paragraph">'.$key['teaser'].'</p>';
        echo'</li>';
    }
    echo'</ul>';


    # Pagination (ish)
    echo'<div class="row">';
        # Less Articles
        echo'<div class="col-6" style="text-align:center; margin:5px 0 0; padding:0; border-right:1px solid #f1f1f1;">';
            if($controller->getLess()['less'] == true){
                $jumpto = $controller->getJump()-12;
                echo'<a href="'.$singleton->getUrl().'&side='.$controller->getLess()['page'].'#'.$jumpto.'" class="blogBackForth">Hent Færre</a>';
            }
        echo'</div>';

        # More articles
        echo'<div class="col-6" style="text-align:center; margin:5px 0 0; padding:0; border-left:1px solid lightgrey;">';
            if($controller->getMore()['forward'] == true){
                echo'<a href="'.$singleton->getUrl().'&side='.$controller->getMore()['page'].'#'.$controller->getJump().'" class="blogBackForth">Hent Flere</a>';
            }
        echo'</div>';
    echo'</div>';
}

?>
