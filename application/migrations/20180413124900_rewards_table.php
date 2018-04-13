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
      'total_stock' => array(
        'type' => 'INT',
      ),
      'current_stock' => array(
        'type' => 'INT',
        'default' => 0
      ),
    ));

    # Table date defaults
    $this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
    $this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP");


    if($this->dbforge->create_table('rewards'))
    {
      $table = 'rewards';

      $data = array(
        'title' => 'Lemonade',
        'description' => 'asdasd',
        'image_url' => 'https://robohash.org/naee?asdasdw=set3',
        'cost' => 5,
        'total_stock' => 10,
      );
      $this->db->insert($table, $data);

      $data = array(
        'title' => 'Some really nice cake',
        'description' => 'asdasd',
        'image_url' => 'https://robohash.org/naee?asdasdw=set3',
        'cost' => 3,
        'total_stock' => 10,
      );
      $this->db->insert($table, $data);

      $data = array(
        'title' => 'Butter',
        'description' => 'asdasd',
        'image_url' => 'https://robohash.org/naee?asdasdw=set3',
        'cost' => 4,
        'total_stock' => 10,
      );
      $this->db->insert($table, $data);

      $data = array(
        'title' => 'Cheese',
        'description' => 'asdasd',
        'image_url' => 'https://robohash.org/naee?asdasdw=set3',
        'cost' => 1,
        'total_stock' => 11,
      );
      $this->db->insert($table, $data);

    }
  }

  public function down()
  {
    $this->dbforge->drop_table('rewards');
  }
}
