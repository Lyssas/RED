<?php
/**
 * Admin Control Panel to manage admin stuff.
 * 
 * @package RedCore
 */
class CCAdminControlPanel extends CObject implements IController {


  /**
   * Constructor
   */
  public function __construct() 
  {
  	  $RED = CRed::Instance();
  	  if($RED->user->IsAdministrator()) 
  	  {
  	  	  parent::__construct();
  	  }
  	  else
  	  {
  	  	 parent::__construct();
  	  	 $this->session->AddMessage('error', "You are not an admin, at least not on this page. I hope you do not get devastated by this... If you actualy are an admin on this page you have most likely forgotten to log in. If you have revoked your own admin rights, and succequently logged out you might wish to head over to the user page and reset the user table.");
  	  	 $this->redirectTo('index');  
  	  }
  }


  /**
   * Show what the admin can do in the ACP.
   */
  public function Index() {
  	$content = new CMContent();	
  	
  	$this->views->SetTitle('ACP: Admin Control Panel');
  		$this->views->AddInclude(__DIR__ . '/index.tpl.php', array(
                  'posts' => $content->ListAll(array(
                  	  'type'=>'post', 'order-by'=>'created', 'order-order'=>'DESC')),
                  'pages' => $content->ListAll(array(
                  	  'type'=>'page', 'order-by'=>'created', 'order-order'=>'DESC')),
                  
                ));
  }
  
  /**
   * Show and allow the admin to manage all content (posts and pages).
   */
  public function Content() {
  	$content = new CMContent();
  	
  	$this->views->SetTitle('ACP: Manage Content');
  		$this->views->AddInclude(__DIR__ . '/content.tpl.php', array(
                  'posts' => $content->ListAll(array(
                  	  'type'=>'post', 'order-by'=>'created', 'order-order'=>'DESC')),
                  'pages' => $content->ListAll(array(
                  	  'type'=>'page', 'order-by'=>'created', 'order-order'=>'DESC')),
                  'comments' => $content->ListAllComments(array(
                  	  'order-by'=>'created', 'order-order'=>'DESC')),
                ));
  }
  
  /**
   * Show and allow the admin to manage pages.
   */
  public function Pages() {
  	$content = new CMContent();
  	
  	$this->views->SetTitle('ACP: Manage Pages');
  		$this->views->AddInclude(__DIR__ . '/pages.tpl.php', array(              
                  'pages' => $content->ListAll(array(
                  	  'type'=>'page', 'order-by'=>'created', 'order-order'=>'DESC')),
                ));
  }
  
  /**
  * Show and allow the admin to manage posts.
  */
  public function Posts() {
  	$content = new CMContent();	  
  	$this->views->SetTitle('ACP: Manage Posts');
  		$this->views->AddInclude(__DIR__ . '/posts.tpl.php', array(              
                  'posts' => $content->ListAll(array(
                  	  'type'=>'post', 'order-by'=>'created', 'order-order'=>'DESC')),
                  'comments' => $content->ListAllComments(array(
                  	  'order-by'=>'created', 'order-order'=>'DESC')),
                ));
  }
  
  /**
  * Show and allow the admin to manage posts.
  */
  public function DeleteContent($contentId=null) 
  {
  	$admin = new CMAdminControlPanel();
  	
  	$admin->DeleteContent($contentId);               
  }
  
  /**
   * Deletes a post
   */
  public function DeletePost($contentId=null) 
  {
  	$admin = new CMAdminControlPanel();
  	
  	$admin->DeletePost($contentId);               
  }
  /**
   * Deletes a page
   */
  public function DeletePage($contentId=null) 
  {
  	$admin = new CMAdminControlPanel();
  	
  	$admin->DeletePage($contentId);               
  }
  /**
   * Deletes a comment, redirects back to content manager
   */
  public function DeleteCommentContent($commentId=null) 
  {
  	$admin = new CMAdminControlPanel();
  	
  	$admin->DeleteCommentContent($commentId);               
  }
  /**
   * Deletes a comment, redirects back to posts manager
   */
  public function DeleteCommentPost($commentId=null) 
  {
  	$admin = new CMAdminControlPanel();
  	
  	$admin->DeleteCommentPost($commentId);               
  }
  
 /**
 * Show and allow the admin to manage users.
 */
 public function Users() 
 {
  	$users = new CMUser();	
  	$admin = new CMAdminControlPanel();
  	
  	$this->views->SetTitle('ACP: Manage Users');
  		$this->views->AddInclude(__DIR__ . '/users.tpl.php', array(              
                  'users' => $users->ListAllUsers(array(
                  	  'order-by'=>'acronym', 'order-order'=>'DESC')),
                  'groups' => $users->ListAllGroups(array(
                  	  'order-by'=>'acronym', 'order-order'=>'DESC')),
                  'memberships' => $users->ListAllMemberships(),
                  
                ));
  }
  /**
   * Deletes a user
   */
  public function DeleteUser($id=null) 
  {
  	$admin = new CMAdminControlPanel();
  	
  	$admin->DeleteUser($id);               
  }
  /**
   * Adds a user to a group, takes the user and group id as arguments
   */
  public function AddToGroup($id=null, $groupId=null) 
  {
  	$admin = new CMAdminControlPanel();
  	
  	$admin->AddToGroup($id, $groupId);               
  }
  
  /**
   * Removes a user from a group, takes the user and group id as arguments
   */
  public function RemoveFromGroup($id=null, $groupId=null) 
  {
  	$admin = new CMAdminControlPanel();
  	
  	$admin->RemoveFromGroup($id, $groupId);               
  }
  
 /**
 * Show and allow the admin to manage groups.
 */
 public function Groups() 
 {
  	$users = new CMUser();	  
  	$this->views->SetTitle('ACP: Manage Groups');
  		$this->views->AddInclude(__DIR__ . '/groups.tpl.php', array(              
                  'groups' => $users->ListAllGroups(array(
                  	  'order-by'=>'acronym', 'order-order'=>'DESC')),
                ));
  }
  
  /**
   * Deletes a group, takes the group acronym as argument
   */
  public function DeleteGroup($id=null) 
  {
  	$admin = new CMAdminControlPanel();
  	
  	$admin->DeleteGroup($id);               
  }
  
 /**
 * Create a new group.
 */
  public function CreateGroup() 
  {
    $form = new CFormGroupCreate($this);
    if($form->Check() === false) {
      $this->session->AddMessage('notice', 'You must fill in all values.');
      $this->RedirectToController('CreateGroup');
    }
    $this->views->SetTitle('Create group');
                $this->views->AddInclude(__DIR__ . '/createGroup.tpl.php', array(
                	'form' => $form->GetHTML()));     
  }
  
  public function DoCreateGroup($form) 
  {    
  	 
  $admin = new CMAdminControlPanel();
 
     if($admin->CreateGroup($form['acronym']['value'], 
                         	$form['name']['value']
                         	)) 
     {
     	     $this->session->AddMessage('success', "The group was successfully created.");
      
     	     $this->RedirectToController('groups');
    } else {
      $this->session->AddMessage('notice', "Failed to create the group.");
      $this->RedirectToController('createGroup');
    }
  }
  	
  public function ChangeGroupPageRights($id, $rights) 
  {
  	$admin = new CMAdminControlPanel();
  	
  	$admin->ChangeGroupPageRights($id, $rights);
  }
  
  public function ChangeGroupPostRights($id, $rights) 
  {
  	$admin = new CMAdminControlPanel();
  	
  	$admin->ChangeGroupPostRights($id, $rights);
  }

}
