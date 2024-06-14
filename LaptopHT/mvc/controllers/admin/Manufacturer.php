<?php
class Manufacturer extends Controller
{
     protected $dManu;
     protected $data;
     function __construct()
     {
          $this->dManu = $this->model("ManufacturerModel");
          $this->data["domain"] = $this->domain;
          $this->data["controller"] = get_class($this);
     }
     // action mặc định
     function DefaultAction($page = 1)
     {
          $numonpage = 10;
          $this->data["page"] = "Manufacturer";
          $this->data['title'] = "Hảng Laptop";
          $this->data['dManu'] = $this->dManu->Get();
          $this->data["np"] = $page;
          $this->data["tp"] = ceil(count($this->data['dManu']) / $numonpage);
          $this->data['dManu'] = array_splice($this->data['dManu'], ($page - 1) * $numonpage, $numonpage);
          $this->view("AdminLayout", $this->data);
     }
     function Search($info = "")
     {
          if (empty($info)) {
               header("Location: $this->domain/Admin/" . $this->data['controller']);
               return;
          }
          $this->data["page"] = "Search";
          $this->data['title'] = "Hảng Laptop";
          $this->data['info'] = $info;
          $this->view("AdminLayout", $this->data);
     }

     function Add()
     {
          $this->data["page"] = "AddManufacturer";
          $this->data['title'] = "Thêm Hảng";
          $this->data['action'] = "Add";
          if (isset($_POST['sm'])) {
               $check = $this->validate($this->dManu, $_POST);
               if ($check)
                    if ($this->dManu->Add($_POST['id'], $_POST['name'])) {
                         $_SESSION['Notification'] = "Thêm thành công!";
                         header("Location: $this->domain/Admin/" . $this->data['controller']);
                         return;
                    } else
                         $_SESSION['Notification'] = "Có lỗi xảy ra! Vui lòng thử lại";
               else
                    $_SESSION['Notification'] = "Vui lòng kiểm tra lại dữ liệu nhập!";
          }
          $this->view("AdminLayout", $this->data);
     }
     function Edit($id)
     {
          $this->data["page"] = "EditManufacturer";
          $this->data['title'] = "Sửa Hảng";
          $this->data['action'] = "Edit";
          $this->data["dManu"] = $this->dManu->GetByID($id);;
          if ($this->data["dManu"] == 0) {
               header("Location: $this->domain/Admin/" . $this->data['controller']);
               return;
          }
          if (isset($_POST['sm'])) {
               $check = $this->validate($this->dManu, $_POST);
               if ($check)
                    if ($this->dManu->Edit($id, $_POST['name'])) {
                         $_SESSION['Notification'] = "Cập nhật thành công!";
                         header("Location: $this->domain/Admin/" . $this->data['controller']);
                         return;
                    } else
                         $_SESSION['Notification'] = "Có lỗi xảy ra! Vui lòng thử lại";
               else
                    $_SESSION['Notification'] = "Vui lòng kiểm tra lại dữ liệu nhập!";
          }
          $this->view("AdminLayout", $this->data);
     }
     function Delete($id)
     {
          $this->data["page"] = "DeleteManufacturer";
          $this->data['title'] = "Xóa Hảng";
          $this->data['action'] = "Delete";
          $this->data["dManu"] = $this->dManu->GetByID($id);
          if ($this->data["dManu"] == "") {
               header("Location: $this->domain/Admin/" . $this->data['controller']);
               return;
          }
          if (isset($_POST['sm'])) {
               if ($this->dManu->Delete($id)) {
                    $_SESSION['Notification'] = "Xóa thành công!";
                    header("Location: $this->domain/Admin/" . $this->data['controller']);
                    return;
               } else
                    $_SESSION['Notification'] = "Có lỗi xảy ra! Vui lòng thử lại";
          }
          $this->view("AdminLayout", $this->data);
     }
}
