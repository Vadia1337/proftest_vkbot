<?php

if ($data->type == 'message_new') {

    if ($message == 'Начать' OR $message == 'начать' OR $message == 'Старт') {
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

if ($payload == 'btn_5'){
    nextQ($vk, $peer_id);
}

if ($payload == 'btn_6'){
    Checkbox($vk, $peer_id);
}




function mainmenu($vk, $peer_id){

    $btn_1 = $vk->buttonText('Пройти тест', 'green', ['command' => 'btn_1']);
    $btn_2 = $vk->buttonText('Результаты теста', 'blue', ['command' => 'btn_2']);
    $btn_3 = $vk->buttonText('Пройти заново', 'white', ['command' => 'btn_3']);
    $btn_4 = $vk->buttonText('Выйти', 'red', ['command' => 'btn_9']);

    $vk->sendButton($peer_id, "Приветствую, предлагаю тебе пройти быстрый тест, после я смогу подсказать тебе на какую специальность лучше подать документы :-)", [[$btn_1], [$btn_2], [$btn_3, $btn_4]]);
}

// вопрос №1 
function nextQ($vk, $peer_id){

    $btn_1 = $vk->buttonText('Да', 'green', ['command' => 'Test_KIS_1']);
    $btn_2 = $vk->buttonText('Нет', 'blue', ['command' => 'Test_IB_1']);
    $btn_3 = $vk->buttonText('Не оч', 'white', ['command' => 'btn_3']);
    $btn_4 = $vk->buttonText('Выйти', 'red', ['command' => 'btn_9']);

    $vk->sendButton($peer_id, "Тебе нравиться прога?", [[$btn_1], [$btn_2], [$btn_3, $btn_4]]);
}

function Checkbox($vk, $peer_id){

    $btn_1 = $vk->buttonText('1', 'green', ['command' => 'Check_btn1_KIS_1']);
    $btn_2 = $vk->buttonText('2', 'green', ['command' => 'Check_btn2_IB_1']);
    $btn_3 = $vk->buttonText('3', 'green', ['command' => 'Check_btn3_KIS_1']);
    $btn_4 = $vk->buttonText('4', 'green', ['command' => 'Check_btn4_KIS_1']);
    $btn_5 = $vk->buttonText('Отправить', 'blue', ['command' => 'CheckBoxSend']);

    $vk->sendButton($peer_id, "Выбери варианты ответов", [[$btn_1, $btn_2], [$btn_3, $btn_4], [$btn_5]]);
}

if (str_contains($payload, 'Check')){
if(str_contains($payload, 'btn1')){
    if(str_contains($payload, 'Checked_btn1')){
        $payload = substr_replace($payload, '', strpos($payload, 'Checked_btn1'), 18);
        $btn_1 = $vk->buttonText('1', 'green', ['command' => $payload.'Check_btn1_KIS_1']);
    }else{
    $payload1 = substr_replace($payload, 'Checked', strpos($payload, 'Check_btn1'), 5);
        $btn_1 = $vk->buttonText('1', 'red', ['command' => $payload1]);
    }
}else{
        $btn_1 = $vk->buttonText('1', 'green', ['command' => $payload.'Check_btn1_KIS_1']);
}


if(str_contains($payload, 'btn2')){
    if(str_contains($payload, 'Checked_btn2')){
        $payload = substr_replace($payload, '', strpos($payload, 'Checked_btn2'), 17);
        $btn_2 = $vk->buttonText('2', 'green', ['command' => $payload.'Check_btn2_IB_1']);
    }else{
    $payload2 = substr_replace($payload, 'Checked', strpos($payload, 'Check_btn2'), 5);
        $btn_2 = $vk->buttonText('2', 'red', ['command' => $payload2]);
    }
}else{
        $btn_2 = $vk->buttonText('2', 'green', ['command' => $payload.'Check_btn2_IB_1']);
}


if(str_contains($payload, 'btn3')){
    if(str_contains($payload, 'Checked_btn3')){
        $payload = substr_replace($payload, '', strpos($payload, 'Checked_btn3'), 18);
        $btn_3 = $vk->buttonText('3', 'green', ['command' => $payload.'Check_btn3_KIS_1']);
    }else{
    $payload3 = substr_replace($payload, 'Checked', strpos($payload, 'Check_btn3'), 5);
        $btn_3 = $vk->buttonText('3', 'red', ['command' => $payload3]);
    }
}else{
        $btn_3 = $vk->buttonText('3', 'green', ['command' => $payload.'Check_btn3_KIS_1']);
}


if(str_contains($payload, 'btn4')){
    if(str_contains($payload, 'Checked_btn4')){
        $payload = substr_replace($payload, '', strpos($payload, 'Checked_btn4'), 18);
        $btn_4 = $vk->buttonText('4', 'green', ['command' => $payload.'Check_btn4_KIS_1']);
    }else{
    $payload4 = substr_replace($payload, 'Checked', strpos($payload, 'Check_btn4'), 5);
        $btn_4 = $vk->buttonText('4', 'red', ['command' => $payload4]);
    }
}else{
        $btn_4 = $vk->buttonText('4', 'green', ['command' => $payload.'Check_btn4_KIS_1']);
}

        $btn_5 = $vk->buttonText('Отправить', 'blue', ['command' => 'CheckBoxSend_']);

    $vk->sendButton($peer_id, "0".$payload, [[$btn_1, $btn_2], [$btn_3, $btn_4], [$btn_5]]);
//&#4448;
}



if (str_contains($payload, 'Test')){
    $fileredactor = fopen('tests/'.$peer_id.".txt", "c");
    fseek($fileredactor, 0, SEEK_END); 
    fwrite($fileredactor, substr($payload, 5)); //обрезка Test_
    fclose($fileredactor);
}

?>