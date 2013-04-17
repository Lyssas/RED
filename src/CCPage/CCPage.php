<?php
/**
* A page controller to display a page, for example an about-page, displays content labelled as "page".
* 
* @package RedCore
*/
class CCPage extends CObject implements IController {


  /**
   * Constructor
   */
  public function __construct() {
    parent::__construct();
  }


  /**
   * Display an empty page.
   */
  public function Index() {
    $content = new CMContent();
    $this->views->SetTitle('Page');
                $this->views->AddInclude(__DIR__ . '/index.tpl.php', array(
                  'content' => null,
                ));
  }


  /**
   * Display a page.
   *
   * @param $id integer the id of the page.
   */
  public function View($id=null) {
    $content = new CMContent($id);
    
    if($content['type'] == 'page')
    {
    	    
    	if($this->config['require_permissions'] == true)
    	{
    	    $this->user->CheckGroupPageRights('content');
    	}
    	    
    }
    
    if($content['type'] == 'post')
    {
    	if($this->config['require_permissions'] == true)
    	{
    	    $this->user->CheckGroupPostRights('content');
    	}
    	    
    }
    
    $this->views->SetTitle('Page: '.htmlEnt($content['title']));
                $this->views->AddInclude(__DIR__ . '/index.tpl.php', array(
                  'content' => $content,
                  'comments' => $content->ListComments($id, array('order-by'=>'created', 'order-order'=>'DESC')), 
              
                ));
  }
  
  /**
   * Creates a comment.
   */
  public function CreateComment($postId) 
  {
  	  $content = new CMContent($postId);
  	  
  	  if($content['type'] == 'page')
  	  {
    	    
  	  	  $this->RedirectTo('content');
    	    
  	  }
    
  	  if($content['type'] == 'post')
  	  {
  	  	  if($this->config['require_permissions'] == true)
  	  	  {
  	  	  	  $this->user->CheckGroupPostRights('content');
  	  	  }
    	    
  	  }
    
    
    $form = new CFormComment($this, $postId);
    if($form->Check() === false) {
      $this->session->AddMessage('notice', 'You must fill in all values.');
      $this->RedirectTo('page', 'createcomment/' . $postId);
    }
    $this->views->SetTitle('Create comment');
                $this->views->AddInclude(__DIR__ . '/comment.tpl.php', array(
                	'content' => $content,
                	'form' => $form->GetHTML(),               	
                	));
  }
  
  /**
   * Send info to model which saves comment to database.
   */
  public function DoCreateComment($form=null, $id=null) 
  {    	  
  $content = new CMContent();
  
     if($content->CreateComments(
     	     			$form['author']['value'], 
                         	$form['content']['value'],
                         	$form['postId']['value']
                         	
                         	)) 
     
     {
     	    
     	     $this->session->AddMessage('success', "The comment was successfully created.");
      
     	     $this->RedirectTo('page', 'view/' . $form['postId']['value']);
     	 
    } else {
      $this->session->AddMessage('notice', "Failed to create the group.");
      $this->RedirectTo('page', 'view', $form['postId']['value']);
    }
  }


}
