<?php

class Sales_model extends Admin_core_model # application/core/MY_Model.php
{
  function __construct()
  {
    parent::__construct();
    $this->table = 'sales';
    $this->per_page = 15;
    $this->upload_dir = 'uploads/sales';
  }

  public function upload($file_key, $full_name)
  {
    @$file = $_FILES[$file_key];
    $upload_path = $this->upload_dir;

    $config['upload_path'] = $upload_path; # NOTE: Change your directory as needed
    $config['allowed_types'] = 'csv'; # NOTE: Change file types as needed
    $config['file_name'] = $full_name . "_" . time() . '_' . $file['name']; # Set the new filename
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

  public function getSales($id, $page = 1, $from_date = null, $to_date = null)
  {
    $per_page = $this->per_page;
    $offset = max(($page - 1) * $per_page, 0);
    if ($from_date && $to_date) {
      $this->db->where("date BETWEEN '$from_date' AND '$to_date'");
    }
    $res =  $this->db->get_where('sales', ['seller_id' => $id], $per_page, $offset)->result();
    foreach ($res as $key => $value) {
      $res[$key]->date_f = date_format(date_create($value->date),"F d, Y");
      $res[$key]->sales_amount_f = round($value->sales_amount);
    }
    return $res;
  }

  public function getTotalSales($id, $from_date = null, $to_date = null)
  {
    if ($from_date && $to_date) {
      $this->db->where("date BETWEEN '$from_date' AND '$to_date'");
    }
    $res =  $this->db->get_where('sales', ['seller_id' => $id])->result();
    $total_sales = 0;
    foreach ($res as $item) {
      $total_sales += $item->sales_amount;
    }

    return number_format($total_sales);
  }

  public function getSalesTotalCount($id, $from_date = null, $to_date = null)
  {
    if ($from_date && $to_date) {
      $this->db->where("date BETWEEN '$from_date' AND '$to_date'");
    }
    $per_page = $this->per_page;
    $res =  $this->db->get_where('sales', ['seller_id' => $id])->result();

    return ceil(count($res) / $per_page);
  }

  /**
  * @deprecated
  * @param  [type] $id      [description]
  * @param  [type] $csv_arr [description]
  * @return [type]          [description]
  */
  public function appendCsv($id, $csv_arr)
  {
    $data = $this->formatCsvArr($id, $csv_arr);
    return $this->db->insert_batch($this->table, $data);
  }

  public function replaceCsv($id, $csv_arr)
  {
    $data = $this->formatCsvArr($id, $csv_arr);
    # delete block
    $this->db->where('seller_id', $id);
    $this->db->delete('sales');
    #/ delete block

    $this->db->reset_query();
    return $this->db->insert_batch($this->table, $data);
  }

  public function formatCsvArr($id, $csv_arr)
  {
    unset($csv_arr[0]);
    $new_arr = [];

    foreach ($csv_arr as $key => $value) {
      $new_arr[] = [
        'project_name' => $value[0],
        'sales_amount' => $value[1],
        'date' => $value[2],
        'seller_id' => $id
      ];
    }

    return $new_arr;
  }
}
