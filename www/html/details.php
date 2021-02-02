<?php
require_once '../conf/const.php';
require_once MODEL_PATH. 'functions.php';
require_once MODEL_PATH. 'user.php';
require_once MODEL_PATH. 'item.php';
require_once MODEL_PATH. 'cart.php';

session_start();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if (is_valid_csrf_token($_POST['csrf'])    === false) {
      redirect_to(LOGIN_URL);
    }
  }

if(is_logined() === false){
  redirect_to(LOGIN_URL);
}

$db = get_db_connect();
$user = get_login_user($db);
$histories = get_history($db, $user['user_id']);

$order_id = get_post('order_id');

$details = get_detail($db, $order_id, $user['user_id']);

include_once VIEW_PATH. '/details_view.php';