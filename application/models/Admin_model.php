<?php

class Admin_model extends CI_Model
{
  function __construct()
  {
    parent::__construct();
  }

  public function all()
  {
    if ($id = $this->session->id && $this->session->login_type === 'admin') {
      $this->db->where("id != {$id}");
    }
    return $this->db->get('admin')->result();
  }

  public function update($id, $data)
  {
    if ($data['password']) {
      $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
    } else {
      unset($data['password']);
    }

    $this->db->where('id', $id);
    return $this->db->update('admin', $data);
  }

  public function add($data)
  {
    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
    return $this->db->insert('admin', $data);
  }

  public function delete($id)
  {
    $this->db->where('id', $id);
    return $this->db->delete('admin');
  }

}
