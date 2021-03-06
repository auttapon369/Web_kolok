<?php
/* --------------------------------------------------------------------------------------- #PATH */
$_cfg_domain = "telekolok.com";
$_cfg_root = "http://www.".$_cfg_domain."/web/v5/";
$_cfg_ws_ip = "ws://".$_cfg_domain.":8100";

$_cfg_path = array
(
	"class"			=> $_cfg_path_root."package/class/",
	"css"				=> $_cfg_path_root."package/css/",
	"script"			=> $_cfg_path_root."package/script/",
	"page"			=> $_cfg_path_root."package/template/",
	"sys"				=> $_cfg_path_root."package/module/",
	"data"			=> $_cfg_path_root."data/",
	"img"				=> $_cfg_path_root."data/img/",
	"temp"			=> $_cfg_path_root."data/temp/",
	"download"		=> $_cfg_path_root."data/download/"
);

$_cfg_today = date('Y-m-d H:')."00";
$_cfg_day = date('Y-m-d');
$_cfg_time = date('H').":00";
$_d = explode('-', str_replace(' ', '-', $_cfg_today));
//$_t = explode(':', $_d[3]);
$_now = $_cfg_path['temp'].$_d[0]."/".(int)$_d[1]."/".(int)$_d[2]."/";
$_fixed = $_cfg_path['temp'];
//$_cfg_path_today = ( is_dir($_now) && count(scandir($_now)) > 2 ) ? $_now : $_fixed;
//$_cfg_path_root = "";
$dir1 = $_cfg_path['temp'];
$dir2 = $dir1.scan_auto($dir1)."/";
$dir3 = $dir2.scan_auto($dir2)."/";
$dir4 = $dir3.scan_auto($dir3)."/";
$_cfg_path_today = $dir4;
$_cfg_path_root = "";


function scan_auto($dir)
{
	if (is_dir($dir))
	{
  		if ($dh=opendir($dir))
		{
			$r = array();
    		while (($file = readdir($dh)) !== false)
			{
				if (is_numeric($file))
				{
     	 			array_push($r, $file);
				}
    		}
    		closedir($dh);
			return max($r);	
  		}
	}

	return false;
}


/* ------------------------------------------------------------------------------------ #CONNECT */
$_cfg_conn = array
(
	'host'		=> "192.168.102.12",
	'user'		=> "sa",
	'pass'		=> "ata+ee&c",
	'db'		=> "KOLOK",
	'sql'		=> 'ms'
);
$_cfg_tb = array
(
	'stn'				=> "[".$_cfg_conn['db']."].[dbo].[TM_STN]",
	'daily'				=> "[".$_cfg_conn['db']."].[dbo].[val]",
	'dailytime'		=> "[".$_cfg_conn['db']."].[dbo].[valtime]",
	'backup'			=> "[".$_cfg_conn['db']."].[dbo].[DATA_Backup]",
	'q'					=> "[".$_cfg_conn['db']."].[dbo].[WL2Q]",
	'user'				=> "[".$_cfg_conn['db']."].[dbo].[TBuser]",
	'door'				=> "[".$_cfg_conn['db']."].[dbo].[control]",
	'door_details'	=> "[".$_cfg_conn['db']."].[dbo].[control_log]"
);
$_cfg_cctv = array
(
	'ip'			=> $_cfg_domain,
	'user'		=> 'ftpcctv',
	'pass'		=> '123456',
	'path'		=> '/image_backup'
);
$_cfg_map = "6 101.95 11";
$_cfg_spot = "http://192.168.102.13/SpotlightService/Switch/";


global $_cfg_conn;

