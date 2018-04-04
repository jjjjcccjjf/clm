<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_events_table extends CI_Migration {

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
      'date' => array(
        'type' => 'DATE',
      ),
    ));

    # Table date defaults
    $this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
    $this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP");


    if($this->dbforge->create_table('events'))
    {
      $table = 'events';

      $data = array(
        'title' => 'Some event',
        'description' => 'asdasd',
        'image_url' => 'https://robohash.org/bruh?set=set4',
        'date' => '2018-04-28',
      );
      $this->db->insert($table, $data);

      $data = array(
        'title' => 'Some event2',
        'description' => 'asdasda',
        'image_url' => 'https://robohash.org/nee?set=set4',
        'date' => '2018-04-28',
      );
      $this->db->insert($table, $data);

      $data = array(
        'title' => 'Birthday of Obama',
        'description' => 'asdasda',
        'image_url' => 'https://robohash.org/newe?set=set4',
        'date' => '2018-04-25',
      );
      $this->db->insert($table, $data);

    }
  }

  public function down()
  {
    $this->dbforge->drop_table('events');
  }
}
