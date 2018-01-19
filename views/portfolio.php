<?php

# Individual project view
if($key = $controller->checkId()){
    echo'<div class="row">';

        # Back link
        echo'<div class="col-12">';
            echo'<a href="'.$session->get('prePage').'" title="Forrige side">Tilbage</a>';
        echo'</div>';

        # The headline and paragraph
        echo'<div class="col-9" style="margin-top:-25px;">';
            echo '<h1 class="font-headline">'.$key['headline'].'</h1>';
            echo '<p class="font-paragraph">'.$key['txt'].'</p>';
        echo'</div>';
    echo'</div>';
}

# All projects
if(!$key = $controller->checkId()){

    # Amount and notes/articles to display
    echo'<div class="row">';
        echo'<div class="col-12">';
            echo'<form method="get" action="?portfolio">';
                echo'<input type="hidden" name="portfolio">';

                # Chose the category
                echo'Vis'.$singleton->spaces(3);
                echo'<select name="kategori" id="category">';
                    echo'<option value="alle">Alle</option>';
                    foreach ($controller->getCategories() as $key) {
                        $selected = null;
                        if(isset($_GET['kategori']) && strtolower($key['category']) == strtolower($_GET['kategori']))
                            $selected = "selected";
                        echo'<option value="'.strtolower($key['category']).'" '.$selected.'>'.ucfirst($key['category']).'</option>';
                    }
                echo'</select>';

                echo $singleton->spaces(3).'projekter.';
                echo'<input type="submit" class="hiddenSubmit" id="portfolioFilter">';
            echo'</form>';
        echo'</div>';
    echo'</div>';

    # Fetch all the projects in a flex-container
    echo'<div class="flex-container">';
        foreach ($controller->getProjects() as $key) {
            $encodedId = $controller->encodeId($key['id']);
            echo'<div class="projectContainer" style="background-image:url(\''.$key['file'].'\');">';

                # Lightbox preview for images
                echo'<a data-fancybox="'.$key['id'].'" class="right portfolioPreviewIcon" href="'.$key['file'].'">';
                    echo'<i class="fa fa-search" aria-hidden="true"></i>';
                echo'</a>';

                echo'<div class="projectInfoContainer">';
                    # The headline
                    echo'<a href="'.$singleton->getUrl().'&id='.$encodedId.'" title="Åben Projekt">';
                        echo '<h4 class="font-headline" style="font-size:80%;">'.$key['headline'].'</h4>';
                    echo'</a>';

                    # The teaser
                    echo'<a href="'.$singleton->getUrl().'&id='.$encodedId.'" style="color:black; text-decoration:none;">';
                        echo '<p class="font-paragraph" style="font-size:80%;">'.$key['teaser'].'</p>';
                    echo'</a>';
                echo'</div>';
            echo'</div>';
        }
    echo'</div>';
}

?>