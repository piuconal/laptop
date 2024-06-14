<?php
class Info extends Controller
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
     // action mặc định
     function DefaultAction()
     {
          $this->data["page"] = "Info";
          $this->data['title'] = "Thông tin cá nhân";
          $this->data['dProvince'] = $this->dAddress->GetProvince();
          if (!isset($_SESSION['user'])) {
               header("Location: $this->domain/login");
               return;
          }
          if (isset($_SESSION['user']['ad'])) {
               header("Location: $this->domain");
               return;
          }
          if (isset($_POST['sm'])) {
               if ($this->validate($this->dCus, $_POST))
                    if ($this->dCus->updateBaseInfo($_SESSION['user']['id'], $_POST['firstname'], $_POST['lastname'], $_POST['phone'], $_POST['email'])) {
                         $_SESSION['user']['ho'] = $_POST['firstname'];
                         $_SESSION['user']['ten'] = $_POST['lastname'];
                         $_SESSION['user']['sdt'] = $_POST['phone'];
                         $_SESSION['user']['email'] = $_POST['email'];
                         $_SESSION['notify'] = "Cập nhật thành công";
                    } else
                         $_SESSION['notify'] = "Có lỗi xảy ra! vui lòng thử lại";
               else
                    $_SESSION['notify'] = "Vui lòng kiểm tra lại dữ liệu";
          }
          if (isset($_POST['sm_changeAddress'])) {
               $address = $this->dAddress->GetAddress($_POST['province'], $_POST['district'], $_POST['ward']);
               $address = $_POST['spe'] . ", ". $address;
               if ($this->dCus->updateAddress($_SESSION['user']['id'], $address)) {
                    $_SESSION['user']['dc'] = $address;
                    $_SESSION['notify'] = "Cập nhật thành công";
               } else
                    $_SESSION['notify'] = "Có lỗi xảy ra! vui lòng thử lại";
          }
          if (isset($_POST['sm_changePassword'])) {
               if ($this->validate($this->dCus, $_POST)) {
                    $this->data['dCus'] = $this->dCus->GetByID($_SESSION['user']['id']);
                    if ($this->dCus->login($this->data['dCus']['Account'], $_POST['oldPassword'])!=0)
                         if ($this->dCus->updatePassword($_SESSION['user']['id'], $_POST['password']))
                              $_SESSION['notify'] = "Cập nhật thành công";
                         else
                              $_SESSION['notify'] = "Có lỗi xảy ra! vui lòng thử lại";
                    else
                         $_SESSION['notify'] = "sai mật khẩu";
               }
          }
          $this->view("ClientLayout", $this->data);
     }
}
