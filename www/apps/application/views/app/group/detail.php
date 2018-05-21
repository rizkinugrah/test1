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
          Group Information
        </h2>
      </div>
      <div class="card-pf-body">
        <dl class="dl-horizontal">
          <dt>Name</dt>
          <dd><?php echo ucwords(str_replace("_"," ",$groups->name)); ?></dd>
        </dl>
      </div>
    </div>
  </div>
</div>

<!--  VERIFICATOR AND REPORT ITEM -->
<div class="row row-cards-pf">
  <!-- START OF REPORT ITEM -->
  <div class="col-sm-12 col-md-12">
    <div class="card-pf">
      <div class="card-pf-body">
        <div class="card-pf-heading">
          <h2 class="card-pf-title">
            <div class="pull-right">
              <a href="<?php echo base_url('usermanagement/addPermissions/'.$groups->id); ?>" class="btn btn-primary" type="button">
                <i class="glyphicon glyphicon-plus"></i> Add Permissions
              </a>
            </div>

            Group Permissions
            <small>(<?php echo sizeof($grouppermissions); ?>)</small>

          </h2>
        </div>
        <?php if (sizeof($grouppermissions) > 0){ ?>
          <div class="">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; foreach ($grouppermissions as $data) { ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $data->name; ?></td>
                    <td><?php echo $data->description; ?></td>
                    <td>
                      <a href="<?php echo base_url('usermanagement/removePermissions/'.$data->groupPermissionsId); ?>" class="btn btn-danger" type="button"><i class="fa fa-remove"></i> Remove</a>
                    </td>
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
            <h1>No Permissions</h1>
          </div>
        <?php } ?>

      </div>
    </div>
  </div>
  <!-- END OF REPORT ITEM -->
</div>
