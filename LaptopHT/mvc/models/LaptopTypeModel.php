<?php
class LaptopTypeModel extends DB
{
     public function Get()
     {
          $qr = "SELECT * FROM `laptop_type`";
          $sql = mysqli_query($this->con, $qr);
          $kq = array();
          while ($row = mysqli_fetch_array($sql)) {
               $kq[] = $row;
          }
          return $kq;
     }

     public function GetByID($id)
     {
          $qr = "SELECT * FROM `laptop_type` WHERE `ID_Type` ='$id'";
          $sql = mysqli_query($this->con, $qr);
          if (mysqli_num_rows($sql) > 0)
               return mysqli_fetch_array($sql);
          return 0;
     }
     public function Search($info,$vt=0)
     {
          $vt=$vt*12;
          $data = $this->Get();
          $kq = [];
          foreach ($data as $key => $value) {
               foreach ($value as $key => $val){
                    $pattern = "/$info/i";
                    if(preg_match($pattern, $val)){
                         $kq[]=$value;
                         break;
                    }
               }
          }
          $d = array_splice($kq, $vt, 12);
          return $d;
     }
     public function Add($id, $name)
     {
          $qr = "INSERT INTO `laptop_type`(`ID_Type`, `Name_Type`) VALUES ('$id','$name')";
          $sql = mysqli_query($this->con, $qr);
          return $sql;
     }

     public function Edit($id, $name)
     {
          $qr = "UPDATE `laptop_type` SET `Name_Type`='$name' WHERE `ID_Type`='$id'";
          $sql = mysqli_query($this->con, $qr);
          return $sql;
     }
     public function Delete($id)
     {
          $qr = "DELETE FROM `laptop_type` WHERE `ID_Type` = '$id'";
          $sql = mysqli_query($this->con, $qr);
          return $sql;
     }
     function Check_id($val)
     {
          $qr = "SELECT * FROM `laptop_type` WHERE `ID_Type` = '$val'";
          $sql = mysqli_query($this->con, $qr);
          if (mysqli_num_rows($sql) > 0)
               return "Mã loại đã tồn tại";
          return $this->check($val, 4, 10, 110);
     }
     function Check_name($val)
     {
          return $this->check($val, 1, 100, 200);
     }
}
