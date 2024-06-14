<h1 style='color: blue;' align='center'>XÓA LOẠI LAPTOP</h1>
<form action="" method="post" class="col-12 col-xl-6 container">
	<div>
		<label for="field1" class="form-label">Mã loại laptop</label>
		<input id="field1" type="text" name="id" value="<?php echo @$data['dType']['ID_Type'] ?>" class="form-control" disabled>
		<label></label>
	</div>
	<div>
		<label for="field2" class="form-label">Tên loại laptop</label>
		<input id="field2" type="text" name="name" value="<?php echo @$data['dType']['Name_Type'] ?>" class="form-control" disabled>
		<label></label>
	</div>
	<div>
		<center>
			<h5>Bạn có chắc muốn xóa loại laptop này không ?</h5>
		</center>
		<center>
			<button class="btn btn-outline-dark mt-3" name="sm" type="submit">
				<h4 class="mx-3 my-1">Xác nhận</h4>
			</button>
		</center>
	</div>
</form>
