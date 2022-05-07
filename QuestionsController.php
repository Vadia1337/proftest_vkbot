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

    $vk->sendButton($peer_id, "Приветствую, предлагаю тебе пройти быстрый тест (16 вопросов), после я смогу подсказать тебе, на какую специальность лучше подать документы :-)", [[$btn_1]]);
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


/*
function Q1($vk, $peer_id){  // Вопр 1

$btn_1 = $vk->buttonText('1', 'blue', ['command' => 'Test_01_WEB_WEB_ASOIU_SAPR']); 
$btn_2 = $vk->buttonText('2', 'blue', ['command' => 'Test_01_ITVMID_ITVMID_KIS_SAPR']);             
$btn_3 = $vk->buttonText('3', 'blue', ['command' => 'Test_01_INFOBES_INFOBES_IBAS_IBAS_SAPR']);              
$btn_4 = $vk->buttonText('4', 'blue', ['command' => 'Test_01_BIGD_BIGD_ASOIU_ASOIU']);

$btn_exit = $vk->buttonText('Пройти заново', 'red', ['command' => 'btn_9']);

$vk->sendButton($peer_id, "Вас попросили разработать калькулятор. Какой из предложенных вариантов вы выберете?", [[$btn_1, $btn_2], [$btn_3, $btn_4], [$btn_exit]]);
$vk->sendMessage($peer_id, "1) Разработать веб-приложение, чтобы иметь доступ к калькулятору с любого устройства.\n2) Разработать мобильную версию приложения для использования калькулятора оффлайн.\n3) Разработать консольное приложение с повышенной отказоустойчивостью.\n4) Проанализирую и найду самый удобный калькулятор.");

}
*/

function Q1($vk, $peer_id){  // Вопр 2

    $btn_1 = $vk->buttonText('1', 'blue', ['command' => 'Test_01_ITUB_BIGD_BIGD_KIS_KIS']); 
    $btn_2 = $vk->buttonText('2', 'blue', ['command' => 'Test_01_WEB_WEB_SIPI_ASOIU_SAPR']);             
    $btn_3 = $vk->buttonText('3', 'blue', ['command' => 'Test_01_SIPI_ITVMID_ASOIU_SAPR_SAPR_KIS_ITUB_ITUB_WEB_CT']); 

    $btn_exit = $vk->buttonText('Пройти заново', 'red', ['command' => 'btn_9']);
    
    $vk->sendButton($peer_id, "Вопрос №1. Ваш знакомый увлекся бизнесом и просит вас посоветовать систему управления взаимоотношениями с клиентами для него. Ваши действия?", [[$btn_1, $btn_2], [$btn_3], [$btn_exit]]);
    $vk->sendMessage($peer_id, "1) Посоветовать вести учет в excel, пока он не поймет, какие именно возможности ему нужны.\n2) Посоветовать использовать готовые облачные решения.\n3) Предложите написать эту систему специально под его задачи.");
    
}

function Q2($vk, $peer_id, $btn_exit){ // Вопр 3
    $btn_1 = $vk->buttonText('1', 'blue', ['command' => 'Test_02_WEB_WEB_ITUB_ITVMID_ISUP_ISUP_SAPR_ASOIU_KIS_SIPI']);
    $btn_2 = $vk->buttonText('2', 'blue', ['command' => 'Test_02_INFOBES_INFOBES_ISUP_ISUP_IBAS_IBAS']);              
    $btn_3 = $vk->buttonText('3', 'blue', ['command' => 'Test_02_KIS_ISUP_ISUP_KIBS_KIBS']);              
    $btn_4 = $vk->buttonText('4', 'blue', ['command' => 'Test_02_SAPR_KIBS_KIBS_ASOIU']);

    $btn_back = $vk->buttonText('К предыдущему вопросу', 'white', ['command' => 'goback_02']);
        
    $vk->sendButton($peer_id, "Вопрос №2. Ваша бабушка постоянно теряет свой смартфон, и вы хотите ей помочь. Ваши действия?", [[$btn_1, $btn_2], [$btn_3, $btn_4], [$btn_back, $btn_exit]]);
    $vk->sendMessage($peer_id, "1) Напишите ей сайт для отслеживания телефона.\n2) Установите софт для отслеживания устройства GPS.\n3) Установите приложение, которое издает звуковой сигнал при определенных условиях.\n4) Спроектируете кнопку, которая отправляет сигнал на телефон по определенному протоколу.\n");
        
}

