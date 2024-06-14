<div class="container" style="max-width: 640px;">
     <?php
     ?>
     <form acction="" method="post" class="border p-3 rounded my-5 bg-primary bg-opacity-25" enctype="multipart/form-data">
          <h2 class="text-center text-primary fw-bold "> Edit Slide</h2>
          <div class="input-group mb-4 ">
               <span class="input-group-text fs-5" id="basic-addon1">Tiêu đề</span>
               <input name="title" value="<?php echo @$data['dSlider']['Title']?>" type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
          </div>
          <div class="input-group mb-4">
               <span class="input-group-text bg-transparent border-0 fs-5" id="basic-addon2">Hình ảnh</span>
               <input name="img_slider" accept="image/*" type="file" class="form-control " placeholder="Username" aria-label="Username" aria-describedby="basic-addon2">
          </div>
          <div style='height:200px;' class="overflow-hidden mb-4"><img class="d-block w-100" src='<?php echo "$data[domain]/images/slider/".$data['dSlider']['Image']; ?>' /></div>
          <div class="input-group mb-4">
               <span class="input-group-text fs-5" id="basic-addon3">Trạng thái</span>
               <input name="status" value="<?php echo @$data['dSlider']['Status']?>" type="bumber" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon3">
          </div>
          <div class="mb-4 text-center ">
               <button name="sm" type="submit" class="py-2 px-4 btn btn-outline-dark fw-bold">Xác nhận</button>
          </div>
     </form>
</div>