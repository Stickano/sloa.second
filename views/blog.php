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

                # TODO: Fix in Controller
                $thumb = $key['file'];
                if (!empty($key['thumb']))
                    $thumb = $key['thumb'];

                echo'<a data-fancybox="gallery" href="'.$key['file'].'" style="outline:none;"><img src="'.$thumb.'" class="articleImage"></a>';
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

    # Amount and notes/articles to display
    echo'<div class="row">';
        echo'<div class="col-12">';
            echo'<form method="get" action="?blog">';
                echo'<input type="hidden" name="blog">';

                # Chose the amount of articles per page
                echo'Vis'.$singleton->spaces(3);
                echo'<select name="antal" id="articleAmount">';
                    $values = [6, 12, 25, 50]; # TODO: const in controller
                    foreach ($values as $key) {
                        $selected = null;
                        if(isset($_GET['antal']) && in_array($_GET['antal'], $values) && $key == $_GET['antal'])
                            $selected = "selected";
                        echo'<option value="'.$key.'" '.$selected.'>'.$key.'</option>';
                    }
                echo'</select>';

                # Chose between articles and notes
                echo $singleton->spaces(3);
                echo'<select name="kategori" id="category">';
                    foreach ($controller->getCategories() as $key) {
                        $selected = null;
                        if(isset($_GET['kategori']) && strtolower($key['category']) == strtolower($_GET['kategori']))
                            $selected = "selected";
                        echo'<option value="'.strtolower($key['category']).'" '.$selected.'>'.$key['category'].'</option>';
                    }
                echo'</select>';

                echo $singleton->spaces(3).'per side.';
                echo'<input type="submit" class="hiddenSubmit" id="blogFilter">';
            echo'</form>';
        echo'</div>';
    echo'</div>';

    # Loop through articles in a unordered list
    echo'<ul>';
    foreach ($result as $key) {
        $br++;
        $encodedId = $controller->encodeId($key['id']);

        # For notes, display the whole content instead of just the teaser
        # TODO: Fix in controller
        $resultParagraph = $key['teaser'];
        $resultHeadline  = '<a href="'.$singleton->getUrl().'&id='.$encodedId.'" title="Åben Artikel"> <h4 class="font-headline">'.$key['headline'].'</h4> </a>';
        if(isset($_GET['kategori']) && strtolower($_GET['kategori']) == 'notater'){
            $resultParagraph = $key['txt'];
            $resultHeadline  = '<h4 class="font-headline">'.$key['headline'].'</h4>';
        }

        # Places (and echoes) the articles in their created month/year section
        # TODO: Fix in controller
        $month   = $time->getMonth(substr($key['time'], 3, 2));
        $newDate = $month." ".substr($key['time'], 6, 4);
        if($date != $newDate){
            $date = $newDate;
            echo '</ul>';
            echo '<div class="col-12" style="padding-left:50px;"><small>'.$date.'</small></div>';
            echo'<ul>';
        }

        # The article headline and its teaser
        echo '<li class="col-12 postsDiv" id="'.$br.'" style="margin-left:0;">';
            $colSize = 12;
            echo '<span class="font-headline blue">'.$resultHeadline.'</span>';
            echo'<div class="row">';
                echo'<div class="col-'.$colSize.'">';
                    echo'<p class="font-paragraph">'.$resultParagraph.'</p>';
                echo'</div>';
            echo'</div>';
        echo'</li>';
    }
    echo'</ul>';


    # Pagination (ish)
    echo'<div class="row">';
        # Less Articles
        # TODO: Fix in controller
        $count = null;
        $cat   = null;
        if(isset($_GET['kategori']))
            $cat = '&kategori='.$_GET['kategori'];
        if(isset($_GET['antal']))
            $count = '&antal='.$_GET['antal'];

        echo'<div class="col-6" style="text-align:center; margin:5px 0 0; padding:0; border-right:1px solid #f1f1f1;">';
            if($controller->getLess()['less'] == true){
                $jumpto = $controller->getJump()-12; # TODO: Fix and smarten in controller
                echo'<a href="?blog'.$cat.$count.'&side='.$controller->getLess()['page'].'#'.$jumpto.'" class="blogBackForth">Hent Færre</a>';
            }
        echo'</div>';

        # More articles
        echo'<div class="col-6" style="text-align:center; margin:5px 0 0; padding:0; border-left:1px solid lightgrey;">';
            if($controller->getMore()['forward'] == true)
                echo'<a href="?blog'.$cat.$count.'&side='.$controller->getMore()['page'].'#'.$controller->getJump().'" class="blogBackForth">Hent Flere</a>';
        echo'</div>';
    echo'</div>';
}

?>