<?php
/**
* A model for content stored in database.
* 
* @package RedCore
*/
class CMAdminControlPanel extends CObject implements IHasSQL, ArrayAccess {

  /**
   * Properties
   */
  private $content;


  /**
   * Constructor
   */
  public function __construct($content=null) {
    parent::__construct();
    $this->content = $content;
    
  }
                                                                           

  /**
   * Implementing ArrayAccess for $this->data
   */
  public function offsetSet($offset, $value) { if (is_null($offset)) { $this->data[] = $value; } else { $this->data[$offset] = $value; }}
  public function offsetExists($offset) { return isset($this->data[$offset]); }
  public function offsetUnset($offset) { unset($this->data[$offset]); }
  public function offsetGet($offset) { return isset($this->data[$offset]) ? $this->data[$offset] : null; }


  /**
   * Implementing interface IHasSQL. Encapsulate all SQL used by this class.
   *
   * @param string $key the string that is the key of the wanted SQL-entry in the array.
   */
  public static function SQL($key=null, $args=null) 
  {
    $order_order  = isset($args['order-order']) ? $args['order-order'] : 'DESC';
    $order_by     = isset($args['order-by'])    ? $args['order-by'] : 'id'; 
   
    $queries = array(
      'delete user'		=> "DELETE FROM User WHERE id=?;",
      'delete group'		=> "DELETE FROM Groups WHERE id=?;",
      'delete content'      	=> "DELETE FROM Content WHERE id=?;",
      'delete comment'      	=> "DELETE FROM Comments WHERE id=?;",
      'user to group'  		=> 'INSERT INTO User2Groups (idUser,idGroups) VALUES (?,?);',
      'remove from group'	=> 'DELETE FROM User2Groups WHERE idUser=? AND idGroups=?',
      'add to group'  		=> 'INSERT INTO Groups (acronym,name, postRights, pageRights) VALUES (?,?,?,?);',
      'change group postRights' => 'UPDATE Groups SET postRights=? WHERE id=?;',
      'change group pageRights' => 'UPDATE Groups SET pageRights=? WHERE id=?;',
      
      
     );
    if(!isset($queries[$key])) {
      throw new Exception("No such SQL query, key '$key' was not found.");
    }
    return $queries[$key];
  }

  
  /**
  * Lets admin delete content by ID
  */  
  public function DeleteContent($contentId) 
  {
  	  
  	  $this->db->ExecuteQuery(self::SQL('delete content'), array($contentId));
  	  $this->session->AddMessage('success', "Successfully deleted content with id '{$contentId}'.");
  	  
  	  $this->RedirectToController('content');
  	  
  }
  
  /**
  * Lets admin delete posts by ID
  */  
  public function DeletePost($contentId) 
  {
  	  
  	  $this->db->ExecuteQuery(self::SQL('delete content'), array($contentId));
  	  $this->session->AddMessage('success', "Successfully deleted content with id '{$contentId}'.");
  	  
  	  $this->RedirectToController('posts');
  	  
  }
  
  /**
  * Lets admin delete pages by ID
  */  
  public function DeletePage($contentId) 
  {
  	  
  	  $this->db->ExecuteQuery(self::SQL('delete content'), array($contentId));
  	  $this->session->AddMessage('success', "Successfully deleted content with id '{$contentId}'.");
  	  
  	  $this->RedirectToController('pages');
  	  
  }
  
  /**
  * Lets admin delete comments by ID
  * Redirects to content controller
  */  
  public function DeleteCommentContent($commentId) 
  {
  	  
  	  $this->db->ExecuteQuery(self::SQL('delete comment'), array($commentId));
  	  $this->session->AddMessage('success', "Successfully deleted comment with id '{$commentId}'.");
  	  
  	  $this->RedirectToController('content');
  	  
  }
  
  /**
  * Lets admin delete comments by ID
  * Redirects to post controller
  */  
  public function DeleteCommentPost($commentId) 
  {
  	  
  	  $this->db->ExecuteQuery(self::SQL('delete comment'), array($commentId));
  	  $this->session->AddMessage('success', "Successfully deleted comment with id '{$commentId}'.");
  	  
  	  $this->RedirectToController('posts');
  	  
  }
  
  /**
  * Lets admin delete users by id
  */  
  public function DeleteUser($id) 
  {
  	  
  	  $this->db->ExecuteQuery(self::SQL('delete user'), array($id));
  	  $this->session->AddMessage('success', "Successfully deleted user with id '{$id}'.");
  	  
  	  $this->RedirectToController('users');
  	  
  }
  
   /**
  * Lets admin give admin rights to users
  */  
  public function AddToGroup($id, $groupId) 
  {
  	  try {
  	  $this->db->ExecuteQuery(self::SQL('user to group'), array($id, $groupId));
  	  $this->session->AddMessage('success', "Successfully added the user with id: {$id} to the group with id: {$groupId}.");
  	  
  	  $this->RedirectToController('users');
  	  }
  	  catch(Exception $e)
  	  {
  	  	  $this->session->AddMessage('error', "The user with id:{$id} is already a member of the group with id: {$groupId}.");
  	  	  $this->RedirectToController('users');	  
  	  }
  	  
  }
  
   /**
  * Lets admin revoke admin rights to users
  */  
  public function RemoveFromGroup($id, $groupId) 
  {
  	  
  	  $this->db->ExecuteQuery(self::SQL('remove from group'), array($id, $groupId));
  	  $this->session->AddMessage('success', "Successfully removed the user with id: {$id} from the group with id: {$groupId}.");
  	  
  	  $this->RedirectToController('users');
  	  
  }
    
  /**
  * Lets admin delete groups by Acronym
  */  
  public function DeleteGroup($id) 
  {
  	  
  	  $this->db->ExecuteQuery(self::SQL('delete group'), array($id));
  	  $this->session->AddMessage('success', "Successfully deleted group with id '{$id}'.");
  	  
  	  $this->RedirectToController('groups');
  	  
  }
  
   /**
   * Create new user.
   *
   * @param $acronym string the acronym.
   * @param $password string the password plain text to use as base. 
   * @param $name string the user full name.
   * @param $email string the user email.
   * @returns boolean true if user was created or else false and sets failure message in session.
   */
  public function CreateGroup($acronym, $name) 
  {
    
    $this->db->ExecuteQuery(self::SQL('add to group'), array($acronym, $name, 1, 1));
    if($this->db->RowCount() == 0) {
      $this->session->AddMessage('error', "Failed to create group.");
      return false;
    }
    return true;
  }
  
  /**
  * Lets admin change group post reader right by Id
  */  
  public function ChangeGroupPostRights($id, $rights) 
  {
  	  
  	  $this->db->ExecuteQuery(self::SQL('change group postRights'), array($rights, $id));
  	  $this->session->AddMessage('success', "Successfully changed post rights of the group with the id: {$id}'.");
  	  
  	  $this->RedirectToController('groups');
  	  
  }
  
   /**
  * Lets admin change group page reader right by Id
  */  
  public function ChangeGroupPageRights($id, $rights) 
  {
  	  
  	  $this->db->ExecuteQuery(self::SQL('change group pageRights'), array($rights, $id));
  	  $this->session->AddMessage('success', "Successfully changed post rights of the group with the id: {$id}'.");
  	  
  	  $this->RedirectToController('groups');
  	  
  }
}
