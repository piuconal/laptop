<?php
class CartModel extends DB
{
     public function Get()
     {
          $qr = "SELECT * FROM `cart`";
          $sql = mysqli_query($this->con, $qr);
          $kq = [];
          while ($row = mysqli_fetch_assoc($sql)) {
               $kq[] = $row;
          }
          // $kq=json_encode($kq);
          return $kq;
     }

     public function GetFullInfo()
     {
          $qr = "SELECT * FROM `cart` JOIN `laptop` ON cart.ID_Lap = laptop.ID_lap
                                        JOIN `customer` ON cart.ID_Cus = customer.ID_Cus";
          $sql = mysqli_query($this->con, $qr);
          $kq = [];
          while ($row = mysqli_fetch_assoc($sql)) {
               $kq[] = $row;
          }
          return $kq;
     }
     public function Search($info, $vt = 0)
     {
          $sarr = ['Name_Lap', 'First_Name', 'Last_Name'];
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
     public function GetByID_Cus($id_Cus)
     {
          $qr = "SELECT * FROM `cart`,`laptop` WHERE cart.ID_Lap = laptop.ID_Lap and `ID_Cus`='$id_Cus'";
          $sql = mysqli_query($this->con, $qr);
          $kq = [];
          while ($row = mysqli_fetch_assoc($sql)) {
               $kq[] = $row;
          }
          return $kq;
     }

     public function GetByOrder($id_Cus,$id_Lap)
     {
          $qr = "SELECT * FROM `cart`,`laptop` WHERE cart.ID_Lap = laptop.ID_Lap and cart.ID_Lap='$id_Lap' and cart.ID_Cus='$id_Cus'";
          $sql = mysqli_query($this->con, $qr);
          return mysqli_fetch_assoc($sql);
     }

     public function GetNumPro($id) // Số lượng sản phẩm trong giỏ hàng
     {
          $qr = "SELECT * FROM `cart` WHERE `ID_Cus` = '$id'";
          $sql = mysqli_query($this->con, $qr);
          if (mysqli_num_rows($sql) > 0)
               return mysqli_num_rows($sql);
          else
               return 0;
     }
     public function AddCart($id_lap, $id_cus)
     {
          $qr = "SELECT * FROM `cart` WHERE `ID_Lap`='$id_lap' and `ID_Cus`='$id_cus'";
          $sql = mysqli_query($this->con, $qr);
          if (mysqli_num_rows($sql)) {
               $qtt = mysqli_fetch_assoc($sql)['Quantity']+1;
               if ($this->Edit($id_lap, $id_cus, $qtt))
                    return "Số lượng + 1 ($qtt)";
               return "Thêm thất bại";
          }
          if ($this->Add($id_lap, $id_cus))
               return "Đã thêm vào giỏ hàng";
          return "Thêm thất bại";
     }
     public function Add($id_lap, $id_cus, $quantity = "")
     {
          if (empty($quantity))
               $quantity = 1;
          $qr = "INSERT INTO `cart`(`ID_Lap`, `ID_Cus`, `Quantity`) VALUES ('$id_lap','$id_cus','$quantity')";
          $sql = mysqli_query($this->con, $qr);
          return $sql;
     }
     public function Edit($id_lap, $id_cus, $quantity)
     {
          if($quantity<=0 || $quantity>99)
               return 0;
          $qr = "UPDATE `cart` SET `Quantity`='$quantity'
                              WHERE `ID_Lap`='$id_lap' and `ID_Cus`='$id_cus'";
          $sql = mysqli_query($this->con, $qr);
          return $sql;
     }

     public function Delete($id_lap, $id_cus)
     {
          $qr = "DELETE FROM `cart` WHERE `ID_Lap`='$id_lap' and `ID_Cus`='$id_cus'";
          $sql = mysqli_query($this->con, $qr);
          return $sql;
     }
}
