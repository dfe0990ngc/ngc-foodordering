<p style="padding:0px 5px 0px 5px;" class="lead"><?= $MODULE_TITLE; ?></p>
<hr />
<?php if(!empty(session()->getFlashData("FAILED"))){ ?>
<div class="alert alert-warning" role="alert"><?= session()->getFlashData("FAILED"); ?>
</div>
<?php } ?>
<form action="<?= base_url(); ?>/saveCategory" method="post" autocomplete="off">
	<div class="row justify-content-center">
		<input type="hidden" name="ID" value="0">
		<div class="col col-sm-6 col-md-4 col-lg-4">
			<div class="mb-1 form-group input-group-sm">
				<label class="text-muted" for="name">Category Name</label>
				<input tabindex="1" type="text" class="form-control" name="name" value="<?= set_value("name");?>"></input>
				<small class="text-danger"><?= isset($validation)?display_error($validation,"name"):'' ?></small>
			</div>
			<div class="mb-1 form-group input-group-sm">
				<label class="text-muted" for="description">Description</label>
				<input tabindex="3" type="text" class="form-control" name="description" value="<?= set_value("description");?>"></input>
				<small class="text-danger"><?= isset($validation)?display_error($validation,"description"):'' ?></small>
			</div>
			<div class="mb-1 form-group input-group-sm">
				<label class="text-muted" for="username">Category Parent</label>
				<select class="form-control" name="parent">
					<option value="0">--select parent category--</option>
					<?php foreach($PCATEGORIES as $row){ ?>
						<option 
							value="<?= $row['ID']; ?>" 
							<?= intval($row['ID'])==intval(set_value("parent"))?'selected':'' ?>
							><?= $row['name']; ?>
					 	</option>
					<?php } ?>
				</select>
				<small class="text-danger"><?= isset($validation)?display_error($validation,"parent"):'' ?></small>
			</div>
			<div class="mb-1 form-group input-group-sm">
				<label class="text-muted" for="active">Active</label>
				<input type="checkbox" name="active" <?= set_value("active")?"checked":'';?>>
				<small class="text-danger"><?= isset($validation)?display_error($validation,"parent"):'' ?></small>
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col col-sm-3 col-md-2 col-lg-2">
				<button tabindex="8" type="submit" style="float: right;" class="mt-2 btn btn-secondary">Submit</button>
				<a tabindex="7" href="<?= base_url(); ?>/getCategories" type="button" class="mt-2 btn btn-secondary">Cancel</a>
			</div>
		</div>
	</div>
</form>