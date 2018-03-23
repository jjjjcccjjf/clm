<?php

class Login_model extends CI_Model
{
  function __construct()
  {
    parent::__construct();
  }

  public function verifyCredentials($email, $password)
  {
    if ($user = $this->getByEmail($email)) {
      return password_verify($password, $user->password) ? $user : false;
    } else {
      return false;
    }
  }

  public function getByEmail($email)
  {
    $this->db->where('email', $email);
    return $this->db->get('admin')->row();
  }

  public function setSession($user)
  {
    $this->session->set_userdata('id', $user->id);
    // $this->session->set_userdata('login_type', '');
  }
}
