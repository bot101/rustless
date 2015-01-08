<!DOCTYPE HTML>

<html>

<head>

<title>Rustless</title>

<style type="text/css">

/* sitewide styles*/


.buttons{

	height:30px;
	width:150px;
	border: 1px solid #ABCBEB;
	border-radius: 2px;
	padding: 5px;
	margin: 5px;

	}

.buttons:hover{

	background: #ABCBEB;
	color: #FFF;
	font-weight: bold;
	}

/* end of sitewide styles*/

/*page holder styles*/

#page-holder{
	max-width: 980px;
	min-width: 800px;
	margin: auto;
	display:  none;
	}

/*end of page holder styles*/

/*header styles*/

#header{
	height:150px;
	width:100%;
	background: #ABCBEB url(yyy.png) no-repeat ;
	background-position: 10px 3px;
	font-family:  Lucida Verdana sans-serif Arial;
	color: #555;
	margin-bottom: 10px;
	}

#header-texts{
	margin-left:200px;
	padding-top: 50px;
	}

#main-header {
	font: 1.6em bold;
	display: block;	
	}
/*end of header styles*/

/*left-sidebar styles*/


#left-sidebar{

	width: 200px;
	background: #ABCBEB;	
	float:left;
	margin-right: 10px;
	font-variant: small-caps;
	height:500px;	
	}

#left-sidebar-links{
	list-style-type:none;
	padding: 20px 0 0 0;
	width:200px;
	float:left;
	}

#left-sidebar-links .sidebar-link{
	;
	}

.sidebar-link a{
	text-decoration:none;
	float:right;
	font: .5em;
	display: block;
	padding: 0 25% 0 25%;
	width:100px;
	margin:5px 0;
	color:#444;
	}

.sidebar-link a:hover{
	background-image: url(here2.jpg);
	background-repeat:no-repeat;
	background-position: 100% 100%;
	border: #666666;	
	border-bottom: 2px solid;
	}

/*end of left sidebar styles*/

/*right float*/

#right-float{
	width: auto;
	}
/* right sidebar */

#right-sidebar{
	
	box-shadow: 3px 3px #ABC;
	float:right;
	width:200px;
	margin: 0 3px 50px 5px;
	border-left:1px #ABC solid;
	overflow: hidden;
	
	}

#top-posts{


	font: bolder 1.2em;
	font-variant: small-caps;
	padding-left: 3px;	
	}

.post-topic-title{

	font-variant: capitalize;
	background: #ABCBEB;
	display: block;
	color: #000;
	padding-left:3px;
	
	}

.post-topic-partcontent{

	padding: 2px 0 5px 3px;

	}
/* end of right sidebar */

#contents{

	font: Cambria;
	margin-right:5px;
	overflow: hidden;
	}


.content-header-container{

	font-variant: small-caps !important;
	border-bottom: 2px solid #ABCBEB;
	width: auto;
	margin-bottom: 10px;
	}


.content-title{

	font-variant: small-caps !important;
	font: 1.2em bold;
	width: 50%;

	}

.content-posted-date{

	display:inline-block;
	font: .6em;
	width: 30%;

	}

#comment-container{

	margin: 50px 0 0 0;	
	display:none;
	clear:both;
	border-bottom:1px solid #ABCBEB;
	}

#comment-container input{

	height:30px;
	width:150px;
	border: 1px solid #ABCBEB;
	border-radius: 2px;
	padding: 5px;
	margin: 5px;

	}


#comment-container textarea{

	height:150px;
	width: 90%;
	border: 1px solid #ABCBEB;
	border-radius: 2px;
	padding: 5px;
	margin: 0 5px;

	}

#related-posts-container{

	margin-top: 10px;

	}

.related-post{

	margin: auto;
	width: 45%;
	padding: 5px;
	float: left;

	}

/*end of right float */

/* footer styles */

#footer{

	clear:both;
	margin: 20px 0 0 0;
	width: 100%;
	height: 150px;
	background: #ABCBEB;
	margin-top: 100px;

	}

.footer-links-style{

	width: 20%;
	margin: 20px 0 0 10%;
	float: left;
	
	}

.footer-links-style a{

	display: block;
	text-align:center;
	text-decoration: none;
	font-family:cambria;
	font-size: .8em;
	font-weight:bold;
	color: #444;
	font-variant:small-caps;
	padding: 0 0 10px 0;
	}
	
#footer #copyright{

	display: block;
	text-align:center;
	font-size:.6em;
	clear: both;
	margin-top: 20px;

	}
	
/*end of footer styles */

</style>


<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
 
function displayFn() {

	document.getElementById('page-holder').style.display = 'block';

	}

function commentBoxDisplay(){

	cContainer = document.getElementById("comment-container");
	cBoxButton = document.getElementById("comment-box-button");	

	if (cContainer.style.display == 'block'){
		cContainer.style.display = 'none';
		cBoxButton.innerHTML = 'Hide Comment Box';
		}
		 else {
		cContainer.style.display = 'block';
		cBoxButton.innerHTML = 'Post A Comment';
		}

	}

function clearInput( inputValue) {
	
	forming = document.forms.item(0);
	defValues	= ['Name', 'Email', " Your Comments here "];
	index = parseInt(inputValue);

	if (forming[index].value == defValues[index]) {
	forming[index].value = ' ';
		} else {
		
		}

	}

function resetDefault(inputValue2) {
	
	forming = document.forms.item(0);
	defValues	= ["Name", "Email", " Your Comments here "];
	index = parseInt(inputValue2);
	
	if (forming[index].value == '' || forming[index].value == ' ') {

		forming[index].value = defValues[index];

		}

	}

