<section id="main-content">
  <section class="wrapper">
    <!-- page start-->
    <div class="row">
      <div class="col-lg-12">
        <section class="panel">
          <header class="panel-heading">
            Sales Bulk Import
            <?php if ($flash_msg = $this->session->flash_msg): ?>
              <br><sub style="color: <?php echo $flash_msg['color'] ?>"><?php echo $flash_msg['message'] ?></sub>
            <?php endif; ?>
          </header>


          <div class="panel-body">
            <div>
              <h4>Backup</h4>
              <br>
              <a class="btn btn-md btn-success" href="<?php echo $export_csv_url ?>"><i class="fa fa-download"></i> Export sales data CSV</a> <br> <br>
              <a class="btn btn-md btn-success" href="<?php echo $last_uploaded_csv_path; ?>"><i class="fa fa-download"></i> Download last imported CSV</a> <br> <hr>
              <h4>Bulk import Template</h4>
              <br>
              <a class="btn btn-md btn-info" href="<?php echo $bulk_upload_template_link; ?>"><i class="fa fa-download"></i> Download CSV template</a> <br> <hr>

              <h4>Add or Replace data</h4>
              <br>
              <form action="" method="post">
                <input class="form-control" type="file" name="file_name" accept=".csv"> <br>
                <a class="btn btn-md btn-info" id="imp_app"><i class="fa fa-download"></i> Bulk Import & Append</a> <br> <br>

                <a class="btn btn-md btn-danger" id="imp_rep"><i class="fa fa-download"></i> Bulk Import & Replace</a> <br> <br>
              </form>
            </div>
          </div>

        </section>
      </div>
    </div>
    <!-- page end-->

  </section>
</section>

<script type="text/javascript">
$(document).ready(function() {

  $("#imp_app").on('click', function(){
    ajaxCsv('bulk_append');
  });

  ////////////////////////////////

  $("#imp_rep").on('click', function(){
    ajaxCsv('bulk_replace');
  });

  function ajaxCsv(seg) {

    var q = '';

    if(seg === 'bulk_append') {
      q = 'IMPORT & APPEND';
    } else if (seg === 'bulk_replace') {
      q = 'IMPORT & REPLACE';
    }

    if ($('input[type=file]').val()) {
      if (confirm('Are you sure you want to perform ' + q + '?')) {

        var $form = $('form');
        var form_data = new FormData($form[0]);

        $form.empty();
        $form.append(loader_gif);

        $.ajax({
          url: base_url + 'admin/sales/' + seg,
          type: 'POST',
          data: form_data,
          success: function (result, textStatus, xhr) {
            location.reload();
          },
          cache: false,
          contentType: false,
          processData: false
        });
      }

    } else {
      alert('Please choose a file first')
    }
  }

});
</script>

<script src="<?php echo base_url('public/admin/js/custom/') ?>generic.js"></script>
