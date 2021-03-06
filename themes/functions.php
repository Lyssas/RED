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
	  if($RED->config['debug']['RED']==1)
	  {
		  $html .= "<div class = 'debug'><h2>Debuginformation</h2><hr><p>The content of the config array:</p><pre>" . htmlentities(print_r($RED->config, true)) . "</pre>";
		  $html .= "<hr><p>The content of the data array:</p><pre>" . htmlentities(print_r($RED->data, true)) . "</pre>";
		  $html .= "<hr><p>The content of the request array:</p><pre>" . htmlentities(print_r($RED->request, true)) . "</pre> </div>";
	  }
	  if($RED->config['debug']['db-num-queries']==1 && $RED->config['debug']['db-num-queries'] && isset($RED->db)) 
	  {
		  $html .= "<div class = 'debug'><h3>DB Number of queries</h3><p>Database made " . $RED->db->GetNumQueries() . " queries.</p></div>";
	  }    
	  if($RED->config['debug']['db-queries']==1 && $RED->config['debug']['db-queries'] && isset($RED->db)) 
	  {
		  $html .= "<div class = 'debug'><h3>DB Queries</h3><p>Database made the following queries.</p><pre>" . implode('<br/><br/>', $RED->db->GetQueries()) . "</pre></div>";  	 
	  }
	  if($RED->config['debug']['session']==1 && $RED->config['debug']['session']) {
	  	  $html .= "<div class = 'debug'><hr><h3>SESSION</h3><p>The content of CRed->session:</p><pre>" . htmlent(print_r($RED->session, true)) . "</pre>";
	  	  $html .= "<p>The content of \$_SESSION:</p><pre>" . htmlent(print_r($_SESSION, true)) . "</pre></div>";
	  }  
	  if($RED->config['debug']['timer']==1 && $RED->config['debug']['timer']) {
	   	  @$html .= "<div class = 'debug'><hr><h3>Timer</h3><p>Page was loaded in " . round(microtime(true) - $RED->timer['first'], 5)*1000 . " msecs.</p></div>";
	  }    
	  return $html;	
}
/**
* Create a url by prepending the base_url.
*/
function base_url($url = 'null') {
	return CRed::Instance()->request->base_url . trim($url, '/');
}

  /**
 * Create a url to an internal resource.
 *
 * @param string the whole url or the controller. Leave empty for current controller.
 * @param string the method when specifying controller as first argument, else leave empty.
 * @param string the extra arguments to the method, leave empty if not using method.
 */
function create_url($urlOrController=null, $method=null, $arguments=null) 
{
  return CRed::Instance()->request->CreateUrl($urlOrController, $method, $arguments);
}

/**
* Return the current url.
*/
function current_url() {
	return CRed::Instance()->request->current_url;
}


/**
* Render all views.
*
* @param $region string the region to draw the content in.
*/
function render_views($region='default') {
  return CRed::Instance()->views->Render($region);
}

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

/**
* Login menu. Creates a menu which reflects if user is logged in or not.
*/
function login_menu() {
  $RED = CRed::Instance();
  if($RED->user->IsAuthenticated()) {
   $items = "<a class = 'login' href='" . create_url('user/profile') . "'><img class='gravatar' src='" . get_gravatar(20) . "' alt=''> " . $RED->user['acronym'] . "</img></a> ";
    if($RED->user->IsAdministrator()) {
      $items .= "<a class = 'login' href='" . $RED->request->CreateUrl('acp') . "'>acp</a> ";
    }
    $items .= "<a class = 'login' href='" . $RED->request->CreateUrl('user/logout') . "'>logout</a> ";
  } else {
    $items = "<a class = 'login' href='" . $RED->request->CreateUrl('user/login') . "'>login</a> ";
  }
  return "<nav>$items</nav>";
}

/**
* Get a gravatar based on the user's email.
*/
function get_gravatar($size=null) {
  return 'http://www.gravatar.com/avatar/' . md5(strtolower(trim(CRed::Instance()->user['email']))) . '.jpg?' . ($size ? "s=$size" : null);
}

/**
 * Escape data to make it safe to write in the browser.
 *
 * @param $str string to escape.
 * @returns string the escaped string.
 */
function esc($str) {
  return htmlEnt($str);
}

/**
 * Filter data according to a filter. Uses CMContent::Filter()
 *
 * @param $data string the data-string to filter.
 * @param $filter string the filter to use.
 * @returns string the filtered string.
 */
function filter_data($data, $filter) {
  return CMContent::Filter($data, $filter);
}

/**
 * Prepend the theme_url, which is the url to the current theme directory.
 */
function theme_url($url) {
 return create_url(CRed::Instance()->themeUrl . "/{$url}");
}

/**
 * Prepend the theme_parent_url, which is the url to the parent theme directory.
 *
 * @param $url string the url-part to prepend.
 * @returns string the absolute url.
 */
function theme_parent_url($url) {
  return create_url(CRed::Instance()->themeParentUrl . "/{$url}");
}

/**
* Check if region has views. Accepts variable amount of arguments as regions.
*
* @param $region string the region to draw the content in.
*/
function region_has_content($region='default' /*...*/) {
  return CRed::Instance()->views->RegionHasView(func_get_args());
}

