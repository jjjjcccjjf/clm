<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Events extends Admin_core_controller { # see application/core/MY_Controller.php

  function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $res = $this->events_model->all();

    $data['events'] = $res;
    $data['total_pages'] = $this->events_model->getTotalPages();

    $this->wrapper('admin/events', $data);
  }

  public function add()
  {
    $data = array_merge($this->input->post(), $this->events_model->upload('image_url'));

    if($this->events_model->add($data)){
      $this->session->set_flashdata('flash_msg', ['message' => 'Item added successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error adding item', 'color' => 'red']);
    }

    $this->admin_redirect('admin/events');
  }

  public function delete($id)
  {
    if($this->events_model->delete($this->input->post('id'))){
      $this->session->set_flashdata('flash_msg', ['message' => 'Item deleted successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error deleting item', 'color' => 'red']);
    }

    $this->admin_redirect('admin/events');
  }

  public function update($id)
  {
    $data = $this->input->post();

    if ($_FILES['image_url']['size'] > 0) {
      $this->events_model->deleteUploadedMedia($id);
      $data = array_merge($data, $this->events_model->upload('image_url'));
    }

    if($this->events_model->update($id, $data)){
      $this->session->set_flashdata('flash_msg', ['message' => 'Item updated successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error updating item', 'color' => 'red']);
    }

    $this->admin_redirect('admin/events');
  }

  public function eventsPerPeriod($month, $year)
  {
    if ($res = $this->events_model->getEventsPerPeriod($month, $year)) {
      custom_response(200, ['message' => 'Success', 'code' => 'ok', 'data' => $res], $this);
    }else{
      custom_response(200, ['message' => 'No events available at this month', 'code' => 'empty'], $this);
    }
  }

}
