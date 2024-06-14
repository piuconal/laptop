<?php
$id = $data['dLap']['ID_Lap'];
$name = $data['dLap']['Name_Lap'];
$audio = $data['dLap']['Audio'];
$images = json_decode($data['dLap']['Images'], 1);
$ram = json_decode($data['dLap']['RAM'], 1);
$connection = json_decode($data['dLap']['Connection'], 1);
$other_Feature = json_decode($data['dLap']['Other_Feature'], 1);
$screen = json_decode($data['dLap']['Screen'], 1);
$price = $this->num_to_price($data['dLap']['Price']);
$id_user = @$_SESSION['user']['id'];
?>
<div class="container-fruit row bg-light bg-gradient g-0">
    <div class="col-6 ">
        <div id="carouselExampleInterval" class="carousel slide " data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php
                foreach ($images as $key => $value) {
                    if ($key == 0) {
                        echo "<div class='carousel-item active'>
                                <img src='$data[domain]/images/$id/$value' class='d-block w-100'>
                            </div>";
                    } else {
                        echo "<div class='carousel-item'>
                                <img src='$data[domain]/images/$id/$value' class='d-block w-100'>
                            </div>";
                    }
                }
                ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div>
            <h4 style="color: red;" class="m-3 p-0 fw-bold text-end">Giá <?php echo $price ?></h4>
        </div>
        <div class="row">
            <div class="col ml-4 d-flex">
                <button id="addCart" class="btn btn-success text-light" type="button"><span style="font-size:20px;"><i class="bi bi-cart-plus"></i> Thêm vào giỏ hàng</span></button>
                <div class="mx-auto"></div>
                <form action="<?php echo "$data[domain]/Order" ?>" method="post" class="m-o p-o">
                    <input type="text" name="id_lap" value="<?php echo $id; ?>" style="display:none;" />
                    <button name="sm_BuyNow" type="submit" class="btn btn-danger"> <span style="color:#FFFFFF; font-size:20px;">Mua ngay</span></button>
                </form>
            </div>
        </div>
        <div class="border border-primary rounded p-2 mt-5 mx-2">
            <h2 class="fs-3 text-center text-primary">Bình luận</h2>
            <div class="d-flex flex-row mb-3 rounded-pill bg-primary bg-gradient bg-opacity-25 badge p-2 m-2 justify-content-center">
                <?php
                if (isset($_SESSION['user']))
                    echo "
                            <img src='$data[domain]/images/shared/avatardefault.png' class='rounded-circle' style='width:50px; height:50px;' />
                            <textarea id='inp_comment' class='form-control flex-grow-1 mx-2 rounded-pill scroll' placeholder='bình luận' style='height:50px;'></textarea>
                            <button id='btn_comment' class='btn btn-dark rounded-pill m-0' tybe='button'><i class='bi bi-send fs-4'></i></button>
                        
                            ";
                else
                    echo "
                            <div> Vui lòng đăng nhập để bình luận</div>
                        "
                ?>
            </div>
            <div id="ListComment">
            </div>
            <div class="text-center">
                <button id="XemThem" class="btn btn-secondary mt-3" style="padding: 5px 125px;">Xem thêm</button>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card border-0 border-top mb-3" style="max-width: 100rem;">
            <div class="col-12 ">
                <h2 class="fw-bold text-center text-warning p-2 m-0 bg-dark"><?php echo $name ?></h2>
                <h5 class="card-header" style="background-color: #C6DEF7;">Tổng quan</h5>
                <div class="card-body">
                    <div class="row">
                        <label class="card-title col-md-4 col-label">CPU</label>
                        <div class="col-md-8 ">
                            <p class="card-text"><?php echo $data['dLap']['CPU'] ?></p>
                        </div>
                        <label class="card-title col-md-4 col-label">GPU</label>
                        <div class="col-md-8 ">
                            <p class="card-text"><?php echo $data['dLap']['GPU'] ?></p>
                        </div>
                        <label class="card-title col-md-4 col-label">Bảo hành</label>
                        <div class="col-md-8 ">
                            <p class="card-text"><?php echo $data['dLap']['Insurance'] ?></p>
                        </div>
                        <label class="card-title col-md-4 col-label">Năm ra mắt</label>
                        <div class="col-md-8 ">
                            <p class="card-text"><?php echo $data['dLap']['Release_Time'] ?></p>
                        </div>
                    </div>
                </div>

                <h5 class="card-header" style="background-color: #C6DEF7;">Bộ nhớ RAM, Ổ cứng</h5>
                <div class="card-body">
                    <div class="row">
                        <label class="card-title col-md-4 col-label">Dung lượng</label>
                        <div class="col-md-8 ">
                            <p class="card-text"><?php echo $ram['memRAM'] ?></p>
                        </div>
                        <label class="card-title col-md-4 col-label">Loại RAM</label>
                        <div class="col-md-8 ">
                            <p class="card-text"><?php echo $ram['typeRAM'] ?></p>
                        </div>
                        <label class="card-title col-md-4 col-label">Bus RAM</label>
                        <div class="col-md-8 ">
                            <p class="card-text"><?php echo $ram['busRAM'] ?></p>
                        </div>
                        <label class="card-title col-md-4 col-label">Hỗ trợ tối đa</label>
                        <div class="col-md-8 ">
                            <p class="card-text"><?php echo $ram['maxRAM'] ?></p>
                        </div>
                    </div>
                </div>

                <h5 class="card-header" style="background-color: #C6DEF7;">Màn hình</h5>
                <div class="card-body">
                    <div class="row">
                        <label class="card-title col-md-4 col-label">Kích thước</label>
                        <div class="col-md-8 ">
                            <p class="card-text"><?php echo $screen['sizeSC'] ?></p>
                        </div>
                        <label class="card-title col-md-4 col-label">Độ phân giải</label>
                        <div class="col-md-8 ">
                            <p class="card-text"><?php echo $screen['resoSC'] ?></p>
                        </div>
                        <label class="card-title col-md-4 col-label">Tần số quét</label>
                        <div class="col-md-8 ">
                            <p class="card-text"><?php echo $screen['freSC'] ?></p>
                        </div>
                        <label class="card-title col-md-4 col-label">Công nghệ</label>
                        <div class="col-md-8 ">
                            <p class="card-text"><?php echo $screen['techSC'] ?></p>
                        </div>
                    </div>
                </div>
                <h5 class="card-header" style="background-color: #C6DEF7;">Kết nối & Tính năng</h5>
                <div class="card-body">
                    <div class="row">
                        <label class="card-title col-md-4 col-label">Cổng kết nối</label>
                        <div class="col-md-8 ">
                            <p class="card-text"><?php echo $connection['port'] ?></p>
                        </div>
                        <label class="card-title col-md-4 col-label">Kết nối không dây</label>
                        <div class="col-md-8 ">
                            <p class="card-text"><?php echo $connection['wireless'] ?></p>
                        </div>
                        <label class="card-title col-md-4 col-label">Âm thanh</label>
                        <div class="col-md-8 ">
                            <p class="card-text"><?php echo $audio ?></p>
                        </div>
                        <label class="card-title col-md-4 col-label">Webcam</label>
                        <div class="col-md-8 ">
                            <p class="card-text"><?php echo $other_Feature['webcam'] ?></p>
                        </div>
                        <label class="card-title col-md-4 col-label">Đèn bàn phím</label>
                        <div class="col-md-8 ">
                            <p class="card-text"><?php echo $other_Feature['ledKB'] ?></p>
                        </div>
                    </div>
                </div>
                <h5 class="card-header" style="background-color: #C6DEF7;">Thông tin khác</h5>
                <div class="card-body">
                    <div class="row">
                        <label class="card-title col-md-4 col-label">Thông số vật lý</label>
                        <div class="col-md-8 ">
                            <p class="card-text"><?php echo $data['dLap']['Dimen_Wei'] ?></p>
                        </div>
                        <label class="card-title col-md-4 col-label">Chất liệu</label>
                        <div class="col-md-8 ">
                            <p class="card-text"><?php echo $data['dLap']['Material'] ?></p>
                        </div>
                        <label class="card-title col-md-4 col-label">Pin</label>
                        <div class="col-md-8 ">
                            <p class="card-text"><?php echo $data['dLap']['Battery'] ?></p>
                        </div>
                        <label class="card-title col-md-4 col-label">Tính năng khác</label>
                        <div class="col-md-8 ">
                            <p class="card-text"><?php echo $other_Feature['otherF'] ?></p>
                        </div>
                        <label class="card-title col-md-4 col-label">Hệ điều hành</label>
                        <div class="col-md-8 ">
                            <p class="card-text"><?php echo $data['dLap']['OS'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var vt = 0;
    var btnAddCart = document.getElementById('addCart')
    var btnBuyNow = document.getElementById('sm_BuyNow')
    var toastLive = document.getElementById('liveToast')
    $(document).ready(function() {
        message();
        load_Comments(vt);
        $("button[name='sm_BuyNow']").click(function() {
            addCart();
            update_cart();
        })
        $("#btn_comment").click(function() {
            comment();
        });
        $("#XemThem").click(function() {
            vt = vt + 1;
            load_Comments(vt);
        });

    });

    function load_Comments(v) {
        $.post('<?php echo "$data[domain]/Ajax/Load_Comments/" . $data['dLap']['ID_Lap'] . "/" ?>' + v, {}, function(data) {
            $("#ListComment").append(data);
            v = v + 1;
            $.post('<?php echo "$data[domain]/Ajax/Load_Comments/" . $data['dLap']['ID_Lap'] . "/" ?>' + v, {}, function(data) {
                if (data == "")
                    $("#XemThem").remove();
            })
        });

    }

    function comment() {
        var content = $("#inp_comment").val();
        $("#inp_comment").val('');
        console.log(content);
        $.post('<?php echo "$data[domain]/Ajax/Comment/$id/$id_user/" ?>', {
            content: content
        }, function(data) {
            $("#ListComment").html('');
            for (var i = 0; i <= vt; i++) {
                load_Comments(i);
            }
        });
    }

    function message() {
        if (btnAddCart) {
            btnAddCart.addEventListener('click', function() {
                addCart();
                update_cart();
                var toast = new bootstrap.Toast(toastLive)
                toast.show()
            })
        }
    }

    function addCart() {
        $.post('<?php echo "$data[domain]/Ajax/AddCart/$id"; ?>', {}, function(data) {
            $(".toast-body").html(JSON.parse(data));
        })
    };
</script>