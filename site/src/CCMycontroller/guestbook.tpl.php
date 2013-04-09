<h1>My Guestbook</h1>
<p>Write something in my guestbook!</p>

<?php echo $form->GetHTML()?>

<h2>Latest messages</h2>

<?php foreach($entries as $val):?>
<div style='background-color:#f6f6f6;border:1px solid #ccc;margin-bottom:1em;padding:1em;'>
  
  
  <p><?php echo htmlent($val['entry'])?></p>
  <p>By: <?php echo $val['user']?></p>
  <p>At: <?php echo $val['created']?></p>
</div>
<?php endforeach;?>