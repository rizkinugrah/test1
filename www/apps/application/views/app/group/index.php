<div class="row row-cards-pf title-header">
  <div class="col-sm-12">

    <div class="pull-right h1">
      <a href="<?php echo base_url('usermanagement/addGroup/'); ?>" class="btn btn-lg btn-primary" type="button">
        <i class="glyphicon glyphicon-plus"></i> Add Group
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
              <th>Group Name</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 1;
            foreach ($groups as $data) {
            ?>
              <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo ucwords(str_replace("_"," ",$data->name)); ?></td>
                <td>
                  <a href="<?php echo base_url('usermanagement/detailGroup/'.$data->id); ?>" class="btn btn-success" type="button"><i class="fa fa-check"></i> Detail</a>
                  <a href="<?php echo base_url('usermanagement/editGroup/'.$data->id); ?>" class="btn btn-warning" type="button"><i class="fa pficon-edit"></i> Edit</a>
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
