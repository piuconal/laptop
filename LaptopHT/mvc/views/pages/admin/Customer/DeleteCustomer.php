<?php
$customer = $data['customer'];
?>
<h1 style='color: blue;' align='center'>XÓA KHÁCH HÀNG</h1>
<form action="" method="post">
	<div class="col-12 my-0 p-1">
		<center>Bạn có chắc muốn xóa khách hàng có tên là <?php echo $customer['First_Name'] . " " . $customer['Last_Name'] ?> không ?</center>
	</div>
	<div class="col-12 my-0 p-1">
		<center><button class="btn btn-primary" type="submit" name="sm">Xác nhận</button></center>
	</div>
</form>
<?php
if (isset($data['dCus'])) {
	if ($data['dTCus'] == 1)
		echo "Đã xóa";
	else
		echo "Lỗi";
}
?>