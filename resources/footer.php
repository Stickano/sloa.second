<?php

echo'<div class="row">';
    echo'<div class="col-2 no-mobile"></div>';
    echo'<div class="col-8 footer">';

        echo'<div class="row">';

            # 
            echo'<div class="col-4 no-mobile">';
            
            echo'</div>';

            # 
            echo'<div class="col-4 no-mobile">';
              
            echo'</div>';

            # Contact Information
            $result = $singleton->db()->recieve('*', 'footer');

            # Desktop Contact info
            echo'<div itemscope itemtype="http://schema.org/Person" class="col-4 contactFooter no-mobile right">';
                echo'<small>';
                echo'<b>sloa.dk</b>';
                echo'<br>';
                echo'<span itemprop="name"><b>'.$result['name'].'</b></span>';
                echo'<br>';
                echo'<table class="right"><tr>';
                    echo'<td class="footer-td"><span itemprop="address">'.$result['adress'].'</span></td>';
                    echo'<td class="footer-td-icon"><abbr title="Lokation"><i class="fa fa-map-marker" aria-hidden="true"></i></abbr></td>';
                echo'</tr><tr>';
                    echo'<td class="footer-td"><span itemprop="telephone">'.$result['phone'].'</span></td>';
                    echo'<td class="footer-td-icon"><abbr title="Telefon"><i class="fa fa-phone" aria-hidden="true"></i></abbr></td>';
                echo'</tr><tr>';
                    echo'<td class="footer-td"><a href="mailto:'.$result['mail'].'" title="Åbner din E-mail klient"><span itemprop="email">'.$result['mail'].'</span></a></td>';
                    echo'<td class="footer-td-icon"><abbr title="E-mail"><i class="fa fa-envelope" aria-hidden="true"></i></abbr></td>';
                echo'</tr><tr>';
                    echo'<td class="footer-td"><span style="font-size:85%;">'.$result['bitcoin'].'</span></td>';
                    echo'<td class="footer-td-icon"><abbr title="Bitcoin"><i class="fa fa-btc" aria-hidden="true"></i></abbr></td>';
                echo'</tr></table>';
                echo'</small>';
            echo'</div>';

            # Mobile Contact info
            echo'<div itemscope itemtype="http://schema.org/Person" class="col-4 contactFooterMobile mobile-only">';
                echo'<small>';
                echo'<b>sloa.dk</b>';
                echo'<br>';
                echo'<span itemprop="name"><b>'.$result['name'].'</b></span>';
                echo'<br>';
                echo'<table style="position:relative; left:22em;"><tr>';
                    echo'<td class="footer-td-icon"><abbr title="Lokation"><i class="fa fa-map-marker" aria-hidden="true"></i></abbr></td>';

                    echo'<td class="footerMobile-td"><span itemprop="address">'.$result['adress'].'</span></td>';
                echo'</tr><tr>';
                    echo'<td class="footer-td-icon"><abbr title="Telefon"><i class="fa fa-phone" aria-hidden="true"></i></abbr></td>';

                    echo'<td class="footerMobile-td"><span itemprop="telephone">'.$result['phone'].'</span></td>';
                echo'</tr><tr>';
                    echo'<td class="footer-td-icon"><abbr title="E-mail"><i class="fa fa-envelope" aria-hidden="true"></i></abbr></td>';

                    echo'<td class="footerMobile-td"><a href="mailto:'.$result['mail'].'" title="Åbner din E-mail klient"><span itemprop="email">'.$result['mail'].'</span></a></td>';
                echo'</tr><tr>';
                    echo'<td class="footer-td-icon"><abbr title="Bitcoin"><i class="fa fa-btc" aria-hidden="true"></i></abbr></td>';

                    echo'<td class="footerMobile-td"><span style="font-size:85%;">'.$result['bitcoin'].'</span></td>';
                echo'</tr></table>';
                echo'</small>';
            echo'</div>';

        echo'</div>';

        // TDOD: Top option

        # Bottom © and social
        $result = $singleton->db()->recieve('*', 'socialmedia');
        echo'<div style="width:100%; padding-bottom:.5%;">';
            echo'<span style="font-size:75%;">© '.$singleton::$time->timestamp('year').'</span>';
            echo'<div class="right">';
                foreach ($result as $key) {
                    if($key['active'] == true){
                        echo $singleton->spaces(2);
                        echo'<a href="'.$key['link'].'" class="white-link" title="'.$key['link_title'].'">';
                            echo'<i class="fa fa-github" aria-hidden="true"></i>';
                        echo'</a>';
                    }
                } 
            echo'</div>';
        echo'</div>';

    echo'</div>';
    echo'<div class="col-2 no-mobile"></div>';
echo'</div>';

?>