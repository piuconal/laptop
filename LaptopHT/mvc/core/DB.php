<?php
class DB
{
     protected $con;
     protected $servername = "localhost";
     protected $username = "root";
     protected $password = "";
     protected $dbname = "laptop_db";
     function __construct()
     {
          $this->con = mysqli_connect($this->servername, $this->username, $this->password);
          mysqli_select_db($this->con, $this->dbname);
          mysqli_query($this->con, "SET NAMES 'utf8'");
     }
     function Check($val, $minLen, $maxLen, $char = 213) //char gồm 3 số ghép lại
     {
          $valLen = strlen($val);
          if ($valLen < $minLen || $valLen > $maxLen) {
               if ($valLen < 1)
                    return "Không được để trống";
               if ($valLen > $maxLen && $minLen < 1)
                    return "Độ dài không được quá $maxLen ký tự";
               if ($minLen == $maxLen)
                    return "Độ dài chỉ được $minLen ký tự";
               else
                    return "Độ dài chỉ được từ $minLen đến $maxLen ký tự";
          }
          $c3 = $char % 10; // chứa sô
          $char = floor($char / 10);
          $c2 = $char % 10; // chứa khoảng trắng
          $char = floor($char / 10);
          $c1 = $char % 10; // chứa chữ cái
          if ($c3 == 0) {
               $pattern = "/^([a-zA-Z0-9ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+)$/i";
               if (!preg_match($pattern, $val)) return "Không gồm ký tự đặc biệt";
          } else
          if ($c3 == 1) {
               $pattern = "/^([a-zA-Z0-9ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s_\.]+)$/i";
               if (!preg_match($pattern, $val)) return "Không gồm ký tự đặc biệt ngoài _ .";
          }
          if ($c3 == 2) {
               $pattern = "/^([a-zA-Z0-9ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s_\.`~!@#$%^&*\-]+)$/i";
               if (!preg_match($pattern, $val)) return "Không gồm ký tự đặc biệt ngoài _.`~!@#$%^&*-";
          }
          if ($c2 == 0) {
               $pattern = "/[0-9]/i";
               if (preg_match($pattern, $val)) return "Không gồm chữ số";
          }
          if ($c1 == 0) {
               $pattern = "/[a-zA-zÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]/i";
               if (preg_match($pattern, $val)) return "Không gồm chữ cái";
          }
          if ($c1 == 1) {
               $pattern = "/[ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ]/i";
               if (preg_match($pattern, $val)) return "Không gồm chữ có dấu";
          }
          return 1;
     }
}
