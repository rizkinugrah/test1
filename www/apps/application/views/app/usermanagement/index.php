<div class="row row-cards-pf title-header">
  <div class="col-sm-12">

    <div class="pull-right h1">
      <a href="<?php echo base_url('usermanagement/group/'); ?>" class="btn btn-lg btn-success" type="button">
        <i class="fa fa-users"></i> Group Management
      </a>
      <a href="<?php echo base_url('usermanagement/add/'); ?>" class="btn btn-lg btn-primary" type="button">
        <i class="glyphicon glyphicon-plus"></i> Add User
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
              <th>Email</th>
              <th>Group</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 1;
            foreach ($users as $data) {
            ?>
              <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $data->username; ?></td>
                <td><?php echo $data->email; ?></td>
                <td><?php echo ucwords(str_replace("_"," ",$data->groupName)); ?></td>
                <td>
                  <a href="#" class="btn btn-warning" type="button"><i class="fa pficon-edit"></i> Edit</a>
                </td>
              </tr>
            <?php
            $i++; }
            ?>
          </tbody>
      </table>
     </div>
   </div>
 </div>
</div>
