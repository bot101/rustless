<?php
session_start();
require ("dba.php");
$_SESSION["logged"] = 1;
$script_start = "<script type=\"text/javascript\">";
$script_end = "</script>";
$action = $_REQUEST['action'];

if(isset($_SESSION["logged"]) || isset($_COOKIE["logged"])){

	if($_SESSION["logged"] == 1 || $_COOKIE["logged"] == 1){
		
		switch($action){
			
			case "manage-post":
		
				$output = "";
				$tab_index =  0;
				
				$cat_verify_q_s = "SELECT * FROM category_list cl";
				$cat_verify_q = mysql_query($cat_verify_q_s,$dbconnect) or die("Error fetching categories, try again!!");
				
				while($row = mysql_fetch_array($cat_verify_q)){
					
					$output .= "<div id=\"CollapsiblePanel1\" class=\"CollapsiblePanel\">";
					$output .= "<div class=\"CollapsiblePanelTab\" tabindex=\"".$tab_index."\">".$row['category_name']." <input type=\"checkbox\" name=\"multiact\" /></div>";
					$output .= "<div class=\"list-of-posts\"><div class=\"CollapsiblePanelContent\" >Here is a post things yo got me haha! <input type=\"checkbox\" name=\"multiact\" /> <button class=\"edit delete\">Delete</button><button value=\"edit_trending_1\" class=\"edit\">Edit</button><button value=\"publish_trending_1\" class=\"edit\">Publish</button><button class=\"edit\">Retract</button><button class=\"edit\">Preview</button></div></div></div>";
					$tab_index++;
					
				}
$script =<<<SCRIPT
				

		actionButtons = document.getElementsByClassName("edit");
	
	function actionCaller(j){
			valueValue = j.target.value;
			values = valueValue.split("_");
			if (values[0] == "edit"){
				
				(function(){
					
					this.ajaxObj = ajaxObj;
					ajaxObj.open("GET","backend-admin-transact.php?category="+values[1]+"&id="+values[2]);
					ajaxObj.send(null);
					
					if(ajaxObj.readystate == 4 && ajaxObj.status == 200){
					
						document.getElementById("contents").innerHTML = ajaxObj.responseText;
							
						
					}
					
				});
			}
	
	for(k=0;k<actionButtons.length; k++){
		actionButtons[k].addEventListener("click", actionCaller(j));
					
				
			} 
	}
	
	panelTab = document.getElementsByClassName("CollapsiblePanelTab");
	
	for (i=0;i<panelTab.length; i++){
		
		panelTab[i].addEventListener("click",  function(e){
			
			categoryHeader = e.currentTarget;
			postContainer = e.currentTarget.nextElementSibling;
			$(postContainer).slideToggle(1000, function (){
	
				var hideIcon = categoryHeader.style.backgroundPosition;
				if (hideIcon == "98% -40px"){
					 hideIcon = "98% 10px"; //tab open
				} else {
					hideIcon = "98% -40px"; //tab close
					infoBox = document.getElementById("info");
					if(infoBox) infoBox.parentNode.removeChild(infoBox);
				}
				categoryHeader.style.backgroundPosition = hideIcon;
				});
			
			});
	}
	
	contentTab = document.getElementsByClassName("CollapsiblePanelContent");
	
	for (i=0;i<contentTab.length; i++){
		
	contentTab[i].addEventListener("click",  function(f){
			
			//alert(f.clientX);
			if(f.className == "edit")f.cancelBubble = true; actionCaller(f);
			
			infoDivPosX = (f.clientX-100) + "px";
			infoDivPosY = (f.clientY-50) + "px";
			if(document.getElementById("info")){
				infoDivStyle.top = infoDivPosY;
				infoDivStyle.left = infoDivPosX;	
			} else {
			
			infoDiv = document.createElement("div");
			infoDiv.id = "info";
			infoDivStyle = infoDiv.style;
			infoDivStyle.width = "200px";
			infoDivStyle.height = "100px";
			infoDivStyle.display = "block";
			infoDivStyle.zIndex = "2000";
			infoDivStyle.border = "solid 2px";
			infoDivStyle.backgroundColor = "blue";
			infoDivStyle.position = "fixed";
			infoDivStyle.top = infoDivPosY;
			infoDivStyle.left = infoDivPosX;
			this.appendChild(infoDiv);
			}
			document.getElementById("info").onmousemove = function(g){
		 
				divToStyle = g.currentTarget.style;
				divToStyle.top = (g.clientY-50) + "px";
				divToStyle.left = (g.clientX-100) + "px";
				}
		  document.getElementById("info").onmouseout = function(h){
			h.currentTarget.parentNode.removeChild(h.currentElement);
		  }
		});
	}

				
SCRIPT;
				$output .= $script_start;
				$output .= $script;
				$output .= $script_end;
				$content = $output;
				
				echo $content;
				
				break;
			
			case "create-post":
				$cat_verify_q_s = "SELECT id,category FROM category_list";
				$cat_verify_q = mysql_query($cat_verify_q_s,$dbconnect) or "No List";
				$opt_text = "";
				
				if(is_resource($cat_verify_q)){
					
						while($opt = mysql_fetch_array($cat_verify_q)){
							
							$opt_text .= "<option value=\"".$opt[0]."\">".$opt[1]."</option>";
							
						}
					
				}
$content =<<<CONTENT
			
			        <form name="form1" id="form1" method="post" action="">
        <label for="post-title">
        <p id="post-header">Post Title</p>
        </label>
        <input type="text" name="post-title" id="post-title" />
        <div id="post-menu-bar">
          <input type="button" name="img-upload" id="img-upload" value="" onclick = "imgUload()"/>
          <input type="button" name="is-top-post" id="is-top-post" value="" />
          <label for="cat-select">Category: </label>
          <select name="cat-select" id="cat-select">
            $opt_text
          </select>
          <input type="button" name="publish" id="publish" value="Publish" />
        </div>
        <textarea contenteditable="true" name="post-content" id="post-content"> </textarea>
        <!-- TemplateEndEditable -->
        <p>
          <label for="tags">Tags:</label>
          <input type="text" name="tags" id="tags" />
          <span id="tag-hint">separate each tag with a comma(,)</span> </p>
        </form>
      </div><div id="u-load-box">
    <div id="u-load-form-box" > <img src="images/img-close-btn.png" id="close-btn" />
      <p id="u-load-heading" >Image Uploader</p>
      <form name="u-load-form" enctype="multipart/form-data" id="u-load-form">
        <table>
          <tr>
            <td>Choose an image:</td>
            <td><input name="img" id="img" type="file" />
              <p style="font-size: .5em">supported formats:jpg,gif,png</p></td>
          </tr>
          <tr>
            <td>Image Name:</td>
            <td><input type="text" name="img-name" id="img-name" /></td>
          </tr>
          <tr>
            <td>Alternative text:</td>
            <td><input type="text" name="alt-text" id="alt-text" /></td>
          </tr>
          <tr>
            <td>Align:</td>
            <td><select name="align" id="align">
                <option selected value="left">Left</option>
                <option value="center">Center</option>
                <option value="right">Right</option>
              </select></td>
          </tr>
          <tr>
            <td>Featured?</td>
            <td>Yes
              <input type="radio" name="featured" id="featured-y" />
              &nbsp;&nbsp;&nbsp;No
              <input type="radio" name="featured" id="featured-n" checked /></td>
          </tr>
        </table>
        <input style="margin:auto; display:block; -moz-box-align:center; -moz-box-pack: center; -ms-box-align:center; -ms-box-pack: center; -o-box-align:center; -o-box-pack: center; -webkit-box-align:center; -webkit-box-pack: center; box-align:center; box-pack: center;" type="button" value="Upload" />
      </form>
    </div>
  </div>
  
CONTENT;
				echo $content;
				
			break;
		
			case "manage-comments":
			
			$comment_q_s = "SELECT * FROM comments, category_list WHERE comment_cat_id = category_list.id LIMIT 15";
			$comment_q = mysql_query($comment_q_s,$dbconnect) or "Could not load comments";
			$output = "";
			$post_row = array();
			if(is_resource($comment_q)){
			while($com_row = mysql_fetch_assoc($comment_q)){
				$post_load_q_s = "SELECT post_title FROM " . $com_row['category'] . " WHERE id = " . $com_row['comment_post_id'];
				$post_load_q = mysql_query($post_load_q_s,$dbconnect) or die("Error");
				$row1 = mysql_fetch_row($post_load_q);
				array_push($post_row, $row1[0]);
			}
			
			for($i=0; $i < mysql_num_rows($comment_q); $i++){
				$com_row1 = mysql_fetch_assoc($comment_q);print_r(mysql_fetch_assoc($comment_q));//error probably here
				$output .= " <tr><td>".$com_row1['comment']."</td><td>".$post_row[$i]."</td><td>".$com_row1['category_name']."</td><td><button class=\"delete edit\">Delete</button><button class=\"edit\">Edit</button></td></tr>";
				
			}
			
			} else { echo "Error";}
			$t_head = "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" id=\"commlist\">";
			
$t_foot =<<<TFOOT
</table>
 <div onclick="javascript: this.style.display = 'none'"; id="commentEditor" style="position:fixed; top: 50%; left:0; z-index:2000; width:100%; background: url(images/gradient-black.png); height:50%; display:none;">
 <div style="width:500px; position:relative; margin:30px auto; background:#FFF; height:80%; padding:3%;">
 	<textarea style="float:left; width:250px; height:200px; margin:1%; overflow:auto;"></textarea>
 	<div >
 	  <p>Posted by: alpha</p>
 	  <p>On: 25/5/014</p>
 	  <p>In: Trending&gt;This is a post Title... 	</p>
 	</div>
 </div>
 </div>
 
 $script_start
 function showEditor(j){
	 //displays the comment editor if not already displayed and loads the comments from the server
	 // loading comments will be handled when serverside is programmed
	 var commEdit = j.currentTarget;
	 var commEditor = document.getElementById("commentEditor");
 if (!(commEditor.style.display == "block")) $("#commentEditor").fadeIn(1000);	 
 }
 
 var TRs = document.getElementsByTagName("tr");
 
 for(i = 1; i < TRs.length; i++){
	 
	 TRs[i].addEventListener("click", function(h){
	//sets background of selected comment
	 if (!(h.currentTarget.id == "selected-tr")){
		 var TRWithId = document.getElementById("selected-tr");
		if (TRWithId) TRWithId.removeAttribute("id");
		 h.currentTarget.setAttribute("id","selected-tr");
	 } else {
		
		h.currentTarget.setAttribute("id","selected-tr");
	 }
	 });
	
	TRs[i].addEventListener("click", function(j){showEditor(j)}) 
	 
 }
 $script_end

TFOOT;
			$content = $t_head ." ". $output ." ". $t_foot;
			echo $content;
			
			break;
			
			case "manage-category":
			$output = "";
			
$table_head =<<<TABLEHEAD

<div style="float:left;">      
<table id="catlist" border="0" cellspacing="0" cellpadding="0">
<thead>
<tr>
<th>
Category Name
</th>
<th>
Actions
</th>
</tr>
</thead>
<tbody>

TABLEHEAD;
$table_foot =<<<TABLEFOOT

</tbody>
</table>
</div>
<div id="options"><div id="option-head">Options</div><form action="" method="get" name="catcreate" id="catcreate">Create New Category<input type="text" name="newCatName" class="inputBox"/><p><input type="button" value="Create Category" class="buttons"/></p></form></div>

TABLEFOOT;
			$tab_index =  0;
				
				$cat_verify_q_s = "SELECT * FROM category_list cl";
				$cat_verify_q = mysql_query($cat_verify_q_s,$dbconnect) or die("Error fetching categories, try again!!");
				
				while($row = mysql_fetch_array($cat_verify_q)){
					
					$output .= "<tr><td>".$row['category_name']."</td>";
					$output .= "<td><button value=\"".$row['category_name']."\" class=\"edit delete\">Delete</button><button class=\"edit\">Hide</button><button class=\"edit\">Rename</button>";
					$output .= "</td></tr>";

					$tab_index++;
					
				}
			$content = $output;
			
			echo $table_head;
			echo $content;
			echo $table_foot;
			
			break;
			
			case "manage-users":
			
$lookup =<<<LOOKUP
      <div id="lookup-container">
        <label for="lookup-type">Look Up User By: </label>
        <select name="lookup-type" id="lookup-type">
        	<option selected="selected" value="username">Username</option>
            <option value="email">Email</option>
            <option value="phone">Phone Number</option>
            <option value="name">Full Name</option>
        </select>
        <input type="text" id="search-term" name="search-term" />
        <input name="look-up" id="look-up" type="button" value="Look Up" />
        
      </div>
LOOKUP;
			
			$content = $lookup;
			echo $content;
				
			break;
			
			case "overview":
			case "default":
			
$overview =<<<OVERVIEW

<div class="overview-icons" onclick="javascript:ajaxer('create-post')"><div id="post"></div><span class="menu-text">Create Post</span></div>
<div class="overview-icons" onclick="javascript:ajaxer('manage-post')"><div id="edit"></div><span class="menu-text">Manage Posts</span></div>
<div class="overview-icons" onclick="javascript:ajaxer('manage-comments')"><div id="comment"></div><span class="menu-text">Manage Comments</span></div>
<div class="overview-icons" onclick="javascript:ajaxer('manage-category')"><div id="category"></div><span class="menu-text">Manage Categories</span></div>
<div class="overview-icons" onclick="javascript:ajaxer('manage-users')"><div id="users"></div><span class="menu-text">Manage Users</span></div>

OVERVIEW;
			
			$content = $overview;
			
			echo $content;
			
			break;
		}
	
} else {	
		$login = "<div id=\"overlay\">Please Login to continue </div>";
		$content = $login;
		
		echo $content;
	}
} else {
	
	$login = "<div id=\"overlay\">Please Login to continue </div>";
		$content = $login;
		
		echo $content;
		
}
?>
