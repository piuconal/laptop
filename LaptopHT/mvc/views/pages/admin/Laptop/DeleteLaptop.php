<?php
$images = json_decode($data['dLap']['Images'], 1);
$folder = $data['dLap']['ID_Lap'];
?>
<div class="container" align="center">
	<div class='card fs-5' style=" max-width: 600px;">
		<img src='<?php echo "$data[domain]/images/$folder/$images[0]" ?>' class='card-img-top' alt='...'>
		<div class='card-body'>
			<h5 class='card-title'><?php echo $data['dLap']['Name_Lap'] ?></h5>
			<p class='card-text text-danger fw-bold'>Giá: <?php echo $this->num_to_price($data['dLap']['Price']) ?></p>
		</div>
	</div>
	<div class="col-12 my-0 p-1">
		<h4>Bạn có chắc muốn xóa laptop này không ?</h4>
	</div>
	<form action="" method="post">
		<div class="col-12 my-0 p-1">
			<button class="btn btn-outline-dark mt-3" name="sm" type="submit">
				<h4 class="mx-3 my-1">Xác nhận</h4>
			</button>
		</div>
	</form>
</div>