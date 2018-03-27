<section id="main-content">
  <section class="wrapper">
    <!-- page start-->
    <div class="row">
      <div class="col-lg-12">
        <section class="panel">
          <header class="panel-heading">
            About
            <?php if ($flash_msg = $this->session->flash_msg): ?>
              <br><sub style="color: <?php echo $flash_msg['color'] ?>"><?php echo $flash_msg['message'] ?></sub>
            <?php endif; ?>
          </header>
          <div class="panel-body">
            <p>
              <button
              data-payload='<?php echo json_encode([
                'id' => $about->id,
                'title'=> $about->title,
                'iframe_code'=> $about->iframe_code,
                'description'=> $about->description
                ]) ?>'
              type="button" class="add-btn btn btn-success btn-sm">Edit</button>
            </p>
            <h4><?php echo $about->title ?></h4>
            <?php echo $about->iframe_code; ?>
            <br>
            <p>
              <?php echo $about->description; ?>
            </p>
          </div>
        </section>
      </div>
    </div>
    <!-- page end-->
  </section>
</section>

<!-- Modal -->
<div class="modal fade " id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Manage</h4>
      </div>
      <div class="modal-body">

        <form role="form" method="post" enctype='multipart/form-data'>
          <div class="form-group">
            <label >Title</label>
            <input type="text" class="form-control" name="title" placeholder="Name">
          </div>
          <div class="form-group">
            <label >Description</label>
            <textarea name="description" placeholder="Description"
            class="form-control" style="resize:vertical"
            rows="8" cols="30"></textarea>
          </div>
          <div class="form-group">
            <label >Iframe code <br>
              <sub>On youtube's website, click share -> embed -> then copy paste the embed code below</sub>
            </label>
            <textarea name="iframe_code" placeholder="Description"
            class="form-control" style="resize:vertical"
            rows="8" cols="20"></textarea>
          </div>

        </div>
        <div class="modal-footer">
          <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
          <input class="btn btn-info" type="submit" value="Save changes">
        </div>
      </form>
    </div>
  </div>
</div>
<!-- modal -->

<script src="<?php echo base_url('public/admin/js/custom/') ?>about_management.js"></script>
<script src="<?php echo base_url('public/admin/js/custom/') ?>generic.js"></script>
