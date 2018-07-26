<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_rewards_table extends CI_Migration {

  public function up()
  {
    # Table PK
    $this->dbforge->add_field('id');

    # Other table fields
    $this->dbforge->add_field(array(
      'title' => array(
        'type' => 'TEXT',
      ),
      'description' => array(
        'type' => 'TEXT',
      ),
      'image_url' => array(
        'type' => 'TEXT',
      ),
      'cost' => array(
        'type' => 'INT',
      ),
      # 0 - classic, 1 - gold, 2 - platinum
      'class_available' => array(
        'type' => 'INT'
      ),
      'total_winners_allowed' => array(
        'type' => 'INT',
      ),
    ));

    # Table date defaults
    $this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
    $this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP");


    if($this->dbforge->create_table('rewards'))
    {
      $table = 'rewards';

      $data = array(
        'title' => 'Shangri-la Mactan overnight stay',
        'description' => '',
        'image_url' => base_url('public/uploads/rewards/shang.jpg'),
        'cost' => 17,
        'class_available' => 0,
        'total_winners_allowed' => 5,
      );
      $this->db->insert($table, $data);

      $data = array(
        'title' => 'Rustans GCs /Sodexo GCs',
        'description' => '',
        'image_url' => base_url('public/uploads/rewards/rustans-pass.jpg'),
        'cost' => 30,
        'class_available' => 0,
        'total_winners_allowed' => 5,
      );
      $this->db->insert($table, $data);

      $data = array(
        'title' => 'Samsung J7',
        'description' => '',
        'image_url' => base_url('public/uploads/rewards/j7.jpg'),
        'cost' => 40,
        'class_available' => 0,
        'total_winners_allowed' => 5,
      );
      $this->db->insert($table, $data);

      $data = array(
        'title' => 'Bohol Trip for 3D2N stay for 2',
        'description' => '',
        'image_url' => base_url('public/uploads/rewards/bohol-trip.jpg'),
        'cost' => 50,
        'class_available' => 0,
        'total_winners_allowed' => 5,
      );
      $this->db->insert($table, $data);

      ### GOLD ####

      $data = array(
        'title' => 'Shangri-la 2-night stay + 2 chi-spa massage',
        'description' => '',
        'image_url' => base_url('public/uploads/rewards/shang.jpg'),
        'cost' => 50,
        'class_available' => 1,
        'total_winners_allowed' => 3,
      );
      $this->db->insert($table, $data);

      $data = array(
        'title' => 'Macbook Air',
        'description' => '',
        'image_url' => base_url('public/uploads/rewards/macbook-air.jpg'),
        'cost' => 80,
        'class_available' => 1,
        'total_winners_allowed' => 3,
      );
      $this->db->insert($table, $data);

      $data = array(
        'title' => 'Iphone X',
        'description' => '',
        'image_url' => base_url('public/uploads/rewards/iphone-x.jpg'),
        'cost' => 70,
        'class_available' => 1,
        'total_winners_allowed' => 3,
      );
      $this->db->insert($table, $data);

      $data = array(
        'title' => 'Bali, Indonesia 5D4N',
        'description' => '',
        'image_url' => base_url('public/uploads/rewards/bali-indo.jpg'),
        'cost' => 80,
        'class_available' => 1,
        'total_winners_allowed' => 3,
      );
      $this->db->insert($table, $data);

      ### PLATINUM ####

      $data = array(
        'title' => 'Omega (Female)/ Tag Heuer (Male)',
        'description' => '',
        'image_url' => base_url('public/uploads/rewards/omega-tag.jpg'),
        'cost' => 100,
        'class_available' => 2,
        'total_winners_allowed' => 3,
      );
      $this->db->insert($table, $data);

      $data = array(
        'title' => 'Seoul, Korea 5D4N',
        'description' => '',
        'image_url' => base_url('public/uploads/rewards/korea.jpg'),
        'cost' => 100,
        'class_available' => 2,
        'total_winners_allowed' => 3,
      );
      $this->db->insert($table, $data);

    }
  }

  public function down()
  {
    $this->dbforge->drop_table('rewards');
  }
}
