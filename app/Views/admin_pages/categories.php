<p style="padding:0px 5px 0px 5px;" class="lead"><?= $MODULE_TITLE; ?></p>
<hr />
<div>
	<?php if(!empty(session()->getFlashData("SUCCESS"))){ ?>
	<div class="alert alert-success alert-dismissible" role="alert"><?= session()->getFlashData("SUCCESS"); ?>
		<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
	    	<span aria-hidden="true">&times;</span>
	  	</button>
	</div>
	<?php } ?>
	<a href="<?= base_url(); ?>/addCategory" class="btn btn-success btn-sm" style="margin-left:10px;">Add Category</a>
	<form action="<?= base_url(); ?>/getCategories" method="post" class="form-group" style="float:right;">
		<div class="input-group input-group-sm">
			<input class="form-control" name="search" placeholder="Search Category" value="<?= set_value("search"); ?>" autofocus></input>
			<div class="input-group-append">
		    	<button class="btn btn-outline-secondary btn-sm" type="submit">Search</button>
		  </div>
		</div>
	</form>
</div>
<table class="table table-striped">
	<thead>
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Description</th>
			<th>Parent</th>
			<th>Active</th>
			<th class="text-center">Action</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($CATEGORIES as $row) {?>
		<tr>
			<td><?= $row['ID']; ?></td>
			<td><?= $row['name']; ?></td>
			<td><?= $row['description']; ?></td>
			<td><?= $row['CParent']; ?></td>
			<td class="text-center">
				<input type="checkbox" name="checkbox_<?= $row['ID']; ?>" <?= $row['active']=='1'?'checked':''; ?> disabled>
			</td>
			<td class="text-center">
				<a class="btn btn-sm btn btn-warning" href="editCategory/<?= $row['ID']; ?>">Edit</a>
				<button class="btn btn-sm btn btn-danger" id="btnDeleteCat_<?= $row['ID']; ?>" data-id="<?= $row['ID']; ?>">Delete</a>
			</td>
		</tr>
		<?php } ?>
	</tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="mdConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="mtModalHeader" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="mtModalHeader">Confirm</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete the selected record?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-warning" id="btnDeleteCategory">Continue</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#btnDeleteCategory').off('click').on('click',function(){
			var frm = $('<form />',{
				method:'post',
				id:'frmDeleteCategory',
				action:'deleteCategory/'+$(this).attr('data-id')
			}).appendTo('body');

			$('<input />',{
				type:'hidden',
				value:$(this).attr('data-id')
			}).appendTo('#frmDeleteCategory');

			$('#frmDeleteCategory').submit();
		});
		$('button[id *= "btnDeleteCat_"]').off('click').on('click',function(){
			$('#btnDeleteCategory').attr('data-id',$(this).attr('data-id'));
			$('#mdConfirmDelete').modal('show');
		});
	});
</script>