<?php
class Sellers_model extends Admin_core_model # application/core/MY_Model.php
{
  function __construct()
  {
    parent::__construct();
    $this->table = 'sellers';
    $this->upload_dir = 'uploads/sellers';

    $config_mail['protocol']='smtp';
    $config_mail['smtp_host']='mail.smtp2go.com';
    $config_mail['smtp_port']='2525';
    $config_mail['smtp_timeout']='30';
    $config_mail['smtp_user']= getenv('SMTP_EMAIL');
    $config_mail['smtp_pass']= getenv('SMTP_PASS');
    $config_mail['charset']='utf-8';
    $config_mail['newline']="\r\n";
    $config_mail['wordwrap'] = TRUE;
    $config_mail['mailtype'] = 'html';
    $this->email->initialize($config_mail);
  }


  public function all() // override
  {
    $res = $this->db->get($this->table)->result();

    foreach ($res as $key => $value) {
      if (!(strpos($value->image_url, 'http') === 0)) {
        $res[$key]->image_url = base_url("{$this->upload_dir}/") . $value->image_url;
      }
      $res[$key]->created_at_f = date_format(date_create($value->created_at),"F d, Y");
      $total_sales = $this->sales_model->getTotalSales($value->id, date('Y') . "-01-01", date('Y') . "-12-31");
      $res[$key]->master_class = $this->getMasterClass($total_sales);
      $res[$key]->rank = $this->getRank($value->id);
    }

    return $res;
  }

  public function get($id)
  {
    $res = $this->db->get_where($this->table, array('id' => $id))->row();
    if (!(strpos($res->image_url, 'http') === 0)) {
      $res->image_url = base_url("{$this->upload_dir}/") . $res->image_url;
    }
    if ($res->imported_csv !== null) {
      $res->imported_csv = base_url("uploads/sales/") . $res->imported_csv;
    }
    $res->created_at_f = date_format(date_create($res->created_at),"F d, Y");
    $total_sales = $this->sales_model->getTotalSales($res->id, date('Y') . "-01-01", date('Y') . "-12-31");
    $res->master_class = $this->getMasterClass($total_sales);
    $res->rank = $this->getRank($res->id);

    return $res;
  }


  public function getByEmail($email)
  {
    return $this->db->get_where($this->table, array('email' => $email))->row();
  }

  public function getById($id)
  {
    return $this->db->get_where($this->table, array('id' => $id))->row();
  }

