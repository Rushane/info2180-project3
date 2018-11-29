let httpRequest = new XMLHttpRequest();
    
    httpRequest.onreadystatechange= function(){
        if(this.readyState==4 && this.status==200){
            document.getElementById("result").innerHTML=this.responseText;
            //handleResponse(this.responseText);
            
        }
    };


/*function update() {
  $.get("response.php", function(data) {
    $("#some_div").html(data);
    window.setTimeout(update, 10000);
  });
}  */  
    