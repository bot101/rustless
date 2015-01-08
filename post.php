<?php
include 'dba.php';
require_once("logcop.php");
$post_category = trim($_GET['category']);
$_post_id = trim($_GET['id']);

function verifyCategory($cat_name){
	$cat_select_qString = "SELECT category FROM category_list";
	$cat_select_qResult = mysql_query($cat_select_qString);
	$array_list = "";

	while ($cat_row = mysql_fetch_array($cat_select_qResult)){
			$array_list .= $cat_row["category"]." ";
		}

	$cat_array = explode(" ",$array_list);

	if (in_array($cat_name, $cat_array) == 1){
		return true;
	} else {
		return false;
	}
}

if ((isset($post_category) and !(is_numeric($_post_id))))
	{
		if (isset($post_category)){		
			$url = "Location:category.php?category=".$post_category;
			header($url);		
		} 
		
	} else if(empty($post_category)) {
		header("Location:index.php");
	}

if(verifyCategory($post_category)){
	} else {	
		$post_category = 'defaultcategory';
		$_post_id = 1;	
	}

$post_query = "SELECT * FROM ".$post_category." WHERE id =".$_post_id;
$query = mysql_query($post_query, $dbconnect) or die(mysql_error());
if(empty($query)){
		echo 'Empty';
	} else {
		$row = mysql_fetch_assoc($query);

		$_post_id = $row['id'];
		$post_title = $row['post_title'];
		$post = $row['post'];
		$post_date = $row['post_date'];
		$comment_count = $row['comment_count'];
		$post_tag = $row['tags'];
	}

?>
<!DOCTYPE HTML>
<html>

<head>

<title>Rustless: <?php echo $post_title; ?></title>

<script type="text/javascript" src="engine2//jquery.js"></script>
<script type="text/javascript" src='script.js'></script>
<script type="text/javascript">

	var commForm = document.forms[0];
	
	commForm.name.onblur = function(e){
	
		this.ajaxObj = ajaxObj;
		ajaxObj.open("GET", "verifyname.php?name="+commForm.value);
		ajaxObj.send(null);
		if(ajaxObj.readyState == 4 && ajaxObj.status == 200){
		
			document.getElementById("isvalidname").innerHTML = ajaxObj.responseText;
		
		}
	
	}
	
</script>

<link rel="stylesheet" href="style.css" />
<link rel="stylesheet" href="poststyle.css" />

</head>

<body id="<?php echo $post_category; ?>">
<div id="page-holder" >

	<?php include 'header.php'; ?>
	
	<?php include 'leftsidebar.php'; ?>
	
	
		<div id="right-sidebar">
			<span id="top-posts">Top Posts</span>
			<?php include 'topposts.php'; ?>
		</div>

		<div id="main-contents">
		
			<div id="crumbs-container">
				<a href="index.php">Home</a>
				<a href="category.php?category=<?php echo $post_category; ?>"><?php echo ucwords($post_category); ?></a>
				<a href="post.php?category=<?php echo $post_category; ?>&id=<?php echo $_post_id; ?>"><?php echo ucwords($post_title); ?></a>
			</div>
			
			<div id="contents">
				
				<div class="content-header-container">
					<span class="content-title"><?php echo $post_title; ?></span>
					<br />
					<span class="content-posted-date"><?php echo $post_date; ?></span>
				</div>
				
				<div class="post-content">
				<?php echo $post; ?>
				</div>

				<div style="margin: 30px 20px 0 0; margin-left: 20%;" id="view-comments-container">
				
				<span  class='buttons' id="comment-box-button" > Post A Comment </span>
				<span  class='buttons' id="view-comments-button" onclick="loadPost('<?php echo $_post_id; ?>','<?php echo $post_category; ?>')"> View Comments(<?php echo $comment_count; ?>) </span>

				</div>
				
				<div id="wait-box" style="display:none; position:fixed; top:200px; margin:auto; width:400px; height:200px; background: #444;">
				
					Please Wait...***
				
				</div>

				<div id="related-posts-container">
					<?php include "relatedpost.php"; ?>
				</div>

				
				<div id="comment-container">

					<form action="" method='post' name='comment-form'>
	  
						Name <input type='text' name='name' id='name' value='Name' onblur = 'resetDefault("0")' onfocus = 'clearInput("0")' /><span id="isvalidname"></span>
 					<span style='display: inline-block;'>Email <input type='email' id='email' name='email' value='Email' onblur = 'resetDefault("1")' onfocus = 'clearInput("1")'/></span>
					<br />
					<textarea name='comment' onblur = 'resetDefault(2)' onfocus = 'clearInput("2")'> Your Comments here </textarea>
					<br />
					<input type="hidden" value='<?php echo $comment_count; ?>' />
					<span style="margin: 30px 20px 0 0; margin-left: 20%; display:block;"><input onclick="postComment('<?php echo $_post_id; ?>','<?php echo $post_category; ?>')" class='buttons' type='button' name='submit' value='Comment' /> <input class='buttons' type='reset' value='Clear Form' /></span>
		
					</form>			

				</div>
				
				
				<div id="posted-comment-container">
				
				</div>
                <div id="login-box-box">
                
                </div>
				
			</div>
		</div>
	
	<?php include 'footer.php'; ?>
</div>

</body>


</html>