<h1 style='color: blue;' align='center'>THÊM LOẠI LAPTOP</h1>
<form action="" method="post" class="col-12 col-xl-6 container">
     <div>
          <label for="field1" class="form-label">Mã loại laptop</label>
          <input id="field1" type="text" name="id" vali value="<?php echo @$_POST['id'] ?>" class="form-control">
          <label mess="id"></label>
     </div>
     <div>
          <label for="field2" class="form-label">Tên loại laptop</label>
          <input id="field2" type="text" name="name" vali value="<?php echo @$_POST['name'] ?>" class="form-control">
          <label mess="name"></label>
     </div>
     <div>
          <center>
               <button class="btn btn-outline-dark mt-3 disabled" name="sm" type="submit">
                    <h4 class="mx-3 my-1">Xác nhận</h4>
               </button>
          </center>
     </div>
     <div class="col-12 my-0 p-1">
</form>
