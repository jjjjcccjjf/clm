<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends Admin_controller { # see application/core/MY_Controller.php

  function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $res = $this->news_model->all();

    $data['news'] = $res;

    $this->wrapper('admin/news', $data);
  }

  public function add()
  {
    $data = array_merge($this->input->post(), $this->news_model->upload('image_url'));

    if($this->news_model->add($data)){
      $this->session->set_flashdata('flash_msg', ['message' => 'News added successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error adding news', 'color' => 'red']);
    }

    $this->admin_redirect('news');
  }

}
