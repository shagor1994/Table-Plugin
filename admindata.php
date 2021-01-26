<?php

$servername=$_POST["servername"];
$username=$_POST["username"];
$password=$_POST["password"];
$databasename=$_POST["databasename"];
$datatable=$_POST["datatable"];
// echo $servername;
// echo $username;
// echo $password;
//echo $datatable;
// echo $databasename;

$con=mysqli_connect($servername,$username,$password,$databasename);
if (!$con) {
	// die("Connection failed: " .  mysqli_connect_error());
	$output='<div class="card" style="width: 18rem;">
	<div class="card-header text-danger">
	<h5>Connection not established<h5>

	</div>
	<ul class="list-group list-group-flush">
	<li class="list-group-item" >typed fields value</li>';


	$output.='<li class="list-group-item">'.$databasename.'</li>';
	$output.='<li class="list-group-item">'.$servername.'</li>';
	$output.='<li class="list-group-item">'.$username.'</li>';
	$output.='<li class="list-group-item">'.$password.'</li>';
	$output.='<li class="list-group-item">'.$datatable.'</li>';


	$output.='</ul></div>';




}
else{
//	echo "connected";

$sql = "SHOW COLUMNS FROM ".$datatable."";
$res = $con->query($sql);
//$columns=array();
while($row = $res->fetch_assoc()){
	$columns[] = $row['Field'];
}

// for ($i=0; $i <sizeof($columns) ; $i++) { 
// 	# code...
// 	echo $columns[$i].'<br>';
// };

$output='<div class="card" style="width: 18rem;">
<div class="card-header text-primary">
<h5>Connection established<h5>

</div>
<ul class="list-group list-group-flush">
<li class="list-group-item" >Avaiable columns</li>';

for ($i=0; $i <sizeof($columns) ; $i++) { 
	$output.='<li class="list-group-item">'.$columns[$i].'</li>';
}
$output.='</ul></div>';


}

$a=array(
      array($output),
      $columns
      );
echo json_encode($a);


?>
