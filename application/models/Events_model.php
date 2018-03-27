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
    foreach ($res as $key => $value) {
      $res[$key]->image_url = base_url("{$this->upload_dir}/") . $value->image_url;
      $res[$key]->date_f = date_format(date_create($value->date),"F d, Y");
    }
    return $res;
  }



}
