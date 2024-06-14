<?php
class MyOrder extends Controller
{
     protected $dOrIn;
     protected $dOrDe;
     protected $data;
     function __construct()
     {
          if (!isset($_SESSION['user'])) {
               header("Location: $this->domain/Login");
               return;
          }
          if (isset($_SESSION['user']['ad'])) {
               header("Location: $this->domain");
               return;
          }
          $this->dOrIn = $this->model("OrderInfoModel");
          $this->dOrDe = $this->model("OrderDetailsModel");
          $this->data["domain"] = $this->domain;
          $this->data["controller"] = get_class($this);
     }
     // action mặc định
     function DefaultAction()
     {
          $this->data["page"] = "MyOrder";
          $this->data['title'] = "Đơn hàng của tôi";
          if (isset($_POST['id_order']))
               if ($this->dOrIn->edit($_POST['id_order'], 0))
                    $_SESSION['notify']    = "Hủy thành công";
               else
                    $_SESSION['notify']    = "Có lỗi xảy ra! vui lòng thử lại";
          $this->data['dOrder'] = $this->dOrIn->getMyOrder($_SESSION['user']['id']);
          foreach ($this->data['dOrder'] as $key => $value) {
               $this->data['dOrder'][$key]['Details'] = $this->dOrDe->GetMyOrderDetails($value['ID_Order']);
          }

          $this->view("ClientLayout", $this->data);
     }
}
