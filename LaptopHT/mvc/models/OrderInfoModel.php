<?php
class OrderInfoModel extends DB
{
     public function Get()
     {
          $qr = "SELECT * FROM `order_info`";
          $sql = mysqli_query($this->con, $qr);
          $kq = array();
          while ($row = mysqli_fetch_array($sql)) {
               $kq[] = $row;
          }
          return $kq;
     }

     public function GetFullInfo()
     {
          $qr = "SELECT * FROM `order_info`,`customer` WHERE order_info.ID_Cus = customer.ID_Cus ORDER BY `Time_Order` DESC";
          $sql = mysqli_query($this->con, $qr);
          $kq = array();
          while ($row = mysqli_fetch_assoc($sql)) {
               $kq[] = $row;
          }
          return $kq;
     }
     public function Search($info, $vt = 0)
     {
          $sarr = ['ID_Order', 'First_Name', 'Last_Name'];
          $vt = $vt * 12;
          $data = $this->GetFullInfo();
          $kq = [];
          foreach ($data as $key => $value) {
               foreach ($value as $k => $val) {
                    if (in_array($k, $sarr)) {
                         $pattern = "/$info/u";
                         if (preg_match($pattern, $val)) {
                              $kq[] = $value;
                              break;
                         }
                    }
               }
          }
          // $d = array_splice($kq, $vt, 12);
          return $kq;
     }

     public function GetByID($id)
     {
          $qr = "SELECT * FROM `order_info`,`customer` WHERE order_info.ID_Cus = customer.ID_Cus AND `ID_Order` ='$id'";
          $sql = mysqli_query($this->con, $qr);
          if (mysqli_num_rows($sql) > 0)
               return mysqli_fetch_assoc($sql);
          return 0;
     }
     public function GetMyOrder($id)
     {
          $qr = "SELECT * FROM `order_info` WHERE `ID_Cus` ='$id' ORDER BY `Time_Order` DESC";
          $sql = mysqli_query($this->con, $qr);
          $kq = [];
          if ($sql != false) {
               while ($row = mysqli_fetch_assoc($sql)) {
                    $kq[] = $row;
               }
          }
          return $kq;
     }

     public function Edit($id, $status_order)
     {
          $qr = "UPDATE `order_info` SET `Status_Order`='$status_order' WHERE `ID_Order`='$id'";
          $sql = mysqli_query($this->con, $qr);
          return $sql;
     }

     public function Add($id_order, $id_cus, $s_o, $cost)
     {
          $qr = "INSERT INTO `order_info`(`ID_Order`,`ID_Cus`, `Status_Order`, `Cost`) VALUES ('$id_order','$id_cus','$s_o','$cost')";
          $sql = mysqli_query($this->con, $qr);
          return $sql;
     }

     public function autoID()
     {
          $qr = "SELECT * FROM `order_info` ORDER BY ID_Order DESC";
          $sql = mysqli_query($this->con, $qr);
          if (mysqli_num_rows($sql) < 1)
               return 1;
          $id = mysqli_fetch_assoc($sql)['ID_Order'];
          return $id + 1;
     }
}