function Q3($vk, $peer_id, $btn_exit){ // Вопр 4

    $btn_1 = $vk->buttonText('1', 'blue', ['command' => 'Test_03_WEB_WEB_KIS_KIS_SAPR_SAPR_ASOIU_GAMEDEV']); 
    $btn_2 = $vk->buttonText('2', 'blue', ['command' => 'Test_03_KIS_KIS_ASOIU_INFOBES_SIPI']);              
    $btn_3 = $vk->buttonText('3', 'blue', ['command' => 'Test_03_INFOBES_IBAS_IBAS_SAPR']);              
    $btn_4 = $vk->buttonText('4', 'blue', ['command' => 'Test_03_INFOBES_INFOBES_IBAS_IBAS']);

    $btn_back = $vk->buttonText('К предыдущему вопросу', 'white', ['command' => 'goback_03']);
            
    $vk->sendButton($peer_id, "Вопрос №3. Вы работаете в компании и Вас попросили разработать систему оповещения сотрудников. Каким способом вы бы решили данную проблему?", [[$btn_1, $btn_2], [$btn_3, $btn_4], [$btn_back, $btn_exit]]);
    $vk->sendMessage($peer_id, "1) Разработать приложение для передачи сообщений по интернету.\n2) Найти людей, которые уже делали подобные системы, и договориться о реализации у вас в фирме.\n3) Объединить компьютеры в одну сеть и написать приложение для передачи данных по локальной сети.\n4) Будем использовать защищенные протоколы связи.");
            
}
            
function Q4($vk, $peer_id, $btn_exit){  // Вопр 5

    $btn_1 = $vk->buttonText('1', 'blue', ['command' => 'Test_04_KIS_KIS_BIGD_BIGD']); 
    $btn_2 = $vk->buttonText('2', 'blue', ['command' => 'Test_04_CT_CT_ITUB_ITUB']);              
    $btn_3 = $vk->buttonText('3', 'blue', ['command' => 'Test_04_SIPI_SIPI_ASOIU_ASOIU_ITUB_ITUB_WEB_CT']);              
    $btn_4 = $vk->buttonText('4', 'blue', ['command' => 'Test_04_ITUB_ITUB_ASOIU_INFOBES_INFOBES']);

    $btn_back = $vk->buttonText('К предыдущему вопросу', 'white', ['command' => 'goback_04']);
                       
    $vk->sendButton($peer_id, "Вопрос №4. Вы заведуете большим отделом компании. Начальник требует от вас ответ по эффективности сотрудников. Ваши действия?", [[$btn_1, $btn_2], [$btn_3, $btn_4], [$btn_back, $btn_exit]]);
    $vk->sendMessage($peer_id, "1) Сформировать отчет с помощью запроса к базе данных.\n2) Узнать у неэффективных сотрудников причины и сформировать отчет, основываясь на личном восприятии.\n 3) Написать программу по подсчету эффективности сотрудников.\n4) Убедить руководителя провести проверку эффективности сотрудников.");
                
}
                
function Q5($vk, $peer_id, $btn_exit){    // Вопр 6

    $btn_1 = $vk->buttonText('1', 'blue', ['command' => 'Test_05_GAMEDEV_GAMEDEV_GAMEDEV_ITVMID_ITVMID_SIPI_SAPR']);       
    $btn_2 = $vk->buttonText('2', 'blue', ['command' => 'Test_05_INFOBES_INFOBES_IBAS_IBAS']);                         
    $btn_3 = $vk->buttonText('3', 'blue', ['command' => 'Test_05_GAMEDEV_GAMEDEV_GAMEDEV_ITVMID_ITVMID']);                         
    $btn_4 = $vk->buttonText('4', 'blue', ['command' => 'Test_05_CT_CT_ITUB_ITUB_ASOIU']);               
    $btn_5 = $vk->buttonText('5', 'blue', ['command' => 'Test_05_VR_VR']);

    $btn_back = $vk->buttonText('К предыдущему вопросу', 'white', ['command' => 'goback_05']);
                                  
    $vk->sendButton($peer_id, "Вопрос №5. Вам сказали сделать с командой игру для телефонов. Выберите, какую роль в разработке Вы будете выполнять.", [[$btn_1, $btn_2], [$btn_3, $btn_4], [$btn_5], [$btn_back, $btn_exit]]);               
    $vk->sendMessage($peer_id, "1) Написать для игры код и заниматься физикой игры, прописывать скрипты, делать игровые модели.\n2) Заняться защитой игры, чтобы её трудней было кому-то взломать.\n3) Работать с графикой или заниматься дизайном мира игры.\n4) Анализировать рынок и выбирать направление развития.\n5) Принимать участие в разработке отдельного режима для VR, который Вы сами можете протестировать.");
}
                    
