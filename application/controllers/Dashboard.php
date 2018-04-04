<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Front_core_controller {

  function __construct()
  {
    parent::__construct();

  }

  public function index()
  {
    $this->wrapper('front/dashboard');
  }

  public function about()
  {
    $this->wrapper('front/about');
  }


}
