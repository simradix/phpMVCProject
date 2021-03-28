<div style="height: 100%;" class="container-fluid d-flex flex-column align-items-center justify-content-center">

<h1 style="margin: 24px 0;">Register</h1>
<?php $form = \app\core\form\Form::begin('', 'post'); ?>

<div class="row">
  <div class="col">
    <?php echo $form->field($model, 'firstname'); ?>
  </div>
  <div class="col">
    <?php echo $form->field($model, 'lastname'); ?>
  </div>
</div>

<?php echo $form->field($model, 'email'); ?>
<?php echo $form->field($model, 'password')->passwordField(); ?>
<?php echo $form->field($model, 'passwordConfirm')->passwordField(); ?>

<button type="submit" class="btn btn-primary mt-3">Submit</button>
<?php \app\core\form\Form::end(); ?>

</div>