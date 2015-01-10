ajax = {
  
  ajaxO: null,
  
  constructor : function() {
	  if(window.ActiveXObject){
		  var version = ["MSXML2.XmlHttp.6.0","MSXML2.XmlHttp.3.0","Microsoft.XmlHttp"];
		  try{
			  for(i=0; i<=2; i++){
				  ajaxO : new ActiveXObject(version[i]);
				  if(ajaxO) break;
			  }
		  } catch(e){}
	  } else {
		  ajaxO : new XMLHttpRequest;
	  }	
  },
	  
  send: function(method,action,valueList,requestHeaderName, requestHeaderValue){	
	  if (requestHeaderName === "undefined") requestHeaderName = "Content-type";
	  if (requestHeaderValue === "undefined") requestHeaderValue = "application/x-www-form-urlencoded";
	  this.ajaxO = ajaxO;
	  method = method.toUpperCase();
	  if(method == "POST"){
		  ajaxO.open(method,action);
		  ajaxO.setRequestHeader(requestHeaderName,requestHeaderValue);
		  ajaxO.send(valueList);
		  //ajaxO.onreadystatechange = response(); This might be required as a separate function call.
	  } else if(method == "GET"){
		  ajaxO.open(method,action+"?"+valueList);
		   ajaxO.send();
		   //ajaxO.onreadystatechange = response(); This might be required as a separate function call.
	  }
	  
  },
  
  waitResponse: function(ajaxObj, id, runWaiting){
	  //This function is run when response is received, optionally it will run the waiting function if set to true
	  do{       
			  if(runWaiting == true) waiting(id,"block",0);
			  if(ajaxObj.readyState == 4) runWaiting = false;        
		  } while(runWaiting == true || ajaxObj.readyState < 4)    
		  waiting(id,"none",ajaxObj.status);    
	  },
  
  waiting: function(elementId,display,status){
	  //This function runs while waiting for an ajax request to be completed
	  //elementId is the id of a DOM element that tells the user status of ajax calls
	  if(status == 200 || status == 0){        
			  if(status == 200) document.getElementById(id).style.backgroundColor = "#0C0";
			  window.setTimeout(function(){},1000);
			  document.getElementById(id).style.display = display;        
		  } else {           
			  document.getElementById(id).style.backgroundColor = "#00C";
			  window.setTimeout(function(){},1000);
			  document.getElementById(id).style.display = display;            
			  }   
	  }
}