<h1>Admin Control Panel Index</h1>
<p><a href='<?php echo create_url("acp")?>'>Back to ACP</a></p>

<h2>Manage Users</h2>

<?php if($users != null):?>
  	<?php foreach($users as $val):?>
  		<h4><?php echo esc($val['acronym'])?></h4>
       
  		<p>Id: <?php echo esc($val['id'])?> <br /> Name: <?php echo esc($val['name'])?> <br /> Email: <?php echo esc($val['email'])?>   <p>
  		
  		<h5>Delete user</h5>
  		<p class='smaller-text silent'> <a href='<?php echo create_url("acp/deleteuser/{$val['id']}")?>'>Delete user</a>  </p>
      
  		<h5>Currently member of the following groups:</h5>
  		
  		<?php foreach($groups as $group):?>
  			<?php foreach($memberships as $memb):?>
  			
  	  				<?php if($val['id'] == $memb['idUser'] AND $group['id'] == $memb['idGroups']): ?>
  				
  						<?php echo $group['name'] . '<br />' ?>
  						<p class='smaller-text silent'><a href='<?php echo create_url("acp/removefromgroup/{$val['id']}/{$group['id']}")?>'>Revoke membership </a></p>
  				
  					<?php endif;?>
  			<?php endforeach; ?>
  		<?php endforeach; ?>
  		
  		<h5>Currently NOT a member of the following groups:</h5>
  		
  		<?php foreach($groups as $group):?>
  			<?php $counter = 0; ?>
  			<?php foreach($memberships as $memb):?>
  			
  	  				<?php if($val['id'] == $memb['idUser'] AND $group['id'] == $memb['idGroups']): ?>
  				
  						<?php $counter = 1; ?>
  				
  					<?php endif;?>
  					
  			<?php endforeach; ?>
  			<?php if($counter == 0): ?>
  				
  				<?php echo $group['name'] . '<br />' ?>
  				<p class='smaller-text silent'><a href='<?php echo create_url("acp/addtogroup/{$val['id']}/{$group['id']}")?>'>Give membership </a></p>
  				
  			<?php endif;?>
  		<?php endforeach; ?>
  		
  		
  			
    
   
    
  		<hr />
  	<?php endforeach; ?>
<?php else:?>
  <p>No posts exists.</p>
<?php endif;?>

