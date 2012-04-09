<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
	 * 
	 */
  class Torrent extends CI_Controller{
		function __construct()
		{
      parent::__construct();
      $this->load->model('Torrent_Model');
      $this->load->model('Options');
      $this->load->library('twig');
		}
		
		function detail($id=false)
		{
			if(!$id){
				echo "no id";
        return false;
			}

			$data = $this->Torrent_Model->fetch($id)->bbToMarkdown()->toHtml()->get();
			$this->twig->display('torrent.html', (array)$data);
		}

    function edit($id=false){
      if( !$id ) return false;
      $data = $this->Torrent_Model->fetch($id)->get($id);

      $options = array(
        array(
          'label' => 'title',
          'name' => 'name',
          'type' => 'text',
          'value' => $data->name,
          'help' => '',
        ),
        array(
          'label' => 'sub title',
          'name' => 'small_descr',
          'type' => 'text',
          'value' => $data->small_descr,
          'help' => '',
        ),
        //array(
          //'label' => 'imdb url',
          //'name' => 'url',
          //'type' => 'text',
          //'value' => $data->url,
          //'help' => '',
        //),
        array(
          'label' => 'category',
          'name' => 'type',
          'type' => 'select',
          'value' => $data->type,
          'help' => '',
          'options' => $this->Options->load('categories')->get(),
        ),
        array(
          'label' => 'media',
          'name' => 'medium_sel',
          'type' => 'select',
          'value' => $data->medium,
          'help' => '',
          'options' => $this->Options->load('media')->get(),
        ),
        array(
          'label' => 'Codec',
          'name' => 'codec_sel',
          'type' => 'select',
          'value' => $data->codec,
          'help' => '',
          'options' => $this->Options->load('codecs')->get(),
        ),
        array(
          'label' => 'Standard',
          'name' => 'standard_sel',
          'type' => 'select',
          'value' => $data->standard,
          'help' => '',
          'options' => $this->Options->load('standards')->get(),
        ),
        array(
          'label' => 'Teams',
          'name' => 'teams_sel',
          'type' => 'select',
          'value' => $data->team,
          'help' => '',
          'options' => $this->Options->load('teams')->get(),
        ),
        array(
          'label' => 'visible',
          'name' => 'visible',
          'type' => 'checkbox',
          'value' => '1',
          'checked' => $data->visible == 'yes',
          'help' => '',
        ),
      );
      //print_r($this->Options->load('codecs')->get());
      $this->twig->display('torrent_edit.html', array('options' => $options, 'data' => $data) );
    }
	}
?>
