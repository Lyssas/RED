<?php
/**
* A user controller to manage content.
* 
* @package RedCore
*/
class CCContent extends CObject implements IController {


  /**
   * Constructor
   */
  public function __construct() { parent::__construct(); }


  /**
   * Show a listing of all content.
   */
  public function Index() {
    $content = new CMContent();
    $this->views->SetTitle('Content Controller');
                $this->views->AddInclude(__DIR__ . '/index.tpl.php', array(
                  'contents' => $content->ListAll(),
                ));
  }
  

  /**
   * Edit a selected content, or prepare to create new content if argument is missing.
   *
   * @param id integer the id of the content.
   */
  public function Edit($id=null) {
    if($this->user->IsAdministrator()==false)
    {
    	    	$this->session->AddMessage('error', "You do not have permissions to edit content. Please log in as administrator.");
		$this->redirectToController(); 	    
    }
  	  
    $content = new CMContent($id);
    $form = new CFormContent($content);
    
   
    $status = $form->Check();
   
    if($status === false) 
    { 
    	    	    
      $this->session->AddMessage('notice', 'The form could not be processed.');
      $this->RedirectToController('edit', $id);
      
    } 
    else if($status === true) 
    {   	    
    	   
      $this->RedirectToController('edit', $content['id']);
    }
    
    
    $title = isset($id) ? 'Edit' : 'Create';
    $this->views->SetTitle("$title content: $id");
                $this->views->AddInclude(__DIR__ . '/edit.tpl.php', array(
                  'user'=>$this->user, 
                  'content'=>$content, 
                  'form'=>$form,
                ));
                
  }
  

  /**
   * Create new content.
   */
  public function Create() {
    $this->Edit();
  }


  /**
   * Init the content database.
   */
  public function Manage() {
    $content = new CMContent();
    $content->Manage('install');
    $this->RedirectToController();
  }
  
 
 /* 
  public function DoCreateComment($form, $id) 
  {    
  	  die('hello C');
  $content = new CMContent();
     if($content->CreateComments($form['author']['value'], 
                         	$form['content']['value']
                         	)) 
     {
     	     $this->session->AddMessage('success', "The group was successfully created.");
      
     	     $this->RedirectTo('content', 'view', $id);
    } else {
      $this->session->AddMessage('notice', "Failed to create the group.");
      $this->RedirectTo('content', 'view', $id);
    }
  }
  */

}