function Q6($vk, $peer_id, $btn_exit){ // Вопр 7

    $btn_1 = $vk->buttonText('1', 'blue', ['command' => 'Test_06_INFOBES_INFOBES_ASOIU_ASOIU']);          
    $btn_2 = $vk->buttonText('2', 'blue', ['command' => 'Test_06_ISUP_ISUP_ASOIU_ASOIU_SIPI']);                            
    $btn_3 = $vk->buttonText('3', 'blue', ['command' => 'Test_06_ITUB_ITUB_CT_CT_BIGD_BIGD']);                    
    $btn_4 = $vk->buttonText('4', 'blue', ['command' => 'Test_06_WEB_WEB_ASOIU_ISUP_ISUP']);                 
    $btn_5 = $vk->buttonText('5', 'blue', ['command' => 'Test_06_GAMEDEV_GAMEDEV_ITVMID_ITVMID']);

    $btn_back = $vk->buttonText('К предыдущему вопросу', 'white', ['command' => 'goback_06']);
                     
    $vk->sendButton($peer_id, "Вопрос №6. У Вас появилась идея написать вместе с группой друзей книгу. Выберите один из вариантов, который Вы хотели бы выполнить сам.", [[$btn_1, $btn_2], [$btn_3, $btn_4], [$btn_5], [$btn_back, $btn_exit]]);              
    $vk->sendMessage($peer_id, "1) Заниматься защитой книги от пиратства.\n2) Написать ИИ, который напишет книгу за вас.\n3) Заняться подсчётом того, сколько нужно денег на выпуск книги.\n4) Создать сайт, где размещалась бы книга или где её можно было бы купить в электронном виде.\n5) Создать игру-квест, в которой будут все события книги.");                
}

function Q7($vk, $peer_id, $btn_exit){  // Вопр 8

    $btn_1 = $vk->buttonText('1', 'blue', ['command' => 'Test_07_WEB_WEB_INFOBES_INFOBES_KIS_ITVMID_IBAS_IBAS_ASOIU_SIPI']);         
    $btn_2 = $vk->buttonText('2', 'blue', ['command' => 'Test_07_ISUP_ISUP_ASOIU_ASOIU_SIPI_KIBS_KIBS']);                           
    $btn_3 = $vk->buttonText('3', 'blue', ['command' => 'Test_07_SAPR_SAPR_GAMEDEV_VR']);                   
    $btn_4 = $vk->buttonText('4', 'blue', ['command' => 'Test_07_CT_CT_ITUB_ITUB_BIGD_BIGD_ASOIU']);                 
    $btn_5 = $vk->buttonText('5', 'blue', ['command' => 'Test_07_INFOBES_INFOBES_IBAS_IBAS_KIBS_KIBS_ISUP_ISUP']);
    $btn_6 = $vk->buttonText('6', 'blue', ['command' => 'Test_07_KIBS_KIBS_SAPR_SAPR_GAMEDEV']);

    $btn_back = $vk->buttonText('К предыдущему вопросу', 'white', ['command' => 'goback_07']);
                     
    $vk->sendButton($peer_id, "Вопрос №7. Вам и группе людей дали возможность сделать автомобиль. Выберите один из вариантов, что ты хотел бы сделать для этого.", [[$btn_1, $btn_2], [$btn_3, $btn_4], [$btn_5, $btn_6], [$btn_back, $btn_exit]]);              
    $vk->sendMessage($peer_id, "1) Сделать безопасный сайт, на котором будет возможность посмотреть характеристики и купить автомобиль.\n2) Сделать автомобиль с автопилотом.\n3) Создать модель машины в компьютере и протестировать её, а потом на основе такой модели сделать реальную.\n4) Узнать, какие машины сейчас более востребованы и их особенности.\n5) Защитить автопилот автомобиля от взлома и несанкционированного доступа.\n6) Построить машинку на радиоуправлении.");                
}

function Q8($vk, $peer_id, $btn_exit){ // Вопр 9

    $btn_1 = $vk->buttonText('1', 'blue', ['command' => 'Test_08_WEB_WEB_BIGD_BIGD_ASOIU']);         
    $btn_2 = $vk->buttonText('2', 'blue', ['command' => 'Test_08_GAMEDEV_GAMEDEV_GAMEDEV_ITVMID_ITVMID']);                           
    $btn_3 = $vk->buttonText('3', 'blue', ['command' => 'Test_08_INFOBES_INFOBES_IBAS_IBAS']);                   
    $btn_4 = $vk->buttonText('4', 'blue', ['command' => 'Test_08_VR_VR_ITVMID']);                 
    $btn_5 = $vk->buttonText('5', 'blue', ['command' => 'Test_08_KIS_KIS_ITVMID_SAPR_BIGD']);

    $btn_back = $vk->buttonText('К предыдущему вопросу', 'white', ['command' => 'goback_08']);
                     
    $vk->sendButton($peer_id, "Вопрос №8. Вы с группой людей основываешь компанию, которая хочет улучшить свой город. Выберите из ответов тот, который наиболее отражает Ваши интересы." , [[$btn_1, $btn_2], [$btn_3, $btn_4], [$btn_5], [$btn_back, $btn_exit]]);              
    $vk->sendMessage($peer_id, "1) Создать защищённый сайт города для того, чтобы узнать мнение людей.\n2) ВСоздать городостроительный симулятор, в котором можно управлять своим городом и продолжать его строительство.\n3) Доработать систему безопасности камер и светофоров от взломов.\n4) Создать VR проект,  с помощью которого можно прогуляться по городу.\n5) Создать приложение карт общественного транспорта для своего города, в котором можно посмотреть, где находится транспорт и время его прибытия.");              
}

