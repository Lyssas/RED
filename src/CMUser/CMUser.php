<?php
/**
* A model for an authenticated user.
* 
* @package RedCore
*/
class CMUser extends CObject implements IModule, IHasSQL, ArrayAccess {

/**
   * Properties
   */
  public $profile = array();

  /**
   * Constructor
   */
  public function __construct($RED = null) {
    parent::__construct($RED);
    $profile = $this->session->GetAuthenticatedUser();
    $this->profile = is_null($profile) ? array() : $profile;
    $this['isAuthenticated'] = is_null($profile) ? false : true;
  }

  /**
   * Implementing ArrayAccess for $this->profile
   */
  public function offsetSet($offset, $value) { if (is_null($offset)) { $this->profile[] = $value; } else { $this->profile[$offset] = $value; }}
  public function offsetExists($offset) { return isset($this->profile[$offset]); }
  public function offsetUnset($offset) { unset($this->profile[$offset]); }
  public function offsetGet($offset) { return isset($this->profile[$offset]) ? $this->profile[$offset] : null; }

  /**
   * Implementing interface IHasSQL. Encapsulate all SQL used by this class.
   *
   * @param string $key the string that is the key of the wanted SQL-entry in the array.
   */
  public static function SQL($key=null, $args=null) {
  	  
    $order_order  = isset($args['order-order']) ? $args['order-order'] : 'DESC';
    $order_by     = isset($args['order-by'])    ? $args['order-by'] : 'id'; 
   
    $queries = array(
      'drop table user'         => "DROP TABLE IF EXISTS User;",
      'drop table group'        => "DROP TABLE IF EXISTS Groups;",
      'drop table user2group'   => "DROP TABLE IF EXISTS User2Groups;",
      'create table user'       => "CREATE TABLE IF NOT EXISTS User (id INTEGER PRIMARY KEY, acronym TEXT KEY, name TEXT, email TEXT, algorithm TEXT, salt TEXT, password TEXT, created DATETIME default (datetime('now')), updated DATETIME default NULL);",
      'create table group'      => "CREATE TABLE IF NOT EXISTS Groups (id INTEGER PRIMARY KEY, acronym TEXT KEY, name TEXT, created DATETIME default (datetime('now')), updated DATETIME default NULL, postRights INT, pageRights INT);",
      'create table user2group' => "CREATE TABLE IF NOT EXISTS User2Groups (idUser INTEGER, idGroups INTEGER, created DATETIME default (datetime('now')), PRIMARY KEY(idUser, idGroups));",
      'insert into user'        => 'INSERT INTO User (acronym,name,email,algorithm,salt,password) VALUES (?,?,?,?,?,?);',
      'insert into group'       => 'INSERT INTO Groups (acronym,name, postRights, pageRights) VALUES (?,?,1,1);',
      'insert into user2group'  => 'INSERT INTO User2Groups (idUser,idGroups) VALUES (?,?);',
      'check user password'     => 'SELECT * FROM User WHERE (acronym=? OR email=?);',
      'get group memberships'   => 'SELECT * FROM Groups AS g INNER JOIN User2Groups AS ug ON g.id=ug.idGroups WHERE ug.idUser=?;',
      'update profile'          => "UPDATE User SET name=?, email=?, updated=datetime('now') WHERE id=?;",
      'update password'         => "UPDATE User SET algorithm=?, salt=?, password=?, updated=datetime('now') WHERE id=?;",
      'select all users'        => 'SELECT * FROM User',
      'select all groups'       => 'SELECT * FROM Groups',
      'select all memberships'  => 'SELECT * FROM User2Groups',
     );
    if(!isset($queries[$key])) {
      throw new Exception("No such SQL query, key '$key' was not found.");
    }
    return $queries[$key];
  }

     /**
   * Create password.
   *
   * $param $plain string the password plain text to use as base.
   * $param $salt boolean should  we use salt or not when creating the password? default is true.
   * @returns array with 'salt' and 'password'.
   */
   public function CreatePassword($plain, $algorithm=null) {
    $password = array(
      'algorithm'=>($algorithm ? $algoritm : CRed::Instance()->config['hashing_algorithm']),
      'salt'=>null
    );
    switch($password['algorithm']) {
      case 'sha1salt': $password['salt'] = sha1(microtime()); $password['password'] = sha1($password['salt'].$plain); break;
      case 'md5salt': $password['salt'] = md5(microtime()); $password['password'] = md5($password['salt'].$plain); break;
      case 'sha1': $password['password'] = sha1($plain); break;
      case 'md5': $password['password'] = md5($plain); break;
      case 'plain': $password['password'] = $plain; break;
      default: throw new Exception('Unknown hashing algorithm');
    }
    return $password;
  }
  
