<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Projects extends Admin_core_controller { # see application/core/MY_Controller.php

  function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $res = $this->projects_model->all();

    $data['projects'] = $res;
    $data['total_pages'] = $this->projects_model->getTotalPages();

    $this->wrapper('admin/projects', $data);
  }

  public function add()
  {
    $data = array_merge($this->input->post(), $this->projects_model->upload('image_url'));

    if($this->projects_model->add($data)){
      $this->session->set_flashdata('flash_msg', ['message' => 'Item added successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error adding item', 'color' => 'red']);
    }

    $this->admin_redirect('admin/projects');
  }

  public function delete($id)
  {
    if($this->projects_model->delete($this->input->post('id'))){
      $this->session->set_flashdata('flash_msg', ['message' => 'Item deleted successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error deleting item', 'color' => 'red']);
    }

    $this->admin_redirect('admin/projects');
  }

  public function update($id)
  {
    $data = $this->input->post();

    if ($_FILES['image_url']['size'] > 0) {
      $this->projects_model->deleteUploadedMedia($id);
      $data = array_merge($data, $this->projects_model->upload('image_url'));
    }

    if($this->projects_model->update($id, $data)){
      $this->session->set_flashdata('flash_msg', ['message' => 'Item updated successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error updating item', 'color' => 'red']);
    }

    $this->admin_redirect('admin/projects');
  }

}
