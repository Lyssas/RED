<h1>Admin Control Panel Index</h1>
<p><a href='<?php echo create_url("acp")?>'>Back to ACP</a></p>
<p><a href='<?php echo create_url("acp/createGroup")?>'>Create group</a></p>

<h2>Manage Groups</h2>

 <p>If the content type is set to "1" the group is allowed to access the content type. <br /> If the content type is set to "0" the group is not allowed to access the content type.</p>

<?php if($groups != null):?>
  <?php foreach($groups as $val):?>
    <h4><?php echo esc($val['name'])?></h4>
    <p class='smaller-text silent'><a href='<?php echo create_url("acp/deletegroup/{$val['id']}")?>'>Delete group</a></p>
    
    <h6>Group reader rights:</h6>
    
  
    
    <?php 
    	if($val['postRights'] == 1)
    	{
    		echo 'Posts = ALLOWED ';
    		?>
    		<p class='smaller-text silent'><a href='<?php echo create_url("acp/changegrouppostrights/{$val['id']}/0")?>'>Revoke reader rights</a></p>
    		<?php
    	}
    	else
    	{
    		echo 'Posts = DISALLOWED ';
    		?>
    		<p class='smaller-text silent'><a href='<?php echo create_url("acp/changegrouppostrights/{$val['id']}/1")?>'>Give reader rights</a></p>
    		<?php
    	}
    	
    	
    	if($val['pageRights'] == 1)
    	{
    		echo 'Pages = ALLOWED ';
    		?>
    		<p class='smaller-text silent'><a href='<?php echo create_url("acp/changegrouppagerights/{$val['id']}/0")?>'>Revoke reader rights</a></p>
    		<?php
    	}
    	else
    	{
    		echo 'Pages = DISALLOWED ';
    		?>
    		<p class='smaller-text silent'><a href='<?php echo create_url("acp/changegrouppagerights/{$val['id']}/1")?>'>Give reader rights</a></p>
    		<?php
    	}
    
    ?>
    
   
    
   
    
  
    <hr />
  <?php endforeach; ?>
  
  
  
  
<?php else:?>
  <p>No posts exists.</p>
<?php endif;?>

