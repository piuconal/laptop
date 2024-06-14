<?php
class Home extends Controller
{
     protected $data;
     protected $dSlider;
     protected $dManu;
     protected $dType;
     function __construct()
     {
          $this->dSlider = $this->model("SliderModel");
          $this->dManu = $this->model("ManufacturerModel");
          $this->dType = $this->model("LaptopTypeModel");
          $this->data["domain"] = $this->domain;
          $this->data["controller"] = get_class($this);
     }
     // action mặc định
     function DefaultAction()
     {
          $this->data["page"] = "Home";
          $this->data['title'] = "Trang chủ";
          $this->data['dSlider'] = $this->dSlider->Get();
          $this->data['dManu'] = $this->dManu->Get();
          $this->data['dType'] = $this->dType->Get();
          $this->view("ClientLayout", $this->data);
     }
}