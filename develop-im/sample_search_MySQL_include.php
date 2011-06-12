<?php
/*
 * INTER-Mediator Ver.@@@@2@@@@ Released @@@@1@@@@
 *
 *   by Masayuki Nii  msyk@msyk.net Copyright (c) 2011 Masayuki Nii, All rights reserved.
 *
 *   This project started at the end of 2009.
 *   INTER-Mediator is supplied under MIT License.
 */
require_once ( 'INTER-Mediator/INTER-Mediator.php');

$tableDefinitions
	= array(
		array(
			'name'  	=> 'postalcode',
            'records'	=>	10,
            'paging'    =>  true,
			'sort'	    => array( array( 'field'=>'f3', 'direction'=>'ASC' ),),
		),
	);

$optionDefinitions = array();

$dbDefinitions = array(
            'db-class' => 'PDO',
            'dsn'=>'mysql:host=localhost;dbname=test_db'
        );

IM_Entry( $tableDefinitions, $optionDefinitions, $dbDefinitions, true );

?>