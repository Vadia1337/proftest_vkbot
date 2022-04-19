<?php

if ($data->type == 'message_new') {

    if ($message == 'Начать' OR $message == 'начать' OR $message == 'Старт') {
        $fileredactor1 = file_get_contents('tests/'.$peer_id.".txt");
       if(str_contains($fileredactor1, "FLOOD")){
        $vk->sendMessage($peer_id, ":-( Ты нарушил правила. Как только напишешь 'Извини', я разрешу тебе продолжить!");
       }else{
       unlink('tests/'.$peer_id.".txt");
       mainmenu($vk, $peer_id);
       }
     }
     if ($message == 'Извини' OR $message == 'извини'){
        unlink('tests/'.$peer_id.".txt");
        mainmenu($vk, $peer_id);
     }
     
}

if (isset($data->object->payload)) {  //получаем payload
    $payload = json_decode($data->object->payload, True);
} else {
    $payload = null;
}
$payload = $payload['command'];




function mainmenu($vk, $peer_id){

    $btn_1 = $vk->buttonText('Пройти тест', 'green', ['command' => 'btn_1']);
  //  $btn_2 = $vk->buttonText('Результаты теста', 'blue', ['command' => 'btn_2']);

    $vk->sendButton($peer_id, "Приветствую, предлагаю тебе пройти быстрый тест, после я смогу подсказать тебе, на какую специальность лучше подать документы :-)", [[$btn_1]]);
}
if ($payload == 'btn_1'){
    Q1($vk, $peer_id);
}

if ($payload == 'btn_9'){

    $fileredactor1 = file_get_contents('tests/'.$peer_id.".txt");
    if(str_contains($fileredactor1, "FLOOD")){
        $vk->sendMessage($peer_id, ":-( Ты нарушил правила. Как только напишешь 'Извини', я разрешу тебе продолжить!");
    }else{
    unlink('tests/'.$peer_id.".txt");
    mainmenu($vk, $peer_id);
    }
}

if (str_contains($payload, 'goback')){

    $fileredactor1 = file_get_contents('tests/'.$peer_id.".txt");
    if(str_contains($fileredactor1, "FLOOD")){
        $vk->sendMessage($peer_id, ":-( Ты нарушил правила. Как только напишешь 'Извини', я разрешу тебе продолжить!");
    }else{
        $file = file_get_contents('tests/'.$peer_id.".txt");

        $pnum1 = substr($payload, 7, 1);
        $pnum2 = substr($payload, 7, 2);
        if(str_contains($pnum1, '0')){
                $itog = '0'.(substr($pnum2, 1)-1);
        }else{
            if(str_contains($pnum2, '0')){
                $ryad = (substr($pnum2, 0, 1)-1);
                $itog = ''.$ryad.''.'9';
            }else{
                $itog = ''.($pnum2 - 1);
            }
        }
        $filenew = substr_replace($file, '', strpos($file, '_'.$itog), strlen($file));

        unlink('tests/'.$peer_id.".txt");
        $fileredactor = fopen('tests/'.$peer_id.".txt", "c");
        fwrite($fileredactor, $filenew);
        fclose($fileredactor);

        $num1 = substr($payload, 7, 1);
        $num2 = substr($payload, 7, 2);
        if(str_contains($num1, '0')){
            $functionname = 'Q'.(substr($num2, 1)-1);
            if(function_exists($functionname)) {
                $btn_exit = $vk->buttonText('Пройти заново', 'red', ['command' => 'btn_9']);
                $functionname($vk, $peer_id, $btn_exit);
             }
        }else{
            $functionname = 'Q'.($num2-1);
            if(function_exists($functionname)) {
                $btn_exit = $vk->buttonText('Пройти заново', 'red', ['command' => 'btn_9']);
                $functionname($vk, $peer_id, $btn_exit);
             }
        }


    }
}
if ($payload == 'btn_2'){
    //Checkbox($vk, $peer_id);
    //$vk->sendMessage($peer_id, ":-( Не работает!");


  //  $btn_exit = $vk->buttonText('Пройти заново', 'red', ['command' => 'btn_9']);
 //   Q22($vk, $peer_id, $btn_exit);

}


//здесь придумать и указать аббревиатуры
//Веб-разработка - WEB
//Автоматизированные системы обработки информации и управления  - ASOIU 
//Интеграция и программирование в САПР - SAPR
//Информационные технологии в медиаиндустрии и дизайне - ITVMID
//Корпоративные информационные системы - KIS
//Информационная безопасность - INFOBES
//Информационная безопасность автоматизированных систем - IBAS
//Большие и открытые данные - BIGD
//Информационные технологии управления бизнесом - ITUB
//Системная и программная инженерия - SIPI
//Цифровая трансформация - CT
//Информационные системы умных пространств - ISUP
//Киберфизические системы - KIBS
//Программное обеспечение игровой компьютерной индустрии - GAMEDEV
//Технологии дополненной и виртуальной реальности - VR




//повтор. кнопки
$btn_exit = $vk->buttonText('Пройти заново', 'red', ['command' => 'btn_9']);