function connDB( $sql = null )
{
	global $_cfg_conn;

	$mode = ( empty($sql) ) ? $_cfg_conn['sql'] : $sql;

	if ( $mode == "odbc" )
	{
		$hosting = "Driver={SQL Server}; Server=$_cfg_conn[host]; Database=$_cfg_conn[db]";
		$conn = odbc_connect($hosting, $_cfg_conn['user'], $_cfg_conn['pass']);
	}
	else if ( $mode == "ms" )
	{
		$conn = mssql_connect($_cfg_conn['host'], $_cfg_conn['user'], $_cfg_conn['pass']);
	}
	else
	{
		$conn = false;
	}

	return $conn;
}


/* ------------------------------------------------------------------------------------ #CONTENT */
$_cfg_name = "โก-ลก";

$_cfg_key = "โครงการโทรมาตร, โทรมาตร, ลุ่มน้ำ".$_cfg_name.", ".$_cfg_name.", สถานการณ์น้ำ, Tkol.1 บ้านตาบา, Tkol.2 โรงเรียนบ้านปะลุกา, Tkol.3 บ้านบรือโมง, Tkol.4 สวนสิรินธร, Tkol.5 บ้านตอออ, Tkol.6 บ้านบางขุด, Tkol.7 บ้านบูเก๊ะตา, Tkol.8 เขตรักษาพันธุ์สัตว์ป่าฮาลา-บาลา, Tkol.9 บ้านราษฎร์พัฒนา, Tkol.10 โรงเรียนบ้านกรือซอ, Tkol.11 แว้ง, Tkol.12 บ้านบาโงมาแย, Tkol.13 อบต. กายูคละ, Tkol.14 บ้านกาวะ, Tkol.15 อบต. ริโก๋, Tkol.16 หน้า ทรบ. ปากคลองปาเสมัส, Tkol.17 ท้าย ทรบ. ปากคลองปาเสมัส, Tkol.18 ปตร.ปากคลองมูโนะ, Tkol.19 ปตร.ปลายคลองโต๊ะแดง, Tkol.20 บ้านลาแล, Tkol.21 บ้านไอบาตู, Tkol.22 บ้านใหม่, Tkol.23 บ้านโคกกูแว, Tkol.24ทรบ.คลองระบายสายที่ 13, Tkol.25 ปตร.ปูยู";

$_cfg_desc = "โครงการศึกษาวางระบบและติดตั้งระบบโทรมาตร เพื่อพยากรณ์น้ำและเตือนภัยลุ่มน้ำ".$_cfg_name;

$_cfg_title = "ลุ่มน้ำ".$_cfg_name." | ระบบโทรมาตร";

$_cfg_footer = "กรมชลประทาน 811 ถนนสามเสน แขวงถนนนครไชยศรี กทม. 10300 โทรศัพท์ 02-241-0020 ถึง 9";
$_cfg_footer .= "<BR><font color=red>* ระบบอยู่ในช่วงทดสอบและปรับแต่ง ข้อมูลยังไม่สามารถนำไปใช้ในการอ้างอิงได้</font>";

$_cfg_report_head = "ข้อมูลการตรวจวัดจากระบบโทรมาตร";

$_cfg_txt_load = "Loading...";
$_cfg_txt_error = "<BR>---- ไม่พบข้อมูล ----";

$_cfg_form_success = "<BR>บันทึกข้อมูลเรียบร้อยค่ะ, กำลังเปลี่ยนหน้า...";
$_cfg_form_error = "<BR>ไม่สามารถบันทึกข้อมูลได้, กำลังเปลี่ยนหน้า...";


