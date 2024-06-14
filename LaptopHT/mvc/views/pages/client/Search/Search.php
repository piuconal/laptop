<div class=" bg-dark bg-opacity-50">
    <div class="border">
        <div class="d-flex p-2 pb-0">
            <?php
            foreach ($data['dManu'] as $key => $value)
                echo "<a  href='$data[domain]/Search/$value[Name_Manu]' class=' badge fs-5 border-2 border-bottom border-end boder-light flex-fill fst-italic btn  fw-bold rounded-pill bg-dark text-light bg-gradient'> $value[Name_Manu]</a><span class='flex-fill'> </span>";
            ?>
        </div>
        <div class="d-flex justify-content-end p-2">
            <?php
            foreach ($data['dType'] as $key => $value)
                echo "<a href='$data[domain]/Search/$value[Name_Type]' class='badge fs-5 border-2 border-bottom border-end boder-light flex-fill fst-italic btn  fw-bold rounded-pill bg-dark text-light bg-gradient'> $value[Name_Type]</a><span class='flex-fill'> </span>";
            ?>
            <select id="sapxep" class="form-select border-primary border-1 text-primary" aria-label="Default select example" style="width: 120px;">
                <option value="Add_Time/DESC" selected>Mới nhất</option>
                <option value="Add_Time/ASC">Cũ nhất</option>
                <option value="Price/ASC">Giá tăng dần</option>
                <option value="Price/DESC">Giá giảm dần</option>
            </select>
        </div>
    </div>
    <div id="Listlaptop" class="row row-cols-2 row-cols-lg-3 row-cols-xl-4 g-2">
    </div>
    <div class="text-center">
        <button id="XemThem" class="btn btn-secondary mt-3" style="padding: 5px 125px; display:none;">Xem thêm</button>
    </div>
</div>
<script>
    var vt = 0;
    $(document).ready(function() {
        load_Laptop();
    })
    $("#sapxep").change(function() {
        vt = 0;
        $("#Listlaptop").html('');
        console.log($(this).val());
        load_Laptop($(this).val());
    })
    $("#XemThem").click(function() {
        load_Laptop($("#sapxep").val());
    })

    function load_Laptop(sx = "Add_Time/DESC") {
        $.post('<?php echo "$data[domain]/Ajax/Get_Search_Laptop/$data[info]/" ?>' + vt + "/" + sx, {}, function(data) {
            $("#Listlaptop").append(data);
            vt = vt + 1;
            $.post('<?php echo "$data[domain]/Ajax/Get_Search_Laptop/$data[info]/" ?>' + vt + "/" + sx, {}, function(data) {
                if (data != "")
                    $("#XemThem").css("display", "inline-block");
                else
                    $("#XemThem").css("display", "none");
            })
        })
    }
</script>