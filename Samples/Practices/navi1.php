<?php
/*
 * INTER-Mediator Ver.@@@@2@@@@ Released @@@@1@@@@
 *
 *   by Masayuki Nii  msyk@msyk.net Copyright (c) 2010-2014 Masayuki Nii, All rights reserved.
 *
 *   This project started at the end of 2009.
 *   INTER-Mediator is supplied under MIT License.
 */
require_once(dirname(__FILE__) . '/../../INTER-Mediator.php');

IM_Entry(
    array(
        array(
            'records' => 10,
            'name' => 'productlist',
            'view' => 'product',
            'key' => 'id',
            'sort' => array(array('field' => 'name', 'direction' => 'ASC'),),
            'navi-control' => 'master-hide',
        ),
        array(
            'records' => 1,
            'name' => 'productdetail',
            'view' => 'product',
            'table' => 'product',
            'key' => 'id',
            'navi-control' => 'detail-top',
        ),
    ),
    array(
        'formatter' => array(
            array('field' => 'product@unitprice', 'converter-class' => 'Number', 'parameter' => '0'),
        ),
    ),
    array('db-class' => 'PDO'),
    false
);
