<?php
/**
* A form for creating a new user.
* 
* @package RedCore
*/
class CFormComment extends CForm {

  /**
   * Constructor
   */
  public function __construct($object, $postId) {
    parent::__construct();
  //  die($postId);
    $this->AddElement(new CFormElementText('author', array('required'=>true)))
         ->AddElement(new CFormElementTextarea('content', array('required'=>true)))
         ->AddElement(new CFormElementHidden('postId', array('value'=>$postId)))
         ->AddElement(new CFormElementSubmit('create', array('callback'=>array($object, 'DoCreateComment'))));
         
    $this->SetValidation('author', array('not_empty'))
         ->SetValidation('content', array('not_empty'));
         
  }
  
}