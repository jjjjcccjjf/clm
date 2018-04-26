<?php
class News_model extends Admin_core_model # application/core/MY_Model
{
  function __construct()
  {
    parent::__construct();
    $this->table = 'news';
    $this->upload_dir = 'uploads/news';
    $this->per_page = 25;
  }

  public function all() # overriden method
  {
    $page = $this->input->get('page') ?: 1;
    $per_page = $this->per_page;
    $offset = max(($page - 1) * $per_page, 0);
    $res = $this->db->get($this->table, $per_page, $offset)->result();
    foreach ($res as $key => $value) {
      if (!(strpos($value->image_url, 'http') === 0)) {
        $res[$key]->image_url = base_url("{$this->upload_dir}/") . $value->image_url;
      }

      $res[$key]->excerpt = (strlen($value->description) > 50)? substr($value->description, 0, 50) . "..." : $value->description;
    }
    return $res;
  }

}
