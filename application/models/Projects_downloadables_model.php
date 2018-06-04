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

  public function upload($file_key)
  {
    @$file = $_FILES[$file_key];
    $upload_path = $this->upload_dir;

    $config['upload_path'] = $upload_path; # NOTE: Change your directory as needed
    $config['allowed_types'] = 'jpg|jpeg|png|doc|docx|ppt|pptx|xls|xlsx|csv|pdf'; # NOTE: Change file types as needed
    $config['file_name'] = time() . '_' . $file['name']; # Set the new filename
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

}
