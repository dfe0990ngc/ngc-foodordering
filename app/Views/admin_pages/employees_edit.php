<p style="padding:0px 5px 0px 5px;" class="lead"><?= $MODULE_TITLE; ?></p>
<hr />
<?php if(!empty(session()->getFlashData("FAILED"))){ ?>
<div class="alert alert-warning" role="alert"><?= session()->getFlashData("FAILED"); ?>
</div>
<?php } ?>
<form action="<?= base_url(); ?>/saveEmployee" method="post" autocomplete="off">
	<div class="row justify-content-center">
		<input type="hidden" name="ID" value="<?= $ID; ?>">
		<div class="col col-sm-6 col-md-4 col-lg-4">
			<div class="mb-1 form-group input-group-sm">
				<label class="text-muted" for="fname">First Name</label>
				<input tabindex="1" type="text" class="form-control" name="fname" value="<?= $fname;?>"></input>
				<small class="text-danger"><?= isset($validation)?display_error($validation,"fname"):'' ?></small>
			</div>
			<div class="mb-1 form-group input-group-sm">
				<label class="text-muted" for="lname">Last Name</label>
				<input tabindex="3" type="text" class="form-control" name="lname" value="<?= $lname;?>"></input>
				<small class="text-danger"><?= isset($validation)?display_error($validation,"lname"):'' ?></small>
			</div>
			<div class="mb-1 form-group input-group-sm">
				<label class="text-muted" for="username">User Name</label>
				<input tabindex="5" type="text" class="form-control" name="username" value="<?= $username;?>" autocomplete="off"></input>
				<small class="text-danger"><?= isset($validation)?display_error($validation,"username"):'' ?></small>
			</div>
		</div>
		<div class="col col-sm-6 col-md-4 col-lg-4">
			<div class="mb-1 form-group input-group-sm">
				<label class="text-muted" for="mname">Middle Name</label>
				<input tabindex="2" type="text" class="form-control" name="mname" value="<?= $mname;?>"></input>
				<small class="text-danger"><?= isset($validation)?display_error($validation,"mname"):'' ?></small>
			</div>
			<div class="mb-1 form-group input-group-sm">
				<label class="text-muted" for="nname">Nick Name</label>
				<input tabindex="4" type="text" class="form-control" name="nname" value="<?= $nname;?>"></input>
				<small class="text-danger"><?= isset($validation)?display_error($validation,"nname"):'' ?></small>
			</div>
			<div class="mb-1 form-group input-group-sm">
				<label class="text-muted" for="password">Password</label>
				<input tabindex="6" type="password" class="form-control" name="password" value="<?= $password;?>" autocomplete="off"></input>
				<small class="text-danger"><?= isset($validation)?display_error($validation,"password"):'' ?></small>
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col col-sm-3 col-md-2 col-lg-2">
				<button tabindex="8" type="submit" style="float: right;" class="mt-2 btn btn-secondary">Submit</button>
				<a tabindex="7" href="<?= base_url(); ?>/getEmployees" type="button" class="mt-2 btn btn-secondary">Cancel</a>
			</div>
		</div>
	</div>
</form>