<?php

//$con=mysqli_connect('localhost','root','','registration');


?>
<!DOCTYPE html>
<html>
<head>
<title></title>

   

 <style type="text/css">

 </style>
	<script type="text/javascript" src="Bootstrap/jquery.js" ></script>
  <link rel="stylesheet" type="text/css" href="Bootstrap/css/bootstrap.min.css">
  <script type="text/javascript" src="Bootstrap/js/bootstrap.min.js"></script>

  
</head>

<body>
	<!-- <input type="button" name="" value="Add" class="btn btn-primary ADD"> -->

	<?php  
	$con=mysqli_connect('localhost','root','','shagorweb');
	if (!$con) {
	die("Connection failed: " .  mysqli_connect_error());
}
else{
	//echo "es";
}
$row='';
$r='';
$table='';
$col_nam=array();

  $query='SELECT * FROM property';
  $query1='SELECT * FROM classes';
  $query2='SELECT * FROM add_information';
  $query_sort='SELECT value FROM sort ORDER BY value DESC ';
   $res=mysqli_query($con,$query);
   $res1=mysqli_query($con,$query1);
   $res3=mysqli_query($con,$query1);
   $res4=mysqli_query($con,$query2);
 
   $res_sort=mysqli_query($con,$query_sort) or die(mysqli_error());
   $sort='';
   $value='';
while($sort=mysqli_fetch_array($res_sort)){
	 // echo $sort['value'];
	  $value=$sort['value'];
	  break;
}
      

     
     $output='<div class="container" style="width:80%"><table class="table';
     while($r=mysqli_fetch_array($res1)){
  
     	if(($r["class"]!='thead-dark')&&( $r["class"]!="thead-light")){
     		
           $output.=' '.$r["class"];
        //   echo $r["class"];
         //  echo $r["class"].'<br>';
      
       }
     }




      $output.='"><thead class="';
    
           while($rr=mysqli_fetch_array($res3)){
          
     	if($rr["class"]=="thead-dark"||$rr["class"]=="thead-light"){
     		
           $output.=' '.$rr["class"];
         
       }
     } 


////inserting rows////

       $output.= '"><tr>';
 $in=0;
 $col_nam=array();
	    while($row=mysqli_fetch_array($res)){
	     // echo $row['id'];
	     // echo $row['d_name'];
	     // echo $row['dis_name'];
	     // echo $row['align'];
	     // echo $row['width'];
	     // echo "<br>";
	    	$col_nam[$in]=$row["d_name"];
	    	 $output.='<th style="width:'.$row["width"].'%" align="'.$row["align"].'" name="'.$row["d_name"].'">'.$row["dis_name"];
	    	 // $in++;
         if($value==1){
         	$output.='<span style="cursor:pointer" style="display:" class="icon" id="'.$in.'"><img src="https://img.icons8.com/color/20/000000/sort.png"></span></th>';
         }
         else{
         	$output.='</th>';
         }
         $in++;
	}

////
	// for ($i=0; $i <count($col_nam) ; $i++) { 
	// 	# code...
	// 	echo $col_nam[$i];
	// }

	$output.='</tr></thead><tbody>';

     while($table=mysqli_fetch_array($res4)){

           $output.='<tr>';
           for ($i=0; $i <count($col_nam) ; $i++) { 
           	# code...
           
           $output.='<td>'.$table[$col_nam[$i]].'</td>';
            
      }
      $output.='</tr>';


     }








	$output.='</tbody></table></div>';




echo $output;


	?>

   


</body>
<!-- <div class="test"><p>Man tjioad</p></div> -->

