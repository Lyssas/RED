<!doctype html>
<html lang="sv"> 
<head>
  <meta charset="utf-8">
  <title><?php echo $title?></title>
  <link rel="stylesheet" href="<?php echo $stylesheet?>">
</head>
<body>
<div id='login-menu'>	
        	<?php echo login_menu()?>
      </div>
  <div id="header">
  	
    <?php echo $header?>
  </div>
  
  <div id='wrap-main'>
    <div id='main' role='main'>
      
      <?php echo get_messages_from_session()?>
      <?php echo @$main?>
      <?php echo render_views()?>
      <?php echo get_debug()?>
    </div>
  </div>
  
  
 
  <div id="footer">
    <?php echo $footer?>
  </div>
</body>
</html>


  
