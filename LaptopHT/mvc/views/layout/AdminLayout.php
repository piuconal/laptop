<?php
function listitem($domain, $currentCtrl, $controller, $itemname)
{
     $item = "<li class='nav-item border-bottom'>";
     if ($currentCtrl == $controller)
          $item = "<li class='nav-item border border-dark bg-primary bg-opacity-10'>";
     echo $item . "<a class='nav-link' aria-current='page' href='$domain/Admin/$controller'><i class='bi bi-caret-right-fill'></i> $itemname</a></li>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="icon" href='<?php echo "$data[domain]/images/shared/icon.jpg" ?>' type="image/x-icon">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <title><?php echo $data['title'] ?></title>
     <style>
          .row {
               margin: 0;
               padding: 0;
          }

          label[mess] {
               font-style: italic;
               margin: 5px 15px;
          }

          .form-label {
               margin: 0;
               padding: 0;
               color: blueviolet;
               font-weight: bolder;
          }

          table th:hover {
               cursor: pointer;
               font-style: italic;
               background-color: blueviolet;
          }
     </style>
</head>

<body class="container-fruilt m-0 p-0" style="min-height: 100vh; min-width: 1080px;">
     <div id="header" class="bg-dark">
          <nav class="navbar navbar-expand navbar-dark bg-dark container p-0">
               <div class="container-fluid d-flex">
                    <a class="navbar-brand text-warning p-2 fs-2 fw-bold" href="<?php echo "$data[domain]/Admin"; ?>"><i class="bi bi-laptop"></i> ADMIN</a>
                    <div class="mb-0 mx-auto">
                    </div>
                    <ul class="navbar-nav">
                         <?php if (isset($_SESSION['user'])) echo "<li class='nav-item dropdown border border-primary rounded px-2'>
                                   <a class='nav-link dropdown-toggle text-primary' id='navbarDropdown' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                   <i class='bi bi-star'></i>  " . $_SESSION['user']['ten'] . "
                                   </a>
                                   <ul class='dropdown-menu bg-dark' aria-labelledby='navbarDropdown'>
                                        <li class='nav-item bg-dark'>
                                             <a class='nav-link' href='$data[domain]/Login/SignOut'>Đăng xuất</a>
                                        </li>
                                   </ul>
                              </li>";
                         else {
                              echo "<li class='nav-item'>
                                   <a class='nav-link py-0' href='$data[domain]/Login'> <button class='btn btn-outline-primary p-2' type='button'> Đăng nhập</button></a>
                                        </li>";
                         }
                         ?>
                    </ul>
               </div>
          </nav>
     </div>
     <div id="content" class="d-flex flex-row mb-5">
          <p></p>
          <div class="border m-0 p-0" style="min-width: 150px !important; ">
               <ul class="nav flex-column d-block" style="font-weight:bold;">
                    <?php listitem($data['domain'], $data['controller'], "Laptop", "Laptop") ?>
                    <?php listitem($data['domain'], $data['controller'], "LaptopType", "Loại laptop") ?>
                    <?php listitem($data['domain'], $data['controller'], "Manufacturer", "Hảng laptop") ?>
                    <?php listitem($data['domain'], $data['controller'], "OrderInfo", "Đơn hàng") ?>
                    <?php listitem($data['domain'], $data['controller'], "Customer", "Khách hàng") ?>
                    <?php listitem($data['domain'], $data['controller'], "Cart", "Giỏ hàng") ?>
                    <?php listitem($data['domain'], $data['controller'], "Slider", "Slide") ?>
                    <?php listitem($data['domain'], $data['controller'], "Admin", "Quản trị") ?>
               </ul>
          </div>
          <div class="flex-grow-1 border p-1">
               <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                    <div id="liveToast" class="toast mb-5" role="alert" aria-live="assertive" aria-atomic="true">
                         <div class="toast-header">
                              <strong class="me-auto">LaptopHT</strong>
                              <small>Just now</small>
                              <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                         </div>
                         <div class="toast-body">
                              Hello, world! This is a toast message.
                         </div>
                    </div>
               </div>
               <?php
               require_once "./mvc/views/pages/admin/$data[controller]/" . $data['page'] . ".php"
               ?>
          </div>
     </div>
     <div id="footer" class="bg-dark text-light fixed-bottom p-3">
          <div class="container fst-italic" align="center">
               <label> @Copyright: LaptopHT</label>
          </div>
     </div>
     <script src='<?php echo "$data[domain]/public/App.js" ?>'></script>
     <script>
          $("input[vali]").keyup(function() {
               check_Input(this, "<?php echo $data['domain'] ?>", "<?php echo $data['controller'] ?>");
          }).change(function() {
               check_Input(this, "<?php echo $data['domain'] ?>", "<?php echo $data['controller'] ?>");
          });
          $("form").children().change(function(){
               <?php if (@$data['action'] == 'Edit') echo 'validate();' ?>
          }).keyup(function(){
               <?php if (@$data['action'] == 'Edit') echo 'validate();' ?>
          })

          function validate() {
               $("input[vali]").each(function() {
                    check_Input(this, "<?php echo $data['domain'] ?>", "<?php echo $data['controller'] ?>");
               });
          }

          function search() {
               search_info = $("#search").val();
               if (search_info !== "") {
                    window.location.href = '<?php echo "$data[domain]/Admin/$data[controller]/Search/" ?>' + search_info;
               }
          }
          if (window.history.replaceState) {
               window.history.replaceState(null, null, window.location.href);
          }
          var tti
          var regexNum = new RegExp('^[0-9]+$');
          $(document).ready(function() {
               tti = 0;
          })
          $("table th").click(function() {
               tti = $(this).index();
               if ($(this).find("i").length == 0) {
                    $("table th").find("i").remove()
                    $(this).append(' <i class="bi bi-chevron-down asc"></i>')
                    $("table tr").not(":first").sort(asc_sort).appendTo('table')
               } else {
                    if ($(this).find(".asc").length > 0) {
                         $("table th").find("i").remove()
                         $(this).append(' <i class="bi bi-chevron-up desc"></i>')
                         $("table tr").not(":first").sort(desc_sort).appendTo('table')

                    } else {
                         $("table th").find("i").remove()
                         $(this).append(' <i class="bi bi-chevron-down asc"></i>')
                         $("table tr").not(":first").sort(asc_sort).appendTo('table')
                    }
               }
          })

          function asc_sort(a, b) {
               if (regexNum.test($(a).find('td').eq(tti).text())) {
                    return parseInt($(a).find('td').eq(tti).text()) >= parseInt($(b).find('td').eq(tti).text()) ? 1 : -1;
               }
               return ($(a).find('td').eq(tti).text()) > ($(b).find('td').eq(tti).text()) ? 1 : -1;
          }

          function desc_sort(a, b) {
               if (regexNum.test($(a).find('td').eq(tti).text())) {

                    return parseInt($(a).find('td').eq(tti).text()) < parseInt($(b).find('td').eq(tti).text()) ? 1 : -1;
               }
               return ($(a).find('td').eq(tti).text()) < ($(b).find('td').eq(tti).text()) ? 1 : -1;
          }
     </script>
     <script>
          let hContent = Math.round(window.innerHeight) - Math.round($("#header").height()) - Math.round($("#footer").height());
          $("#content").css("min-height", hContent + "px");
     </script>
     <?php
     if (!empty($_SESSION['Notification'])) {
          echo "<script>$(document).ready(function(){alert('$_SESSION[Notification]');})</script>";
          unset($_SESSION['Notification']);
     }
     ?>
</body>

</html>