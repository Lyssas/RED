<?php $RED = CRed::Instance();?>
<h1>My Blog</h1>
<p>All my blogposts.</p>

<?php if($contents != null):?>
  <?php foreach($contents as $val):?>
    <h2><?php echo esc($val['title'])?></h2>
    <p class='smaller-text'><em>Posted on <?php echo $val['created']?> by <?php echo $val['idUser']?></em></p>
    <p><?=filter_data($val['data'], $val['filter'])?></p>
<p class='smaller-text silent'><?php if($RED->user->IsAdministrator()):?><a href='<?php echo create_url("content/edit/{$val['id']}")?>'>edit</a><?php endif; ?></p>
     <p class='smaller-text silent'><a href='<?php echo create_url("page/view/{$val['id']}")?>'>Read and write comments</a></p>
  <?php endforeach; ?>
<?php else:?>
  <p>No posts exists.</p>
<?php endif;?>