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
            'name' => 'invoice',
            'records' => 1,
            'paging' => true,
            'key' => 'id',
            'query' => array( //    array('field' => 'issued', 'value' => '2012-01-01', 'operator' => '>=')
            ),
            'sort' => array(
                array('field' => 'id', 'direction' => 'ASC'),
            ),
            'repeat-control' => 'insert delete',
//        'post-enclosure' => 'invoiceExpanded',
            'calculation' => array(
                array(
                    'field' => 'total_calc',
                    'expression' => 'format(sum(item@amount_calc) * (1 + _@taxRate ))',
                ),
            ),
        ),
        array(
            'name' => 'item',
            //  'table' => 'item',
            //    'view' => 'item_display',
            'key' => 'id',
            'relation' => array(
                array('foreign-key' => 'invoice_id', 'join-field' => 'id', 'operator' => '=')
            ),
            'repeat-control' => 'insert delete',
            'default-values' => array(
                array('field' => 'product_id', 'value' => 1),
            ),
            'validation' => array(
                array(
                    'field' => 'qty',
                    'rule' => 'value>=0 && value < 100',
                    'message' => 'Quantity should be between 1..99.',
                    'notify' => 'inline'
                ),
                array(
                    'field' => 'unitprice',
                    'rule' => 'value>=0 && value<10000',
                    'message' => 'Unit price should be between 1.. 9999.',
                    'notify' => 'end-of-sibling'
                ),
            ),
            'calculation' => array(
                array(
                    'field' => 'amount_calc',
                    'expression' => "format(qty * if ( unitprice = '', product@unitprice, unitprice ))",
                ),
                array(
                    'field' => 'qty@style.color',
                    'expression' => "if (qty >= 10, 'red', 'black')",
                ),
            ),
        ),
        array(
            'name' => 'product',
            'key' => 'id',
            'relation' => array(
                array('foreign-key' => 'id', 'join-field' => 'product_id', 'operator' => '=')
            ),
        )
    ),
    array(
        'formatter' => array(
            array(
                'field' => 'item@qty',
                'converter-class' => 'NullZeroString',
                'parameter' => '0'
            ),
            array(
                'field' => 'item@unitprice',
                'converter-class' => 'NullZeroString',
                'parameter' => '0'
            ),
            array(
                'field' => 'product@unitprice',
                'converter-class' => 'Number',
                'parameter' => '2'
            ),
        ),
        /*
         * The definitions for Pusher are required. But it should be set to the params.php file
         * because some value is associated with each user.
        'pusher' => array(
            'app_id' => 'string',
            'key' => 'integer',
            'secret' => 'string',
        )
        */
    ),
    array('db-class' => 'PDO'),
    false
);
