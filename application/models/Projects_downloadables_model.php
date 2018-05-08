<?php
class Projects_downloadables_model extends Admin_core_model # application/core/MY_Model
{
  function __construct()
  {
    parent::__construct();
    $this->table = 'projects_downloadables';
    $this->upload_dir = 'uploads/projects_downloadables';
  }

  public function getDownloadables($fk) # overriden method
  {
    $this->db->where('project_id', $fk);
    $res = $this->db->get($this->table)->result();

    foreach ($res as $key => $value) {
      if (!(strpos($value->file_url, 'http') === 0)) {
        $res[$key]->file_url = base_url("{$this->upload_dir}/") . $value->file_url;
      }
    }
    return $res;

  }

}
