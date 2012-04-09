<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  class Torrent_Model extends CI_Model
	{
    function __construct()
    {
      parent::__construct();
			$this->load->database();
			$this->load->model('User_Model');
			$this->load->helper('markdown');
			$this->load->helper('bbcode');
      $this->_model = null;
    }

		function fetch($id){
			$query = $this->db->get_where('torrents', array('id' =>$id));
			if($query->num_rows() == 1){
				$torrent = $query->row();
				$torrent->owner = $this->User_Model->get_user(array('id'=> $torrent->owner));
				$this->_model = $torrent;
			} else {
        $this->_model = false;
			}
      return $this;
		}

    // convery Markdown toHtml
    function toHtml(){
      if($this->_model){
        $this->_model->descr = Markdown($this->_model->descr);
      }
      return $this;
    }

    function bbToMarkdown(){
      if($this->_model){
        $this->_model->descr = bb2Markdown($this->_model->descr);
      }
      return $this;
    }

    // get the model.
    function get(){
      return $this->_model;
    }
	}
?>

