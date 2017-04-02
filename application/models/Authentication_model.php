<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication_model extends CI_Model {
  public function validate_credentials($username, $password) {
    $result = $this->db->query("SELECT * FROM useraccounts WHERE username='$username' AND password='$password'");
    if($result->num_rows() > 0){
        $row = $result->row_array();
        $query = $this->db->query("SELECT uid as userid, fname, lname, avatarpath from extendedinfo where uid = " . $row['srno']);
        return $query->row_array();
    }
    return false;
  }
}
