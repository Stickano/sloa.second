<?php



# Welcome, last login
echo'<div class="row">';
    echo'<div class="col-12">';
    echo'<h3>Velkommen '.$controller->getUsername().'</h3>';
    echo $singleton->spaces(3).'Sidste login: '.$controller->getLastLoggedIn();
    echo'</div>';
echo'</div>';

# Navigation
echo'<div class="row">';
    echo'<div class="flex-container">';
        
        # Front-page
        echo'<ul>';
            echo'<li style="list-style:none;">';
                echo'<h3 style="margin-bottom:0;">Forsiden</h3>';
                echo'<ul style="padding-left:5px;">';
                    echo'<li style="list-style:none;">';
                        echo'<a href="?godmode&forsiden&velkomst" title="Velkomst Besked">Velkomst</a>';
                    echo'</li>';
                    echo'<li style="list-style:none;">';
                        echo'<a href="?godmode&forsiden&kontakt" title="Kontakt Muligheder">Kontakt</a>';
                    echo'</li>';
                    echo'<li style="list-style:none;">';
                        echo'<a href="?godmode&forsiden&support" title="Bidrag til sloa.dk">Support</a>';
                    echo'</li>';
                echo'</ul>';
            echo'</li>';
        echo'</ul>';

        # Blog 
        echo'<ul>';
            echo'<li style="list-style:none;">';
                echo'<h3 style="margin-bottom:0;">Blog</h3>';
                echo'<ul style="padding-left:5px;">';
                    echo'<li style="list-style:none;">';
                        echo'<a href="?godmode&blog&ny" title="Tilføj ny artikel">Tilføj</a>';
                    echo'</li>';
                    echo'<li style="list-style:none;">';
                        echo'<a href="?godmode&blog&alle" title="Alle artikler">Kontakt</a>';
                    echo'</li>';
                echo'</ul>';
            echo'</li>';
        echo'</ul>';

        # Portfolio
        echo'<ul>';
            echo'<li style="list-style:none;">';
                echo'<h3 style="margin-bottom:0;">Portfolio</h3>';
                echo'<ul style="padding-left:5px;">';
                    echo'<li style="list-style:none;">';
                        echo'<a href="?godmode&portfolio&ny" title="Tilføj nyt projekt">Tilføj</a>';
                    echo'</li>';
                    echo'<li style="list-style:none;">';
                        echo'<a href="?godmode&portfolio&alle" title="Alle projekter">Vis Alle</a>';
                    echo'</li>';
                echo'</ul>';
            echo'</li>';
        echo'</ul>';

        # Guides
        echo'<ul>';
            echo'<li style="list-style:none;">';
                echo'<h3 style="margin-bottom:0;">Guider</h3>';
                echo'<ul style="padding-left:5px;">';
                    echo'<li style="list-style:none;">';
                        echo'<a href="?godmode&guider&ny" title="Tilføj ny guide">Tilføj</a>';
                    echo'</li>';
                    echo'<li style="list-style:none;">';
                        echo'<a href="?godmode&guider&alle" title="Alle guider">Vis Alle</a>';
                    echo'</li>';
                echo'</ul>';
            echo'</li>';
        echo'</ul>';

        # Information
        echo'<ul>';
            echo'<li style="list-style:none;">';
                echo'<h3 style="margin-bottom:0;">Information</h3>';
                echo'<ul style="padding-left:5px;">';
                    echo'<li style="list-style:none;">';
                        echo'<a href="?godmode&information&udgiver" title="Information vedr. udgiveren">Om udgiveren</a>';
                    echo'</li>';
                    echo'<li style="list-style:none;">';
                        echo'<a href="?godmode&information&sloa" title="Information vedr. sloa.dk">Om sloa.dk</a>';
                    echo'</li>';
                    echo'<li style="list-style:none;">';
                        echo'<a href="?godmode&information&betingelser" title="Copyright information m.m.">Vilkår og Betingelser</a>';
                    echo'</li>';
                echo'</ul>';
            echo'</li>';
        echo'</ul>';

        # Contact
        echo'<ul>';
            echo'<li style="list-style:none;">';
                echo'<h3 style="margin-bottom:0;">Kontakt</h3>';
                echo'<ul style="padding-left:5px;">';
                    echo'<li style="list-style:none;">';
                        echo'<a href="?godmode&kontakt&tekst" title="Kontakt informaion">Tekst</a>';
                    echo'</li>';
                    echo'<li style="list-style:none;">';
                        echo'<a href="?godmode&kontakt&instillinger" title="Kontakt muligheder">Instillinger</a>';
                    echo'</li>';
                echo'</ul>';
            echo'</li>';
        echo'</ul>';

        # Profiles
        echo'<ul>';
            echo'<li style="list-style:none;">';
                echo'<h3 style="margin-bottom:0;">Profiler</h3>';
                echo'<ul style="padding-left:5px;">';
                    echo'<li style="list-style:none;">';
                        echo'<a href="?godmode&profiler&ny" title="Opret ny profil">Tilføj</a>';
                    echo'</li>';
                    echo'<li style="list-style:none;">';
                        echo'<a href="?godmode&profiler&alle" title="Alle profiler">Vis Alle</a>';
                    echo'</li>';
                echo'</ul>';
            echo'</li>';
        echo'</ul>';

        # Meta
        echo'<ul>';
            echo'<li style="list-style:none;">';
                echo'<h3 style="margin-bottom:0;">Meta</h3>';
                echo'<ul style="padding-left:5px;">';
                    echo'<li style="list-style:none;">';
                        echo'<a href="?godmode&meta&sider" title="sloa.dk meta data">Side Meta</a>';
                    echo'</li>';
                    echo'<li style="list-style:none;">';
                        echo'<a href="?godmode&meta&kontakt" title="Sidebarens kontakt-information">Kontakt Info</a>';
                    echo'</li>';
                    echo'<li style="list-style:none;">';
                        echo'<a href="?godmode&meta&social" title="Github, LinkedIn etc.">Social Media</a>';
                    echo'</li>';
                echo'</ul>';
            echo'</li>';
        echo'</ul>';

        # Log
        echo'<ul>';
            echo'<li style="list-style:none;">';
                echo'<h3 style="margin-bottom:0;">Loggen</h3>';
                echo'<ul style="padding-left:5px;">';
                    echo'<li style="list-style:none;">';
                        echo'<a href="?godmode&log" title="Log beskeder">Oversigt</a>';
                    echo'</li>';
                echo'</ul>';
            echo'</li>';
        echo'</ul>';

    echo'</div>';
echo'</div>';

?>