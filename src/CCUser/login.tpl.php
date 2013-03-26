<div class = 'temp'>
<h1>Login</h1>
<p>Login using your acronym or email.</p>
<?php echo $login_form->GetHTML('form')?>
  <fieldset>
    <?php echo $login_form['acronym']->GetHTML()?>
    <?php echo $login_form['password']->GetHTML()?>  
    <?php echo $login_form['login']->GetHTML()?>
    <?php if($allow_create_user) : ?>
      <p class='form-action-link'><a href='<?php echo $create_user_url?>' title='Create a new user account'>Create user</a></p>
    <?php endif; ?>
  </fieldset>
</form>

</div>
