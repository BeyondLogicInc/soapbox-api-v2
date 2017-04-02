<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication extends CI_Controller {
  public function login() {
    $username = $this->security->xss_clean($this->input->post('username'));
    $password = $this->security->xss_clean($this->input->post('password'));

    $this->load->model('Authentication_model');

    $result = $this->Authentication_model->validate_credentials($username, md5($password));
    $data = false;

    if($result) {
      $data = array(
        "userid" => $result['userid'],
        "username" => $username,
        "fname" => $result['fname'],
        "lname" => $result['lname'],
        "avatarpath" => $result['avatarpath']
      );
      $this->session->set_userdata($data);
    }
    return json($data, $result != false);
  }

  public function logout() {
    foreach (array('userid', 'username', 'fname', 'lname', 'avatarpath') as $key => $value) {
      $this->session->unset_userdata($key);
    }
    session_destroy();
    return json('User logged out', true);
  }
}