function Q1($vk, $peer_id){

$btn_1 = $vk->buttonText('1', 'blue', ['command' => 'Test_01_WEB_WEB_ASOIU_SAPR']); 
$btn_2 = $vk->buttonText('2', 'blue', ['command' => 'Test_01_ITVMID_ITVMID_KIS_SAPR']);             
$btn_3 = $vk->buttonText('3', 'blue', ['command' => 'Test_01_INFOBES_INFOBES_IBAS_IBAS_SAPR']);              
$btn_4 = $vk->buttonText('4', 'blue', ['command' => 'Test_01_BIGD_BIGD_ASOIU_ASOIU']);

$btn_exit = $vk->buttonText('Пройти заново', 'red', ['command' => 'btn_9']);

$vk->sendButton($peer_id, "Вас попросили разработать калькулятор. Какой из предложенных вариантов вы выберете?", [[$btn_1, $btn_2], [$btn_3, $btn_4], [$btn_exit]]);
$vk->sendMessage($peer_id, "1) Разработать веб-приложение, чтобы иметь доступ к калькулятору с любого устройства.\n2) Разработать мобильную версию приложения для использования калькулятора оффлайн.\n3) Разработать консольное приложение с повышенной отказоустойчивостью.\n4) Проанализирую и найду самый удобный калькулятор.");

}


function Q2($vk, $peer_id, $btn_exit){

    $btn_1 = $vk->buttonText('1', 'blue', ['command' => 'Test_02_ITUB_BIGD_KIS_KIS']); 
    $btn_2 = $vk->buttonText('2', 'blue', ['command' => 'Test_02_WEB_WEB_SIPI_ASOIU_SAPR']);             
    $btn_3 = $vk->buttonText('3', 'blue', ['command' => 'Test_02_SIPI_ASOIU_SAPR_SAPR_KIS_ITUB_ITUB_WEB_CT']); 

    $btn_back = $vk->buttonText('К предыдущему вопросу', 'white', ['command' => 'goback_02']);
    
    $vk->sendButton($peer_id, "Ваш знакомый увлекся бизнесом и просит вас посоветовать систему управления взаимоотношениями с клиентами для него. Ваши действия?", [[$btn_1, $btn_2], [$btn_3], [$btn_back, $btn_exit]]);
    $vk->sendMessage($peer_id, "1) Посоветовать вести учет в excel, пока он не поймет, какие именно возможности ему нужны.\n2) Посоветовать использовать готовые облачные решения.\n3) Предложите написать это систему специально под его задачи.");
    
}

function Q3($vk, $peer_id, $btn_exit){

    $btn_1 = $vk->buttonText('1', 'blue', ['command' => 'Test_03_WEB_WEB_ITUB_ISUP_SAPR_ASOIU_KIS_SIPI']);
    $btn_2 = $vk->buttonText('2', 'blue', ['command' => 'Test_03_INFOBES_INFOBES_ISUP_ISUP_IBAS_IBAS']);              
    $btn_3 = $vk->buttonText('3', 'blue', ['command' => 'Test_03_KIS_ISUP_ISUP_KIBS_KIBS']);              
    $btn_4 = $vk->buttonText('4', 'blue', ['command' => 'Test_03_SAPR_KIBS_KIBS_ASOIU']);

    $btn_back = $vk->buttonText('К предыдущему вопросу', 'white', ['command' => 'goback_03']);
        
    $vk->sendButton($peer_id, "Ваша бабушка постоянно теряет свой смартфон, и вы хотите ей помочь. Ваши действия?", [[$btn_1, $btn_2], [$btn_3, $btn_4], [$btn_back, $btn_exit]]);
    $vk->sendMessage($peer_id, "1) Написать ей сайт для отслеживания телефона.\n2) Установите софт для отслеживания устройства GPS.\n3) Установите приложение, издающее звуковой сигнал при определенных условиях.\n4) Спроектируете кнопку, которая отправляет сигнал на телефон по определенному протоколу.\n");
        
}

function Q4($vk, $peer_id, $btn_exit){

    $btn_1 = $vk->buttonText('1', 'blue', ['command' => 'Test_04_WEB_WEB_KIS_KIS_SAPR_SAPR_ASOIU']); 
    $btn_2 = $vk->buttonText('2', 'blue', ['command' => 'Test_04_KIS_KIS_ASOIU_INFOBES_SIPI']);              
    $btn_3 = $vk->buttonText('3', 'blue', ['command' => 'Test_04_INFOBES_IBAS_IBAS_SAPR']);              
    $btn_4 = $vk->buttonText('4', 'blue', ['command' => 'Test_04_INFOBES_INFOBES_IBAS_IBAS']);

    $btn_back = $vk->buttonText('К предыдущему вопросу', 'white', ['command' => 'goback_04']);
            
    $vk->sendButton($peer_id, "Вы работаете в компании и вас попросили разработать систему оповещения сотрудников. Каким способом вы бы решили данную проблему?", [[$btn_1, $btn_2], [$btn_3, $btn_4], [$btn_back, $btn_exit]]);
    $vk->sendMessage($peer_id, "1) Разработать приложение для передачи сообщений по интернету.\n2) Найти людей, которые уже делали подобные системы, и договориться о реализации у вас в фирме.\n3) Объединить компьютеры в одну сеть и написать приложение для передачи данных по локальной сети.\n4) Будем использовать защищенные протоколы связи.");
            
}
            
