<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends Admin_core_controller { # see application/core/MY_Controller.php

  public function index()
  {
    $res = $this->about_model->all();
    $data['about'] = $res[0];
    $this->wrapper('admin/about', $data);
  }

  public function update($id)
  {
    $data = $this->input->post();

    if($this->about_model->update($id, $data)){
      $this->session->set_flashdata('flash_msg', ['message' => 'Item updated successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error updating item', 'color' => 'red']);
    }

    $this->admin_redirect('admin/about');
  }

}
