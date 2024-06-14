<?php
class Slider extends Controller
{
    protected $dSlider;
    protected $data;
    function __construct()
    {
        $this->dSlider = $this->model("SliderModel");
        $this->data["domain"] = $this->domain;
        $this->data["controller"] = get_class($this);
    }
    // action mặc định
    function DefaultAction()
    {
        $this->data["page"] = "Slider";
        $this->data['title'] = "Giỏ hàng";
        $this->data['dSlider'] = $this->dSlider->Get();
        $this->view("AdminLayout", $this->data);
    }
    function Add()
    {
        $this->data["page"] = "AddSlider";
        $this->data['title'] = "Thêm slide";
        $this->data['action'] = "Add";
        if (isset($_POST['sm'])) {
            if (!empty(@$_FILES['img_slider']['name'])) {
                $img = $this->upSlide();
                if (!is_numeric($_POST['status']))
                    $_POST['status'] = 0;
                if ($this->dSlider->Add($_POST['title'], $img, $_POST['status']) && $img != 0) {
                    $_SESSION['Notification'] = "Thêm thành công!";
                    header("Location: $this->domain/Admin/" . $this->data['controller']);
                    return;
                } else
                    $_SESSION['Notification'] = "Có lỗi xảy ra! Vui lòng thử lại";
            } else
                $_SESSION['Notification'] = "Vui lòng nhập file";
        }
        $this->view("AdminLayout", $this->data);
    }
    function Edit($id)
    {
        $this->data["page"] = "EditSlider";
        $this->data['title'] = "Sửa slide";
        $this->data['action'] = "Edit";
        $this->data['dSlider'] = $this->dSlider->GetByID($id);
        if ($this->data['dSlider'] == 0) {
            header("Location: $this->domain/Admin/" . $this->data['controller']);
            return;
        }
        if (isset($_POST['sm'])) {
            if (!is_numeric($_POST['status']))
                $_POST['status'] = 0;
            $change_img = !empty($_FILES['img_slider']['name']);
            if ($change_img)
                $img = $this->upSlide();
            else
                $img = $this->data['dSlider']['Image'];
            if ($this->dSlider->Edit($id, $_POST['title'], $img, $_POST['status']) && $img != 0) {
                $_SESSION['Notification'] = "Sửa thành công!";
                if($change_img)
                    $this->delSlider($this->data['dSlider']['Image']);
                header("Location: $this->domain/Admin/" . $this->data['controller']);
                return;
            } else {
                $_SESSION['Notification'] = "Có lỗi xảy ra! Vui lòng thử lại";
            }
        }
        $this->view("AdminLayout", $this->data);
    }
    function Delete($id)
    {
        $this->data["page"] = "DeleteSlider";
        $this->data['title'] = "Xóa slide";
        $this->data['action'] = "Delete";
        $this->data['dSlider'] = $this->dSlider->GetByID($id);
        if ($this->data['dSlider'] == 0) {
            header("Location: $this->domain/Admin/" . $this->data['controller']);
            return;
        }
        if (isset($_POST['sm'])) {
            if ($this->dSlider->Delete($id)) {
                $img = $this->data['dSlider']['Image'];
                $this->delSlider($img);
                $_SESSION['Notification'] = "Xóa thành công!";
                header("Location: $this->domain/Admin/" . $this->data['controller']);
                return;
            } else
                $_SESSION['Notification'] = "Có lỗi xảy ra! Vui lòng thử lại";
        }
        $this->view("AdminLayout", $this->data);
    }
}