/* ------------------------------------------------------------------- #MENU */
$_cfg_menu_path_1 = "./?page=";
$_cfg_menu_path_2 = "&view=";
$_cfg_menu_main = array
(
	'map' => array
	(
		'name'		=> "สถานการณ์ลุ่มน้ำ",
		'title'			=> "สถานการณ์ลุ่มน้ำ",
		'expand'		=> false,
		'function'		=> null,
		'link'			=> $_cfg_menu_path_1."map",
		'jump'			=> array('class'=>null, 'target'=>null),
		'display'		=> array('default'=>true, 'admin'=>true)
	),
	'station' => array
	(
		'name'		=> "สถานีโทรมาตร",
		'title'			=> "สถานีโทรมาตร",
		'expand'		=> true,
		'function'		=> "get_stn_list",
		'link'			=> "javascript:expand('station')",
		'jump'			=> array('class'=>"expand", 'target'=>null),
		'display'		=> array('default'=>true, 'admin'=>true)
	),
	'about' => array
	(
		'name'		=> "เกี่ยวกับโครงการ",
		'title'			=> "เกี่ยวกับโครงการ",
		'expand'		=> true,
		'function'		=> null,
		'link'			=> "javascript:expand('about')",
		'jump'			=> array('class'=>"expand", 'target'=>null),
		'display'		=> array('default'=>true, 'admin'=>true)
	),
	'report' => array
	(
		'name'		=> "รายงานสรุป",
		'title'			=> "รายงานสรุป",
		'expand'		=> true,
		'function'		=> null,
		'link'			=> "javascript:expand('report')",
		'jump'			=> array('class'=>"expand", 'target'=>null),
		'display'		=> array('default'=>true, 'admin'=>true)
	),
	'cctv' => array
	(
		'name'		=> 'CCTV',
		'title'			=> 'ภาพจากกล้อง CCTV',
		'expand'		=> false,
		'function'		=> null,
		'link'			=> $_cfg_menu_path_1."cctv",
		'jump'			=> array('class'=>null, 'target'=>null),
		'display'		=> array('default'=>true, 'admin'=>true)
	),
	'search' => array
	(
		'name'		=> "ข้อมูลโทรมาตร",
		'title'			=> "ค้นหาข้อมูลโทรมาตร",
		'expand'		=> false,
		'function'		=> null,
		'link'			=> $_cfg_menu_path_1."search",
		'jump'			=> array('class'=>null, 'target'=>null),
		'display'		=> array('default'=>true, 'admin'=>true)
	),
	/*'download' => array
	(
		'name'		=> "ดาวน์โหลด",
		'title'			=> "ดาวน์โหลด",
		'expand'		=> false,
		'function'		=> null,
		'link'			=> $_cfg_menu_path_1."download",
		'jump'			=> array('class'=>null, 'target'=>null),
		'display'		=> array('default'=>true, 'admin'=>true)
	),*/
	'panel' => array
	(
		'name'		=> "สำหรับเจ้าหน้าที่",
		'title'			=> "สำหรับเจ้าหน้าที่",
		'expand'		=> true,
		'function'		=> null,
		'link'			=> "javascript:expand('panel')",
		'jump'			=> array('class'=>"expand", 'target'=>null),
		'display'		=> array('default'=>false, 'admin'=>true)
	),
	'logout' => array
	(
		'name'		=> "ออกจากระบบ",
		'title'			=> "ออกจากระบบ",
		'expand'		=> false,
		'function'		=> null,
		'link'			=> $_cfg_menu_path_1."login&sign=out",
		'jump'			=> array('class'=>null, 'target'=>null),
		'display'		=> array('default'=>false, 'admin'=>true)
	),
	'login' => array
	(
		'name'		=> "เข้าสู่ระบบ",
		'title'			=> "เข้าสู่ระบบ",
		'expand'		=> false,
		'function'		=> null,
		'link'			=> $_cfg_menu_path_1."login",
		'jump'			=> array('class'=>null, 'target'=>null),
		'display'		=> array('default'=>true, 'admin'=>false)
	)
);

