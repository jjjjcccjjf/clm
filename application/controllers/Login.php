<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

  function __construct()
  {
    parent::__construct();

  }

  public function index()
  {
    if ($this->session->login_type === 'sellers') {
      redirect('dashboard');
    }

    $this->load->view('front/login');
  }

  public function accreditation_form()
  {
    $data = $this->input->post();
    $data = array_merge($data, $this->accreditation_forms_model->upload('image_url'));
    $data = array_merge($data, $this->accreditation_forms_model->upload('form_url'));

    if($this->accreditation_forms_model->add($data)){
      custom_response(200, ['message' => 'Successfully submitted. The Administrator will keep in touch via email.', 'code' => 'ok'], $this);
    } else {
      custom_response(200, ['message' => 'Failure to submit accreditation form. Please try again.', 'code' => 'fail'], $this);
    }
  }

}
