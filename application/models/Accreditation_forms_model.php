<?php
class Accreditation_forms_model extends Admin_core_model # application/core/MY_Model
{
  function __construct()
  {
    parent::__construct();
    $this->table = 'accreditation_forms';
    $this->upload_dir = 'uploads/accreditation_forms';
    $this->per_page = 25;
  }

  public function all($from_date = null, $to_date = null) # overriden method
  {
    $page = $this->input->get('page') ?: 1;
    $per_page = $this->per_page;
    $offset = max(($page - 1) * $per_page, 0);

    if ($from_date && $to_date) {
      
      if ($from_date === $to_date) { # For current day
        $this->db->where("created_at LIKE '{$from_date}%'");
      } else {
        $this->db->where("created_at BETWEEN '$from_date' AND '$to_date'");
      }

    }
    $res = $this->db->get($this->table, $per_page, $offset)->result();
    foreach ($res as $key => $value) {
      if (!(strpos($value->image_url, 'http') === 0)) {
        $res[$key]->image_url = base_url("{$this->upload_dir}/") . $value->image_url;
        $res[$key]->form_url = base_url("{$this->upload_dir}/") . $value->form_url;
        $res[$key]->created_at_f = date_format(date_create($value->created_at),"F d, Y");
      }

      $res[$key]->excerpt = (strlen($value->description) > 50)? substr($value->description, 0, 50) . "..." : $value->description;
    }
    return $res;
  }

  public function getTotalPages($from_date = null, $to_date = null)
  {
    if ($from_date && $to_date) {
      $this->db->where("created_at BETWEEN '$from_date' AND '$to_date'");
    }
    return ceil(count($this->db->get($this->table)->result()) / $this->per_page);
  }

  # Override this little bitch
  public function upload($file_key)
  {
    @$file = $_FILES[$file_key];
    $upload_path = $this->upload_dir;

    $config['upload_path'] = $upload_path; # NOTE: Change your directory as needed
    $config['allowed_types'] = 'jpg|jpeg|png|pdf'; # NOTE: Change file types as needed
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
