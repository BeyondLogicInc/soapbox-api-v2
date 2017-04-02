<?php
function json($result, $success, $mime='application/json', $status = 200) {
    // Get current CodeIgniter instance
    $CI =& get_instance();
    $response = array(
      'success' => $success,
      'result' => $result
    );

    // We need to use $CI->output instead of $this->output
    return $CI->output
      ->set_status_header($status)
      ->set_content_type($mime, 'utf-8')
      ->set_output(json_encode($response));
}
?>
