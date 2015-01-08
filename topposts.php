<?php
/* This module loads top posts as specified by the site admin, on update will be determined by 
number of pageviews
*/

include 'dba.php';

$cat_select = "SELECT * FROM category_list, top_posts WHERE category_list.id = top_posts.post_cat_id ORDER BY top_posts.id DESC LIMIT 0,5";
$top_post_query = mysql_query($cat_select, $dbconnect) or die(mysql_error());

while ($row = mysql_fetch_array($top_post_query))
	{

		extract($row);
		$post_select = "SELECT * FROM $category c WHERE c.id = $post_id";
		$top_post = mysql_query($post_select, $dbconnect) or die(mysql_error());
		$row1 = mysql_fetch_assoc($top_post);		

		$top_post_title = substr($row1['post_title'],0,18);
		$top_post = substr($row1['post'],0,150);
		
		
		echo '<div class="post-snippet-main-container">';
		echo '<a href = "post.php?category='.$category.'&id='.$post_id.'">';
		echo '<span class="post-topic-title">'.$row1['post_title'].'('.$category_name.')</span>';
		echo '<div class="post-topic-partcontent">';
		echo $top_post.'...';
		echo '</div>';
		echo '</a>';
		echo '</div>';

		
	}
	
?>