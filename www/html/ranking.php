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

$items = get_ranking_items($db);

function get_ranking_items($db, $is_open = false){
    $sql = '
    SELECT
        items.item_id,
        items.name,
        items.stock,
        items.price,
        items.image,
        items.status,
        SUM(details.amount) AS total
    FROM
        items
    INNER JOIN
        details
    ON
        items.item_id=details.item_id
    GROUP BY
        details.item_id
    ORDER BY
        total DESC
    LIMIT 3
    ';
  

    if($is_open === true){
        $sql .= '
          WHERE status = 1
        ';
      }

    return fetch_all_query($db, $sql);
  }


include_once VIEW_PATH . 'ranking_view.php';