function Q5($vk, $peer_id, $btn_exit){ 

    $btn_1 = $vk->buttonText('1', 'blue', ['command' => 'Test_05_KIS_KIS_BIGD_BIGD']); 
    $btn_2 = $vk->buttonText('2', 'blue', ['command' => 'Test_05_CT_CT_ITUB_ITUB']);              
    $btn_3 = $vk->buttonText('3', 'blue', ['command' => 'Test_05_SIPI_SIPI_ASOIU_ASOIU_ITUB_ITUB_WEB_CT']);              
    $btn_4 = $vk->buttonText('4', 'blue', ['command' => 'Test_05_ITUB_ITUB_ASOIU_INFOBES_INFOBES']);

    $btn_back = $vk->buttonText('К предыдущему вопросу', 'white', ['command' => 'goback_05']);
                       
    $vk->sendButton($peer_id, "Вы заведуете большим отделом компании. Начальник просит от вас ответ по эффективности сотрудников. Ваши действия?", [[$btn_1, $btn_2], [$btn_3, $btn_4], [$btn_back, $btn_exit]]);
    $vk->sendMessage($peer_id, "1) Сформировать отчет с помощью запроса к базе данных.\n2) Узнать у неэффективных сотрудников причины и сформировать отчет основываясь на личном восприятии.\n 3) Написать программу по подсчету эффективности сотрудников.\n4) Убедить руководителя провести внешний аудит.");
                
}
                
function Q6($vk, $peer_id, $btn_exit){   

    $btn_1 = $vk->buttonText('1', 'blue', ['command' => 'Test_06_GAMEDEV_GAMEDEV_ITVMID_ITVMID_SIPI_SAPR']);       
    $btn_2 = $vk->buttonText('2', 'blue', ['command' => 'Test_06_INFOBES_INFOBES_IBAS_IBAS']);                         
    $btn_3 = $vk->buttonText('3', 'blue', ['command' => 'Test_06_GAMEDEV_GAMEDEV_ITVMID_ITVMID']);                         
    $btn_4 = $vk->buttonText('4', 'blue', ['command' => 'Test_06_CT_CT_ITUB_ITUB_ASOIU']);               
    $btn_5 = $vk->buttonText('5', 'blue', ['command' => 'Test_06_VR_VR']);

    $btn_back = $vk->buttonText('К предыдущему вопросу', 'white', ['command' => 'goback_06']);
                                  
    $vk->sendButton($peer_id, "Тебе сказали сделать с командой игру для телефонов, Выбери какую роль в разработке ты будешь выполнять", [[$btn_1, $btn_2], [$btn_3, $btn_4], [$btn_5], [$btn_back, $btn_exit]]);               
    $vk->sendMessage($peer_id, "1) Ты хочешь писать для игры код и заниматься физикой игры, прописывать скрипты, делать игровые модели.\n2) Ты хотел бы заняться защитой игры, чтобы её трудней было кому-то взломать.\n3) Ты бы хотел работать с графикой или заниматься дизайном мира игры.\n4) Ты бы хотел анализировать рынок и выбирать направление развития.\n5) Ты хочешь принять участие в разработке отдельного режима для VR, который ты сам можешь протестировать.");
}
                    
function Q7($vk, $peer_id, $btn_exit){

    $btn_1 = $vk->buttonText('1', 'blue', ['command' => 'Test_07_INFOBES_INFOBES_ASOIU_ASOIU']);          
    $btn_2 = $vk->buttonText('2', 'blue', ['command' => 'Test_07_ISUP_ISUP_ASOIU_ASOIU_SIPI']);                            
    $btn_3 = $vk->buttonText('3', 'blue', ['command' => 'Test_07_ITUB_ITUB_CT_CT_BIGD']);                    
    $btn_4 = $vk->buttonText('4', 'blue', ['command' => 'Test_07_WEB_WEB_ASOIU_ISUP']);                 
    $btn_5 = $vk->buttonText('5', 'blue', ['command' => 'Test_07_GAMEDEV_GAMEDEV_ITVMID_ITVMID']);

    $btn_back = $vk->buttonText('К предыдущему вопросу', 'white', ['command' => 'goback_07']);
                     
    $vk->sendButton($peer_id, "У тебя появилась идея написать вместе с группой друзей книгу. Выбери один из вариантов, который ты хотел бы выполнить сам", [[$btn_1, $btn_2], [$btn_3, $btn_4], [$btn_5], [$btn_back, $btn_exit]]);              
    $vk->sendMessage($peer_id, "1) Ты занимаешься защитой книги от пиратства.\n2) Ты бы написал ИИ, который напишет книгу за вас.\n3) Ты бы хотел заняться подсчётом того, сколько нужно денег на выпуск книги.\n4) Ты хочешь создать сайт, где размещалась бы книга или где её можно было бы купить в электронном виде.\n5) Ты создаёшь игру-квест в которой будут все события книги.");                
}

