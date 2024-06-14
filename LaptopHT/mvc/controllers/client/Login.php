<?php

class Login extends Controller
{
    protected $dCus;
    protected $dAddress;
    protected $data;
    function __construct()
    {
        $this->dCus = $this->model("CustomerModel");
        $this->dAddress = $this->model("AddressModel");
        $this->data["domain"] = $this->domain;
        $this->data["controller"] = get_class($this);
    }

    function DefaultAction()
    {
        if (isset($_SESSION['user'])) {
            header("Location: $this->domain/" . @$_SESSION['url']);
            return;
        }
        $this->data["page"] = "Login";
        $this->data['title'] = "Đăng nhập";
        $this->data['action'] = "";
        if (isset($_POST['sm'])) {
            $u = $this->dCus->Login($_POST['account'], $_POST['password']);
            if ($u != 0) {
                $_SESSION['user'] = ['id' => "$u[ID_Cus]", 'ho' => "$u[First_Name]", 'ten' => "$u[Last_Name]", 'dc' => "$u[Address]", 'sdt' => "$u[Phone]", 'email' => "$u[Email]"];
                header("Location: $this->domain/" . @$_SESSION['url']);
                return;
            } else
                $_SESSION['notify'] = "Tài khoản hoặc mật sai!";
        }
        $this->view("Login", $this->data);
    }
    function SignOut()
    {
        unset($_SESSION['user']);
        header("Location: $this->domain/" . @$_SESSION['url']);
        return;
    }
    function SignUp()
    {
        if (isset($_SESSION['user'])) {

            header("Location: $this->domain/" . @$_SESSION['url']);
            return;
        }
        $this->data["page"] = "SignUp";
        $this->data['title'] = "Đăng ký";
        $this->data['action'] = "SignUp";
        $this->data['dProvince'] = $this->dAddress->GetProvince();
        if (isset($_POST['sm'])) {
            if (isset($_POST['province']))
                $this->data['dDistrict'] = $this->dAddress->GetDistrict($_POST['province']);
            if (isset($_POST['district']))
                $this->data['dWard'] = $this->dAddress->GetWard($_POST['district']);
            $this->data['dProvince'] = $this->dAddress->GetProvince();
            $check = $this->validate($this->dCus, $_POST);
            $address = $this->dAddress->GetAddress($_POST['province'], $_POST['district'], $_POST['ward']);
            $address = $_POST['spe']  . ", " . $address;
            if ($check && $_POST['password'] == $_POST['confirmPassword']) {
                            $this->dCus->Add($_POST['firstname'], $_POST['lastname'], $address, $_POST['phone'], $_POST['email'], $_POST['account'], $_POST['password']);
                            $u = $this->dCus->Login($_POST['account'], $_POST['password']);
                            $_SESSION['user'] = ['id' => "$u[ID_Cus]", 'ho' => "$u[First_Name]", 'ten' => "$u[Last_Name]", 'dc' => "$u[Address]", 'email' => "$u[Email]", 'sdt' => "$u[Phone]"];
                            $_SESSION['notify'] = "<p>Chào $u[Last_Name]!</p><p>Chúc mừng bạn vừa tạo tài khoản</p>";
                            unset($_SESSION['verify']);
                            header("Location: $this->domain");
                            return;
            } else
                $_SESSION['notify'] = "Có lỗi xảy ra! vui lòng thử lại";
        }
        $this->view("Login", $this->data);
    }
}
