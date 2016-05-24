<?php
$files = array('bla_1.jpeg','bla_2.png','bla_3.txt','bla_4.csv','bla_5.doc','bla_6.html','bla_7.xml','bla_8.xml','bla_9.xls','bla_10.yaml');

function create_corect_file_data($files){
  $result = array();
  $time = time();
  for ($i=0;$i<=1000;$i++){
    $number = rand(1,3600);
    $event = rand (0,1);
    $file = rand(0,9);

    $time +=$number;
    $result[$i][0] = date('Y-m-d H:i:s',$time);

    if ($event == 0){
      $result[$i]['event_type'] = 'file_upload';
    }
    else{
      $result[$i]['event_type'] = 'file_download';
    }
    
    $result[$i]['filename'] = $files[$file];
  }
  $result;

  write_file($result, 'corect.csv');
}

function create_file_wrong_data($files){
  $result = array();
  $time = time();
  for ($i=0;$i<=1000;$i++){
    $number = rand(1,3600);
    $event = rand (0,2);
    $file = rand(0,9);

    $time +=$number;
    $result[$i][0] = date('Y-m-d H:i:s',$time);

    if ($event == 0){
      $result[$i]['event_type'] = 'file_upload';
    }
    elseif ($event == 1) {
      $result[$i]['event_type'] = 'file_download';
    }
    else {
      $result[$i]['event_type'] = 'wrong data';
    }


    $result[$i]['filename'] = $files[$file];
  }
  write_file($result, 'incorect.csv');
}

function write_file($data,$file){

  $fp = fopen($file, 'w');
  foreach ($data as $item){
    fputcsv($fp, $item);
  }
  fclose($fp);
}

create_corect_file_data($files);
create_file_wrong_data($files);