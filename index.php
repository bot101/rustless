<?php
//this is the homepage
require 'dba.php';

$cat_select_qString = "SELECT * FROM category_list";
$cat_select_qResult = mysql_query($cat_select_qString,$dbconnect);
$cat_list = "";
$content = "";

$img_post_q_s = "SELECT *,c.category FROM images i, category_list c WHERE i.img_cat_id=c.id AND i.is_featured = 1 ORDER BY i.id DESC LIMIT 6";
$img_query = mysql_query($img_post_q_s,$dbconnect) or die (mysql_error());
$images = "";
$tooltips = "";
$id_id = 0;

while ($img_row = mysql_fetch_array($img_query)){
	
	$img_cat = $img_row['category'];
	$img_id = $img_row[0];
	$img_alt = $img_row['image_alt'];
	$img_post_title = $img_row['post_title'];
	$img_post_id = $img_row['id'];
	
	$images .= "<li><a href=\"post.php?category=".$img_cat."&id=".$img_post_id."\" target=\"_self\"><img src=\"data2/images/".$img_id.".jpg\" alt=\"".$img_alt."\" title=\"".$img_post_title."\" id=\"wows2_".$id_id."\"/></a>".$img_post_title."</li>";
	
	$tooltips .= "<a href=\"post.php?category=".$img_cat."&id=".$img_post_id."\" title=\"".$img_post_title."\"><img src=\"data2/tooltips/".$img_id.".jpg\" alt=\"".$img_alt."\"/>1</a>";
	
	$id_id++;
}

while ($cat_row = mysql_fetch_array($cat_select_qResult)){
		
		//this is crazy
		$home_q_s = "SELECT * FROM ". $cat_row[2] ." ORDER BY id DESC LIMIT 1";
		$home_q_r = mysql_query($home_q_s,$dbconnect) or die (mysql_error());
		$home_row = mysql_fetch_array($home_q_r);
		
		$cat = $cat_row[2];
		$cat_name = $cat_row[1];
		$p_title = $home_row['post_title'];
		$p_id = $home_row['id'];
		$short_p_title = substr($p_title,0,20);	
		$p_post = substr($home_row['post'],0,160);
		
$content .=<<<CONT

		<div class="last-cat-post">
							
			<a href="post.php?category=$cat&id=$p_id" title="Click to read">
			<span class="post-title" title="$p_title"><span class="post-cat-title">$cat_name:</span>$short_p_title...</span>
			$p_post...
			</a>
		</div>
CONT;
	}


?>
<!DOCTYPE HTML>
<html>

<head>

<title>Rustless: HOME</title>


<script type="text/javascript" src='script.js'></script>
<script type="text/javascript" src="engine2//jquery.js"></script>

<style type="text/css">
@import url('style.css');
@import url('homestyle.css');
</style>
<link rel="stylesheet" type="text/css" href="engine2//style.css" media="screen" />

</head>

<body id="home">
<div id="page-holder" >

	<?php include 'header.php'; ?>
	
	<?php include 'leftsidebar.php'; ?>
	
		<div id="main-contents">
			
			<div id="contents">
			
				<div id="top-box">
				
					<div id="slider-box">
					
						<!-- Start WOWSlider.com BODY section id=wowslider-container2 -->
						<div id="wowslider-container2">
							<div class="ws_images">
								<ul>
									<?php echo $images; ?>
									<!--
									<li><a href="#" target="_self"><img src="data2/images/1.jpg" alt="Chrysanthemum" title="Chrysanthemum" id="wows2_0"/></a>Crysanthemum price increases by 20% in the intermarket</li>
									<li><a href="#" target="_self"><img src="data2/images/desert.jpg" alt="Desert Oil" title="Desert Oil" id="wows2_1"/></a>The desert region of  middle east records increased oil exploration interest from multinational</li>
									<li><img src="data2/images/hydrangeas.jpg" alt="Hydrangeas" title="Hydrangeas" id="wows2_2"/></li>
									<li><img src="data2/images/jellyfish.jpg" alt="Jellyfish" title="Jellyfish" id="wows2_3"/></li>
									<li><img src="data2/images/penguins.jpg" alt="Penguins" title="Penguins" id="wows2_4"/></li>
									<li><img src="data2/images/tulips.jpg" alt="Tulips" title="Tulips" id="wows2_5"/></li>
									!-->
								</ul>
							
							</div>
						
							<div class="ws_bullets">
							
								<div>
									<?php echo $tooltips ?>
									<!--
									<a href="#" title="Chrysanthemum"><img src="data2/tooltips/1.jpg" alt="Chrysanthemum"/>1</a>
									<a href="#" title="Desert Oil"><img src="data2/tooltips/desert.jpg" alt="Desert Oil"/>2</a>
									<a href="#" title="Hydrangeas"><img src="data2/tooltips/hydrangeas.jpg" alt="Hydrangeas"/>3</a>
									<a href="#" title="Jellyfish"><img src="data2/tooltips/jellyfish.jpg" alt="Jellyfish"/>4</a>
									<a href="#" title="Penguins"><img src="data2/tooltips/penguins.jpg" alt="Penguins"/>5</a>
									<a href="#" title="Tulips"><img src="data2/tooltips/tulips.jpg" alt="Tulips"/>6</a>
									!-->
								</div>
								
							</div>
							
							<span class="wsl"><a href="http://wowslider.com">Webpage Slideshow</a> by WOWSlider.com v4.7</span>
							<a href="#" class="ws_frame"></a>
							<div class="ws_shadow"></div>
							</div>
							<script type="text/javascript" src="engine2//wowslider.js"></script>
							<script type="text/javascript" src="engine2//script.js"></script>
						<!-- End WOWSlider.com BODY section -->
				
					</div>
					
					<div id="social">
					Social links
					
					</div>

				</div>
				
				<div id="latest-post-container">
				
				
						<?php echo $content; ?>
<!--
						<div class="last-cat-post">
							
							<a href="#" title="Click to read">
							<span class="post-title" title="Part of post title"><span class="post-cat-title">Politics:</span> Part of po...</span>
							This a small part of the  post, click on the container to see the full post...
							</a>
							
						</div>
						
						<div class="last-cat-post">
							
							<a href="#" title="Click to read">
							<span class="post-title" title="Part of post title"><span class="post-cat-title">News:</span> Part of po...</span>
							This a small part of the  post, click on the container to see the full post...
							</a>
							
						</div>
						
						<div class="last-cat-post">
							
							<a href="#" title="Click to read">
							<span class="post-title" title="Part of post title"><span class="post-cat-title">Sports:</span> Part of po...</span>
							This a small part of the  post, click on the container to see the full post...
							</a>
							
						</div>
					
					
					
					
					
						<div class="last-cat-post">
							
							<a href="#" title="Click to read">
							<span class="post-title" title="Part of post title"><span class="post-cat-title">Entertainment:</span> Part of po...</span>
							This a small part of the  post, click on the container to see the full post...
							</a>
							
						</div>
						
						<div class="last-cat-post">
							
							<a href="#" title="Click to read">
							<span class="post-title" title="Part of post title"><span class="post-cat-title">Education:</span> Part of po...</span>
							This a small part of the  post, click on the container to see the full post...
							</a>
							
						</div>
						
						<div class="last-cat-post">
							
							<a href="#" title="Click to read">
							<span class="post-title" title="Part of post title"><span class="post-cat-title">Trending:</span> Part of po...</span>
							This a small part of the  post, click on the container to see the full post...
							</a>
							
						</div>
!-->
					

				</div>
				
			</div>
			
		</div>	

	
	<?php include 'footer.php'; ?>
	
</div>

</body>


</html>