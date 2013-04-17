<?php
/**
* A blog controller to display a blog-like list of all content labelled as "post".
* 
* @package RedCore
*/
class CCBlog extends CObject implements IController {


  /**
   * Constructor
   */
  public function __construct() {
    parent::__construct();
  }


  /**
   * Display all content of the type "post".
   */
  public function Index() {
    $content = new CMContent();
    
    if($this->config['require_permissions'] == true)
    	{
    	    $this->user->CheckGroupPostRights('content');
    	}
    	
    $this->views->SetTitle('Blog');
                $this->views->AddInclude(__DIR__ . '/index.tpl.php', array(
                  'contents' => $content->ListAll(array('type'=>'post', 'order-by'=>'created', 'order-order'=>'DESC')),
                ));
  }


}
