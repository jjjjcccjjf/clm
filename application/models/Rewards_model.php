<?php
class Rewards_model extends Admin_core_model # application/core/MY_Model
{
  function __construct()
  {
    parent::__construct();
    $this->table = 'rewards';
    $this->upload_dir = 'uploads/rewards';
    $this->per_page = 15;

    $this->tiers = [
      'classic' => 0,
      'gold' => 1,
      'platinum' => 2
    ];

  }

  public function getTiers()
  {
    return $this->tiers;
  }

  public function getTierByClass($master_class)
  {
    return $this->tiers[$master_class];
  }

  public function getClassbyTier($tier)
  {
    return array_search ($tier, $this->tiers);
  }

  public function all($master_class = null) # overriden method
  {
    if ($master_class) {
      $tier = $this->getTierByClass($master_class);
      $this->db->where('class_available <=', $tier);
    }

    $res = $this->db->get($this->table)->result();
    foreach ($res as $key => $value) {
      if (!(strpos($value->image_url, 'http') === 0)) {
        $res[$key]->image_url = base_url("{$this->upload_dir}/") . $value->image_url;
      }
      $res[$key]->winners = $winners = $this->getWinners($value->id);
      $res[$key]->is_grayed_out = ($winners >= $value->total_winners_allowed);
      $res[$key]->master_class = $this->getClassbyTier($value->class_available);
      $res[$key]->excerpt = (strlen($value->description) > 50)? substr($value->description, 0, 50) . "..." : $value->description;
    }
    return $res;
  }

  public function getWinners($reward_id)
  {
    $this->db->where('reward_id', $reward_id);
    $res = $this->db->get('rewards_history');
    return $res->num_rows();
  }

  public function redeem($seller_id, $reward_id)
  {
    $reward = $this->get($reward_id);

    $available_points = $this->sales_model->getNetPoints($seller_id);
    $cost = $reward->cost;

    $user = $this->sellers_model->get($seller_id);

    # admins block
    $a = $this->admin_model->all();
    $admins = [];
    foreach ($a as $admin) {
      $admins[] = $admin->email;
    }
    # / admins block

    $winners = $this->getWinners($reward_id);
    $total_winners_allowed = $reward->total_winners_allowed;

    if ($available_points >= $cost && $winners < $total_winners_allowed) {
      if( $this->db->insert('rewards_history', ['seller_id' => $seller_id, 'reward_id' => $reward_id])){
        return $this->sellers_model->sendSellerRedeemEmail($user, $reward)
        && $this->sellers_model->sendAdminRedeemEmail($user, $admins, $reward);
      }
    } else {
      return false;
    }
  }

  public function getRedeemHistory($seller_id, $page = 1)
  {
    $per_page = $this->per_page;
    $offset = max(($page - 1) * $per_page, 0);
    $res = $this->db->query('SELECT rewards_history.created_at as created_at,
      title, cost FROM rewards_history
      LEFT JOIN rewards ON rewards_history.reward_id = rewards.id
      WHERE seller_id = ' . $seller_id . '
      LIMIT ' . $per_page . ' OFFSET ' . $offset . '')->result();

      foreach ($res as $key => $value) {
        $res[$key]->created_at = date_format(date_create($value->created_at),"F d, Y");
      }

      return $res;
    }

    public function getTotalRedeemHistory($seller_id)
    {
      $per_page = $this->per_page;
      $res =  $this->db->get_where('rewards_history', ['seller_id' => $seller_id])->result();
      return ceil(count($res) / $per_page);
    }

  }
