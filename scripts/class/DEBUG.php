<?php
class DEBUG{
	public static function debug_to_console( $data ) {
		if ( is_array( $data ) )
			$output = "<script>console.log( 'Debug: " . implode( ',', $data) . "' );</script>";
		else
			$output = "<script>console.log( 'Debug: " . $data . "' );</script>";

		echo $output;
		
	}
		
	public static function print_var_name($var) {
		foreach($GLOBALS as $var_name => $value) {
			if ($value === $var) {
				return $var_name;
			}
		}

		return false;
	}

	public static function debug_foreach( $TAB, $varname = null ){

		if ($varname == null) $varname = $this->print_var_name($TAB);
		
		foreach ( $TAB as $row_name => $row_value) {
			if (is_array($row_value)){
				$this->debug_foreach( $row_value, $varname . "[\'$row_name\']" );
			}else{
				$this->debug_to_console( $varname . "[\'" . $row_name . "\'] = " . $row_value );
			}
		}
	}
}
?>