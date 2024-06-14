<?php
class LaptopModel extends DB
{
     public function Get()
     {
          $qr = "SELECT * FROM `laptop`";
          $sql = mysqli_query($this->con, $qr);
          $kq = array();
          while ($row = mysqli_fetch_array($sql)) {
               $kq[] = $row;
          }
          return $kq;
     }

     public function GetByID($id)
     {
          $qr = "SELECT * FROM `laptop` WHERE `ID_Lap` ='$id'";
          $sql = mysqli_query($this->con, $qr);
          if (mysqli_num_rows($sql) == 1)
               return mysqli_fetch_array($sql);
          return 0;
     }

     public function GetFullInfo($a="Add_Time", $o="DESC")
     {
          $qr = "SELECT * FROM `laptop` JOIN `manufacturer` ON laptop.ID_Manu = manufacturer.ID_Manu
                                        JOIN `laptop_type` ON laptop.ID_Type = laptop_type.ID_Type Order By `$a` $o";
          $sql = mysqli_query($this->con, $qr);
          $kq = array();
          while ($row = mysqli_fetch_array($sql)) {
               $kq[] = $row;
          }
          return $kq;
     }
     public function GetForHome($vt=0,$a="Add_Time",$o="DESC")
     {
          $numonpage=8;
          $vt=$vt*$numonpage;
          $qr = "SELECT * FROM `laptop` JOIN `manufacturer` ON laptop.ID_Manu = manufacturer.ID_Manu
                                        JOIN `laptop_type` ON laptop.ID_Type = laptop_type.ID_Type Order By `$a` $o LIMIT $vt,$numonpage";
          $sql = mysqli_query($this->con, $qr);
          $kq = array();
          while ($row = mysqli_fetch_array($sql)) {
               $kq[] = $row;
          }
          return $kq;
     }
     public function Search($info,$vt=0, $a="Add_Time",$o="DESC")
     {
          $numonpage=8;
          $vt=$vt*$numonpage;
          $data = $this->GetFullInfo($a,$o);
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
          $d = array_splice($kq, $vt, $numonpage);
          return $d;
     }
     public function GetFullInfoByID($id)
     {
          $qr = "SELECT * FROM `laptop` JOIN `manufacturer` ON laptop.ID_Manu = manufacturer.ID_Manu
                                        JOIN `laptop_type` ON laptop.ID_Type = laptop_type.ID_Type
                                        WHERE laptop.ID_Lap='$id'";
          $sql = mysqli_query($this->con, $qr);
          if(mysqli_num_rows($sql) > 0)
               return mysqli_fetch_array($sql);
          return 0;
     }

     public function Add(
          $id,
          $name,
          $price,
          $insur,
          $id_type,
          $id_manu,
          $img,
          $cpu,
          $gpu,
          $ram,
          $storage,
          $screen,
          $audio,
          $connec,
          $o_f,
          $d_w,
          $material,
          $battery,
          $os,
          $r_t
     ) {
          $qr = "INSERT INTO `laptop`(`ID_Lap`,`Name_Lap`, `Price`, `Insurance`, 
                                        `ID_Type`, `ID_Manu`, `Images`, `CPU`, 
                                        `GPU`, `RAM`, `Storage`, `Screen`, `Audio`, 
                                        `Connection`, `Other_Feature`, `Dimen_Wei`, 
                                        `Material`, `Battery`, `OS`, `Release_Time`) 
                    VALUES ('$id','$name','$price','$insur','$id_type',
                         '$id_manu','$img','$cpu','$gpu','$ram','$storage',
                         '$screen','$audio','$connec','$o_f','$d_w','$material',
                         '$battery','$os','$r_t')";
          $sql = mysqli_query($this->con, $qr);
          return $sql;
     }

     public function Edit(
          $id,
          $name,
          $price,
          $insur,
          $id_type,
          $id_manu,
          $img,
          $cpu,
          $gpu,
          $ram,
          $storage,
          $screen,
          $audio,
          $connec,
          $o_f,
          $d_w,
          $material,
          $battery,
          $os,
          $r_t
     ) {
          $qr = "UPDATE `laptop` SET `Name_Lap`='$name',`Price`='$price',
                                   `Insurance`='$insur',`ID_Type`='$id_type',
                                   `ID_Manu`='$id_manu',`Images`='$img',
                                   `CPU`='$cpu',`GPU`='$gpu',`RAM`='$ram',
                                   `Storage`='$storage',`Screen`='$screen',
                                   `Audio`='$audio',`Connection`='$connec',
                                   `Other_Feature`='$o_f',`Dimen_Wei`='$d_w',
                                   `Material`='$material',`Battery`='$battery',
                                   `OS`='$os',`Release_Time`='$r_t' WHERE `ID_Lap`='$id'";
          $sql = mysqli_query($this->con, $qr);
          return $sql;
     }

     public function Delete($id)
     {
          $qr = "DELETE FROM `laptop` WHERE `ID_Lap` = '$id'";
          $sql = mysqli_query($this->con, $qr);
          return $sql;
     }

     function Check_id($val)
     {
          $qr = "SELECT * FROM `laptop` WHERE `ID_Lap` = '$val'";
          $sql = mysqli_query($this->con, $qr);
          if (mysqli_num_rows($sql) > 0)
               return "Mã laptop đã tồn tại";
          return ($this->check($val, 4, 10, 110));
     }
     function Check_name($val)
     {
          return $this->check($val, 1, 100);
     }
     function Check_price($val)
     {
          return $this->check($val, 7, 10, 10);
     }
     function Check_cpu($val)
     {
          return $this->check($val, 1, 100);
     }
     function Check_gpu($val)
     {
          return $this->check($val, 1, 100);
     }
     function Check_disk($val)
     {
          return $this->check($val, 1, 255);
     }
     function Check_insu($val)
     {
          return $this->check($val, 1, 100, 210);
     }
     function Check_release($val)
     {
          return $this->check($val, 1, 100, 210);
     }
     function Check_sizeSC($val)
     {
          return $this->check($val, 1, 100);
     }
     function Check_resoSC($val)
     {
          return $this->check($val, 1, 100);
     }
     function Check_freSC($val)
     {
          return $this->check($val, 1, 100, 110);
     }
     function Check_techSC($val)
     {
          return $this->check($val, 1, 100);
     }
     function Check_memRAM($val)
     {
          return $this->check($val, 1, 100);
     }
     function Check_typeRAM($val)
     {
          return $this->check($val, 1, 100);
     }
     function Check_busRAM($val)
     {
          return $this->check($val, 1, 100);
     }
     function Check_maxRAM($val)
     {
          return $this->check($val, 1, 100);
     }
}
