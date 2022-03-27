<?php

require_once('vkmaster/autoload.php');

use DigitalStar\vk_api\VK_api as vk_api;

const VK_KEY = "c321026e37cfcb5b8e67cf7107e5a0df06ed3c5ce505834cdcbe36410da6d88795694a43713f5e211403a";  // Токен сообщества
const ACCESS_KEY = "f7174ec3";  // ключ из сообщества 
const VERSION = "5.131"; // Версия API VK

$vk = vk_api::create(VK_KEY, VERSION)->setConfirm(ACCESS_KEY);

$vk->initVars($peer_id, $message, $payload, $vk_id, $type, $data);

if ($data->type == 'message_new') {

    if ($message == 'Начать' OR $message == 'начать') {
        mainmenu($vk, $peer_id);
    }

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

function mainmenu($vk, $peer_id){

    $btn_1 = $vk->buttonText('Пройти тест', 'green', ['command' => 'btn_1']);
    $btn_2 = $vk->buttonText('Результаты теста', 'blue', ['command' => 'btn_2']);
    $btn_3 = $vk->buttonText('Пройти заново', 'white', ['command' => 'btn_3']);
    $btn_4 = $vk->buttonText('Выйти', 'red', ['command' => 'btn_4']);

    $vk->sendButton($peer_id, "Приветствую, я бот Политеша, предлагаю тебе пройти быстрый тест, после я смогу подсказать тебе на какую специальность лучше подать документы :-)", [[$btn_1], [$btn_2], [$btn_3, $btn_4]]);
}
    
?>