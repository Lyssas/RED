<?php
/**
* Helpers for the template file.
*/
$fn = 'base_url';
$ly->data['header'] = <<<EOD



<header id = "top">
	<!-- logo -->
	<div>
		<img src={$fn('img/logoLydia.png')} alt="lydia logo" > 
	</div>	
</header>

EOD;


if($ly->data['main'] == "")
{
	$ly->data['main']   = '<div class = "temp"><p>Not much to report for now.</p></div>';
}
$ly->data['footer'] = '<footer id = "bottom"><p>Lydia by Henrik Lundqvist. Inspired by and created with tutorial for &copy; Lydia by Mikael Roos (mos@dbwebb.se)</p></div>';
  
/**
* Print debuginformation from the framework.
*/
function get_debug() {
  $ly = CLydia::Instance();
  $html = "<div class = 'debug'><h2>Debuginformation</h2><hr><p>The content of the config array:</p><pre>" . htmlentities(print_r($ly->config, true)) . "</pre>";
  $html .= "<hr><p>The content of the data array:</p><pre>" . htmlentities(print_r($ly->data, true)) . "</pre>";
  $html .= "<hr><p>The content of the request array:</p><pre>" . htmlentities(print_r($ly->request, true)) . "</pre> </div>";
  return $html;
}
