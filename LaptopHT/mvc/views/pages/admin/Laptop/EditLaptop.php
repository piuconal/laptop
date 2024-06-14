<?php
$folder = $data['dLap']['ID_Lap'];
$images = json_decode($data['dLap']['Images'], 1);
$ram = json_decode($data['dLap']['RAM'], 1);
$connection = json_decode($data['dLap']['Connection'], 1);
$other_Feature = json_decode($data['dLap']['Other_Feature'], 1);
$screen = json_decode($data['dLap']['Screen'], 1);
?>
<h1 style='color: blue;' align='center'>EDIT LAPTOP</h1>
<form action="" class="row" method="post" enctype="multipart/form-data">
    <div class="col-12 m-0 p-3 row border">
        <div class="col-12 col-xl-6">
            <h4>Thông tin cơ bản</h4>
            <div class="row">
                <label class="col-sm-4 col-form-label">Mã laptop</label>
                <div class="col-sm-8">
                    <input type="text" name="id" value="<?php echo @$data['dLap']['ID_Lap'] ?>" class="form-control" disabled>
                    <label mess="id"></label>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-form-label">Tên laptop</label>
                <div class="col-sm-8">
                    <input type="text" vali name="name" value="<?php echo @$data['dLap']['Name_Lap'] ?>" class="form-control">
                    <label mess="name"></label>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-form-label">Giá</label>
                <div class="col-sm-8">
                    <input type="number" vali name="price" value="<?php echo @$data['dLap']['Price'] ?>" min="1000000" max="9999999999" class="form-control">
                    <label mess="price"></label>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-6">
            <h4 class="d-none d-xl-block" style="visibility:hidden"> Cấu hình</h4>
            <div class="row">
                <label class="col-sm-4 col-form-label">CPU</label>
                <div class="col-sm-8">
                    <input type="text" vali value="<?php echo @$data['dLap']['CPU'] ?>" name="cpu" class="form-control">
                    <label mess="cpu"></label>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-form-label">GPU</label>
                <div class="col-sm-8">
                    <input type="text" vali name="gpu" value="<?php echo @$data['dLap']['GPU'] ?>" class="form-control">
                    <label mess="gpu"></label>
                </div>
            </div>
            <div class="row" id="disk">
                <label class="col-sm-4 col-form-label">Ổ cứng</label>
                <div class="col-sm-8">
                    <input type="text" vali name="disk" value="<?php echo @$data['dLap']['Storage'] ?>" class="form-control">
                    <label mess="disk"></label>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-6">
            <div class="row">
                <label class="col-sm-4 col-form-label">Bảo hành</label>
                <div class="col-sm-8">
                    <input type="text" vali name="insu" value="<?php echo @$data['dLap']['Insurance'] ?>" class="form-control">
                    <label mess="insu"></label>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-form-label">Năm ra mắt</label>
                <div class="col-sm-8">
                    <input type="text" vali name="release" value="<?php echo @$data['dLap']['Release_Time'] ?>" class="form-control">
                    <label mess="release"></label>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <select class=" form-select" name="type" required>
                        <option disabled value="">Loại Laptop</option>
                        <?php
                        $dtype = $data['dType'];
                        for ($i = 0; $i < count($dtype); $i++) {
                            $dty = $dtype[$i];
                            if ($dty['ID_Type'] != $data['dLap']['ID_Type'])
                                echo "<option value='$dty[ID_Type]'>$dty[Name_Type]</option>";
                            else
                                echo "<option selected value='$dty[ID_Type]'>$dty[Name_Type]</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-6">
                    <select class="form-select" name="manu" required>
                        <option disabled value="">Hãng sản xuất</option>
                        <?php
                        $dmanu = $data['dManu'];
                        for ($i = 0; $i < count($dmanu); $i++) {
                            $dman = $dmanu[$i];
                            if ($dman['ID_Manu'] != $data['dLap']['ID_Manu'])
                                echo "<option value='$dman[ID_Manu]'>$dman[Name_Manu]</option>";
                            else
                                echo "<option selected value='$dman[ID_Manu]'>$dman[Name_Manu]</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-6 mt-3 mt-xl-0">
            <div class="input-group">
                <span class="input-group-text border-0 bg-transparent"> Hình ảnh</span>
                <input id="gallery-photo-add" type="file" accept="image/*" class="form-control rounded-pill" name="img[]" multiple>
            </div>
            <div class="gallery mt-1 row row-cols-5 g-2 g-lg-3">
                <?php
                foreach ($images as $value) {

                    echo "<div class='p-1 col p-1'><img src='$data[domain]/images/$folder/$value' style='width:100%'/></div>";
                }
                ?>
            </div>
        </div>
    </div>
    <div class="col-12 m-0 p-0 row">
    </div>
    <div class="col-12 m-0 p-0 row">
        <div class="col-12 col-xl-6 my-0 p-3 border">
            <h4>Màn hình</h4>
            <div class="row">
                <label class="col-sm-4 col-form-label">Kích thước</label>
                <div class="col-sm-8">
                    <input type="text" vali name="sizeSC" value="<?php echo $screen['sizeSC'] ?>" class="form-control">
                    <label mess="sizeSC"></label>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-form-label">Độ phân giải</label>
                <div class="col-sm-8">
                    <input type="text" vali name="resoSC" value="<?php echo @$screen['resoSC'] ?>" class="form-control">
                    <label mess="resoSC"></label>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-form-label">Tần số quét</label>
                <div class="col-sm-8">
                    <input type="text" vali name="freSC" value="<?php echo @$screen['freSC'] ?>" class="form-control">
                    <label mess="freSC"></label>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-form-label">Công nghệ</label>
                <div class="col-sm-8">
                    <input type="text" vali name="techSC" value="<?php echo @$screen['techSC'] ?>" class=" form-control">
                    <label mess="techSC"></label>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-6 my-0 p-3 border">
            <h4>RAM</h4>
            <div class="row">
                <label class="col-sm-4 col-form-label">Dung lượng</label>
                <div class="col-sm-8">
                    <input type="text" vali name="memRAM" value="<?php echo @$ram['memRAM'] ?>" class="form-control">
                    <label mess="memRAM"></label>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-form-label">Loại RAM</label>
                <div class="col-sm-8">
                    <input type="text" vali name="typeRAM" value="<?php echo @$ram['typeRAM'] ?>" class="form-control">
                    <label mess="typeRAM"></label>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-form-label">Bus RAM</label>
                <div class="col-sm-8">
                    <input type="text" vali name="busRAM" value="<?php echo @$ram['busRAM'] ?>" class="form-control">
                    <label mess="busRAM"></label>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-form-label">Hỗ trợ tối đa</label>
                <div class="col-sm-8">
                    <input type="text" vali name="maxRAM" value="<?php echo @$ram['maxRAM'] ?>" class="form-control">
                    <label mess="maxRAM"></label>
                </div>
            </div>
        </div>

    </div>
    <div class="col-12 m-0 p-0 row">
        <div class="col-12 col-xl-6 my-0 p-3 border">
            <h4 class="d-inline-block">Kết nối & Tính năng</h4><span class="fst-italic"> (không bắt buộc !)</span>
            <div class="row">
                <label class="col-sm-4 col-form-label">Cổng kết nối</label>
                <div class="col-sm-8">
                    <input type="text" vali no-re name="port" value="<?php echo @$connection['port'] ?>" class="form-control">
                    <label mess="port"></label>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-form-label">Kết nối không dây</label>
                <div class="col-sm-8">
                    <input type="text" vali no-re name="wireless" value="<?php echo @$connection['wireless'] ?>" class="form-control">
                    <label mess="wireless"></label>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-form-label">Âm thanh</label>
                <div class="col-sm-8">
                    <input type="text" vali no-re name="audio" value="<?php echo @$data['dLap']['Audio'] ?>" class="form-control">
                    <label mess="audio"></label>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-form-label">Webcam</label>
                <div class="col-sm-8">
                    <input type="text" vali no-re name="webcam" value="<?php echo @$other_Feature['webcam'] ?>" class="form-control">
                    <label mess="webcam"></label>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-form-label">Đèn bàn phím</label>
                <div class="col-sm-8">
                    <input type="text" vali no-re name="ledKB" value="<?php echo @$other_Feature['ledKB'] ?>" class="form-control">
                    <label mess="ledKB"></label>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-6 my-0 p-3 border">
            <h4 class="d-inline-block">Thông tin khác</h4><span class="fst-italic"> (không bắt buộc !)</span>
            <div class="row">
                <label class="col-sm-4 col-form-label">Thông số vật lý</label>
                <div class="col-sm-8">
                    <input type="text" vali no-re name="d_w" value="<?php echo @$data['dLap']['Dimen_Wei'] ?>" class="form-control">
                    <label mess="d_w"></label>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-form-label">Chất liệu</label>
                <div class="col-sm-8">
                    <input type="text" vali no-re name="material" value="<?php echo @$data['dLap']['Material'] ?>" class="form-control">
                    <label mess="material"></label>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-form-label">Pin</label>
                <div class="col-sm-8">
                    <input type="text" vali no-re name="pin" value="<?php echo @$data['dLap']['Battery'] ?>" class="form-control">
                    <label mess="pin"></label>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-form-label">Tính năng khác</label>
                <div class="col-sm-8">
                    <input type="text" vali no-re name="otherF" value="<?php echo @$other_Feature['otherF'] ?>" class="form-control">
                    <label mess="otherF"></label>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-form-label">Hệ điều hành</label>
                <div class="col-sm-8">
                    <input type="text" vali no-re name="os" value="<?php echo @$data['dLap']['OS'] ?>" class="form-control">
                    <label mess="os"></label>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 my-0 p-1">
        <center>
            <button class="btn btn-outline-dark mt-3 disabled" name="sm" type="submit">
                <h4 class="mx-3 my-1">Xác nhận</h4>
            </button>
        </center>
    </div>
</form>
<script>
    $(function() {
        // Multiple images preview in browser
        $('#gallery-photo-add').on('change', function() {
            imagesPreview(this, 'div.gallery');
        });
    });
</script>