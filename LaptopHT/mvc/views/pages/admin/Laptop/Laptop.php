<h1 class="text-center text-primary fw-bold m-3">Danh Sách Laptop <a href='<?php echo "$data[domain]/Admin/$data[controller]/Add" ?>'><i class="bi bi-plus-circle"></i></a></h1>
<div class="container mb-3" style="max-width: 400px;">
     <div class="input-group">
          <input id="search" class="form-control border-2 border-primary" name="info" value="<?php echo @$data['info'] ?>" type="search" onsearch="search()" placeholder="Tìm kiếm" aria-label="Search">
          <button class="btn btn-dark border-2 border-primary" type="button" onclick="search()"><i class="bi bi-search"></i></button>
     </div>
</div>

<?php
$prev = @$data['np'] - 1;
$next = @$data['np'] + 1;
echo "<table align='center' class='table table-bordered' cellpadding='2' cellspacing='2' id='list_data'>
          <tr class='table-primary' align='center' style='vertical-align: middle; font-size:20px;' id='tt' >
               <th>STT</th>
               <th>Mã </th>
               <th>Hình ảnh</th>
               <th>Tên</th>
               <th>Giá</th>
               <th>Bảo hành</th>
               <th>Tên loại laptop</th>
               <th>Tên hảng</th>
               <th>Thời điểm ra mắt</th>
               <th>Thời điểm nhập</th>
               <th width='150px'>Tùy chọn</th>
          </tr>
          ";
foreach ($data['dLap'] as $key => $value) {
     $images = json_decode($value['Images']);
     $stt = $key + 1;
     $price = $this->num_to_price($value['Price']);
     $time_add = $this->format_date($value['Add_Time']);
     echo "<tr align='center' id_lap='$value[ID_Lap]'>
               <td>$stt</td>
               <td >$value[ID_Lap]</td>
               <td><img class='col' src='$data[domain]/images/$value[ID_Lap]/$images[0]' style='max-height:80px;'/></td>
               <td class='fw-bold'>$value[Name_Lap]</td>
               <td class='text-danger'>$price</td>
               <td '>$value[Insurance]</td>
               <td class='text-primary fw-bold'>$value[Name_Type]</td>
               <td class='text-success fw-bold'>$value[Name_Manu]</td>
               <td>$value[Release_Time]</td>
               <td>$time_add</td>
               <td>
                    <a href='$data[domain]/Admin/$data[controller]/Edit/$value[ID_Lap]'><i class='bi bi-pencil-square btn btn-success rounded-circle shadow-lg' style='color:white; font-size: 20px;'></i></a>
                    <a href='$data[domain]/Admin/$data[controller]/Delete/$value[ID_Lap]'><i class='bi bi-trash-fill btn btn-danger rounded-circle shadow-lg' style='color:white; font-size: 20px;'></i></a>  
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