<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Front_core_controller {

  function __construct()
  {
    parent::__construct();

  }

  public function index()
  {
    $data['news'] = $this->news_model->all();
    // $data['events'] = $this->events_model->all();

    $this->wrapper('front/dashboard', $data);
  }

  public function about()
  {
    $res = $this->about_model->all()[0];

    $data = array(
      'title' => $res->title,
      'description' => $res->description,
      'iframe_code' => $res->iframe_code,
    );
    $this->wrapper('front/about', $data);
  }

  public function events($month = null, $year = null)
  {
    $data['events'] = $this->events_model->all($month, $year);

    $start    = new DateTime(date('Y-m-d', strtotime('-1 years')));
    $start->modify('first day of this month');
    $end    = new DateTime(date('Y-m-d', strtotime('+1 years')));
    $end->modify('first day of next month');
    $interval = DateInterval::createFromDateString('1 month');
    $period   = new DatePeriod($start, $interval, $end);

    $month_year = [];
    foreach ($period as $dt) {

      $active = "";

      if ($month == $dt->format('m') && $year == $dt->format('Y')) {
        $active = "selected='selected'";
      }

      $month_year[] = "<option $active
      data-redirect='" .base_url('dashboard/events/'). "{$dt->format("m")}/{$dt->format("Y")}' >
      {$dt->format("F Y")}</option>";
    }

    $data['month_year'] = $month_year;

    $this->wrapper('front/events', $data, 'events');
  }

  public function account()
  {
    $id = $_SESSION['id'];
    $data['seller'] = $this->sellers_model->get($id);

    $this->wrapper('front/account', $data);
  }

  public function forgot_password()
  {
    $this->load->view('front/forgot_password');
  }

  public function reset_password()
  {
    $forgot_token = $this->input->get('c');
    $user = $this->db->get_where('sellers', ['forgot_token' => $forgot_token])->row();

    if (!$user || !$forgot_token) {
      # if token is empty or if there are no matching forgot token
      redirect();
    } else{
      $data['email'] = $user->email;
      $this->load->view('front/reset_password', $data);
    }

  }

  public function send_password_token()
  {
    $email = $this->input->post('email');

    if($this->sellers_model->resetPassword($email)){
      custom_response(200, ['message' => "Instructions sent to $email" , 'code' => 'ok'], $this);
    } else {
      custom_response(200, ['message' => 'That account is inactive or nonexistent', 'code' => 'error'], $this);
    }
  }

  public function change_password()
  {
    $data['password'] = password_hash($this->input->post('new_password'), PASSWORD_DEFAULT);
    $this->sellers_model->update($_SESSION['id'], $data);

    $this->session->set_flashdata('flash_msg', ['message' => 'Password changed successfully', 'color' => 'green']);

    $this->front_redirect('dashboard/account');
  }

  public function change_photo()
  {
    $data = [];

    if ($_FILES['image_url']['size'] > 0) {
      $this->sellers_model->deleteUploadedMedia($_SESSION['id']);
      $data = array_merge($data, $this->sellers_model->upload('image_url'));
    }

    if($this->sellers_model->update($_SESSION['id'], $data)){
      $this->session->set_flashdata('flash_msg_photo', ['message' => 'Display photo updated', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg_photo', ['message' => 'Invalid photo', 'color' => 'red']);
    }

    $this->front_redirect('dashboard/account');
  }


}
