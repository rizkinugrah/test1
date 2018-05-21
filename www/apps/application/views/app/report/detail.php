<?php if(isset($documentRevised) && $reports->status == 'revised'){ ?>
  <div class="alert alert-warning">
    <span class="pficon pficon-warning-triangle-o"></span>
    <?php echo $documentRevised->description; ?>
  </div>
<?php } ?>

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

          <?php if($reports->status == null || $reports->status == 'revised'){ ?>
          <a href="<?php echo base_url('report/edit/'.$reports->id); ?>" class="pull-right btn btn-warning" type="button"><i class="pf pficon-edit"></i> Edit</a>
          <?php } ?>
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


      <?php if($reports->status == null || $reports->status == 'revised'){ ?>
      <div class="card-pf-footer" style="">
        <a href="<?php echo base_url('report/submitDocumentReport/'.$reports->id); ?>" class="btn btn-success" type="button">
          <i class="fa fa-check"></i> Submit
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
            <?php if($reports->status == null || $reports->status == 'revised'){ ?>
            <div class="pull-right">
              <a href="<?php echo base_url('report/addItem/'.$reports->id); ?>" class="btn btn-primary" type="button">
                <i class="glyphicon glyphicon-plus"></i> Add Report Items
              </a>
            </div>
          <?php } ?>

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
                  <?php if($reports->status == null || $reports->status == 'revised'){ ?> <th>Action</th> <?php } ?>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; $total = 0; foreach ($reportItems as $data) { ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $data->description; ?></td>
                    <td class="text-right"><?php echo humanizeNumber($data->value); ?></td>
                    <?php if($reports->status == null || $reports->status == 'revised'){ ?>
                      <td>
                        <a href="<?php echo base_url('report/editItem/'.$reports->id.'/'.$data->id); ?>" class="btn btn-warning" type="button"><i class="fa pficon-edit"></i> Edit</a>
                        <a href="<?php echo base_url('report/deleteItem/'.$reports->id.'/'.$data->id); ?>" class="btn btn-danger" type="button"><i class="fa fa-remove"></i> Delete</a>
                      </td>
                    <?php } ?>
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
            <?php if($reports->status == null || $reports->status == 'revised'){ ?>
            <div class="pull-right">
              <a href="<?php echo base_url('report/addApprover/'.$reports->id); ?>" class="btn btn-primary" type="button">
                <i class="glyphicon glyphicon-plus"></i> Add User Approval
              </a>
            </div>
          <?php } ?>

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
                  <?php if($reports->status == null || $reports->status == 'revised'){ ?> <th>Action</th> <?php } ?>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; $total = 0; foreach ($documentApprover as $data) { ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $data->email; ?></td>
                    <td ><?php echo humanizeNumber($data->sequence); ?></td>
                    <td ><?php echo $data->status; ?></td>
                    <?php if($reports->status == null || $reports->status == 'revised'){ ?>
                      <td>
                        <a href="<?php echo base_url('report/editApprover/'.$reports->id.'/'.$data->id); ?>" class="btn btn-warning" type="button"><i class="fa pficon-edit"></i> Edit</a>
                        <a href="<?php echo base_url('report/deleteApprover/'.$reports->id.'/'.$data->id); ?>" class="btn btn-danger" type="button"><i class="fa fa-remove"></i> Delete</a>
                      </td>
                    <?php } ?>
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


<div class="row row-cards-pf">
  <div class="col-sm-12">
    <div class="card-pf">
      <div class="card-pf-heading">
        <h2 class="card-pf-title">
          Document History Tracking
        </h2>
      </div>
      <div class="card-pf-body">
        <div class="list-pf">
          <?php
            foreach ($documentStatus as $data) {
            ?>
              <div class="list-pf-item <?php echo $data->status == 'approved' ? 'list-group-item-success' : ''; ?>">
                <div class="list-pf-container">
                  <div class="list-pf-content list-pf-content-flex">
                    <div class="list-pf-left">

                      <?php
                        if ($data->status == 'submitted'){
                          echo '<span class="pficon pficon-info list-pf-icon-small"></span>';
                        } else if ($data->status == 'revised'){
                          echo '<span class="pficon pficon-warning-triangle-o list-pf-icon-small"></span>';
                        } else if ($data->status == 'verified'){
                          echo '<span class="fa fa-check list-pf-icon-small"></span>';
                        } else if ($data->status == 'approved'){
                          echo '<span class="pficon pficon-ok list-pf-icon-small"></span>';
                        }
                      ?>

                      <!-- <span class="pficon pficon-error-circle-o list-pf-icon-small"></span> -->

                    </div>
                    <div class="list-pf-content-wrapper">
                      <div class="list-pf-main-content ">
                        <div class="list-pf-title">
                          <?php echo ucfirst($data->status); ?>
                          <br/>
                          <small><?php echo $data->email; ?></small>
                          <h6><?php echo indonesianDateTime($data->approvalTimestamp); ?></h6>
                        </div>
                        <div class="list-pf-description text-overflow-pf">
                          <?php echo $data->description; ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            <?php
            }
          ?>
        </div>
      </div>
    </div>
  </div>
</div>
