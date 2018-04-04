<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Front_core_controller {

  function __construct()
  {
    parent::__construct();

  }

  public function index()
  {
    $data['news'] = $this->news_model->all();
    // $data['events'] = $this->events_model->all();

    $this->wrapper('front/dashboard', $data);
  }

  public function about()
  {
    $res = $this->about_model->all()[0];

    $data = array(
      'title' => $res->title,
      'description' => $res->description,
      'iframe_code' => $res->iframe_code,
    );
    $this->wrapper('front/about', $data);
  }

  public function events()
  {
    $data['events'] = $this->events_model->all();

    $this->wrapper('front/events', $data);
  }


}
