<?php

class Bulk_import_model extends Admin_core_model # application/core/MY_Model.php
{
  function __construct()
  {
    parent::__construct();
    $this->table = 'bulk_import';
    $this->upload_dir = 'uploads/bulk_import';
  }

  public function upload($file_key)
  {
    @$file = $_FILES[$file_key];
    $upload_path = $this->upload_dir;

    $config['upload_path'] = $upload_path; # NOTE: Change your directory as needed
    $config['allowed_types'] = 'csv'; # NOTE: Change file types as needed
    $config['file_name'] =  "bulk_import_" . time() . '_' . $file['name']; # Set the new filename
    $this->upload->initialize($config);

    if (!is_dir($upload_path) && !mkdir($upload_path, DEFAULT_FOLDER_PERMISSIONS, true)){
      mkdir($upload_path, DEFAULT_FOLDER_PERMISSIONS, true); # You can set DEFAULT_FOLDER_PERMISSIONS constant in application/config/constants.php
    }
    if($this->upload->do_upload($file_key)){
      return [$file_key => $this->upload->data('file_name')];
    }else{
      return [];
    }
  }

  public function appendCsv($csv_arr)
  {
    $data = $this->formatCsvArr($csv_arr);
    return $this->db->insert_batch('sales', $data);
  }

  public function replaceCsv($csv_arr)
  {
    $data = $this->formatCsvArr($csv_arr);
    # delete block
    $this->db->truncate('sales');
    #/ delete block

    $this->db->reset_query();
    return $this->db->insert_batch('sales', $data);
  }

  public function formatCsvArr($csv_arr)
  {
    unset($csv_arr[0]);
    $new_arr = [];

    foreach ($csv_arr as $key => $value) {
      $new_arr[] = [
        'project_name' => $value[0],
        'sales_amount' => $value[1],
        'date' => $value[2],
        'seller_id' => $this->sellers_model->getByEmail($value[3])->id
      ];
    }

    return $new_arr;
  }

  public function getLastUploadedCsv()
  {
    $this->db->order_by('id', 'desc');
    $res = $this->db->get($this->table)->row()->file_name;

    return base_url($this->upload_dir . "/") . $res;
  }

}
