<?php $RED = CRed::Instance();?>
<h1>Content Controller Index</h1>
<p>One controller to manage the actions for content, mainly list, create, edit, delete, view.</p>

<h2>All content</h2>

<?php if($contents != null):?>
  <ul>
  <?php foreach($contents as $val):?>
    <li><?php echo $val['id']?>, <?php echo $val['title']?> by <?php echo $val['idUser']?> 
    
    <?php if($RED->user->IsAdministrator()):?> 
    
    	    <a href='<?php echo create_url("content/edit/{$val['id']}")?>'>edit</a>
    	    <?php endif; ?>
    	    <a href='<?php echo create_url("page/view/{$val['id']}")?>'>view</a>
  <?php endforeach; ?>
  </ul>
<?php else:?>
  <p>No content exists.</p>
<?php endif;?>

<h2>Actions</h2>
<ul>
  <?php if($RED->user->IsAdministrator()): ?> 
  <li><a href='<?php echo create_url('content/manage')?>'>Init database, create tables and sample content</a>
  <li><a href='<?php echo create_url('content/create')?>'>Create new content</a>
  <?php endif; ?>
  <li><a href='<?php echo create_url('blog')?>'>View as blog</a>
</ul>

