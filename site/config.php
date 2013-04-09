<?php
/**
* Site configuration, this file is changed by user per site.
*
*/

/*
* Set level of error reporting
*/
error_reporting(-1);
ini_set('display_errors', 1);


/**
 * Define session name
 */
$this->config['session_name'] = preg_replace('/[:\.\/-_]/', '', $_SERVER["SERVER_NAME"]);
$this->config['session_key']  = 'RED';

/*
* Define server timezone
*/
$this->config['timezone'] = 'Europe/Stockholm';

/*
* Define internal character encoding
*/
$this->config['character_encoding'] = 'UTF-8';

/*
* Define language
*/
$this->config['language'] = 'en';

/**
* Define the controllers, their classname and enable/disable them.
*
* The array-key is matched against the url, for example: 
* the url 'developer/dump' would instantiate the controller with the key "developer", that is 
* CCDeveloper and call the method "dump" in that class. This process is managed in:
* $ly->FrontControllerRoute();
* which is called in the frontcontroller phase from index.php.
*/
$this->config['controllers'] = array(
  'index'     => array('enabled' => true,'class' => 'CCIndex'),
  'developer' => array('enabled' => true,'class' => 'CCDeveloper'),
  'guestbook' => array('enabled' => true,'class' => 'CCGuestbook'),
  'user' => array('enabled' => true,'class' => 'CCUser'),
  'acp' => array('enabled' => true,'class' => 'CCAdminControlPanel'),
  'content' => array('enabled' => true,'class' => 'CCContent'),
  'blog' => array('enabled' => true,'class' => 'CCBlog'),
  'page' => array('enabled' => true,'class' => 'CCPage'),
  'theme' => array('enabled' => true,'class' => 'CCTheme'),
  'modules' => array('enabled' => true,'class' => 'CCModules'),
  'my'        => array('enabled' => true,'class' => 'CCMycontroller'),
);



/**
* Settings for the theme.
*/
$this->config['theme'] = array(
  // The name of the theme in the theme directory
  //'name'    => 'core', 
  'path'            => 'site/themes/mytheme',
  'parent'          => 'themes/grid',
  'stylesheet'      => 'style.css',
  //'stylesheet' => 'style.php',
  'template_file'   => 'index.tpl.php',
  // A list of valid theme regions
  'regions' => array('flash','featured-first','featured-middle','featured-last',
    'primary','sidebar','triptych-first','triptych-middle','triptych-last',
    'footer-column-one','footer-column-two','footer-column-three','footer-column-four',
    'footer', 'navbar',
  ),
  'menu_to_region' => array('my-navbar'=>'navbar'),
  
  'data' => array(
    'header' => 'RED',
    'slogan' => 'A PHP-based MVC-inspired CMF',
    'favicon' => 'favicon.png',
    'logo' => 'logo_80x80.png',
    'logo_width'  => 80,
    'logo_height' => 80,
    'footer' => '<footer id = "bottom"><p>&copy; RED by Henrik Lundqvist. Inspired by and created with tutorial for &copy; Lydia by Mikael Roos (mos@dbwebb.se)</p></footer>',
  ),
);


/**
* Set a base_url to use another than the default calculated
*/
$this->config['base_url'] = null;

/**
* What type of urls should be used?
* 
* default      = 0      => index.php/controller/method/arg1/arg2/arg3
* clean        = 1      => controller/method/arg1/arg2/arg3
* querystring  = 2      => index.php?q=controller/method/arg1/arg2/arg3
*/
$this->config['url_type'] = 1;

/**
* Which debug values should be displayed?
* 1 = display
* 0 = hide
*/
$this->config['debug']['RED'] = 1;
$this->config['debug']['db-num-queries'] = 1;
$this->config['debug']['db-queries'] = 1;
$this->config['debug']['session'] = 1;
$this->config['debug']['timer'] = 1;

/**
* Set database(s).
*/
$this->config['database'][0]['dsn'] = 'sqlite:' . RED_SITE_PATH . '/data/.ht.sqlite';

//Sessions
$this->config['session_key']  = 'RED';


/**
* How to hash password of new users, choose from: plain, md5salt, md5, sha1salt, sha1.
*/
$this->config['hashing_algorithm'] = 'sha1salt';

/**
* Allow or disallow creation of new user accounts.
*/
$this->config['create_new_users'] = true;

/**
* Define a routing table for urls.
*
* Route custom urls to a defined controller/method/arguments
*/
$this->config['routing'] = array(
  'home' => array('enabled' => true, 'url' => 'index/index'),
);

/**
 * Define menus.
 *
 * Create hardcoded menus and map them to a theme region through $ly->config['theme'].
 */
$this->config['menus'] = array(
  'navbar' => array(
    'home'      => array('label'=>'Home', 'url'=>'home'),
    'modules'   => array('label'=>'Modules', 'url'=>'modules'),
    'content'   => array('label'=>'Content', 'url'=>'content'),
    'guestbook' => array('label'=>'Guestbook', 'url'=>'guestbook'),
    'blog'      => array('label'=>'Blog', 'url'=>'blog'),
  ),
  'my-navbar' => array(
    'home'      => array('label'=>'About Me', 'url'=>'my'),
    'blog'      => array('label'=>'My Blog', 'url'=>'my/blog'),
    'guestbook' => array('label'=>'Guestbook', 'url'=>'my/guestbook'),
  ),

);
