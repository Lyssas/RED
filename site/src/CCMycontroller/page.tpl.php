<?php if($content['id']):?>
  <h1><?php echo esc($content['title'])?></h1>
  <p><?php echo $content->GetFilteredData()?></p>
  <p class='smaller-text silent'><a href='<?php echo create_url("content/edit/{$content['id']}")?>'>edit</a> <a href='<?php echo create_url("content")?>'>view all</a></p>
<?php else:?>
  <p>404: No such page exists.</p>
<?php endif;?>