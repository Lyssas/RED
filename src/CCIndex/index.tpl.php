<div class = "temp">
<h1>Index Controller</h1>
<p>This is what you can do for now.</p>

<?php foreach($menu as $val): ?>
<li><a href='<?php echo create_url($val)?>'><?php echo $val?></a>  
<?php endforeach; ?>   
</div>
