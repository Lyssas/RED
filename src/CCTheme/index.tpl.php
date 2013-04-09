<div class = "temp">
<h1>Theme</h1>
<p>This is a helper to aid in theme developing and testing.<p>
<p>Current theme is: <?php echo $theme_name?></p>

<p>Here is a list of helping methods for theme developing and testing.</p>
<ul>
<?php foreach($methods as $val): ?>
  <li><a href='<?php echo create_url($val)?>'><?php echo $val?></a>
<?php endforeach; ?>
</ul>
</div>
