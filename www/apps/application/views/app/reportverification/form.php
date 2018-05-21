<div class="row row-cards-pf title-header">
  <div class="col-sm-12">
    <div class="page-header">
      <h1><?php echo $title; ?></h1>
    </div>
  </div>
</div>

<div class="row row-cards-pf">

  <div class="col-sm-12">
    <div class="card-pf">
      <?php if (isset($formTitle)) { ?>
        <div class="card-pf-heading">
          <h2 class="card-pf-title">
            <?php echo $formTitle; ?>
          </h2>
        </div>
      <?php } ?>

      <div class="card-pf-body">
        <?php echo form_open('', array( 'id' => 'form', 'class' => 'form-horizontal' ));?>

          <?php echo $formsView; ?>

        <?php echo form_close(); ?>
      </div>
    </div>
  </div>

</div>
