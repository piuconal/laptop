<?php
class Search extends Controller
{
     protected $dManu;
     protected $dType;
     protected $data;
     function __construct()
     {
          $this->data["domain"] = $this->domain;
          $this->data["controller"] = get_class($this);
          $this->dManu = $this->model("ManufacturerModel");
          $this->dType = $this->model("LaptopTypeModel");
     }
     function DefaultAction($info = "")
     {
          $this->data["page"] = "Search";
          $this->data['title'] = "Tìm kiếm";
          $this->data['dManu'] = $this->dManu->Get();
          $this->data['dType'] = $this->dType->Get();
          $this->data['info'] = $info;
          if (empty($info)) {
               header("Location: $this->domain");
               return;
          } else
               $this->view("ClientLayout", $this->data);
     }
}
