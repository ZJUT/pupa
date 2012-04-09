<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// codec / categories / media / standards / sources
  class Options extends CI_Model{
    var $_db_name = null;

    function __construct()
    {
      $this->_db_name = null;
      $this->load->database();
    }

    // options_model->name('all')->
    function load($name)
    {
      $available_tables = array(
        'codecs', // 编码 id name sort_index
        'categories', // 分类 id name class_name name image sort_index
        'media', // 媒介 id name sort_index
        'standards', // 分辨率 id name sort_index
        // 'sources', // same with media!!!
        'teams', // 制作组 id name sort_index
      );
      // if name in available_tables: # Pythoner
      if(in_array( $name, $available_tables )){
        $this->_db_name = $name;
      }
      return $this;
    }

    function get(){
      if($this->_db_name){
        $query = $this->db->get($this->_db_name);
        if($query->num_rows() > 0){
          return $query->result();
        } else {
          return false;
        }
      }
    }
  }

// languages / locations / isp /

?>

