<?php
/**
 * DataConverter_NumberBase_Test file
 */
require_once(dirname(__FILE__) . '/../INTER-Mediator.php');
require_once(dirname(__FILE__) . '/../DataConverter_NumberBase.php');

class DataConverter_NumberBase_Test extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $_SERVER['HTTP_ACCEPT_LANGUAGE'] = 'ja';
        
        $this->dataconverter = new DataConverter_NumberBase();
        
        $locInfo = localeconv();
        $this->decimalMark = $locInfo['mon_decimal_point'];
        if (strlen($this->decimalMark) == 0) {
            $this->decimalMark = '.';
        }
        $this->thSepMark = $locInfo['mon_thousands_sep'];
    }

    public function test_converterFromUserToDB()
    {
        $expected = '100';
        $string = '100';
        $this->assertEquals($expected, $this->dataconverter->converterFromUserToDB($string));

        $expected = '1000';
        $string = '1' . $this->thSepMark . '000';
        $this->assertEquals($expected, $this->dataconverter->converterFromUserToDB($string));

        $expected = '10000';
        $string = '10' . $this->thSepMark . '000';
        $this->assertEquals($expected, $this->dataconverter->converterFromUserToDB($string));

        $expected = '100000';
        $string = '100' . $this->thSepMark . '000';
        $this->assertEquals($expected, $this->dataconverter->converterFromUserToDB($string));

        $expected = '1000000';
        $string = '1' . $this->thSepMark . '000' . $this->thSepMark . '000';
        $this->assertEquals($expected, $this->dataconverter->converterFromUserToDB($string));

        $expected = '10000000.1';
        $string = '10' . $this->thSepMark . '000' . $this->thSepMark . '000' . $this->decimalMark . '1';
        $this->assertEquals($expected, $this->dataconverter->converterFromUserToDB($string));
    }
}