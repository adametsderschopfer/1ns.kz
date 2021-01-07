<?php
	class db
	{
		private $con = false; 
		private $Queryes = 0; 
		private $MySQLErrors = array();
		private $TimeQuery = 0; 
		private $MaxExTime = 0;
		private $ListQueryes = ""; 
		private $HardQuery = ""; 
		private $LastQuery = false; 
		private $ConnectData = array();
		
		public function __construct($host, $user, $pass, $base){
			$this->Connect($host, $user, $pass, $base);
			$this->query("SET NAMES 'utf8'");
			$this->query("SET CHARACTER SET 'utf8'");
		}

		private function GetError($TextError){
			$this->MySQLErrors[] = $TextError;
			die($TextError);
		}
		
		public function query($query, $FreeMemory = false, $write_last = true){
			$TimeA = $this->get_time();
			$xxt_res = mysqli_query($this->con, $query) or $this->GetError(mysqli_error($this->con));
			
			if($write_last) $this->LastQuery = $xxt_res;
			
			$TimeB = $this->get_time() - $TimeA;
			$this->TimeQuery += $TimeB;
			
			if($TimeB > $this->MaxExTime){$this->HardQuery = $query; $this->MaxExTime = $TimeB;}
			if( empty($this->ListQueryes) ) $this->ListQueryes = $query; else $this->ListQueryes .= "\n".$query;
				
			$this->Queryes++;
			
			if(!$FreeMemory){
				return $this->LastQuery;
			} else return $this->FreeMemory();
		}

		private function get_time(){
			list($seconds, $microSeconds) = explode(' ', microtime());
			return ((float) $seconds + (float) $microSeconds);
		}

		private function Connect($host, $user, $pass, $base){
			$this->con =  @mysqli_connect($host, $user, $pass, $base) or $this->GetError(mysqli_connect_error());
		} 
		
		function __destruct(){
			if( !count($this->MySQLErrors) ) mysqli_close($this->con);
		}
		
		function NumRows()
		{
			return mysqli_num_rows($this->LastQuery);
		}
		
		function FetchArray(){
			return mysqli_fetch_array($this->LastQuery);
		}
		
		function FetchRow(){
			$xres = mysqli_fetch_row($this->LastQuery);
			
			return (count($xres) > 1) ? $xres :  $xres[0];
		}
		
		function LastInsert(){
			return @mysqli_insert_id($this->con);
		}
	}
?>