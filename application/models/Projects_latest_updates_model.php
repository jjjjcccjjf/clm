<?php
class Projects_latest_updates_model extends Admin_core_model # application/core/MY_Model
{
  function __construct()
  {
    parent::__construct();
    $this->table = 'projects_latest_updates';
    $this->upload_dir = 'uploads/projects_latest_updates';
  }

  public function getLatestUpdates($fk)
  {
    $this->db->where('project_id', $fk);
    $res = $this->db->get($this->table)->result();

    foreach ($res as $key => $value) {
      if (!(strpos($value->image_url, 'http') === 0)) {
        $res[$key]->image_url = base_url("{$this->upload_dir}/") . $value->image_url;
      }
       $res[$key]->date_f = date_format(date_create($value->date),"F d, Y"); 
    }

    return $res;

  }

  public function getLatestUpdatesF($fk)
  {
    $res = $this->getLatestUpdates($fk);

    $dates_arr = []; # holder for all unique dates

    foreach ($res as $key => $value) {
      $dates_arr[] = $value->date;
    }

    # We get the unique dates here
    # and make them array keys
    $unique_dates = array_unique($dates_arr);

    $res_f = [];

    foreach ($unique_dates as $ud) {

      $tmp_arr = []; #temporary holder for res values

      foreach ($res as $val) { # res arr
        if ($val->date == $ud) {
          $tmp_arr[] = $val;
        }
      }

      $res_f[$ud] = $tmp_arr;
    }

    return $res_f;
  }

}
