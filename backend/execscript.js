// JavaScript Document
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
