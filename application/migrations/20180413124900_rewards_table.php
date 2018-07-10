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
        'image_url' => base_url('public/uploads/Shangri-la Mactan.jpg'),
        'cost' => 17,
        'class_available' => 0,
        'total_winners_allowed' => 5,
      );
      $this->db->insert($table, $data);

      $data = array(
        'title' => 'Rustans GCs /Sodexo GCs',
        'description' => '',
        'image_url' => base_url('public/uploads/rustans-pass.jpg'),
        'cost' => 30,
        'class_available' => 0,
        'total_winners_allowed' => 5,
      );
      $this->db->insert($table, $data);

      $data = array(
        'title' => 'Samsung J7',
        'description' => '',
        'image_url' => base_url('public/uploads/j7.jpg'),
        'cost' => 40,
        'class_available' => 0,
        'total_winners_allowed' => 5,
      );
      $this->db->insert($table, $data);

      $data = array(
        'title' => 'Bohol Trip for 3D2N stay for 2 ',
        'description' => '',
        'image_url' => base_url('public/uploads/bohol-trip.jpg'),
        'cost' => 50,
        'class_available' => 0,
        'total_winners_allowed' => 5,
      );
      $this->db->insert($table, $data);



    }
  }

  public function down()
  {
    $this->dbforge->drop_table('rewards');
  }
}
