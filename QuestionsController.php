<?php

if ($data->type == 'message_new') {

 //   if ($message == 'Начать' OR $message == 'начать') {
        mainmenu($vk, $peer_id);
 //    }
}

if (isset($data->object->payload)) {  //получаем payload
    $payload = json_decode($data->object->payload, True);
} else {
    $payload = null;
}
$payload = $payload['command'];


if ($payload == 'btn_1'){
$vk->sendMessage($peer_id, "Для начала мне нужно понять кто ты на самом деле!");

$btn_5 = $vk->buttonText('Школьник', 'green', ['command' => 'btn_5']);
$btn_6 = $vk->buttonText('Абитуриент', 'green', ['command' => 'btn_6']);
$btn_7 = $vk->buttonText('Студент', 'green', ['command' => 'btn_7']);
$btn_8 = $vk->buttonText('Преподаватель', 'green', ['command' => 'btn_8']);
$btn_9 = $vk->buttonText('Назад', 'white', ['command' => 'btn_9']);

$vk->sendButton($peer_id, "Выбери из предложенных вариантов:", [[$btn_5, $btn_6], [$btn_7, $btn_8], [$btn_9]]);
}
if ($payload == 'btn_9'){
    mainmenu($vk, $peer_id);
}

if ($payload == 'btn_5'){
    nextQ($vk, $peer_id);
}




function mainmenu($vk, $peer_id){

    $btn_1 = $vk->buttonText('Пройти тест', 'green', ['command' => 'btn_1']);
    $btn_2 = $vk->buttonText('Результаты теста', 'blue', ['command' => 'btn_2']);
    $btn_3 = $vk->buttonText('Пройти заново', 'white', ['command' => 'btn_3']);
    $btn_4 = $vk->buttonText('Выйти', 'red', ['command' => 'btn_4']);

    $vk->sendButton($peer_id, "Приветствую, я бот Политеша, предлагаю тебе пройти быстрый тест, после я смогу подсказать тебе на какую специальность лучше подать документы :-)", [[$btn_1], [$btn_2], [$btn_3, $btn_4]]);
}

// вопрос №1 
function nextQ($vk, $peer_id){

    $btn_1 = $vk->buttonText('Да', 'green', ['command' => 'KIS_1']);
    $btn_2 = $vk->buttonText('Нет', 'blue', ['command' => 'IB_1']);
    $btn_3 = $vk->buttonText('Не оч', 'white', ['command' => 'btn_3']);
    $btn_4 = $vk->buttonText('Выйти', 'red', ['command' => 'btn_4']);

    $vk->sendButton($peer_id, "Тебе нравиться прога?", [[$btn_1], [$btn_2], [$btn_3, $btn_4]]);
}

if ($payload == 'KIS_1'){
    //записать в бд
}
if ($payload == 'IB_1'){
    //записать в бд
}

?>