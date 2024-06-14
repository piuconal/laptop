<?php

class CustomerModel extends DB
{
     public function Get()
     {
          $qr = "SELECT * FROM `customer`";
          $sql = mysqli_query($this->con, $qr);
          $kq = array();
          while ($row = mysqli_fetch_array($sql)) {
               $kq[] = $row;
          }
          // $kq=json_encode($kq);
          return $kq;
     }

     public function GetByID($id)
     {
          $qr = "SELECT * FROM `customer` WHERE `ID_Cus` ='$id'";
          $sql = mysqli_query($this->con, $qr);
          $row = ["Last_Name" => ""];
          if (mysqli_num_rows($sql) == 1)
               $row = mysqli_fetch_array($sql);
          return $row;
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
          // $d = array_splice($kq, $vt, 12);
          return $kq;
     }
     function updateBaseInfo($id, $first_name, $last_name, $phone, $email)
     {
          $qr = "UPDATE `customer` SET `First_Name`='$first_name',`Last_Name`='$last_name',`Phone`='$phone',`Email`='$email'
                              WHERE `ID_Cus`='$id'";
          $sql = mysqli_query($this->con, $qr);
          return $sql;
     }
     function updateAddress($id, $address)
     {
          $qr = "UPDATE `customer` SET `Address`='$address'
                              WHERE `ID_Cus`='$id'";
          $sql = mysqli_query($this->con, $qr);
          return $sql;
     }
     function updatePassword($id, $password)
     {
          $password = password_hash($password, PASSWORD_DEFAULT);
          $qr = "UPDATE `customer` SET `Password`='$password'
                              WHERE `ID_Cus`='$id'";
          $sql = mysqli_query($this->con, $qr);
          return $sql;
     }
     public function Login($account, $password)
     {
          $qr = "SELECT * FROM `customer` WHERE `Account`='$account'";
          $sql = mysqli_query($this->con, $qr);
          if (mysqli_num_rows($sql) > 0) {
               $kq = mysqli_fetch_assoc($sql);
               if (password_verify($password,$kq['Password']))
                    return $kq;
          }
          return 0;
     }

     public function Add($first_name, $last_name, $address, $phone, $email, $account, $password)
     {
          $password = password_hash($password, PASSWORD_DEFAULT);
          $qr = "INSERT INTO `customer`(`First_Name`, 
                                        `Last_Name`, `Address`, 
                                        `Phone`, `Email`, `Account`, `Password`)
               VALUES ('$first_name','$last_name','$address','$phone','','$account','$password')";
          $sql = mysqli_query($this->con, $qr);
          return $sql;
     }

     public function Edit($id, $first_name, $last_name, $address, $phone, $email, $account, $password)
     {
          $qr = "UPDATE `customer` SET `First_Name`='$first_name',`Last_Name`='$last_name',
                                        `Address`='$address',`Phone`='$phone',
                                        `Email`='$email',`Account`='$account',
                                        `Password`='$password'  
                              WHERE `ID_Cus`='$id'";
          $sql = mysqli_query($this->con, $qr);
          return $sql;
     }

     public function Delete($id)
     {
          $qr = "DELETE FROM `customer` WHERE `ID_Cus` = '$id'";
          $sql = mysqli_query($this->con, $qr);
          return $sql;
     }

     // check họ
     public function Check_firstname($val)
     {
          return $this->Check($val, 1, 100, 200);
     }

     public function Check_lastname($val)
     {
          return $this->Check($val, 1, 100, 200);
     }

     public function Check_account($val)
     {
          $qr = "SELECT * FROM `customer` WHERE `Account`='$val'";
          $sql = mysqli_query($this->con, $qr);
          if (mysqli_num_rows($sql) > 0)
               return "Tài khoản đã tồn tại";
          return $this->Check($val, 8, 32, 111);
     }

     public function Check_password($val)
     {
          if(!preg_match("/[a-z]+/i", $val) || !preg_match("/[A-Z]+/i", $val) ||!preg_match("/[0-9]+/i", $val))
               return "Mật khẩu phải chứa chữ thường, chữ hoa và chữ số";
          return $this->Check($val, 8, 32, 112);
     }
     public function Check_phone($val)
     {
          return $this->Check($val, 10, 10, 10);
     }

     public function Check_email($val)
     {
          if(!preg_match("/[\S]{6,}@[\S]+\.[\S]+$/i", $val))
               return "Sai định dạng mail";
          return $this->Check($val, 8, 32);
     }
}
