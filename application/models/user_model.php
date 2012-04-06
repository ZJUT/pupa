<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  /**
   * 
   */
  class User_Model extends CI_Model
  {
    function __construct()
    {
      parent::__construct();
      $this->load->database();
    }

    public function get_user($username)
    {
      if(is_string($username)){
        $condition = array('username' => $username);
      } else if (is_array($username)){ 
        $condition = $username;
      } else {
        return false;
      }
      $query = $this->db->get_where('users', $condition);
      if($query->num_rows() == 1){
        return $query->row();
      } else {
        return false;
      }
    }

    # return Boolean
    public function auth($username, $password)
    {
      $user = $this->get_user($username);
      if( $user and $this->_make_hash($password, $user->secret) == $user->passhash){
        return $user;
      }
      return false;
    }

    # make password hash
    public function _make_hash($password, $secret)
    {
        return md5($secret . $password . $secret);
    }

    public function _make_secret($len = 20)
    {
      $ret = "";
      for ($i = 0; $i < $len; $i++){
        $ret .= chr(mt_rand(100, 120));
      }
      return $ret;
    }

    # add user
    public function create_user($username, $password='', $email='', $avator='')
    {
      if(is_object($username)){
        $username = (array)$username;
      }

      if(is_array($username)){
        extract($username);
      }

      $secret = $this->_make_secret();
      $passhash = $this->_make_hash($password, $secret);
      // must have keys in param `username`, `password`, `email`
      $param = array(
        'avatar' => $avator,
        'username' => $username,
        'passhash' => $passhash,
        'secret' => $secret,
        'editsecret' => ' ',
        'email' => $email,
        'country' => 8,
        'gender' => "N/A",
        'status' => 'confirmed',
        'class' => 1,
        'invites' => 0,
        'added' => date("Y-m-d H:i:s"),
        'last_access' => date("Y-m-d H:i:s"),
        'lang' => 25,
        'stylesheet' => 0,
        'uploaded' => 0
      );
      $this->db->insert('users', $param);
    }
  }
?>

