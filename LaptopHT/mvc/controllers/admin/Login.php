<?php
class Login extends Controller
{
     protected $dAdmin;
     protected $data;
     function __construct()
     {
          $this->dAdmin = $this->model("AdminModel");
          $this->data["domain"] = $this->domain;
          $this->data["controller"] = get_class($this);
     }
     public function DefaultAction()
     {
          $this->data["page"] = "Login";
          $this->data['title'] = "Đăng nhập Admin";
          $this->data['dAdmin'] = $this->dAdmin->Get();
          if (isset($_SESSION['user']['ad'])) {
               header("Location: $this->domain/Admin/Laptop");
               return;
          }
          if (isset($_POST['sm'])) {
               $u = $this->dAdmin->Login($_POST['account'], $_POST['password']);
               if ($u != 0) {
                    $_SESSION['user'] = ['id' => "$u[ID_Cus]", 'ho' => "$u[First_Name]", 'ten' => "$u[Last_Name]", 'ad' => 1];
                    header("Location: $this->domain/Admin/Laptop");
                    return;
               }
               $_SESSION['Notification']="Sai tài khoản hoặc mật khẩu";
          }
          $this->view("AdminLogin", $this->data);
     }
}
