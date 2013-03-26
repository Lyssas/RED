<?php
/**
* Holding a instance of CRed to enable use of $this in subclasses.
*
* @package RedCore
*/
class CObject {

   public $config;
   public $request;
   public $data;
   public $db;
   public $views;
   public $session;
   public $timer;
   public $user;
   
   /**
    * Constructor
    */
   protected function __construct($RED = null) 
   {
   	   if(!$RED) 
   	   {
   	   	   $RED = CRed::Instance();
   	   }
   	   $this->config   = &$RED->config;
   	   $this->request  = &$RED->request;
   	   $this->data     = &$RED->data;
   	   $this->db       = &$RED->db;
   	   $this->views    = &$RED->views;
   	   $this->session    = &$RED->session;
   	   $this->timer    = &$RED->timer;
   	   $this->user    = &$RED->user;
   }
   
   /**
	 * Redirect to another url and store the session
	 */
	protected function RedirectTo($urlOrController=null, $method=null) {
    $RED = CRed::Instance();
    if(isset($RED->config['debug']['db-num-queries']) && $RED->config['debug']['db-num-queries'] && isset($RED->db)) {
      $this->session->SetFlash('database_numQueries', $this->db->GetNumQueries());
    }    
    if(isset($RED->config['debug']['db-queries']) && $RED->config['debug']['db-queries'] && isset($RED->db)) {
      $this->session->SetFlash('database_queries', $this->db->GetQueries());
    }    
    if(isset($RED->config['debug']['timer']) && $RED->config['debug']['timer']) {
	    $this->session->SetFlash('timer', $RED->timer);
    }    
    $this->session->StoreInSession();
    header('Location: ' . $this->request->CreateUrl($urlOrController, $method));
  }


	/**
	 * Redirect to a method within the current controller. Defaults to index-method. Uses RedirectTo().
	 *
	 * @param string method name the method, default is index method.
	 */
	protected function RedirectToController($method=null) {
    $this->RedirectTo($this->request->controller, $method);
  }


	/**
	 * Redirect to a controller and method. Uses RedirectTo().
	 *
	 * @param string controller name the controller or null for current controller.
	 * @param string method name the method, default is current method.
	 */
	protected function RedirectToControllerMethod($controller=null, $method=null) {
	  $controller = is_null($controller) ? $this->request->controller : null;
	  $method = is_null($method) ? $this->request->method : null;	  
    $this->RedirectTo($this->request->CreateUrl($controller, $method));
  }

}
