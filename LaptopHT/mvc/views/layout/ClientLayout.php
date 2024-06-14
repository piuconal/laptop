<?php
if (isset($_SESSION['notify'])) {
     $ct_notify = $_SESSION['notify'];
     unset($_SESSION['notify']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title><?php echo $data['title']; ?></title>
     <link rel="icon" href='<?php echo "$data[domain]/images/shared/icon.jpg" ?>' type="image/x-icon">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <style>
          p,
          .row {
               margin: 0px;
               padding: 0px;
          }

          input::-webkit-outer-spin-button,
          input::-webkit-inner-spin-button {
               -webkit-appearance: none;
               margin: 0;
          }

          label[mess] {
               margin: 5px;
          }

          .laptop:hover {
               box-shadow: 0px 4px 8px 0px rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
               padding: 0;
               z-index: 100;
          }

          .btn:hover {
               filter: drop-shadow(0 0 10px #fff);
          }

          .form-label {
               color: blueviolet;
               font-weight: bolder;
          }

          .scroll::-webkit-scrollbar {
               display: none;
          }
     </style>
</head>

<body class="container-fruilt" style='min-width:640px; background: url(<?php echo "$data[domain]/images/shared/bg.jpg" ?>) top center no-repeat black'>
     <div id="header" class="bg-dark">
          <nav class="navbar navbar-expand navbar-dark bg-dark container-md">
               <div class="container-fluid d-flex">
                    <a class="navbar-brand text-danger fw-bold fst-italic" href="<?php echo "$data[domain]"; ?>"><i class="bi bi-laptop"></i> LaptopHT</a>
                    <div class="collapse navbar-collapse">
                         <div class="mb-0 mx-auto">
                              <div class="input-group">
                                   <input id="search" class="form-control border-2 border-primary" name="info" value="<?php echo @$data['info'] ?>" type="search" onsearch="search()" placeholder="Tìm kiếm" aria-label="Search">
                                   <button class="btn btn-outline-light border-2 border-primary" type="button" onclick="search()"><i class="bi bi-search"></i></button>
                              </div>
                         </div>
                         <ul class="navbar-nav">
                              <li class="nav-item">
                                   <a class="nav-link py-0 " href='<?php echo "$data[domain]/Cart"; ?>'>
                                        <button class="btn btn-outline-success p-2" style="width: 130px; color: rgb(120, 240, 0);" type="button">
                                             <i class="bi bi-cart4"></i> Giỏ hàng( <span id="NumP" class="text-danger"></span> )
                                        </button>
                                   </a>
                              </li>
                              <?php
                              if (isset($_SESSION['user'])) {
                                   echo "
                                   <li class='nav-item dropdown border border-primary rounded '>
                                        <a class='nav-link dropdown-toggle text-primary' id='navbarDropdown' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                             <i class='bi bi-person-circle'></i>  " . $_SESSION['user']['ten'] . "
                                        </a>
                                        <ul class='dropdown-menu bg-dark' aria-labelledby='navbarDropdown'>
                                        ";
                                   if (!isset($_SESSION['user']['ad']))
                                        echo " 
                                             <li class='nav-item bg-dark'>
                                                  <a class='nav-link' href='$data[domain]/MyOrder'>Đơn hàng của tôi</a>
                                             </li>
                                             <li class='nav-item bg-dark'>
                                                  <a class='nav-link' href='$data[domain]/Info'>Thông tin cá nhân</a>
                                             </li>
                                   ";
                                   echo "
                                        <li class='nav-item bg-dark'>
                                             <a class='nav-link' href='$data[domain]/Login/SignOut'>Đăng xuất</a>
                                        </li>
                                   </ul>
                                   </li>";
                              } else {
                                   echo "<li class='nav-item'>
                                   <a class='nav-link py-0' href='$data[domain]/Login'> <button class='btn btn-outline-primary p-2' type='button'> Đăng nhập</button></a>
                                        </li>";
                              }
                              ?>
                         </ul>

                    </div>
               </div>
          </nav>
     </div>

     <div id="content" class="container-xl p-0" style="margin-bottom: 60px;">
          <div class="modal fade" id="Model_Notify" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                         <div class="modal-header">
                              <h5 class="modal-title fw-bold" id="exampleModalLabel">Thông báo</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                         </div>
                         <div class="modal-body text-center text-primary" id="notify_body">
                         </div>
                         <div class="modal-footer">
                         </div>
                    </div>
               </div>
          </div>
          <div class="position-fixed bottom-0 end-0 p-3 " style="z-index: 11;">
               <div id="liveToast" class="toast mb-5 bg-light fs-5 bg-gradient border border-primary w-100" style="filter:drop-shadow(0 0 5px blue)" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                         <strong class="me-auto">LaptopHT</strong>
                         <small>Just now</small>
                         <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body text-center text-primary p-4 fst-italic">
                    </div>
               </div>
          </div>
          <?php
          require_once "./mvc/views/pages/client/$data[controller]/" . $data['page'] . ".php"
          ?>
     </div>
     <div id="footer" class="bg-dark text-light fixed-bottom p-3">
          <div class="container fst-italic" align="center">
               <label> @Copyright: LaptopHT</label>
          </div>
     </div>
     <script src='<?php echo "$data[domain]/public/App.js"; ?>'></script>
     <script>
          $(document).ready(function() {
               update_cart();
               $("#notify_body").html("<?php echo @$ct_notify ?>");
               var notify = new bootstrap.Modal(document.getElementById('Model_Notify'), {
                    keyboard: false
               });
               if ($("#notify_body").html() != '') {
                    notify.show();
               }
          });

          function update_cart() {
               $.post('<?php echo "$data[domain]/Ajax/GetNumPro" ?>', {},
                    function(data) {
                         $("#NumP").html(data);
                    })
          }

          function search() {
               search_info = $("#search").val();
               if (search_info !== "") {
                    window.location.href = '<?php echo "$data[domain]/Search/" ?>' + search_info;
               }
          }
          if (window.history.replaceState) {
               window.history.replaceState(null, null, window.location.href);
          }
     </script>
</body>

</html>