<section id="main-content">
  <section class="wrapper">
    <!-- page start-->
    <div class="row">
      <div class="col-lg-12">
        <section class="panel">
          <header class="panel-heading">
            Gallery of project: <span style="font-weight:bold"><?php echo $project->title ?></span> <br>
            <?php if ($flash_msg = $this->session->flash_msg): ?>
              <sub style="color: <?php echo $flash_msg['color'] ?>"><?php echo $flash_msg['message'] ?></sub> <br>
            <?php endif; ?>
            <br>
            <a href="<?php echo base_url('admin/projects?page=' . $this->input->get('_p')) ?>">
              <button type="button" class="btn btn-info btn-sm">&laquo; Go back</button>
            </a>
            <button type="button" class="add-btn btn btn-success btn-sm">Add new</button>
          </header>

          <div class="panel-body">
            <div class="adv-table">
              <table  class="display table table-bordered table-striped" id="dynamic-table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1; foreach ($gallery as $key => $value): ?>
                    <tr>
                      <td><?php echo $i++ ?></td>
                      <td><a href="<?php echo $value->image_url ?>" target="_blank">
                        <img src="<?php echo $value->image_url ?>" alt="" style="max-width:90px">
                      </a></td>
                      <td>
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
                  <label >Image</label>
                  <input type="file" name="image_url" class="default" accept=".jpg,.png,.jpeg">
                </div>
                <input type="hidden" name="project_id" value="<?php echo $project->id ?>">

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

    </section>
  </section>

  <script src="<?php echo base_url('public/admin/js/custom/') ?>projects_gallery_management.js"></script>
  <script src="<?php echo base_url('public/admin/js/custom/') ?>generic.js"></script>
