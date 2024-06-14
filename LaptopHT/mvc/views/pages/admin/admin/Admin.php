<h1 class="text-center text-primary fw-bold p-5">Danh Sách Admin</h1>
<?php
echo "<table align='center' class='table table-bordered rounded-3' cellpadding='2' cellspacing='2'>
<thead class='table-primary' >
<tr align='center' style='font-size:20px'>
     <th width='150px'>Mã</th>
     <th width='500px'>Họ</th>
     <th>Tên</th>
     <th>Tài khoản</th>
     </thead>";

foreach ($data['dAdmin'] as $key => $value) {
     $dad = $value;
     echo "<tr align='center'>
               <td>$dad[ID_Admin]</td>
               <td>$dad[First_Name]</td>
               <td>$dad[Last_Name]</td>
               <td>$dad[Account]</td>
          </tr>";
}
echo "</table>";

?>