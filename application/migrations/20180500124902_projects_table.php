<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_projects_table extends CI_Migration {

  public function up()
  {
    # Table PK
    $this->dbforge->add_field('id');

    # Other table fields
    $this->dbforge->add_field(array(
      'title' => array(
        'type' => 'TEXT',
      ),
      'address' => array(
        'type' => 'TEXT',
        'null' => true
      ),
      'total_land_area' => array(
        'type' => 'TEXT',
        'null' => true
      ),
      'phases' => array(
        'type' => 'TEXT',
        'null' => true
      ),
      'status' => array(
        'type' => 'TEXT',
        'null' => true
      ),
      'image_url' => array( # logo of the project
      'type' => 'TEXT',
    ),
  ));

  # Table date defaults
  $this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
  $this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP");

  if($this->dbforge->create_table('projects'))
  {
    $table = 'projects';

    $data = array(
      'title' => 'Casa Mira Linao',
      'image_url' => base_url('public/uploads/projects/CM Linao.jpg'),
    );
    $this->db->insert($table, $data);

    $data = array(
      'title' => 'Casa Mira South',
      'image_url' => base_url('public/uploads/projects/CM South.jpg'),
    );
    $this->db->insert($table, $data);

    $data = array(
      'title' => 'Casa Mira Coast',
      'image_url' => base_url('public/uploads/projects/CM Coast.jpg'),
    );
    $this->db->insert($table, $data);

    $data = array(
      'title' => 'Casa Mira Guadalupe',
      'image_url' => base_url('public/uploads/projects/CM Guadalupe.jpg'),
    );
    $this->db->insert($table, $data);

    $data = array(
      'title' => 'Casa Mira Labangon',
      'image_url' => base_url('public/uploads/projects/CM Labangon.jpg'),
    );
    $this->db->insert($table, $data);

    ##### End of casa shits #####

    $data = array(
      'title' => 'Midori Plains',
      'image_url' => base_url('public/uploads/projects/Midori plains.jpg'),
    );
    $this->db->insert($table, $data);

    $data = array(
      'title' => 'San Josemaria Village - Balamban',
      'image_url' => base_url('public/uploads/projects/SJV - Bal.jpg'),
    );
    $this->db->insert($table, $data);

    $data = array(
      'title' => 'San Josemaria Village - Minglanilla',
      'image_url' => base_url('public/uploads/projects/SJV - Ming.jpg'),
    );
    $this->db->insert($table, $data);

    $data = array(
      'title' => 'San Josemaria Village - Talisay',
      'image_url' => base_url('public/uploads/projects/SJV - Tal.jpg'),
    );
    $this->db->insert($table, $data);

    $data = array(
      'title' => 'San Josemaria Village - Toledo',
      'image_url' => base_url('public/uploads/projects/SJV - Tol.jpg'),
    );
    $this->db->insert($table, $data);

    ##############

    $data = array(
      'title' => 'Velmiro Heights',
      'image_url' => base_url('public/uploads/projects/Velmiro Heights logo_png.jpg'),
    );
    $this->db->insert($table, $data);

    $data = array(
      'title' => 'Mivesa Garden Residences',
      'image_url' => base_url('public/uploads/projects/Mivesa Garden Residences logo_png.jpg'),
    );
    $this->db->insert($table, $data);

    $data = array(
      'title' => 'Midori Residences',
      'image_url' => base_url('public/uploads/projects/Midori Residences logo_png.jpg'),
    );
    $this->db->insert($table, $data);

    $data = array(
      'title' => 'MesaVirre Garden Residences',
      'image_url' => base_url('public/uploads/projects/MesaVirre Garden Residences logo_png.jpg'),
    );
    $this->db->insert($table, $data);

    $data = array(
      'title' => 'MesaVerte Residences',
      'image_url' => base_url('public/uploads/projects/MesaVerte Residences logo_png.jpg'),
    );
    $this->db->insert($table, $data);

    $data = array(
      'title' => 'MesaTierra Garden Residences',
      'image_url' => base_url('public/uploads/projects/MesaTierra Garden Residences logo_png.jpg'),
    );
    $this->db->insert($table, $data);

  }
}

public function down()
{
  $this->dbforge->drop_table('projects');
}
}
