<?php
//this page lists contents of specific categories as determined by category id position($pos)
//!IMPORTANT if $pos == $row_length, no post will be displayed. Note:This has been resolved using a very acheic method. I need to stop using too much fors and ifs.
include 'dba.php';

$_category = $_GET['category'];
if(isset($_GET['pos'])){
$pos = $_GET['pos'];
} else {$pos = 0;}

//returns the length of the category content
$row_length_qString  = "SELECT COUNT(*) FROM ".$_category;
//redirects to homepage if selected table does not exist. Possible security loophole here if user alters link to query an existing non category table

$row_length_qResult = mysql_query($row_length_qString) or die(header("Location:index.php"));
$count = mysql_fetch_array($row_length_qResult);

$row_length = $count[0];
$remainder = $row_length%10;
$more_links = "";
$category_last10 = "";

for ($i=0; $i<=$row_length; $i=$i+10)
	{
	//link group builder for more content
	$more_links .='<a href ="category.php?category='.$_category.'&pos='.$i.'">'.$i.'</a>';
	}

if((isset($_category) and !(is_numeric($pos))))
	{
	//if category is available but no pos
	
	$pos = '0';
	} elseif(!(isset($_category))) {
	//if category is not available, go to homepage
	
	header("Location:index.php");
	} else {
	//if both category and pos are set but pos is greater than the number of posts on the database, 
	//load the last 10 or less posts on the database
	
	if ($pos == $row_length){
		$pos = $row_length - 1;
		}
		
	if (($pos>$row_length) or ($pos<0))$pos = $row_length-$remainder;
	//if both are available, check to see if such category exists on database,if it does, load it
	//else load default category info from database.
	
	}
		switch ($_category)
		{
			//Update this and same on post.php to allow for dynamic addition and removal of categories
			
			case 'testtable': 
			case 'politics' :
			case 'entertainment':
			case 'sports':
			case 'news':
			case 'education':
			case 'trending':
			break;
			
			default:
			header('location: index.php');
			//$_category = 'defaultcategory';
			//$post_id = 1;//change to 2 later if necessary
			break;

		}

	
	$category_connect_qString = "SELECT * FROM ".$_category." ORDER BY id DESC LIMIT ".$pos.", 10";
	
	
$result = mysql_query($category_connect_qString, $dbconnect) or die(header("Location:signup.php"));



while ($row = mysql_fetch_assoc($result))
	{
	
		$id = $row['id'];
		$date = $row['post_date'];
		$post_title = $row['post_title'];
		$post = $row['post'];
		
		$category_last10 .=<<<LAST10
		<div class="category-content">
					<h1 class="content-title">$post_title</h1>
					$post
				
					<a class="category-full-story-link" href="post.php?category=$_category&id=$id">read more...</a>
		</div>
LAST10;
		
	}


?>
<!doctype html>
<html>
<head>

<title>Rustless: <?php echo ucwords($_category); ?></title>

<script type="text/javascript" src="engine2//jquery.js"></script>
<script type="text/javascript" src='script.js'></script>

<style type="text/css">
@import url('style.css');
@import url('categorystyle.css');
</style>

</head>

<body id="<?php echo $_category; ?>">

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
				<a href="category.php?category=<?php echo $_category; ?>"><?php echo ucwords($_category); ?></a>
			</div>
		
			<div id="contents">
				<?php echo $category_last10; ?>

			</div>
			
			<div id="more-links"><?php echo $more_links; ?></div>
			
		</div>
	
	<?php include 'footer.php'; ?>

</div>

</body>


</html>