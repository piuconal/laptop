<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Ajax extends controller
{
     function __construct()
     {
     }
     public function Check_Input()
     {
          $val = $_POST['val'];
          $md = $this->model($_POST['md'] . "Model");
          $this->mt = "Check_" . $_POST['fn'];
          $mess = 1;
          if (method_exists($md, $this->mt))
               $mess = call_user_func_array([$md, $this->mt], [$val]);
          else
               $mess = $md->check($val, 0, 255);
          if ($mess == 1)
               echo json_encode(["<i class='bi bi-check2-circle'></i>"]);
          else {
               echo json_encode([$mess, 0]);
          }
     }
     public function GetDistrict($id)
     {
          $md = $this->model("AddressModel");
          echo json_encode($md->GetDistrict($id), JSON_UNESCAPED_UNICODE);
     }
     public function GetWard($id)
     {
          $md = $this->model("AddressModel");
          echo json_encode($md->GetWard($id), JSON_UNESCAPED_UNICODE);
     }
     public function GetNumPro()
     {
          $md = $this->model("CartModel");
          if (isset($_SESSION['user']['id']) && !isset($_SESSION['user']['ad']))
               echo $md->GetNumPro($_SESSION['user']['id']);
          else
               echo 0;
     }



     public function AddCart($id_lap)
     {
          if (!isset($_SESSION['user'])) {
               echo json_encode("vui lòng đăng nhập để thêm hàng vào giỏ", JSON_UNESCAPED_UNICODE);
               return;
          }
          $md = $this->model("CartModel");
          echo json_encode($md->AddCart($id_lap, $_SESSION['user']['id']), JSON_UNESCAPED_UNICODE);
     }
     public function Comment($id_Lap, $id_Cus)
     {
          $content = "" . @$_POST['content'];
          $md = $this->model("CommentModel");
          $this->convert_time($md->AddComment($id_Lap, $id_Cus, $content));
     }
     public function Load_Comments($id_lap, $vt)
     {
          $md = $this->model("CommentModel");
          $dCom = $md->GetCommByID_Lap($id_lap, $vt);
          foreach ($dCom as $key => $value) {
               $time_comm = $this->convert_time($value['Time_Comm']);
               echo "
                    <div class='border rounded p-2 m-2 comment' style='background: #fff;'>
                         <div>
                              <img src='$this->domain/images/shared/avatardefault.png' class='rounded-circle' style='width:50px; height:50px;' />
                              <span class='fw-bold name_cm'>$value[First_Name] $value[Last_Name]</span>        
                         </div>
                         <div>
                              <p class='ct_cm' style='margin-left:50px;'>$value[Content]</p>
                              <p align = 'right'> <small class='small text-muted'>$time_comm</small></p>
                         </div>
                    </div>
               ";
          }
     }
     public function Update_Cart($id_lap, $quantity)
     {
          $md = $this->model("CartModel");
          echo json_encode($md->Edit($id_lap, $_SESSION['user']['id'], $quantity), JSON_UNESCAPED_UNICODE);
     }
     public function Remove_Form_Cart($id_lap)
     {
          $md = $this->model("CartModel");
          if ($md->Delete($id_lap, $_SESSION['user']['id']))
               echo "Deleted";
     }
     public function Get_Laptop($vt, $a = "Add_Time", $o = "DESC")
     {
          $md = $this->model("LaptopModel");
          $dLap = $md->GetForHome($vt, $a, $o);
          foreach ($dLap as $key => $value) {
               $id = $value['ID_Lap'];
               $images = json_decode($value['Images']);
               $name = $value['Name_Lap'];
               $price = $this->num_to_price($value['Price']);
               $screen = json_decode($value['Screen'], 1);
               $cpu = $value['CPU'];
               $gpu = $value['GPU'];
               $pin = $value['Battery'];
               $ram = json_decode($value['RAM'], 1);
               echo "
               <a class='laptop' href='$this->domain/LaptopDetails/$id' style='text-decoration: none; color: black'>
                    <div class='col border h-100 p-1 rounded' style='background-color: white'>
                    <div class='card mb-1 m-0 p-0 border-0'>
                         <div>
                              <img src='$this->domain/images/$id/$images[0]' class='card-img-top' style='max-height:200px;'>
                              <h5 class='card-title overflow-hidden m-0 p-0' style='white-space: nowrap;'>$name </h5>
                         </div>
                         <div>
                              <div class='card-body '>
                                   <h5 class='card-title text-danger text-end '>$price</h5>
                                   <div class='row'>
                                        <label class='card-title col-md-4 col-label'>Màn hình</label>
                                        <div class='col-md-8'>
                                        <p class='card-text'>$screen[sizeSC], $screen[resoSC], $screen[freSC]</p>
                                        </div>
                                        <label class='card-title col-md-4 col-label'>CPU</label>
                                        <div class='col-md-8'>
                                        <p class='card-text'>$cpu</p>
                                        </div>
                                        <label class='card-title col-md-4 col-label'>GPU</label>
                                        <div class='col-md-8'>
                                        <p class='card-text'>$gpu</p>
                                        </div>
                                        <label class='card-title col-md-4 col-label'>RAM</label>
                                        <div class='col-md-8'>
                                        <p class='card-text'>$ram[memRAM]</p>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
                    </div>
               </a>
               ";
          }
     }
     public function Get_Search_Laptop($info, $vt, $a, $o)
     {
          $md = $this->model("LaptopModel");
          $dLap = $md->Search($info, $vt, $a, $o);
          foreach ($dLap as $key => $value) {
               $id = $value['ID_Lap'];
               $images = json_decode($value['Images']);
               $name = $value['Name_Lap'];
               $price = $this->num_to_price($value['Price']);
               $screen = json_decode($value['Screen'], 1);
               $cpu = $value['CPU'];
               $gpu = $value['GPU'];
               $pin = $value['Battery'];
               $ram = json_decode($value['RAM'], 1);
               echo "
               <a class='laptop' href='$this->domain/LaptopDetails/$id' style='text-decoration: none; color: black'>
                    <div class='col border h-100 p-1 rounded' style='background-color: white'>
                    <div class='card mb-2 row m-0 border-0'>
                         <div class='ml-3'>
                              <img src='$this->domain/images/$id/$images[0]' class='card-img-top' style='max-height:200px;'>
                              <h5 class='card-title overflow-hidden m-0 p-0' style='white-space: nowrap;'>$name </h5>
                         </div>
                         <div>
                              <div class='card-body '>
                                   <h5 class='card-title text-danger text-end '>$price</h5>
                                   <div class='row'>
                                        <label class='card-title col-md-4 col-label'>Màn hình</label>
                                        <div class='col-md-8'>
                                        <p class='card-text'>$screen[sizeSC], $screen[resoSC], $screen[freSC]</p>
                                        </div>
                                        <label class='card-title col-md-4 col-label'>CPU</label>
                                        <div class='col-md-8'>
                                        <p class='card-text'>$cpu</p>
                                        </div>
                                        <label class='card-title col-md-4 col-label'>GPU</label>
                                        <div class='col-md-8'>
                                        <p class='card-text'>$gpu</p>
                                        </div>
                                        <label class='card-title col-md-4 col-label'>RAM</label>
                                        <div class='col-md-8'>
                                        <p class='card-text'>$ram[memRAM]</p>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
                    </div>
               </a>
               ";
          }
     }

     public function SendMail()
     {
          $email = $_POST['em'];
          require './lib/PHPMailer/src/Exception.php';
          require './lib/PHPMailer/src/PHPMailer.php';
          require './lib/PHPMailer/src/SMTP.php';
          date_default_timezone_set("Asia/Ho_Chi_Minh");
          if (isset($_SESSION['verify'])) {
               $now = strtotime(date('Y-m-d H:i:s'));
               $dt = strtotime($_SESSION['verify']['time']);
               if ($now - $dt >= 60)
                    unset($_SESSION['verify']);
               else
                    {
                         echo "vui lòng thử lại sau 1 phút";
                         return;
                    }
          }
          $_SESSION['verify']['code'] = "";
          $_SESSION['verify']['email'] = $email;
          $_SESSION['verify']['time'] = date('Y-m-d H:i:s');
          for ($i = 1; $i <= 6; $i++) {
               $_SESSION['verify']['code'] .= rand(0, 9);
          }
          $mail = new PHPMailer(true);
          try {
               $mail->SMTPDebug = 0;                      //Enable verbose debug output
               $mail->isSMTP();                                            //Send using SMTP
               $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
               $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
               $mail->Username   = 'laptopht18062910@gmail.com';                     //SMTP username
               $mail->Password   = 'LaptopHT18062910';                               //SMTP password
               $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
               $mail->Port       = 465;
               $mail->CharSet  = 'UTF-8';                                //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
               $mail->setFrom('LaptopHT@gmal.com', 'LaptopHT');
               $mail->addAddress("$email");     //Add a recipient
               //Content
               $mail->isHTML(true);                                  //Set email format to HTML
               $mail->Subject = 'Mã Xác nhận';
               $mail->Body    = '<h1>Mã xác nhận của bạn là: <b style="color:red">' . $_SESSION['verify']['code'] . '</b></h1> <p> Mã tồn tại trong 5 phút</p><p>Vui lòng không tiết lộ thông tin này với bất kì ai</p>';
               $mail->send();
               echo "Đã gửi mã xác nhận vui lòng kiểm tra lại email đã nhập";
          } catch (Exception $e) {
               unset($_SESSION['verify']);
               echo "Vui lòng nhập chính xác email";
          }
     }
}
