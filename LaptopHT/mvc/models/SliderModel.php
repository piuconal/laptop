<?php
class SliderModel extends DB
{
     public function Get()
     {
          $qr = "Select * from slider";
          $sql = mysqli_query($this->con, $qr);
          $kq = array();
          while ($row = mysqli_fetch_array($sql)) {
               $kq[] = $row;
          }
          return $kq;
     }
     public function GetByID($id)
     {
          $qr = "SELECT * FROM `slider` WHERE `ID_Slider` ='$id'";
          $sql = mysqli_query($this->con, $qr);
          if (mysqli_num_rows($sql) > 0)
               return mysqli_fetch_array($sql);
          return 0;
     }
     public function Add($title, $image, $status)
     {
          $qr = "INSERT INTO `slider`(`Title`, `Image`, `Status`) VALUES ('$title','$image','$status')";
          $sql = mysqli_query($this->con, $qr);
          return $sql;
     }

     public function Edit($id_slider,$title, $image, $status)
     {
          $qr = "UPDATE `slider` SET `Title`='$title', `Image`='$image', `Status`='$status' WHERE `ID_Slider`='$id_slider'";
          $sql = mysqli_query($this->con, $qr);
          return $sql;
     }
     public function Delete($id)
     {
          $qr = "DELETE FROM `slider` WHERE `ID_Slider` = '$id'";
          $sql = mysqli_query($this->con, $qr);
          return $sql;
     }
}
