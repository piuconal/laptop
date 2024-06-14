<h2 class="my-5 text-primary fs-1 fw-bold" align='center'>ĐĂNG KÝ</h2>
<div class="container my-5 bg-dark bg-opacity-50 py-5 rounded" style="max-width: 600px;">
    <form action="" method="post" class="row">
        <div class="col-12 col-sm-6">
            <input type="text" vali class="form-control" name="firstname" placeholder="Họ và tên đệm" value='<?php if (isset($_POST["firstname"])) echo $_POST["firstname"] ?>' required>
            <label mess="firstname"></label>
        </div>
        <div class="col-12 col-sm-6">
            <input type="text" vali class="form-control" name="lastname" placeholder="Tên" value='<?php if (isset($_POST["lastname"])) echo $_POST["lastname"] ?>' required>
            <label mess="lastname"></label>
        </div>
        <div>
            <input type="text" vali class="form-control" name="account" placeholder="Tài khoản" value='<?php if (isset($_POST["account"])) echo $_POST["account"] ?>' required>
            <label mess="account"></label>
        </div>
        <div>
            <input type="password" vali class="form-control" name="password" placeholder="Mật khẩu" value='<?php if (isset($_POST["password"])) echo $_POST["password"] ?>' required>
            <label mess="password"></label>
        </div>
        <div>
            <input type="password" class="form-control" name="confirmPassword" placeholder="Xác nhận mật khẩu" value='<?php if (isset($_POST["password"])) echo $_POST["password"] ?>' required>
            <label mess="confirmPassword"></label>
        </div>
        <div class="row m-0 p-0">
            <div class="col-6 mb-3">
                <select id="province" class="form-select" name="province" required>
                    <?php
                    if (!isset($_POST["province"])) {
                        echo "<option selected disabled value=''>Tỉnh</option>";
                        foreach ($data['dProvince'] as $key => $value) {
                            echo "<option value='$value[id]'>$value[_name]</option>";
                        }
                    } else {
                        echo "<option disabled value=''>Tỉnh</option>";
                        foreach ($data['dProvince'] as $key => $value) {
                            if ($_POST["province"] == $value['id'])
                                echo "<option value='$value[id]' selected>$value[_name]</option>";
                            else
                                echo "<option value='$value[id]'>$value[_name]</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="col-6 mb-3">
                <select id="district" class="form-select" name="district" required>
                    <?php
                    if (!isset($_POST["district"])) {
                        echo "<option selected disabled value=''>quận, huyện</option>";
                        foreach ($data['dDistrict'] as $key => $value) {
                            echo "<option value='$value[id]'>$value[_prefix] $value[_name]</option>";
                        }
                    } else {
                        echo "<option disabled value=''>quận, huyện</option>";
                        foreach ($data['dDistrict'] as $key => $value) {
                            if ($_POST["district"] == $value['id'])
                                echo "<option value='$value[id]' selected >$value[_prefix] $value[_name]</option>";
                            else
                                echo "<option value='$value[id]'> $value[_prefix] $value[_name]</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="col-6 mb-3">
                <select id="ward" class="form-select" name="ward" required>
                    <?php
                    if (!isset($_POST["ward"])) {
                        echo "<option selected disabled value=''>xã, phường</option>";
                        foreach ($data['dWard'] as $key => $value) {
                            echo "<option value='$value[id]'>$value[_prefix] $value[_name]</option>";
                        }
                    } else {
                        echo "<option disabled value=''>xã, phường</option>";
                        foreach ($data['dWard'] as $key => $value) {
                            if ($_POST["ward"] == $value['id'])
                                echo "<option value='$value[id]' selected >$value[_prefix] $value[_name]</option>";
                            else
                                echo "<option value='$value[id]'>$value[_prefix] $value[_name]</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="col-6 mb-3">
                <input type="text" vali class="form-control" name="spe" placeholder="Số nhà, đường" value='<?php if (isset($_POST["spe"])) echo $_POST["spe"] ?>'>
            </div>
            <label mess="spe"></label>
        </div>
        <div>
            <input type="text" vali class="form-control" name="phone" placeholder="Số điện thoại" value='<?php if (isset($_POST["phone"])) echo $_POST["phone"] ?>'>
            <label mess="phone"></label>
        </div>
        <!-- <div>
            <div class="input-group">
                <input id="email" type="email" vali value='<?php if (isset($_POST["email"])) echo $_POST["email"] ?>' name="email" placeholder="Email" class="form-control" aria-label="Recipient's username" aria-describedby="basic-addon2">
                <span class="input-group-text p-0" id="basic-addon2"><button id="sendmail" type="button" class="btn btn-primary">Lấy mã</button></span>
            </div>
            <label mess="email"></label>
        </div>
        <div>
            <input type="text" class="form-control" name="verify" placeholder="Mã xác thực" value='<?php if (isset($_POST["verify"])) echo $_POST["verify"] ?>'>
            <label mess=""></label>
        </div> -->
        <div>
            <center>
                <button class="btn btn-outline-primary mt-3 disabled" name="sm" type="submit">
                    <h4 class="mx-3 my-1">Đăng ký</h4>
                </button>
            </center>
        </div>
    </form>
</div>
<script src='<?php echo "$data[domain]/public/App.js" ?>'></script>
<script>
    function validate() {
        $("input[vali]").each(function() {
            check_Input(this, "<?php echo $data['domain'] ?>", "Customer");
        });
    }
    $(document).ready(function() {
        <?php if (isset($_POST['sm'])) echo "validate();" ?>
    })

    $("input[vali]").keyup(function() {
        check_Input(this, "<?php echo $data['domain'] ?>", "Customer");
    }).change(function() {
        check_Input(this, "<?php echo $data['domain'] ?>", "Customer");
    });
    $("input[name='confirmPassword']").keyup(function() {
        if ($(this).val() == $("input[name='password']").val()) {
            $("label[mess='confirmPassword']").html("<i class='bi bi-check2-circle'></i>").css("color", "blue");
            $("button[name='sm']").removeClass("disabled");
        } else {
            $("label[mess='confirmPassword']").html('Mật khẩu không khớp').css("color", "red");
            $("button[name='sm']").addClass("disabled");
        }
    });
    $("#province").change(function() {
        var id = $(this).val();
        $.post('<?php echo "$data[domain]"; ?>/' + 'Ajax/GetDistrict/' + id, {}, function(data) {
            var d = JSON.parse(data);
            var dt = $("#district");
            $("#ward").html("<option disabled selected value=''> xã, phường</option>");
            dt.html("<option disabled selected value=''> quận, huyện</option>");
            d.forEach(element => {
                $($.parseHTML('<option>')).attr('value', element['id']).html(element['_prefix'] + ' ' + element['_name']).appendTo(dt);
            });
        });
    });
    $("#district").change(function() {
        var id = $(this).val();
        $.post('<?php echo "$data[domain]"; ?>/' + 'Ajax/GetWard/' + id, {}, function(data) {
            var d = JSON.parse(data);
            var w = $("#ward");
            w.html("<option disabled selected value=''> xã, phường</option>");
            d.forEach(element => {
                $($.parseHTML('<option>')).attr('value', element['id']).html(element['_prefix'] + ' ' + element['_name']).appendTo(w);
            });
        });
    });
</script>