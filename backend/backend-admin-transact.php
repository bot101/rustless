<?php
session_start();
require ("Connections/myconn.php");

$page = $_REQUEST["page"] ? $_REQUEST["page"] : "manage-post";//for testing purposes only, change laters

if (((isset($_SESSION["logged"]) && $_SESSION["logged"] == 1) && isset($_SESSION["username"])) || (isset($_COOKIE["username"]) && (isset($_COOKIE["logged"]) && $_COOKIE["logged"] == 1))){
	
		if(isset($_SESSION["username"])){
			$auth_username = $_SESSION["username"];
		} else {
			$auth_username = $_COOKIE["username"];
		}
		
	
		
	switch($page){
		
		case "manage-post":
		
			$data = $_REQUEST["action"];
			
			if(isset($data)){
				$infoArr = explode("_",$data);
				$action = $infoArr[0];
				$category = $infoArr[1];
				$id = $infoArr[2];
			}
			
			switch($action){
				
				case "preview":
					header("location: post.php?category=".$category."$id=".$id);
				break;
				
				case "retract":
				
					$output = "";
					$query_s = "UPDATE ".$category." SET is_published = 0 WHERE id = @".$id." LIMIT 1";
					$query = mysql_query($query_s,$myconn) or die("Not Ok");
					$output .= "<div class=\"CollapsiblePanelContent\" >$post_title<input type=\"checkbox\" name=\"multiact\" /> <button value = \"delete_".$category."_".$id."\" class=\"edit delete\">Delete</button><button value = \"edit_".$category."_".$id."\" class=\"edit\">Edit</button>";
					$output .= "<button value = \"publish_".$category."_".$id."\" class=\"edit\">Publish</button>";
					$output .= "<button value = \"preview_".$category."_".$id."\" class=\"edit\">Preview</button></div>";
					echo $output;
					
				break;
				
				case "publish":
					
					$output = "";
					$query_s = "UPDATE $category SET is_published = 1 WHERE id = @$id LIMIT 1";
					$query = mysql_query($query_s,$myconn) or die("Not Ok");
					$output .= "<div class=\"CollapsiblePanelContent\" >$post_title<input type=\"checkbox\" name=\"multiact\" /> <button value = \"delete_".$category."_".$id."\" class=\"edit delete\">Delete</button><button value = \"edit_".$category."_".$id."\" class=\"edit\">Edit</button>";
					$output .= "<button value = \"retract_".$category."_".$id."\" class=\"edit\">Retract</button>";
					$output .= "<button value = \"preview_".$category."_".$id."\" class=\"edit\">Preview</button></div>";
					echo $output;
					
				break;
				
				case "edit":
					
				break;
				
				case "delete":
					
				break;
				
				case"default":
				
					$cat_id = $_REQUEST["cat-id"];
					$index = isset($_REQUEST["index"]) ? $_REQUEST["index"] : 0;
					//$action = 
					
					$cat_verify_q_s = "SELECT * FROM category_list cl WHERE cl.id = @$cat_id LIMIT 1";
					$cat_verify_q = mysql_query($cat_verify_q_s,$myconn) or die("This category does not exist!!");
					extract(mysql_fetch_array($cat_verify_q));
					
					if(isset($category)){
					$postlist_q_s = "SELECT c.id, c.post_title c.is_published FROM $category c ORDER BY c.post_date DESC LIMIT $index,10";
					$postlist_q = mysql_query($postlist_q_s,$myconn) or die("Could not load posts, please try again");
					while($row = mysql_fetch_assoc($postlist_q)){
						
							extract($row);
							$output .= "<div class=\"CollapsiblePanelContent\" >$post_title<input type=\"checkbox\" name=\"multiact\" /> <button value = \"delete_".$category."_".$id."\" class=\"edit delete\">Delete</button><button value = \"edit_".$category."_".$id."\" class=\"edit\">Edit</button>";
							$output .= $is_published == 1 ? "<button value = \"retract_".$category."_".$id."\" class=\"edit\">Retract</button>" : "<button value = \"publish_".$category."_".$id."\" class=\"edit\">Publish</button>";
							$output .= "<button value = \"preview_".$category."_".$id."\" class=\"edit\">Preview</button></div>";
				
						}//while ends
					}// if(category ends here
					echo $output;
					break;//default break
				}//switch action closes here
		
		break;
		
		case "create-post":
			
			
			
		break;
		
		case "manage-comments":
		
		
		break;
		
		case "manage-category":
		
		
		break;
		
		case "manage-users":
		
		
		break;
		
		case "overview":
		case "default":
		
		
		break;
				
		
	}	//switch page ends here
				
} else {

	//echo html and maybe javascript code for login box here		
	
}
		

?>