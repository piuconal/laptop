<?php
class Cart extends Controller
{
    protected $dCart;
    protected $data;
    function __construct()
    {
        $this->dCart = $this->model("CartModel");
        $this->data["domain"] = $this->domain;
        $this->data["controller"] = get_class($this);
    }
    // action mặc định
    function DefaultAction($page = 1)
    {
        $numonpage = 10;
        $this->data["page"] = "Cart";
        $this->data['title'] = "Giỏ hàng";
        $this->data['dCart'] = $this->dCart->GetFullInfo();
        $this->data["np"] = $page;
        $this->data["tp"] = ceil(count($this->data['dCart']) / $numonpage);
        $this->data['dCart'] = array_splice($this->data['dCart'], ($page - 1) * $numonpage, $numonpage);
        $this->view("AdminLayout", $this->data);
    }
    function Search($info)
    {
        if (empty($info)) {
            header("Location: /$this->domain/Admin/" . $this->data['controller']);
            return;
        }
        $this->data["page"] = "Search";
        $this->data['title'] = "Giỏ hàng";
        $this->data['info'] = $info;
        $this->view("AdminLayout", $this->data);
    }
}
