<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_sales_table extends CI_Migration {

  public function up()
  {
    # Table PK
    $this->dbforge->add_field('id');

    # Other table fields
    $this->dbforge->add_field(array(
      'project_name' => array(
        'type' => 'TEXT',
      ),
      # fk
      'seller_id' => array(
        'type' => 'INT',
      ),
      'sales_amount' => array(
        'type' => 'DOUBLE',
        'constraint' => '11,2',
      ),
      'date' => array(
        'type' => 'DATE',
      ),
    ));

    # Table date defaults
    $this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
    $this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP");


    if($this->dbforge->create_table('sales'))
    {
      $table = 'sales';

      $data = array(
        'project_name' => 'Test project 1',
        'date' => '2018-01-01',
        'seller_id' => 1,
        'sales_amount' => 3000000,
      );
      $this->db->insert($table, $data);

      $data = array(
        'project_name' => 'Test project 2',
        'date' => '2018-01-01',
        'seller_id' => 1,
        'sales_amount' => 1800000,
      );
      $this->db->insert($table, $data);

      $data = array(
        'project_name' => 'Test project 3',
        'date' => '2018-01-01',
        'seller_id' => 1,
        'sales_amount' => 200000,
      );
      $this->db->insert($table, $data);

    }
  }

  public function down()
  {
    $this->dbforge->drop_table('sales');
  }
}
