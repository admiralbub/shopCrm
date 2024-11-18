<?php
if (! function_exists('settings')) {
    function settings(?string $key = null, $default = null)
    {
        if (is_null($key)) {
            return app('settings');
        }
        return app('settings')->get($key, $default);
    }
}
function filter_url($url, $id,$prefix) {
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