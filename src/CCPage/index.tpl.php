<?php $RED = CRed::Instance();?>
<?php if($content['id']):?>
  <h1><?php echo $content['title']?></h1>
  <p><?php echo $content->getFilteredData()?></p>
  
  <?php if($content['type'] == 'post'):?>
  <a href='<?php echo create_url("page/createcomment/" . $content['id'])?>'>Write comment</a>
  <h3><br />Comments:</h3>
  
   
	  <?php foreach($comments as $val):?>
		<?php if($val['postId'] == $content['id']):?>		  
	  		 <div class = 'comment'>
	  		 	<p>
	  		 		<?php echo 'By: ' . $val['author']; ?>
	  		 	</p>
	  		 	<p>
	  		 		<?php echo $val['content']; ?>
	  		 	</p>
	  		 	<p>
	  		 		<?php echo $val['created']; ?>
	  		 	</p>
	  		 </div>
		<?php endif; ?>
	  <?php endforeach; ?>
	 
  <?php endif; ?>
  
  <p class='smaller-text silent'><br /><?php if($RED->user->IsAdministrator()):?><a href='<?php echo create_url("content/edit/{$content['id']}")?>'>edit</a> <?php endif; ?><a href='<?php echo create_url("content")?>'>view all</a></p>
<?php else:?>
  <p>404: No such page exists.</p>
<?php endif;?>

