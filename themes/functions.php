<?php
/**
* Helpers for theming, available for all themes in their template files and functions.php.
* This file is included right before the themes own functions.php
*/

/**
* Print debuginformation from the framework.
*/
function get_debug() 
{
	  $RED = CRed::Instance();
	  $html = '';
	  if(isset($RED->config['debug']['RED']))
	  {
		  $html .= "<div class = 'debug'><h2>Debuginformation</h2><hr><p>The content of the config array:</p><pre>" . htmlentities(print_r($RED->config, true)) . "</pre>";
		  $html .= "<hr><p>The content of the data array:</p><pre>" . htmlentities(print_r($RED->data, true)) . "</pre>";
		  $html .= "<hr><p>The content of the request array:</p><pre>" . htmlentities(print_r($RED->request, true)) . "</pre> </div>";
	  }
	  if(isset($RED->config['debug']['db-num-queries']) && $RED->config['debug']['db-num-queries'] && isset($RED->db)) 
	  {
		  $html .= "<div class = 'debug'><h3>DB Number of queries</h3><p>Database made " . $RED->db->GetNumQueries() . " queries.</p></div>";
	  }    
	  if(isset($RED->config['debug']['db-queries']) && $RED->config['debug']['db-queries'] && isset($RED->db)) 
	  {
		  $html .= "<div class = 'debug'><h3>DB Queries</h3><p>Database made the following queries.</p><pre>" . implode('<br/><br/>', $RED->db->GetQueries()) . "</pre></div>";  	 
	  }
	  if(isset($RED->config['debug']['session']) && $RED->config['debug']['session']) {
	  	  $html .= "<div class = 'debug'><hr><h3>SESSION</h3><p>The content of CLydia->session:</p><pre>" . htmlent(print_r($RED->session, true)) . "</pre>";
	  	  $html .= "<p>The content of \$_SESSION:</p><pre>" . htmlent(print_r($_SESSION, true)) . "</pre></div>";
	  }  
	  if(isset($RED->config['debug']['timer']) && $RED->config['debug']['timer']) {
	   	  $html .= "<div class = 'debug'><hr><h3>Timer</h3><p>Page was loaded in " . round(microtime(true) - $RED->timer['first'], 5)*1000 . " msecs.</p></div>";
	  }    
	  return $html;	
}
/**
* Create a url by prepending the base_url.
*/
function base_url($url) {
	return CRed::Instance()->request->base_url . trim($url, '/');
}

/**
* Return the current url.
*/
function current_url() {
	return CRed::Instance()->request->current_url;
}

/**
* Render all views.
*/
function render_views() {
	return CRed::Instance()->views->Render();
}

/**
* Get messages stored in flash-session.
*/

function get_messages_from_session() 
{
	$messages = CRed::Instance()->session->GetMessages();
	$html = null;
	
	if(!empty($messages)) 
	{
		
		foreach($messages as $val) 
		{
			$valid = array('info', 'notice', 'success', 'warning', 'error', 'alert');
			$class = (in_array($val['type'], $valid)) ? $val['type'] : 'info';
			$html .= "<div class='$class'>{$val['message']}</div>\n";
		}
	}
	
	return $html;
}

