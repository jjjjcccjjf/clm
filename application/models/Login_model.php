<?php

class Login_model extends CI_Model
{
  function __construct()
  {
    parent::__construct();
  }

  /**
  * [verifyCredentials description]
  * @param  [type] $email      [description]
  * @param  [type] $password   [description]
  * @param  [type] $login_type this parameter is for the table name to check
  * @return [type]             [description]
  */
  public function verifyCredentials($email, $password, $login_type)
  {
    $user = $this->getUserByEmail($email, $login_type);
    if ($user) {
      return password_verify($password, $user->password) ? $user : false;
    } else {
      return false;
    }
  }

  public function getUserByEmail($email, $table)
  {
    $this->db->where('email', $email);
    return $this->db->get($table)->row();
  }

  public function setSession($user, $login_type)
  {
    $this->session->set_userdata('id', $user->id);
    $this->session->set_userdata('login_type', $login_type);
    $this->session->set_userdata('name', $user->name);
  }

  public function createRedirectURL($login_type)
  {
    switch ($login_type) {
      case 'sellers':
      // code...
      // break;

      case 'admin':
      default:
      $url = base_url('admin');
      break;
    }

    return $url;
  }

}
