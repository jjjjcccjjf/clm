<?php
class Events_model extends Admin_core_model # application/core/MY_Model.php
{
  function __construct()
  {
    parent::__construct();
    $this->table = 'events';
    $this->upload_dir = 'uploads/events';
  }

  public function all()
  {
    $res = $this->db->get($this->table)->result();
    $res = $this->filterFields($res);
    return $res;
  }

  public function getEventsPerPeriod($month, $year)
  {
    $res = $this->db->query("SELECT * FROM `events` WHERE month(date) = {$month} AND year(date) = {$year}")->result();
    $res = $this->filterFields($res);
    return $res;
  }

  public function filterFields($res)
  {

    foreach ($res as $key => $value) {
      if (!(strpos($value->image_url, 'http') === 0)) {
        $res[$key]->image_url = base_url("{$this->upload_dir}/") . $value->image_url;
      }
      $res[$key]->date_f = date_format(date_create($value->date),"F d, Y");
      $res[$key]->day = date_format(date_create($value->date),"d");
      $res[$key]->month = date_format(date_create($value->date),"m");
      $res[$key]->year = date_format(date_create($value->date),"Y");
      $res[$key]->excerpt = (strlen($value->description) > 50)? substr($value->description, 0, 50) . "..." : $value->description;
    }

    return $res;
  }

}
