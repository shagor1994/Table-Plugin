<!DOCTYPE html>
<html>
<head>
<title></title>

<script type="text/javascript" src="Bootstrap/jquery.js" ></script>
  <link rel="stylesheet" type="text/css" href="Bootstrap/css/bootstrap.min.css">
  <script type="text/javascript" src="Bootstrap/js/bootstrap.min.js"></script>
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

jQuery library
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->

<!-- Popper JS -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script> -->

<!-- Latest compiled JavaScript -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> -->
<style type="text/css">
.info{
	margin:0 auto;
	max-width: 50% ;
}
.show{
	margin:0 auto;
/*	//	margin-left:400px;*/
    max-width: 40%;
}
</style>
</head>
<body>
<div class="info">
<form action="admin.php" method="post" class="form" id="submit_form">
<div class="form-group">
<label for="database_name">Database name</label>
<input type="text" class="form-control" id="database_name" name="databasename" aria-describedby="database_name" placeholder="Enter database name" required="true">

</div> 
<div class="form-group">
<label for="">Servername</label>
<input type="text" class="form-control" id="servername" name="servername" placeholder="Enter servername" required>
</div>
<div class="form-group">
<label for="">Username</label>
<input type="text" class="form-control" id="username"
name="username" placeholder="Enter username ">
</div>
<div class="form-group">
<label for="">Passwoard</label>
<input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
<small id="share" class="form-text text-muted">We'll never share your password with anyone else.</small>
</div>
<div class="form-group">
<label for="">Datatable name</label>
<input type="text" class="form-control" id="datatable"
name="datatable" placeholder="Enter datatable name">
</div>
<input type="button" name="submit" id="submit" class="btn btn-info btn-block" value="Submit" /> 
</form>
<br>



</div>

<div class="showw"></div>
<div class="show"></div>
<div class="box"></div>
<div class="t_style container" style="width: 80%"></div>
<div class="la"></div>
<div id="order"></div>



</body>
</html>



<script>
var keep=[[],[],[],[]];
  function myFunction() {

               	alert("i am called");

 //var data1=$('#submit_form1').serializeArray();
 var data2=$('#submit_form2').serializeArray();
// console.log(data1);
console.log(data2);
 //   console.log(data);
var coffee = document.forms[1];
var data1=   document.forms[2];

// var txt = "";
var i;
alert(coffee.length);
var k=0;
for (i = 0; i < coffee.length; i=i+4) {
    if (coffee[i].checked) {

     //   txt = txt + coffee[i].value + " ";
     //   alert(coffee[i].value);
        keep[0][k]=coffee[i].value;
        keep[1][k]=coffee[i+1].value;
        keep[2][k]=coffee[i+2].value;
        keep[3][k]=coffee[i+3].value;
        k++;
        // alert(coffee[i+1].value);
    }
}
var form_val=[];
for(var j=0;j<data1.length;j++){
	  if(data1[j].checked){
	  	form_val.push(data1[j].value);
	  }
}
//   alert(txt);
console.log(keep);
console.log(form_val);

//document.getElementById("order").value = "You ordered a coffee with: " + txt;
   $.ajax({
       url:"tab_info.php",
       method:"post",
       data:{keep:keep,form_val:form_val,data2:data2},
       dataType:"json",
       success:function(data){

             ///code...

       }


   })

}

$(document).ready(function(){    
	






  $('#submit').click(function(){  




 	var data=$('#submit_form').serialize();
 //	var data1=('#submit_form1').serializeArray();
 //	var data2=$('#submit_form2').serializeArray();
 //console.log(data1);
// console.log(data2);
 //   console.log(data);
     

  //   $(".showw").text(data);  
     $.ajax({  
            url:"admindata.php",  
            method:"POST",  
            data:data,  
            dataType:"JSON",
            success:function(data)  
            {    
           // 	alert(data);
                // $(".show").html(data[0][0]); 
                 
                 var size=data[1].length;
                 //alert(size);
               //  alert(data[1][0]);


                 $(".box").append('<div class="container"><form action=""><table class="table table-bordered"><thead><tr><th scope="col" style="width: 10%">choose</th> <th scope="col" style="width: 20%">datatable name</th><th scope="col" style="width: 30%">display name</th><th scope="col" style="width: 20%">align</th><th scope="col" style="width: 20%">% Width of the column</th></tr></thead><tbody></tbody></table></form></div>');


               for(var i=0;i<size;i++){
                  $("tbody").append('<tr><td><input type="checkbox" name="vehicle" value="'+data[1][i]+'"></td><td>'+data[1][i]+'</td><td> <div class=""><input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter column name" value=""></div></td><td><div class="form-group"><select title="Pick a number" class="selectpicker form-control"><option value="left">left</option><option value="right">right</option><option value="center">center</option><option value="justify">justify</option></select></div></td><td><input type="text" class="form-control" id="exampleInputPassword1" placeholder=" default value is empty" value=""></td></tr>');

               } 
          

            $(".t_style").append('<div class="row"><div class="col col-md-6"><form id="submit_form1"><div class="card"><div class="card-header">Bootstrap Classes to customise table</div><div class="card-body"><div class="row"><div class="col col-md-6"><div class="form-check"><input type="checkbox" class="form-check-input" id="exampleCheck1" value="table-dark"><label class="form-check-label" for="exampleCheck1">.table-dark</label></div><div class="form-check"><input type="checkbox" class="form-check-input" id="exampleCheck1" value="thead-dark"><label class="form-check-label" for="exampleCheck1">.thead-dark</label></div><div class="form-check"><input type="checkbox" class="form-check-input" id="exampleCheck1" value="thead-light"><label class="form-check-label" for="exampleCheck1">.thead-light</label></div><div class="form-check"><input type="checkbox" class="form-check-input" id="exampleCheck1" value="table-striped"><label class="form-check-label" for="exampleCheck1">.table-striped</label></div></div><div class="col col-md-6"><div class="form-check"><input type="checkbox" class="form-check-input" id="exampleCheck1" value="table-bordered"><label class="form-check-label" for="exampleCheck1">.table-bordered</label></div><div class="form-check"><input type="checkbox" class="form-check-input" id="exampleCheck1" value="table-hover"><label class="form-check-label" for="exampleCheck1">.table-hover</label></div><div class="form-check"><input type="checkbox" class="form-check-input" id="exampleCheck1" value="table-sm"><label class="form-check-label" for="exampleCheck1">.table-sm</label></div></div></div></div></div></div></form><div class="col col-md-6"><div class="card"><div class="card-header">Add function to Table</div><div class="card-body"><form id="submit_form2"><div class="form-check"><input type="checkbox" name="sort" class="form-check-input" id="exampleCheck1" value="1"><label class="form-check-label" for="exampleCheck1">Sort columns</label></div><div class="form-group"> <label for="">Datatable name for bootstrap classes</label><input type="text" class="form-control"  name="d_t_b" placeholder="Enter class datatable name" required></div><div class="form-group"><label for="">Datatable name for style property</label><input type="text" class="form-control"  name="d_t_p" placeholder="Enter property datatable name" required> </div><div class="form-group"><label for="">Database name</label><input type="text" class="form-control"  name="d_t_p" placeholder="Enter database name" required> </div></form>  </div></div></div></div>');

             $(".la").append('<input type="button" value="submit" class="btn btn-primary btn-lg btn-block" onclick="myFunction()" >');







               
            }  
       });  
     

              
  });  
});

// $("tbody").append('<tr>')

</script>

