<div class="row justify-content-center" style="margin-top:45px;">
	<h3 class="text-center"><?= $SITE_TITLE ?></h3>
	<div class="col-md-3">
		<form action="adminlogin" method="post">
			<div class="mb-3 mt-4">
				<?php if(session()->getFlashData("invalid")): ?>
				<div class="alert alert-danger" role="alert">
				  <?php echo session()->getFlashData("invalid"); ?> Please try again...
				</div>
				<?php endif; ?>
			</div>
			<div class="mb-3">
				<label class="form-label" for="uname">User Name</label>
				<input type="text" class="form-control" name="uname" placeholder="Enter User Name" value="<?= set_value("uname"); ?>"></input>
				<span class="text-danger"><?= isset($validation)?display_error("uname"):''; ?></span>
			</div>
			<div class="mb-3">
				<label class="form-label" for="upass">Password</label>
				<input type="password" placeholder="Enter Password" class="form-control" name="upass" value="<?= set_value("upass"); ?>"></input>
				<span class="text-danger"><?= isset($validation)?display_error("upass"):''; ?></span>
			</div>
			<button type="submit" class="btn btn-primary">Login</button>
		</form>
	</div>
</div>