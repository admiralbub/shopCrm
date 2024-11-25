<?php
use Carbon\Carbon;
if (! function_exists('settings')) {
    function settings(?string $key = null, $default = null)
    {
        if (is_null($key)) {
            return app('settings');
        }
        return app('settings')->get($key, $default);
    }
}

if (! function_exists('pages')) {
    function pages()
    {
        return app('pages');
    }
}
function lastDay($start_stocks_date, $end_stocks_date) {
    $date_start = new DateTime($start_stocks_date);
    $end_start = new DateTime($end_stocks_date);

    $current_date = Carbon::now();

    $end_date = Carbon::parse($end_stocks_date);

    $days_difference = $current_date->diffInDays($end_date, false);


    
    return (int) ceil($days_difference);
} 
function dateBetween($start_stocks_date, $end_stocks_date, $lang) {
    $date_start = new DateTime($start_stocks_date);
    $end_start = new DateTime($end_stocks_date);
    return Carbon::parse($date_start)->locale($lang)->isoFormat('D MMMM').' - '.Carbon::parse($end_start)->locale($lang)->isoFormat('D MMMM ');
}

function findInNestedArray($needle, $haystack) {
    foreach ($haystack as $value) {
        if (is_array($value)) {
            // Рекурсивный вызов, если значение - массив
            if (findInNestedArray($needle, $value)) {
                return true;
            }
        } elseif ($value === $needle) {
            // Нашли значение
            return true;
        }
    }
    return false;
}

function filterUrlAttr($url, $id,$prefix) {
    //Проверяем, если есть в url атрибут $prefix
    $brand = strripos($url, $prefix.'-'); 
    //Верно
    if($brand) {
        //Разбиваем url строку на массив
        $url_items = explode("/", $url);
        //Перебираем url строку с атрибутом бренда
        foreach ($url_items as $key=>$url_item) {
            //Находим атрибут бренд
            if (strpos($url_item, $prefix) !== false) {
                //Проверяем в атрибут brand на дубликаты id
                if (strpos($url_item, $id) !== false) {
                    $brandIds = explode("-", $url_item); //Выводим массив всех id из атрибута $prefix
                    $brandIds = explode("_", $brandIds[1]); //Выводим массив по отдельности id
                    $brand_unio_ids = implode('_',array_diff($brandIds, [$id])); //Удаляем дубоикат id
                    $brand_list = $brand_unio_ids ? $prefix.'-'.$brand_unio_ids : ''; //Создаем новый атрибут из уникальных id
                } else {
                    $brand_list = $url_item.'_'.$id; //Добавляем новый id в атрибут brand
                }
                $url_item = $brand_list; 
            }
            $brand_url[] = $url_item;
        }
        //Генерируем строку из новых id бренлов
        $url = implode('/',$brand_url); 
        //Удаляем / в конце url, если он есть 
        $url = rtrim($url, '/');
   
    } else {
        $url = $url.'/'.$prefix.'-'.$id; //Добавляем атрибут $prefix в url
         //Удаляем / в конце url, если он есть 
         $url = rtrim($url, '/');
    }
    return $url;
}    

?>