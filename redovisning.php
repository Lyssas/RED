﻿<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    
<?php
$title = "Mina redovisningar av kursmomenten";
$pageId = "redovisning";
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

<?php include("incl/config.php"); ?>



<?php include("incl/header.php"); ?>

<div class = "content">
	
	<article>
		
		<h1>Kursmoment 1</h1> 
	
		<p>Kursmoment 1 var enkelt genomfört då det gick att återanvända mycket material från tidigare kurser, jag valde dock att arbeta om css en aning för att variera utseendet, det är ju trots allt roligare att testa någonting nytt ibland.
		</p>
		
		<p>
		Min utvecklingsmiljö består av Jedit, Filezilla samt Firefox. 
		</p>
		
		<p>
		Boilerplatekonceptet känns bra. Går det att återanvända en redan existerande mall för att lösa många avancerade problem finns det ingen direkt anledning att inte göra det. Mycket av de tekniska detaljerna av boilerplate är dock fortfarande för avancerade för att jag ska förstå exakt vad de gör, men det var enkelt att komma igång med och sidan fungerar uppenbarligen.
		</p>
		
		<p>
		När jag skapade min me sida bytte jag filändring på indexfilen till .php och återanvände me-sidan från tidigare kurser. Någonting jag kom att fundera på nu vore om jag borde använda mallen i index.php till de övriga sidorna, redovisning.php och source.php, som det är nu så använder de sidorna kanske inte boilerplate till fullo.
		</p>
		
		<p>
		Extra intressant med boilerplate är just att mallen är så pass enkel att använda och hjälper med många avancerade bekymmer. Den är användbar även om jag inte är en särskilt erfaren webbutvecklare. 
		</p>
	
	</article>
	
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