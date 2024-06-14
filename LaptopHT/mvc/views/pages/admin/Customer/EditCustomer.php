<?php
$dc = explode(", ", @$data['dCus']['Address']);
?>
<div class="container p-5">
    <div class="card mb-3 rounded-pill p-5 fs-5 bg-light bg-gradient">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="<?php echo "$data[domain]/images/shared/avatardefault.png" ?>" class="img-fluid rounded-start w-100 mt-5" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body px-5">
                    <h5 class="card-title fs-3 text-center">Thông tin khách hàng</h5>
                    <form action="" method="post" class="row">
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Họ</label>
                            <input type="text" vali class="form-control" name="firstname" placeholder="Họ và tên đệm" value='<?php echo @$data['dCus']['First_Name'] ?>' required>
                            <label mess="firstname"></label>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label">Tên</label>
                            <input type="text" vali class="form-control" name="lastname" placeholder="Tên" value='<?php echo @$data['dCus']['Last_Name'] ?>' required>
                            <label mess="lastname"></label>
                        </div>
                        <div>
                            <label class="form-label">Phone</label>
                            <input type="text" vali class="form-control" name="phone" placeholder="Số điện thoại" value='<?php echo @$data['dCus']['Phone'] ?>'>
                            <label mess="phone"></label>
                        </div>
                        <div>
                            <label class="form-label">Email</label>
                            <input type="email" vali class="form-control" name="email" placeholder="Email" value='<?php echo @$data['dCus']['Email'] ?>'>
                            <label mess="email"></label>
                        </div>
                        <div>
                            <center>
                                <button class="btn btn-outline-primary mt-3 disabled" name="sm" type="submit">
                                    <h4 class="mx-3 my-1">Cập nhật</h4>
                                </button>
                            </center>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-12">
                <div class="text-center">
                    <label class="fw-bold">Địa chỉ: </label>
                    <?php echo @$data['dCus']['Address'] ?>
                    <button type="button" class="btn btn-outline-primary border-0 p-1 pt-0" data-bs-toggle="modal" data-bs-target="#changAddress">
                        <i class="bi bi-pencil"></i>
                    </button>
                </div>
                <div class="text-center">
                    <label class="fw-bold">Mật khẩu: ********</label>
                    <button type="button" class="btn btn-outline-primary border-0 p-1 pt-0" data-bs-toggle="modal" data-bs-target="#changPassword">
                        <i class="bi bi-pencil"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="changAddress" tabindex="-1" aria-labelledby="changAddressLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changAddressLabel">Cập nhật địa chỉ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post">
                    <div class="modal-body row m-0 p-0 pt-3">
                        <div class="col-6 mb-3">
                            <select id="province" class="form-select" name="province" required>
                                <option selected disabled value="">Tỉnh</option>
                                <?php
                                $dprovince = $data['dProvince'];
                                for ($i = 0; $i < count($dprovince); $i++) {
                                    $pv = $dprovince[$i];
                                    echo "<option value='$pv[id]'>$pv[_name]</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-6 mb-3">
                            <select id="district" class="form-select" name="district" required>
                                <option disabled selected> quận, huyện</option>
                            </select>
                        </div>
                        <div class="col-6 mb-3 fs-5">
                            <select id="ward" class="form-select" name="ward" required>
                                <option disabled selected> xã, phường</option>
                            </select>
                        </div>
                        <div class="col-6 mb-3 fs-5">
                            <input type="text" class="form-control" name="spe" placeholder="Số nhà, đường" value='<?php if (isset($_POST["address"])) echo $_POST["address"] ?>'>
                        </div>
                        <label mess="address"></label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" name="sm_changeAddress" class="btn btn-primary px-4">Đổi</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="changPassword" tabindex="-1" aria-labelledby="changPasswordLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changPasswordLabel">Đổi mật khẩu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post" class="">
                <div class="modal-body row m-0 p-3">
                    <div>
                        <input type="password" vali class="form-control" name="password" placeholder="Mật khẩu mới" required>
                        <label mess="password"></label>
                    </div>
                    <div>
                        <input type="password" class="form-control" name="confirmPassword" placeholder="Xác nhận mật khẩu mới" required>
                        <label mess="confirmPassword"></label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" name="sm_changePassword" class="btn btn-primary px-4"> Đổi</button>
                </div>
        </div>

        </form>
    </div>
</div>
</div>
</div>
<script src='<?php echo "$data[domain]/public/App.js" ?>'></script>
<script>
    $(document).ready(function() {
        
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
                dt.html("<option disabled selected> quận, huyện</option>");
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
                w.html("<option disabled selected> xã, phường</option>");
                d.forEach(element => {
                    $($.parseHTML('<option>')).attr('value', element['id']).html(element['_prefix'] + ' ' + element['_name']).appendTo(w);
                });
            });
        });
    });
</script>