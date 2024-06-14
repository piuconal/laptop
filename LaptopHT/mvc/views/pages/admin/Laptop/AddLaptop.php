<style>
</style>
<h1 style='color: blue;' align='center'>THÊM LAPTOP</h1>
<form action="" class="row" method="post" enctype="multipart/form-data">
    <div class="col-12 m-0 p-3 row border">
        <div class="col-12 col-xl-6">
            <h4>Thông tin cơ bản</h4>
            <div class="row">
                <label class="col-sm-4 col-form-label">Mã laptop</label>
                <div class="col-sm-8">
                    <input type="text" vali name="id" class="form-control">
                    <label mess="id"></label>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-form-label">Tên laptop</label>
                <div class="col-sm-8">
                    <input type="text" vali name="name" class="form-control">
                    <label mess="name"></label>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-form-label">Giá</label>
                <div class="col-sm-8">
                    <input type="number" vali name="price" min="1000000" max="9999999999" class="form-control">
                    <label mess="price"></label>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-6">
            <h4 class="d-none d-xl-block" style="visibility:hidden"> Cấu hình</h4>
            <div class="row">
                <label class="col-sm-4 col-form-label">CPU</label>
                <div class="col-sm-8">
                    <input type="text" vali name="cpu" class="form-control">
                    <label mess="cpu"></label>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-form-label">GPU</label>
                <div class="col-sm-8">
                    <input type="text" vali name="gpu" class="form-control">
                    <label mess="gpu"></label>
                </div>
            </div>
            <div class="row" id="disk">
                <label class="col-sm-4 col-form-label">Ổ cứng</label>
                <div class="col-sm-8">
                    <input type="text" vali name="disk" class="form-control">
                    <label mess="disk"></label>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-6">
            <div class="row">
                <label class="col-sm-4 col-form-label">Bảo hành</label>
                <div class="col-sm-8">
                    <input type="text" vali name="insu" class="form-control">
                    <label mess="insu"></label>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-form-label">Năm ra mắt</label>
                <div class="col-sm-8">
                    <input type="text" vali name="release" class="form-control">
                    <label mess="release"></label>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <select class=" form-select" name="type" required>
                        <option selected disabled value="">Loại Laptop</option>
                        <?php
                        $dtype = $data['dType'];
                        for ($i = 0; $i < count($dtype); $i++) {
                            $dty = $dtype[$i];
                            echo "<option value='$dty[ID_Type]'>$dty[Name_Type]</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-6">
                    <select class="form-select" name="manu" required>
                        <option selected disabled value="">Hãng sản xuất</option>
                        <?php
                        $dmanu = $data['dManu'];
                        for ($i = 0; $i < count($dmanu); $i++) {
                            $dman = $dmanu[$i];
                            echo "<option value='$dman[ID_Manu]'>$dman[Name_Manu]</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-6 mt-3 mt-xl-0">
            <div class="input-group">
                <span class="input-group-text border-0 bg-transparent"> Hình ảnh</span>
                <input id="gallery-photo-add" type="file" accept="image/*" class="form-control rounded-pill" name="img[]" required multiple>
            </div>
            <div class="gallery mt-1 row row-cols-5 g-2 g-lg-3"></div>
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
                    <input type="text" vali name="sizeSC" class="form-control">
                    <label mess="sizeSC"></label>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-form-label">Độ phân giải</label>
                <div class="col-sm-8">
                    <input type="text" vali name="resoSC" class="form-control">
                    <label mess="resoSC"></label>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-form-label">Tần số quét</label>
                <div class="col-sm-8">
                    <input type="text" vali name="freSC" class="form-control">
                    <label mess="freSC"></label>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-form-label">Công nghệ</label>
                <div class="col-sm-8">
                    <input type="text" vali name="techSC" class=" form-control">
                    <label mess="techSC"></label>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-6 my-0 p-3 border">
            <h4>RAM</h4>
            <div class="row">
                <label class="col-sm-4 col-form-label">Dung lượng</label>
                <div class="col-sm-8">
                    <input type="text" vali name="memRAM" class="form-control">
                    <label mess="memRAM"></label>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-form-label">Loại RAM</label>
                <div class="col-sm-8">
                    <input type="text" vali name="typeRAM" class="form-control">
                    <label mess="typeRAM"></label>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-form-label">Bus RAM</label>
                <div class="col-sm-8">
                    <input type="text" vali name="busRAM" class="form-control">
                    <label mess="busRAM"></label>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-form-label">Hỗ trợ tối đa</label>
                <div class="col-sm-8">
                    <input type="text" vali name="maxRAM" class="form-control">
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
                    <input type="text" vali no-re name="port" class="form-control">
                    <label mess="port"></label>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-form-label">Kết nối không dây</label>
                <div class="col-sm-8">
                    <input type="text" vali no-re name="wireless" class="form-control">
                    <label mess="wireless"></label>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-form-label">Âm thanh</label>
                <div class="col-sm-8">
                    <input type="text" vali no-re name="audio" class="form-control">
                    <label mess="audio"></label>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-form-label">Webcam</label>
                <div class="col-sm-8">
                    <input type="text" vali no-re name="webcam" class="form-control">
                    <label mess="webcam"></label>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-form-label">Đèn bàn phím</label>
                <div class="col-sm-8">
                    <input type="text" vali no-re name="ledKB" class="form-control">
                    <label mess="ledKB"></label>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-6 my-0 p-3 border">
            <h4 class="d-inline-block">Thông tin khác </h4> <span class="fst-italic"> (không bắt buộc !)</span>
            <div class="row">
                <label class="col-sm-4 col-form-label">Thông số vật lý</label>
                <div class="col-sm-8">
                    <input type="text" vali no-re name="d_w" class="form-control">
                    <label mess="d_w"></label>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-form-label">Chất liệu</label>
                <div class="col-sm-8">
                    <input type="text" vali no-re name="material" class="form-control">
                    <label mess="material"></label>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-form-label">Pin</label>
                <div class="col-sm-8">
                    <input type="text" vali no-re name="pin" class="form-control">
                    <label mess="pin"></label>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-form-label">Tính năng khác</label>
                <div class="col-sm-8">
                    <input type="text" vali no-re name="otherF" class="form-control">
                    <label mess="otherF"></label>
                </div>
            </div>
            <div class="row">
                <label class="col-sm-4 col-form-label">Hệ điều hành</label>
                <div class="col-sm-8">
                    <input type="text" vali no-re name="os" class="form-control">
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