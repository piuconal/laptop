<?php
class LaptopDetails extends Controller
{
    protected $dLap;
    protected $dComm;
    protected $dCart;
    protected $data;

    function __construct()
    {
        $this->dLap = $this->model("LaptopModel");
        $this->dComm = $this->model("CommentModel");
        $this->dCart = $this->model("CartModel");
        $this->data["domain"] = $this->domain;
        $this->data["controller"] = get_class($this);
    }
    function DefaultAction($id)
    {
        $this->data["page"] = "LaptopDetails";
        $this->data["title"] = "Chi tiết sản phẩm";
        // $this->data['dComm'] = $this->dComm->GetCommByID_Lap($id);
        $this->data['dLap'] = $this->dLap->GetFullInfoByID($id);
        $this->view("ClientLayout", $this->data);
    }
}
