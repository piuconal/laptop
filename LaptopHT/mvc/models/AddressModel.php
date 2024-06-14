<?php

class AddressModel extends DB
{
    public function GetProvince()
    {
        $qr = "SELECT * FROM `province`";
        $sql = mysqli_query($this->con, $qr);
        $kq = array();
        while ($row = mysqli_fetch_array($sql)) {
            $kq[] = $row;
        }
        return $kq;
    }
    public function GetAddress($id_prov, $id_dist, $id_ward)
    {
        $qr = "SELECT * FROM `province` WHERE `id`='$id_prov'";
        $sql = mysqli_query($this->con, $qr);
        if (mysqli_num_rows($sql) == 0)
            return 0;
        $row = mysqli_fetch_assoc($sql);
        $province = $row['_name'];
        $qr = "SELECT * FROM `district` WHERE `id`='$id_dist'";
        $sql = mysqli_query($this->con, $qr);
        if (mysqli_num_rows($sql) == 0)
            return 0;
        $row = mysqli_fetch_assoc($sql);
        $district = $row['_prefix'] . " " . $row['_name'];
        $qr = "SELECT * FROM `ward` WHERE `id`='$id_ward'";
        $sql = mysqli_query($this->con, $qr);
        if (mysqli_num_rows($sql) == 0)
            return 0;
        $row = mysqli_fetch_assoc($sql);
        $ward = $row['_prefix'] . " " . $row['_name'];
        return $ward . ", " . $district . ", " . $province;
    }
    public function GetDistrict($id)
    {
        $qr = "SELECT * FROM `district` WHERE `_province_id`='$id'";
        $sql = mysqli_query($this->con, $qr);
        $kq = array();
        while ($row = mysqli_fetch_assoc($sql)) {
            $kq[] = $row;
        }
        return $kq;
    }

    public function GetWard($id)
    {
        $qr = "SELECT * FROM `ward` WHERE `_district_id`='$id'";
        $sql = mysqli_query($this->con, $qr);
        $kq = array();
        while ($row = mysqli_fetch_array($sql)) {
            $kq[] = $row;
        }
        return $kq;
    }
}
