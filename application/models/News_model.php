<?php
class News_model extends CI_Model
{
  function __construct()
  {
    parent::__construct();
  }

  public function all()
  {
    $res = $this->db->get('news')->result();
    foreach ($res as $key => $value) {
      $res[$key]->image_url = base_url('uploads/news/') . $value->image_url;
    }
    return $res;
  }

  public function add($data)
  {
    return $this->db->insert('news', $data);
  }

  public function upload($file_key)
  {
    @$file = $_FILES[$file_key];
    $upload_path = "uploads/news";

    $config['upload_path'] = $upload_path; # NOTE: Change your directory as needed
    $config['allowed_types'] = 'gif|jpg|jpeg|png'; # NOTE: Change file types as needed
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
