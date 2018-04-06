<?php
class Sellers_model extends Admin_core_model # application/core/MY_Model.php
{
  function __construct()
  {
    parent::__construct();
    $this->table = 'sellers';
    $this->upload_dir = 'uploads/sellers';
  }


  public function all() // override
  {
    $res = $this->db->get($this->table)->result();

    foreach ($res as $key => $value) {
      if (!(strpos($value->image_url, 'http') === 0)) {
        $res[$key]->image_url = base_url("{$this->upload_dir}/") . $value->image_url;
      }
      $res[$key]->created_at_f = date_format(date_create($value->created_at),"F d, Y");
    }

    return $res;
  }

  public function get($id)
  {
    $res = $this->db->get_where($this->table, array('id' => $id))->row();
    if (!(strpos($res->image_url, 'http') === 0)) {
      $res->image_url = base_url("{$this->upload_dir}/") . $res->image_url;
    }
    $res->created_at_f = date_format(date_create($res->created_at),"F d, Y");

    return $res;
  }

  public function add($data)
  {
    $password = $this->generatePassword(8); # we make the hashed password
    $data['password'] = password_hash($password, PASSWORD_DEFAULT);

    if ($this->db->insert($this->table, $data)) { # if success we finally inseert it

      # Block for checking if email sends
      if(!$this->sendEmail($this->input->post('email'), $this->input->post('full_name'), $password)){
        $id = $this->db->insert_id();

        # Delete if email failed sending
        $this->db->reset_query();
        $this->db->where('id', $id);
        $this->db->delete('sellers');
        return false;
      }
      # Block for checking if email sends

      return true;
    } else {
      return false;
    }
  }

  public function generatePassword($length)
  {
    $pool = array_merge(range(0,9), range('a', 'z'),range('A', 'Z'));

    for($i=0; $i < $length; $i++) {
      $key .= $pool[mt_rand(0, count($pool) - 1)];
    }
    return $key;
  }

  public function sendEmail($email, $full_name, $password)
  {
    $config_mail['protocol']='smtp';
    $config_mail['smtp_host']='mail.smtp2go.com';
    $config_mail['smtp_port']='80';
    $config_mail['smtp_timeout']='30';
    $config_mail['smtp_user']='betamail@optimindsolutions.com';
    $config_mail['smtp_pass']='MDFldDJ5a3lkbWk3';
    $config_mail['charset']='utf-8';
    $config_mail['newline']="\r\n";
    $config_mail['wordwrap'] = TRUE;
    $config_mail['mailtype'] = 'html';
    $this->email->initialize($config_mail);

    $this->email->from('noreply@cebulandmasters.com', 'Cebu Landmasters');
    $this->email->to($email);
    // $this->email->bcc(['cvalerio@myoptimind.com', 'lsalamante@myoptimind.com']);
    $this->email->subject('Cebu Landmasters Sellers Reward Program');

    $url = base_url();
    $msg = "
    <table>
    <tr><td>Dear $full_name,</td></tr>
    <tr><td></td></tr>
    <tr><td>You have been enrolled to our sellers reward program.</td></tr>
    <tr><td><b>Your password is:</b> $password
    <br><sub>Notice: This password SHOULD NOT be shared to anyone</sub>
    </td></tr>
    <tr><td>You can sign-in to the portal using this link: <a href='$url'>$url</a></td></tr>
    <tr><td></td></tr>
    <tr><td>Thank you</td></tr>
    </table>
    ";
    $this->email->message($msg);
    return $this->email->send();
  }


}
