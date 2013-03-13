<?php
/**
* Standard controller layout.
* 
* @package RedCore
*/
class CCIndex implements IController {

   /**
    * Implementing interface IController. All controllers must have an index action.
    */
   public function Index() {   
      global $ly;
      $ly->data['title'] = "The Index Controller";
      $ly->data['main'] = "";
   }

}
