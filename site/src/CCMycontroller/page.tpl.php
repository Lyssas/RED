<?php if($content['id']):?>
  <h1><?php echo esc($content['title'])?></h1>
  <p><?php echo $content->GetFilteredData()?></p>
  
<?php else:?>
  <p>404: No such page exists.</p>
<?php endif;?>