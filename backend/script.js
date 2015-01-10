function postComment(post_id, post_cat){
	this.ajaxObj = ajaxObj;
	var comBox = document.forms[0];
	name = comBox.name.value;
	email = comBox.email.value;
	comment = comBox.comment.value;
	stripSpaces = /\s/;//work on this later
	queryString = "name="+name+"&email="+email+"&comment="+comment+"&cat="+post_cat+"&id="+post_id;
	ajaxObj.open("POST","postcomment.php");
	ajaxObj.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	ajaxObj.send(queryString);
	
	ajaxObj.onreadystatechange = function(){
	
		if(ajaxObj.readyState == 4 && ajaxObj.status == 200){		
			loadPost(post_id, post_cat);			
			for(i=0; i<2; i++){
				resetDefault(i);
			}			
		} 
		else {

			}
		}	
	}
	
function loadPost(post_id, post_cat){
	
	this.ajaxObj = ajaxObj;
	var waitBox = document.getElementById("wait-box");
	//waitBox.style.display = 'block';
	ajaxObj.open("GET","commentload.php?cat_name="+post_cat+"&post_id="+post_id);
	ajaxObj.send();
	ajaxObj.onreadystatechange = function (){
	this.waitBox = waitBox;
		if(ajaxObj.readyState == 4 && ajaxObj.status == 200){		
			//waitBox.style.display = "none";
			document.getElementById("posted-comment-container").innerHTML = ajaxObj.responseText;
			$("#posted-comment-container").slideToggle(1000, viewComments(formerText));
		} else {			
			waitBox.innerHTML = "Could not load comments";
			setTimeout(function(){this.waitBox.style.display = "none";},3000);
		}	
	}
}

function ajaxer(page){	
	page = page ? page : "overview";
	this.ajaxObj = ajaxObj;
	ajaxObj.open("GET","backend-admin-display.php?action=" + page + "&r=" + Math.random());
	ajaxObj.send(null);
	ajaxObj.onreadystatechange = function (){
		if(ajaxObj.readyState == 4 && ajaxObj.status == 200){	
			document.getElementById("contents").innerHTML = ajaxObj.responseText;		
		}
	};
}

function init() {
	if(window.location.pathname == "/rustless/backend/") ajaxer("overview");
	with(document){
		getElementById('page-holder').style.display = 'block';
		navLinks = getElementsByClassName("sidebar-link");
		overviewIcons = getElementsByClassName("overview-icons");
	}
	
	for (var i = 0; i<navLinks.length; i++){	
		navLinks[i].addEventListener("click",function(e){			
			var active = document.getElementById("is-active");
			if(active != null) active.id = "";
			e.currentTarget.setAttribute("id", "is-active");			
		},false);
	}
}

function commentBoxDisplay(){
	cContainer = document.getElementById("comment-container");
	cBoxButton = document.getElementById("comment-box-button");	
	if (cContainer.style.display == 'block'){
		cContainer.style.display = 'block';
		cBoxButton.innerHTML = 'Post A Comment';
		}
		 else {
		cContainer.style.display = 'none';	
		cBoxButton.innerHTML = 'Hide Comment Box';
		}
	}
	
function viewComments(formerText){
	vcContainer = document.getElementById("posted-comment-container");
	vcBoxButton = document.getElementById("view-comments-button");
	if (vcContainer.style.display == 'block'){
		vcContainer.style.display = 'block';
		vcBoxButton.innerHTML = formerText;
		}
		 else {
		vcContainer.style.display = 'none';		
		vcBoxButton.innerHTML = 'Hide Comments';
		}
	}

function clearInput( inputValue) {	
	forming = document.forms.item(0);
	defValues	= ['Name', 'Email', " Your Comments here "];
	index = parseInt(inputValue);
	if (forming[index].value == defValues[index]) {
	forming[index].value = ' ';
		} else {}
	}
 
function resetDefault(inputValue2) {	
	forming = document.forms.item(0);
	defValues	= ["Name", "Email", " Your Comments here "];
	index = parseInt(inputValue2);	
	if (forming[index].value == '' || forming[index].value == ' ') {
		forming[index].value = defValues[index];
		}
	}
	
function imgUload(){
	var img_upload = document.getElementById("img-upload");
	var closer_btn = document.getElementById("close-btn");	
	$("#u-load-box").fadeIn(500);
	closer_btn.onclick = function(){$("#u-load-box").fadeOut(500);}
}

$(document).ready(function(){
	formerText = document.getElementById("view-comments-button").innerHTML;	
	$("#comment-box-button").click(function(){
		$("#comment-container").slideToggle(1000, commentBoxDisplay())
		});
		
	$('comment-form').submit(function(){
		alert('here');
		});			
});

	var ajaxObj;
	
	if(window.ActiveXObject){	
		var version = ["MSXML2.XmlHttp.6.0","MSXML2.XmlHttp.3.0","Microsoft.XmlHttp"];		
		try{		
			for(i=0; i<=2; i++){			
				ajaxObj = new ActiveXObject(version[i]);
				if(ajaxObj) break;			
			}		
		} catch(e){}
	} 	
	else {	
		ajaxObj = new XMLHttpRequest;	
	}