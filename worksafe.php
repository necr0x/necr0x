<?php
    include('config.php');
    $result = mysql_query("SELECT * FROM $c_tab WHERE public = 1 ORDER BY id DESC");
    include("header.php"); ?>
<!--JWPlayer--> 
<script type="text/javascript" src="js/jwplayer.js"></script>
<script type="text/javascript" src="js/jwplayer.html5.js"></script>
<script type="text/javascript">jwplayer.key="t3Yz1eHiHUIjfNBAFOgs1IcYq7hZIQoM97esbQ==";</script>
 
<!--Image zoom--> 
<script src='js/jquery.elevatezoom.js'></script>

<!--Bewertungen script-->
 <script type="text/javascript" src="js/jquery.easing.min.js"></script>
 <script type="text/javascript" src="js/jquery.easy-ticker.js"></script>

 <script type="text/javascript" src="js/scripts.js"> </script>


<div class="container"> 
    <aside>
        <p class="comment_title ">Bewertungen</p>
        <div class="vticker">
            <ul>    
            <?php while($row=mysql_fetch_array($result))  
                { ?>
                    <li>
                        <p><?=$row['text'];?> </p>
                        <b  class="comment_name"> <?=$row['name']; ?></b>  
                        <br><br><div class="vertical_line"></div>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </aside>

    <section>
        <h1> WorkSafe Precision - Billigere Montage Hanschuhen </h1>
        <div id="myElement" >Beladung ...</div>
        <script type="text/javascript" >
            jwplayer("myElement").setup({
                playlist: [{
                image: "./img/player_poster.jpg",
                sources: [{
                file: "./media/worksafe360.mp4",
                skin: "./xml/six.xml",
                label: "360p SD"
                },{
                    file: "./media/worksafe720.mp4",
                    label: "720p HD"
                    }]
                }]
            });
        </script>

        <article class="text_area">
        <div class="vertical_line"> </div>
        <br>
            <h2 class="top_text">Handschuhe WorkSafe Precision Eigenschaften</h2>
            <ul class="txt_ul">
                <li><span style="color:#AC9F98">Haut</span>  kommt nur mit dem <span style="color:#AC9F98">weichen Futte in Berührung</span> </li>
                <li>Garantiert <span style="color:#AC9F98">optimale Rutschfestigkeit</span> in nassen und öligen Bereichen</li>
                <li><span style="color:#AC9F98">Hervorragender Grip</span> dank einer Nitril-Beschichtung an der Handinnenfläche</li>
                <li>Sehr hohe Atmungsaktivität - <span style="color:#AC9F98">der beste Atmungsaktive Handschuh auf dem Markt</span></li>
                <li>Deutlich <span style="color:#AC9F98">preisgünstiger</span> im Vergleich zu den teuren <span style="color:#AC9F98">Maxiflex Ultimate</span> Handschuhen</li>
                <li>Ergonomie reduziert die <span style="color:#AC9F98">Ermüdung der Hand</span> und bietet <span style="color:#AC9F98">einen angenehmen Tragekomfort</span></li>
            </ul>            
            <div class="vertical_line"> </div>
            <img class="main_img" src="img/Worksafe-P30-101-logo.jpg" alt="WorkSafe Precision Handschuhe - Neue Bauarbeits/Montage Handschuhen aus Sweden - Jetzt im Deutschland! Billigere alternative zu denn teuren Maxiflex Ultimate Handschuhen! Kostenlose lieferung innerhalb Deutschlands und sichere bezahlung mit PayPal ohne Registrierung!">
            <div class="clear"> </div>
            <div class="vertical_line"> </div>
            <div class="clear"> </div>
            <div class="left_rigt_txt">
                <div class="hidden_div">
                    <div class="left_txt">
                        <img src="img/left-text.png" alt="Handschunhen von WorkSafe Precision ist billigere Alternative zu denn teuren Handschuhen von Maxiflex Ultimate!" />
                        <h2>Handschunhen von WorkSafe Precision ist billigere Alternative zu denn teuren Handschuhen von Maxiflex Ultimate!</h2>
                    </div>
                    <div class="right_txt"> 
                        <img src="img/right-text.png" alt="Kostenlose Lieferung und sichere PayPal Bezahlung onhe registrierung!" />
                        <h2>Kostenlose Lieferung und sichere PayPal Bezahlung onhe registrierung!</h2>
                    </div>   
                <div class="clear"> </div>

                </div>
            </div>   
                            <div class="clear"> </div>

            <div class="vertical_line"> </div>
        </article>

        <article class="text_area">
            <h2 class="bottom_text">Handschuhe Anwendungsbereich</h2>
            <h5 class="bottom_subtext">Jetzt können Sie Ihre Hände in jedem Beruf schützen ...</h5> 
            <ul class="txt_ul">
                <li>Montage langlebiger Gebrauchsgüter</li>
                <li>Logistik und Lagerverwaltung</li>
                <li>Verschiedene Montagearbeiten</li>
                <li>Haupt- und Nebenfließbänder</li>
                <li>Endfertigung und Kontrolle</li>
                <li>Arbeiten mit Kleinteilen</li>
                <li>Montage von weißer Ware</li>
                <li>Gartenbauarbeiten</li>
                <li>Wartung</li>
            </ul>
            <div class="product_img">
                <img id="zoom_01" src='./img/smallimage-1.png' data-zoom-image="./img/bigimage01.png" alt="Handschuhe WorkSafe Precision P30-101"/>
                <script type="text/javascript" src="js/scripts.js"> </script>
            </div>

            <div class="clear"></div>            
            <div class="vertical_line"> </div>
        </article>
        <article class="text_area">
            <h2 class="bottom_text">Worksafe Precision Handschuhe jetzt bestellen</h2>
            <h5 class="bottom_subtext">Der Preis ist für 12 Paar pro Packung</h5>
            <ul class="txt_ul">
                <li>Viel billiger als Maxiflex</li>
                <li>Beste und höchste Qualität</li>
                <li>Kostenlose Lieferung (DE)</li>
                <li>Sichere PayPal Bezahlung</li>
            </ul>  
        </article>
        <div class="text_area paypal_button">
            <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                <input type="hidden" name="cmd" value="_s-xclick">
                <input type="hidden" name="hosted_button_id" value="VFGAVN3P4H25N">
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <div style="width: 190px; margin: 0 auto;">
                                    <input type="radio" name="os0" id="os02" value="VFGAVN3P4H25N"><label for="os02">WorkSafe Pre Große 9</label><br>
                                    <input type="radio" name="os0" id="os03" value="CSKK7Q4EEQ8ZC"><label for="os03">WorkSafe Pre Große 10</label>
                                </div>
                                <div class="abstande">
                                    <input style="border:none" type="image" src="/img/paypal-button.png"  name="submit" alt="Jetzt einfach, schnell und sicher online bezahlen – mit PayPal." width="170">
                                    <img alt="image of paypal" style="border:none"  src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form> 
            <div class="price">
                <span class="newproductprice">30</span>
                <span class="valut">€</span>
            </div>

        </div>
        <h2 class="bottom_subtext_paypal">Wenn Sie noch Fragen haben, dann besuchen Sie bitte die <a class="link_style" href="faq_s.php">Info faq's</a> oder senden Sie bitte Ihre Frage über das Feedback-Formular auf der Seite <a class="link_style" href="kontakt.php">Kontakt</a>.</h2>	
    </section>
	
    <div class="clear"> </div>
</div>
<div class="clear"></div>
<?php include("footer.php"); ?>