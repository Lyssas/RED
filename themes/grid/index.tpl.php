<!doctype html>
<html lang='en'> 
<head>
  <meta charset='utf-8'/>
  <title><?php echo $title?></title>
  <link rel='shortcut icon' href='<?php echo theme_url($favicon)?>'/>
  <link rel='stylesheet' href='<?php echo $stylesheet?>'/>
  <?php if(isset($inline_style)): ?><style><?php echo $inline_style?></style><?php endif; ?>
</head>
<body>

<div id='outer-wrap-header'>
  <div id='inner-wrap-header'>
    <div id='header'>
      <div id='login-menu'><?php echo login_menu()?></div>
      <div id='banner'>
        <a href='<?php echo base_url()?>'><img id='site-logo' src='<?php echo theme_url($logo)?>' alt='logo' width='<?php echo $logo_width?>' height='<?php echo $logo_height?>' /></a>
        <span id='site-title'><a href='<?php echo base_url()?>'><?php echo $header?></a></span>
        <span id='site-slogan'><?php echo $slogan?></span>
      </div>
    </div>
  </div>
</div>

<?php if(region_has_content('flash')): ?>
<div id='outer-wrap-flash'>
  <div id='inner-wrap-flash'>
    <div id='flash'><?php echo render_views('flash')?></div>
  </div>
</div>
<?php endif; ?>

<?php if(region_has_content('featured-first', 'featured-middle', 'featured-last')): ?>
<div id='outer-wrap-featured'>
  <div id='inner-wrap-featured'>
    <div id='featured-first'><?php echo render_views('featured-first')?></div>
    <div id='featured-middle'><?php echo render_views('featured-middle')?></div>
    <div id='featured-last'><?php echo render_views('featured-last')?></div>
  </div>
</div>
<?php endif; ?>

<?php if(region_has_content('primary', 'sidebar')): ?>
<div id='outer-wrap-main'>
  <div id='inner-wrap-main'>
    <div id='primary'><?php echo render_views('primary')?></div>
    <div id='sidebar'><?php echo render_views('sidebar')?></div>
  </div>
</div>
<?php endif; ?>

<?php if(region_has_content('triptych-first', 'triptych-middle', 'triptych-last')): ?>
<div id='outer-wrap-triptych'>
  <div id='inner-wrap-triptych'>
    <div id='triptych-first'><?php echo render_views('triptych-first')?></div>
    <div id='triptych-middle'><?php echo render_views('triptych-middle')?></div>
    <div id='triptych-last'><?php echo render_views('triptych-last')?></div>
  </div>
</div>
<?php endif; ?>

<div id='outer-wrap-footer'>
  <?php if(region_has_content('footer-column-one', 'footer-column-two', 'footer-column-three', 'footer-column-four')): ?>
  <div id='inner-wrap-footer-column'>
    <div id='footer-column-one'><?php echo render_views('footer-column-one')?></div>
    <div id='footer-column-two'><?php echo render_views('footer-column-two')?></div>
    <div id='footer-column-three'><?php echo render_views('footer-column-three')?></div>
    <div id='footer-column-four'><?php echo render_views('footer-column-four')?></div>
  </div>
  <?php endif; ?>
  <div id='inner-wrap-footer'>
    <div id='footer'>
    <?php echo render_views('footer')?>
    <?php echo $footer?>
    <?php echo get_debug()?></div>
  </div>
</div>

</body>
</html>
