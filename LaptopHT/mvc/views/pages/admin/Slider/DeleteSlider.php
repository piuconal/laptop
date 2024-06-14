<div class="container-md">
<h1 style='color: blue;' align='center' class="my-5">Xóa Slider</h1>
<div class="card">
	<img src="<?php echo "$data[domain]/images/slider/" . $data['dSlider']['Image'] ?>" class="card-img-top" alt="...">
	<div class="card-body card-img-overlay p-0 d-flex justify-content-center align-items-end">
		<h5 class="card-title text-light bg-dark fs-4 fst-italic m-0 p-0 w-100 bg-opacity-50 text-center" style="filter: drop-shadow(0 0 5px dark);"><?php echo $data['dSlider']['Title'] ?></h5>
	</div>
</div>
<form action="" method="post" class="col-12 col-xl-6 container">
	<div>
		<center>
			<h5>Bạn có chắc muốn xóa slider này này không ?</h5>
		</center>
		<center>
			<button class="btn btn-outline-dark mt-3" name="sm" type="submit">
				<h4 class="mx-3 my-1">Xác nhận</h4>
			</button>
		</center>
	</div>
</form>
</div>