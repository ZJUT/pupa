<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  class Torrent_Model extends CI_Model
	{
    function __construct()
    {
      parent::__construct();
			$this->load->database();
			$this->load->model('User_Model');
			$this->load->helper('markdown');
    }

		function get($id){
			$query = $this->db->get_where('torrents', array('id' =>$id));
			if($query->num_rows() == 1){
				$torrent = $query->row();
				$torrent->owner = $this->User_Model->get_user(array('id'=> $torrent->owner));
				$torrent->descr = Markdown($torrent->descr);
				return $torrent;
			} else {
				return false;
			}
		}
	}
?>

