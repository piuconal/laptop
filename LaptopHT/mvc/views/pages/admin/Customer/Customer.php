<h1 class="text-center text-primary fw-bold m-3">Danh Sách Khách hàng</h1>
<div class="container mb-3" style="max-width: 400px;">
<div class="input-group">
     <input id="search" class="form-control border-2 border-primary"  name="info" value="<?php echo @$data['info'] ?>" type="search" onsearch="search()" placeholder="Tìm kiếm" aria-label="Search">
     <button class="btn btn-dark border-2 border-primary"  type="button" onclick="search()"><i class="bi bi-search"></i></button>
</div>
</div>
<?php
$prev = @$data['np'] - 1;
$next = @$data['np'] + 1;
echo "<table align='center' class='table table-bordered table-striped' cellpadding='2' cellspacing='2'>
          <tr class='table-primary' align='center' style='font-size:20px'>
               <th width='150px'>Mã</th>
               <th>Họ</th>
               <th>Tên</th>
               <th>Địa chỉ</th>
               <th>Số điện thoại</th>
               <th>Email</th>
               <th>Tài khoản</th>
               <th width='150px'>Tùy chọn</th>
          </tr>";

foreach ($data['dCus'] as $key => $value){
     echo "<tr align='center'>
               <td>$value[ID_Cus]</td>
               <td>$value[First_Name]</td>
               <td>$value[Last_Name]</td>
               <td>$value[Address]</td>
               <td>$value[Phone]</td>
               <td>$value[Email]</td>
               <td>$value[Account]</td>
               <td>
                    <a href='$data[domain]/Admin/$data[controller]/Edit/$value[ID_Cus]'><i class='bi bi-pencil-square btn btn-success rounded-circle shadow-lg' style='color:white; font-size: 20px;'></i></a>
                    <a href='$data[domain]/Admin/$data[controller]/Delete/$value[ID_Cus]'><i class='bi bi-trash-fill btn btn-danger rounded-circle shadow-lg' style='color:white; font-size: 20px;'></i></a>               
               </td>
          </tr>";
}
echo "</table>";

?>
<nav aria-label="Page navigation">
     <ul class="pagination d-flex justify-content-center fs-5">
          <li id="prev" class="page-item"><a class="page-link" href='<?php echo "$data[domain]/Admin/$data[controller]/$prev" ?>'>Previous</a></li>
          <?php
          for ($i = 1; $i <= $data['tp']; $i++) {
               echo "<li class='page-item'><a class='page-link' href='$data[domain]/Admin/$data[controller]/$i'>$i</a></li>";
          }
          ?>
          <li id="next" class="page-item"><a class="page-link" href='<?php echo "$data[domain]/Admin/$data[controller]/$next" ?>'>Next</a></li>
     </ul>
</nav>
<script>
      $(document).ready(function() {
          <?php
          if ($prev <= 0)
               echo ("$('#prev').addClass('invisible');");
          if ($next > $data['tp'])
               echo ("$('#next').addClass('invisible');");
          ?>
     })
</script>