<?php
ob_start();
session_start();
require_once('../../includes/bootstrap.php');	
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SAHAYA - THE GIRL ADOPTION</title>
	<link href="<?php echo BASEPLUGINS;?>css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo BASEPLUGINS;?>css/font-awesome.min.css" rel="stylesheet">
	<link href="<?php echo BASEPLUGINS;?>css/datepicker3.css" rel="stylesheet">
	<link href="<?php echo BASEPLUGINS;?>plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet">
	<link href="<?php echo BASEPLUGINS;?>css/styles.css" rel="stylesheet">
	<link href="<?php echo BASEPLUGINS;?>css/loader.css" rel="stylesheet">

	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<link rel="shortcut icon" href="<?php echo BASEPLUGINS;?>images/logo.png" />
	<!--[if lt IE 9]>
	<script src="<?php echo BASEPLUGINS;?>js/html5shiv.js"></script>
	<script src="<?php echo BASEPLUGINS;?>js/respond.min.js"></script>
	<![endif]-->
</head>

<body>

<div class="loader-wrapper">
	<div class="loader">
    <div class="roller"></div>
    <div class="roller"></div>
  </div>
  
  <div id="loader2" class="loader">
    <div class="roller"></div>
    <div class="roller"></div>
  </div>
  
  <div id="loader3" class="loader">
    <div class="roller"></div>
    <div class="roller"></div>
  </div>
</div>