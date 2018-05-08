<?php
class Projects_model extends Admin_core_model # application/core/MY_Model.php
{
  function __construct()
  {
    parent::__construct();
    $this->table = 'projects';
    $this->upload_dir = 'uploads/projects';
    $this->per_page = 25;
  }

  public function all()
  {
    $res = $this->db->get($this->table)->result();
    $res = $this->filterFields($res);
    return $res;
  }

  public function filterFields($res)
  {

    foreach ($res as $key => $value) {
      if (!(strpos($value->image_url, 'http') === 0)) {
        $res[$key]->image_url = base_url("{$this->upload_dir}/") . $value->image_url;
      }
      $res[$key]->excerpt = (strlen($value->description) > 50)? substr($value->description, 0, 50) . "..." : $value->description;
    }

    return $res;
  }

  public function get($id)
  {
    $res = [];
    $res[] = $this->db->get_where($this->table, array('id' => $id))->row();
    $res = $this->filterFields($res);
    return $res[0];
  }

}
