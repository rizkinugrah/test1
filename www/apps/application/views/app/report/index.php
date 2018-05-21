<div class="row row-cards-pf title-header">
  <div class="col-sm-12">

    <div class="pull-right h1">
      <a href="<?php echo base_url('report/add/'); ?>" class="btn btn-lg btn-primary" type="button">
        <i class="glyphicon glyphicon-plus"></i> Add Report
      </a>
    </div>

    <div class="page-header">
      <h1><?php echo $title; ?></h1>
    </div>

  </div>
</div>

<!--  MAIN CONTAINER -->
<div class="row row-cards-pf">
 <div class="col-sm-12">
   <div class="card-pf">
     <div class="card-pf-body">
       <table class="table table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>User</th>
              <th>Type</th>
              <th class="text-right">Value</th>
              <th>Description</th>
              <th>Status</th>
              <th width="250px">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 1;
              foreach($reports as $data) {
                $status = $data->status;
                $labelType = '';
                if($status == 'submitted'){
                  $labelType = 'info';
                } else if($status == 'verified'){
                  $labelType = 'info';
                } else if($status == 'need next approval'){
                  $labelType = 'info';
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
              <tr class="<?php echo $labelType; ?>">
                <td><?php echo $i; ?></td>
                <td><?php echo $data->email; ?></td>
                <td><?php echo $data->type; ?></td>
                <td class="text-right"><?php echo humanizeNumber($data->value); ?></td>
                <td><?php echo $data->description; ?></td>
                <td><?php echo '<h5><span class="label label-'.$labelType.'">'.ucfirst($status).'</span></h5>'; ?></td>
                <td>
                  <a href="<?php echo base_url('report/detail/'.$data->id); ?>" class="btn btn-success" type="button"><i class="fa fa-check"></i> Detail</a>

                  <a href="<?php echo $data->status === NULL ? base_url('report/delete/'.$data->id) : '#'; ?>" <?php echo $data->status !== NULL ? 'disabled' : ''; ?> class="btn btn-danger"type="button"><i class="fa fa-remove"></i> Delete</a>
                </td>
              </tr>
          <?php
            $i++;
            }
          ?>
          </tbody>
      </table>
     </div>
   </div>
 </div>
</div>
