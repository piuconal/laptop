<?php
class LaptopType extends Controller
{
     protected $dType;
     protected $data;
     function __construct()
     {
          $this->dType = $this->model("LaptopTypeModel");
          $this->data["domain"] = $this->domain;
          $this->data["controller"] = get_class($this);
     }
     function DefaultAction($page = 1)
    {
        $numonpage = 10;
        $this->data["page"] = "LaptopType";
        $this->data['title'] = "Laptop Type";
        $this->data['dType'] = $this->dType->Get();
        $this->data["np"] = $page;
        $this->data["tp"] = ceil(count($this->data['dType']) / $numonpage);
        $this->data['dType'] = array_splice($this->data['dType'], ($page - 1) * $numonpage, $numonpage);
        $this->view("AdminLayout", $this->data);
    }
     function Search($info = "")
     {
          if (empty($info)) {
               header("Location: $this->domain/Admin/" . $this->data['controller']);
               return;
          }
          $this->data["page"] = "Search";
          $this->data['title'] = "Loại laptop";
          $this->data['info']=$info;
          $this->data['dType'] = $this->dType->Search($info);
          $this->view("AdminLayout", $this->data);
     }
     function Add()
     {
          $this->data["page"] = "AddLaptopType";
          $this->data['title'] = "Thêm loại laptop";
          $this->data['action'] = "Add";
          if (isset($_POST['sm'])) {
               $check = $this->validate($this->dType, $_POST);
               if ($check)
                    if ($this->dType->Add($_POST['id'], $_POST['name'])) {
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
          $this->data["page"] = "EditLaptopType";
          $this->data['title'] = "Sửa loại laptop";
          $this->data['action'] = "Edit";
          $this->data['dType'] = $this->dType->GetByID($id);
          if ($this->data['dType'] == 0) {
               header("Location: $this->domain/Admin/" . $this->data['controller']);
               return;
          }
          if (isset($_POST['sm'])) {
               $check = $this->validate($this->dType, $_POST);
               if ($check) {
                    if ($this->dType->Edit($id, $_POST['name'])) {
                         $_SESSION['Notification'] = "Cập nhật thành công!";
                         header("Location: $this->domain/Admin/" . $this->data['controller']);
                         return;
                    } else
                         $_SESSION['Notification'] = "Có lỗi xảy ra! Vui lòng thử lại";
               } else
                    $_SESSION['Notification'] = "Vui lòng kiểm tra lại dữ liệu nhập!";
          }
          $this->view("AdminLayout", $this->data);
     }
     function Delete($id)
     {
          $this->data["page"] = "DeleteLaptopType";
          $this->data['title'] = "Xóa loại laptop";
          $this->data['action'] = "Delete";
          $this->data['dType'] = $this->dType->GetByID($id);
          if ($this->data['dType'] == 0) {
               header("Location: $this->domain/Admin/" . $this->data['controller']);
               return;
          }
          if (isset($_POST['sm'])) {
               if ($this->dType->Delete($id)) {
                    $_SESSION['Notification'] = "Xóa thành công!";
                    header("Location: $this->domain/Admin/" . $this->data['controller']);
                    return;
               } else
                    $_SESSION['Notification'] = "Có lỗi xảy ra! Vui lòng thử lại";
          }
          $this->view("AdminLayout", $this->data);
     }
}
