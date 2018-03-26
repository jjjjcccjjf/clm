<section id="main-content">
  <section class="wrapper">
    <!-- page start-->
    <div class="row">
      <div class="col-lg-12">
        <section class="panel">
          <header class="panel-heading">
            News
            <?php if ($flash_msg = $this->session->flash_msg): ?>
              <br><sub style="color: <?php echo $flash_msg['color'] ?>"><?php echo $flash_msg['message'] ?></sub>
            <?php endif; ?>
          </header>
          <div class="panel-body">
            <p>
              <button type="button" class="add-btn btn btn-success btn-sm">Add new</button>
            </p>
            <div class="table-responsive" style="overflow: hidden; outline: none;" tabindex="1">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1; foreach ($news as $key => $value): ?>
                    <tr>
                      <th scope="row"><?php echo $i++ ?></th>
                      <td><?php echo $value->title ?></td>
                      <td><?php echo $value->description ?></td>
                      <td><a href="<?php echo $value->image_url ?>">
                        <img src="<?php echo $value->image_url ?>" alt="" style="max-width:90px">
                      </a></td>
                      <td>
                        <button type="button"
                        data-payload='<?php echo json_encode(['id' => $value->id, 'title' => $value->title, 'content' => $value->content, 'image_url' => $value->image_url])?>'
                        class="edit-row btn btn-info btn-xs">Edit</button>
                        <button type="button" data-id='<?php echo $value->id; ?>'
                          class="btn btn-delete btn-danger btn-xs">Delete</button>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
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
              rows="8" cols="60"></textarea>
            </div>
            <div class="form-group">
              <label >Image</label>
              <input type="file" name="image_url" class="default">
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

  <script src="<?php echo base_url('public/admin/js/custom/') ?>news_management.js"></script>
  <script src="<?php echo base_url('public/admin/js/custom/') ?>generic.js"></script>