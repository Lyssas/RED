<div class = 'temp'>

<?php if($content['created']): ?>
  <h1>Edit Content</h1>
  <p>You can edit and save this content.</p>
<?php else: ?>
  <h1>Create Content</h1>
  <p>Create new content.</p>
<?php endif; ?>


<?php echo $form->GetHTML(array('class'=>'content-edit'))?>

<p class='smaller-text'><em>
<?php if($content['created']): ?>
  This content were created by <?php echo $content['idUser']?> at <?php echo $content['created']?>.
<?php else: ?>
  Content not yet created.
<?php endif; ?>

<?php if(isset($content['updated'])):?>
  Last updated at <?php echo $content['updated']?>.
<?php endif; ?>
</em></p>

<p><a href='<?php echo create_url('content')?>'>View all content</a></p>
</div>
