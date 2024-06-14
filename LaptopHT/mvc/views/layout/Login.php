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
      <link rel="icon" href='<?php echo "$data[domain]/images/shared/icon.jpg"?>' type="image/x-icon">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <title><?php echo $data["title"] ?></title>
      <style>
            label[mess] {
                  margin: 5px;
            }

            .form-label {
                  color: blueviolet;
                  font-weight: bolder;
            }
      </style>
</head>

<body style="background: url(<?php echo "$data[domain]/images/shared/bg-login.jpg" ?>) top center">
      <?php
      require_once "./mvc/views/pages/client/$data[controller]/" . $data['page'] . ".php";
      ?>
      <div class="modal fade" id="Model_Notify" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                        <div class="modal-header">
                              <h5 class="modal-title fw-bold" id="exampleModalLabel">Thông báo</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center text-primary fs-5" id="notify_body">
                        </div>
                        <div class="modal-footer">
                        </div>
                  </div>
            </div>
      </div>
      <script>
            $(document).ready(function() {
                  $("#notify_body").html("<?php echo @$ct_notify ?>");
                  var notify = new bootstrap.Modal(document.getElementById('Model_Notify'), {
                        keyboard: false
                  });
                  if ($("#notify_body").html() != '') {
                        notify.show();
                  }
            })
            if (window.history.replaceState) {
                  window.history.replaceState(null, null, window.location.href);
            }
      </script>
</body>

</html>