<?php
header('Content-type: text/plain');
function maskOutWords ($words , $text) {
	
	$symbols_arr = array ('.' , ',' , '!' , '?' , ';' , ':' , '/' , '\\' , '~' , '%' , '&');
	$text = preg_replace("/\n/",' ~ ',$text);
	
	$words_arr = explode(" ", $text);
	
	for ($i = 0 ; $i < count($words_arr); $i ++){
		for ($j =0 ; $j <count($words) ; $j ++){
			if(strpos(strtolower($words_arr[$i]), strtolower($words[$j])) !== false) {
				
				$word_len = strlen ($words_arr[$i]);
				
				for($c =0 ; $c < $word_len; $c++){
					
					if(!in_array($words_arr[$i][$c] , $symbols_arr ))
						$words_arr[$i][$c] = '*';
					
				}
				
				
			}
			
		}
		
	} 
	$final_str = "";
	for ($i = 0 ; $i < count($words_arr); $i ++){
		if($words_arr[$i] == '~') {
			$final_str .="\n";
		}
		else {
			$final_str .=$words_arr[$i]." ";
		}
	}
	return $final_str;
	
}



$words = array ("yesterday", "Dog", "food", "walk"); 
$text ="Yesterday, I took my dog for a walk.\nIt was crazy! My dog wanted only food.";
echo maskOutWords($words , $text);