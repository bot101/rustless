<?php

require "dba.php";

$name = addslashes(trim($_REQUEST['name']));
$email = addslashes(trim($_REQUEST['email']));
$comment = addslashes(trim($_REQUEST['comment']));
$category = addslashes(trim($_REQUEST['cat']));
$post_id = addslashes(trim($_REQUEST['id']));


$where_get_q_String = "SELECT c.id, u.id, u.comment_count FROM category_list c, userbase u WHERE c.category = '$category' AND u.username = '$name' LIMIT 1";
$where_get_q_Query = mysql_query($where_get_q_String,$dbconnect) or die(mysql_error());

$get_row = mysql_fetch_row($where_get_q_Query);

$post_cat_id = trim($get_row[0]);
$userbase_id = trim($get_row[1]);
$comment_count_no = trim($get_row[2]);
$comment_count_no = $comment_count_no + 1;

print_r($where_get_q_String);
$comment_post_q_String = "INSERT INTO comments (id,comment_post_id,comment_cat_id,commenter_id,comment) VALUES (null, '$post_id', '$post_cat_id', '$userbase_id', '$comment')";
$comment_post_q_Query = mysql_query($comment_post_q_String,$dbconnect) or die(mysql_error());

$comment_count_u_qString = "UPDATE userbase u, $category c SET u.comment_count=$comment_count_no, c.comment_count=c.comment_count+1 WHERE u.id = $userbase_id AND c.id = $post_id";
$comment_count_u_q_Query = mysql_query($comment_count_u_qString,$dbconnect) or die(mysql_error());

?>
