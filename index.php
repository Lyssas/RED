<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

<?php
$title = "Min Me-sida om mig själv";
$pageId = "hem";
?>

<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php
  		echo $title;
  	?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
    </head>
    
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
         <?php 
        	
         	include("incl/config.php"); 
         	include("incl/header.php");  	
         ?>

<!-- Huvudsakligt innehåll -->

<div class = "content">

		<h1>Om mig</h1> 
			<figure class = "top right">
				<img src="img/me.jpg" alt="Bild på Henrik Lundqvist">
				<figcaption>
					<p> Bild: Jag och Inga-Britt.
					</p>
				</figcaption>
			</figure>
			
			<p>
			
			Jag heter Henrik Lundqvist, är 23 år gammal och har en magisterexamen i Serious 
			Games (samt en kandidatexamen i speldesign) från Högskolan i Skövde. I och med detta har jag 
			en ganska god teorigrund vad gäller design rent generellt, och viss erfarenhet då det kommer till 
			programmering i C++. Jag läser det här kurspaketet då jag känner att jag vill komplettera mina 
			kunskaper med lite mer tekniskt kunnande. I dagsläget bor jag med min flickvän i Jönköping.
			
			</p>

			<div >
			
				<p>
				På fritiden blir det en del spelande, men det hinns även med litteratur och
				träning som är stora intressen. Idag tränar jag karate, men jag har tidigare tränat 
				både ju-jutsu och shorinji-kempo, stilar inom vilka jag varit instruktör för juniorer. 
				Som bilden kanske avslöjar blir det även en del frivilligt arbete med djur på svärfars gård =).
				</p>
			
			</div>
			

	
	<?php include("incl/byline.php"); ?>

</div>

<?php include("incl/footer.php"); ?>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.0.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
    </body>
</html>
