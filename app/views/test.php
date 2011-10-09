<?php

function clean_snmp_array($_arr){
  $_ret=array();
  foreach($_arr as $v){
    $v = explode(":", $v);
    if(count($v)>1){
    	$v = $v[1];
    	array_push($_ret, $v);}
  }
  return $_ret;
}



  if (isset($_GET['address']) ){
    $community = $_GET['community'];
    
    echo "<h1>Details for {$_GET['address']}</h1>";
    $sysDescr = 	clean_snmp_array(snmp2_walk($_GET['address'],"$community","1.3.6.1.2.1.1.1",50000));
    echo $sysDescr[0];
    
    
    echo "<h2>Interfaces</h2>";
    
    $ifDescr = 			clean_snmp_array(snmp2_walk($_GET['address'],"$community","1.3.6.1.2.1.2.2.1.2",50000));
    $ifType = 			clean_snmp_array(snmp2_walk($_GET['address'],"$community","1.3.6.1.2.1.2.2.1.3",50000));
    $ifMtu = 			clean_snmp_array(snmp2_walk($_GET['address'],"$community","1.3.6.1.2.1.2.2.1.4",50000));
    $ifSpeed = 			clean_snmp_array(snmp2_walk($_GET['address'],"$community","1.3.6.1.2.1.2.2.1.5",50000));
    $ifPhysAddress = 	clean_snmp_array(snmp2_walk($_GET['address'],"$community","1.3.6.1.2.1.2.2.1.6",50000));
    
	for($i=0; $i<count($ifDescr); $i++) {
		if($ifType[$i] == 6){
			echo "{$ifDescr[$i]}: <ul>
				<li>Interface Type: {$ifType[$i]}</li>
				<li>Interface MTU: {$ifMtu[$i]}</li>
				<li>Interface Speed: {$ifSpeed[$i]}</li>
				<li>Interface MAC: {$ifPhysAddress[$i]}</li>
				</ul>";
		}
	}
	
	echo "<h2>Routing Table</h2>";
	
	$ipRouteProto = 	clean_snmp_array(snmprealwalk($_GET['address'],"$community","1.3.6.1.2.1.4.21.1.9",50000));
	$ipRouteDest = 		clean_snmp_array(snmprealwalk($_GET['address'],"$community","1.3.6.1.2.1.4.21.1.1",50000));
	$ipRouteMetric1 = 	clean_snmp_array(snmprealwalk($_GET['address'],"$community","1.3.6.1.2.1.4.21.1.3",50000));
	$ipRouteNextHop = 	clean_snmp_array(snmprealwalk($_GET['address'],"$community","1.3.6.1.2.1.4.21.1.7",50000));
	
	echo "<table style='width:50%;margin-left:auto;margin-right:auto;'><tr><td>Protocol</td><td>Route</td><td>Metric</td><td>Next Hop</td></tr>";
	for($i=0; $i<count($ipRouteProto); $i++) {
		echo "<tr>
			<td>{$ipRouteProto[$i]}</td>
			<td>{$ipRouteDest[$i]}</td>
			<td>{$ipRouteMetric1[$i]}</td>
			<td>{$ipRouteNextHop[$i]}</td>
			</tr>";
	}
	echo "</table>";

  }
  
  
 
 
 else{
 	echo "
 	<form method='get'>
 	<input type='text' name='address' /><br/>
 	<input type='text' name='community' />
 	<input type='submit' value='Submit'>
 	</form>
 	";
 }
 
 ?>
 
 
 
