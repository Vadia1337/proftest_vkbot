<?php

require_once('vkmaster/autoload.php');

use DigitalStar\vk_api\VK_api as vk_api;

const VK_KEY = "c321026e37cfcb5b8e67cf7107e5a0df06ed3c5ce505834cdcbe36410da6d88795694a43713f5e211403a";  // Токен сообщества
const ACCESS_KEY = "f7174ec3";  // ключ из сообщества 
const VERSION = "5.131"; // Версия API VK

$vk = vk_api::create(VK_KEY, VERSION)->setConfirm(ACCESS_KEY);
$vk->initVars($peer_id, $message, $payload, $vk_id, $type, $data);

include_once('QuestionsController.php');
    
?>