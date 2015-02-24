<?php
include ("MyLogger.php");
class ConsoleLogger implements MyLogger {
	
	
	public function log($level , $message){
		
		$time=time();
		$time_iso= date("Y-m-d", $time) . 'T' . date("H:i:s", $time) .'+00:00';

		if($level == 1) {
			
			echo "INFO::".$time_iso."::".$message;
		}
		if($level == 2) {
			echo "WARNING::".$time_iso."::".$message;
		}
		if($level == 3) {
			echo "PLSCHECKFFS::".$time_iso."::".$message;
			
		}
		
	}
	
}
