<?php if($this->session->flashdata('error')) { ?>
<div class="alert alert-danger">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
  </button>
  <span class="pficon pficon-error-circle-o"></span>
  <?php echo $this->session->flashdata('error'); ?>
</div>
<?php } if($this->session->flashdata('warning')) { ?>
<div class="alert alert-warning">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
  </button>
  <span class="pficon pficon-warning-triangle-o"></span>
  <?php echo $this->session->flashdata('warning'); ?>
</div>
<?php } if($this->session->flashdata('success')) { ?>
<div class="alert alert-success">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
  </button>
  <span class="pficon pficon-ok"></span>
  <?php echo $this->session->flashdata('success'); ?>
</div>
<?php } if ($this->session->flashdata('info')){ ?>
<div class="alert alert-info">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
  </button>
  <span class="pficon pficon-info"></span>
  <?php echo $this->session->flashdata('info'); ?>
</div>
<?php } ?>