$_cfg_menu_sub = array
(
	'about' => array
	(
		'project' => array
		(
			'name'	=> 'ความเป็นมาของโครงการ',
			'title'		=> 'ความเป็นมาของโครงการ',
			'link'		=> $_cfg_menu_path_1."about".$_cfg_menu_path_2."project",
			'jump'		=> array('class'=>null, 'target'=>null)
		),
		'station' => array
		(
			'name'	=> 'รายละเอียดสถานีโทรมาตร',
			'title'		=> 'รายละเอียดสถานีโทรมาตร',
			'link'		=> $_cfg_menu_path_1."about".$_cfg_menu_path_2."station",
			'jump'		=> array('class'=>null, 'target'=>null)
		)
	),
	'report' => array
	(
		'now' => array
		(
			'name'	=> 'รายงานสรุปข้อมูลปัจจุบัน',
			'title'		=> 'รายงานสรุปข้อมูลปัจจุบัน',
			'link'		=> $_cfg_menu_path_1."report".$_cfg_menu_path_2."now",
			'jump'		=> array('class'=>null, 'target'=>null)
		),
		'board' => array
		(
			'name'	=> 'รายงานสรุปผลการพยากรณ์',
			'title'		=> 'รายงานสรุปผลการพยากรณ์',
			'link'		=> $_cfg_menu_path_1."report".$_cfg_menu_path_2."board",
			'jump'		=> array('class'=>null, 'target'=>null)
		),
		'basin' => array
		(
			'name'	=> "รายงานเตือนภัยลุ่มน้ำ",
			'title'		=> "รายงานเตือนภัยลุ่มน้ำ",
			'link'		=> "basin.php",
			'jump'		=> array('class'=>"new", 'target'=>"_blank")
		),
		'daily' => array
		(
			'name'	=> "รายงานสถานการณ์น้ำประจำวัน",
			'title'		=> "รายงานสถานการณ์น้ำประจำวัน",
			'link'		=> "daily.php",
			'jump'		=> array('class'=>"new", 'target'=>"_blank")
		)
	),
	'panel' => array
	(
		'station' => array
		(
			'name'	=> 'แก้ไขข้อมูลสถานี',
			'title'		=> 'ข้อมูลสถานีโทรมาตร',
			'link'		=> $_cfg_menu_path_1."panel".$_cfg_menu_path_2."station",
			'jump'		=> array('class'=>null, 'target'=>null)
		),
		'alarm' => array
		(
			'name'	=> 'แก้ไขค่าระดับเตือนภัย',
			'title'		=> 'ตั้งค่าระดับเตือนภัยลุ่มน้ำ',
			'link'		=> $_cfg_menu_path_1."panel".$_cfg_menu_path_2."alarm",
			'jump'		=> array('class'=>null, 'target'=>null)
		),
		'door' => array
		(
			'name'	=> 'ข้อมูลระยะยกบาน',
			'title'		=> 'การเก็บบันทึกข้อมูลระยะยกบาน (ปตร./ ทรบ.)',
			'link'		=> $_cfg_menu_path_1."panel".$_cfg_menu_path_2."door",
			'jump'		=> array('class'=>null, 'target'=>null)
		),
		'spot' => array
		(
			'name'	=> 'ตั้งค่าอุปกรณ์',
			'title'		=> 'การตั้งค่าอุปกรณ์',
			'link'		=> $_cfg_menu_path_1."panel".$_cfg_menu_path_2."spot",
			'jump'		=> array('class'=>null, 'target'=>null)
		)
	)
);


