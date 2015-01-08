<script type="text/javascript">

	var ajaxObj;
	var waitBox = document.getElementById("wait-box");
	
	if(window.ActiveXObject){
	
		var version = ["MSXML2.XmlHttp.6.0","MSXML2.XmlHttp.3.0","Microsoft.XmlHttp"];
		
		try{
		
			for(i=0; i<=2; i++){
			
				ajaxObj = new ActiveXObject(version[i]);
				if(ajaxObj) return;
			
			}
		
		} catch(e){}

	} 
	
	else {
	
		ajaxObj = new XmlHttpRequest;
	
	}
	
function viewPost(post_id, post_cat){

	this.ajaxObj = ajaxObj;
	ajaxObj.open("GET","commentload.php?cat_id="+post_cat+"&post_id="+post_id);
	ajaxObj.send();
	waitBox.style.display = 'block';
	
	ajaxObj.onreadystatechange = function (){
	
		if(ajaxObj.status == 200 && ajaxObj.readyState == 4){
		
			document.getElementById("posted-comment-container").innerHTML = ajaxObj.responseText;
			waitBox.style.display = "none";
		} else {
		
			waitBox.innerHTML = "Could not load comments";
			setTimeout(3000, function(){waitBox.style.display = "none";});
		
		}
	
	}
	


}




</script>