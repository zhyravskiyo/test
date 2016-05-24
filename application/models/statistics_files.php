<?php

/**
 * Created by PhpStorm.
 * User: olegmaniake
 * Date: 23.05.2016
 * Time: 18:47
 */
class Statistics_files extends CI_Model{
  private $events = array('file_upload','file_download');
  private $date_format = "Y-m-d";

  public function get_files($path){
    $this->load->helper('file');
    $file_names = get_filenames($path);
    $result = array();

    foreach ($file_names as $file_name){
      $file = explode(".",$file_name);
      if ($file[1] == "csv"){
        $result[] = $file[0];
      }
    }
    return $result;
  }

  private function read_file($path){
    $file = $path. '.csv';
    $result = array();
    if (($fp = fopen($file,'r')) !=FALSE){
      while (($data = fgetcsv($fp)) !=FALSE ) {
        $result[]= $data;
      }
    }

    return $result;
  }

  private function get_graphics_variables($data){

  }

  private function check_time($time){
    $time_stamp = strtotime($time);

    if ($time_stamp !== FALSE){
      return date($this->date_format,$time_stamp);
    }

    return FALSE;
  }

  private function check_event($event){
    if (in_array($event,$this->events)){
      return $event;
    }

    return FALSE;
  }
  private function get_corect_array($data){
    foreach ($data as $item){
      $date = $this->check_time($item[0]);
      $event = $this->check_event($item[1]);
      $file = $item[2];
      if ((isset($file) && !empty($file)) && ($date != FALSE) && ($event != FALSE)){
        if (isset($result[$date][$event][$file]) && !empty($result[$date][$event][$file])){
          $result[$date][$event][$file]++;
        }else{
          $result[$date][$event][$file] = 1;
        }
      }
    }

    return $result;
  }
  private function get_variables($data){
    $corect_array = $this->get_corect_array($data);
    $return = array();



    foreach ($corect_array as $date => $value){
      foreach ($value as $event=>$item){
        $return[$date][$event] = array_sum($item);
        if ($event == 'file_upload'){
          arsort($item);
          reset($item);
          $return[$date]['file'][key($item)] = current($item);
        }
      }
    }
    krsort($return);
    return $return;
  }

  public function get_file_teble_data($path){
    $file_data = $this->read_file($path);
    $result = $this->get_variables($file_data);
    return $result;
  }
  public function get_file_graphics_data($path){
    $file_data = $this->read_file($path);
    $corect_array = $this->get_corect_array($file_data);
    $return = array();
    $pattern = array('date',"upload","download");
    foreach ($corect_array as $date => $value){
      foreach ($value as $event=>$item){
        $return[$date][$event] = array_sum($item);
      }
    }
    $result = array();

    foreach ($return as $date => $value){
      if (isset($value['file_upload']) && !empty($value['file_upload'])){
        $upload = $value['file_upload'];
      }
      else{
        $upload = 0;
      }
      if (isset($value['file_download']) && !empty($value['file_download'])){
        $download = $value['file_upload'];
      }
      else{
        $download = 0;
      }
      $result[] = array($date,$upload,$download);
    }
    return $result;
  }
}