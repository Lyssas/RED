<?php if(!is_array($module)): ?>

<p>404. So such module.</p>

<?php else: ?>

<h1>Module: <?php echo $module['name']?></h1>

<h2>Description</h2>

<!-- <p>File: <code><?php echo $module['filename']?></code></p> -->

<p><?php echo nl2br($module['doccomment'])?></p>


<h2>Details</h2>

<table>
<caption>Details of module.</caption>
<thead><tr><th>Characteristics</th><th>Applies to module</th></tr></thead>
<tbody>
  <tr><td>Part of RED Core modules</td><td><?php echo $module['isRedCore']?'Yes':'No'?></td></tr>
  <tr><td>Part of RED CMF modules</td><td><?php echo $module['isRedCMF']?'Yes':'No'?></td></tr>
  <tr><td>Implements interface(s)</td><td><?php echo empty($module['interface'])?'No':implode(', ', $module['interface'])?></td></tr>
  <tr><td>Controller</td><td><?php echo $module['isController']?'Yes':'No'?></td></tr>
  <tr><td>Model</td><td><?php echo $module['isModel']?'Yes':'No'?></td></tr>
  <tr><td>Has SQL</td><td><?php echo $module['hasSQL']?'Yes':'No'?></td></tr>
  <tr><td>Manageable as a module</td><td><?php echo $module['isManageable']?'Yes':'No'?></td></tr>
</tbody>
</table>


<?php if(!empty($module['publicMethods'])): ?>
<h2>Public methods</h2>
<?php foreach($module['methods'] as $method): ?>
<?php if($method['isPublic']): ?>
<h3><?php echo $method['name']?></h3>
<p><?php echo nl2br($method['doccomment'])?></p>
<p>Implemented through lines: <?php echo $method['startline']?> - <?php echo $method['endline']?>.</p>
<?php endif; ?>
<?php endforeach; ?>
<?php endif; ?>


<?php if(!empty($module['protectedMethods'])): ?>
<h2>Protected methods</h2>
<?php foreach($module['methods'] as $method): ?>
<?php if($method['isProtected']): ?>
<h3><?php echo $method['name']?></h3>
<p><?php echo nl2br($method['doccomment'])?></p>
<p>Implemented through lines: <?php echo $method['startline']?> - <?php echo $method['endline']?>.</p>
<?php endif; ?>
<?php endforeach; ?>
<?php endif; ?>


<?php if(!empty($module['privateMethods'])): ?>
<h2>Private methods</h2>
<?php foreach($module['methods'] as $method): ?>
<?php if($method['isPrivate']): ?>
<h3><?php echo $method['name']?></h3>
<p><?php echo nl2br($method['doccomment'])?></p>
<p>Implemented through lines: <php echo $method['startline']?> - <?php echo $method['endline']?>.</p>
<?php endif; ?>
<?php endforeach; ?>
<?php endif; ?>


<?php if(!empty($module['staticMethods'])): ?>
<h2>Static methods</h2>
<?php foreach($module['methods'] as $method): ?>
<?php if($method['isStatic']): ?>
<h3><?php echo $method['name']?></h3>
<p><?php echo nl2br($method['doccomment'])?></p>
<p>Implemented through lines: <?php echo $method['startline']?> - <?php echo $method['endline']?>.</p>
<?php endif; ?>
<?php endforeach; ?>
<?php endif; ?>


<?php endif; ?>
