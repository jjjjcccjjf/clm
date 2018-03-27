<?php
class About_model extends Admin_core_model # application/core/MY_Model.php
{
  function __construct()
  {
    parent::__construct();
    $this->table = 'about';
  }

}
