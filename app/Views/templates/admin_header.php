<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?= $SITE_TITLE; ?></title>
	<link rel="stylesheet" type="text/css" href="<?= base_url('bootstrap/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('style.css'); ?>">
	<script type="text/javascript" src="<?= base_url('jquery-3.6.0.min.js'); ?>"></script>
</head>
<body>
	<?php if(!$isLoginPage){ ?>
	<div class="mb-2">
		<h3 class="fo-header">Food Ordering System
			<span class="lead fo-welcome-user">Welcome! <?= session()->get("USERNAME"); ?> 
				<a class="btn btn-secondary" href="adminpage">Logout</a>
			</span>
		</h3>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="mb-3 col-sm-12 col-md-3 col-lg-2" style="padding: 0px !important;">
				<div class="list-group">
					<p class="text-center lead">
					    Navigation Menu
					 </p>
				  <a href="<?= base_url('getEmployees'); ?>" class="list-group-item list-group-item-action <?= $ACTIVE_MENU=='EMPLOYEES'?'active':'' ?>">
				    Employees
				  </a>
				  <a href="<?= base_url('getCategories'); ?>" class="list-group-item list-group-item-action <?= $ACTIVE_MENU=='CATEGORIES'?'active':'' ?>">
				  	Categories
				  </a>
				  <a href="#" class="list-group-item list-group-item-action <?= $ACTIVE_MENU=='PRODUCTS'?'active':'' ?>">
				  	Products
				  </a>
				  <a href="#" class="list-group-item list-group-item-action <?= $ACTIVE_MENU=='ORDERS'?'active':'' ?>">
				  	Orders
				  </a>
				  <a href="#" class="list-group-item list-group-item-action <?= $ACTIVE_MENU=='CUSTOMERS'?'active':'' ?>">
				  	Customers
				  </a>
				  <a href="#" class="list-group-item list-group-item-action <?= $ACTIVE_MENU=='COUPONS'?'Active':'' ?>">
				  	Coupons
				  </a>
				</div>
			</div>
			<div class="col-md-9 col-lg-10" style="background-color: #e6e6e6 !important;padding:0px 0px 10px 0px !important;">
				

	<?php } ?>