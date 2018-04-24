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
    $data['top_sellers'] = $this->sellers_model->getTopSellers();
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

  public function rewards()
  {
    $data['rewards'] = $this->rewards_model->all(
      $this->sellers_model->get($this->session->id)->master_class
    );

    $this->wrapper('front/rewards', $data, 'rewards');
  } 

  public function redeem_history()
  {
    $id = @$this->session->id;
    $data['redeem_history'] = $this->rewards_model->getRedeemHistory($id, $this->input->get('page'));
    $data['total_redeemed'] = $this->rewards_model->getTotalRedeemHistory($id);
    $data['points_spent'] = $this->sales_model->getPointsSpent($id);
    $data['gross_points'] = $this->sales_model->getGrossPoints($id);

    $this->wrapper('front/redeem_history', $data, 'rewards');
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
    $id = $this->session->id;
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
      $this->session->id,
      $this->input->get('page'),
      $this->input->get('from_date'),
      $this->input->get('to_date')
    );

    $data['total_page_count'] = $this->sales_model->getSalesTotalCount(
      $this->session->id,
      $this->input->get('from_date'),
      $this->input->get('to_date')
    );

    $data['total_sales'] = number_format($this->sales_model->getTotalSales(
      $this->session->id,
      $this->input->get('from_date'),
      $this->input->get('to_date')
    ));

    $data['total_overall_sales'] = number_format($this->sales_model->getTotalSales(
      $this->session->id
    ));

    ############# Month block start #################
    $start    = new DateTime(date('Y-m-d', strtotime('-1 years')));
    $start->modify('first day of this month');
    $end    = new DateTime(date('Y-m-d', strtotime('+1 years')));
    $end->modify('first day of next month');
    $interval = DateInterval::createFromDateString('1 month');
    $period   = new DatePeriod($start, $interval, $end);

    $month_year_start = [];
    foreach ($period as $dt) {
      $month_year_start[] = "<option value='{$dt->format("Y-m-d")}'>{$dt->format("F Y")}</option>";
    }
    $data['month_year_start'] = $month_year_start;
    ############# Month block start #################

    ############# Month block end #################
    $start    = new DateTime(date('Y-m-d', strtotime('-1 years')));
    $start->modify('first day of this month');
    $end    = new DateTime(date('Y-m-d', strtotime('+1 years')));
    $end->modify('first day of next month');
    $interval = DateInterval::createFromDateString('1 month');
    $period   = new DatePeriod($start, $interval, $end);

    $month_year_end = [];
    foreach ($period as $dt) {
      $month_year_end[] = "<option value='{$dt->format("Y-m-t")}'>{$dt->format("F Y")}</option>";
    }
    $data['month_year_end'] = $month_year_end;
    ############# Month block end #################


    ################# Years start block #################
    $yearly_start = [];
    $yearly_start[] = "<option value='" . date('Y', strtotime('-2 year')) . "-01-01'>" . date('Y', strtotime('-2 year')) . "</option>";
    $yearly_start[] = "<option value='" . date('Y', strtotime('-1 year')) . "-01-01'>" . date('Y', strtotime('-1 year')) . "</option>";
    $yearly_start[] = "<option value='" . date('Y') . "-01-01'>" . date('Y') . "</option>";
    $yearly_start[] = "<option value='" . date('Y', strtotime('+1 year')) . "-01-01'>" . date('Y', strtotime('+1 year')) . "</option>";
    $yearly_start[] = "<option value='" . date('Y', strtotime('+2 year')) . "-01-01'>" . date('Y', strtotime('+2 year')) . "</option>";
    ################# Years start block #################

    ################# Years start block #################
    $yearly_end = [];
    $yearly_end[] = "<option value='" . date('Y', strtotime('-2 year')) . "-12-31'>" . date('Y', strtotime('-2 year')) . "</option>";
    $yearly_end[] = "<option value='" . date('Y', strtotime('-1 year')) . "-12-31'>" . date('Y', strtotime('-1 year')) . "</option>";
    $yearly_end[] = "<option value='" . date('Y') . "-12-31'>" . date('Y') . "</option>";
    $yearly_end[] = "<option value='" . date('Y', strtotime('+1 year')) . "-12-31'>" . date('Y', strtotime('+1 year')) . "</option>";
    $yearly_end[] = "<option value='" . date('Y', strtotime('+2 year')) . "-12-31'>" . date('Y', strtotime('+2 year')) . "</option>";
    ################# Years start block #################

    $data['yearly_start'] = $yearly_start;
    $data['yearly_end'] = $yearly_end;


    $q1 = get_dates_of_quarter(1 , date('Y'));
    $q2 = get_dates_of_quarter(2 , date('Y'));
    $q3 = get_dates_of_quarter(3 , date('Y'));
    $q4 = get_dates_of_quarter(4 , date('Y'));

    $quarterly_start = [];
    $quarterly_end = [];

    # At this point, tinatamad na ko
    ######## Quarterly start ################
    $quarterly_start[] = "<option value='{$q1['start']->format('Y-m-d')}'>1st Quarter</option>";
    $quarterly_start[] = "<option value='{$q2['start']->format('Y-m-d')}'>2nd Quarter</option>";
    $quarterly_start[] = "<option value='{$q3['start']->format('Y-m-d')}'>3rd Quarter</option>";
    $quarterly_start[] = "<option value='{$q4['start']->format('Y-m-d')}'>4th Quarter</option>";
    ######## Quarterly start ################

    ######## Quarterly end ################
    $quarterly_end[] = "<option value='{$q1['end']->format('Y-m-d')}'>1st Quarter</option>";
    $quarterly_end[] = "<option value='{$q2['end']->format('Y-m-d')}'>2nd Quarter</option>";
    $quarterly_end[] = "<option value='{$q3['end']->format('Y-m-d')}'>3rd Quarter</option>";
    $quarterly_end[] = "<option value='{$q4['end']->format('Y-m-d')}'>4th Quarter</option>";
    ######## Quarterly end ################

    $data['quarterly_start'] = $quarterly_start;
    $data['quarterly_end'] = $quarterly_end;

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
    if ($this->sellers_model->update($this->session->id, ['pending_payload' => json_encode($arr)])){
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
      $this->sellers_model->update($this->session->id, $data);
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

  public function redeem_item($item_id)
  {
    if($this->rewards_model->redeem($this->session->id, $item_id)){
      // $this->rewards_model->sendRedemptionEmail($this->session->id, $item_id); # Bruh! Nice function name b(*u*)b
      $this->session->set_flashdata('flash_msg_redeem', ['message' => 'Item redeemed. Please check your email for further instructions.', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg_redeem', ['message' => 'Insufficient points', 'color' => 'red']);
    }

    $this->front_redirect('dashboard/redeem-history');
  }

  public function change_photo()
  {
    $data = [];

    if ($_FILES['image_url']['size'] > 0) {
      $this->sellers_model->deleteUploadedMedia($this->session->id);
      $data = array_merge($data, $this->sellers_model->upload('image_url'));
    }

    if($this->sellers_model->update($this->session->id, $data)){
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
