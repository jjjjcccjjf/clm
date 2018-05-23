<?php
$qs_arr = explode('&', $_SERVER['QUERY_STRING']);
$qs_arr = removeFromArrayStart('page', $qs_arr);;
$qs = implode('&', $qs_arr);
function removeFromArrayStart($word, $arr)
{
  foreach ($arr as $key => $value) {
    if (strpos($value, $word) !== false) {
      unset($arr[$key]);
    }
  }
  return $arr;
}

?>
<section id="main-content">
  <section class="wrapper">
    <!-- page start-->
    <div class="row">
      <div class="col-lg-12">
        <section class="panel">
          <header class="panel-heading">
            Accomplished Accreditation Forms
            <div class="pull-right">
              <form method="get">
                <input type="date" name="from_date" value="<?php echo ($this->input->get('from_date')) ?: date('Y-m-d'); ?>"> to
                <input type="date" name="to_date" value="<?php echo ($this->input->get('to_date')) ?: date('Y-m-d', strtotime('+1 day', strtotime(date('Y-m-d')))); ?>">
                <input type="submit" value="Filter">
              </form>
            </div>
            <?php if ($flash_msg = $this->session->flash_msg): ?>
              <br><sub style="color: <?php echo $flash_msg['color'] ?>"><?php echo $flash_msg['message'] ?></sub>
            <?php endif; ?>
          </header>
          <div class="panel-body">
            <div class="table-responsive" style="overflow: hidden; outline: none;" tabindex="1">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Full name</th>
                    <th>Photo</th>
                    <th>Accreditation Form</th>
                    <th>Date Submitted</th>
                    <th style="width:300px">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (count($accreditation_forms) > 0 ): ?>

                    <?php $i = 1; foreach ($accreditation_forms as $key => $value): ?>
                      <tr>
                        <th scope="row"><?php echo $i++ ?></th>
                        <td><?php echo $value->full_name ?></td>
                        <td><a href="<?php echo $value->image_url ?>" target="_blank">
                          <img src="<?php echo $value->image_url ?>" alt="" style="max-width:90px">
                        </a></td>
                        <td><a href="<?php echo $value->form_url ?>" target="_blank">
                          <button type="button" class="btn btn-xs btn-info">
                            <i class="fa fa-eye"></i> View accreditation form
                          </button>
                        </a></td>
                        <td>
                          <?php echo $value->created_at_f ?>
                        </td>
                        <td>
                          <button type="button" data-id='<?php echo $value->id; ?>'
                            class="btn btn-delete btn-danger btn-xs">Delete</button>
                            <?php if ($value->is_marked): ?>
                                <button type="button" data-id='<?php echo $value->id; ?>'
                                  class="btn btn-unmark btn-success btn-xs">Completed <i class="fa fa-check"></i></button>
                            <?php else: ?>
                              <button type="button" data-id='<?php echo $value->id; ?>'
                                class="btn btn-mark btn-warning btn-xs">Unmarked <i class="fa fa-times"></i></button>
                            <?php endif; ?>

                            <a href="<?php echo $value->form_url ?>?fdl=1" >
                              <button type="button" class="btn btn-xs btn-info">
                                <i class="fa fa-download"></i> Download accreditation form
                              </button>
                            </a>
                            <a href="<?php echo $value->image_url ?>?fdl=1">
                              <button type="button" class="btn btn-xs btn-info">
                                <i class="fa fa-download"></i> Download profile photo
                              </button>
                            </a>
                            </td>
                          </tr>
                        <?php endforeach; ?>

                      <?php else: ?>
                        <tr>
                          <td colspan="6" style="text-align:center">Empty table data</td>
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
                          href="<?php echo base_url('admin/accreditation_forms')
                          . "?page=" . $i . $qs;
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

      <script src="<?php echo base_url('public/admin/js/custom/') ?>accreditation_forms.js"></script>
      <script src="<?php echo base_url('public/admin/js/custom/') ?>generic.js"></script>
