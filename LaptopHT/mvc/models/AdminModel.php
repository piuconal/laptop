<?php
class AdminModel extends DB
{
    public function Get()
    {
        $qr = "SELECT * FROM `admin`";
        $sql = mysqli_query($this->con, $qr);
        $kq = array();
        while ($row = mysqli_fetch_array($sql)) {
            $kq[] = $row;
        }
        // $kq=json_encode($kq);
        return $kq;
    }
    public function Login($account, $password)
    {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $qr = "SELECT * FROM `admin` WHERE `Account`='$account'";
        $sql = mysqli_query($this->con, $qr);
        if (mysqli_num_rows($sql) > 0) {
            $kq = mysqli_fetch_assoc($sql);;
            if (password_verify($kq['Password'], $password));
            return $kq;
        }
        return 0;
    }
    public function GetByID($id)
    {
        $qr = "SELECT * FROM `admin` WHERE `ID_Admin` ='$id'";
        $sql = mysqli_query($this->con, $qr);
        $row = ["Last_Name" => ""];
        if (mysqli_num_rows($sql) == 1)
            $row = mysqli_fetch_array($sql);
        return $row;
    }

    public function Add($first_name, $last_name, $account, $password)
    {
        $qr = "INSERT INTO `admin`(`First_Name`,`Last_Name`,`Account`, `Password`)
               VALUES ('$first_name','$last_name','$account','$password')";
        $sql = mysqli_query($this->con, $qr);
        return $sql;
    }

    public function Edit($id, $first_name, $last_name, $account, $password)
    {
        $qr = "UPDATE `admin` SET `First_Name`='$first_name',`Last_Name`='$last_name',`Account`='$account',`Password`='$password'  
                              WHERE `ID_Admin`='$id'";
        $sql = mysqli_query($this->con, $qr);
        return $sql;
    }

    public function Delete($id)
    {
        $qr = "DELETE FROM `admin` WHERE `ID_Admin` = '$id'";
        $sql = mysqli_query($this->con, $qr);
        return $sql;
    }

    function CheckFirstName($val)
    {
        return $this->check($val, 1, 100, 11100);
    }

    function CheckLastName($val)
    {
        return $this->check($val, 1, 20, 11100);
    }

    function CheckAccount($val)
    {
        return $this->check($val, 8, 32, 10010);
    }
}
