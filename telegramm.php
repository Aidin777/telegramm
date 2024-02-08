<?php

$tele_token = '6965995082:AAEP5gybt5yi19oZo3ByB80MfODOFgs2eOc';
$unit_id = 72;
$api_key = 'ba65886f-dfc1-47cc-9bed-705f06d90001';
$url_tele = "https://api.tuktuk.oeda.site/api/unit/$unit_id/order?api_key=$api_key&page=1&per_page=20";

$response = json_decode(file_get_contents($url_tele), 1);

$order = $response['data']['orders'][0];

function sendMessage($chatId, $message) {
    $botToken = '6965995082:AAEP5gybt5yi19oZo3ByB80MfODOFgs2eOc';
    $url = "https://api.telegram.org/bot$botToken/sendMessage?chat_id=$chatId&text=".urlencode($message);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Отправляем запрос на API Телеграмма
    $response = curl_exec($ch);

// Закрываем соединение cURL
    curl_close($ch);

    return $response;
}

$placeName = 'Название заведения: '.$order['partner'];
$orderNumber = 'Заказ №: '.$order['number'];
//$orderType = 'Тип заказа:'.$order[''];
$orderCreateTime = 'Заказ создан: '.$order['products']['category']['created_at'];
$orderToTime = 'Заказ ко времени: '.$order['order_time_at'];
$orderPhone = 'Телефон: '.$order['payload']['client']['phone'];
$orderAddress = 'Адрес получения: '.$order['client_address']['address'];
//$order = ' '.$order[''];
//$order = 'Состав заказа: '.$order[''];
//$order = 'Все позиции в заказе '.$order[''];
//$order = 'Доставка: '.$order[''];
//$order = 'ИТОГО: '.$order[''];
$orderPaymentType = 'Способ оплаты: '.$order['payment']['name'];
$orderKitchen = 'Комментарий повару: '.$order['payload']['comments']['kitchen'];
$orderCourier = 'Комментарий курьеру: '.$order['payload']['comments']['courier'];
// Пример использования функции
$chatId = '1724934632';
$message = 'Привет, мир!';



$message = $placeName."\n".
    $orderNumber."\n".
    $orderCreateTime."\n".
    $orderToTime."\n".
    $orderPhone."\n";

sendMessage($chatId, $message);
