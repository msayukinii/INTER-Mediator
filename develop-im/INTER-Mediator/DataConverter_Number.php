<?php
/*
 * INTER-Mediator
 * by Masayuki Nii  msyk@msyk.net Copyright (c) 2010 Masayuki Nii, All rights reserved.
 * 
 * This project started at the end of 2009.
 * 
 */
require_once( 'DataConverter_NumberBase.php' );
class DataConverter_FMDateTime extends DataConverter_NumberBase	{
	
	var $d = null;
	
	function __construct( $digits )	{
		parent::__construct();
		$this->d = $digits;
	}

	function converterFromDBtoUser( $str )	{
		return number_format( $str, $this->d, $this->decimalMark, $this->thSepMark );
	}
}
?>