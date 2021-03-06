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
            'name' => 'asset',
            'view' => 'im_sample.asset',
            'table' => 'im_sample.asset',
            'key' => 'asset_id',
            'repeat-control'=>'insert delete',
            'records' => 5,
            'paging' => true,
            'sort' => array(
                array('field' => 'purchase', 'direction' => 'ASC'),
            ),
            'default-values'=>array(
                array('field'=>'purchase', 'value'=> strftime('%Y-%m-%d')),
            )
        ),
        array(
            'name' => 'asseteffect',
            'view' => 'im_sample.asset',
            'table' => 'im_sample.asset',
            'sort' => array(
                array('field' => 'purchase', 'direction' => 'ASC'),
            ),
            'query' => array(
                array('field' => 'discard', 'operator' => '<', 'value'=>'1990-1-1'),
            ),
            'repeat-control'=>'insert delete',
            'records' => 5,
            'paging' => true,
        ),
        array(
            'name' => 'assetdetail',
            'view' => 'im_sample.asset',
            'table' => 'im_sample.asset',
            'records' => 1,
            'key' => 'asset_id',
        ),
        array(
            'name' => 'rent',
            'view' => 'im_sample.rent',
            'table' => 'im_sample.rent',
            'key' => 'rent_id',
            'sort' => array(
                array('field' => 'rentdate', 'direction' => 'ASC'),
            ),
            'relation' => array(
                array('foreign-key' => 'asset_id', 'join-field'=> 'asset_id', 'operator' => '='),
            ),
            'repeat-control'=>'insert delete',
            'default-values'=>array(
                array('field'=>'rentdate', 'value'=> strftime('%Y-%m-%d')),
            )
        ),
        array(
            'name' => 'staff',
            'view' => 'im_sample.staff',
            'table' => 'im_sample.staff',
        ),
        array(
            'name' => 'rentback',
            'view' => 'im_sample.rent',
            'table' => 'im_sample.rent',
            'key' => 'rent_id',
            'query' => array(
                array('field' => 'backdate', 'operator' => 'IS NULL'),
            ),
        ),
        array(
            'name' => 'category',
            'view' => 'im_sample.category',
            'table' => 'im_sample.category',
        ),
        array(
            'name' => 'category-in-list',
            'view' => 'im_sample.category',
            'table' => 'im_sample.category',
            'relation' => array (
                array('foreign-key' => 'name', 'join-field'=> 'category', 'operator' => '=')
            )
        ),
    ),
    array(
        'formatter' => array(
            array('field' => 'asset@purchase', 'converter-class' => 'MySQLDateTime', 'parameter'=>'%y/%m/%d'),
            array('field' => 'asset@discard', 'converter-class' => 'MySQLDateTime'),
        ),
    ),
    array(
        'db-class' => 'PDO',
        'dsn' => 'pgsql:host=localhost;port=5432;dbname=test_db',
    ),
    false
);
