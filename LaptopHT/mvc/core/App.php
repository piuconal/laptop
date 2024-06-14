<?php
class App
{
     protected $domain;
     protected $area;
     protected $controller = "Home";
     protected $action = "DefaultAction";
     protected $params = [];
     function __construct()
     {
          $arr = $this->UrlProcess();
          $control = new Controller();
          $this->domain = $control->domain;
          // Xử lý Controllers
          $dir = "./mvc/controllers/client";
          if (isset($arr[0])) {
               if (strtolower(trim($arr[0])) == "admin") {
                    $dir = "./mvc/controllers/admin";
                    $this->area = "Admin";
                    array_splice($arr, 0, 1);
               }
               if (@file_exists("$dir/$arr[0].php"))
                    $this->controller = $arr[0];
               else {
                    $dir = "./mvc/controllers";
                    if (@file_exists("$dir/$arr[0].php"))
                         $this->controller = $arr[0];
                    else
                         if ($this->area != "Admin") {
                         header("Location: $this->domain");
                         return;
                    } else {
                         header("Location: $this->domain/Admin/Laptop");
                         return;
                    }
               }
               array_splice($arr, 0, 1);
          }
          require_once "$dir/$this->controller" . ".php";
          // xử lý Action
          if (isset($arr[0]))
               if (method_exists($this->controller, $arr[0]) && !method_exists("Controller", $arr[0])) {
                    $this->action = $arr[0];
                    array_splice($arr, 0, 1);
               }
          // Xử lý params
          if ($arr != [])
               $this->params = $arr;
          $this->PreviousPage(); // lưu lịch sử duyệt web 
          // echo ($this->controller);
          // echo ("</br>");
          // echo ($this->action);
          // echo ("</br>");
          // print_r($this->params);
          // print_r($_SESSION);
          $this->BlockAccessAdmin();
          $this->VerifyTimeOut();
          $this->controller = new $this->controller;
          call_user_func_array([$this->controller, $this->action], $this->params);
     }
     function UrlProcess()
     {
          if (isset($_GET['url'])) {
               return explode('/', filter_var(trim($_GET['url'], '/')));
          }
     }
     function BlockAccessAdmin()
     {
          if ($this->area == "Admin" && $this->controller != "Login") {
               if (!isset($_SESSION['user']['ad']) && !isset($_SESSION['user'])) {
                    header("Location: $this->domain/Admin/Login");
                    return;
               }
               if (!isset($_SESSION['user']['ad']) && isset($_SESSION['user'])) {
                    header("Location: $this->domain");
                    return;
               }
          }
     }
     function PreviousPage()
     {
          $url = @$_GET['url'];
          if (strlen(strstr($url, "Ajax")) <= 0  && strlen(strstr($url, "Login")) <= 0)
               $_SESSION['url'] = $url;
     }
     function VerifyTimeOut()
     {
          if (isset($_SESSION['verify'])) {
               date_default_timezone_set("Asia/Ho_Chi_Minh");
               $now = strtotime(date('Y-m-d H:i:s'));
               $dt = strtotime($_SESSION['verify']['time']);
               if($now - $dt>=300)
                  unset($_SESSION['verify']);  
          }
     }
}
