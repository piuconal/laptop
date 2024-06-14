<?php
class OrderDetailsModel extends DB
{
     public function Get()
     {
          $qr = "SELECT * FROM `order_details`";
          $sql = mysqli_query($this->con, $qr);
          $kq = array();
          while ($row = mysqli_fetch_assoc($sql)) {
               $kq[] = $row;
          }
          // $kq=json_encode($kq);
          return $kq;
     }

     public function GetByID($id)
     {
          $qr = "SELECT * FROM `order_details` WHERE `ID_Order` ='$id'";
          $sql = mysqli_query($this->con, $qr);
          $kq = array();
          while ($row = mysqli_fetch_assoc($sql)) {
               $kq[] = $row;
          }
          return $kq;
     }
     public function GetMyOrderDetails($id)
     {
          $qr = "SELECT * FROM `order_details` JOIN `laptop` ON order_details.ID_Lap=laptop.ID_Lap WHERE `ID_Order` ='$id'";
          $sql = mysqli_query($this->con, $qr);
          $kq = [];
          while ($row = mysqli_fetch_assoc($sql)) {
               $kq[] = $row;
          }
          return $kq;
     }

     public function Add($id_order, $id_lap, $quantity, $price)
     {
          $qr = "INSERT INTO `order_details`(`ID_Order`,`ID_Lap`, `Quantity`, `Price`) VALUES ('$id_order','$id_lap','$quantity','$price')";
          $sql = mysqli_query($this->con, $qr);
          return $sql;
     }
}
