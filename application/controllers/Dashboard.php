<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_controller { # see application/core

  function __construct()
  {
    parent::__construct();

    if ($this->session->login_type !== 'admin') {
      redirect();
    }
  }

  public function index()
  {
    $this->wrapper('admin/blank');
  }

}
