<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sellers extends Admin_core_controller { # see application/core/MY_Controller.php

  function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $res = $this->sellers_model->all();

    $data['sellers'] = $res;

    $this->wrapper('admin/sellers', $data);
  }

  public function add()
  {
    $_POST = $this->setJsonPayload($this->input->post(), $this->input->post('real_estate_record_type'));
    $_POST = $this->unsetJsonFields($_POST);

    $data = array_merge($this->input->post(), $this->sellers_model->upload('image_url'));

    if($this->sellers_model->add($data)){
      $this->session->set_flashdata('flash_msg', ['message' => 'Item added successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error adding seller', 'color' => 'red']);
    }

    $this->admin_redirect('admin/sellers');
  }

  public function delete($id)
  {
    if($this->sellers_model->delete($this->input->post('id'))){
      $this->session->set_flashdata('flash_msg', ['message' => 'Item deleted successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error deleting item', 'color' => 'red']);
    }

    $this->admin_redirect('admin/sellers');
  }

  public function update($id)
  {
    $_POST = $this->setJsonPayload($this->input->post(), $this->input->post('real_estate_record_type'));
    $_POST = $this->unsetJsonFields($_POST);

    $data = $this->input->post();

    if ($_FILES['image_url']['size'] > 0) {
      $this->sellers_model->deleteUploadedMedia($id);
      $data = array_merge($data, $this->sellers_model->upload('image_url'));
    }

    if($this->sellers_model->update($id, $data)){
      $this->session->set_flashdata('flash_msg', ['message' => 'Item updated successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error updating item', 'color' => 'red']);
    }

    $this->admin_redirect('admin/sellers');
  }

  public function review($id)
  {
    $_POST = $this->setJsonPayload($this->input->post(), $this->input->post('real_estate_record_type'));
    $_POST = $this->unsetJsonFields($_POST);
    $_POST['pending_payload'] = '[{},{}]'; # reset this baby
  
    $data = $this->input->post();

    if ($_FILES['image_url']['size'] > 0) {
      $this->sellers_model->deleteUploadedMedia($id);
      $data = array_merge($data, $this->sellers_model->upload('image_url'));
    }

    if($this->sellers_model->update($id, $data)){
      $this->session->set_flashdata('flash_msg', ['message' => 'Changes approved', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error updating item', 'color' => 'red']);
    }

    $this->admin_redirect('admin/sellers');
  }

  function unsetJsonFields($arr)
  {
    unset($arr['realty_firm']);
    unset($arr['num_of_agents']);
    unset($arr['tin_num']);
    unset($arr['team_leader']);
    unset($arr['prc_reg_num']);
    unset($arr['hlurb_cert']);
    unset($arr['affiliated_realty_firm']);
    unset($arr['affiliated_broker']);

    return $arr;
  }

  public function setJsonPayload($post, $real_estate_record_type)
  {
    if ($real_estate_record_type === 'Broker') {
      $post['real_estate_record_payload'] = json_encode(array(
        'realty_firm' => @$post['realty_firm'],
        'num_of_agents' => @$post['num_of_agents'],
        'tin_num' => @$post['tin_num'],
        'team_leader' => @$post['team_leader'],
        'prc_reg_num' => @$post['prc_reg_num'],
        'hlurb_cert' => @$post['hlurb_cert'],
      ));
    } else if ($real_estate_record_type === 'Agent'){
      $post['real_estate_record_payload'] = json_encode(array(
        'affiliated_realty_firm' => @$post['affiliated_realty_firm'],
        'affiliated_broker' => @$post['affiliated_broker'],
        'tin_num' => @$post['tin_num'],
      ));
    }

    return $post;
  }

}