/* ---------------------------------------------------------------- #STATION */
$_cfg_station = array
(
	'MS' => array
	(
		'name'		=> 'สถานีควบคุมหลัก กรมชลประทาน สามเสน',
		'address'		=> 'ศูนย์ควบคุมระบบโทรมาตร ชั้น 2 อาคารอำนวยการ กรมชลประทาน สามเสน',
		'utm'			=> '663,840E 1,524,614N',
		'tool'			=> 'เครื่องแม่ข่าย 4 ชุด (SCADA Server, Flood Forecast Sever, Database Sever, Internet/Web Sever) เครื่องเวิร์คสเตชั่น 3 ชุด (SCADA View, FLOOD FORECAST View, Internet Sever) และอุปกรณ์บริวาร',
		'adsl'			=> 'ควบคุมการทำงานของสถานีโทรมาตรสนามและรับข้อมูลตรวจวัดจากสถานีโทรมาตรสนามผ่าน GPRS สำหรับเชื่อมโยงกับสถานีหลักย่อยใช้ ADSL Modem'
	),
	'SMS1' => array
	(
		'name'		=> 'สถานีหลักย่อย ศูนย์อุทกวิทยาและบริหารน้ำภาคใต้ จ.พัทลุง',
		'address'		=> 'ศูนย์อุทกวิทยาและบริหารน้ำภาคใต้ โครงการชลประทานพัทลุง ถนนราเมศวร์ ต.คูหาสวรรค์ อ.เมือง จ.พัทลุง',
		'utm'			=> '617,330E 841,076N',
		'tool'			=> "เครื่องเวิร์คสเตชั่น 1 ชุด (SCADA View)",
		'adsl'			=> "เชื่อมโยงกับสถานีหลัก ใช้ ADSL Modem"
	),
	'SMS2' => array
	(
		'name'		=> 'สถานีหลักย่อย สำนักชลประทานที่ 17 นราธิวาส',
		'address'		=> 'ศูนย์ประมวลวิเคราะห์สถานการณ์น้ำ โครงการชลประทานนราธิวาส เลขที่ 3/1 หมู่ที่ 3 ตำบลกะลุวอเหนือ อำเภอเมือง จังหวัดนราธิวาส ',
		'utm'			=> "6°24'36.2\"N 101°50'05.4\"E",
		'tool'			=> "เครื่องเวิร์คสเตชั่น 1 ชุด (SCADA View) และอุปกรณ์บริวาร",
		'adsl'			=> "เชื่อมโยงกับสถานีหลัก ใช้ ADSL Modem"
	),
	'SMS3' => array
	(
		'name'		=> 'สถานีหลักย่อย โครงการชลประทานนราธิวาส',
		'address'		=> 'โครงการชลประทานนราธิวาส เลขที่ 66 ถนนสุริยะประดิษฐ์ ตำบลบางนาค อำเภอเมือง จังหวัดนราธิวาส 96000',
		'utm'			=> "6°25'10.6\"N 101°48'55.8\"E",
		'tool'			=> "เครื่องเวิร์คสเตชั่น 1 ชุด (SCADA View)",
		'adsl'			=> "เชื่อมโยงกับสถานีหลัก ใช้ ADSL Modem"
	)
);


