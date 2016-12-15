<?php

use PHPUnit\Framework\TestCase;

use Funpay\SMS;

class SMSTest extends TestCase
{
    public function testParse()
    {
        $str = "Пароль: 5817\nСпишется 99,5р.\nПеревод на счет 410012542376474";
        $sms = new SMS();
        $result = [
            'code' => '5817',
            'sum' => '99,5',
            'num' => '410012542376474'
        ];
        $this->assertEquals($result, $sms->parse($str));

        $str = "Спишется 0,01р.\nПароль: 5817\nНомер счета 410012542376474";
        $sms = new SMS();
        $result = [
            'code' => '5817',
            'sum' => '0,01',
            'num' => '410012542376474'
        ];
        $this->assertEquals($result, $sms->parse($str));

        $str = "Спишется 10000,00р.\nПеревод на счет 410012542376474\nКод: 5817";
        $sms = new SMS();
        $result = [
            'code' => '5817',
            'sum' => '10000,00',
            'num' => '410012542376474'
        ];
        $this->assertEquals($result, $sms->parse($str));

        // Интересный случай
        $str = "Спишется 999999999999999,99р.\nПеревод на счет 410012542376474\nКод: 5817";
        $sms = new SMS();
        $result = [
            'code' => '5817',
            'sum' => '999999999999999,99',
            'num' => '410012542376474'
        ];
        $this->assertEquals($result, $sms->parse($str));

        $str = "Спишется 999999999999999.99р.\nПеревод на счет 410012542376474\nКод: 5817";
        $sms = new SMS();
        $result = [
            'code' => '5817',
            'sum' => '999999999999999.99',
            'num' => '410012542376474'
        ];
        $this->assertEquals($result, $sms->parse($str));

        $str = "99,5 руб.\n410012542376474\n5817";
        $sms = new SMS();
        $result = [
            'code' => '5817',
            'sum' => '99,5',
            'num' => '410012542376474'
        ];
        $this->assertEquals($result, $sms->parse($str));

        $str = "99.50руб.\n410012542376474\n5817";
        $sms = new SMS();
        $result = [
            'code' => '5817',
            'sum' => '99.5',
            'num' => '410012542376474'
        ];
        $this->assertEquals($result, $sms->parse($str));
    }
}