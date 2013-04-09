<div class='box'>
<h4>All modules</h4>
<p>All Lydia modules.</p>
<ul>
<?php foreach($modules as $module): ?>
  <li><?php echo $module['name']?></li>
<?php endforeach; ?>
</ul>
</div>


<div class='box'>
<h4>Lydia core</h4>
<p>Lydia core modules.</p>
<ul>
<?php foreach($modules as $module): ?>
  <?php if($module['isRedCore']): ?>
  <li><?php echo $module['name']?></li>
  <?php endif; ?>
<?php endforeach; ?>
</ul>
</div>


<div class='box'>
<h4>Lydia CMF</h4>
<p>Lydia Content Management Framework (CMF) modules.</p>
<ul>
<?php foreach($modules as $module): ?>
  <?php if($module['isRedCMF']): ?>
  <li><?php echo $module['name']?></li>
  <?php endif; ?>
<?php endforeach; ?>
</ul>
</div>


<div class='box'>
<h4>Models</h4>
<p>A class is considered a model if its name starts with CM.</p>
<ul>
<?php foreach($modules as $module): ?>
  <?php if($module['isModel']): ?>
  <li><?php echo $module['name']?></li>
  <?php endif; ?>
<?php endforeach; ?>
</ul>
</div>


<div class='box'>
<h4>Controllers</h4>
<p>Implements interface <code>IController</code>.</p>
<ul>
<?php foreach($modules as $module): ?>
  <?php if($module['isController']): ?>
  <li><?php echo $module['name']?></li>
  <?php endif; ?>
<?php endforeach; ?>
</ul>
</div>


<div class='box'>
<h4>Contains SQL</h4>
<p>Implements interface <code>IHasSQL</code>.</p>
<ul>
<?php foreach($modules as $module): ?>
  <?php if($module['hasSQL']): ?>
  <li><?php echo $module['name']?></li>
  <?php endif; ?>
<?php endforeach; ?>
</ul>
</div>


<div class='box'>
<h4>More modules</h4>
<p>Modules that does not implement any specific RED interface.</p>
<ul>
<?php foreach($modules as $module): ?>
  <?php if(!($module['isController'] || $module['isRedCore'] || $module['isRedCMF'])): ?>
  <li><?php echo $module['name']?></li>
  <?php endif; ?>
<?php endforeach; ?>
</ul>
</div>