    /**
   * Check if password matches.
   *
   * @param $plain string the password plain text to use as base.
   * @param $salt string the user salted string to use to hash the password.
   * @param $password string the hashed user password that should match.
   * @returns boolean true if match, else false.
   */
  public function CheckPassword($plain, $algorithm, $salt, $password) {
    switch($algorithm) {
      case 'sha1salt': return $password === sha1($salt.$plain); break;
      case 'md5salt': return $password === md5($salt.$plain); break;
      case 'sha1': return $password === sha1($plain); break;
      case 'md5': return $password === md5($plain); break;
      case 'plain': return $password === $plain; break;
      default: throw new Exception('Unknown hashing algorithm');
    }
  }

   /**
   * Init the database and create appropriate tables.
   */
  public function Init() {
    try {
      $this->db->ExecuteQuery(self::SQL('drop table user2group'));
      $this->db->ExecuteQuery(self::SQL('drop table group'));
      $this->db->ExecuteQuery(self::SQL('drop table user'));
      $this->db->ExecuteQuery(self::SQL('create table user'));
      $this->db->ExecuteQuery(self::SQL('create table group'));
      $this->db->ExecuteQuery(self::SQL('create table user2group'));
       $password = $this->CreatePassword('root');
      $this->db->ExecuteQuery(self::SQL('insert into user'), array('root', 'The Administrator', 'root@dbwebb.se', $password['algorithm'], $password['salt'], $password['password']));
      $idRootUser = $this->db->LastInsertId();
      $password = $this->CreatePassword('doe');
      $this->db->ExecuteQuery(self::SQL('insert into user'), array('doe', 'John/Jane Doe', 'doe@dbwebb.se', $password['algorithm'], $password['salt'], $password['password']));
      $idDoeUser = $this->db->LastInsertId();
      $this->db->ExecuteQuery(self::SQL('insert into group'), array('admin', 'The Administrator Group'));
      $idAdminGroup = $this->db->LastInsertId();
      $this->db->ExecuteQuery(self::SQL('insert into group'), array('user', 'The User Group'));
      $idUserGroup = $this->db->LastInsertId();
      $this->db->ExecuteQuery(self::SQL('insert into user2group'), array($idRootUser, $idAdminGroup));
      $this->db->ExecuteQuery(self::SQL('insert into user2group'), array($idRootUser, $idUserGroup));
      $this->db->ExecuteQuery(self::SQL('insert into user2group'), array($idDoeUser, $idUserGroup));
      $this->session->AddMessage('notice', 'Successfully created the database tables and created a default admin user as root:root and an ordinary user as doe:doe.');
    } catch(Exception$e) {
      die("$e<br/>Failed to open database: " . $this->config['database'][0]['dsn']);
    }
  }
  
 

  /**
   * Login by autenticate the user and password. Store user information in session if success.
   *
   * @param string $acronymOrEmail the emailadress or user akronym.
   * @param string $password the password that should match the akronym or emailadress.
   * @returns booelan true if match else false.
   */
  public function Login($akronymOrEmail, $password) 
  {
    $user = $this->db->ExecuteSelectQueryAndFetchAll(self::SQL('check user password'), array($akronymOrEmail, $akronymOrEmail));
    $user = (isset($user[0])) ? $user[0] : null;
    if(!$user) {
    	    $this->session->AddMessage('notice', "Could not login, user does not exists or password did not match.");
      return false;
    } else if(!$this->CheckPassword($password, $user['algorithm'], $user['salt'], $user['password'])) {
      $this->session->AddMessage('notice', "Could not login, user does not exists or password did not match.");
    	    return false;
    }
    unset($user['algorithm']);
    unset($user['salt']);
    unset($user['password']);
    if($user) 
    {
    	    $user['isAuthenticated'] = true;
	    $user['groups'] = $this->db->ExecuteSelectQueryAndFetchAll(self::SQL('get group memberships'), array($user['id']));
	    foreach($user['groups'] as $val) 
	    {
		    if($val['id'] == 1) 
		    {
			    $user['hasRoleAdmin'] = true;
		    }
		    if($val['id'] == 2) 
		    {
			    $user['hasRoleUser'] = true;
		    }
	    }
	    $this->profile = $user;
	    $this->session->SetAuthenticatedUser($this->profile);
	      
	    $this->session->AddMessage('success', "Welcome '{$user['name']}'.");
	    
    }
    
    return ($user != null);
  }

