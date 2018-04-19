<?php
class Rewards_model extends Admin_core_model # application/core/MY_Model
{
  function __construct()
  {
    parent::__construct();
    $this->table = 'rewards';
    $this->upload_dir = 'uploads/rewards';
  }

  public function all() # overriden method
  {
    $res = $this->db->get($this->table)->result();
    foreach ($res as $key => $value) {
      if (!(strpos($value->image_url, 'http') === 0)) {
        $res[$key]->image_url = base_url("{$this->upload_dir}/") . $value->image_url;
      }
      $res[$key]->winners = $this->getWinners($value->id);

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

  public function getRedeemHistory($seller_id)
  {
    $res = $this->db->query('SELECT rewards_history.created_at as created_at,
    title, cost FROM rewards_history
    LEFT JOIN rewards ON rewards_history.reward_id = rewards.id
    WHERE seller_id = ' . $seller_id . '')->result();

    foreach ($res as $key => $value) {
      $res[$key]->created_at = date_format(date_create($value->created_at),"F d, Y");
    }
    
    return $res;

  }

}
