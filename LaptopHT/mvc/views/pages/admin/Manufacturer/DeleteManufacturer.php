<h1 style='color: blue;' align='center'>XÓA HẢNG</h1>
<form action="" method="post" class="col-12 col-xl-6 container">
	<div>
		<label for="field1" class="form-label">Mã hảng</label>
		<input id="field1" type="text" name="id" value="<?php echo @$data['dManu']['ID_Manu'] ?>" class="form-control" disabled>
		<label></label>
	</div>
	<div>
		<label for="field2" class="form-label">Tên hảng</label>
		<input id="field2" type="text" name="name" value="<?php echo @$data['dManu']['Name_Manu'] ?>" class="form-control" disabled>
		<label></label>
	</div>
	<div>
		<center>
			<h5>Bạn có chắc muốn xóa hảng này không ?</h5>
		</center>
		<center>
			<button class="btn btn-outline-dark mt-3" name="sm" type="submit">
				<h4 class="mx-3 my-1">Xác nhận</h4>
			</button>
		</center>
	</div>
</form>