function Q9($vk, $peer_id, $btn_exit){    // Вопр 10

    $btn_1 = $vk->buttonText('1', 'blue', ['command' => 'Test_09_GAMEDEV_SIPI_SIPI_CT_ASOIU_ASOIU_ISUP_SAPR_SAPR_KIS']);         
    $btn_2 = $vk->buttonText('2', 'blue', ['command' => 'Test_09_WEB_WEB_ITVMID_SAPR_ITUB_ITUB_ASOIU_ISUP_ISUP']);                           
    $btn_3 = $vk->buttonText('3', 'blue', ['command' => 'Test_09_ISUP_ISUP_GAMEDEV_ITVMID_ITVMID']);                                  
    $btn_4 = $vk->buttonText('4', 'blue', ['command' => 'Test_09_KIS_KIS_KIS_KIS_SIPI_SIPI_CT_ASOIU_ASOIU_ISUP_SAPR_SAPR']);
    $btn_5 = $vk->buttonText('5', 'blue', ['command' => 'Test_09_ITUB_ITUB_CT']);

    $btn_back = $vk->buttonText('К предыдущему вопросу', 'white', ['command' => 'goback_09']);
                     
    $vk->sendButton($peer_id, "Вопрос №9. Вы хотите создать сайт или приложение. Выберите один из вариантов того, какой сайт Вы будете делать." , [[$btn_1, $btn_2], [$btn_3, $btn_4], [$btn_5], [$btn_back, $btn_exit]]);              
    $vk->sendMessage($peer_id, "1) Создать калькулятор для высокоточных вычислений.\n2) Сделать сайт для нового маркетплейса/по объявлению.\n3) Создать приложение для поиска потерянного телефона по его номеру и включенной геолокацией.\n4) Создать приложение для коммуникаций и работы людей внутри компании.\n5) Найти человека, который реализует задуманное.");              
}

/*
function Q11($vk, $peer_id, $btn_exit){  // Вопр 11

    $btn_1 = $vk->buttonText('1', 'blue', ['command' => 'Test_11_WEB_INFOBES_INFOBES']);         
    $btn_2 = $vk->buttonText('2', 'blue', ['command' => 'Test_11_GAMEDEV_GAMEDEV_ITVMID_ITVMID']);                           
    $btn_3 = $vk->buttonText('3', 'blue', ['command' => 'Test_11_ITUB_ITUB_CT_KIS']);                                  
    $btn_4 = $vk->buttonText('4', 'blue', ['command' => 'Test_11_SAPR_SAPR_KIS']);

    $btn_back = $vk->buttonText('К предыдущему вопросу', 'white', ['command' => 'goback_11']);
                     
    $vk->sendButton($peer_id, "Тебя отправили на небольшое время на завод, на нём у тебя есть возможность его как-то улучшить или увеличить персонал. Выбери один из вариантов ответа, который больше хотелось бы тебе изменить." , [[$btn_1, $btn_2], [$btn_3, $btn_4], [$btn_back, $btn_exit]]);              
    $vk->sendMessage($peer_id, "1) Ты создаёшь защищённый сайт для работы, где можно посмотреть информацию о заводе и подать документы для устройства на работу.\n2) Ты делаешь игру, в которой ты можешь побыть работником этого завода и понять, как там проходит рабочий день.\n3) Ты работаешь над программой, просчитывающим самую эффективную трату денег из всех вариантов для завода.\n4) Ты разрабатываешь программу работникам завода для подробной информации об оборудовании и правилах эксплуатации.");              
}
*/


