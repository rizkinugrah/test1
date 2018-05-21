<div class="nav-pf-vertical nav-pf-vertical-with-sub-menus nav-pf-vertical-collapsible-menus">
  <ul class="list-group">

    <?php if (in_array("module_navigation_dashboard", $arrUserPermissions)){ ?>
    <li class="list-group-item <?php if($activePages == "Dashboard"){ echo "active"; } ?>">
      <a href="<?php echo base_url(); ?>">
        <span class="fa fa-dashboard" data-toggle="tooltip" title="Dashboard"></span>
        <span class="list-group-item-value"><small>Dashboard</small></span>
      </a>
    </li>
    <?php } ?>

    <?php if (in_array("module_navigation_report", $arrUserPermissions)){ ?>
    <li class="list-group-item <?php if($activePages == "Report"){ echo "active"; } ?>">
      <a href="<?php echo base_url('report'); ?>">
        <span class="fa fa-book" data-toggle="tooltip" title="Report"></span>
        <span class="list-group-item-value"><small>Report</small></span>
      </a>
    </li>
    <?php } ?>

    <?php if (in_array("module_navigation_reportverification", $arrUserPermissions)){ ?>
    <li class="list-group-item <?php if($activePages == "Report Verification"){ echo "active"; } ?>">
      <a href="<?php echo base_url('reportVerification'); ?>">
        <span class="fa fa-file" data-toggle="tooltip" title="Report Verification"></span>
        <span class="list-group-item-value"><small>Report Verification</small></span>
      </a>
    </li>
    <?php } ?>

    <?php if (in_array("module_navigation_reportapproval", $arrUserPermissions)){ ?>
    <li class="list-group-item <?php if($activePages == "Report Approval"){ echo "active"; } ?>">
      <a href="<?php echo base_url('reportApproval'); ?>">
        <span class="fa fa-check" data-toggle="tooltip" title="Report Approval"></span>
        <span class="list-group-item-value"><small>Report Approval</small></span>
      </a>
    </li>
    <?php } ?>

    <?php if (in_array("module_navigation_usermanagement", $arrUserPermissions)){ ?>
    <li class="list-group-item <?php if($activePages == "User Management"){ echo "active"; } ?>">
      <a href="<?php echo base_url('userManagement'); ?>">
        <span class="fa fa-users" data-toggle="tooltip" title="User Management"></span>
        <span class="list-group-item-value"><small>User Management</small></span>
      </a>
    </li>
    <?php } ?>

    <li class="list-group-item secondary-nav-item-pf mobile-nav-item-pf visible-xs-block">
      <a href="#0">
        <span class="pficon pficon-user" data-toggle="tooltip" title="User" data-original-title="User"></span>
        <span class="list-group-item-value">User</span>
      </a>
      <div id="user-secondary" class="nav-pf-secondary-nav">
        <div class="nav-item-pf-header">
          <a href="#0" class="secondary-collapse-toggle-pf" data-toggle="collapse-secondary-nav"></a>
          <span><?php echo $this->session->userdata("email"); ?></span>
        </div>
        <ul class="list-group">
          <li class="list-group-item">
            <a href="<?php echo base_url().'account/logout'; ?>">
              <span class="list-group-item-value">Logout</span>
            </a>
          </li>
        </ul>
      </div>
    </li>

  </ul>
</div>

<div class="container-fluid container-cards-pf container-pf-nav-pf-vertical">
