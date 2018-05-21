<div class="row row-cards-pf title-header">
  <div class="col-sm-12">

    <div class="page-header">
      <h1><?php echo $title; ?></h1>
    </div>

  </div>
</div>

<!-- START OF WIDGET -->
<div class="row row-cards-pf">

  <div class="col-sm-6 col-md-3 col-xs-12">
    <div class="card-pf card-pf-accented card-pf-aggregate-status" style="height: 89px;">
      <a href="<?php echo base_url('report'); ?>">
        <h2 class="card-pf-title" style="height: 17px;">
          <span class="fa fa-book"></span><span class="card-pf-aggregate-status-count"></span> All Reports
        </h2>
        <div class="card-pf-body" style="height: 50px;">
          <p class="card-pf-aggregate-status-notifications">
            <?php echo sizeof($reports); ?>
          </p>
        </div>
      </a>
    </div>
  </div>

  <div class="col-sm-6 col-md-3 col-xs-12">
    <div class="card-pf card-pf-accented card-pf-aggregate-status" style="height: 89px;">
      <h2 class="card-pf-title" style="height: 17px;">
        <span class="fa fa-book"></span><span class="card-pf-aggregate-status-count"></span> Unfixed Report
      </h2>
      <div class="card-pf-body" style="height: 50px;">
        <p class="card-pf-aggregate-status-notifications">
          <?php echo sizeof($unfixedReport); ?>
        </p>
      </div>
    </div>
  </div>

  <div class="col-sm-6 col-md-3 col-xs-12">
    <div class="card-pf card-pf-accented card-pf-aggregate-status" style="height: 89px;">
      <h2 class="card-pf-title" style="height: 17px;">
        <span class="fa fa-book"></span><span class="card-pf-aggregate-status-count"></span> Unverified Report
      </h2>
      <div class="card-pf-body" style="height: 50px;">
        <p class="card-pf-aggregate-status-notifications">
          <?php echo sizeof($unverifiedReport); ?>
        </p>
      </div>
    </div>
  </div>

  <div class="col-sm-6 col-md-3 col-xs-12">
    <div class="card-pf card-pf-accented card-pf-aggregate-status" style="height: 89px;">
      <h2 class="card-pf-title" style="height: 17px;">
        <span class="fa fa-book"></span><span class="card-pf-aggregate-status-count"></span> Unapproved Report
      </h2>
      <div class="card-pf-body" style="height: 50px;">
        <p class="card-pf-aggregate-status-notifications">
          <?php echo sizeof($unapprovedReport); ?>
        </p>
      </div>
    </div>
  </div>

</div>
<!-- END OF WIDGET -->

<!--  MAIN CONTAINER -->
<div class="row row-cards-pf">

  <div class="col-sm-12 col-md-4">
    <div class="card-pf">
      <div class="card-pf-body">
        <div class="card-pf-heading">
          <h2 class="card-pf-title">
            Unfixing Report
            <small>(<?php echo sizeof($unfixedReport); ?>)</small>
          </h2>
        </div>

        <?php if(sizeof($unfixedReport) > 0){ ?>
        <div class="">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>User</th>
                <th>Type</th>
                <th>Value</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $i = 1;
              foreach ($unfixedReport as $data) {
              ?>
                <tr class='clickable-row' data-href="<?php echo base_url('report/detail/'.$data->id); ?>">
                  <td><?php echo $i; ?></td>
                  <td><?php echo $data->email; ?></td>
                  <td><?php echo $data->type; ?></td>
                  <td><?php echo humanizeNumber($data->value); ?></td>
                  <td><?php echo $data->description; ?></td>
                </tr>
              <?php
              $i++;
              }
              ?>

            </tbody>
          </table>
        </div>
        <?php } else { ?>
        <div class="blank-slate-pf">
          <h1>No Unfixed Report</h1>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>

  <div class="col-sm-12 col-md-4">
    <div class="card-pf">
      <div class="card-pf-body">
        <div class="card-pf-heading">
          <h2 class="card-pf-title">
            Unverified Report
            <small>(<?php echo sizeof($unverifiedReport); ?>)</small>
          </h2>
        </div>

        <?php if(sizeof($unverifiedReport) > 0){ ?>
        <div class="">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>User</th>
                <th>Type</th>
                <th>Value</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $i = 1;
              foreach ($unverifiedReport as $data) {
              ?>
                <tr class='clickable-row' data-href="<?php echo base_url('report/detail/'.$data->id); ?>">
                  <td><?php echo $i; ?></td>
                  <td><?php echo $data->email; ?></td>
                  <td><?php echo $data->type; ?></td>
                  <td><?php echo humanizeNumber($data->value); ?></td>
                  <td><?php echo $data->description; ?></td>
                </tr>
              <?php
              $i++;
              }
              ?>

            </tbody>
          </table>
        </div>
        <?php } else { ?>
        <div class="blank-slate-pf">
          <h1>No Unverified Report</h1>
        </div>
        <?php } ?>



      </div>
    </div>
  </div>

  <div class="col-sm-12 col-md-4">
    <div class="card-pf">
      <div class="card-pf-body">
        <div class="card-pf-heading">
          <h2 class="card-pf-title">
            Unapproved Report
            <small>(<?php echo sizeof($unapprovedReport); ?>)</small>
          </h2>
        </div>

        <?php if(sizeof($unapprovedReport) > 0){ ?>
        <div class="">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>User</th>
                <th>Type</th>
                <th>Value</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $i = 1;
              foreach ($unapprovedReport as $data) {
              ?>
                <tr class='clickable-row' data-href="<?php echo base_url('report/detail/'.$data->id); ?>">
                  <td><?php echo $i; ?></td>
                  <td><?php echo $data->email; ?></td>
                  <td><?php echo $data->type; ?></td>
                  <td><?php echo humanizeNumber($data->value); ?></td>
                  <td><?php echo $data->description; ?></td>
                </tr>
              <?php
              $i++;
              }
              ?>

            </tbody>
          </table>
        </div>
        <?php } else { ?>
        <div class="blank-slate-pf">
          <h1>No Unapproved Report</h1>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