function Q8($vk, $peer_id, $btn_exit){

    $btn_1 = $vk->buttonText('1', 'blue', ['command' => 'Test_08_WEB_WEB_INFOBES_IBAS_IBAS_ASOIU_SIPI']);         
    $btn_2 = $vk->buttonText('2', 'blue', ['command' => 'Test_08_ISUP_ISUP_ASOIU_ASOIU_SIPI']);                           
    $btn_3 = $vk->buttonText('3', 'blue', ['command' => 'Test_08_SAPR_SAPR_GAMEDEV']);                   
    $btn_4 = $vk->buttonText('4', 'blue', ['command' => 'Test_08_CT_CT_ITUB_ITUB_BIGD_BIGD_ASOIU']);                 
    $btn_5 = $vk->buttonText('5', 'blue', ['command' => 'Test_08_INFOBES_INFOBES_IBAS_IBAS_KIBS_KIBS_ISUP_ISUP']);
    $btn_6 = $vk->buttonText('6', 'blue', ['command' => 'Test_08_KIBS_KIBS_SAPR_SAPR_GAMEDEV']);

    $btn_back = $vk->buttonText('К предыдущему вопросу', 'white', ['command' => 'goback_08']);
                     
    $vk->sendButton($peer_id, "Тебе и группе людей дали возможность сделать автомобиль, Выбери один из вариантов, что ты хотел бы сделать для этого.", [[$btn_1, $btn_2], [$btn_3, $btn_4], [$btn_5, $btn_6], [$btn_back, $btn_exit]]);              
    $vk->sendMessage($peer_id, "1) Ты делаешь безопасный сайт, на котором будет возможность посмотреть характеристики и купить автомобиль.\n2) Ты хотел бы сделать автомобиль с автопилотом.\n3) Ты хочешь создать модель машины в компьютере и протестировать её, а потом на основе такой модели сделать реальную.\n4) Ты хочешь узнать какие машины щас более востребованные и их особенности.\n5) Ты хочешь защитить автопилот автомобиля от взлома и несанкционированного доступа.\n6) Ты хочешь построить машинку на радиоуправлении.");                
}

function Q9($vk, $peer_id, $btn_exit){

    $btn_1 = $vk->buttonText('1', 'blue', ['command' => 'Test_09_WEB_WEB_BIGD_BIGD_ASOIU']);         
    $btn_2 = $vk->buttonText('2', 'blue', ['command' => 'Test_09_GAMEDEV_GAMEDEV_ITVMID_ITVMID']);                           
    $btn_3 = $vk->buttonText('3', 'blue', ['command' => 'Test_09_INFOBES_INFOBES_IBAS_IBAS']);                   
    $btn_4 = $vk->buttonText('4', 'blue', ['command' => 'Test_09_VR_VR_ITVMID']);                 
    $btn_5 = $vk->buttonText('5', 'blue', ['command' => 'Test_09_KIS_KIS_ITVMID_SAPR']);

    $btn_back = $vk->buttonText('К предыдущему вопросу', 'white', ['command' => 'goback_09']);
                     
    $vk->sendButton($peer_id, "Ты с группой людей основываешь компанию, которая хочет улучшить свой город. Выбери из ответов тот, который тебе больше интересен из всех." , [[$btn_1, $btn_2], [$btn_3, $btn_4], [$btn_5], [$btn_back, $btn_exit]]);              
    $vk->sendMessage($peer_id, "1) Вы создаёте защищённый сайт города для того, чтобы узнать мнение людей.\n2) Вы создаёте городостроительный симулятор, в котором можешь управлять своим городом и продолжать его строительство.\n3) Вы доработаете систему безопасности камер и светофоров от взломов.\n4) Вы делаете VR проект, в котором можешь прогуляться по городу.\n5) Вы делаете приложение карт общественного транспорта для своего города, в котором можно посмотреть, где находится транспорт и время прибытия.");              
}

function Q10($vk, $peer_id, $btn_exit){

    $btn_1 = $vk->buttonText('1', 'blue', ['command' => 'Test_10_GAMEDEV_GAMEDEV_SIPI_SIPI_CT_ASOIU_ASOIU_ISUP_SAPR_SAPR_KOPR']);         
    $btn_2 = $vk->buttonText('2', 'blue', ['command' => 'Test_10_WEB_WEB_ITVMID_SAPR_ITUB_ITUB_ASOIU_KOPR']);                           
    $btn_3 = $vk->buttonText('3', 'blue', ['command' => 'Test_10_ISUP_ISUP_KIS_KIS_ITVMID']);                                  
    $btn_4 = $vk->buttonText('4', 'blue', ['command' => 'Test_10_ITUB_ITUB_CT']);

    $btn_back = $vk->buttonText('К предыдущему вопросу', 'white', ['command' => 'goback_10']);
                     
    $vk->sendButton($peer_id, "Ты хочешь создать сайт или приложение. Выбери один из вариантов того, какой сайт ты будешь делать." , [[$btn_1, $btn_2], [$btn_3, $btn_4], [$btn_back, $btn_exit]]);              
    $vk->sendMessage($peer_id, "1) Ты хочешь сделать калькулятор для высокоточных вычислений.\n2) Ты делаешь сайт для нового маркетплейса/по объявлению.\n3) Приложение для поиска потерянного телефона по его номеру и включенной геолокацией.\n4) Ты ищешь человека, который реализует задуманное.");              
}