function Q10($vk, $peer_id, $btn_exit){   // Вопр 12

    $btn_1 = $vk->buttonText('1', 'blue', ['command' => 'Test_10_GAMEDEV_GAMEDEV_SIPI_SIPI_CT_ASOIU_ASOIU_ISUP_WEB_SAPR_SAPR_ITUB_KIBS_KIS']);         
    $btn_2 = $vk->buttonText('2', 'blue', ['command' => 'Test_10_ITVMID_KIS_KIS_VR_SAPR_SAPR']);                           
    $btn_3 = $vk->buttonText('3', 'blue', ['command' => 'Test_10_BIGD_BIGD_SIPI_ASOIU_ISUP_ISUP_KIS']);                                  
    $btn_4 = $vk->buttonText('4', 'blue', ['command' => 'Test_10_KIBS_KIBS_KIBS']);
    $btn_5 = $vk->buttonText('5', 'blue', ['command' => 'Test_10_IBAS_IBAS_INFOBES_INFOBES__ISUP_ISUP_ITUB']);

    $btn_back = $vk->buttonText('К предыдущему вопросу', 'white', ['command' => 'goback_10']);
                     
    $vk->sendButton($peer_id, "Вопрос №10. Что из перечисленного вам наиболее знакомо и (или) чем вам больше всего понравилось заниматься? " , [[$btn_1, $btn_2], [$btn_3, $btn_4], [$btn_5], [$btn_back, $btn_exit]]);              
    $vk->sendMessage($peer_id, "1) Программирование на различных языках.\n2) Цифровое моделирование и проектирование.\n3) Настройка и работа с базами данных.\n4) Робототехника.\n5) Защита информацию.");              
}

function Q11($vk, $peer_id, $btn_exit){ // Вопр 12

    $btn_1 = $vk->buttonText('1', 'blue', ['command' => 'Test_11_BIGD_BIGD_ASOIU_ISUP_KIS']);         
    $btn_2 = $vk->buttonText('2', 'blue', ['command' => 'Test_11_SIPI_SIPI_ITVMID_CT']);                           
    $btn_3 = $vk->buttonText('3', 'blue', ['command' => 'Test_11_CT_ITUB_BIGD_BIGD']);

    $btn_back = $vk->buttonText('К предыдущему вопросу', 'white', ['command' => 'goback_11']);
                     
    $vk->sendButton($peer_id, "Вопрос №11. Вы работаете в компании и ваш коллега попросил вас помочь выбрать себе телефон. Ваши дальнейшие действия?" , [[$btn_1, $btn_2], [$btn_3], [$btn_back, $btn_exit]]);              
    $vk->sendMessage($peer_id, "1) Создать таблицу с моделями телефонов и отсортировать ее по техническим спецификациям и цене.\n2) Написать программу, собирающую отзывы с сайтов.\n3) Узнать у своих друзей и знакомых мнения насчет их телефонов и собрать список.");              
}

function Q12($vk, $peer_id, $btn_exit){  // Вопр 14

    $btn_1 = $vk->buttonText('1', 'blue', ['command' => 'Test_12_INFOBES_INFOBES_IBAS_IBAS_SAPR']);         
    $btn_2 = $vk->buttonText('2', 'blue', ['command' => 'Test_12_WEB_KIS_ASOIU_BIGD']);                           
    $btn_3 = $vk->buttonText('3', 'blue', ['command' => 'Test_12_KIBS_KIBS_SAPR_ASOIU_SIPI_SIPI_ISUP']);                                  
    $btn_4 = $vk->buttonText('4', 'blue', ['command' => 'Test_12_ITUB_ITUB_CT']);
    $btn_5 = $vk->buttonText('5', 'blue', ['command' => 'Test_12_VR_VR_VR']);

    $btn_back = $vk->buttonText('К предыдущему вопросу', 'white', ['command' => 'goback_12']);
                     
    $vk->sendButton($peer_id, "Вопрос №12. Вы работаете в компании, которая занимается информационными услугами. Что Вам хотелось бы улучшить в работе компании? " , [[$btn_1, $btn_2], [$btn_3, $btn_4], [$btn_5], [$btn_back, $btn_exit]]);              
    $vk->sendMessage($peer_id, "1) Поднять уровень безопасности в компании путем введения биометрии.\n2) Оптимизировать работу сайта под большое количество пользователей.\n3) Спроектировать дронов для доставки товаров на дом.\n4) Улучшить систему повышений в компании.\n 5)Внедрить систему дополненной реальности для повышения производительности сотрудников.");              
}

