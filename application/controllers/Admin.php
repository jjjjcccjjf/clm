<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends Admin_controller { # see application/core/MY_Controller.php

  function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $this->admin();
  }

  public function admin()
  {
    if ($this->session->login_type === 'admin') {
      redirect('admin/dashboard');
    }

    $this->load->view('admin/login');
  }

  public function dashboard()
  {
    $this->wrapper('admin/index');
  }

}
