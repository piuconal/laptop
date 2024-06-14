<?php
class CommentModel extends DB
{
     public function Get()
     {
          $qr = "SELECT * FROM `comment`";
          $sql = mysqli_query($this->con, $qr);
          $kq = array();
          while ($row = mysqli_fetch_array($sql)) {
               $kq[] = $row;
          }
          return $kq;
     }

     public function GetCommByID_Lap($id,$vt)
     {
          $vt=$vt*5;
          $qr = "SELECT * FROM `comment` JOIN `customer` ON comment.ID_Cus = customer.ID_Cus
                                        WHERE comment.ID_Lap='$id'
                                        ORDER BY Time_Comm DESC LIMIT $vt,5";
          $sql = mysqli_query($this->con, $qr);
          $kq = array();
          while ($row = mysqli_fetch_assoc($sql)) {
               $kq[] = $row;
          }
          return $kq;
     }
     public function AddComment($id_Lap, $id_Cus, $content)
     {
          if($content=="")
               return 0;
          $qr = "INSERT INTO `comment`(`ID_Lap`, `ID_Cus`, `Content`) VALUES ('$id_Lap','$id_Cus','$content')";
          $sql = mysqli_query($this->con, $qr);
          return $sql;
     }

}
