<?php
class Admin extends Controller
{
    protected $dAdmin;
    protected $data;
    function __construct()
    {
        $this->dAdmin = $this->model("AdminModel");
        $this->data["domain"] = $this->domain;
        $this->data["controller"] = get_class($this);
    }
    // action mặc định
    function DefaultAction()
    {
        $this->data["page"] = "Admin";
        $this->data['title'] = "Quản trị";
        $this->data['dAdmin'] = $this->dAdmin->Get();
        $this->view("AdminLayout", $this->data);
    }
}
