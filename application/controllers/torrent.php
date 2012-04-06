<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
	 * 
	 */
  class Torrent extends CI_Controller{
		function __construct()
		{
      parent::__construct();
      $this->load->model('Torrent_Model');
      $this->load->library('twig');
		}
		
		function detail($id=false)
		{
			if(!$id){
				echo "no id";
			}
			$data = $this->Torrent_Model->get($id);
			$this->twig->display('torrent.html', (array)$data);
		}
	}
?>
