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
    $imported_csv = $this->sales_model->upload('imported_csv', $this->input->post('full_name'));
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

  public function bulk_import($value='')
  {
    $data['last_uploaded_csv_path'] = $this->bulk_import_model->getLastUploadedCsv();
    $data['export_csv_url'] = base_url('admin/sales/export-all');
    $this->wrapper('admin/bulk-import', $data);
  }

  public function export_all()
  {
    $list = $this->db->get('sales')->result_array();;

    // output headers so that the file is downloaded rather than displayed
    header('Content-type: text/csv');
    header('Content-Disposition: attachment; filename="sales_export.csv"');

    // do not cache the file
    header('Pragma: no-cache');
    header('Expires: 0');

    // create a file pointer connected to the output stream
    $file = fopen('php://output', 'w');

    // send the column headers
    fputcsv($file, array('Project name', 'Sales amount', 'Date', 'Sellers Email'));

    $res = $this->sales_model->all();
    $new_res = [];
    foreach ($res as $key => $value) {
      if ($value->seller_id) { # skip zeros
        $new_res[] = array(
          $value->project_name,
          $value->sales_amount,
          $value->date,
          $this->sellers_model->getById($value->seller_id)->email,
        );
      }
    }

    $data = $new_res;
    // var_dump($data); die();

    // output each row of the data
    foreach ($data as $row)
    {
      fputcsv($file, $row);
    }

    exit();
  }

  public function bulk_append()
  {
    $imported_csv = $this->bulk_import_model->upload('file_name');
    $this->bulk_import_model->add($imported_csv); # We update the seller's last imported CSV

    $last_uploaded_csv_path = base_url() . "uploads/bulk_import/{$imported_csv['file_name']}";
    $csv_arr = array_map('str_getcsv', file($last_uploaded_csv_path));

    if ($this->bulk_import_model->appendCsv($csv_arr)) {
      $this->session->set_flashdata('flash_msg', ['message' => 'Import success. Data updated', 'color' => 'green']);
      custom_response(200, ['message' => 'Import success. Data updated', 'code' => 'ok'], $this);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Unknown error occured while importing', 'color' => 'red']);
      custom_response(200, ['message' => 'Unknown error occured while importing', 'code' => 'err'], $this);
    }
  }

  public function bulk_replace()
  {
    $imported_csv = $this->bulk_import_model->upload('file_name');
    $this->bulk_import_model->add($imported_csv); # We update the seller's last imported CSV

    $last_uploaded_csv_path = base_url() . "uploads/bulk_import/{$imported_csv['file_name']}";
    $csv_arr = array_map('str_getcsv', file($last_uploaded_csv_path));

    if ($this->bulk_import_model->replaceCsv($csv_arr)) {
      $this->session->set_flashdata('flash_msg', ['message' => 'Import success. Dataset replaced', 'color' => 'green']);
      custom_response(200, ['message' => 'Import success. Data updated', 'code' => 'ok'], $this);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Unknown error occured while importing', 'color' => 'red']);
      custom_response(200, ['message' => 'Unknown error occured while importing', 'code' => 'err'], $this);
    }
  }

}