function Q13($vk, $peer_id, $btn_exit){   // Вопр 15

    $btn_1 = $vk->buttonText('1', 'blue', ['command' => 'Test_13_WEB_WEB_ITVMID_SAPR_ITUB_ITUB']);         
    $btn_2 = $vk->buttonText('2', 'blue', ['command' => 'Test_13_ITUB_ITUB_CT_CT']);                           
    $btn_3 = $vk->buttonText('3', 'blue', ['command' => 'Test_13_GAMEDEV_GAMEDEV_ITVMID_ITVMID_SIPI_SIPI_CT_ASOIU_ASOIU_ISUP_ISUP_SAPR_SAPR_KIS_VR']);                                  
    $btn_4 = $vk->buttonText('4', 'blue', ['command' => 'Test_13_INFOBES_INFOBES_IBAS_IBAS']);

    $btn_back = $vk->buttonText('К предыдущему вопросу', 'white', ['command' => 'goback_13']);
                     
    $vk->sendButton($peer_id, "Вопрос №13. Вы - студент ВУЗа, вы вместе с однокурсниками решили создать свой проект. Какую роль Вы бы предпочли исполнять в вашем совместном проекте?" , [[$btn_1, $btn_2], [$btn_3, $btn_4], [$btn_back, $btn_exit]]);              
    $vk->sendMessage($peer_id, "1) Создавать сайт.\n2) Заниматься рекламой проекта.\n3) Написать приложение.\n4) Заняться безопасностью проекта.");              
}

function Q14($vk, $peer_id, $btn_exit){ // Вопр 16

    $btn_1 = $vk->buttonText('1', 'blue', ['command' => 'Test_14_VR_VR_VR_SIPI_ITVMID_ITMID_CT_ASOIU_KIS']);         
    $btn_2 = $vk->buttonText('2', 'blue', ['command' => 'Test_14_SAPR_SAPR_ITVMID_ITVMID_VR_VR_KIS_SIPI_SIPI_GAMEDEV']);                           
    $btn_3 = $vk->buttonText('3', 'blue', ['command' => 'Test_14_INFOBES_INFOBES_IBAS_IBAS_KIBS']);                                  
    $btn_4 = $vk->buttonText('4', 'blue', ['command' => 'Test_14_KIBS_KIBS_KIBS_ASOIU_ASOIU_SIPI_SIPI_SAPR_ISUP']);

    $btn_back = $vk->buttonText('К предыдущему вопросу', 'white', ['command' => 'goback_14']);
                     
    $vk->sendButton($peer_id, "Вопрос №14. Вас попросили найти решение для тех кто может потеряться в лесу. Ваши действия?" , [[$btn_1, $btn_2], [$btn_3, $btn_4], [$btn_back, $btn_exit]]);              
    $vk->sendMessage($peer_id, "1) Создать приложение, с помощью которого можно будет определить съедобные грибы с помощью камеры.\n2) Создать приложение, которое помечает пройденный путь произвольной линией.\n3) Поставить глушилки связи, чтобы потерялся не ты один.\n4) Сконструировать роботов, с GPS-трекерами, патрулирующих леса и сообщающих о найденных сигналах.");              
}

function Q15($vk, $peer_id, $btn_exit){   // Вопр 17

    $btn_1 = $vk->buttonText('1', 'blue', ['command' => 'Test_15_GAMEDEV_GAMEDEV_GAMEDEV_KIS_SIPI_VR_ITVMID_ITVMID']);         
    $btn_2 = $vk->buttonText('2', 'blue', ['command' => 'Test_15_WEB_WEB_ITVMID_SAPR_ITUB_ITUB_KIS']);                           
    $btn_3 = $vk->buttonText('3', 'blue', ['command' => 'Test_15_ITUB_ITUB_CT_ITVMID_ITVMID_SIPI']);                                  
    $btn_4 = $vk->buttonText('4', 'blue', ['command' => 'Test_15_ISUP_ISUP_BIGD_SIPI_ASOIU_KIBS_KIBS']);
    $btn_5 = $vk->buttonText('5', 'blue', ['command' => 'Test_15_ISUP_ISUP_KIBS_KIBS_SAPR']);

    $btn_back = $vk->buttonText('К предыдущему вопросу', 'white', ['command' => 'goback_15']);
                     
    $vk->sendButton($peer_id, "Вопрос №15. Для чего больше Вы бы хотели изучать языки программирования?" , [[$btn_1, $btn_2], [$btn_3, $btn_4], [$btn_5], [$btn_back, $btn_exit]]);              
    $vk->sendMessage($peer_id, "1) Под различные игровые платформы.\n2) Разработка веб-сайтов.\n3) Для реализации собственных идей.\n4) Для разработки умных устройств.\n5) Прикладное программирование микроконтроллеров.");              
}

