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
    $res = $this->admin_model->all();

    $data['admins'] = $res;
    $this->wrapper('admin/index', $data);
  }

  function login($value='')
  {
    if ($this->session->login_type === 'admin') {
      redirect('admin');
    }

    $this->load->view('admin/login');
  }

  public function update($id)
  {
    if($this->admin_model->update($id, $this->input->post())){
      $this->session->set_flashdata('flash_msg', ['message' => 'Item updated successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error updating item', 'color' => 'red']);
    }

    $this->admin_redirect('admin');
  }

  public function add()
  {
    if($this->admin_model->add($this->input->post())){
      $this->session->set_flashdata('flash_msg', ['message' => 'Item added successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error adding user. Email already exists.', 'color' => 'red']);
    }

    $this->admin_redirect('admin');
  }

  public function delete($id)
  {
    if($this->admin_model->delete($this->input->post('id'))){
      $this->session->set_flashdata('flash_msg', ['message' => 'Item deleted successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error deleting item', 'color' => 'red']);
    }

    $this->admin_redirect('admin');
  }

}
