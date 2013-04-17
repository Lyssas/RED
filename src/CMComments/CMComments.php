<?php
/**
* A model for content stored in database.
* 
* @package RedCore
*/
class CMContent extends CObject implements IHasSQL, ArrayAccess {

  /**
   * Properties
   */
  public $data;


  /**
   * Constructor
   */
  public function __construct($id=null) {
    parent::__construct();
    if($id) {
      $this->LoadById($id);
    } else {
      $this->data = array();
    }
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
      'drop table content'      => "DROP TABLE IF EXISTS Content;",
      'delete content'      	=> "DELETE FROM Content WHERE id=?;",
      'create table content'    => "CREATE TABLE IF NOT EXISTS Content (id INTEGER PRIMARY KEY, key TEXT KEY, type TEXT, title TEXT, data TEXT, filter TEXT, idUser TEXT, created DATETIME default (datetime('now')), updated DATETIME default NULL, deleted DATETIME default NULL, FOREIGN KEY(idUser) REFERENCES User(id));",
      'insert content'          => 'INSERT INTO Content (key,type,title,data, filter, idUser) VALUES (?,?,?,?,?,?);',
      'update content'          => "UPDATE Content SET key=?, type=?, title=?, data=?, filter=?, updated=datetime('now') WHERE id=?;",
      'select * single'         => "SELECT * FROM Content WHERE id=? ORDER BY $order_by $order_order",
      'select * type'         	=> "SELECT * FROM Content WHERE type=? ORDER BY $order_by $order_order",
      'select all'              => 'SELECT * FROM Content',
      
     );
    if(!isset($queries[$key])) {
      throw new Exception("No such SQL query, key '$key' was not found.");
    }
    return $queries[$key];
  }

  
    /**
   * Implementing interface IModule. Manage install/update/deinstall and equal actions.
   */
  public function Manage($action=null) {
    switch($action) {
      case 'install': 
        try {
            $this->db->ExecuteQuery(self::SQL('drop table content'));
      $this->db->ExecuteQuery(self::SQL('create table content'));
      $this->db->ExecuteQuery(self::SQL('insert content'), array('about-me', 'page', 'About me', 'This is a demo post where information about the user can be presented.', 'plain', 'Automatically generated'));
      $this->db->ExecuteQuery(self::SQL('insert content'), array('home', 'page', 'Home', 'This is a demo page, this is the first page on your own site built with the framework. It will be visible to all visitors.', 'plain', 'Automatically generated'));
      $this->db->ExecuteQuery(self::SQL('insert content'), array('hello-world2', 'post', 'Hello World Again', 'This is a another demo post.', 'plain', 'Automatically generated'));
      $this->db->ExecuteQuery(self::SQL('insert content'), array('hello-world3', 'post', 'Bla Bla Hello World Yet Again', 'This is yet another demo post.', 'plain', 'Automatically generated'));
      $this->db->ExecuteQuery(self::SQL('insert content'), array('hello-world BB-Code', 'post', 'Hello World BB-code', '[b]This[/b] is [i]BB-Code[/i].', 'bbcode', 'Automatically generated'));
      $this->db->ExecuteQuery(self::SQL('insert content'), array('hello-world HTMLPurify', 'post', 'Hello World HTMLPurify', 'This is a demo page with some HTML code intended to run through <a href="http://htmlpurifier.org/">HTMLPurify</a>. Edit the source and insert HTML code and see if it works. <b>Text in bold</b> and <i>text in italic</i> and <a href="http://dbwebb.se">a link to dbwebb.se</a>. JavaScript, like this: <javascript>alert("hej");</javascript> should however be removed.', 'htmlpurify', 'Automatically generated'));
      $this->db->ExecuteQuery(self::SQL('insert content'), array('home', 'page', 'Home page', 'This is a demo page, this could be your personal home-page.', 'plain', 'Automatically generated'));
      $this->db->ExecuteQuery(self::SQL('insert content'), array('about', 'page', 'About page', 'This is a demo page, this could be your personal home-page.', 'plain', 'Automatically generated'));
      $this->db->ExecuteQuery(self::SQL('insert content'), array('download', 'page', 'Download page', 'This is a demo page, this could be your personal home-page.', 'plain', 'Automatically generated'));
          return array('success', 'Successfully created the database tables and created a default "Hello World" blog post, owned by you.');
        } catch(Exception$e) {
          die("$e<br/>Failed to open database: " . $this->config['database'][0]['dsn']);
        }
      break;
      
      default:
        throw new Exception('Unsupported action for this module.');
      break;
    }
  }

 /*
  public function Init() {
    try {
      $this->db->ExecuteQuery(self::SQL('drop table content'));
      $this->db->ExecuteQuery(self::SQL('create table content'));
      $this->db->ExecuteQuery(self::SQL('insert content'), array('hello-world', 'post', 'Hello World', 'This is a demo post.', 'plain', 'Automatically generated'));
      $this->db->ExecuteQuery(self::SQL('insert content'), array('hello-world2', 'post', 'Hello World Again', 'This is a another demo post.', 'plain', 'Automatically generated'));
      $this->db->ExecuteQuery(self::SQL('insert content'), array('hello-world3', 'post', 'Bla Bla Hello World Yet Again', 'This is yet another demo post.', 'plain', 'Automatically generated'));
      $this->db->ExecuteQuery(self::SQL('insert content'), array('hello-world BB-Code', 'post', 'Hello World BB-code', '[b]This[/b] is [i]BB-Code[/i].', 'bbcode', 'Automatically generated'));
      $this->db->ExecuteQuery(self::SQL('insert content'), array('hello-world HTMLPurify', 'post', 'Hello World HTMLPurify', 'This is a demo page with some HTML code intended to run through <a href="http://htmlpurifier.org/">HTMLPurify</a>. Edit the source and insert HTML code and see if it works. <b>Text in bold</b> and <i>text in italic</i> and <a href="http://dbwebb.se">a link to dbwebb.se</a>. JavaScript, like this: <javascript>alert("hej");</javascript> should however be removed.', 'htmlpurify', 'Automatically generated'));
      $this->db->ExecuteQuery(self::SQL('insert content'), array('home', 'page', 'Home page', 'This is a demo page, this could be your personal home-page.', 'plain', 'Automatically generated'));
      $this->db->ExecuteQuery(self::SQL('insert content'), array('about', 'page', 'About page', 'This is a demo page, this could be your personal home-page.', 'plain', 'Automatically generated'));
      $this->db->ExecuteQuery(self::SQL('insert content'), array('download', 'page', 'Download page', 'This is a demo page, this could be your personal home-page.', 'plain', 'Automatically generated'));
      $this->session->AddMessage('success', 'Successfully created the database tables and automatically created default content');
    } catch(Exception$e) {
      die("$e<br/>Failed to open database: " . $this->config['database'][0]['dsn']);
    }
  }
  */
  

  /**
   * Save content. If it has a id, use it to update current entry or else insert new entry.
   *
   * @returns boolean true if success else false.
   */
  public function Save() {
    $msg = null;
    if($this['id']) 
    {
    	    
    	    if($this->user['acronym'] != null)
    	    {
    	    	    
    	    	    $this->db->ExecuteQuery(self::SQL('update content'), array($this['key'], $this['type'], $this['title'], $this['data'], $this['filter'], $this['id']));
    	    }
    	    else
    	    {
    	    	 
    	    	    $this->db->ExecuteQuery(self::SQL('update content'), array($this['key'], $this['type'], $this['title'], $this['data'], $this['filter'], $this['id'])); 
    	    	   
    	    }
    	    $msg = 'update';
    } 
    else 
    {
    	        	   
    	    if($this->user['acronym'] != null)
    	    {
    	    	    $this->db->ExecuteQuery(self::SQL('insert content'), array($this['key'], $this['type'], $this['title'], $this['data'], $this['filter'], $this->user['acronym']));    
    	    }
    	    else
    	    {
    	    	    $this->db->ExecuteQuery(self::SQL('insert content'), array($this['key'], $this['type'], $this['title'], $this['data'], $this['filter'], 'Anonymous'));  
    	    }
      
      $this['id'] = $this->db->LastInsertId();
      
      $msg = 'created';
    }
   
    $rowcount = $this->db->RowCount();
   
    if($rowcount) {
  
      $this->session->AddMessage('success', "Successfully {$msg}d content '{$this['key']}'.");
      
    } else {
    	    
      $this->session->AddMessage('error', "HELLO!O Failed to {$msg}d content '{$this['key']}'.");
    }
    return $rowcount === 1;
    
  }
  
  public function Delete($postId) 
  {
  	  
  	  $this->db->ExecuteQuery(self::SQL('delete content'), array($postId));
  	  $this->session->AddMessage('success', "Successfully deleted content with id '{$postId}'.");
  	  
  	  
  }
    

  /**
   * Load content by id.
   *
   * @param id integer the id of the content.
   * @returns boolean true if success else false.
   */
  public function LoadById($id) {
    $res = $this->db->ExecuteSelectQueryAndFetchAll(self::SQL('select * single'), array($id));
    if(empty($res)) {
      $this->session->AddMessage('error', "Failed to load content with id '$id'.");
      return false;
    } else {
      $this->data = $res[0];
    }
    return true;
  }
  
  
  /**
   * List all content.
   *
   * @returns array with listing or null if empty.
   */
  
 public function ListAll($args=null) {    
    try {
      if(isset($args) && isset($args['type'])) {
        return $this->db->ExecuteSelectQueryAndFetchAll(self::SQL('select * type', $args), array($args['type']));
      } else {
        return $this->db->ExecuteSelectQueryAndFetchAll(self::SQL('select all', $args));
      }
    } catch(Exception $e) {
      echo $e;
      return null;
    }
  }
  
  /**
   * Filter content according to a filter.
   *
   * @param $data string of text to filter and format according its filter settings.
   * @returns string with the filtered data.
   */
  public static function Filter($data, $filter) {
    switch($filter) 
    {
      /*case 'php': 
      $data = nl2br(makeClickable(eval('?>'.$data))); break;
      case 'html': 
      $data = nl2br(makeClickable($data)); break;*/
      	case 'htmlpurify': 
      		 $data = nl2br(CHTMLPurifier::Purify($data)); break;
	case 'bbcode': 
      		 $data = nl2br(bbcode2html(htmlEnt($data))); break;
	case 'plain': 
	default: $data = nl2br(CHTMLPurifier::Purify($data)); break;
    }
    return $data;
  }
  
  /**
   * Get the filtered content.
   *
   * @returns string with the filtered data.
   */
  public function GetFilteredData() {
    return $this->Filter($this['data'], $this['filter']);
  }
  
  
}
