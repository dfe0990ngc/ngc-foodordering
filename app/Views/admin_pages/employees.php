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
	<a href="<?= base_url(); ?>/addEmployee" class="btn btn-success btn-sm" style="margin-left:10px;">Add Employee</a>
	<form action="<?= base_url(); ?>/getEmployees" method="post" class="form-group" style="float:right;">
		<div class="input-group input-group-sm">
			<input class="form-control" name="search" placeholder="Search Employee" value="<?= set_value("search"); ?>" autofocus></input>
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
			<th>First Name</th>
			<th>Middle Name</th>
			<th>Last Name</th>
			<th>Nick Name</th>
			<th class="text-center">Action</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($EMPLOYEES as $row) {?>
		<tr>
			<td><?= $row['ID']; ?></td>
			<td><?= $row['fname']; ?></td>
			<td><?= $row['mname']; ?></td>
			<td><?= $row['lname']; ?></td>
			<td><?= $row['nname']; ?></td>
			<td class="text-center">
				<a class="btn btn-sm btn btn-warning" href="editEmployee/<?= $row['ID']; ?>">Edit</a>
				<button class="btn btn-sm btn btn-danger" id="btnDeleteEmp_<?= $row['ID']; ?>" data-id="<?= $row['ID']; ?>">Delete</a>
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
        <button type="button" class="btn btn-warning" id="btnDeleteEmployee">Continue</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#btnDeleteEmployee').off('click').on('click',function(){
			var frm = $('<form />',{
				method:'post',
				id:'frmDeleteEmployee',
				action:'deleteEmployee/'+$(this).attr('data-id')
			}).appendTo('body');

			$('<input />',{
				type:'hidden',
				value:$(this).attr('data-id')
			}).appendTo('#frmDeleteEmployee');

			$('#frmDeleteEmployee').submit();
		});
		$('button[id *= "btnDeleteEmp_"]').off('click').on('click',function(){
			$('#btnDeleteEmployee').attr('data-id',$(this).attr('data-id'));
			$('#mdConfirmDelete').modal('show');
		});
	});
</script>