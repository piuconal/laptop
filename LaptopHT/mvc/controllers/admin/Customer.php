<?php
class Customer extends Controller
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
    function DefaultAction($page = 1)
    {
        $numonpage = 10;
        $this->data["page"] = "Customer";
        $this->data['title'] = "Khách hàng";
        $this->data['dCus'] = $this->dCus->Get();
        $this->data["np"] = $page;
        $this->data["tp"] = ceil(count($this->data['dCus']) / $numonpage);
        $this->data['dCus'] = array_splice($this->data['dCus'], ($page - 1) * $numonpage, $numonpage);
        $this->view("AdminLayout", $this->data);
    }
    function Search($info)
    {
        if (empty($info)) {
            header("Location: $this->domain/Admin/" . $this->data['controller']);
            return;
        }
        $this->data["page"] = "Search";
        $this->data['title'] = "Customer";
        $this->data['info'] = $info;
        $this->view("AdminLayout", $this->data);
    }

    function Edit($id)
    {
        $this->data["page"] = "EditCustomer";
        $this->data['title'] = "Sửa khách hàng";
        $this->data['action'] = "Edit";
        $this->data["dCus"] = $this->dCus->GetByID($id);
        $this->data['dProvince'] = $this->dAddress->GetProvince();
        if (isset($_POST['sm'])) {
            if ($this->validate($this->dCus, $_POST))
                if ($this->dCus->updateBaseInfo($id, $_POST['firstname'], $_POST['lastname'], $_POST['phone'], $_POST['email'])) {
                    $_SESSION['Notification'] = "Cập nhật thành công";
                } else
                    $_SESSION['Notification'] = "Có lỗi xảy ra! vui lòng thử lại";
            else
                $_SESSION['Notification'] = "Vui lòng kiểm tra lại dữ liệu";
        }
        if (isset($_POST['sm_changeAddress'])) {
            $address = $this->dAddress->GetAddress($_POST['province'], $_POST['district'], $_POST['ward']);
            $address = $_POST['spe'] . ", ". $address;
            if ($this->dCus->updateAddress($id, $address))
                $_SESSION['Notification'] = "Cập nhật thành công";
            else
                $_SESSION['Notification'] = "Có lỗi xảy ra! vui lòng thử lại";
        }
        if (isset($_POST['sm_changePassword'])) {
            if ($this->validate($this->dCus, $_POST)) {
                if ($_POST['password'] == $_POST['confirmPassword'] && $this->dCus->updatePassword($id, $_POST['password']))
                    $_SESSION['Notification'] = "Cập nhật thành công";
                else
                    $_SESSION['Notification'] = "Có lỗi xảy ra! vui lòng thử lại";
            }
        }
        if(@$_POST!=[])
            $this->data["dCus"] = $this->dCus->GetByID($id);
        $this->view("AdminLayout", $this->data);
    }
    function Delete($id)
    {
        $this->data["page"] = "DeleteCustomer";
        $this->data['title'] = "Xóa khách hàng";
        $this->data['action'] = "Delete";
        $this->data["customer"] = $this->dCus->GetByID($id);
        if (isset($_POST['sm'])) {
            if ($this->dCus->Delete($id)) {
                $_SESSION['Notification'] = "Xóa thành công!";
                header("Location: $this->domain/Admin/" . $this->data['controller']);
                return;
            } else
                $_SESSION['Notification'] = "Có lỗi xảy ra! Vui lòng thử lại";
        }
        $this->view("AdminLayout", $this->data);
    }
}
