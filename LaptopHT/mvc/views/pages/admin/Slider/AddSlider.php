<div class="container" style="max-width: 640px;">
     <?php
     ?>
     <form acction="" method="post" class="border p-3 rounded my-5 bg-primary bg-opacity-25" enctype="multipart/form-data">
          <h2 class="text-center text-primary fw-bold "> Add Slide</h2>
          <div class="input-group mb-4 ">
               <span class="input-group-text fs-5" id="basic-addon1">Tiêu đề</span>
               <input name="title" type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
          </div>
          <div class="input-group mb-4">
               <span class="input-group-text bg-transparent border-0 fs-5" id="basic-addon2">Hình ảnh</span>
               <input name="img_slider" accept="image/*" type="file" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon2" required>
          </div>
          <div class="input-group mb-4">
               <span class="input-group-text fs-5" id="basic-addon3">Trạng thái</span>
               <input name="status" type="number" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon3">
          </div>
          <div class="mb-4 text-center ">
               <button name="sm" type="submit" class="py-2 px-4 btn btn-outline-dark fw-bold">Xác nhận</button>
          </div>
     </form>
</div>