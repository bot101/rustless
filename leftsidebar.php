<?php
require ("dba.php");


$left_sidebar =<<<LEFTSIDEBAR

	<div id="left-sidebar">

		<ul id="left-sidebar-links">
	
			<li class="sidebar-link" id="homeLink"><a href="index.php">Home</a></li>
			<li class="sidebar-link" id="topLink"><a href="#">Top Stories</a></li>
			<li class="sidebar-link" id="trendLink"><a href="category.php?category=trending">Trending</a></li>
			<li class="sidebar-link" id="politicsLink"><a href="category.php?category=politics">Politics</a></li>
			<li class="sidebar-link" id="entertainLink"><a href="category.php?category=entertainment">Entertainment</a></li>
			<li class="sidebar-link" id="eduLink"><a href="category.php?category=education">Education</a></li>
			<li class="sidebar-link" id="sportsLink"><a href="category.php?category=sports">Sports</a></li>
			<li class="sidebar-link" id="newsLink"><a href="category.php?category=news">News</a></li>

		</ul>


	</div>
	
	<div id="right-float">
	
LEFTSIDEBAR;

echo $left_sidebar;

?>