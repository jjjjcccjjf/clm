<section id="main-content">
  <section class="wrapper">
    <!-- page start-->
    <div class="row">
      <div class="col-lg-12">
        <section class="panel">
          <header class="panel-heading">
            Projects
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
                    <th>Address</th>
                    <th>Total land area</th>
                    <th>Phases</th>
                    <th>Status</th>
                    <th>Photo</th>
                    <th style="width:380px">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (count($projects) > 0 ): ?>

                    <?php foreach ($projects as $key => $value): ?>
                      <tr>
                        <th scope="row"><?php echo $value->id?></th>
                        <td><?php echo $value->title ?></td>
                        <td><?php echo $value->address ?></td>
                        <td><?php echo $value->total_land_area ?></td>
                        <td><?php echo $value->phases ?></td>
                        <td><?php echo $value->status ?></td>
                        <td><a href="<?php echo $value->image_url ?>" target="_blank">
                          <img src="<?php echo $value->image_url ?>" alt="" style="max-width:90px">
                        </a></td>
                        <td>
                          <button type="button" data-edit-type="update"
                          data-payload='<?php echo json_encode(
                            ['id' => $value->id,
                            'title' => $value->title,
                            'address' => $value->address,
                            'total_land_area' => $value->total_land_area,
                            'phases' => $value->phases,
                            'status' => $value->status,
                            'image_url' => $value->image_url,
                            ])?>'
                            class="edit-row btn btn-info btn-xs">Edit</button>
                            <!-- gallery button -->
                            <a href="<?php echo base_url('admin/projects_gallery?p=') . $value->id . "&_p=" . $this->input->get('page') ?>">
                              <button type="button" data-id='<?php echo $value->id; ?>'
                                class="btn btn-gallery btn-warning btn-xs">Gallery</button>
                              </a>
                              <!-- /gallery button -->
                            <!-- latest updates -->
                            <a href="<?php echo base_url('admin/projects_latest_updates?p=') . $value->id . "&_p=" . $this->input->get('page') ?>">
                              <button type="button" data-id='<?php echo $value->id; ?>'
                                class="btn btn-gallery btn-warning btn-xs">Latest updates</button>
                              </a>
                              <!-- /latest updates -->
                            <!-- downloadables button -->
                            <a href="<?php echo base_url('admin/projects_downloadables?p=') . $value->id . "&_p=" . $this->input->get('page') ?>">
                              <button type="button" data-id='<?php echo $value->id; ?>'
                                class="btn btn-downloadables btn-success btn-xs">Downloadables</button>
                              </a>
                              <!-- /downloadables button -->
                              <button type="button" data-id='<?php echo $value->id; ?>'
                                class="btn btn-delete btn-danger btn-xs">Delete</button>
                                </td>
                              </tr>
                            <?php endforeach; ?>

                          <?php else: ?>
                            <tr>
                              <td colspan="8" style="text-align:center">Empty table data</td>
                            </tr>
                          <?php endif; ?>
                        </tbody>
                      </table>
                      <style>
                        .active_lg {
                          background: lightgray !important
                        }
                      </style>
                      <ul class="pagination">
                        <ul class='pagination'>
                          <?php
                          $page = ($this->input->get('page')) ?: 1;
                          for ($i=1; $i <= $total_pages; $i++) { ?>
                            <li><a
                              class="<?php echo ($i == $page) ? 'active_lg' : '' ?>"
                              href="<?php echo base_url('admin/projects')
                              . "?page=" . $i;
                              ?>"><?php echo $i ?></a></li>
                            <?php } ?>
                          </ul>
                        </ul>
                      </div>
                    </div>
                  </section>
                </div>
              </div>
              <!-- page end-->
            </section>
          </section>

          <!-- Modal -->
          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Manage</h4>
                </div>
                <div class="modal-body">

                  <form role="form" method="post" enctype='multipart/form-data'>
                    <div class="form-group">
                      <label >Title</label>
                      <input type="text" class="form-control" name="title" placeholder="Title" >
                    </div>
                    <div class="form-group">
                      <label >Address</label>
                      <input type="text" class="form-control" name="address" placeholder="Address" >
                    </div>
                    <div class="form-group">
                      <label >Total land area</label>
                      <input type="text" class="form-control" name="total_land_area" placeholder="Total land area" >
                    </div>
                    <div class="form-group">
                      <label >Phases</label>
                      <input type="text" class="form-control" name="phases" placeholder="Phases" >
                    </div>
                    <div class="form-group">
                      <label >Status</label>
                      <input type="text" class="form-control" name="status" placeholder="Status" >
                    </div>
                    <div class="form-group">
                      <label >Image</label>
                      <input type="file" name="image_url" class="default" accept=".jpg,.png,.jpeg">
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

          <script src="<?php echo base_url('public/admin/js/custom/') ?>projects_management.js"></script>
          <script src="<?php echo base_url('public/admin/js/custom/') ?>generic.js"></script>