$(document).ready(function(){

	$("#comment-box-button").click(function(){
		$("#comment-container").slideToggle(1000, commentBoxDisplay())
		});

	$('[submit]').click(function(){
		$("#comment-container").fadeOut('slow')
		});
});
</script>


</head>

<body id="home" onload = 'displayFn()'>
<div id="page-holder" >

	<div id="header">
		<div id="header-texts">
			<span id="main-header">How Rustless Are You?</span><span id="sub-header">...helping you stay RUSTLESS!!</span>
		</div>
	</div>
	<div id="left-sidebar">

		<ul id="left-sidebar-links">
	
			<li class="sidebar-link" id="homeLink"><a href="home.htm">Home</a></li>
			<li class="sidebar-link" id="topLink"><a href="topstories.htm">Top Stories</a></li>
			<li class="sidebar-link" id="trendLink"><a href="trending.htm">Trending</a></li>
			<li class="sidebar-link" id="politicsLink"><a href="politics.htm">Politics</a></li>
			<li class="sidebar-link" id="entertainLink"><a href="entertainment.htm">Entertainment</a></li>
			<li class="sidebar-link" id="eduLink"><a href="education.htm">Education</a></li>
			<li class="sidebar-link" id="sportsLink"><a href="sports.htm">Sports</a></li>

		</ul>


	</div>
	<div id="right-float">
	
		<div id="right-sidebar">
			<span id="top-posts">Top Posts</span>
			<div class="post-snippet-main-container">

				<span class="post-topic-title">New Post Snippet Here!</span>
				<div class="post-topic-partcontent">
				This container holds part of a top post's content, click on the container to continue reading. . .
				</div>
			</div>

			<div class="post-snippet-main-container">

				<span class="post-topic-title">New Post Snippet Here!</span>
				<div class="post-topic-partcontent">
				This container holds part of a top post's content, click on the container to continue reading. . .
				</div>
			</div>

			<div class="post-snippet-main-container">

				<span class="post-topic-title">New Post Snippet Here!</span>
				<div class="post-topic-partcontent">
				This container holds part of a top post's content, click on the container to continue reading. . .
				</div>
			</div>

			<div class="post-snippet-main-container">

				<span class="post-topic-title">New Post Snippet Here!</span>
				<div class="post-topic-partcontent">
				This container holds part of a top post's content, click on the container to continue reading. . .
				</div>
			</div>

			<div class="post-snippet-main-container">

				<span class="post-topic-title">New Post Snippet Here!</span>
				<div class="post-topic-partcontent">
				This container holds part of a top post's content, click on the container to continue reading. . .
				</div>
			</div>

		</div>

		
		<div id="contents">
			
			<div class="content-header-container">
				<span class="content-title">A Complete Post's Title, Read And Enjoy</span>
				<br />
				<span class="content-posted-date">dd-mm-yyyy hh:mm</span>
			</div>
			
			<div class="post-content">

			Here's the competely complete post, the top stories link in the right sidebar displays the full story with its title in the title box here.
			Almost all page content is loaded with php effectively making this a blog-like CMS website. Every other thing on this page goes thus... blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah  blah blah .
			Thank you very much for reading, please come back later. Bye!!
			</div>

			<div style="margin: 30px 20px 0 0; margin-left: 20%;" id="view-comments-container">
			
			<button  class='buttons' id="comment-box-button" onclick="commentBoxDisplay()"> Post A Comment </button>
			<button  class='buttons' id="view-comments-button" onclick="viewCommentDisplay()"> View Comments </button>

			</div>


			<div id="related-posts-container">

				<div class="related-post">

					<span class="post-topic-title">A related post</span>
					<div class="post-topic-partcontent">
						This container holds part of a related post's content, click on the container to continue reading. . .
					</div>
				
				</div>

				<div class="related-post">

					<span class="post-topic-title">Another related post</span>
					<div class="post-topic-partcontent">
						This container holds part of a related post's content, click on the container to continue reading. . .
					</div>
				
				</div>

			</div>



			<div id="comment-container">

				<form action="" method='post' name='comment-box'>
  
 					Name <input type='text' name='commenter-name' id='name' value='Name' onblur = 'resetDefault("0")' onfocus = 'clearInput("0")' />
 					<span style='display: inline-block;'>Email <input type='email' id='email' name='commenter-email' value='Email' onblur = 'resetDefault("1")' onfocus = 'clearInput("1")'/></span>
					<br />
					<textarea name='comment' onblur = 'resetDefault(2)' onfocus = 'clearInput("2")'> Your Comments here </textarea>
					<br />
					<span style="margin: 30px 20px 0 0; margin-left: 20%; display:block;"><input class='buttons' type='button' name='submit' value='Comment' /> <input class='buttons' type='reset' value='Clear Form' /></span>
	
				</form>			

			</div>

		</div>

	</div>
	
	<div id="footer">
	
		<div class="footer-links-style" id="footer-links-left">
			<a href="#">Home</a> <a href="#">Sports</a> <a href="#">Politics</a>
		</div>

		<div  class="footer-links-style" id="footer-links-center">
			<a href="#">Top Stories</a> <a href="#">Entertainment</a> <a href="#">Education</a>
		</div>

		<div class="footer-links-style" id="footer-links-right">
			<a href="#">Trending</a> <a href="#">Contact Us</a> <a href="#">Feeds</a>
		</div>
		<span id="copyright">AlphaDev Copyright &copy; 2014</span>

	</div>
</div>

</body>


</html>