<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accreditation_forms extends Admin_core_controller { # see application/core/MY_Controller.php

  function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $res = $this->accreditation_forms_model->all(
      $this->input->get('from_date'), $this->input->get('to_date')
    );

    $data['accreditation_forms'] = $res;
    $data['total_pages'] = $this->accreditation_forms_model->getTotalPages($this->input->get('from_date'), $this->input->get('to_date'));

    $this->wrapper('admin/accreditation_forms', $data);
  }

  public function add()
  {
    $data = array_merge($this->input->post(), $this->accreditation_forms_model->upload('image_url'));

    if($this->accreditation_forms_model->add($data)){
      $this->session->set_flashdata('flash_msg', ['message' => 'Item added successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error adding item', 'color' => 'red']);
    }

    $this->admin_redirect('admin/accreditation_forms');
  }

  public function delete($id)
  {
    if($this->accreditation_forms_model->delete($this->input->post('id'))){
      $this->session->set_flashdata('flash_msg', ['message' => 'Item deleted successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error deleting item', 'color' => 'red']);
    }

    $this->admin_redirect('admin/accreditation_forms');
  }

  public function update($id)
  {
    $data = $this->input->post();

    if ($_FILES['image_url']['size'] > 0) {
      $this->accreditation_forms_model->deleteUploadedMedia($id);
      $data = array_merge($data, $this->accreditation_forms_model->upload('image_url'));
    }

    if($this->accreditation_forms_model->update($id, $data)){
      $this->session->set_flashdata('flash_msg', ['message' => 'Item updated successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error updating item', 'color' => 'red']);
    }

    $this->admin_redirect('admin/accreditation_forms');
  }

  public function accreditation_formsPerPeriod($month, $year)
  {
    if ($res = $this->accreditation_forms_model->getEventsPerPeriod($month, $year)) {
      custom_response(200, ['message' => 'Success', 'code' => 'ok', 'data' => $res], $this);
    }else{
      custom_response(200, ['message' => 'No accreditation_forms available at this month', 'code' => 'empty'], $this);
    }
  }

}
