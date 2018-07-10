<section id="main-content">
  <section class="wrapper">
    <!-- page start-->
    <div class="row">
      <div class="col-lg-12">
        <section class="panel">
          <header class="panel-heading">
            Sales of user: <span style="font-weight:bold"><?php echo $seller->full_name ?></span>
          </header>
          <header class="panel-heading" >
            <?php if ($flash_msg = $this->session->flash_msg): ?>
              <sub style="color: <?php echo $flash_msg['color'] ?>"><?php echo $flash_msg['message'] ?></sub>
            <?php else: ?>
              &nbsp;
            <?php endif; ?>
            <div class="pull-right">
              <?php if ($seller->imported_csv): ?>
                <a href="<?php echo $seller->imported_csv ?>">
                  <button class="btn btn-warning btn-xs" type="button">
                    <i class="fa fa-download"></i>
                    Download Last Imported</button>
                  </a>
                <?php endif; ?>
                <a href="#myModal" data-toggle="modal"
                class="btn btn-info btn-xs" title="Import and replace all existing data for <?php echo $seller->full_name?>"
                <i class="fa fa-pencil-square-o"></i> Import and Replace
              </a>
            </div>
          </header>

          <div class="panel-body">
            <div class="adv-table">
              <table  class="display table table-bordered table-striped" id="dynamic-table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Project name</th>
                    <th>Sales amount</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1; foreach ($sales as $key => $value): ?>
                    <tr>
                      <td><?php echo $i++ ?></td>
                      <td><?php echo $value->project_name ?></td>
                      <td><?php echo $value->sales_amount_f ?></td>
                      <td><?php echo $value->date_f ?></td>
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
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog ">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Manage
            </h4>
          </div>
          <div class="modal-body">

            <form role="form" method="post" action="<?php echo base_url('admin/sales/import/' . $_GET['u']) ?>" enctype='multipart/form-data'>
              <div class="row">
                <div class="form-group col-md-6">
                  <h4>Import CSV file</h4>
                  <a href="<?php echo base_url('public/uploads/sales_template.csv') ?>">
                    <button class="btn btn-warning btn-xs" type="button">
                      <i class="fa fa-download"></i>
                      Download CSV Template</button>
                    </a>
                  </div>
                </div>
                <div class="form-group">
                  <input type="file" class="form-control" name="imported_csv" accept=".csv">
                  <input type="hidden" name="full_name" value="<?php echo $seller->full_name?>">
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
      <!-- modal -->
    </section>
  </section>

  <script src="<?php echo base_url('public/admin/js/custom/') ?>generic.js"></script>
