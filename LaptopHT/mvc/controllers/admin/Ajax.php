<?php
class Ajax extends controller
{
     function Get_Search_Laptop()
     {
          $numonpage = 10;
          $info = @$_POST['info'];
          $vt = @$_POST['vt'];
          $vt = $vt * $numonpage;
          $md = $this->model("LaptopModel");
          $data = $md->GetFullInfo();
          $sa = ["ID_Lap", "Name_Lap", "Insurance", "Price", "Name_Type", "Name_Type", "Release_Time", "Add_Time"]; // các thuộc tính sẽ kiểm tra
          foreach ($data as $key => $value) {
               $data[$key]['Add_Time'] = $this->format_date($value['Add_Time']);
               $data[$key]['Price'] = $this->num_to_price($value['Price']);
          }
          $kq = [];
          foreach ($data as $key => $value) {
               foreach ($value as $key => $val) {
                    if (in_array($key, $sa)) {
                         $pattern = "/$info/i";
                         if (preg_match($pattern, $val)) {
                              $kq[] = $value;
                              break;
                         }
                    }
               }
          }
          $numkq = count($kq);
          $data = array_splice($kq, $vt, $numonpage);
          $list_laptop = "";
          foreach ($data as $key => $value) {
               $images = json_decode($value['Images']);
               $stt = $vt + $key + 1;
               $list_laptop .= "<tr align='center' id_lap='$value[ID_Lap]'>
                         <td>$stt</td>
                         <td >$value[ID_Lap]</td>
                         <td><img class='col' src='$this->domain/images/$value[ID_Lap]/$images[0]' style='max-height:80px;'/></td>
                         <td class='fw-bold'>$value[Name_Lap]</td>
                         <td class='text-danger'>$value[Price]</td>
                         <td '>$value[Insurance]</td>
                         <td class='text-primary fw-bold'>$value[Name_Type]</td>
                         <td class='text-success fw-bold'>$value[Name_Manu]</td>
                         <td>$value[Release_Time]</td>
                         <td>$value[Add_Time]</td>
                         <td>
                              <a href='$this->domain/Admin/Laptop/Edit/$value[ID_Lap]'><i class='bi bi-pencil-square btn btn-success rounded-circle shadow-lg' style='color:white; font-size: 20px;'></i></a>
                              <a href='$this->domain/Admin/Laptop/Delete/$value[ID_Lap]'><i class='bi bi-trash-fill btn btn-danger rounded-circle shadow-lg' style='color:white; font-size: 20px;'></i></a>  
                         </td>
                    </tr>";
          }
          echo json_encode([$list_laptop, $numkq], JSON_UNESCAPED_UNICODE);
     }
     function Get_Search_Order()
     {
          $numonpage = 10;
          $info = @$_POST['info'];
          $vt = @$_POST['vt'];
          $vt = $vt * $numonpage;
          $md = $this->model("OrderInfoModel");
          $data = $md->GetFullInfo();
          $sa = ["ID_Order", "First_Name", "Last_Name", "Time_Order"];
          foreach ($data as $key => $value) {
               $data[$key]['Time_Order'] = $this->format_date($value['Time_Order']);
               $data[$key]['Status_Order'] = $this->num_to_status($value['Status_Order']);
          }
          $kq = [];
          foreach ($data as $key => $value) {
               foreach ($value as $key => $val) {
                    if (in_array($key, $sa)) {
                         $pattern = "/$info/i";
                         if (preg_match($pattern, $val)) {
                              $kq[] = $value;
                              break;
                         }
                    }
               }
          }
          $numkq = count($kq);
          $data = array_splice($kq, $vt, $numonpage);
          $list = "";
          foreach ($data as $key => $value) {
               $stt = $vt + $key + 1;
               $list .= "<tr align='center'>
                         <td>$stt</td>
                         <td>$value[ID_Order]</td>
                         <td>$value[First_Name]</td>
                         <td>$value[Last_Name]</td>
                         <td>$value[Time_Order]</td>
                         <td>$value[Status_Order]</td>
                         <td>
                              <a class='fs-5 btn btn-outline-dark py-0' href='$this->domain/Admin/OrderInfo/OrderDetails/$value[ID_Order]'><i class='bi bi-ticket-detailed-fill' style='color:red'></i></a>
                         </td>
                    </tr>";
          }
          echo json_encode([$list, $numkq], JSON_UNESCAPED_UNICODE);
     }
     function Get_Search_LaptopType()
     {
          $numonpage = 10;
          $info = @$_POST['info'];
          $vt = @$_POST['vt'];
          $vt = $vt * $numonpage;
          $md = $this->model("LaptopTypeModel");
          $data = $md->Get();
          $kq = [];
          foreach ($data as $key => $value) {
               foreach ($value as $key => $val) {
                    $pattern = "/$info/i";
                    if (preg_match($pattern, $val)) {
                         $kq[] = $value;
                         break;
                    }
               }
          }
          $numkq = count($kq);
          $data = array_splice($kq, $vt, $numonpage);
          $list = "";
          foreach ($data as $key => $value) {
               $stt = $vt + $key + 1;
               $list .= "<tr align='center'>
                              <td>$stt</td>
                              <td>$value[ID_Type]</td>
                              <td>$value[Name_Type]</td>
                              <td>
                                   <a href='$this->domain/Admin/LaptopType/Edit/$value[ID_Type]'><i class='bi bi-pencil-square btn btn-success rounded-circle shadow-lg' style='color:white; font-size: 20px;'></i></a>
                                   <a href='$this->domain/Admin/LaptopType/Delete/$value[ID_Type]'><i class='bi bi-trash-fill btn btn-danger rounded-circle shadow-lg' style='color:white; font-size: 20px;'></i></a>               
                              </td>
                         </tr>";
          }
          echo json_encode([$list, $numkq], JSON_UNESCAPED_UNICODE);
     }
     function Get_Search_Manufacturer()
     {
          $numonpage = 10;
          $info = @$_POST['info'];
          $vt = @$_POST['vt'];
          $vt = $vt * $numonpage;
          $md = $this->model("ManufacturerModel");
          $data = $md->Get();
          $kq = [];
          foreach ($data as $key => $value) {
               foreach ($value as $key => $val) {
                    $pattern = "/$info/i";
                    if (preg_match($pattern, $val)) {
                         $kq[] = $value;
                         break;
                    }
               }
          }
          $numkq = count($kq);
          $data = array_splice($kq, $vt, $numonpage);
          $list = "";
          foreach ($data as $key => $value) {
               $stt = $vt + $key + 1;
               $list .= "<tr align='center'>
                         <td>$stt</td>
                         <td>$value[ID_Manu]</td>
                         <td>$value[Name_Manu]</td>
                         <td>
                              <a href='$this->domain/Admin/Manufacturer/Edit/$value[ID_Manu]'><i class='bi bi-pencil-square btn btn-success rounded-circle shadow-lg' style='color:white; font-size: 20px;'></i></a> 
                              <a href='$this->domain/Admin/Manufacturer/Delete/$value[ID_Manu]'><i class='bi bi-trash-fill btn btn-danger rounded-circle shadow-lg' style='color:white; font-size: 20px;'></i></a>               
                         </td>
                    </tr>";
          }
          echo json_encode([$list, $numkq], JSON_UNESCAPED_UNICODE);
     }
     function Get_Search_Cart()
     {
          $numonpage = 10;
          $info = @$_POST['info'];
          $vt = @$_POST['vt'];
          $vt = $vt * $numonpage;
          $md = $this->model("CartModel");
          $data = $md->GetFullInfo();
          $kq = [];
          foreach ($data as $key => $value) {
               foreach ($value as $key => $val) {
                    $pattern = "/$info/i";
                    if (preg_match($pattern, $val)) {
                         $kq[] = $value;
                         break;
                    }
               }
          }
          $numkq = count($kq);
          $data = array_splice($kq, $vt, $numonpage);
          $list = "";
          foreach ($data as $key => $value) {
               $stt = $vt + $key + 1;
               $list .= "<tr align='center'>
                              <td>$stt</td>
                              <td>$value[First_Name]</td>
                              <td> $value[Last_Name]</td>
                              <td>$value[Name_Lap]</td>
                              <td>$value[Quantity]</td>
                         </tr>";
          }
          echo json_encode([$list, $numkq], JSON_UNESCAPED_UNICODE);
     }
     function Get_Search_Customer()
     {
          $numonpage = 10;
          $info = @$_POST['info'];
          $vt = @$_POST['vt'];
          $vt = $vt * $numonpage;
          $md = $this->model("CustomerModel");
          $data = $md->Get();
          $kq = [];
          foreach ($data as $key => $value) {
               foreach ($value as $key => $val) {
                    $pattern = "/$info/i";
                    if (preg_match($pattern, $val)) {
                         $kq[] = $value;
                         break;
                    }
               }
          }
          $numkq = count($kq);
          $data = array_splice($kq, $vt, $numonpage);
          $list = "";
          foreach ($data as $key => $value) {
               $stt = $vt + $key + 1;
               $list .= "<tr align='center'>
                              <td>$value[ID_Cus]</td>
                              <td>$value[First_Name]</td>
                              <td>$value[Last_Name]</td>
                              <td>$value[Address]</td>
                              <td>$value[Phone]</td>
                              <td>$value[Email]</td>
                              <td>$value[Account]</td>
                              <td>
                                   <a href='$this->domain/Admin/Customer/Edit/$value[ID_Cus]'><i class='bi bi-pencil-square btn btn-success rounded-circle shadow-lg' style='color:white; font-size: 20px;'></i></a>
                                   <a href='$this->domain/Admin/Customer/Delete/$value[ID_Cus]'><i class='bi bi-trash-fill btn btn-danger rounded-circle shadow-lg' style='color:white; font-size: 20px;'></i></a>               
                              </td>
                         </tr>";
          }
          echo json_encode([$list, $numkq], JSON_UNESCAPED_UNICODE);
     }
}
