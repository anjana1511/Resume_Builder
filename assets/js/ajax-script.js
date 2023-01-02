function onAdd() {
$(document).ready(function(){
    $.ajax({
        type: "GET",
        url: 'function1.php',
        data: "functionName=add",
        success: function(response) {
        	console.log(response);
            //alert(response);
        }
    });
});
}



/*
 $(document).ready(function(){
 	$.ajax({    
        type: "GET",
        url: "function.php",             
          data: "functionName=showData",                  
        success: function(data){                    
            $("#table-container").html(data); 
           
        }
    });
});
/*$(document).on('click','#showData',function(e){
      $.ajax({    
        type: "GET",
        url: "function.php",             
        dataType: "html",                  
        success: function(data){                    
            $("#table-container").html(data); 
           
        }
    });
});  */

/*

function fun_eduinfo() {
      $.ajax({
        type: "GET",
        url: "function.php",
        dataType: "html",
        success: function(data){
            $("#table-container").html(data); 
        }
      });
    }
    
    //Call AJAX:
    $(document).ready(fun_eduinfo);

*/