/* ------------------------------------------------------------------ #ABOUT */
$_cfg_about = array
(
	array
	(
		'title'			=>	'ที่มาของโครงการ',
		'content'		=>	array
								(
									'พื้นที่ลุ่มน้ำโก-ลก เป็นพื้นที่ชายแดนระหว่างประเทศไทย-สหพันธรัฐมาเลเซีย มีแม่น้ำโก-ลกเป็นแนวกั้นพรมแดนระหว่างประเทศ เมื่อถึงช่วงฤดูน้ำหลากมีปริมาณน้ำจำนวนมากไหลจากลำน้ำสาขาในพื้นที่อำเภอแว้ง อำเภอสุคิริน อำเภอสุไหงโก-ลกและจากสหพันธรัฐมาเลเซียมารวมกันที่แม่น้ำโก-ลก ประกอบกับปริมาณน้ำจากพรุโต๊ะแดงไหลผ่านพื้นที่ลุ่มน้ำโก-ลก ลงสู่ทะเลฝั่งอ่าวไทยทำให้ปริมาณน้ำในพื้นที่มีจำนวนมาก ไม่สามารถระบายลงสู่แม่น้ำโก-ลกจึงทำให้เกิดปริมาณน้ำท่วม โดยช่วงฤดูฝนในพื้นที่ลุ่มน้ำโก-ลกแบ่งพื้นที่เป็น 2 ช่วง ได้แก่ ช่วงที่รับลมมรสุมตะวันตกเฉียงใต้ซึ่งพัดพาเอาความชื้นจากทะเลอันดามันและมหาสมุทรอินเดียเข้ามา ทำให้มีปริมาณฝนตกชุกในเดือนพฤษภาคมถึงเดือนตุลาคม อีกช่วงหนึ่งคือช่วงที่รับลมมรสุมตะวันออกเฉียงเหนือซึ่งพัดเอาความชื้นจากอ่าวไทยเข้ามาทำให้มีปริมาณฝนตกชุกอีกในเดือนพฤศจิกายนถึงเดือนมกราคม อาจก่อให้เกิดอุทกภัยขึ้นในบริเวณต่าง ๆ ได้ ประกอบกับรูปแบบการใช้ที่ดินในสภาพปัจจุบันได้เกิดการเปลี่ยนแปลงไปค่อนข้างมาก เช่น สภาพป่าต้นน้ำลำธาร สภาพลำน้ำตื้นเขิน การสร้างอาคารกีดขวางทางไหลของน้ำ การเจริญเติบโตของแหล่งชุมชน ทำให้อุทกภัยที่เกิดขึ้นเป็นไปอย่างฉับพลันและมีความรุนแรงมากกว่าในสภาพอดีตโดยเฉพาะพื้นที่ใกล้ภูเขาอาจเกิดจากแผ่นดินถล่มจากปริมาณน้ำป่าไหลหลาก ก่อให้เกิดความสูญเสียทั้งชีวิตและทรัพย์สินเป็นจำนวนมากในแต่ละปี',

									'กรมชลประทาน ได้ตระหนักถึงความสำคัญของปัญหาอุทกภัยดังกล่าว จึงเห็นสมควรให้ดำเนินการจ้างเหมา "โครงการศึกษาวางระบบและติดตั้งระบบโทรมาตรเพื่อการพยากรณ์น้ำและเตือนภัยลุ่มน้ำโก-ลก" เพื่อใช้เป็นเครื่องมือประกอบการวางแผนบรรเทาปัญหาอุทกภัยและการแจ้งเตือนภัยและการเตรียมความพร้อมเพื่อรับสถานการณ์ดังกล่าว'
								),
		'list'			=>	null,
		'file'			=>	null,
		'img'			=>	'pic_about_1.jpg'
	),
	array
	(
		'title'			=>	'วัตถุประสงค์',
		'content'		=>	array
								(
									'เพื่อใช้ประกอบการวางแผนบรรเทาปัญหาอุทกภัย การแจ้งเตือนภัย และการเตรียมความพร้อมเพื่อรับสถานการณ์ทั้งในฤดูฝนและในฤดูแล้งในบริเวณพื้นที่เป้าหมาย ทั้งยังสามารถประยุกต์ใช้เป็นเครื่องมือ(Tools) ช่วยประกอบการตัดสินใจเพื่อการบริหารจัดการน้ำอย่างมีประสิทธิภาพเพิ่มมากยิ่งขึ้นและสามารถใช้สำหรับการติดตามและเฝ้าระวังการติดตามสถานการ์น้ำ นำข้อมูลจากการติดตามตรวจวัดไปประกอบการคำนวณของแบบจำลองทางคณิตศาสตร์ และนำผลการตรวจวัดและผลการคำนวณมาใช้ประกอบการบริหารจัดการน้ำภายในพื้นที่ลุ่มน้ำที่มีประสิทธิภาพและทันต่อสถานกาณ์ โดยมีวัตถุประสงค์ของโครงการ ประกอบด้วย'
								),
		'list'			=>	array
								(
									'ดำเนินการศึกษาวางระบบโทรมาตรให้ครอบคลุมพื้นที่ลุ่มน้ำ ตามหลักทางอุตุ-อุทกวิทยาสำหรับติดตามข้อมูลเพื่อบริหารจัดการน้ำ การดำเนินการระบบพยากรณ์น้ำประกอบการบริหารจัดการน้ำ ระบบการแจ้งเตือนภัยเพื่อประกอบการบริหารจัดการน้ำในพื้นที่ลุ่มน้ำโก-ลกให้มีประสิทธิภาพ',

									'นำเสนอและเตือนภัยสู่สาธารณะชน (Public Information System) ในรูปแบบของการนำเสนอผ่านเครือข่าย Internet และช่องทางอื่นที่เหมาะสม',

									'พัฒนาแบบจำลองทางคณิตศาตร์เพื่อประกอบการบริหารจัดการน้ำอย่างมีประสิทธิภาพ โดยแบบจำลองจะต้องสามารถรับข้อมูลจากระบบโทรมาตรเพื่อนำมาประกอบการคำนวณได้โดยอัตโนมัติ',
									
									'พัฒนาระบบช่วยตัดสินใจ (Decision Support System, DSS) สำหรับประกอบการบริหารจัดการน้ำทันต่อสถานการณ์ทั้งในฤดูฝนและฤดูแล้ง'
								),
		'file'			=>	null,
		'img'			=>	'pic_about_2.jpg'
	),
	array
	(
		'title'			=>	'องค์ประกอบหลักของระบบ',
		'content'		=>	array
								(
									'ใน ปี 2555 กรมชลประทานได้ดำเนินการเชื่อมโยงข้อมูล ระบบโทรมาตรของโครงการโทรมาตรลุ่มน้ำ'.$_cfg_name.' ให้จัดเก็บและแสดงผลแบบเวลาจริง พร้อมทั้งจัดหาโปรแกรม และพัฒนาระบบพยากรณ์และระบบ Website ขึ้นใหม่ โดยปฏิบัติการ ณ ศูนย์โทรมาตร กรมชลประทาน สามเสน กรุงเทพฯ ระบบโทรมาตรลุ่มน้ำ'.$_cfg_name.' มี 3 ส่วนหลัก ได้แก่ สถานีศูนย์ควบคุมหลัก สถานีหลักย่อย และสถานีสนาม'
								),
		'list'			=>	array
								(
									'สถานีศูนย์ควบคุมหลัก (Master Station) ซึ่งเป็นที่ตั้งของห้องควบคุมระบบโทรมาตร (Control Room) ตั้งอยู่ที่กรมชลประทาน สามเสน',

									'สถานีหลักย่อย (Sub-Master Station) ทำหน้าที่ติดตามและเฝ้าระวัง จำนวน 4 แห่ง ได้แก่
									<br>- '.$_cfg_station['SMS1']['name'].'
									<br>- '.$_cfg_station['SMS2']['name'].'
									<br>- '.$_cfg_station['SMS3']['name'].'',

									'สถานีสนาม (Remote Station) จำนวน 25 สถานี ประกอบด้วย
									<br>- สถานีวัดปริมาณน้ำฝนอย่างเดียว 7 สถานี
									<br>- สถานีวัดระดับน้ำอย่างเดียว 7 สถานี
									<br>- สถานีวัดปริมาณน้ำฝนและวัดระดับน้ำ 11 สถานี'
								),
		'file'			=>	null,
		'img'			=>	'pic_about_3.jpg'
	),
	array
	(
		'title'			=>	'รายชื่อสถานีโทรมาตร',
		'content'		=>	null,
		'list'			=>	null,
		'file'			=>	'table.php',
		'img'			=>	null
		//'img'			=>	'pic_map.jpg'
	)
);


