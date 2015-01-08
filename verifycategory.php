<?php
require "dba.php";

function verifyCategory($cat_name){
	$cat_select_qString = "SELECT category FROM category_list";
	$cat_select_qResult = mysql_query($cat_select_qString);
	$array_list;

	while ($cat_row = mysql_fetch_array($cat_select_qResult)){
			$array_list .= $cat_row["category"]." ";
		}

	$cat_array = explode(" ",$array_list);

	if (in_array($cat_name, $cat_array)){

		echo "Yeah";

		}
}

verifyCategory("defaultcategory");	
?>