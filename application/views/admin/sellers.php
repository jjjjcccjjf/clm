<section id="main-content">
  <section class="wrapper">
    <!-- page start-->
    <div class="row">
      <div class="col-lg-12">
        <section class="panel">
          <header class="panel-heading">
            Sellers
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
                    <th>Full name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Date created</th>
                    <th>Photo</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (count($sellers) > 0 ): ?>

                    <?php $i = 1; foreach ($sellers as $key => $value): ?>
                      <tr>
                        <th scope="row"><?php echo $i++ ?></th>
                        <td><?php echo $value->full_name ?></td>
                        <td><?php echo $value->email ?></td>
                        <td><?php echo $value->mobile_num ?></td>
                        <td><?php echo $value->created_at_f ?></td>
                        <td><a href="<?php echo $value->image_url ?>" target="_blank">
                          <img src="<?php echo $value->image_url ?>" alt="" style="max-width:90px">
                        </a></td>
                        <td>
                          <button type="button" data-edit-type="update"
                          data-payload='<?php echo json_encode(
                            ['id' => $value->id,
                            'full_name' => $value->full_name,
                            'birth_date' => $value->birth_date,
                            'gender' => $value->gender,
                            'civil_status' => $value->civil_status,
                            'home_address' => $value->home_address,
                            'office_address' => $value->office_address,
                            'mobile_num' => $value->mobile_num,
                            'office_fax' => $value->office_fax,
                            'home_num' => $value->home_num,
                            'email' => $value->email,
                            'real_estate_record_payload' => $value->real_estate_record_payload,
                            'real_estate_record_type' => $value->real_estate_record_type,
                            'image_url' => $value->image_url
                            ])?>'
                            class="edit-row btn btn-info btn-xs">Edit</button>
                            <button type="button" data-id='<?php echo $value->id; ?>'
                              class="btn btn-delete btn-danger btn-xs">Delete</button>
                              <?php if ($value->pending_payload !== '[{},{}]'):
                                $seller_pending = json_decode($value->pending_payload)[1];
                                $seller_pending->real_estate_record_payload = json_decode($value->pending_payload)[0];

                                ?>
                              <button type="button"
                              data-edit-type="review"
                              data-payload='<?php echo json_encode(
                                ['id' => $value->id,
                                'full_name' => $seller_pending->full_name,
                                'birth_date' => $seller_pending->birth_date,
                                'gender' => $seller_pending->gender,
                                'civil_status' => $seller_pending->civil_status,
                                'home_address' => $seller_pending->home_address,
                                'office_address' => $seller_pending->office_address,
                                'mobile_num' => $seller_pending->mobile_num,
                                'office_fax' => $seller_pending->office_fax,
                                'home_num' => $seller_pending->home_num,
                                'email' => $seller_pending->email,
                                'real_estate_record_payload' => $seller_pending->real_estate_record_payload,
                                'real_estate_record_type' => $seller_pending->real_estate_record_type,
                                'image_url' => $seller_pending->image_url
                                ])?>'
                                class="edit-row btn btn-warning btn-xs">Review Pending</button>
                              <?php endif; ?>
                            </td>
                          </tr>
                        <?php endforeach; ?>

                      <?php else: ?>
                        <tr>
                          <td colspan="7" style="text-align:center">Empty table data</td>
                        </tr>
                      <?php endif; ?>
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
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Manage</h4>
          </div>
          <div class="modal-body">

            <form role="form" method="post" enctype='multipart/form-data'>

              <div class="row">
                <div class="form-group col-md-6">
                  <h4>Personal Information</h4>
                </div>
              </div>

              <div class="row">
                <div class="form-group col-md-6">
                  <label >Full name</label>
                  <input type="text" class="form-control" name="full_name" placeholder="Full name" required="required">
                </div>
                <div class="form-group col-md-6">
                  <label >Birth date</label>
                  <input class="form-control" type="date" required="required"
                  name="birth_date">
                </div>
              </div>

              <div class="row">
                <div class="form-group col-md-6">
                  <label >Gender</label>
                  <select class="form-control" name="gender">
                    <option>Male</option>
                    <option>Female</option>
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label >Civil status</label>
                  <select class="form-control" name="civil_status">
                    <option>Single</option>
                    <option>Married</option>
                    <option>Widowed</option>
                  </select>
                </div>
              </div>

              <div class="row">
                <div class="form-group col-md-12">
                  <label >Home address</label>
                  <input class="form-control" type="text" placeholder="Home address" required="required"
                  name="home_address" value="">
                </div>
              </div>

              <div class="row">
                <div class="form-group col-md-12">
                  <label >Office address</label>
                  <input class="form-control" type="text" placeholder="Office address" required="required"
                  name="office_address" value="">
                </div>
              </div>

              <!-- ---------------------- -->

              <div class="row">
                <div class="form-group col-md-6">
                  <h4>Contact Information</h4>
                </div>
              </div>

              <div class="row">
                <div class="form-group col-md-6">
                  <label >Mobile number</label>
                  <input type="text" class="form-control" name="mobile_num" placeholder="Mobile" required="required">
                </div>
                <div class="form-group col-md-6">
                  <label >Office / Fax</label>
                  <input type="text" class="form-control" name="office_fax" placeholder="Office / Fax">
                </div>
              </div>

              <div class="row">
                <div class="form-group col-md-6">
                  <label >Home number</label>
                  <input type="text" class="form-control" name="home_num" placeholder="Mobile">
                </div>
                <div class="form-group col-md-6">
                  <label >Email address</label>
                  <input type="email" class="form-control" name="email" placeholder="Email" required="required">
                </div>
              </div>

              <!-- ---------------------- -->

              <div class="row">
                <div class="form-group col-md-6">
                  <h4>Real Estate Record</h4>
                  <h5>Are you a broker or an agent?</h5>
                </div>
              </div>

              <div class="row">
                <div class="form-group col-md-6">
                  <label >
                    <input type="radio" id="chk_broker" name="real_estate_record_type" value="Broker">
                    Broker
                  </label>
                </div>
                <div class="form-group col-md-6">
                  <label >
                    <input type="radio" id="chk_agent" name="real_estate_record_type" value="Agent">
                     Agent
                  </label>
                </div>
              </div>

              <div id="real_estate_record_dynamic">
                <!-- loaded through jQuery -->
              </div>

              <div class="row">
                <div class="form-group col-md-6">
                  <label >Upload 1x1 photo <sub>(.jpg & .png only)</sub></label>
                  <input type="file" class="form-control" name="image_url" accept=".jpg,.png,.jpeg">
                </div>
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

    <script src="<?php echo base_url('public/admin/js/custom/') ?>sellers_management.js"></script>
    <script src="<?php echo base_url('public/admin/js/custom/') ?>generic.js"></script>