function Q11($vk, $peer_id, $btn_exit){

    $btn_1 = $vk->buttonText('1', 'blue', ['command' => 'Test_11_WEB_INFOBES_INFOBES']);         
    $btn_2 = $vk->buttonText('2', 'blue', ['command' => 'Test_11_GAMEDEV_GAMEDEV_ITVMID_ITVMID']);                           
    $btn_3 = $vk->buttonText('3', 'blue', ['command' => 'Test_11_ITUB_ITUB_CT_KIS']);                                  
    $btn_4 = $vk->buttonText('4', 'blue', ['command' => 'Test_11_SAPR_SAPR_KIS']);

    $btn_back = $vk->buttonText('К предыдущему вопросу', 'white', ['command' => 'goback_11']);
                     
    $vk->sendButton($peer_id, "Тебя отправили на небольшое время на завод, на нём у тебя есть возможность его как-то улучшить или увеличить персонал. Выбери один из вариантов ответа, который больше хотелось бы тебе изменить." , [[$btn_1, $btn_2], [$btn_3, $btn_4], [$btn_back, $btn_exit]]);              
    $vk->sendMessage($peer_id, "1) Ты создаёшь защищённый сайт для работы, где можно посмотреть информацию о заводе и подать документы для устройства на работу.\n2) Ты делаешь игру, в которой ты можешь побыть работником этого завода и понять, как там проходит рабочий день.\n3) Ты работаешь над программой, просчитывающим самую эффективную трату денег из всех вариантов для завода.\n4) Ты разрабатываешь программу работникам завода для подробной информации об оборудовании и правилах эксплуатации.");              
}


function Q12($vk, $peer_id, $btn_exit){

    $btn_1 = $vk->buttonText('1', 'blue', ['command' => 'Test_12_GAMEDEV_GAMEDEV_SIPI_SIPI_CT_ASOIU_ASOIU_ISUP_WEB_WEB_SAPR_SAPR_ITUB_KIBS_KIS']);         
    $btn_2 = $vk->buttonText('2', 'blue', ['command' => 'Test_12_ITVMID_KIS_VR']);                           
    $btn_3 = $vk->buttonText('3', 'blue', ['command' => 'Test_12_BIGD_BIGD_SIPI_ASOIU_ISUP_KIS']);                                  
    $btn_4 = $vk->buttonText('4', 'blue', ['command' => 'Test_12_KIBS_KIBS']);
    $btn_5 = $vk->buttonText('5', 'blue', ['command' => 'Test_12_IBAS_IBAS_INFOBES_INFOBES_ISUP_ITUB']);

    $btn_back = $vk->buttonText('К предыдущему вопросу', 'white', ['command' => 'goback_12']);
                     
    $vk->sendButton($peer_id, "Что из перечисленного вам наиболее знакомо и (или) чем вам больше всего понравилось заниматься? " , [[$btn_1, $btn_2], [$btn_3, $btn_4], [$btn_5], [$btn_back, $btn_exit]]);              
    $vk->sendMessage($peer_id, "1) Программирование на различных языках.\n2) Цифровое моделирование и проектирование.\n3) Настройка и работа с базами данных.\n4) Робототехника.\n5) Защищать информацию.");              
}

function Q13($vk, $peer_id, $btn_exit){

    $btn_1 = $vk->buttonText('1', 'blue', ['command' => 'Test_13_BIGD_BIGD_ASOIU_ISUP_KIS']);         
    $btn_2 = $vk->buttonText('2', 'blue', ['command' => 'Test_13_SIPI_SIPI_WEB_CT']);                           
    $btn_3 = $vk->buttonText('3', 'blue', ['command' => 'Test_13_CT_ITUB_BIGD_BIGD']);

    $btn_back = $vk->buttonText('К предыдущему вопросу', 'white', ['command' => 'goback_13']);
                     
    $vk->sendButton($peer_id, "Вы работаете в компании и ваш коллега попросил вас помочь выбрать себе телефон. Ваши дальнейшие действия?" , [[$btn_1, $btn_2], [$btn_3], [$btn_back, $btn_exit]]);              
    $vk->sendMessage($peer_id, "1) Создать таблицу и отсортировать ее по техническим спецификациям и цене.\n2) Написать программу, собирающую отзывы с сайтов.\n3) Узнать у своих друзей и знакомых мнения насчет их телефонов и собрать список.");              
}

function Q14($vk, $peer_id, $btn_exit){

    $btn_1 = $vk->buttonText('1', 'blue', ['command' => 'Test_14_INFOBES_INFOBES_IBAS_IBAS_SAPR']);         
    $btn_2 = $vk->buttonText('2', 'blue', ['command' => 'Test_14_WEB_WEB_ASOIU']);                           
    $btn_3 = $vk->buttonText('3', 'blue', ['command' => 'Test_14_KIBS_KIBS_SAPR_ASOIU_ASOIU_SIPI_SIPI_ISUP']);                                  
    $btn_4 = $vk->buttonText('4', 'blue', ['command' => 'Test_14_ITUB_ITUB_CT']);

    $btn_back = $vk->buttonText('К предыдущему вопросу', 'white', ['command' => 'goback_14']);
                     
    $vk->sendButton($peer_id, "Вы работаете в компании, занимающейся информационными услугами, начальство спросило у вас, что вам хотелось бы улучшить в работе компании? " , [[$btn_1, $btn_2], [$btn_3, $btn_4], [$btn_back, $btn_exit]]);              
    $vk->sendMessage($peer_id, "1) Поднять уровень безопасности в компании путем введения биометрии.\n2) Оптимизировать работу сайта под большое количество пользователей.\n3) Спроектировать дронов для доставки товаров на дом.\n4) Улучшить систему повышений в компании.");              
}

