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
      $this->session->set_flashdata('flash_msg', ['message' => 'Item added successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error adding item', 'color' => 'red']);
    }

    $this->admin_redirect('news');
  }

  public function delete($id)
  {
    if($this->news_model->delete($this->input->post('id'))){
      $this->session->set_flashdata('flash_msg', ['message' => 'Item deleted successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error deleting item', 'color' => 'red']);
    }

    $this->admin_redirect('news');
  }

  public function update($id)
  {
    $data = $this->input->post();

    if ($_FILES['image_url']['size'] > 0) {
      $this->news_model->deleteUploadedMedia($id);
      $data = array_merge($data, $this->news_model->upload('image_url'));
    }

    if($this->news_model->update($id, $data)){
      $this->session->set_flashdata('flash_msg', ['message' => 'Item updated successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error updating item', 'color' => 'red']);
    }

    $this->admin_redirect('news');
  }

}
