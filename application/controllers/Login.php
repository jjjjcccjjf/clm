<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

  function __construct()
  {
    parent::__construct();

    if ($this->session->login_type === 'admin') {
      redirect('dashboard');
    }
  }

  public function index()
  {
    $this->load->view('admin/login');
  }

  public function attempt($login_type)
  {
    $email = $this->input->post('email');
    $password = $this->input->post('password');

    if($user = $this->login_model->verifyCredentials($email, $password, $login_type)){
      $this->login_model->setSession($user, $login_type);

      custom_response(200, [ 'message' => 'Login success', 'code' => 'ok'], $this);
    } else {
      custom_response(200, [ 'message' => 'Invalid username or password', 'code' => 'unauthorized'], $this);
    }
  }
}
