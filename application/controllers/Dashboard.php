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
    $seller = $this->sellers_model->get($id);
    $data['seller'] = $seller;

    /**
    * structure
    * [ {...}, {...}]
    */
    if ($seller->pending_payload != '[{},{}]') {
      $data['seller_pending'] = json_decode($seller->pending_payload)[1];
      $data['seller_pending']->real_estate_record_payload = json_decode($seller->pending_payload)[0];
    } else {
      $data['seller_pending'] = $seller;
    }
    // var_dump($data); die();
    $this->wrapper('front/account', $data);
  }

  public function forgot_password()
  {
    $this->load->view('front/forgot_password');
  }

  public function sales()
  {
    $data['sales'] = $this->sales_model->getSales(
      $_SESSION['id'],
      $this->input->get('page'),
      $this->input->get('from_date'),
      $this->input->get('to_date')
    );

    $data['total_page_count'] = $this->sales_model->getSalesTotalCount(
      $_SESSION['id'],
      $this->input->get('from_date'),
      $this->input->get('to_date')
    );

    $data['total_sales'] = $this->sales_model->getTotalSales(
      $_SESSION['id'],
      $this->input->get('from_date'),
      $this->input->get('to_date')
    );

    $data['total_overall_sales'] = $this->sales_model->getTotalSales(
      $_SESSION['id']
    );

    $this->wrapper('front/sales', $data);
  }

  public function reset_password()
  {
    $forgot_token = $this->input->get('c');
    $user = $this->db->get_where('sellers', ['forgot_token' => $forgot_token])->row();

    if (!$user || !$forgot_token) {
      redirect('login');
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

  public function change_profile()
  {
    // var_dump($_POST); die();
    $_POST = $this->setJsonPayload($this->input->post(), $this->input->post('real_estate_record_type'));
    $_POST = $this->unsetJsonFields($_POST);

    $arr = [];

    $arr[] = $this->input->post('real_estate_record_payload');
    unset($_POST['real_estate_record_payload']);
    $arr[] = $_POST;
    if ($this->sellers_model->update($_SESSION['id'], ['pending_payload' => json_encode($arr)])){
      $this->session->set_flashdata('flash_msg_profile', ['message' => 'Changes will be reviewed by the admin', 'color' => 'gold']);
    } else {
      $this->session->set_flashdata('flash_msg_profile', ['message' => 'Error updating profile', 'color' => 'red']);
    }

    $this->front_redirect('dashboard/account');

  }

  public function change_password($type = 'account')
  {
    $data['password'] = password_hash($this->input->post('new_password'), PASSWORD_DEFAULT);

    if ($type === 'account') {
      $this->sellers_model->update($_SESSION['id'], $data);
      $this->session->set_flashdata('flash_msg', ['message' => 'Password changed successfully', 'color' => 'green']);
      $this->front_redirect('dashboard/account');

    } else if ($type === 'reset') {
      $this->db->where('forgot_token', $this->input->get('c'));
      $data['forgot_token'] = null;
      $this->db->update('sellers', $data);

      $this->session->set_flashdata('flash_email', base64_decode($this->input->get('e')));
      $this->session->set_flashdata('flash_password', $this->input->post('new_password'));
      $this->session->set_flashdata('auto_login', '<script>$(document).ready(function() {$("form").submit();});</script>');

      redirect('login');
    }
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
