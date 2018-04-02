<?php
class Sellers_model extends Admin_core_model # application/core/MY_Model.php
{
  function __construct()
  {
    parent::__construct();
    $this->table = 'sellers';
    $this->upload_dir = 'uploads/sellers';
  }


  public function all()
  {
    $res = $this->db->get($this->table)->result();

    foreach ($res as $key => $value) {
      // $res[$key]->image_url = base_url("{$this->upload_dir}/") . $value->image_url; TODO: uncomment this in production
      $res[$key]->created_at_f = date_format(date_create($value->created_at),"F d, Y");
    }

    return $res;
  }

}