/*
function Q18($vk, $peer_id, $btn_exit){   // Вопр 18

    $btn_1 = $vk->buttonText('1', 'blue', ['command' => 'Test_18_GAMEDEV_GAMEDEV_ITVMID_ITVMID_VR_VR_SIPI_SIPI_ASOIU_ASOIU_ISUP_ISUP_BIGD_BIGD_WEB_WEB_SAPR_SAPR_IBAS_IBAS']);         
    $btn_2 = $vk->buttonText('2', 'blue', ['command' => 'Test_18_INFOBES_INFOBES_KIBS_KIS']);                           
    $btn_3 = $vk->buttonText('3', 'blue', ['command' => 'Test_18_ITUB_ITUB_KIS_KIS_CT']);                                  
    $btn_4 = $vk->buttonText('4', 'blue', ['command' => 'Test_18_KIS_KIS_ITUB']);

    $btn_back = $vk->buttonText('К предыдущему вопросу', 'white', ['command' => 'goback_18']);
                     
    $vk->sendButton($peer_id, "Привлекает ли Вас работа с документацией?" , [[$btn_1, $btn_2], [$btn_3, $btn_4], [$btn_back, $btn_exit]]);              
    $vk->sendMessage($peer_id, "1) Только для учебных целей.\n2) Для разработки технологической и эксплуатационной документации.\n3) Сбор, анализ и документирование требований заказчика, разработка технической документации для проекта.\n4) Проектная документация.");              
}

function Q19($vk, $peer_id, $btn_exit){  // Вопр 19

    $btn_1 = $vk->buttonText('1', 'blue', ['command' => 'Test_19_VR_VR_GAMEDEV_SAPR_SAPR_ITVMID_ITVMID']);         
    $btn_2 = $vk->buttonText('2', 'blue', ['command' => 'Test_19_KIS_KIS']);                           
    $btn_3 = $vk->buttonText('3', 'blue', ['command' => 'Test_19_BIGD_BIGD_SIPI_ASOIU_ISUP_KIS']);                                  
    $btn_4 = $vk->buttonText('4', 'blue', ['command' => 'Test_19_ISUP_ISUP_ASOIU_ASOIU_SIPI']);
    $btn_5 = $vk->buttonText('5', 'blue', ['command' => 'Test_19_INFOBES_INFOBES_IBAS_IBAS']);

    $btn_back = $vk->buttonText('К предыдущему вопросу', 'white', ['command' => 'goback_19']);
                     
    $vk->sendButton($peer_id, "Что из перечисленного привлекает Вас больше всего?" , [[$btn_1, $btn_2], [$btn_3, $btn_4], [$btn_5], [$btn_back, $btn_exit]]);              
    $vk->sendMessage($peer_id, "1) Заниматься 3D и 2D моделированием.\n2) Тестировать приложения.\n3) Заниматься анализом больших потоков данных.\n4) Работать с нейросетями и системами искусственного интеллекта.\n5) Защищать важную информацию.");              
}
*/

function Q16($vk, $peer_id, $btn_exit){   // Вопр 20

    $btn_1 = $vk->buttonText('Да.', 'blue', ['command' => 'Test_16_ITUB_ITUB_CT_CT']);         
    $btn_2 = $vk->buttonText('Нет.', 'blue', ['command' => 'Test_16_GAMEDEV_ITVMID_VR_VR_SIPI_INFOBES_ASOIU_ISUP_BIGD_WEB_SAPR_IBAS_KIBS_KIBS_KIS']);  

    $btn_back = $vk->buttonText('К предыдущему вопросу', 'white', ['command' => 'goback_16']);                         
                     
    $vk->sendButton($peer_id, "Вопрос №16. Хотите ли Вы решать бизнес задачи компании?" , [[$btn_1, $btn_2], [$btn_back, $btn_exit]]);                 
              
}

/*
function Q21($vk, $peer_id, $btn_exit){  // Вопр 21

    $btn_1 = $vk->buttonText('1', 'blue', ['command' => 'Test_21_GAMEDEV_GAMEDEV_ITVMID']);         
    $btn_2 = $vk->buttonText('2', 'blue', ['command' => 'Test_21_VR_VR']);                           
    $btn_3 = $vk->buttonText('3', 'blue', ['command' => 'Test_21_INFOBES_INFOBES_IBAS_IBAS']);                                  
    $btn_4 = $vk->buttonText('4', 'blue', ['command' => 'Test_21_WEB_WEB_ASOIU_ISUP_SAPR']);
    $btn_5 = $vk->buttonText('5', 'blue', ['command' => 'Test_21_SIPI_WEB_ASOIU_BIGD_BIGD']);

    $btn_back = $vk->buttonText('К предыдущему вопросу', 'white', ['command' => 'goback_21']);
                     
    $vk->sendButton($peer_id, "На Ваш взгляд, какой из видов проектирования вам подходит больше?" , [[$btn_1, $btn_2], [$btn_3, $btn_4], [$btn_5], [$btn_back, $btn_exit]]);              
    $vk->sendMessage($peer_id, "1) Проектирование компьютерных игр.\n2) Проектирование приложений дополненной и виртуальной реальности.\n3) Проектирование систем защиты информации.\n4) Проектирование веб-страницы.\n5) Проектирование баз данных.");              
}
*/

