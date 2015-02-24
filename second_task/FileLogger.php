<?php
include ("MyLogger.php");
class FileLogger implements MyLogger {
	
	public function log($level , $message){
		
		$time=time();
		$time_iso= date("Y-m-d", $time) . 'T' . date("H:i:s", $time) .'+00:00';
		
		$file = 'file.txt';
		if($level == 1) {
			$file_string = file_get_contents($file);
			$file_string .= "INFO::".$time_iso."::".$message."\r\n";
			file_put_contents($file, $file_string);
			
			echo "FileLogger logged message to file.";
			
		}
		if($level == 2) {
			$file_string = file_get_contents($file);
			$file_string .= "WARNING::".$time_iso."::".$message."\r\n";
			file_put_contents($file, $file_string);
			
			echo "FileLogger logged message to file.";
		}
		if($level == 3) {
			$file_string = file_get_contents($file);
			$file_string .= "PLSCHECKFFS::".$time_iso."::".$message."\r\n";
			file_put_contents($file, $file_string);
			
			echo "FileLogger logged message to file.";
		}
		
	}
	
	
}