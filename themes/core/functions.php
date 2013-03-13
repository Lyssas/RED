<?php
/**
* Helpers for the template file.
*/
$fn = 'base_url';
$RED->data['header'] = <<<EOD



<header id = "top">
	<!-- logo -->
	<div>
		<img src={$fn('img/logoRED.png')} alt="RED logo" > 
	</div>	
</header>

EOD;


if($RED->data['main'] == "")
{
	$RED->data['main']   = '<div class = "temp"><p>Not much to report for now.</p></div>';
}
$RED->data['footer'] = '<footer id = "bottom"><p>&copy; RED by Henrik Lundqvist. Inspired by and created with tutorial for &copy; Lydia by Mikael Roos (mos@dbwebb.se)</p></footer>';
  
/**
* Print debuginformation from the framework.
*/
function get_debug() {
  $RED = CRed::Instance();
  $html = "<div class = 'debug'><h2>Debuginformation</h2><hr><p>The content of the config array:</p><pre>" . htmlentities(print_r($RED->config, true)) . "</pre>";
  $html .= "<hr><p>The content of the data array:</p><pre>" . htmlentities(print_r($RED->data, true)) . "</pre>";
  $html .= "<hr><p>The content of the request array:</p><pre>" . htmlentities(print_r($RED->request, true)) . "</pre> </div>";
  return $html;
}
