<?php
class Cart extends Controller
{
     protected $dCart;
     protected $dCus;
     protected $data;
     function __construct()
     {
          $this->dCart = $this->model("CartModel");
          $this->dCus = $this->model("CustomerModel");
          $this->data["domain"] = $this->domain;
          $this->data["controller"] = get_class($this);
     }
     // action mặc định
     function DefaultAction()
     {
          $this->data["page"] = "Cart";
          $this->data['title'] = "Giỏ hàng";
          if (isset($_SESSION['user']['id'])) {
               $this->data['dCart'] = $this->dCart->GetByID_Cus($_SESSION['user']['id']);
               if (isset($_POST['delete'])) {
                    $this->dCart->Delete();
                    $this->data['dCart'] = $this->dCart->GetCart();
               }
          } else {
               header("Location: $this->domain/Login");
               return;
          }
          $this->view("ClientLayout", $this->data);
     }
}
