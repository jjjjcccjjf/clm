<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rewards extends Admin_core_controller { # see application/core/MY_Controller.php

  function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $res = $this->rewards_model->all();

    $data['rewards'] = $res;

    $this->wrapper('admin/rewards', $data);
  }

  public function add()
  {
    $data = array_merge($this->input->post(), $this->rewards_model->upload('image_url'));

    if($this->rewards_model->add($data)){
      $this->session->set_flashdata('flash_msg', ['message' => 'Item added successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error adding item', 'color' => 'red']);
    }

    $this->admin_redirect('admin/rewards');
  }

  public function delete($id)
  {
    if($this->rewards_model->delete($this->input->post('id'))){
      $this->session->set_flashdata('flash_msg', ['message' => 'Item deleted successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error deleting item', 'color' => 'red']);
    }

    $this->admin_redirect('admin/rewards');
  }

  public function update($id)
  {
    $data = $this->input->post();

    if ($_FILES['image_url']['size'] > 0) {
      $this->rewards_model->deleteUploadedMedia($id);
      $data = array_merge($data, $this->rewards_model->upload('image_url'));
    }

    if($this->rewards_model->update($id, $data)){
      $this->session->set_flashdata('flash_msg', ['message' => 'Item updated successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error updating item', 'color' => 'red']);
    }

    $this->admin_redirect('admin/rewards');
  }

}