<script type="text/javascript">
function sto(){
	console.log('clicked');
 //    $(".adD").click(function(event){ 
	// console.log('clicked');
	/* Act on the event */
  //  var sto=$("submit_form").serializeArray();
   // console.log(sto);
   var coll=[];
   function col_name (num) {
 y=num.length;
 

 for(var i=0;i<y;i++){
 	 console.log(num[i]);
    var aa=num[i].name;
    console.log(aa);

  // num[i]=num[i].innerHTML;
  num[i]=aa;
 }
  // body... 
coll=num;
}
col_name($("th").toArray());
console.log(coll);

    var tem=<?php echo json_encode($col_nam); ?>;
    var store=[];
     var fo=document.forms[0];
     for (var i = 0; i < fo.length-1; i++) {
     	store.push([]);
     	store[i].push(tem[i]);
     	 store[i].push(fo[i].value);
     }
    

   console.log(store);
    $.ajax({
    	url: 'store.php',
    	method:'post',
    	datatype:'json',
    	data:{store:store},
    	success:function(data){
    		alert("Successfully stored");
    	}
 
    

 });
//


}

$(document).ready(function(){
  

var x;
var y;
var col;
//icon();

var j=0;
var toggle=-5;



//store the name fo the colums/.....
function colum (num) {
 y=num.length;
 

 for(var i=0;i<y;i++){
    var aa=num[i].innerHTML.split('<');
  // num[i]=num[i].innerHTML;
  num[i]=aa[0];
 }
  // body... 
col=num;
}
colum($("th").toArray());
console.log(col);

//count the number of element in one colum
function count (num) {
  x=num.length;
  console.log(x);
  console.log(y);
}
count($("tr>td:nth-child(1)").toArray());

//.//////...store function...




/////................add sort icon to array..............

 function icon(){

   $(".icon").click(function(event) {
   	/* Act on the event */
   	var id=this.id;
  // 	alert(id);
   	j=id;
   
      if(toggle==id){
      	//j=id;
     // 	de_sort(arr);
       de_sort(arr);
   	loadin();   
      	toggle=-5;
      	console.log('agin');


      }
      else{
      	sort(arr);
   	    loadin();
          toggle=id;
          console.log('first');
      }
   	   });

 //    $("thead>tr>th").each(function(){
 //   //  this.append('<button type="button"  class="btn btn-default icon" aria-label="Left Align"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span></button>');
 //    //  this.append("<button>button</button>");
 //    this.append(' <button type="button" class="btn btn-default icon btn-sm" aria-label="Left Align" va>sort<span class="glyphicon glyphicon-sort"></span></button>');

 // });

    
   // });
// $("thead>tr>th").append(' <span class="icon"><img src="https://img.icons8.com/color/20/000000/sort.png"></span>');
 $("th").addClass('th');
$(".th").css({"position":"relative"});
$(".icon").css({
	"position": "absolute",
	"right":"5%"
});


 };
 icon();

//creation of 2d array to store values....
var arr=new  Array(y);
for(var i=0;i<y;i++){
  arr[i]=new Array(x);
}



/// load the value of the td tag in the 2d array//.....
function load(compact, track){
  for(var i=0;i<x;i++){
     arr[track][i]=compact[i].innerHTML;
 }
}
for(var i=0;i<y;i++){
pass=i+1;
load($("tr>td:nth-child("+pass+")").toArray(),i);
}


console.log(arr);

sort(arr);
function deleete(){
//y++;


$("thead>tr").append('<th scope="col" class="delete" style="width:10%;">Delete</th>');
 $("tbody>tr").append('<td><button class="btn btn-info">x</button></td>');

 


}
//deleete();


function add(){
//$("table").before('<button type="button" class="btn btn-primary bot">Add</button>');
$("table").before('<br><button class="btn btn-info bott btn-block" data-toggle="modal" data-target="#myModal">Add</button>');
 
    $("table").after('  <div class="modal fade" id="myModal" role="dialog"><div class="modal-dialog"> <div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Edit</h4></div><div class="modal-body"> <form class="form" id="submit_form" method="post"></form></div><div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></div></div></div></div>');
 for(var i=0;i<y;i++){
$(".form").append('<div class="form-group"><label for="'+col[i]+'">'+col[i]+'</label><input type="text" class="form-control" id="'+col[i]+'" name="'+col[i]+'" placeholder="'+col[i]+'"></div>');
}
$(".form").append('<div class="form-group"><input type="button" class="btn btn-block btn-success adD" name="submit"  value="Add" onclick="sto();"></div>');
}
add();
function edit(){
 $("thead>tr").append('<th scope="col" class="delete" style="width:10%;">Add</th>');
 $("tbody>tr").append('<td><button class="btn btn-info" data-toggle="modal" data-target="#myModal">+</button></td>');
 $("table").after('  <div class="modal fade" id="myModal" role="dialog"><div class="modal-dialog"> <div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Edit</h4></div><div class="modal-body"> <form class="form" id="store_form"></form></div><div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></div></div></div></div>');
 for(var i=0;i<y;i++){
$(".form").append('<div class="form-group"><label for="'+col[i]+'">'+col[i]+'</label><input type="text" class="form-control" id="'+col[i]+'" name="'+col[i]+'"placeholder="'+col[i]+'"></div>'); 
}

}
//edit();

function partition(a,start,end){
  var  pivot=a[j][end];



   var  pIndex=start;

  if(isNaN(a[j][end])){
   for(var i=start;i<end;i++){



      if(a[j][i]<=pivot){
    

        for(var l=0;l<y;l++){
          var tem=a[l][i];
        a[l][i]=a[l][pIndex];
        a[l][pIndex]=tem;
        }
      console.log('w1');
      
   
      pIndex++;
      }
  }
}

else{
   for(var i=start;i<end;i++){

 

      if(parseInt(a[j][i])<=parseInt(pivot)){

        var tem=a[j][i];
        a[j][i]=a[j][pIndex];
        a[j][pIndex]=tem;
       console.log('w2');

      
  
      pIndex++;
      }
  }
}

  for(var l=0;l<y;l++){
    var temm=a[l][pIndex];
   a[l][pIndex]=a[l][end];
   a[l][end]=temm;
  }

     return pIndex;
 
}

function quicksort(a,start,end){
var index;
  if(start<end){
index=partition(a,start,end);

  
      quicksort(a, start,index-1);

      quicksort(a, index+1,end);




}
}
/////2nd sort.................
function de_partition(a,start,end){
  var  pivot=a[j][end];



   var  pIndex=start;

  if(isNaN(a[j][end])){
   for(var i=start;i<end;i++){



      if(a[j][i]>=pivot){
    

        for(var l=0;l<y;l++){
          var tem=a[l][i];
        a[l][i]=a[l][pIndex];
        a[l][pIndex]=tem;
        }
      console.log('w1');
      
   
      pIndex++;
      }
  }
}

else{
   for(var i=start;i<end;i++){

 

      if(parseInt(a[j][i])>=parseInt(pivot)){

        var tem=a[j][i];
        a[j][i]=a[j][pIndex];
        a[j][pIndex]=tem;
       console.log('w2');

      
  
      pIndex++;
      }
  }
}

  for(var l=0;l<y;l++){
    var temm=a[l][pIndex];
   a[l][pIndex]=a[l][end];
   a[l][end]=temm;
  }

     return pIndex;
 
}

function de_quicksort(a,start,end){
var index;
  if(start<end){
index=de_partition(a,start,end);

  
      de_quicksort(a, start,index-1);

      de_quicksort(a, index+1,end);

      


}
}
////end of second sort..........


function sort(arr){

 var end=x;
var start=0;
  quicksort(arr, start,end-1);


}
function de_sort(arr){

 var end=x;
var start=0;
  de_quicksort(arr, start,end-1);


}

console.log(arr);
console.log(arr);
console.log(y);

// function reload(){
  

// }



//count($("tr").toArray());

function reload(compact, track){
  for(var i=0;i<x;i++){
   compact[i].innerHTML= arr[track][i];
 }
}
function loadin(){
for(var i=0;i<y;i++){
pass=i+1;
reload($("tr>td:nth-child("+pass+")").toArray(),i);
}
}
loadin();


});

/////...........add data to database through modal............


</script>


</html>