  /**
   * Logout.
   */
  public function Logout() {
    $this->session->UnsetAuthenticatedUser();
    $this->session->AddMessage('success', "You have logged out.");
  }
  

  /**
   * Does the session contain an authenticated user?
   *
   * @returns boolen true or false.
   */
  public function IsAuthenticated() {
    return ($this->session->GetAuthenticatedUser() != false);
  }
  
  
  /**
   * Get profile information on user.
   *
   * @returns array with user profile or null if anonymous user.
   */
  public function GetUserProfile() {
    return $this->session->GetAuthenticatedUser();
  }
  
    /**
   * Get the user acronym.
   *
   * @returns string with user acronym or null
   */
  public function GetAcronym() {
    $profile = $this->GetUserProfile();
    return isset($profile['acronym']) ? $profile['acronym'] : "NO ACRONYM FOUND";
  }
  
    /**
   * Does the user have the admin role?
   *
   * @returns boolen true or false.
   */
  public function IsAdministrator() {
    $profile = $this->GetUserProfile();
    return isset($profile['hasRoleAdmin']) ? $profile['hasRoleAdmin'] : null;
  }
  
  /**
   * Save user profile to database and update user profile in session.
   *
   * @returns boolean true if success else false.
   */
  public function Save() {
  	  
    $this->db->ExecuteQuery(self::SQL('update profile'), array($this['name'], $this['email'], $this['id']));
    $this->session->SetAuthenticatedUser($this->profile);
    return $this->db->RowCount() === 1;
  }
  
  
  /**
   * Change user password.
   *
   * @param $password string the new password
   * @returns boolean true if success else false.
   */
  public function ChangePassword($password) {
    $this->db->ExecuteQuery(self::SQL('update password'), array($password, $this['id']));
    return $this->db->RowCount() === 1;
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
  public function Create($acronym, $password, $name, $email) {
    $pwd = $this->CreatePassword($password);
    
    $this->db->ExecuteQuery(self::SQL('insert into user'), array($acronym, $name, $email, $pwd['algorithm'], $pwd['salt'], $pwd['password']));
    if($this->db->RowCount() == 0) {
      $this->session->AddMessage('error', "Failed to create user.");
      return false;
    }
    return true;
  }
  
    /**
   * Implementing interface IModule. Manage install/update/deinstall and equal actions.
   *
   * @param string $action what to do.
   */
  public function Manage($action=null) {
    switch($action) {
      case 'install': 
        try {
          $this->db->ExecuteQuery(self::SQL('drop table user2group'));
          $this->db->ExecuteQuery(self::SQL('drop table group'));
          $this->db->ExecuteQuery(self::SQL('drop table user'));
          $this->db->ExecuteQuery(self::SQL('create table user'));
          $this->db->ExecuteQuery(self::SQL('create table group'));
          $this->db->ExecuteQuery(self::SQL('create table user2group'));
          $this->db->ExecuteQuery(self::SQL('insert into user'), array('anonomous', 'Anonomous, not authenticated', null, 'plain', null, null));
          $password = $this->CreatePassword('root');
          $this->db->ExecuteQuery(self::SQL('insert into user'), array('root', 'The Administrator', 'root@dbwebb.se', $password['algorithm'], $password['salt'], $password['password']));
          $idRootUser = $this->db->LastInsertId();
          $password = $this->CreatePassword('doe');
          $this->db->ExecuteQuery(self::SQL('insert into user'), array('doe', 'John/Jane Doe', 'doe@dbwebb.se', $password['algorithm'], $password['salt'], $password['password']));
          $idDoeUser = $this->db->LastInsertId();
          $this->db->ExecuteQuery(self::SQL('insert into group'), array('admin', 'The Administrator Group'));
          $idAdminGroup = $this->db->LastInsertId();
          $this->db->ExecuteQuery(self::SQL('insert into group'), array('user', 'The User Group'));
          $idUserGroup = $this->db->LastInsertId();
          $this->db->ExecuteQuery(self::SQL('insert into user2group'), array($idRootUser, $idAdminGroup));
          $this->db->ExecuteQuery(self::SQL('insert into user2group'), array($idRootUser, $idUserGroup));
          $this->db->ExecuteQuery(self::SQL('insert into user2group'), array($idDoeUser, $idUserGroup));
          return array('success', 'Successfully created the database tables and created a default admin user as root:root and an ordinary user as doe:doe.');
        } catch(Exception$e) {
          die("$e<br/>Failed to open database: " . $this->config['database'][0]['dsn']);
        }   
      break;
      
      default:
        throw new Exception('Unsupported action for this module.');
      break;
    }
  }
  
   /**
   * List all users
   *
   * @returns array with listing or null if empty.
   */
  
 public function ListAllUsers($args=null) 
 {    
    try 
    {
           return $this->db->ExecuteSelectQueryAndFetchAll(self::SQL('select all users', $args));
    }
    catch(Exception $e) 
    {
      echo $e;
      return null;
    }
 }
 
 public function ListAllGroups($args=null) 
 {    
    try 
    {
           return $this->db->ExecuteSelectQueryAndFetchAll(self::SQL('select all groups', $args));
    }
    catch(Exception $e) 
    {
      echo $e;
      return null;
    }
 }
 
 public function ListAllMemberships($args=null) 
 {    
    try 
    {
           return $this->db->ExecuteSelectQueryAndFetchAll(self::SQL('select all memberships', $args));
    }
    catch(Exception $e) 
    {
      echo $e;
      return null;
    }
 }
 
 
 public function CheckGroupPostRights($controller=null) 
 {
 	 $check = 0;
 	 
 	 $profile = $this->GetUserProfile();
 	 
 	 if(isset($profile))
 	 {
		 foreach($profile['groups'] as $group)
		 {
			if($group['postRights'] == 1)
			{
				$check = 1;
			}
		 }
		 
		 if($check == 1)
		 {
			 return TRUE;	 
		 }
		 
		 else
		 {
		 	 if(isset($controller))
		 	 {
		 	 $this->session->AddMessage('error', "You do not have permissions to see the requested content. You are either not logged in or lack the proper rights. Contact the site admin if you want to petition for the rights.");
			 $this->redirectTo($controller);		 
		 	 }
		 	 else
		 	 {
			 $this->session->AddMessage('error', "You do not have permissions to see the requested content. You are either not logged in or lack the proper rights. Contact the site admin if you want to petition for the rights.");
			 $this->redirectToController();	
			 }
		 }
	 }
	 else
	 {
	 	 if(isset($controller))
		 {
		 	 $this->session->AddMessage('error', "You do not have permissions to see the requested content. You are either not logged in or lack the proper rights. Contact the site admin if you want to petition for the rights.");
			 $this->redirectTo($controller);		 
		 }
		 else
		 {
		 	$this->session->AddMessage('error', "You do not have permissions to see the requested content. You are either not logged in or lack the proper rights. Contact the site admin if you want to petition for the rights.");
		 	$this->redirectToController(); 
		 }
	 }
 	 
 }
 
 public function CheckGroupPageRights($controller=null) 
 {
 	 $check = 0;
 	 
 	 $profile = $this->GetUserProfile();
 	 
 	 if(isset($profile))
 	 {
		 foreach($profile['groups'] as $group)
		 {
			if($group['pageRights'] == 1)
			{
				$check = 1;
			}
		 }
		 
		 if($check == 1)
		 {
			 return TRUE;	 
		 }
		 
		 else
		 {
		 	 if(isset($controller))
		 	 {
		 	 $this->session->AddMessage('error', "You do not have permissions to see the requested content. You are either not logged in or lack the proper rights. Contact the site admin if you want to petition for the rights.");
			 $this->redirectTo($controller);		 
		 	 }
		 	 else
		 	 {
			 $this->session->AddMessage('error', "You do not have permissions to see the requested content. You are either not logged in or lack the proper rights. Contact the site admin if you want to petition for the rights.");
			 $this->redirectToController();	
			 }
		 }
	 }
	 else
	 {
	 	 if(isset($controller))
		 {
		 	 $this->session->AddMessage('error', "You do not have permissions to see the requested content. You are either not logged in or lack the proper rights. Contact the site admin if you want to petition for the rights.");
			 $this->redirectTo($controller);		 
		 }
		 else
		 {
		 	$this->session->AddMessage('error', "You do not have permissions to see the requested content. You are either not logged in or lack the proper rights. Contact the site admin if you want to petition for the rights.");
		 	$this->redirectToController(); 
		 }
	 }
 	 
 }
 
  
}
