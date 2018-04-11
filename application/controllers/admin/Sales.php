<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends Admin_core_controller { # see application/core/MY_Controller.php

  public function index()
  {
    if (!$this->input->get('u')) {
      redirect('admin/sellers');
    }
    $res = $this->sales_model->getSales($this->input->get('u')); # user id
    $data['sales'] = $res;
    $data['seller'] = $this->sellers_model->get($this->input->get('u')); # user id
    $this->wrapper('admin/sales', $data);
  }

  public function import($id)
  {
    $imported_csv = $this->sales_model->upload('imported_csv');
    $this->sellers_model->update($id, $imported_csv); # We update the seller's last imported CSV

    $last_uploaded_csv_path = $this->sellers_model->getLastUploadedCsv($id);
    $csv_arr = array_map('str_getcsv', file($last_uploaded_csv_path));

    if ($this->sales_model->replaceCsv($id, $csv_arr)) {
      $this->session->set_flashdata('flash_msg', ['message' => 'Import success. Data updated', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Unknown error occured while importing', 'color' => 'red']);
    }

    redirect('admin/sales' . "?u={$id}");
  }

}
