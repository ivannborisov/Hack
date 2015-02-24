<?php
$file = fopen('file.csv', 'r');
$csv = array ();
while (($line = fgetcsv($file)) !== FALSE) {
  array_push( $csv ,$line  );
}
fclose($file);

//print_r($csv);
$query = $_POST['query'];
$q_elements = explode(" ", $query);
$q_el_num = count ($q_elements);
echo "RESULT: </br>";
if(strtoupper($q_elements[0]) == "SELECT" ){
	
	
		
		$limit = count($csv)-1;
		
		if(strpos($query,'LIMIT') && $q_elements[$q_el_num-1] < $limit ){
			$limit = $q_elements[$q_el_num-1];	
		}
		$columns_str = "";
		if(strpos($query,'LIMIT')) {
			for($i = 1; $i < $q_el_num -2 ; $i++) {
				$columns_str .= $q_elements[$i];
			}	
		}
		else {
			for($i = 1; $i < $q_el_num  ; $i++) {
				$columns_str .= $q_elements[$i];
			}
		}
		//$text = preg_replace("/\n/",' ~ ',$text);
		$columns_str= str_replace(' ','',$columns_str); 
		//echo "</br>".$columns_str;
		if (strpos($columns_str,',') !== false) {
			$colums_arr = explode(',', $columns_str);
		}
		else {
			$colums_arr[0] = $columns_str;
		}
		$num_colums = count($colums_arr);
		
		$res_columns_num = 0;
		$num_res =0;
		if($num_colums == 0) echo "Wrong query!";
		else {
			for ($i=0 ; $i < $num_colums ; $i ++ ) {
				for($j=0; $j < count($csv[0]) ; $j ++ ) {
					if($colums_arr[$i] == $csv[0][$j]) {
						++$res_columns_num;
						echo "<div style=\"float:left;border:1px solid gray; padding:10px;\">";
						echo $colums_arr[$i]."</br>";
						for($c=1; $c <=$limit ; $c++) {
							echo $csv[$c][$j]."</br>";
						}
						echo "</div>";
						++$num_res;
					}
				}
			}	
		}
		if($num_res ==0) echo "No results";
	
}
elseif(strtoupper($q_elements[0]) == "SUM" ){
	$column = $q_elements[1];
	$sum =0;
	for($i=0; $i < count($csv[0]) ; $i ++ ) {
		if($column == $csv[0][$i]){
			for($c=1; $c <count($csv) ; $c++) {
				$sum +=$csv[$c][$i];
			}	
				
		}
	}	
	echo $sum;
	
	
}
elseif(strtoupper($q_elements[0]) == "SHOW" ){
	for($i=0; $i < count($csv[0]) ; $i ++ ) {
		echo 	$csv[0][$i]." ";
	}	
	
}
elseif(strtoupper($q_elements[0]) == "FIND" ){
	
	$find_arr = array();
	$num_res = 0;
	$q_elements[1]= str_replace('"','',$q_elements[1]); 
	for($i=1; $i < count($csv) ; $i ++ ) {
		$check = false;
		for($j=0; $j < count($csv[$i]) && !$check ; $j ++ ) {
			if(strpos(strtolower($csv[$i][$j]),strtolower($q_elements[1])) !== FALSE ){	
				array_push( $find_arr ,$i);
				for($c=0; $c < count($csv[$i]) ; $c ++ ) {
					echo $csv[$i][$c]." ";
				}		
				echo "</br>";
				++$num_res;
				$check = true;
			}
		}
		
	}	
	if($num_res == 0) echo "No results";
	
	
}
else {
	echo "Wrong query ! <a href=\"index.php\">Try again </a>";
}
//echo $query_elements_arr[0];