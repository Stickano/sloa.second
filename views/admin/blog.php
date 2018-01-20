<?php

echo'<div class="row">';
    echo'<div class="col-12">';
        echo'<form method="get" action="?godmode&blog&alle">';
            echo'<input type="hidden" name="godmode&blog&alle">';

            # Chose between articles and notes
            echo'Vis'.$singleton->spaces(3);
            echo'<select name="kategori" id="category">';
                $values = ['Alle', 'Artikler', 'Notater'];
                foreach ($values as $key) {
                    $selected = null;
                    if(isset($_GET['kategori']) && strtolower($key['category']) == strtolower($_GET['kategori']))
                        $selected = "selected";
                    echo'<option value="'.strtolower($key).'" '.$selected.'>'.$key.'</option>';
                }
            echo'</select>';

            echo'<input type="submit" class="hiddenSubmit" id="blogFilter">';
        echo'</form>';
    echo'</div>';
echo'</div>';


echo '<table style="width:100%; border-spacing:0;">';
foreach ($controller->getArticles() as $key) {
    $color = "green";
    $title = "Aktiv artikel.";
    if ($key['active'] == 0){
        $color = "red";
        $title = "Ikke synlig. In-aktiv artikel.";
    }

    echo '<tr>';

    echo '<td style="border-bottom:1px solid black; margin:0;">';
        echo '<i class="fa fa-flag" aria-hidden="true" style="color:'.$color.';" title="'.$title.'"></i>';
    echo '</td>';
    
    echo '<td style="border-bottom:1px solid black; margin:0;">';
        echo '<h4>'.$key['headline'].'</h4>';
    echo '</td>';

    echo '<td style="text-align:right; padding-left:15px; border-bottom:1px solid black; margin:0;">';
        echo '<a href="" title="Slet">'; # TODO: Confirm
            echo '<i class="fa fa-times" aria-hidden="true"></i>';
        echo '</a>';

        echo $singleton->spaces(3);

        echo '<a href="" title="Rediger">'; 
            echo '<i class="fa fa-pencil-square-o " aria-hidden="true"></i>';
        echo '</a>';
    echo '</td>';

    echo '</tr>';

}
echo '</table>';

?>