<?php
//session_start();
require_once("logcop.php");
/*this page is ajax called and loads comments from the database

--How it works--
#receives post id, category id

#gets the post's category from the category_list table

#select all from comments table whose comment cat id and comment post id match the ones received

#select username, status from userbase where comments['id'] equals id

#output username, comments['posted date'], comment, comment category*, comment likes, comment id*
(* for new likes, report and quote)
*/
require('dba.php');

$post_id = $_REQUEST['post_id'];
$cat_name = $_REQUEST['cat_name'];

$comment_qString = "SELECT c.id, u.username, co.* FROM category_list c, userbase u, comments co WHERE co.comment_cat_id = c.id AND co.comment_post_id = $post_id AND c.category ='$cat_name' AND co.commenter_id = u.id ORDER BY comment_date DESC";

$comm_q = mysql_query($comment_qString, $dbconnect) or die(mysql_error());

if(mysql_num_rows($comm_q)){
while($c_res = mysql_fetch_array($comm_q)) {
	extract($c_res);
	$comment_id = stripslashes($id);
	$username = stripslashes($username);
	$comment = stripslashes($comment);
	$comment_likes = stripslashes($comment_likes);
	$comment_id = stripslashes($comment_id);
	$comment_load = "";

$comment_load .=<<<COMMENT
	
	<div class="comment-box" style="display: block;">
		
		<div class="comment-head">
			
			<span class="commenter-name">$username</span> <span class="comment-date">$comment_date</span>
	
		</div>

		<div class="comments">
		
			$comment
		
		</div>

		<div class="comment-foot">
			
			<span>Quote</span><span>$comment_likes Like(s) (<a href="commenttransact.php?id=$comment_id&action=like" title="Like comment" onclick="comLike($comment_id)">Like</a>)</span><span class="report"><a href="commenttransact.php?id=$comment_id&action=report" title="Report comment" onclick="comRep($comment_id)">Report</a></span>
	
		</div>

		</div>
	
	</div>


COMMENT;
}
} else {
	$comment_load = "No comments posted yet, be the first.";	
	$comment_load .= ($_SESSION["logged"] == 1) ? " Comment as " . $_SESSION["username"] : " <span style='color:blue; cursor: pointer;' onClick='loginForm()'>Login</span> to comment.";
}



$comment_load .=<<<COMSCRIPT
<script type = "text/javascript" src="commentscript.js"></script>
COMSCRIPT;

echo $comment_load;
?>