<?php
class Laptop extends Controller
{
    protected $dLap;
    protected $dType;
    protected $dManu;
    protected $data;

    function __construct()
    {
        $this->dLap = $this->model("LaptopModel");
        $this->dType = $this->model("LaptopTypeModel");
        $this->dManu = $this->model("ManufacturerModel");
        $this->data["domain"] = $this->domain;
        $this->data["controller"] = get_class($this);
    }
    function DefaultAction($page = 1)
    {
        $numonpage = 10;
        $this->data["page"] = "Laptop";
        $this->data['title'] = "Laptop";
        $this->data['dLap'] = $this->dLap->GetFullInfo();
        $this->data["np"] = $page;
        $this->data["tp"] = ceil(count($this->data['dLap']) / $numonpage);
        $this->data['dLap'] = array_splice($this->data['dLap'], ($page - 1) * $numonpage, $numonpage);
        $this->view("AdminLayout", $this->data);
    }
    function Search($info = "")
    {
        if (empty($info)) {
            header("Location: $this->domain/Admin/" . $this->data['controller']);
            return;
        }
        $this->data["page"] = "Search";
        $this->data['title'] = "Laptop";
        $this->data['info'] = $info;
        $this->view("AdminLayout", $this->data);
    }
    function Add()
    {
        $this->data["page"] = "AddLaptop";
        $this->data['title'] = "Thêm laptop";
        $this->data['action'] = "Add";
        $this->data['dType'] = $this->dType->Get();
        $this->data['dManu'] = $this->dManu->Get();
        if (isset($_POST['sm'])) {
            $check = $this->validate($this->dLap, $_POST);
            $img = $this->upFile($_POST['id']);
            $ram = json_encode(array("memRAM" => $_POST['memRAM'], "typeRAM" => $_POST['typeRAM'], "busRAM" => $_POST['busRAM'], "maxRAM" => $_POST['maxRAM']), JSON_UNESCAPED_UNICODE);
            $screen = json_encode(array("sizeSC" => $_POST['sizeSC'], "resoSC" => $_POST['resoSC'], "freSC" => $_POST['freSC'], "techSC" => $_POST['techSC']), JSON_UNESCAPED_UNICODE);
            $connection = json_encode(array("port" => $_POST['port'], "wireless" => $_POST['wireless']), JSON_UNESCAPED_UNICODE);
            $other_feature = json_encode(array("webcam" => $_POST['webcam'], "ledKB" => $_POST['ledKB'], "otherF" => $_POST['otherF']), JSON_UNESCAPED_UNICODE);
            if ($check)
                if ($this->dLap->Add($_POST['id'], $_POST['name'], $_POST['price'], $_POST['insu'], $_POST['type'], $_POST['manu'], $img, $_POST['cpu'], $_POST['gpu'], $ram, $_POST['disk'], $screen, $_POST['audio'], $connection, $other_feature, $_POST['d_w'], $_POST['material'], $_POST['pin'], $_POST['os'], $_POST['release'])) {
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
        $this->data["page"] = "EditLaptop";
        $this->data['title'] = "Sửa laptop";
        $this->data['action'] = "Edit";
        $this->data['dType'] = $this->dType->Get();
        $this->data['dManu'] = $this->dManu->Get();
        $this->data["dLap"] = $this->dLap->GetByID($id);
        if ($this->data["dLap"] == 0) {
            header("Location: $this->domain/Admin/" . $this->data['controller']);
            return;
        }
        if (isset($_POST['sm'])) {
            $check = $this->validate($this->dLap, $_POST);
            if ($_FILES['img']['name'][0] != '')
                $img = $this->upFile($id);
            else $img = $this->data['dLap']['Images'];
            $ram = json_encode(["memRAM" => $_POST['memRAM'], "typeRAM" => $_POST['typeRAM'], "busRAM" => $_POST['busRAM'], "maxRAM" => $_POST['maxRAM']], JSON_UNESCAPED_UNICODE);
            $screen = json_encode(["sizeSC" => $_POST['sizeSC'], "resoSC" => $_POST['resoSC'], "freSC" => $_POST['freSC'], "techSC" => $_POST['techSC']], JSON_UNESCAPED_UNICODE);
            $connection = json_encode(["port" => $_POST['port'], "wireless" => $_POST['wireless']]);
            $other_feature = json_encode(["webcam" => $_POST['webcam'], "ledKB" => $_POST['ledKB'], "otherF" => $_POST['otherF']], JSON_UNESCAPED_UNICODE);
            if ($check)
                if ($this->dLap->Edit($id, $_POST['name'], $_POST['price'], $_POST['insu'], $_POST['type'], $_POST['manu'], $img, $_POST['cpu'], $_POST['gpu'], $ram, $_POST['disk'], $screen, $_POST['audio'], $connection, $other_feature, $_POST['d_w'], $_POST['material'], $_POST['pin'], $_POST['os'], $_POST['release'])) {
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
        $this->data["page"] = "DeleteLaptop";
        $this->data['title'] = "Xóa laptop";
        $this->data['action'] = "Delete";
        $this->data["dLap"] = $this->dLap->GetByID($id);
        if ($this->data["dLap"] == 0) {
            header("Location: $this->domain/Admin/" . $this->data['controller']);
            return;
        }
        if (isset($_POST['sm'])) {
            if ($this->dLap->Delete($id)) {
                $_SESSION['Notification'] = "Xóa thành công!";
                $this->delFile($id);
                header("Location: $this->domain/Admin/" . $this->data['controller']);
                return;
            } else
                $_SESSION['Notification'] = "Có lỗi xảy ra! Vui lòng thử lại";
        }
        $this->view("AdminLayout", $this->data);
    }
}