function Q15($vk, $peer_id, $btn_exit){

    $btn_1 = $vk->buttonText('1', 'blue', ['command' => 'Test_15_WEB_WEB_ITVMID_SAPR_ITUB_ITUB']);         
    $btn_2 = $vk->buttonText('2', 'blue', ['command' => 'Test_15_ITUB_ITUB_CT_CT']);                           
    $btn_3 = $vk->buttonText('3', 'blue', ['command' => 'Test_15_GAMEDEV_GAMEDEV_SIPI_SIPI_CT_ASOIU_ASOIU_ISUP_SAPR_SAPR_KIS']);                                  
    $btn_4 = $vk->buttonText('4', 'blue', ['command' => 'Test_15_INFOBES_INFOBES_IBAS_IBAS']);

    $btn_back = $vk->buttonText('К предыдущему вопросу', 'white', ['command' => 'goback_15']);
                     
    $vk->sendButton($peer_id, "Вы студент ВУЗа, вы вместе с однокурсниками решили создать свой проект. Какую роль вы бы предпочли исполнять в вашем совместном проекте?" , [[$btn_1, $btn_2], [$btn_3, $btn_4], [$btn_back, $btn_exit]]);              
    $vk->sendMessage($peer_id, "1) Создавать сайт.\n2) Заниматься рекламой проекта.\n3) Программировать приложение.\n4) Заняться безопасностью проекта.");              
}

function Q16($vk, $peer_id, $btn_exit){

    $btn_1 = $vk->buttonText('1', 'blue', ['command' => 'Test_16_VR_VR_SIPI_CT_ASOIU_KIS']);         
    $btn_2 = $vk->buttonText('2', 'blue', ['command' => 'Test_16_SAPR_SAPR_VR_SIPI_SIPI']);                           
    $btn_3 = $vk->buttonText('3', 'blue', ['command' => 'Test_16_INFOBES_INFOBES_IBAS_IBAS']);                                  
    $btn_4 = $vk->buttonText('4', 'blue', ['command' => 'Test_16_KIBS_KIBS_ASOIU_ASOIU_SIPI_SIPI_SAPR_ISUP']);

    $btn_back = $vk->buttonText('К предыдущему вопросу', 'white', ['command' => 'goback_16']);
                     
    $vk->sendButton($peer_id, "Вас попросили найти решение для тех кто может потеряться в лесу. Ваши действия?" , [[$btn_1, $btn_2], [$btn_3, $btn_4], [$btn_back, $btn_exit]]);              
    $vk->sendMessage($peer_id, "1) Создать приложение, с помощью которого можно будет определить съедобные грибы с помощью камеры.\n2) Создать приложение, которое помечает пройденный путь произвольной линией.\n3) Поставить глушилки связи, чтобы потерялся не ты один :-):-):-)\n4) Сконструировать дронов-квадрокоптеров, оборудованных GPS трекером, патрулирующих леса и сообщающих о найденных сигналах");              
}

function Q17($vk, $peer_id, $btn_exit){

    $btn_1 = $vk->buttonText('1', 'blue', ['command' => 'Test_17_GAMEDEV_GAMEDEV_SIPI_VR_ITVMID_ITVMID']);         
    $btn_2 = $vk->buttonText('2', 'blue', ['command' => 'Test_17_WEB_WEB_ITVMID_SAPR_ITUB_ITUB']);                           
    $btn_3 = $vk->buttonText('3', 'blue', ['command' => 'Test_17_ITUB_ITUB_CT_ITVMID_SIPI']);                                  
    $btn_4 = $vk->buttonText('4', 'blue', ['command' => 'Test_17_ISUP_ISUP_BIGD_SIPI_ASOIU_KIBS_KIBS']);
    $btn_5 = $vk->buttonText('5', 'blue', ['command' => 'Test_17_ISUP_ISUP_KIBS_SAPR']);

    $btn_back = $vk->buttonText('К предыдущему вопросу', 'white', ['command' => 'goback_17']);
                     
    $vk->sendButton($peer_id, "Для чего больше Вы бы хотели изучать языки программирования?" , [[$btn_1, $btn_2], [$btn_3, $btn_4], [$btn_5], [$btn_back, $btn_exit]]);              
    $vk->sendMessage($peer_id, "1) Под различные игровые платформы.\n2) Разработка веб-сайтов.\n3) Для реализации собственных идей.\n4) Для разработки умных устройств.\n5) Прикладное программирование микроконтроллеров.");              
}

