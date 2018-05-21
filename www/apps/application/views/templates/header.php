<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html class="layout-pf layout-pf-fixed">
<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex">
  <meta name="googlebot" content="noindex">
  <link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?php echo assetsUrl().'img/apple-touch-icon-precomposed-152.png'; ?>">
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo assetsUrl().'img/apple-touch-icon-precomposed-144.png'; ?>">
  <link rel="apple-touch-icon-precomposed" sizes="76x76" href="<?php echo assetsUrl().'img/apple-touch-icon-precomposed-76.png'; ?>">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo assetsUrl().'img/apple-touch-icon-precomposed-72.png'; ?>">
  <link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?php echo assetsUrl().'img/apple-touch-icon-precomposed-180.png'; ?>">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo assetsUrl().'img/apple-touch-icon-precomposed-114.png'; ?>">
  <link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?php echo assetsUrl().'img/apple-touch-icon-precomposed-57.png'; ?>">

  <link rel="stylesheet" href="<?php echo assetsUrl().'css/custom.css'; ?>" >
  <link rel="stylesheet" href="<?php echo assetsUrl().'css/patternfly.min.css'; ?>" >
  <link rel="stylesheet" href="<?php echo assetsUrl().'css/patternfly-additions.min.css'; ?>" >
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" >

  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.2/jquery.matchHeight-min.js"></script>
  <script src="<?php echo assetsUrl().'js/patternfly.min.js'; ?>"></script>
  <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

</head>

<body class="cards-pf">

  <nav class="navbar navbar-pf-vertical">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="/" class="navbar-brand">
        PROJECT DOCUMENT
        <!-- <img class="navbar-brand-icon" src="<?php echo assetsUrl().'img/logo-alt.svg'; ?>" alt=""/> -->
        <!-- <img class="navbar-brand-name" src="<?php echo assetsUrl().'img/brand-alt.svg'; ?>" alt="PatternFly Enterprise Application" /> -->
      </a>

    </div>
    <nav class="collapse navbar-collapse">
      <ul class="nav navbar-nav navbar-right navbar-iconic navbar-utility">
        <li class="dropdown">
          <a href="#0" class="dropdown-toggle nav-item-iconic" id="dropdownMenu28" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <span title="Username" class="fa pficon-user"></span>
            <?php echo $this->session->userdata("email"); ?> <span class="caret"></span>
          </a>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenu28">
            <li><a href="<?php echo base_url().'account/logout'; ?>">Logout</a></li>
          </ul>
        </li>
      </ul>
    </nav>

  </nav> <!--/.navbar-->
