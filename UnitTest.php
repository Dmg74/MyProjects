<?php
declare(strict_types=1);
include 'test.php';

use PHPUnit\Framework\TestCase;

class UnitTest extends TestCase
{
    public function testWithPhrase()
    {
        $word = 'Это «ТАк-Так» "ПроCто"';//Задаем фразу
        $result = reverseAllPrase($word);
        $this->assertEquals('Отэ «ТАк-Так» "ОтcОрп"', $result);
    }
    public function testWithPartPhrase()
    {
        $word = ['Э','т'];////Задаем часть фразы ввиде массива
        //print_r(reverseAllPhrase($word));
        $result = reverse($word);
        //print $result;
        $this->assertEquals(['Т','э'], $result);
    }
}