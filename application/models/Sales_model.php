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

  public function uploadF($file_key, $full_name)
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

    return $total_sales;
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

  public function monthToDateSales($id)
  {
    $this->db->like('date', date('Y-m'));
    $per_page = $this->per_page;
    $res =  $this->db->get_where('sales', ['seller_id' => $id])->result();

    $total_sales = 0;
    foreach ($res as $item) {
      $total_sales += $item->sales_amount;
    }

    return $total_sales;
  }

  public function yearToDateSales($id)
  {
    $this->db->like('date', date('Y'));
    $per_page = $this->per_page;
    $res =  $this->db->get_where('sales', ['seller_id' => $id])->result();

    $total_sales = 0;
    foreach ($res as $item) {
      $total_sales += $item->sales_amount;
    }

    return $total_sales;
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

  public function getAccumulatedPoints($id)
  {
    return $this->sellers_model->get($id)->accumulated_points;
  }

  /**
  * eww, gross!
  */
  public function getGrossPoints($id)
  {
    $gross_sales = $this->db->query('SELECT SUM(sales_amount) as sales_amount
    FROM sales WHERE seller_id = ' . $id . '')->row()->sales_amount;
    $accumulated_points = $this->getAccumulatedPoints($id);

    return floor($gross_sales / 1000000) + $accumulated_points;
  }

  public function getPointsSpent($id)
  {
    $points_spent = $this->db->query('SELECT SUM(cost) as cost
    FROM rewards_history
    LEFT JOIN rewards ON rewards_history.reward_id = rewards.id
    WHERE seller_id = ' . $id . '')->row()->cost;

    return $points_spent;
  }

  public function getNetPoints($id)
  {
    return $this->getGrossPoints($id) - $this->getPointsSpent($id);
  }

  public function getLastAccumulatedYear()
  {
    return $this->db->get('annual_refresh')->row()->last_year_updated;
  }

  /**
  * this deletes the entire sales db
  * and converts the points to accumulated_points
  * in the sellers table
  * @return [type]        [description]
  */
  public function accumulateSales()
  {
    if ((int) $this->getLastAccumulatedYear() < (int) date('Y')) {

      $sellers = $this->sellers_model->all();

      #### STEP 1: Update all seller's accumulated points
      foreach ($sellers as $seller) {
        $this->updateAccumulatedPoints($seller->id);
      }

      #### STEP 2: Clear sales table
      $this->db->reset_query();
      $this->db->empty_table('sales');

      #### STEP 3: Update 'annual_refresh' table so script won't execute again this year
      #### clever, ain't it?
      $this->db->reset_query();
      $this->db->where('id', 1); # Only 1 entry, so...
      $this->db->update('annual_refresh', ['last_year_updated' => date('Y')]);
    }
  }

  public function updateAccumulatedPoints($seller_id)
  {
    $points = $this->getGrossPoints($seller_id);

    $this->db->where('id', $seller_id);
    return $this->db->update('sellers', ['accumulated_points' => $points]);
  }

}