function Q18($vk, $peer_id, $btn_exit){

    $btn_1 = $vk->buttonText('1', 'blue', ['command' => 'Test_18_GAMEDEV_GAMEDEV_ITVMID_ITVMID_VR_VR_SIPI_SIPI_ASOIU_ASOIU_ISUP_ISUP_BIGD_BIGD_WEB_WEB_SAPR_SAPR_IBAS_IBAS']);         
    $btn_2 = $vk->buttonText('2', 'blue', ['command' => 'Test_18_INFOBES_INFOBES_KIBS_KIS']);                           
    $btn_3 = $vk->buttonText('3', 'blue', ['command' => 'Test_18_ITUB_ITUB_KIS_KIS_CT']);                                  
    $btn_4 = $vk->buttonText('4', 'blue', ['command' => 'Test_18_KIS_KIS_ITUB']);

    $btn_back = $vk->buttonText('К предыдущему вопросу', 'white', ['command' => 'goback_18']);
                     
    $vk->sendButton($peer_id, "Привлекает ли Вас работа с документацией?" , [[$btn_1, $btn_2], [$btn_3, $btn_4], [$btn_back, $btn_exit]]);              
    $vk->sendMessage($peer_id, "1) Только для учебных целей.\n2) Для разработки технологической и эксплуатационной документации.\n3) Сбор, анализ и документирование требований заказчика, разработка технической документации для проекта.\n4) Проектная документация.");              
}

function Q19($vk, $peer_id, $btn_exit){

    $btn_1 = $vk->buttonText('1', 'blue', ['command' => 'Test_19_VR_VR_GAMEDEV_SAPR_SAPR_ITVMID_ITVMID']);         
    $btn_2 = $vk->buttonText('2', 'blue', ['command' => 'Test_19_KIS_KIS']);                           
    $btn_3 = $vk->buttonText('3', 'blue', ['command' => 'Test_19_BIGD_BIGD_SIPI_ASOIU_ISUP_KIS']);                                  
    $btn_4 = $vk->buttonText('4', 'blue', ['command' => 'Test_19_ISUP_ISUP_ASOIU_ASOIU_SIPI']);
    $btn_5 = $vk->buttonText('5', 'blue', ['command' => 'Test_19_INFOBES_INFOBES_IBAS_IBAS']);

    $btn_back = $vk->buttonText('К предыдущему вопросу', 'white', ['command' => 'goback_19']);
                     
    $vk->sendButton($peer_id, "Что из перечисленного привлекает Вас больше всего?" , [[$btn_1, $btn_2], [$btn_3, $btn_4], [$btn_5], [$btn_back, $btn_exit]]);              
    $vk->sendMessage($peer_id, "1) Заниматься 3D и 2D моделированием.\n2) Тестировать приложения.\n3) Заниматься анализом больших потоков данных.\n4) Работать с нейросетями и системами искусственного интеллекта.\n5) Защищать важную информацию.");              
}

function Q20($vk, $peer_id, $btn_exit){

    $btn_1 = $vk->buttonText('Да', 'blue', ['command' => 'Test_20_ITUB_ITUB_CT_CT']);         
    $btn_2 = $vk->buttonText('Нет', 'blue', ['command' => 'Test_20_GAMEDEV_ITVMID_VR_SIPI_INFOBES_ASOIU_ISUP_BIGD_WEB_SAPR_IBAS_KIBS_KIS']);  

    $btn_back = $vk->buttonText('К предыдущему вопросу', 'white', ['command' => 'goback_20']);                         
                     
    $vk->sendButton($peer_id, "Хотите ли Вы решать бизнес задачи компании?" , [[$btn_1, $btn_2], [$btn_back, $btn_exit]]);              
              
}

function Q21($vk, $peer_id, $btn_exit){

    $btn_1 = $vk->buttonText('1', 'blue', ['command' => 'Test_21_GAMEDEV_GAMEDEV_ITVMID']);         
    $btn_2 = $vk->buttonText('2', 'blue', ['command' => 'Test_21_VR_VR']);                           
    $btn_3 = $vk->buttonText('3', 'blue', ['command' => 'Test_21_INFOBES_INFOBES_IBAS_IBAS']);                                  
    $btn_4 = $vk->buttonText('4', 'blue', ['command' => 'Test_21_WEB_WEB_ASOIU_ISUP_SAPR']);
    $btn_5 = $vk->buttonText('5', 'blue', ['command' => 'Test_21_SIPI_WEB_ASOIU_BIGD_BIGD']);

    $btn_back = $vk->buttonText('К предыдущему вопросу', 'white', ['command' => 'goback_21']);
                     
    $vk->sendButton($peer_id, "На Ваш взгляд, какой из видов проектирования вам подходит больше?" , [[$btn_1, $btn_2], [$btn_3, $btn_4], [$btn_5], [$btn_back, $btn_exit]]);              
    $vk->sendMessage($peer_id, "1) Проектирование компьютерных игр.\n2) Проектирование приложений дополненной и виртуальной реальности.\n3) Проектирование систем защиты информации.\n4) Проектирование веб-страницы.\n5) Проектирование баз данных.");              
}