  public function getRank($id)
  {
    $res = $this->db->query("SELECT seller_id, SUM(sales_amount) as sales_amount FROM `sales`
    GROUP BY seller_id
    ORDER BY sales_amount DESC");
    $sellers = $res->result();

    for ($i=0; $i < $res->num_rows(); $i++) {
      if ($sellers[$i]->seller_id == $id){
        return $i+1; #the rank
      }
    }
  }

  public function getMasterClass($sales)
  {
    if ($sales < 49999999) { #classic
      $class = 'classic';
    } else if ($sales < 99999999 && $sales > 49999999) { # gold
      $class = 'gold';
    } else if ($sales > 100000000) { # platinum
      $class = 'platinum';
    }
    return $class;
  }

  /**
  * retrieves list of top sellers in the current quarter
  * @return [type] [description]
  */
  public function getTopSellers()
  {
    $qtr = get_dates_of_quarter();
    $start = $qtr['start']->format('Y-m-d');
    $end = $qtr['end']->format('Y-m-d');
    $res = $this->db->query("SELECT seller_id, SUM(sales_amount) as sales_amount
    FROM sales
    WHERE date BETWEEN '$start' AND '$end'
    GROUP BY seller_id DESC
    ORDER BY sales_amount DESC
    LIMIT 5
    ")->result();

    $top_sellers = [];
    foreach ($res as $key => $value) {
      $u = $this->sellers_model->get($value->seller_id);
      $top_sellers[$u->full_name] = [
        'sales_amount' => $value->sales_amount,
        'image_url' => $u->image_url,
        'position' => $u->position,
        'division' => $u->division,
      ];
    }

    return $top_sellers;
  }

  public function getLastUploadedCsv($id)
  {
    $res = $this->db->get_where($this->table, array('id' => $id))->row();
    if (!(strpos($res->imported_csv, 'http') === 0)) {
      $res->imported_csv = base_url("uploads/sales/") . $res->imported_csv;
    }

    return $res->imported_csv;
  }

  public function add($data)
  {
    $password = $this->generatePassword(8); # we make the hashed password
    $data['password'] = password_hash($password, PASSWORD_DEFAULT);

    if ($this->db->insert($this->table, $data)) { # if success we finally inseert it

      # Block for checking if email sends
      if(!$this->sendPasswordToEmail($this->input->post('email'), $this->input->post('full_name'), $password)){
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

  public function resetPassword($email)
  {
    $this->db->where('email', $email);
    $this->db->update('sellers', ['forgot_token' => $code = $this->generatePassword(32)]);

    if ($this->db->affected_rows()) {
      $this->email->from('sales@cebulandmasters.com', 'Cebu Landmasters');
      $this->email->to($email);
      $this->email->subject('Password reset');

      $url = base_url('reset-password');
      $msg = "
      <table>
      </td></tr>
      <tr><td>Click the link to reset your password:<br><a href='$url?c={$code}'>$url?c={$code}</a></td></tr>
      <tr><td>Thank you</td></tr>
      <tr><td>&nbsp;</td></tr>
      <tr><td><sub>Please ignore this email if you did not make this password request</sub></td></tr>
      </table>
      ";
      $this->email->message($msg);
      return $this->email->send();

    } else {
      return false;
    }

  }

  public function sendPasswordToEmail($email, $full_name, $password)
  {

    $this->email->from('sales@cebulandmasters.com', 'Cebu Landmasters');
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

  public function sendSellerRedeemEmail($user, $reward)
  {

    $this->email->from('sales@cebulandmasters.com', 'Cebu Landmasters');
    $this->email->to($user->email);
    // $this->email->bcc(['cvalerio@myoptimind.com', 'lsalamante@myoptimind.com']);
    $this->email->subject('Cebu Landmasters Sellers Reward Program');

    $d = date('F j, Y');
    $msg = "
    <table>
    <tr><td>Dear $user->full_name,</td></tr>
    <tr><td></td></tr>
    <tr><td>You just redeemed an item called $reward->title.<br>
    You can find the reward details below:</td></tr>
    <tr><td></td></tr>
    <tr><td><b>Reward details</b></td></tr>
    <tr><td><b>-------------------</b></td></tr>
    <tr><td>Reward name: $reward->title</td></tr>
    <tr><td>Reward cost: $reward->cost</td></tr>
    <tr><td>Date redeemed: $d</td></tr>
    <tr><td><b>-------------------</b></td></tr>
    <tr><td></td></tr>
    <tr><td>Thank you.</td></tr>
    </table>
    ";
    $this->email->message($msg);
    return $this->email->send();
  }

  public function sendAdminRedeemEmail($user, $admins, $reward)
  {

    $this->email->from('sales@cebulandmasters.com', 'Cebu Landmasters');
    $this->email->to($admins[0]);
    unset($admins[0]); # Remove first admin
    $this->email->cc($admins);
    $this->email->subject('Cebu Landmasters Sellers Reward Program');

    $d = date('F j, Y');
    $msg = "
    <table>
    <tr><td>Dear Administrators,</td></tr>
    <tr><td></td></tr>
    <tr><td>A user named <em>$user->full_name<em> just redeemed an item called <em>$reward->title.</em><br>
    You can find the reward details below:</td></tr>
    <tr><td></td></tr>
    <tr><td><b>Reward details</b></td></tr>
    <tr><td><b>-------------------</b></td></tr>
    <tr><td>Reward name: $reward->title</td></tr>
    <tr><td>Reward cost: $reward->cost</td></tr>
    <tr><td>Date redeemed: $d</td></tr>
    <tr><td><b>-------------------</b></td></tr>
    <tr><td></td></tr>
    <tr><td>Thank you.</td></tr>
    </table>
    ";

    $this->email->message($msg);
    return $this->email->send();
  }


}
