<?php
$method = $_SERVER['REQUEST_METHOD'];
$arr = json_decode($_POST["name"], true);

//$file = 'people.txt';
//file_put_contents($file, $arr['Программное_обеспечение_игровой_компьютерной_индустрии']);

$napravleniya = array('Веб-технологии', 'Автоматизированные_системы_обработки_информации_и_управления', 'Интеграция_и_программирование_в_САПР', 'Информационные_технологии_в_медиаиндустрии_и_дизайне', 'Корпоративные_информационные_системы', 'Информационная_безопасность', 'Информационная_безопасность_автоматизированных_систем', 'Большие_и_открытые_данные', 'Информационные_технологии_управления_бизнесом', 'Системная_и_программная_инженерия', 'Цифровая_трансформация', 'Информационные_системы_умных_пространств', 'Киберфизические_системы', 'Программное_обеспечение_игровой_компьютерной_индустрии', 'Технологии_дополненной_и_виртуальной_реальности');

for($i = 0; $i<15; $i++){
	if($arr[$napravleniya[$i]] > 20){
		$arr[$napravleniya[$i]] = array_sum(str_split($arr[$napravleniya[$i]]));
	} 
}


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
    $array[$i]['count'] = $arr[$napravleniya[$i]];
    }

    function cmp_function_desc($a, $b){
        return ($a['count'] < $b['count']);
    }
    uasort($array, 'cmp_function_desc');
	
	$array = array_slice($array, 0, 5);
	$json = json_encode($array);
	echo $json;
?>