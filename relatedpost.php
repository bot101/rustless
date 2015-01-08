<?php
$tags = "";
$tag_list = explode(",",$post_tag);
/*
related post builder. This one will gidigan!!
This module will use a yet to be determined algorithm to determine
posts that are related to the main post and loading snippets of the top two most related posts.
Time to test my wits aye!. Lets see what my head can manufacture.

1. allow user enter tags
2. search for posts with similar tags
3. load top two posts with highest number of tag matches
*/	
$tags .= "'%%'";

foreach($tag_list as $tag) {
	$tag = trim($tag);
	$tags .= " or '%".$tag."%'";	
}

//temporary hack here till i find a better way to eliminate the last 'or'
$rel_post_qString = "SELECT * FROM $post_category pc WHERE pc.id <> $_post_id AND pc.tags LIKE $tags'' ORDER BY pc.id DESC LIMIT 0 , 2";

$rel_post_query = mysql_query($rel_post_qString,$dbconnect);

while($rel_post = mysql_fetch_array($rel_post_query)){
	//extracting data one by one to avoid variable name clashes
	$rel_post_id = $rel_post['id'];
	$rel_post_title = substr($rel_post['post_title'],0,18);
	$rel_post = substr($rel_post['post'],0,150);
	$post_done = "";

echo '<div class="related-post">';
echo '<a href="post.php?category='.$post_category.'&id='.$rel_post_id.'">';
echo	'<span class="post-topic-title">'.$rel_post_title.'...</span>';
echo	'<div class="post-topic-partcontent">';
echo		$rel_post."...";
echo	'</div>';
echo '</a>';			
echo '</div>';
		
}

?>