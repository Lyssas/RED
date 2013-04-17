<?php $RED = CRed::Instance();?>
<?php if( $RED->user->isAuthenticated()): ?>

<h1>User Profile</h1>
<p>You can view and update your profile information.</p>


  <?php echo $profile_form ?>
  <p>You were created at <?php echo $user['created']?> and last updated at <?php echo $user['updated']?>.</p>
  <p>You are member of <?php echo count($user['groups'])?> group(s).</p>
  <ul>
  
  <?php foreach($user['groups'] as $group): ?>
    <li> <?php echo $group['name'] ?>
  <?php endforeach; ?>
  </ul>
<?php endif; ?>