/* ---------------------------------------------------------------- DATATYPE */
$_cfg_data_type = array
(
	'rf' => array("ปริมาณฝน", "มม."),
	'wl' => array("ระดับน้ำ", "ม.รทก."),
	'fl' => array("อัตราการไหล", "ลบ.ม./วินาที"),
	'ca' => array("ความจุลำน้ำ", "%")
);


/* ------------------------------------------------------------------ #LABEL */
$_cfg_label = array
(
	"stn"				=> "สถานี",
	"date"			=> "วันที่",
	"time"			=> "ช่วงเวลา",
	"type"			=> "ประเภท",
	"data"			=> "ข้อมูล",
	"format"			=> "รูปแบบ",
	"download"		=> "ดาวโหลด"
);


/* ----------------------------------------------------------------- #BUTTON */
$_cfg_btn = array
(
	"login"		=> "Sing In",
	"search"		=> "ค้นหา",
	"graph"		=> "แสดงกราฟ",
	"table"		=> "แสดงตาราง",
	"excel"		=> "Excel",
	"pdf"			=> "PDF"
);


/* ----------------------------------------------------------------- #SELECT */
$_cfg_select = array
(
	"time" => array
	(
		array(600, "เช้ามืด, 0:00-5:59 น.", ""),
		array(1900, "กลางวัน, 6:00-18:59 น.", "SELECTED"),
		array(2400, "กลางคืน, 19:00-23:59 น.", "")
	),
	"report" => array
	(
		array("f_15", "ราย 15 นาที", ""),
		array("f_hr", "รายชั่วโมง", ""),
		array("f_mean", "รายวัน-เฉลี่ย", ""),
		array("f_min", "รายวัน-ต่ำสุด", ""),
		array("f_max", "รายวัน-สูงสุด", "")
	)
);