function Q22($vk, $peer_id, $btn_exit){

    $vk->sendButton($peer_id, "Вы завершили тест! Поздравляем." , [[$btn_exit]]);  

    $fileredactor1 = file_get_contents('tests/'.$peer_id.".txt");

    $napravleniya = array('WEB', 'ASOIU', 'SAPR', 'ITVMID', 'KIS', 'INFOBES', 'IBAS', 'BIGD', 'ITUB', 'SIPI', 'CT', 'ISUP', 'KIBS', 'GAMEDEV', 'VR');
    $array = array(
        array(
            'sku' => 'Веб-разработка',
            'count' => ''
        ),
        array(
            'sku' => 'Автоматизированные системы обработки информации и управления',
            'count' => ''
        ),
        array(
            'sku' => 'Интеграция и программирование в САПР',
            'count' => ''
        ),
        array(
            'sku' => 'Информационные технологии в медиаиндустрии и дизайне',
            'count' => ''
        ),
        array(
            'sku' => 'Корпоративные информационные системы',
            'count' => ''
        ),
        array(
            'sku' => 'Информационная безопасность',
            'count' => ''
        ),
        array(
            'sku' => 'Информационная безопасность автоматизированных систем',
            'count' => ''
        ),
        array(
            'sku' => 'Большие и открытые данные',
            'count' => ''
        ),
        array(
            'sku' => 'Информационные технологии управления бизнесом',
            'count' => ''
        ),
        array(
            'sku' => 'Системная и программная инженерия',
            'count' => ''
        ),
        array(
            'sku' => 'Цифровая трансформация',
            'count' => ''
        ),
        array(
            'sku' => 'Информационные системы умных пространств',
            'count' => ''
        ),
        array(
            'sku' => 'Киберфизические системы',
            'count' => ''
        ),
        array(
            'sku' => 'Программное обеспечение игровой компьютерной индустрии',
            'count' => ''
        ),
        array(
            'sku' => 'Технологии дополненной и виртуальной реальности',
            'count' => ''
        )
    );
    for($i = 0; $i<15; $i++){
    $array[$i]['count'] = substr_count($fileredactor1, $napravleniya[$i]);
    }

    function cmp_function_desc($a, $b){
        return ($a['count'] < $b['count']);
    }
    uasort($array, 'cmp_function_desc');

     $vk->sendMessage($peer_id, "Мы подобрали для вас топ 5 специальностей, на которые вы можете подать документы!"); 
     $i =0;
    foreach($array as $val) {
        $i++;
        $vk->sendMessage($peer_id, $i.". ".$val['sku']."."); 
        if($i>4){
            break;
        }
    }
      
                             
}

//Веб-разработка - WEB
//Автоматизированные системы обработки информации и управления  - ASOIU 
//Интеграция и программирование в САПР - SAPR
//Информационные технологии в медиаиндустрии и дизайне - ITVMID
//Корпоративные информационные системы - KIS
//Информационная безопасность - INFOBES
//Информационная безопасность автоматизированных систем - IBAS
//Большие и открытые данные - BIGD
//Информационные технологии управления бизнесом - ITUB
//Системная и программная инженерия - SIPI
//Цифровая трансформация - CT
//Информационные системы умных пространств - ISUP
//Киберфизические системы - KIBS
//Программное обеспечение игровой компьютерной индустрии - GAMEDEV
//Технологии дополненной и виртуальной реальности - VR






/*
function Checkbox($vk, $peer_id){

    $btn_1 = $vk->buttonText('1', 'green', ['command' => 'Check_btn1_KIS_1']);
    $btn_2 = $vk->buttonText('2', 'green', ['command' => 'Check_btn2_INFOBES_1']);
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
        $btn_2 = $vk->buttonText('2', 'green', ['command' => $payload.'Check_btn2_INFOBES_1']);
    }else{
    $payload2 = substr_replace($payload, 'Checked', strpos($payload, 'Check_btn2'), 5);
        $btn_2 = $vk->buttonText('2', 'red', ['command' => $payload2]);
    }
}else{
        $btn_2 = $vk->buttonText('2', 'green', ['command' => $payload.'Check_btn2_INFOBES_1']);
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
}
*/


if (str_contains($payload, 'Test')){

    $fileredactor1 = file_get_contents('tests/'.$peer_id.".txt");
    if(str_contains($fileredactor1, "FLOOD")){
        $vk->sendMessage($peer_id, ":-( Ты нарушил правила. Как только напишешь 'Извини', я разрешу тебе продолжить!");
    }else{

if(str_contains($fileredactor1, ''.substr($payload, 5, 2))){
    $vk->sendMessage($peer_id, ":-( Ты слишком быстро нажимаешь на кнопку! Я вынужден завершить твой тест, постарайся больше так не делать! Как только ты напишешь 'Извини', я разрешу тебе продолжить!");
    
    $fileredactor = fopen('tests/'.$peer_id.".txt", "c");
    fseek($fileredactor, 0, SEEK_END); 
    fwrite($fileredactor, "FLOOD");
    fclose($fileredactor);
    
    
}else{

    $fileredactor = fopen('tests/'.$peer_id.".txt", "c");
    fseek($fileredactor, 0, SEEK_END); 
    fwrite($fileredactor, substr($payload, 4)); //обрезка Test
    fclose($fileredactor);

    $num1 = substr($payload, 5, 1);
    $num2 = substr($payload, 5, 2);
    if(str_contains($num1, '0')){
        $functionname = 'Q'.(substr($num2, 1)+1);
        if(function_exists($functionname)) {
            $functionname($vk, $peer_id, $btn_exit);
         }
    }else{
        $functionname = 'Q'.($num2+1);
        if(function_exists($functionname)) {
            $functionname($vk, $peer_id, $btn_exit);
         }
    }
}
}

}

?>