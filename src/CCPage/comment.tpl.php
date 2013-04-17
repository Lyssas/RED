
<h1>Write a comment</h1>

<?php echo $form ?>

<?php if($content['id']):?>
  <h1><?php echo $content['title']?></h1>
  <p><?php echo $content->getFilteredData()?></p>
  <?php endif; ?>