/* ------------------------------------------------------------------ #LOGIN */
$_cfg_sign_form = array
(
	"id"		=> "ID",
	"pass"	=> "Password",
	"verify"	=> "Verify"
);
$_cfg_sign_ms = array
(
	"yes" => array
	(
		"ms" => "Logging in, Please wait.",
		"style" => "process fs_big fc_pri"
	),
	"no" => array
	(
		"ms" => "Username or Password incorrect, Please try again.",
		"style" => "process fs_big fc_danger"
	),
	"verify" => array
	(
		"ms" => "Verify incorrect.",
		"style" => "process fs_big fc_danger"
	)
);


/* ---------------------------------------------------------------------------------------- #XML */
$_cfg_xml = array
(
array("data/weather_report1.xml", 0),
array("data/weather_report2.xml", 1),
array("data/weather_report3.xml", 0),
array("data/weather_report4.xml", 1),
array("data/weather_report5.xml", 1),

//	array("http://www.tmd.go.th/xml/weather_report.php?StationNumber=48580", 0),
//	array("http://www.tmd.go.th/xml/weather_report.php?StationNumber=48583", 1),
//	array("http://www.tmd.go.th/xml/region_daily_forecast.php?RegionID=5", 0),
//	array("http://www.tmd.go.th/xml/region_daily_forecast.php?RegionID=6", 1),
//	array("http://www.tmd.go.th/xml/warning.php", 1)
);


/* --------------------------------------------------------------------------------------- #LINK */
$_cfg_link = array
(
	array
	(
		'name' => 'TMD',
		'link' => 'http://www.tmd.go.th/weather_map.php'
	),
	array
	(
		'name' => 'HAM',
		'link' => 'http://wx.hamweather.com/?country=th&state=&place=trang&from=wxdir'
	),
	array
	(
		'name' => 'WATER',
		'link' => 'http://water.rid.go.th'
	),
	array
	(
		'name' => 'HYDROLOGY',
		'link' => 'http://hydro-8.com'
	),
	array
	(
		'name' => 'RI17',
		'link' => 'http://irrigation.rid.go.th/rid17'
	),
	array
	(
		'name' => 'narathiv',
		'link' => 'http://ridceo.rid.go.th/narathiv'
	)
);


/* -------------------------------------------------------------------------------------- #BLOCK */
$_cfg_flow = array
(
	'Tkol.1',
	'Tkol.2',
	'Tkol.16',
	'Tkol.17',
	'Tkol.18',
	'Tkol.19',
	'Tkol.24',
	'Tkol.25'
);
$_cfg_block_cctv = array
(
	//'Tkol.x'
	
);
?>