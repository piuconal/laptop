<?php
class controller
{
     public $domain = "/LaptopHT";
     function model($model)
     {
          require_once "./mvc/models/" . $model . ".php";
          return new $model;
     }

     function view($layout, $data = [])
     {
          // print_r($_SESSION);
          if (@file_exists("./mvc/views/layout/" . $layout . ".php"))
               require_once "./mvc/views/layout/" . $layout . ".php";
          else
               require_once "./mvc/views/layout/NoLayout.php";
     }
     function validate($model, $data)
     {
          $all_check = get_class_methods($model);
          $pattern = "/^Check_/i";
          foreach ($all_check as $key => $value) {
               if (preg_match($pattern, $value)) {
                    $param = explode("_", $value, 2);
                    if (!empty($data[$param[1]]))
                         if (call_user_func([$model, $value], $data[$param[1]]) != 1)
                              return 0;
               }
          }
          return 1;
     }
     function num_to_status($num)
     {
          switch ($num) {
               case 1: {
                         return  "chờ xác nhận";
                    }
               case 2: {
                         return  "xác nhận , đóng gói";
                    }
               case 3: {
                         return  "đang vận chuyển";
                    }
               case 4: {
                         return  "Đang đang giao hàng";
                    }
               case 5: {
                         return  "đã giao hàng";
                    }
               default: {
                         return  "đơn hàng bị hủy";
                    }
          };
     }
     function upSlide()
     {
          $target_dir = "images/slider/";
          $target_file = $target_dir . basename($_FILES["img_slider"]["name"]);
          $uploadOk = 1;
          $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
          $check = getimagesize($_FILES["img_slider"]["tmp_name"]);
          if ($check !== false) {
               $uploadOk = 1;
          } else {
               $uploadOk = 0;
          }
          if ($_FILES["img_slider"]["size"] > 40 * 1024 * 1024) {
               $uploadOk = 0;
          }
          if (
               $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
               && $imageFileType != "gif"
          ) {
               $uploadOk = 0;
          }
          if ($uploadOk == 0) {
          } else {
               if (move_uploaded_file($_FILES["img_slider"]["tmp_name"], $target_file)) {
                    return htmlspecialchars(basename($_FILES["img_slider"]["name"]));
               } else {
                    return 0;
               }
          }
     }
     function delSlider($file)
     {
          $file = "images/slider/$file";
          if (is_file($file)) {
               unlink($file); // delete file
          }
     }
     function upFile($folderName)
     {
          $imgdata = [];
          $target_dir = "images/$folderName/";
          $folder = "images/$folderName";
          if (!is_dir($folder))
               mkdir($folder);
          $files = glob("$folder/*"); // get all file names
          foreach ($files as $file) { // iterate files
               if (is_file($file)) {
                    unlink($file); // delete file
               }
          }
          foreach ($_FILES["img"]["name"] as $key => $value) {
               $target_file = $target_dir . basename($_FILES["img"]["name"][$key]);
               $uploadOk = 1;
               $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
               $check = getimagesize($_FILES["img"]["tmp_name"][$key]);
               if ($check !== false) {
                    // echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
               } else {
                    // echo "File is not an image.";
                    $uploadOk = 0;
               }
               // Check file size
               if ($_FILES["img"]["size"][$key] > 40 * 1024 * 1024) {
                    echo "Sorry, your file is too large.";
                    $uploadOk = 0;
               }
               // Allow certain file formats
               if (
                    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif"
               ) {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
               }
               // Check if $uploadOk is set to 0 by an error
               if ($uploadOk == 0) {
                    echo "Sorry, your file was not uploaded.";
                    // if everything is ok, try to upload file
               } else {
                    if (move_uploaded_file($_FILES["img"]["tmp_name"][$key], $target_file)) {
                         $imgdata[] = htmlspecialchars(basename($_FILES["img"]["name"][$key]));
                    } else {
                         echo "Sorry, there was an error uploading your file.";
                    }
               }
          }
          return json_encode($imgdata, JSON_UNESCAPED_UNICODE);
     }
     function delFile($folderName)
     {
          $folder = "images/$folderName";
          if (is_dir($folder)) {
               $files = glob("$folder/*"); // get all file names
               foreach ($files as $file) { // iterate files
                    if (is_file($file)) {
                         unlink($file); // delete file
                    }
               }
               rmdir($folder);
          }
     }
     function num_to_price($num)
     {
          $str = "";
          while ($num > 0) {
               $spe = substr("$num", -3, 3);
               $num = floor($num / 1000);
               if ($num > 0) {
                    $str = '.' . $spe . $str;
               } else
                    $str = $spe . $str;
          }
          return $str . 'đ';
     }
     function format_date($str)
     {
          $arr = explode(" ", $str);
          $date = $arr[0];
          $arr2 = explode("-", $date);
          return $arr[1] . " " . $arr2[2] . "-" . $arr2[1] . "-" . $arr2[0];
     }
     function convert_time($strdate)
     {
          date_default_timezone_set("Asia/Ho_Chi_Minh");
          $now = strtotime(date('Y-m-d H:i:s'));
          $dt = strtotime($strdate);
          $t = round(($now - $dt) / 60);
          if ($t < 60)
               return $t . " phút trước";
          $t = round($t / 60);
          if ($t < 24)
               return $t . " giờ trước ";
          $t = round($t / 24);
          if ($t == 1)
               return "Hôm qua";
          if ($t < 7)
               return $t . " ngày trước ";
          return $this->format_date($strdate);
     }
}
