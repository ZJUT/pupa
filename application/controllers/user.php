<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  /**
   * Basic Auth.
   */
  class User extends CI_Controller {

    public function __construct()
    {
      parent::__construct();
      $this->load->helper(array('cookie', 'base64'));
      $this->load->model('User_Model');
    }

    function index()
    {
      //print $this->User_Model->sayhello();
    }

    function login()
    {
      # XSS
      $username = $this->input->post('username', true);
      $password = $this->input->post('password', true);
      if($username and $password){
        $user = $this->_auth($username, $password);
        if($user){
          $this->_logincookie($user->id, $user->passhash);
          $this->_login_success();
        } else {
          $this->_login_wrong_password();
        }
      } else {
        //$this->_login_no_info();
        $this->load->library('Twig');
        $this->twig->display('login.html');
      }
    }

    function _login_success()
    {
      print "Login success!";
    }

    function _login_wrong_password()
    {
      print "Wrong username or password!";
    }

    function _login_no_info()
    {
      print "No username or password inputed!";
    }

    function logout()
    {
      $cookies = array(
        'uid', 'pass', 'ssl', 'tracker_ssl', 'login',
      );
      foreach($cookies as $cookiename){
        delete_cookie($cookiename);
      }
    }

    # rewrite NexusPHP's `logincookie` function
    function _logincookie($id, $passhash, $updatedb = 1, $expires = 0x7fffffff, $securelogin=false, $ssl=false, $trackerssl=false)
    {
      if($securelogin){
	      $securelogin_indentity_cookie = true;
	      $passhash = md5($passhash . $_SERVER["REMOTE_ADDR"]);
      } else {
	      $passhash = md5($passhash);
      }
      $prefix = 'c_secure_';
      $cookies = array(
        'uid' => base64($id),
        'pass' => $passhash,
        'ssl' => $ssl ? base64('yeah') : base64('nope'),
        'tracker_ssl' =>  $trackerssl ? base64('yeah') : base64('nope'),
        'login' =>  $securelogin ? base64('yeah') : base64('nope'),
      );
      foreach( $cookies as $key => $value ){
        $this->input->set_cookie(
          array(
            'name' => $key,
            'value' => $value,
            'expire' => $expires,
            # 'domain' => ''
            'path' => '/',
            'prefix' => $prefix,
            'secure' => false,
          )
        );
      }
    }

    function _auth($username, $password)
    {
      $this->load->config('auth');
      $auth_type = $this->config->item('auth_type');
      if($auth_type == 'default'){
        return $this->User_Model->auth($username, $password);
      } else {
        # helper
        $this->load->helper('authtype/' . $auth_type );
        # this function is autoloaded from a helper.
        $result = third_party_auth($username, $password);
        if($result){
          $userinfo = $this->User_Model->get_user($username);
          if( ! $userinfo ){
            $this->User_Model->create_user($result);
            $userinfo = $this->User_Model->get_user($username);
          }
          return $userinfo ? $userinfo : false;
        } else {
          return false;
        }
      }
    }
  }
?>