function Q17($vk, $peer_id, $btn_exit){

    $vk->sendButton($peer_id, "Вы завершили тест! Поздравляем." , [[$btn_exit]]);  

    $fileredactor1 = file_get_contents('tests/'.$peer_id.".txt");

    $napravleniya = array('WEB', 'ASOIU', 'SAPR', 'ITVMID', 'KIS', 'INFOBES', 'IBAS', 'BIGD', 'ITUB', 'SIPI', 'CT', 'ISUP', 'KIBS', 'GAMEDEV', 'VR');
    $array = array(
        array(
            'sku' => 'Веб-разработка',
            'count' => '',
            'link' => 'https://mospolytech.ru/postupayushchim/programmy-obucheniya/bakalavriat/veb-tekhnologii/'
        ),
        array(
            'sku' => 'Автоматизированные системы обработки информации и управления',
            'count' => '',
            'link' => 'https://mospolytech.ru/postupayushchim/programmy-obucheniya/bakalavriat/avtomatizirovannye-sistemy-obrabotki-informatsii-i-upravleniya/'
        ),
        array(
            'sku' => 'Интеграция и программирование в САПР',
            'count' => '',
            'link' => 'https://mospolytech.ru/postupayushchim/programmy-obucheniya/bakalavriat/integratsiya-i-programmirovanie-v-sapr/'
        ),
        array(
            'sku' => 'Информационные технологии в медиаиндустрии и дизайне',
            'count' => '',
            'link' => 'https://mospolytech.ru/postupayushchim/programmy-obucheniya/bakalavriat/informatsionnye-tekhnologii-v-mediaindustrii-i-dizayne/'
        ),
        array(
            'sku' => 'Корпоративные информационные системы',
            'count' => '',
            'link' => 'https://mospolytech.ru/postupayushchim/programmy-obucheniya/bakalavriat/korporativnye-informatsionnye-sistemy/'
        ),
        array(
            'sku' => 'Информационная безопасность',
            'count' => '',
            'link' => 'https://mospolytech.ru/postupayushchim/programmy-obucheniya/bakalavriat/information-security-bakalavr/'
        ),
        array(
            'sku' => 'Информационная безопасность автоматизированных систем',
            'count' => '',
            'link' => 'https://mospolytech.ru/postupayushchim/programmy-obucheniya/bakalavriat/info-bezopasnost-raspredelennykh-info-sistem/'
        ),
        array(
            'sku' => 'Большие и открытые данные',
            'count' => '',
            'link' => 'https://mospolytech.ru/postupayushchim/programmy-obucheniya/bakalavriat/bolshie-i-otkrytye-dannye/'
        ),
        array(
            'sku' => 'Информационные технологии управления бизнесом',
            'count' => '',
            'link' => 'https://mospolytech.ru/postupayushchim/programmy-obucheniya/bakalavriat/informacionnye-tekhnologii-upravleniya-biznesom/'
        ),
        array(
            'sku' => 'Системная и программная инженерия',
            'count' => '',
            'link' => 'https://mospolytech.ru/postupayushchim/programmy-obucheniya/bakalavriat/sistemnaya-i-programmnaya-inzheneriya/'
        ),
        array(
            'sku' => 'Цифровая трансформация',
            'count' => '',
            'link' => 'https://mospolytech.ru/postupayushchim/programmy-obucheniya/bakalavriat/cifrovaya-transformaciya/'
        ),
        array(
            'sku' => 'Информационные системы умных пространств',
            'count' => '',
            'link' => 'https://mospolytech.ru/postupayushchim/programmy-obucheniya/bakalavriat/informacionnye-sistemy-umnykh-prostranstv/'
        ),
        array(
            'sku' => 'Киберфизические системы',
            'count' => '',
            'link' => 'https://mospolytech.ru/postupayushchim/programmy-obucheniya/bakalavriat/kiberfizicheskie-sistemy/'
        ),
        array(
            'sku' => 'Программное обеспечение игровой компьютерной индустрии',
            'count' => '',
            'link' => 'https://mospolytech.ru/postupayushchim/programmy-obucheniya/bakalavriat/programmnoe-obespechenie-igrovoy-kompyuternoy-industrii/'
        ),
        array(
            'sku' => 'Технологии дополненной и виртуальной реальности',
            'count' => '',
            'link' => 'https://mospolytech.ru/postupayushchim/programmy-obucheniya/bakalavriat/tekhnologii-dopolnennoy-i-virtualnoy-realnosti-v-mediaindustrii/'
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
        $text1 = $vk->buttonOpenLink('Подробнее...', ''.$val['link']);
        $vk->sendButton($peer_id, $i.". ".$val['sku'].".", [[$text1]], true);
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