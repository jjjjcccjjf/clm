<?php
class Events_model extends Admin_core_model # application/core/MY_Model.php
{
  function __construct()
  {
    parent::__construct();
    $this->table = 'events';
    $this->upload_dir = 'uploads/events';
    $this->per_page = 25;
  }

  public function all($month = null, $year = null)
  {

    # Block to show everything to admin
    if ($this->session->login_type === 'sellers') {
      if ($month && $year) {
        $this->db->where("month(date) = {$month} AND year(date) = {$year}");
      }else{
        $d = date('m');
        $y = date('Y');
        $this->db->where("month(date) = {$d} AND year(date) = {$y}");
      }
      $this->db->order_by('date', 'desc');
    } else {
      $page = $this->input->get('page') ?: 1;
      $per_page = $this->per_page;
      $offset = max(($page - 1) * $per_page, 0);
      $this->db->limit($per_page, $offset);
    }

    $res = $this->db->get($this->table)->result();
    $res = $this->filterFields($res);
    return $res;
  }

  public function getEventsPerPeriod($month, $year)
  {
    $res = $this->db->query("SELECT * FROM `events` WHERE month(date) = {$month} AND year(date) = {$year} ORDER BY date DESC")->result();
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
