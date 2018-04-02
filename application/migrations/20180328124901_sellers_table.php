<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_sellers_table extends CI_Migration {

  public function up()
  {
    # Table PK
    $this->dbforge->add_field('id');

    # Other table fields
    $this->dbforge->add_field(array(
      'full_name' => array(
        'type' => 'VARCHAR',
        'constraint' => '200',
      ),
      'birth_date' => array(
        'type' => 'DATE',
      ),
      'password' => array(
        'type' => 'TEXT',
      ),
      'gender' => array(
        'type' => 'VARCHAR',
        'constraint' => '50',
      ),
      'civil_status' => array(
        'type' => 'VARCHAR',
        'constraint' => '200',
      ),
      'home_address' => array(
        'type' => 'TEXT',
      ),
      'office_address' => array(
        'type' => 'TEXT',
      ),
      'mobile_num' => array(
        'type' => 'VARCHAR',
        'constraint' => '200',
      ),
      'office_fax' => array(
        'type' => 'VARCHAR',
        'constraint' => '200',
      ),
      'home_num' => array(
        'type' => 'VARCHAR',
        'constraint' => '200',
      ),
      'email' => array(
        'type' => 'VARCHAR',
        'constraint' => '200',
      ),
      # 'Broker' or 'Agent'
      'real_estate_record_type' => array(
        'type' => 'VARCHAR',
        'constraint' => '200',
      ),
      # JSON string
      'real_estate_record_payload' => array(
        'type' => 'VARCHAR',
        'constraint' => '20000',
      ),
      'forgot_token' => array(
        'type' => 'TEXT',
        'null' => true,
      ),
      'position_id' => array(
        'type' => 'INT',
        'null' => true,
      ),
      'division_id' => array(
        'type' => 'INT',
        'null' => true,
      ),
      'group_id' => array(
        'type' => 'INT',
        'null' => true,
      ),
      'image_url' => array(
        'type' => 'TEXT',
      ),
    ));

    # Table date defaults
    $this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
    $this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP");


    if($this->dbforge->create_table('sellers'))
    {
      $table = 'sellers';

      $data = array(
        'full_name' => 'Magen Attraglaitz',
        'birth_date' => '2018-01-01',
        'password' => password_hash('password', PASSWORD_DEFAULT),
        'gender' => 'Male',
        'civil_status' => 'Single',
        'home_address' => 'Royal Capital, Luspierheil, Attraglaitz Royal Castle',
        'office_address' => 'Strangaz',
        'mobile_num' => '09451494315',
        'office_fax' => 'Hello',
        'home_num' => '22299222',
        'email' => 'est@est.com',
        'real_estate_record_type' => 'Broker',
        'real_estate_record_payload' => '{}',
          'image_url' => 'https://robohash.org/Magen Attraglaitz?set=set4' ,
        );
        $this->db->insert($table, $data);

      $data = array(
        'full_name' => 'Vane',
        'birth_date' => '2018-01-01',
        'password' => password_hash('password', PASSWORD_DEFAULT),
        'gender' => 'Male',
        'civil_status' => 'Single',
        'home_address' => 'Unknown',
        'office_address' => 'Strangaz',
        'mobile_num' => '09451494311',
        'office_fax' => 'Hello',
        'home_num' => '22299222',
        'email' => 'est@est.com',
        'real_estate_record_type' => 'Agent',
        'real_estate_record_payload' => '{}',
        'image_url' => 'https://robohash.org/Vane?set=set4' ,
        );
        $this->db->insert($table, $data);

      }
    }

    public function down()
    {
      $this->dbforge->drop_table('sellers');
    }
  }
