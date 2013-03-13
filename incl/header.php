<!-- show current nav menu choice -->
<body <?php if(isset($pageId)) echo " id='$pageId' "; ?>>

<header id = "above">
	<!-- relaterade länkar -->
			
	<nav class = "related">
		<p>
			
			<a href = "index.php"> kmoment1</a>
			
		</p>		
	</nav>
</header>

<!-- Background frames -->
<div id = "col-left" class = "bgleft"></div>
<div id = "col-right" class = "bgright"></div>

<header id = "top">
	<!-- logo -->
	<div>
		<img src="img/henriklogo.png" alt="htmlphp logo" >
	</div>

	<!-- Navigeringsmeny -->
	<nav class="navmenu">
		<a id = "hem-" href="index.php">Me</a>
		<a id = "redovisning-" href="redovisning.php">Redovisning</a>	
		<a id= "source-" href="viewsource.php">Källkod</a>
		<a id= "lydia-" href="lydia/index">Lydia (MVC)</a>
	</nav>
	
	
	
</header>

