<section id="main-content">
  <section class="wrapper">
    <!-- page start-->
    <div class="row">
      <div class="col-lg-12">
        <section class="panel">
          <header class="panel-heading">
            Administrators
            <?php if ($update_msg = $this->session->update_msg): ?>
              <br><sub style="color: <?php echo $update_msg['color'] ?>"><?php echo $update_msg['message'] ?></sub>
            <?php endif; ?>
          </header>
          <div class="panel-body">
            <div class="table-responsive" style="overflow: hidden; outline: none;" tabindex="1">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1; foreach ($admins as $key => $admin): ?>
                    <tr>
                      <th scope="row"><?php echo $i++ ?></th>
                      <td><?php echo $admin->name ?></td>
                      <td><?php echo $admin->email ?></td>
                      <td>
                        <button type="button"
                        data-payload='<?php echo json_encode(['id' => $admin->id, 'name' => $admin->name, 'email' => $admin->email])?>'
                        class="edit-row btn btn-info btn-xs">Edit</button>
                        <button type="button" class="btn btn-danger btn-xs">Delete</button>
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
        <h4 class="modal-title">Edit</h4>
      </div>
      <div class="modal-body">

        <form role="form" method="post">
          <div class="form-group">
            <label >Name</label>
            <input type="text" class="form-control" name="name" placeholder="Name">
          </div>
          <div class="form-group">
            <label >Email address</label>
            <input type="email" class="form-control" name="email" placeholder="Email">
          </div>
          <div class="form-group">
            <label >Password</label>
            <input type="password" class="form-control" name="password" placeholder="New Password">
          </div>
          <div class="form-group">
            <label >Confirm Password</label>
            <input type="password" class="form-control" name="confirm_password" placeholder="Confirm New Password">
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

<script src="<?php echo base_url('public/admin/js/custom/') ?>admin_management.js"></script>
