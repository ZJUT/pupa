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
        array(
          'label' => 'imdb url',
          'name' => 'url',
          'type' => 'text',
          'value' => $data->url,
          'help' => '',
        ),
        array(
          'label' => 'category',
          'name' => 'type',
          'type' => 'select',
          'value' => $data->category,
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
          'name' => 'team_sel',
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
        array(
          'label' => '不要在浏览页面显示用户名',
          'name' => 'anonymous',
          'type' => 'checkbox',
          'value' => '1',
          'checked' => $data->anonymous == 'yes',
          'help' => '',
        ),
        array(
          'label' => '禁止',
          'name' => 'banned',
          'type' => 'checkbox',
          'value' => 'yes',
          'checked' => $data->banned == 'yes',
          'help' => '',
        ),
        array(
          'no_default' => true,
          'label' => '促销种子',
          'name' => 'sel_spstate',
          'type' => 'select',
          'value' => $data->sp_state,
          'help' => '',
          'options' => array(
            array(
              'id'=> 1,
              'name' => '普通',
            ),
            array(
              'id'=> 2,
              'name' => '免费',
            ),
            array(
              'id'=> 3,
              'name' => '2x',
            ),
            array(
              'id'=> 4,
              'name' => '2x 免费',
            ),
            array(
              'id'=> 5,
              'name' => '50%',
            ),
            array(
              'id'=> 6,
              'name' => '2x 50%',
            ),
            array(
              'id'=> 7,
              'name' => '30%',
            ),
          ),
        ),
        array(
          'no_default' => true,
          'label' => '种子位置',
          'name' => 'sel_posstate',
          'type' => 'select',
          'value' => $data->pos_state,
          'help' => '',
          'options' => array(
            array(
              'id'=> 0,
              'name' => '普通',
            ),
            array(
              'id'=> 1,
              'name' => '置顶',
            ),
          ),
        ),
      );
      //print_r($this->Options->load('codecs')->get());
      $this->twig->display('torrent_edit.html', array('options' => $options, 'data' => $data) );
    }
	}
?>
