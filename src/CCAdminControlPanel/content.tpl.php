
<h1>Admin Control Panel Index</h1>
<p><a href='<?php echo create_url("acp")?>'>Back to ACP</a></p>

<h2>Manage Posts</h2>

<?php if($posts != null):?>
  <?php foreach($posts as $val):?>
    <h5><?php echo esc($val['title'])?></h5>
    
    <p class='smaller-text'><em>Posted on <?php echo $val['created']?> by <?php echo $val['idUser']?></em></p>
    
    <p class='smaller-text silent'><a href='<?php echo create_url("content/edit/{$val['id']}")?>'>edit</a>  <a href='<?php echo create_url("acp/deletecontent/{$val['id']}")?>'>delete</a></p>
   
  <h3><br />Comments:</h3>
    	<?php foreach($comments as $com):?>
		<?php if($com['postId'] == $val['id']):?>		  
	  		<div class = 'comment'>
			  	<p>
			  		<?php echo 'By: ' . $com['author']; ?>
			  	</p>
			  	<p>
			  		<?php echo $com['content']; ?>
			  	</p>
			  	<p>
			  		<?php echo $com['created']; ?>
			  	</p>
			  	<p class='smaller-text silent'><a href='<?php echo create_url("acp/DeleteCommentContent/{$com['id']}")?>'>delete</a></p>
			</div>
		<?php endif; ?>
	  <?php endforeach; ?>
	   <hr />
    
    <?php endforeach; ?>
<?php else:?>
  <p>No posts exists.</p>
<?php endif;?>

<h2>Manage Pages<h2>

<?php if($pages != null):?>
  <?php foreach($pages as $val):?>
    <h5><?php echo esc($val['title'])?></h5>
    
    <p class='smaller-text'><em>Posted on <?php echo $val['created']?> by <?php echo $val['idUser']?></em></p>
    
    <p class='smaller-text silent'><a href='<?php echo create_url("content/edit/{$val['id']}")?>'>edit</a>  <a href='<?php echo create_url("acp/deletecontent/{$val['id']}")?>'>delete</a></p>
  <hr />
    <?php endforeach; ?>
<?php else:?>
  <p>No pages exists.</p>
<?php endif;?>
