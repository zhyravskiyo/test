<?php

class Statistics extends CI_Controller{
  private $js_files_head = array(
    'https://www.gstatic.com/charts/loader.js',
    'https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js'
  );
  private $js_files_footer = array('/application/views/statistics/js/chart.js',);
  
  private $css_files = array('/application/views/statistics/css/style.css');

  private $path = './application/download';

  public function __construct() {
    parent::__construct();

    $this->load->model('Statistics_files');
  }

  public function index(){
    $data = array();

    $data['js_files_head'] = $this->js_files_head;
    $data['js_files_footer'] = $this->js_files_footer;
    $data['css_files'] = $this->css_files;
    $data['title'] = 'files list';
    
    $data['files'] = $this->Statistics_files->get_files($this->path);
    $bla = $data['files'];
    $a = $bla;
    $this->load->view('statistics/head',$data);
    $this->load->view('statistics/files_list',$data);
    $this->load->view('statistics/footer',$data);

  }

  public function file($name){
    $data = array();

    $data['js_files_head'] = $this->js_files_head;
    $data['js_files_footer'] = $this->js_files_footer;
    $data['css_files'] = $this->css_files;
    $data['title'] = 'statistics of the file ' . $name;

    $path = $this->path . "/" . $name;
    $data['table'] = $this ->Statistics_files-> get_file_teble_data($path);

    $this->load->view('statistics/head',$data);
    $this->load->view('statistics/menu');
    $this->load->view('statistics/graphics');
    $this->load->view('statistics/table',$data);
    $this->load->view('statistics/footer',$data);
  }
  
  public function graphics($file){
    $path = $this->path . "/" . $file;
    $garphics = $this->Statistics_files->get_file_graphics_data($path);

    echo json_encode($garphics);
  }

  public function _remap($method, $params = array()) {
    if (method_exists($this, $method)) {
        return call_user_func_array(array($this, $method), $params);
      }
      show_404();
  }
}