<?php
class Projects_latest_updates_model extends Admin_core_model # application/core/MY_Model
{
  function __construct()
  {
    parent::__construct();
    $this->table = 'projects_latest_updates';
    $this->upload_dir = 'uploads/projects_latest_updates';
  }

  public function getGallery($fk) # overriden method
  {
    $this->db->where('project_id', $fk);
    $res = $this->db->get($this->table)->result();

    foreach ($res as $key => $value) {
      if (!(strpos($value->image_url, 'http') === 0)) {
        $res[$key]->image_url = base_url("{$this->upload_dir}/") . $value->image_url;
        $res[$key]->created_at_f = date_format(date_create($value->created_at),"F d, Y");
      }
    }
    return $res;

  }

}
