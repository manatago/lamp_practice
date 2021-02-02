<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';

session_start();
if($_SERVER['REQUEST_METHOD'] === 'POST'){
  if (is_valid_csrf_token($_POST['csrf'])    === false) {
    redirect_to(LOGIN_URL);
  }
}


if(is_logined() === false){
  redirect_to(LOGIN_URL);
}
$token=get_csrf_token();
$db = get_db_connect();
$user = get_login_user($db);

var_dump($_GET);
$items= pull_get_items($db);

include_once VIEW_PATH . 'index_view.php';