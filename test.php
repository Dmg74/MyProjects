<?php
//declare(strict_types=1);
$word = 'Это «ТАк-Так» "ПроCто"';//Задаем фразу
//$word = 'Это';
function reverseAllPrase($prase)
{
    $reverse = preg_split('//u', $prase, null, PREG_SPLIT_NO_EMPTY);//разбиваем фразу по символам в массив
// с учем Юникода

    $arr_temp = [];//Определяем временный массив
    $result = [];//Определяем результирующий массив массив
    $j = 0;//Переменная для цикла

    while ($reverse[$j]) {//в первом цикле перебираем весь входящий массив
        if (bin2hex($reverse[$j]) == 'c2ab')//Если открывающие кавычки - «
        {
            $no_reverse = true; //отключаем реверсирование фраз
        }

        while (IntlChar::isalpha($reverse[$j])) {//цикл для сброра фразы из символов, если буква
            $arr_temp[] = $reverse[$j];// символ добавляем во временный массив символ
            $j++;//переходим к следующему символу
        }

        if (isset($arr_temp)) {//проверяем массив , что не пустой
            if (!$no_reverse) {//если включен реверс
                $arr_temp = reverse($arr_temp);//делаем реверс слова и добавляем в массив
            }/*else{//иначе
            $arr_temp = $arr_temp;//просто добавляем в массив
            //$no_reverse = false;
        }*/
            $result = array_merge($result, $arr_temp);//добавляем временный массив в реультирующий
        }
        unset($arr_temp);//очищаем временный массив
        if ($reverse[$j]) {//проверяем наличие символа
            if (bin2hex($reverse[$j]) == 'c2bb')//если закрывающая кавычка
            {
                $no_reverse = false; //включаем реверсирование
            }
            $result[] = $reverse[$j];//добавляем небуквенный символ в массив
        }
        $j++;
    }
    return implode($result);//объединяем массив строку и возвращаем
}
function reverse($reverse)//функция реверсироания
    {
        $half = count($reverse)/2;//делим длину слова пополам
        $num = count($reverse)-1;//общее число символов, -1 для соответсвия индексу массива
    for ($i = 0; $i < $half; $i++) {//Цикл для зеркальной замены 2-х символов
        if (IntlChar::isUUppercase($reverse[$i]) && IntlChar::isULowercase($reverse[$num - $i])) {//Если символы в разном регистре
            //print_r($reverse[$i]);
            $reverse[$i] = mb_convert_case($reverse[$i], MB_CASE_LOWER, "UTF-8");//меняем регистр
            $reverse[$num - $i] = mb_convert_case($reverse[$num - $i], MB_CASE_UPPER, "UTF-8");//на противоположный
        }elseif (IntlChar::isULowercase($reverse[$i]) && IntlChar::isUUppercase($reverse[$num - $i]))//Если символы в разном регистре
        {
            $reverse[$i] = mb_convert_case($reverse[$i], MB_CASE_UPPER, "UTF-8");//меняем регистр
            $reverse[$num - $i] = mb_convert_case($reverse[$num - $i], MB_CASE_LOWER, "UTF-8");//на противоположный
        }
        $temp = $reverse[$i];//меняем символы местами
        $reverse[$i] = $reverse[$num - $i];//через временную
        $reverse[$num - $i] = $temp;//переменную
    }
    return $reverse;
}
$result = reverseAllPrase($word);
echo $result;


