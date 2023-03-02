		function getId(id){
			return document.getElementById(id);
		}
		function getID(id){
			return document.getElementById(id);
		}
		function  getLoader(l,o=true){
			       if(o){
				   getId(l).style.display="block";
				   }else{
				   getId(l).style.display="none";
				   }
		   }
		   
		   function isJson(str) {
				try {
					JSON.parse(str);
				} catch (e) {
					return false;
				}
				return true;
			}
		
function ajaxRequest(f="",l,s="",r="POST") {
	var formData;
	if(f!=""){formData = new FormData(f);}
    if(s==""){
		s = f;
	}
	getLoader("loaderDiv");
	   var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
	  if(this.readyState===1){
          getID("lajelaLoader1").style.display="block";
          }else if(this.readyState===2){
           getID("lajelaLoader1").style.display="none";
           getID("lajelaLoader2").style.display="block";
          }else if(this.readyState===3){
            getID("lajelaLoader2").style.display="none";
           getID("lajelaLoader3").style.display="block";
          }else{
          getLoader("loaderDiv",false);
          }
	  
	  
    if (this.readyState == 4 && this.status == 200) {
      ajaxRequestResponse(this.responseText.toString().trim(),s,f);
       
	}else if(this.readyState == 4 && this.status != 200){
 swal({
			title : "An Error Occurred",
			text : this.status.toString(),
			icon : "error",
			button: "Okay",
			closeOnEsc: false,
			closeOnClickOutside:false,
		}
		);
	}
  };
  xhttp.open(r, l, true);
  xhttp.send(formData);
  return false;
}



 function ajaxRequestResponse(response,s="",f="") {

	if(!isJson(response)){
		message =  response;
		response = new Object()
		response.message=message;
		response.status="Info";
		response.button="Okay";
		response.close = true;
		response.icon = "info";
	}else{
		response  = JSON.parse(response);
	}
	  if(response.status=="success"){
		  swalTitle = "Success";
	  }else{
		 swalTitle = "Error";
	  }
	  swal({
		  title: response.title,
		  text: response.message,
		  icon: response.icon,
		  button: response.button,
		  closeOnEsc: response.close,
		  closeOnClickOutside:response.close,
		  }).then((value) => {
		    if(response.status=="success"){
				if(response.new == true){
				location.href=response.link;
				}
				if(response.reset==true && f!=""){
					f.reset();
				}
				if(response.scroll==true && s!=""){
					s.scrollIntoView({behavior: "smooth", block: "end", inline: "start"});

				}
			}
		});
	}

		function autoSaveConfiguration(output=false){
			var d = new Date();
			var name = document.getElementById('name').value;
			 var content = CKEDITOR.instances.editor.getData();
			 var formData = new FormData();
		      formData.append("value[]",content);
			  formData.append("name[]",name);		
			  var xhttp = new XMLHttpRequest();
			  xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
				
				  var response = this.responseText.toString().trim(); 
				  	if(output){
						ajaxRequestResponse(response);
					}
				}
			  };
			  xhttp.open("POST", "//gsubz.com/processor/configureprocessing.php?t="+d.getTime(), true);
			  xhttp.send(formData);
			  
			 return false;
		}

function ajaxConfirm(t,l,f="",s="",r="POST",i="",titleText=""){
   if(titleText==""){
     titleText = "Attention";
   }
   if(i==""){
      i = "//gsubz.com/images/icon/surprised.jpg";
   }
	swal({
		text: t,
		title: titleText,
		icon: i,
		closeOnEsc: false,
		closeOnClickOutside:false,
		buttons:{
			true : {
				text : "Okay",
				value : true
			},
			false : {
				text : "cancel",
				value : false
			}
		}
	}).then((value) => {
			 if(value===true) {
				ajaxRequest(f,l,s,r)
			}
	});

}

            function openLink(link, tab=false){
                if(tab===true){
                    window.open(link);
                }else{
                    location.href=link;
                }
            }
            
            
            function  mobileLanguage(){
                $("#mobileLang").addClass("slideInLeft")
                   getID("mobileLang").style.display="block";
                   getId("mobileLang").scrollIntoView({behavior: "smooth", block: "end", inline: "start"});
             }
             function closeMobileLang(){
                     $("#mobileLang").addClass("slideOutLeft")
                    setTimeout(() => {
                      $("#mobileLang").removeClass("slideOutLeft")
                      getID("mobileLang").style.display="none";
                    }, 700);
                    
             }
             function openMobileLang(){
             if(getId("mobileLang").style.display==="block"){
              closeMobileLang();   
             }else{
               mobileLanguage();  
             }
             return false;
             }
            
            
            
       function  mobileSearchDisplay(){
                $("#mobile-search").addClass("slideInRight")
                   getID("mobile-search").style.display="block";
                   getId("mobile-search-input").focus();
             }
             function closeMobileSearch(){
                     $("#mobile-search").addClass("slideOutRight")
                    setTimeout(() => {
                      $("#mobile-search").removeClass("slideOutRight")
                      getID("mobile-search").style.display="none";
                    }, 700);
                    
             }
             
             
              function newsLetter() {
		 document.getElementById("newsLetterResponse").innerHTML = "<strong>Subscribing...</strong>";
		 var d = new Date();
		 formData = new FormData(document.getElementById('newsLetterForm'));   
		  var xhttp = new XMLHttpRequest();
		  xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
			 var response = this.responseText.toString().trim();
                         ajaxRequestResponse(response);
                         document.getElementById("newsLetterResponse").innerHTML ="";
     		}
		  };
		  xhttp.open("POST", "//gsubz.com/newsletterprocessing.php?t="+d.getTime(), true);
		  xhttp.send(formData);
		 return false;
		}
                