<h1 class="text-center text-primary fw-bold m-3">Danh Sách Laptop <a href='<?php echo "$data[domain]/Admin/$data[controller]/Add" ?>'><i class="bi bi-plus-circle"></i></a></h1>
<div class="container mb-3" style="max-width: 400px;">
     <div class="input-group">
          <input id="search" class="form-control border-2 border-primary" name="info" value="<?php echo @$data['info'] ?>" type="search" onsearch="search()" placeholder="Tìm kiếm" aria-label="Search">
          <button class="btn btn-dark border-2 border-primary" type="button" onclick="search()"><i class="bi bi-search"></i></button>
     </div>
     <p class="text-center text-primary fs-5">Tìm thấy <span id='numkq'></span> kết quả!</p>
</div>
<?php
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
     </table>";
?>
<div class="text-center">
     <button id="XemThem" class="btn btn-secondary mt-3" style="padding: 5px 125px; display:none;">Xem thêm</button>
</div>
<script>
     vt = 0
     $(document).ready(function() {
          getData();
     })
     $("#XemThem").click(function() {
          getData();
     })
     function getData() {
          $.post('<?php echo "$data[domain]/Admin/Ajax/Get_Search_Laptop"; ?>', {
               info: '<?php echo "$data[info]" ?>',
               vt: vt,
          }, function(data) {
               vt++
               data = JSON.parse(data);
               $("#list_data").append(data[0]);
               $("#numkq").html(data[1]);
               $.post('<?php echo "$data[domain]/Admin/Ajax/Get_Search_Laptop"; ?>', {
                    info: '<?php echo "$data[info]" ?>',
                    vt: vt,
               }, function(data) {
                    data = JSON.parse(data);
                    if (data[0] != "")
                         $("#XemThem").css("display", "inline-block");
                    else
                         $("#XemThem").css("display", "none");
               })
          })
     }
</script>