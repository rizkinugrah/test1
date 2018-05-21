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
      <div class="card-pf-heading">
        <h2 class="card-pf-title">
          Report Information
        </h2>
      </div>
      <div class="card-pf-body">
        <dl class="dl-horizontal">
          <dt>User</dt>
          <dd><?php echo $reports->email; ?></dd>

          <dt>Type</dt>
          <dd><?php echo $reports->type; ?></dd>

          <dt>Value</dt>
          <dd>Rp. <?php echo humanizeNumber($reports->value); ?></dd>

          <dt>Description</dt>
          <dd><?php echo $reports->description; ?></dd>

          <dt>Document Status</dt>
          <?php
          // 'submitted','verified','need next approval','revised','approved','rejected'
          $status = $reports->status;
          $labelType = '';
          if($status == 'submitted'){
            $labelType = 'info';
          } else if($status == 'verified'){
            $labelType = 'info';
          } else if($status == 'need next approval'){
            $labelType = 'primary';
          } else if($status == 'revised'){
            $labelType = 'warning';
          } else if($status == 'approved'){
            $labelType = 'success';
          } else if($status == 'rejected'){
            $labelType = 'rejected';
          } else {
            $status = 'Not submit yet';
            $labelType = 'default';
          }
          ?>
          <dd><?php echo '<span class="label label-'.$labelType.'">'.ucfirst($status).'</span>'; ?></dd>

          <dt>Activity Date</dt>
          <dd><?php echo indonesianDate($reports->activityTimestamp); ?></dd>

          <dt>Report Create Date</dt>
          <dd><?php echo indonesianDateTime($reports->createdTimestamp); ?></dd>
        </dl>
      </div>

      <?php if($status == 'submitted'){ ?>
      <div class="card-pf-footer" style="">
        <a href="<?php echo base_url('reportverification/markAsVerified/'.$reports->id); ?>" class="btn btn-success" type="button">
          <i class="fa fa-check"></i> Mark as Verified
        </a>
        &nbsp;
        <a href="<?php echo base_url('reportverification/markAsRevised/'.$reports->id); ?>" class="btn btn-warning" type="button">
          <i class="fa fa-pencil"></i> Mark as Revised
        </a>
      </div>
      <?php } ?>

    </div>
  </div>
</div>

<!--  VERIFICATOR AND REPORT ITEM -->
<div class="row row-cards-pf">
  <!-- START OF REPORT ITEM -->
  <div class="col-sm-12 col-md-6">
    <div class="card-pf">
      <div class="card-pf-body">
        <div class="card-pf-heading">
          <h2 class="card-pf-title">
            Report Items
            <small>(<?php echo sizeof($reportItems); ?>)</small>
          </h2>
        </div>
        <?php if (sizeof($reportItems) > 0){ ?>
          <div class="">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Description</th>
                  <th class="text-right">Value</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; $total = 0; foreach ($reportItems as $data) { ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $data->description; ?></td>
                    <td class="text-right"><?php echo humanizeNumber($data->value); ?></td>
                  </tr>
                <?php $i++; $total = $total + $data->value; } ?>
              </tbody>
              <tfoot>
                <tr>
                  <th></th>
                  <th></th>
                  <th class="text-right">Total: <?php echo humanizeNumber($total); ?></th>
                  <?php if($reports->status == null || $reports->status == 'revised'){ ?> <th></th> <?php } ?>
                </tr>
              </tfoot>
            </table>


          </div>
        <?php } else { ?>
          <div class="blank-slate-pf">
            <div class="blank-slate-pf-icon">
              <span class="pficon pficon pficon-add-circle-o"></span>
            </div>
            <h1>No Report Items</h1>
          </div>
        <?php } ?>

      </div>
    </div>
  </div>
  <!-- END OF REPORT ITEM -->

  <!-- START OF VERIFICATOR -->
  <div class="col-sm-12 col-md-6">
    <div class="card-pf">
      <div class="card-pf-body">
        <div class="card-pf-heading">
          <h2 class="card-pf-title">
            User Approval
            <small>(<?php echo sizeof($documentApprover); ?>)</small>
          </h2>
        </div>
        <?php if (sizeof($documentApprover) > 0){ ?>
          <div class="">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Verificator</th>
                  <th>Sequence</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; $total = 0; foreach ($documentApprover as $data) { ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $data->userId; ?></td>
                    <td ><?php echo humanizeNumber($data->sequence); ?></td>
                    <td ><?php echo $data->status; ?></td>
                  </tr>
                <?php $i++; } ?>
              </tbody>
            </table>


          </div>
        <?php } else { ?>
          <div class="blank-slate-pf">
            <div class="blank-slate-pf-icon">
              <span class="pficon pficon pficon-add-circle-o"></span>
            </div>
            <h1>No User Approval</h1>
          </div>
        <?php } ?>

      </div>
    </div>
  </div>
  <!-- END OF VERIFICATOR -->

</div>
