<!--<script type="text/javascript" src="../../js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="chart/highstock.js"></script>
<script type="text/javascript" src="chart/exporting.js"></script>-->

<?

$conn = connDB("odbc");

$tdt = explode("-",$datetime);
if($tdt[1]=='02' AND $tdt[2]>28)
{
	$info = cal_days_in_month( CAL_GREGORIAN , $tdt[1] , $tdt[0] ) ;
	$date2=$tdt[0]."-".$tdt[1]."-".$info;
}
if($tdt[1]=='04' AND $tdt[2]>30)
{
	$info = cal_days_in_month( CAL_GREGORIAN , $tdt[1] , $tdt[0] ) ;
	$date2=$tdt[0]."-".$tdt[1]."-".$info;
}
if($tdt[1]=='06' AND $tdt[2]>30)
{
	$info = cal_days_in_month( CAL_GREGORIAN , $tdt[1] , $tdt[0] ) ;
	$date2=$tdt[0]."-".$tdt[1]."-".$info;
}
if($tdt[1]=='09' AND $tdt[2]>30)
{
	$info = cal_days_in_month( CAL_GREGORIAN , $tdt[1] , $tdt[0] ) ;
	$date2=$tdt[0]."-".$tdt[1]."-".$info;
}
if($tdt[1]=='11' AND $tdt[2]>30)
{
	$info = cal_days_in_month( CAL_GREGORIAN , $tdt[1] , $tdt[0] ) ;
	$date2=$tdt[0]."-".$tdt[1]."-".$info;
}


$chcount = 0;
foreach($p_stn as $id)
{
	$_value = cut($id);
	$ssite = $_value[0];
	$nname = $_value[4];

	$s_rf = C_rf($_value[1],$p_rain);
	$s_wl = C_wl($_value[2],$p_water);
	$s_fl = C_fl($_value[3],$p_flow);

	$chcount++;
	//echo $ssite."-".$chcount."<BR>";
}

//$chcount = 0;

foreach ( $p_stn as $index => $value )
{
	$n = $index + 1;
	$arr = explode('-', $value);
	$x = explode('.', $arr[0]);

	$v1 = "Tk".$x[1];
	$$v1 = $arr[0];

	$v2 = "_namec".$x[1];
	$$v2 = $arr[1];

	$v3 = "_nrow".$x[1];
	$$v3 = str_replace('.', '', $arr[0]);

	$v4 = "cnumTk".$x[1];
	$$v4 = $n;

	//echo $_namec1."<br>";
}

if($p_rain=="Y")
{
	$nametype="กราฟ".$_cfg_data_type["rf"][0]; 
	$yname=$_cfg_data_type["rf"][1];
	$yaname=$_cfg_data_type["rf"][0]." ".$_cfg_data_type["rf"][1];
	$typess="column";
	$minva=0;
	$maxva=100;
    
	if($p_format=="f_15")
	{
		
			$p_date=date("Y-m-d",strtotime($p_day1));
			$maxZ= 3 * 60 * 60 * 1000;//3 * 3600000;
			$pointIn= 900 * 1000; // 15 min
			$mmdate=date("m",strtotime($p_day1))-1;
			$formatdd="%e. %B %Y %H:%M";
			$minva = $maxva = null;
			$a=15;
			$b=900;

			$strQuery = "SELECT CONVERT(varchar(16),DT,121) adate ";
						
				foreach($p_stn as $id)
				{
					$_value = cut($id);
					$ssite = $_value[0];
					$nname = $_value[4];

					$strQuery .=",Sum(case when STN_ID='".$ssite."' and sensor_id='100' then Value  end) RF_".$nname." ";
				}
				
				$strQuery .="FROM [dbo].[DATA_Backup]
					WHERE CONVERT(varchar(16),DT,121) between '".$p_day1." 00:00' and '".$p_day2." 23:45' AND (DATEPART(MINUTE ,DT))%15='0'
					GROUP BY CONVERT(varchar(16),DT,121)	ORDER BY CONVERT(varchar(16),DT,121)";
		
		$result = odbc_exec($conn,$strQuery);
		//$checkrow=mssql_num_rows($result);

		$stagearray=array();
		$wt_tk1=array();
		$wt_tk2=array();
		$wt_tk3=array();
		$wt_tk4=array();
		$wt_tk5=array();
		$wt_tk6=array();
		$wt_tk7=array();
		$wt_tk8=array();
		$wt_tk9=array();
		$wt_tk10=array();
		$wt_tk11=array();
		$wt_tk12=array();	
		$wt_tk13=array();
		$wt_tk14=array();
		$wt_tk15=array();
		$wt_tk16=array();
		$wt_tk17=array();
		$wt_tk18=array();
		$wt_tk19=array();
		$wt_tk20=array();
		$wt_tk21=array();
		$wt_tk22=array();
		$wt_tk23=array();
		$wt_tk24=array();
		$wt_tk25=array();
		
				$stadatey=date("Y",strtotime($p_day1));	
				$stadatem=date("m",strtotime($p_day1));	
				$stadated=date("d",strtotime($p_day1));

				$stadateh=date("H",strtotime($p_day1));
				$stadatei=date("i",strtotime($p_day1));
						
				$sm=$stadatey."-".$stadatem;
				
				if ($p_format=="f_15")
				{
					$stadate=strtotime($p_day1);
					$enddate=strtotime($p_day2)+86400;
				}
				else{}
		
				while($stadate < $enddate)
				{

					if ($row = odbc_fetch_array($result))
					{
						
						$sname=strtotime($row['adate']);
						
						while($stadate < $sname)
						{
							if(isset($Tk1))
							{ 
								array_push($wt_tk1,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk2))
							{ 
								array_push($wt_tk2,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk3))
							{ 
								array_push($wt_tk3,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk4))
							{ 
								array_push($wt_tk4,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk5))
							{ 
								array_push($wt_tk5,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk6))
							{ 
								array_push($wt_tk6,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk7))
							{ 
								array_push($wt_tk7,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk8))
							{ 
								array_push($wt_tk8,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk9))
							{ 
								array_push($wt_tk9,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk10))
							{ 
								array_push($wt_tk10,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk11))
							{ 
								array_push($wt_tk11,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk12))
							{ 
								array_push($wt_tk12,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk13))
							{ 
								array_push($wt_tk13,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk14))
							{ 
								array_push($wt_tk14,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk15))
							{ 
								array_push($wt_tk15,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk16))
							{ 
								array_push($wt_tk16,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk17))
							{ 
								array_push($wt_tk17,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk18))
							{ 
								array_push($wt_tk18,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk19))
							{ 
								array_push($wt_tk19,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk20))
							{ 
								array_push($wt_tk20,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk21))
							{ 
								array_push($wt_tk21,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk22))
							{ 
								array_push($wt_tk22,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk23))
							{ 
								array_push($wt_tk23,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk24))
							{ 
								array_push($wt_tk24,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk25))
							{ 
								array_push($wt_tk25,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}

							if ($p_format=="f_15")
							{
								$stadatei+=$a;
								$stadate+=$a*60;
							}
						
						}

						if(isset($Tk1))
						{ 
							if($row['RF_'.$_nrow1.'']==null){$val_tk1="null";}else{$val_tk1=$row['RF_'.$_nrow1.''];}
							array_push($wt_tk1,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk1."]");
						}
						if(isset($Tk2))
						{ 
							if($row['RF_'.$_nrow2.'']==null){$val_tk2="null";}else{$val_tk2=$row['RF_'.$_nrow2.''];}
							array_push($wt_tk2,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk2."]");
						}
						if(isset($Tk3))
						{ 
							if($row['RF_'.$_nrow3.'']==null){$val_tk3="null";}else{$val_tk3=$row['RF_'.$_nrow3.''];}
							array_push($wt_tk3,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk3."]");
						}
						if(isset($Tk4))
						{ 
							if($row['RF_'.$_nrow4.'']==null){$val_tk4="null";}else{$val_tk4=$row['RF_'.$_nrow4.''];}
							array_push($wt_tk4,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk4."]");
						}
						if(isset($Tk5))
						{ 
							if($row['RF_'.$_nrow5.'']==null){$val_tk5="null";}else{$val_tk5=$row['RF_'.$_nrow5.''];}
							array_push($wt_tk5,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk5."]");
						}
						if(isset($Tk6))
						{ 
							if($row['RF_'.$_nrow6.'']==null){$val_tk6="null";}else{$val_tk6=$row['RF_'.$_nrow6.''];}
							array_push($wt_tk6,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk6."]");
						}
						if(isset($Tk7))
						{ 
							if($row['RF_'.$_nrow7.'']==null){$val_tk7="null";}else{$val_tk7=$row['RF_'.$_nrow7.''];}
							array_push($wt_tk7,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk7."]");
						}
						if(isset($Tk8))
						{ 
							if($row['RF_'.$_nrow8.'']==null){$val_tk8="null";}else{$val_tk8=$row['RF_'.$_nrow8.''];}
							array_push($wt_tk8,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk8."]");
						}
						if(isset($Tk9))
						{ 
							if($row['RF_'.$_nrow9.'']==null){$val_tk9="null";}else{$val_tk9=$row['RF_'.$_nrow9.''];}
							array_push($wt_tk9,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk9."]");
						}
						if(isset($Tk10))
						{ 
							if($row['RF_'.$_nrow10.'']==null){$val_tk10="null";}else{$val_tk10=$row['RF_'.$_nrow10.''];}
							array_push($wt_tk10,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk10."]");
						}
						if(isset($Tk11))
						{ 
							if($row['RF_'.$_nrow11.'']==null){$val_tk11="null";}else{$val_tk11=$row['RF_'.$_nrow11.''];}
							array_push($wt_tk11,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk11."]");
						}
						if(isset($Tk12))
						{ 
							if($row['RF_'.$_nrow12.'']==null){$val_tk12="null";}else{$val_tk12=$row['RF_'.$_nrow12.''];}
							array_push($wt_tk12,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk12."]");
						}
						if(isset($Tk13))
						{ 
							if($row['RF_'.$_nrow13.'']==null){$val_tk13="null";}else{$val_tk13=$row['RF_'.$_nrow13.''];}
							array_push($wt_tk13,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk13."]");
						}
						if(isset($Tk14))
						{ 
							if($row['RF_'.$_nrow14.'']==null){$val_tk14="null";}else{$val_tk14=$row['RF_'.$_nrow14.''];}
							array_push($wt_tk14,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk14."]");
						}
						if(isset($Tk15))
						{ 
							if($row['RF_'.$_nrow15.'']==null){$val_tk15="null";}else{$val_tk15=$row['RF_'.$_nrow15.''];}
							array_push($wt_tk15,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk15."]");
						}
						if(isset($Tk16))
						{ 
							if($row['RF_'.$_nrow16.'']==null){$val_tk16="null";}else{$val_tk16=$row['RF_'.$_nrow16.''];}
							array_push($wt_tk16,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk16."]");
						}
						if(isset($Tk17))
						{ 
							if($row['RF_'.$_nrow17.'']==null){$val_tk17="null";}else{$val_tk17=$row['RF_'.$_nrow17.''];}
							array_push($wt_tk17,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk17."]");
						}
						if(isset($Tk18))
						{ 
							if($row['RF_'.$_nrow18.'']==null){$val_tk18="null";}else{$val_tk18=$row['RF_'.$_nrow18.''];}
							array_push($wt_tk18,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk18."]");
						}
						if(isset($Tk19))
						{ 
							if($row['RF_'.$_nrow19.'']==null){$val_tk19="null";}else{$val_tk19=$row['RF_'.$_nrow19.''];}
							array_push($wt_tk19,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk19."]");
						}
						if(isset($Tk20))
						{ 
							if($row['RF_'.$_nrow20.'']==null){$val_tk20="null";}else{$val_tk20=$row['RF_'.$_nrow20.''];}
							array_push($wt_tk20,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk20."]");
						}
						if(isset($Tk21))
						{ 
							if($row['RF_'.$_nrow21.'']==null){$val_tk21="null";}else{$val_tk21=$row['RF_'.$_nrow21.''];}
							array_push($wt_tk21,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk21."]");
						}
						if(isset($Tk22))
						{ 
							if($row['RF_'.$_nrow22.'']==null){$val_tk22="null";}else{$val_tk22=$row['RF_'.$_nrow22.''];}
							array_push($wt_tk22,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk22."]");
						}
						if(isset($Tk23))
						{ 
							if($row['RF_'.$_nrow23.'']==null){$val_tk23="null";}else{$val_tk23=$row['RF_'.$_nrow23.''];}
							array_push($wt_tk23,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk23."]");
						}
						if(isset($Tk24))
						{ 
							if($row['RF_'.$_nrow24.'']==null){$val_tk24="null";}else{$val_tk24=$row['RF_'.$_nrow24.''];}
							array_push($wt_tk24,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk24."]");
						}
						if(isset($Tk25))
						{ 
							if($row['RF_'.$_nrow25.'']==null){$val_tk25="null";}else{$val_tk25=$row['RF_'.$_nrow25.''];}
							array_push($wt_tk25,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk25."]");
						}

						if ($p_format=="f_15")
						{
							$stadatei+=$a;
							$stadate+=$a*60;
						}
					
					}
					else
					{
						if(isset($Tk1))
							{ 
								array_push($wt_tk1,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk2))
							{ 
								array_push($wt_tk2,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk3))
							{ 
								array_push($wt_tk3,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk4))
							{ 
								array_push($wt_tk4,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk5))
							{ 
								array_push($wt_tk5,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk6))
							{ 
								array_push($wt_tk6,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk7))
							{ 
								array_push($wt_tk7,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk8))
							{ 
								array_push($wt_tk8,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk9))
							{ 
								array_push($wt_tk9,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk10))
							{ 
								array_push($wt_tk10,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk11))
							{ 
								array_push($wt_tk11,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk12))
							{ 
								array_push($wt_tk12,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk13))
							{ 
								array_push($wt_tk13,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk14))
							{ 
								array_push($wt_tk14,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk15))
							{ 
								array_push($wt_tk15,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk16))
							{ 
								array_push($wt_tk16,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk17))
							{ 
								array_push($wt_tk17,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk18))
							{ 
								array_push($wt_tk18,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk19))
							{ 
								array_push($wt_tk19,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk20))
							{ 
								array_push($wt_tk20,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk21))
							{ 
								array_push($wt_tk21,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk22))
							{ 
								array_push($wt_tk22,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk23))
							{ 
								array_push($wt_tk23,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk24))
							{ 
								array_push($wt_tk24,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk25))
							{ 
								array_push($wt_tk25,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}

							if ($p_format=="f_15")
							{
								$stadatei+=$a;
								$stadate+=$a*60;
							}						
					}
				}
				
				if(isset($Tk1))
				{ 
					$ponts_Tk1=implode(",",$wt_tk1);
				}
				if(isset($Tk2))
				{ 
					$ponts_Tk2=implode(",",$wt_tk2);
				}
				if(isset($Tk3))
				{ 
					$ponts_Tk3=implode(",",$wt_tk3);
				}
				if(isset($Tk4))
				{ 
					$ponts_Tk4=implode(",",$wt_tk4);
				}
				if(isset($Tk5))
				{ 
					$ponts_Tk5=implode(",",$wt_tk5);
				}
				if(isset($Tk6))
				{ 
					$ponts_Tk6=implode(",",$wt_tk6);
				}
				if(isset($Tk7))
				{ 
					$ponts_Tk7=implode(",",$wt_tk7);
				}
				if(isset($Tk8))
				{ 
					$ponts_Tk8=implode(",",$wt_tk8);
				}
				if(isset($Tk9))
				{ 
					$ponts_Tk9=implode(",",$wt_tk9);
				}
				if(isset($Tk10))
				{ 
					$ponts_Tk10=implode(",",$wt_tk10);
				}
				if(isset($Tk11))
				{ 
					$ponts_Tk11=implode(",",$wt_tk11);
				}
				if(isset($Tk12))
				{ 
					$ponts_Tk12=implode(",",$wt_tk12);
				}
				if(isset($Tk13))
				{ 
					$ponts_Tk13=implode(",",$wt_tk13);
				}
				if(isset($Tk14))
				{ 
					$ponts_Tk14=implode(",",$wt_tk14);
				}
				if(isset($Tk15))
				{ 
					$ponts_Tk15=implode(",",$wt_tk15);
				}
				if(isset($Tk16))
				{ 
					$ponts_Tk16=implode(",",$wt_tk16);
				}
				if(isset($Tk17))
				{ 
					$ponts_Tk17=implode(",",$wt_tk17);
				}
				if(isset($Tk18))
				{ 
					$ponts_Tk18=implode(",",$wt_tk18);
				}
				if(isset($Tk19))
				{ 
					$ponts_Tk19=implode(",",$wt_tk19);
				}
				if(isset($Tk20))
				{ 
					$ponts_Tk20=implode(",",$wt_tk20);
				}
				if(isset($Tk21))
				{ 
					$ponts_Tk21=implode(",",$wt_tk21);
				}
				if(isset($Tk22))
				{ 
					$ponts_Tk22=implode(",",$wt_tk22);
				}
				if(isset($Tk23))
				{ 
					$ponts_Tk23=implode(",",$wt_tk23);
				}
				if(isset($Tk24))
				{ 
					$ponts_Tk24=implode(",",$wt_tk24);
				}
				if(isset($Tk25))
				{ 
					$ponts_Tk25=implode(",",$wt_tk25);
				}


			 if(isset($Tk1))
			   {
						 $se_Tk1='
								{
								type: "column",
								name: "'.$_namec1.'",
								data: ['.$ponts_Tk1.'],
								color: "#228B22",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}	
				
			   if(isset($Tk2))
			   {
						 $se_Tk2='
								{
								type: "column",
								name: "'.$_namec2.'",
								data: ['.$ponts_Tk2.'],
								color: "#528B8B",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk3))
			   {
						 $se_Tk3='
								{
								type: "column",
								name: "'.$_namec3.'",
								data: ['.$ponts_Tk3.'],
								color: "#A0522D",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk4))
			   {
						 $se_Tk4='
								{
								type: "column",
								name: "'.$_namec4.'",
								data: ['.$ponts_Tk4.'],
								color: "#483D8B",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk5))
			   {
						 $se_Tk5='
								{
								type: "column",
								name: "'.$_namec5.'",
								data: ['.$ponts_Tk5.'],
								color: "#000080",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk6))
			   {
						 $se_Tk6='
								{
								type: "column",
								name: "'.$_namec6.'",
								data: ['.$ponts_Tk6.'],
								color: "#8B658B",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk7))
			   {
						 $se_Tk7='
								{
								type: "column",
								name: "'.$_namec7.'",
								data: ['.$ponts_Tk7.'],
								color: "#CD9B9B",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk8))
			   {
						 $se_Tk8='
								{
								type: "column",
								name: "'.$_namec8.'",
								data: ['.$ponts_Tk8.'],
								color: "#CD5555",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk9))
			   {
						 $se_Tk9='
								{
								type: "column",
								name: "'.$_namec9.'",
								data: ['.$ponts_Tk9.'],
								color: "#CD6839",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk10))
			   {
						 $se_Tk10='
								{
								type: "column",
								name: "'.$_namec10.'",
								data: ['.$ponts_Tk10.'],
								color: "#CD2626",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk11))
			   {
						 $se_Tk11='
								{
								type: "column",
								name: "'.$_namec11.'",
								data: ['.$ponts_Tk11.'],
								color: "#EE9A00",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk12))
			   {
						 $se_Tk12='
								{
								type: "column",
								name: "'.$_namec12.'",
								data: ['.$ponts_Tk12.'],
								color: "#CD6600",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk13))
			   {
						 $se_Tk13='
								{
								type: "column",
								name: "'.$_namec13.'",
								data: ['.$ponts_Tk13.'],
								color: "#CD0000",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk14))
			   {
						 $se_Tk14='
								{
								type: "column",
								name: "'.$_namec14.'",
								data: ['.$ponts_Tk14.'],
								color: "#CD1076",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk15))
			   {
						 $se_Tk15='
								{
								type: "column",
								name: "'.$_namec15.'",
								data: ['.$ponts_Tk15.'],
								color: "#8B4789",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk16))
			   {
						 $se_Tk16='
								{
								type: "column",
								name: "'.$_namec16.'",
								data: ['.$ponts_Tk16.'],
								color: "#C71585",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk17))
			   {
						 $se_Tk17='
								{
								type: "column",
								name: "'.$_namec17.'",
								data: ['.$ponts_Tk17.'],
								color: "#ECAB53",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk18))
			   {
						 $se_Tk18='
								{
								type: "column",
								name: "'.$_namec18.'",
								data: ['.$ponts_Tk18.'],
								color: "#008080",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk19))
			   {
						 $se_Tk19='
								{
								type: "column",
								name: "'.$_namec19.'",
								data: ['.$ponts_Tk19.'],
								color: "#00BB00",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk20))
			   {
						 $se_Tk20='
								{
								type: "column",
								name: "'.$_namec20.'",
								data: ['.$ponts_Tk20.'],
								color: "#778899",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk21))
			   {
						 $se_Tk21='
								{
								type: "column",
								name: "'.$_namec21.'",
								data: ['.$ponts_Tk21.'],
								color: "#97FFFF",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk22))
			   {
						 $se_Tk22='
								{
								type: "column",
								name: "'.$_namec22.'",
								data: ['.$ponts_Tk22.'],
								color: "#FFE4B5",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk23))
			   {
						 $se_Tk23='
								{
								type: "column",
								name: "'.$_namec23.'",
								data: ['.$ponts_Tk23.'],
								color: "#4876FF",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk24))
			   {
						 $se_Tk24='
								{
								type: "column",
								name: "'.$_namec24.'",
								data: ['.$ponts_Tk24.'],
								color: "#B0E0E6",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk25))
			   {
						 $se_Tk25='
								{
								type: "column",
								name: "'.$_namec25.'",
								data: ['.$ponts_Tk25.'],
								color: "#7CFC00",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}

	}
	else if($p_format=="f_hr")
	{
			$p_date=date("Y-m-d",strtotime($p_day1));
			$maxZ= 3 * 60 * 60 * 1000;//3 * 3600000;
			$pointIn= 3600 * 1000; // 15 min
			$mmdate=date("m",strtotime($p_day1))-1;
			$formatdd="%e. %B %Y %H:%M";
			$minva = $maxva = null;
			$a=60;
			$b=3600;


			$start = strtotime($p_day1);
			$end = strtotime($p_day2)+86400;

			$wt_tk1=array();
			$wt_tk2=array();
			$wt_tk3=array();
			$wt_tk4=array();
			$wt_tk5=array();
			$wt_tk6=array();
			$wt_tk7=array();
			$wt_tk8=array();
			$wt_tk9=array();
			$wt_tk10=array();
			$wt_tk11=array();
			$wt_tk12=array();	
			$wt_tk13=array();
			$wt_tk14=array();
			$wt_tk15=array();
			$wt_tk16=array();
			$wt_tk17=array();
			$wt_tk18=array();
			$wt_tk19=array();
			$wt_tk20=array();
			$wt_tk21=array();
			$wt_tk22=array();
			$wt_tk23=array();
			$wt_tk24=array();
			$wt_tk25=array();

			for ( $tt = $start; $tt <= $end; $tt += 3600 )
			{	
				$dt=date("Y-m-d H:i",$tt);

				$starhour=date("Y-m-d H:15",strtotime('-1 hour',strtotime($dt)));
				$endhour=date("Y-m-d H:00",strtotime($dt));

				//echo $starhour."<BR>";
				//echo $endhour."<BR>";

				$sumrain = "SELECT Sum(case when STN_ID='' and sensor_id='' then Value end) aa";	
				foreach($p_stn as $id)
				{
					$_value = cut($id);
					$ssite = $_value[0];
					$nname = $_value[4];

					$sumrain .=" ,CONVERT(decimal(38,2),SUM(case when STN_ID='".$ssite."' and sensor_id='100' then Value  end)) vhour_".$nname." ";
				}					
				$sumrain .="FROM [dbo].[DATA_Backup] WHERE CONVERT(varchar(16),DT,121) between '".$starhour."' and '".$endhour."'";
					
				//echo $sumrain;
				$sumrf =odbc_exec($conn,$sumrain);
				
				//echo $dt."_";
				//echo $row['vhour_'.$_nrow2.'']."<BR>";
				
				$stadatey=date("Y",strtotime($dt));	
				$stadatem=date("m",strtotime($dt));	
				$stadated=date("d",strtotime($dt));
				$stadateh=date("H",strtotime($dt));
				$stadatei=date("i",strtotime($dt));
						
				$sm=$stadatey."-".$stadatem;

				$row=odbc_fetch_array($sumrf);

				if(isset($Tk1))
				{ 
					if($row['vhour_'.$_nrow1.'']==null){$val_tk1="null";}else{$val_tk1=$row['vhour_'.$_nrow1.''];}
					array_push($wt_tk1,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk1."]");
				}
				if(isset($Tk2))
				{ 
					if($row['vhour_'.$_nrow2.'']==null){$val_tk2="null";}else{$val_tk2=$row['vhour_'.$_nrow2.''];}
					array_push($wt_tk2,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk2."]");
				}
				if(isset($Tk3))
				{ 
					if($row['vhour_'.$_nrow3.'']==null){$val_tk3="null";}else{$val_tk3=$row['vhour_'.$_nrow3.''];}
					array_push($wt_tk3,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk3."]");
				}
				if(isset($Tk4))
				{ 
					if($row['vhour_'.$_nrow4.'']==null){$val_tk4="null";}else{$val_tk4=$row['vhour_'.$_nrow4.''];}
					array_push($wt_tk4,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk4."]");
				}
				if(isset($Tk5))
				{ 
					if($row['vhour_'.$_nrow5.'']==null){$val_tk5="null";}else{$val_tk5=$row['vhour_'.$_nrow5.''];}
					array_push($wt_tk5,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk5."]");
				}
				if(isset($Tk6))
				{ 
					if($row['vhour_'.$_nrow6.'']==null){$val_tk6="null";}else{$val_tk6=$row['vhour_'.$_nrow6.''];}
					array_push($wt_tk6,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk6."]");
				}
				if(isset($Tk7))
				{ 
					if($row['vhour_'.$_nrow7.'']==null){$val_tk7="null";}else{$val_tk7=$row['vhour_'.$_nrow7.''];}
					array_push($wt_tk7,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk7."]");
				}
				if(isset($Tk8))
				{ 
					if($row['vhour_'.$_nrow8.'']==null){$val_tk8="null";}else{$val_tk8=$row['vhour_'.$_nrow8.''];}
					array_push($wt_tk8,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk8."]");
				}
				if(isset($Tk9))
				{ 
					if($row['vhour_'.$_nrow9.'']==null){$val_tk9="null";}else{$val_tk9=$row['vhour_'.$_nrow9.''];}
					array_push($wt_tk9,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk9."]");
				}
				if(isset($Tk10))
				{ 
					if($row['vhour_'.$_nrow10.'']==null){$val_tk10="null";}else{$val_tk10=$row['vhour_'.$_nrow10.''];}
					array_push($wt_tk10,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk10."]");
				}
				if(isset($Tk11))
				{ 
					if($row['vhour_'.$_nrow11.'']==null){$val_tk11="null";}else{$val_tk11=$row['vhour_'.$_nrow11.''];}
					array_push($wt_tk11,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk11."]");
				}
				if(isset($Tk12))
				{ 
					if($row['vhour_'.$_nrow12.'']==null){$val_tk12="null";}else{$val_tk12=$row['vhour_'.$_nrow12.''];}
					array_push($wt_tk12,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk12."]");
				}
				if(isset($Tk13))
				{ 
					if($row['vhour_'.$_nrow13.'']==null){$val_tk13="null";}else{$val_tk13=$row['vhour_'.$_nrow13.''];}
					array_push($wt_tk13,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk13."]");
				}
				if(isset($Tk14))
				{ 
					if($row['vhour_'.$_nrow14.'']==null){$val_tk14="null";}else{$val_tk14=$row['vhour_'.$_nrow14.''];}
					array_push($wt_tk14,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk14."]");
				}
				if(isset($Tk15))
				{ 
					if($row['vhour_'.$_nrow15.'']==null){$val_tk15="null";}else{$val_tk15=$row['vhour_'.$_nrow15.''];}
					array_push($wt_tk15,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk15."]");
				}
				if(isset($Tk16))
				{ 
					if($row['vhour_'.$_nrow16.'']==null){$val_tk16="null";}else{$val_tk16=$row['vhour_'.$_nrow16.''];}
					array_push($wt_tk16,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk16."]");
				}
				if(isset($Tk17))
				{ 
					if($row['vhour_'.$_nrow17.'']==null){$val_tk17="null";}else{$val_tk17=$row['vhour_'.$_nrow17.''];}
					array_push($wt_tk17,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk17."]");
				}
				if(isset($Tk18))
				{ 
					if($row['vhour_'.$_nrow18.'']==null){$val_tk18="null";}else{$val_tk18=$row['vhour_'.$_nrow18.''];}
					array_push($wt_tk18,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk18."]");
				}
				if(isset($Tk19))
				{ 
					if($row['vhour_'.$_nrow19.'']==null){$val_tk19="null";}else{$val_tk19=$row['vhour_'.$_nrow19.''];}
					array_push($wt_tk19,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk19."]");
				}
				if(isset($Tk20))
				{ 
					if($row['vhour_'.$_nrow20.'']==null){$val_tk20="null";}else{$val_tk20=$row['vhour_'.$_nrow20.''];}
					array_push($wt_tk20,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk20."]");
				}
				if(isset($Tk21))
				{ 
					if($row['vhour_'.$_nrow21.'']==null){$val_tk21="null";}else{$val_tk21=$row['vhour_'.$_nrow21.''];}
					array_push($wt_tk21,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk21."]");
				}
				if(isset($Tk22))
				{ 
					if($row['vhour_'.$_nrow22.'']==null){$val_tk22="null";}else{$val_tk22=$row['vhour_'.$_nrow22.''];}
					array_push($wt_tk22,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk22."]");
				}
				if(isset($Tk23))
				{ 
					if($row['vhour_'.$_nrow23.'']==null){$val_tk23="null";}else{$val_tk23=$row['vhour_'.$_nrow23.''];}
					array_push($wt_tk23,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk23."]");
				}
				if(isset($Tk24))
				{ 
					if($row['vhour_'.$_nrow24.'']==null){$val_tk24="null";}else{$val_tk24=$row['vhour_'.$_nrow24.''];}
					array_push($wt_tk24,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk24."]");
				}
				if(isset($Tk25))
				{ 
					if($row['vhour_'.$_nrow25.'']==null){$val_tk25="null";}else{$val_tk25=$row['vhour_'.$_nrow25.''];}
					array_push($wt_tk25,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk25."]");
				}
			}//for
			
				if(isset($Tk1))
				{ 
					$ponts_Tk1=implode(",",$wt_tk1);
				}
				if(isset($Tk2))
				{ 
					$ponts_Tk2=implode(",",$wt_tk2);
				}
				if(isset($Tk3))
				{ 
					$ponts_Tk3=implode(",",$wt_tk3);
				}
				if(isset($Tk4))
				{ 
					$ponts_Tk4=implode(",",$wt_tk4);
				}
				if(isset($Tk5))
				{ 
					$ponts_Tk5=implode(",",$wt_tk5);
				}
				if(isset($Tk6))
				{ 
					$ponts_Tk6=implode(",",$wt_tk6);
				}
				if(isset($Tk7))
				{ 
					$ponts_Tk7=implode(",",$wt_tk7);
				}
				if(isset($Tk8))
				{ 
					$ponts_Tk8=implode(",",$wt_tk8);
				}
				if(isset($Tk9))
				{ 
					$ponts_Tk9=implode(",",$wt_tk9);
				}
				if(isset($Tk10))
				{ 
					$ponts_Tk10=implode(",",$wt_tk10);
				}
				if(isset($Tk11))
				{ 
					$ponts_Tk11=implode(",",$wt_tk11);
				}
				if(isset($Tk12))
				{ 
					$ponts_Tk12=implode(",",$wt_tk12);
				}
				if(isset($Tk13))
				{ 
					$ponts_Tk13=implode(",",$wt_tk13);
				}
				if(isset($Tk14))
				{ 
					$ponts_Tk14=implode(",",$wt_tk14);
				}
				if(isset($Tk15))
				{ 
					$ponts_Tk15=implode(",",$wt_tk15);
				}
				if(isset($Tk16))
				{ 
					$ponts_Tk16=implode(",",$wt_tk16);
				}
				if(isset($Tk17))
				{ 
					$ponts_Tk17=implode(",",$wt_tk17);
				}
				if(isset($Tk18))
				{ 
					$ponts_Tk18=implode(",",$wt_tk18);
				}
				if(isset($Tk19))
				{ 
					$ponts_Tk19=implode(",",$wt_tk19);
				}
				if(isset($Tk20))
				{ 
					$ponts_Tk20=implode(",",$wt_tk20);
				}
				if(isset($Tk21))
				{ 
					$ponts_Tk21=implode(",",$wt_tk21);
				}
				if(isset($Tk22))
				{ 
					$ponts_Tk22=implode(",",$wt_tk22);
				}
				if(isset($Tk23))
				{ 
					$ponts_Tk23=implode(",",$wt_tk23);
				}
				if(isset($Tk24))
				{ 
					$ponts_Tk24=implode(",",$wt_tk24);
				}
				if(isset($Tk25))
				{ 
					$ponts_Tk25=implode(",",$wt_tk25);
				}

			   if(isset($Tk1))
			   {
						 $se_Tk1='
								{
								type: "column",
								name: "'.$_namec1.'",
								data: ['.$ponts_Tk1.'],
								color: "#228B22",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}	
				
			   if(isset($Tk2))
			   {
						 $se_Tk2='
								{
								type: "column",
								name: "'.$_namec2.'",
								data: ['.$ponts_Tk2.'],
								color: "#528B8B",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk3))
			   {
						 $se_Tk3='
								{
								type: "column",
								name: "'.$_namec3.'",
								data: ['.$ponts_Tk3.'],
								color: "#A0522D",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk4))
			   {
						 $se_Tk4='
								{
								type: "column",
								name: "'.$_namec4.'",
								data: ['.$ponts_Tk4.'],
								color: "#483D8B",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk5))
			   {
						 $se_Tk5='
								{
								type: "column",
								name: "'.$_namec5.'",
								data: ['.$ponts_Tk5.'],
								color: "#000080",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk6))
			   {
						 $se_Tk6='
								{
								type: "column",
								name: "'.$_namec6.'",
								data: ['.$ponts_Tk6.'],
								color: "#8B658B",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk7))
			   {
						 $se_Tk7='
								{
								type: "column",
								name: "'.$_namec7.'",
								data: ['.$ponts_Tk7.'],
								color: "#CD9B9B",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk8))
			   {
						 $se_Tk8='
								{
								type: "column",
								name: "'.$_namec8.'",
								data: ['.$ponts_Tk8.'],
								color: "#CD5555",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk9))
			   {
						 $se_Tk9='
								{
								type: "column",
								name: "'.$_namec9.'",
								data: ['.$ponts_Tk9.'],
								color: "#CD6839",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk10))
			   {
						 $se_Tk10='
								{
								type: "column",
								name: "'.$_namec10.'",
								data: ['.$ponts_Tk10.'],
								color: "#CD2626",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk11))
			   {
						 $se_Tk11='
								{
								type: "column",
								name: "'.$_namec11.'",
								data: ['.$ponts_Tk11.'],
								color: "#EE9A00",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk12))
			   {
						 $se_Tk12='
								{
								type: "column",
								name: "'.$_namec12.'",
								data: ['.$ponts_Tk12.'],
								color: "#CD6600",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk13))
			   {
						 $se_Tk13='
								{
								type: "column",
								name: "'.$_namec13.'",
								data: ['.$ponts_Tk13.'],
								color: "#CD0000",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk14))
			   {
						 $se_Tk14='
								{
								type: "column",
								name: "'.$_namec14.'",
								data: ['.$ponts_Tk14.'],
								color: "#CD1076",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk15))
			   {
						 $se_Tk15='
								{
								type: "column",
								name: "'.$_namec15.'",
								data: ['.$ponts_Tk15.'],
								color: "#8B4789",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk16))
			   {
						 $se_Tk16='
								{
								type: "column",
								name: "'.$_namec16.'",
								data: ['.$ponts_Tk16.'],
								color: "#C71585",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk17))
			   {
						 $se_Tk17='
								{
								type: "column",
								name: "'.$_namec17.'",
								data: ['.$ponts_Tk17.'],
								color: "#ECAB53",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk18))
			   {
						 $se_Tk18='
								{
								type: "column",
								name: "'.$_namec18.'",
								data: ['.$ponts_Tk18.'],
								color: "#008080",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk19))
			   {
						 $se_Tk19='
								{
								type: "column",
								name: "'.$_namec19.'",
								data: ['.$ponts_Tk19.'],
								color: "#00BB00",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk20))
			   {
						 $se_Tk20='
								{
								type: "column",
								name: "'.$_namec20.'",
								data: ['.$ponts_Tk20.'],
								color: "#778899",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk21))
			   {
						 $se_Tk21='
								{
								type: "column",
								name: "'.$_namec21.'",
								data: ['.$ponts_Tk21.'],
								color: "#97FFFF",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk22))
			   {
						 $se_Tk22='
								{
								type: "column",
								name: "'.$_namec22.'",
								data: ['.$ponts_Tk22.'],
								color: "#FFE4B5",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk23))
			   {
						 $se_Tk23='
								{
								type: "column",
								name: "'.$_namec23.'",
								data: ['.$ponts_Tk23.'],
								color: "#4876FF",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk24))
			   {
						 $se_Tk24='
								{
								type: "column",
								name: "'.$_namec24.'",
								data: ['.$ponts_Tk24.'],
								color: "#B0E0E6",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk25))
			   {
						 $se_Tk25='
								{
								type: "column",
								name: "'.$_namec25.'",
								data: ['.$ponts_Tk25.'],
								color: "#7CFC00",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
	}
	else
	{

			$p_date=date("Y-m-d 07:00",strtotime($p_day1));
			$maxZ= 3 * 60 * 60 * 1000;//3 * 3600000;
			$pointIn=  24 * 3600 * 1000; // 15 min
			$mmdate=date("m",strtotime($p_day1))-1;
			$formatdd="%e. %B %Y %H:%M";
			$minva = $maxva = null;
			$a=1440;
			$b=86400;

			$start = strtotime($p_day1);
			$end = strtotime($p_day2);
			$wt_tk1=array();
			$wt_tk2=array();
			$wt_tk3=array();
			$wt_tk4=array();
			$wt_tk5=array();
			$wt_tk6=array();
			$wt_tk7=array();
			$wt_tk8=array();
			$wt_tk9=array();
			$wt_tk10=array();
			$wt_tk11=array();
			$wt_tk12=array();	
			$wt_tk13=array();
			$wt_tk14=array();
			$wt_tk15=array();
			$wt_tk16=array();
			$wt_tk17=array();
			$wt_tk18=array();
			$wt_tk19=array();
			$wt_tk20=array();
			$wt_tk21=array();
			$wt_tk22=array();
			$wt_tk23=array();
			$wt_tk24=array();
			$wt_tk25=array();
			$stagearray=array();
			for ( $tt = $start; $tt <= $end; $tt += 86400 )
			{	
				$dt=date("Y-m-d",$tt);
				
				if($p_format=="f_mean")
				{
					$strQuery = "SELECT Sum(case when STN_ID='' and sensor_id='' then Value end) aa";	
					foreach($p_stn as $id)
					{
						$_value = cut($id);
						$ssite = $_value[0];
						$nname = $_value[4];

						$strQuery .=" ,Sum(case when STN_ID='".$ssite."' and sensor_id='100' then Value  end) RF_".$nname." ";
					}					
					$strQuery .=" FROM 	[dbo].[DATA_Backup]
							WHERE DT between (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)) 
							and dateAdd(dd, 1, (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)))	";
				}
				elseif($p_format=="f_min")
				{
					$strQuery = "SELECT Sum(case when STN_ID='' and sensor_id='' then Value end) aa";	
					foreach($p_stn as $id)
					{
						$_value = cut($id);
						$ssite = $_value[0];
						$nname = $_value[4];

						$strQuery .=" ,min(case when STN_ID='".$ssite."' and sensor_id='100' then Value  end) RF_".$nname." ";
					}					
					$strQuery .=" FROM 	[dbo].[DATA_Backup]
							WHERE DT between (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)) 
							and dateAdd(dd, 1, (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)))	";
				}
				elseif($p_format=="f_max")
				{
					$strQuery = "SELECT Sum(case when STN_ID='' and sensor_id='' then Value end) aa";	
					foreach($p_stn as $id)
					{
						$_value = cut($id);
						$ssite = $_value[0];
						$nname = $_value[4];

						$strQuery .=" ,max(case when STN_ID='".$ssite."' and sensor_id='100' then Value  end) RF_".$nname." ";
					}					
					$strQuery .=" FROM 	[dbo].[DATA_Backup]
							WHERE DT between (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)) 
							and dateAdd(dd, 1, (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)))	";
				}
				else{}
			
			    //echo $strQuery;
				$result = odbc_exec($conn,$strQuery);
				//$checkrow=odbc_num_rows($objExec);
				$date_now = $dt.' 07:00';
				

				$stadatey=date("Y",strtotime($date_now));	
				$stadatem=date("m",strtotime($date_now));	
				$stadated=date("d",strtotime($date_now));
				$stadateh=date("H",strtotime($date_now));
				$stadatei=date("i",strtotime($date_now));
						
				$sm=$stadatey."-".$stadatem;
				
				$stadate=strtotime($date_now);
				$enddate=strtotime($date_now)+86400;
				$row = odbc_fetch_array($result);
		
						if(isset($Tk1))
						{ 
							if($row['RF_'.$_nrow1.'']==null){$val_tk1="null";}else{$val_tk1=$row['RF_'.$_nrow1.''];}
							array_push($wt_tk1,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk1."]");
						}
						if(isset($Tk2))
						{ 
							if($row['RF_'.$_nrow2.'']==null){$val_tk2="null";}else{$val_tk2=$row['RF_'.$_nrow2.''];}
							array_push($wt_tk2,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk2."]");
						}
						if(isset($Tk3))
						{ 
							if($row['RF_'.$_nrow3.'']==null){$val_tk3="null";}else{$val_tk3=$row['RF_'.$_nrow3.''];}
							array_push($wt_tk3,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk3."]");
						}
						if(isset($Tk4))
						{ 
							if($row['RF_'.$_nrow4.'']==null){$val_tk4="null";}else{$val_tk4=$row['RF_'.$_nrow4.''];}
							array_push($wt_tk4,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk4."]");
						}
						if(isset($Tk5))
						{ 
							if($row['RF_'.$_nrow5.'']==null){$val_tk5="null";}else{$val_tk5=$row['RF_'.$_nrow5.''];}
							array_push($wt_tk5,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk5."]");
						}
						if(isset($Tk6))
						{ 
							if($row['RF_'.$_nrow6.'']==null){$val_tk6="null";}else{$val_tk6=$row['RF_'.$_nrow6.''];}
							array_push($wt_tk6,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk6."]");
						}
						if(isset($Tk7))
						{ 
							if($row['RF_'.$_nrow7.'']==null){$val_tk7="null";}else{$val_tk7=$row['RF_'.$_nrow7.''];}
							array_push($wt_tk7,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk7."]");
						}
						if(isset($Tk8))
						{ 
							if($row['RF_'.$_nrow8.'']==null){$val_tk8="null";}else{$val_tk8=$row['RF_'.$_nrow8.''];}
							array_push($wt_tk8,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk8."]");
						}
						if(isset($Tk9))
						{ 
							if($row['RF_'.$_nrow9.'']==null){$val_tk9="null";}else{$val_tk9=$row['RF_'.$_nrow9.''];}
							array_push($wt_tk9,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk9."]");
						}
						if(isset($Tk10))
						{ 
							if($row['RF_'.$_nrow10.'']==null){$val_tk10="null";}else{$val_tk10=$row['RF_'.$_nrow10.''];}
							array_push($wt_tk10,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk10."]");
						}
						if(isset($Tk11))
						{ 
							if($row['RF_'.$_nrow11.'']==null){$val_tk11="null";}else{$val_tk11=$row['RF_'.$_nrow11.''];}
							array_push($wt_tk11,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk11."]");
						}
						if(isset($Tk12))
						{ 
							if($row['RF_'.$_nrow12.'']==null){$val_tk12="null";}else{$val_tk12=$row['RF_'.$_nrow12.''];}
							array_push($wt_tk12,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk12."]");
						}
						if(isset($Tk13))
						{ 
							if($row['RF_'.$_nrow13.'']==null){$val_tk13="null";}else{$val_tk13=$row['RF_'.$_nrow13.''];}
							array_push($wt_tk13,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk13."]");
						}
						if(isset($Tk14))
						{ 
							if($row['RF_'.$_nrow14.'']==null){$val_tk14="null";}else{$val_tk14=$row['RF_'.$_nrow14.''];}
							array_push($wt_tk14,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk14."]");
						}
						if(isset($Tk15))
						{ 
							if($row['RF_'.$_nrow15.'']==null){$val_tk15="null";}else{$val_tk15=$row['RF_'.$_nrow15.''];}
							array_push($wt_tk15,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk15."]");
						}
						if(isset($Tk16))
						{ 
							if($row['RF_'.$_nrow16.'']==null){$val_tk16="null";}else{$val_tk16=$row['RF_'.$_nrow16.''];}
							array_push($wt_tk16,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk16."]");
						}
						if(isset($Tk17))
						{ 
							if($row['RF_'.$_nrow17.'']==null){$val_tk17="null";}else{$val_tk17=$row['RF_'.$_nrow17.''];}
							array_push($wt_tk17,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk17."]");
						}
						if(isset($Tk18))
						{ 
							if($row['RF_'.$_nrow18.'']==null){$val_tk18="null";}else{$val_tk18=$row['RF_'.$_nrow18.''];}
							array_push($wt_tk18,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk18."]");
						}
						if(isset($Tk19))
						{ 
							if($row['RF_'.$_nrow19.'']==null){$val_tk19="null";}else{$val_tk19=$row['RF_'.$_nrow19.''];}
							array_push($wt_tk19,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk19."]");
						}
						if(isset($Tk20))
						{ 
							if($row['RF_'.$_nrow20.'']==null){$val_tk20="null";}else{$val_tk20=$row['RF_'.$_nrow20.''];}
							array_push($wt_tk20,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk20."]");
						}
						if(isset($Tk21))
						{ 
							if($row['RF_'.$_nrow21.'']==null){$val_tk21="null";}else{$val_tk21=$row['RF_'.$_nrow21.''];}
							array_push($wt_tk21,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk21."]");
						}
						if(isset($Tk22))
						{ 
							if($row['RF_'.$_nrow22.'']==null){$val_tk22="null";}else{$val_tk22=$row['RF_'.$_nrow22.''];}
							array_push($wt_tk22,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk22."]");
						}
						if(isset($Tk23))
						{ 
							if($row['RF_'.$_nrow23.'']==null){$val_tk23="null";}else{$val_tk23=$row['RF_'.$_nrow23.''];}
							array_push($wt_tk23,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk23."]");
						}
						if(isset($Tk24))
						{ 
							if($row['RF_'.$_nrow24.'']==null){$val_tk24="null";}else{$val_tk24=$row['RF_'.$_nrow24.''];}
							array_push($wt_tk24,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk24."]");
						}
						if(isset($Tk25))
						{ 
							if($row['RF_'.$_nrow25.'']==null){$val_tk25="null";}else{$val_tk25=$row['RF_'.$_nrow25.''];}
							array_push($wt_tk25,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk25."]");
						}

			}
				if(isset($Tk1))
				{ 
					$ponts_Tk1=implode(",",$wt_tk1);
				}
				if(isset($Tk2))
				{ 
					$ponts_Tk2=implode(",",$wt_tk2);
				}
				if(isset($Tk3))
				{ 
					$ponts_Tk3=implode(",",$wt_tk3);
				}
				if(isset($Tk4))
				{ 
					$ponts_Tk4=implode(",",$wt_tk4);
				}
				if(isset($Tk5))
				{ 
					$ponts_Tk5=implode(",",$wt_tk5);
				}
				if(isset($Tk6))
				{ 
					$ponts_Tk6=implode(",",$wt_tk6);
				}
				if(isset($Tk7))
				{ 
					$ponts_Tk7=implode(",",$wt_tk7);
				}
				if(isset($Tk8))
				{ 
					$ponts_Tk8=implode(",",$wt_tk8);
				}
				if(isset($Tk9))
				{ 
					$ponts_Tk9=implode(",",$wt_tk9);
				}
				if(isset($Tk10))
				{ 
					$ponts_Tk10=implode(",",$wt_tk10);
				}
				if(isset($Tk11))
				{ 
					$ponts_Tk11=implode(",",$wt_tk11);
				}
				if(isset($Tk12))
				{ 
					$ponts_Tk12=implode(",",$wt_tk12);
				}
				if(isset($Tk13))
				{ 
					$ponts_Tk13=implode(",",$wt_tk13);
				}
				if(isset($Tk14))
				{ 
					$ponts_Tk14=implode(",",$wt_tk14);
				}
				if(isset($Tk15))
				{ 
					$ponts_Tk15=implode(",",$wt_tk15);
				}
				if(isset($Tk16))
				{ 
					$ponts_Tk16=implode(",",$wt_tk16);
				}
				if(isset($Tk17))
				{ 
					$ponts_Tk17=implode(",",$wt_tk17);
				}
				if(isset($Tk18))
				{ 
					$ponts_Tk18=implode(",",$wt_tk18);
				}
				if(isset($Tk19))
				{ 
					$ponts_Tk19=implode(",",$wt_tk19);
				}
				if(isset($Tk20))
				{ 
					$ponts_Tk20=implode(",",$wt_tk20);
				}
				if(isset($Tk21))
				{ 
					$ponts_Tk21=implode(",",$wt_tk21);
				}
				if(isset($Tk22))
				{ 
					$ponts_Tk22=implode(",",$wt_tk22);
				}
				if(isset($Tk23))
				{ 
					$ponts_Tk23=implode(",",$wt_tk23);
				}
				if(isset($Tk24))
				{ 
					$ponts_Tk24=implode(",",$wt_tk24);
				}
				if(isset($Tk25))
				{ 
					$ponts_Tk25=implode(",",$wt_tk25);
				}

			   
			   if(isset($Tk1))
			   {
						 $se_Tk1='
								{
								type: "column",
								name: "'.$_namec1.'",
								data: ['.$ponts_Tk1.'],
								color: "#228B22",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}	
				
			   if(isset($Tk2))
			   {
						 $se_Tk2='
								{
								type: "column",
								name: "'.$_namec2.'",
								data: ['.$ponts_Tk2.'],
								color: "#528B8B",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk3))
			   {
						 $se_Tk3='
								{
								type: "column",
								name: "'.$_namec3.'",
								data: ['.$ponts_Tk3.'],
								color: "#A0522D",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk4))
			   {
						 $se_Tk4='
								{
								type: "column",
								name: "'.$_namec4.'",
								data: ['.$ponts_Tk4.'],
								color: "#483D8B",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk5))
			   {
						 $se_Tk5='
								{
								type: "column",
								name: "'.$_namec5.'",
								data: ['.$ponts_Tk5.'],
								color: "#000080",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk6))
			   {
						 $se_Tk6='
								{
								type: "column",
								name: "'.$_namec6.'",
								data: ['.$ponts_Tk6.'],
								color: "#8B658B",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk7))
			   {
						 $se_Tk7='
								{
								type: "column",
								name: "'.$_namec7.'",
								data: ['.$ponts_Tk7.'],
								color: "#CD9B9B",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk8))
			   {
						 $se_Tk8='
								{
								type: "column",
								name: "'.$_namec8.'",
								data: ['.$ponts_Tk8.'],
								color: "#CD5555",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk9))
			   {
						 $se_Tk9='
								{
								type: "column",
								name: "'.$_namec9.'",
								data: ['.$ponts_Tk9.'],
								color: "#CD6839",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk10))
			   {
						 $se_Tk10='
								{
								type: "column",
								name: "'.$_namec10.'",
								data: ['.$ponts_Tk10.'],
								color: "#CD2626",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk11))
			   {
						 $se_Tk11='
								{
								type: "column",
								name: "'.$_namec11.'",
								data: ['.$ponts_Tk11.'],
								color: "#EE9A00",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk12))
			   {
						 $se_Tk12='
								{
								type: "column",
								name: "'.$_namec12.'",
								data: ['.$ponts_Tk12.'],
								color: "#CD6600",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk13))
			   {
						 $se_Tk13='
								{
								type: "column",
								name: "'.$_namec13.'",
								data: ['.$ponts_Tk13.'],
								color: "#CD0000",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk14))
			   {
						 $se_Tk14='
								{
								type: "column",
								name: "'.$_namec14.'",
								data: ['.$ponts_Tk14.'],
								color: "#CD1076",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk15))
			   {
						 $se_Tk15='
								{
								type: "column",
								name: "'.$_namec15.'",
								data: ['.$ponts_Tk15.'],
								color: "#8B4789",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk16))
			   {
						 $se_Tk16='
								{
								type: "column",
								name: "'.$_namec16.'",
								data: ['.$ponts_Tk16.'],
								color: "#C71585",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk17))
			   {
						 $se_Tk17='
								{
								type: "column",
								name: "'.$_namec17.'",
								data: ['.$ponts_Tk17.'],
								color: "#ECAB53",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk18))
			   {
						 $se_Tk18='
								{
								type: "column",
								name: "'.$_namec18.'",
								data: ['.$ponts_Tk18.'],
								color: "#008080",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk19))
			   {
						 $se_Tk19='
								{
								type: "column",
								name: "'.$_namec19.'",
								data: ['.$ponts_Tk19.'],
								color: "#00BB00",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk20))
			   {
						 $se_Tk20='
								{
								type: "column",
								name: "'.$_namec20.'",
								data: ['.$ponts_Tk20.'],
								color: "#778899",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk21))
			   {
						 $se_Tk21='
								{
								type: "column",
								name: "'.$_namec21.'",
								data: ['.$ponts_Tk21.'],
								color: "#97FFFF",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk22))
			   {
						 $se_Tk22='
								{
								type: "column",
								name: "'.$_namec22.'",
								data: ['.$ponts_Tk22.'],
								color: "#FFE4B5",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk23))
			   {
						 $se_Tk23='
								{
								type: "column",
								name: "'.$_namec23.'",
								data: ['.$ponts_Tk23.'],
								color: "#4876FF",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk24))
			   {
						 $se_Tk24='
								{
								type: "column",
								name: "'.$_namec24.'",
								data: ['.$ponts_Tk24.'],
								color: "#B0E0E6",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk25))
			   {
						 $se_Tk25='
								{
								type: "column",
								name: "'.$_namec25.'",
								data: ['.$ponts_Tk25.'],
								color: "#7CFC00",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
	}
		?>
		<BR>
		<div id="graphRF" style="<?echo $st;?>"></div>
		<script type="text/javascript">
		//alert("aa");
		$(function () {
			var chart;
			$(document).ready(function() {
				Highcharts.setOptions({
				lang: {
					months: ['ม.ค.', 'ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.']		}
			});
				chart = new Highcharts.Chart({
					chart: {
						zoomType: 'x',
						renderTo: 'graphRF',
						type: 'column',
						spacingLeft: 25 ,
						resetZoomButton: {
							position: {
							// align: 'right', // by default
							 // verticalAlign: 'top', // by default
							x: -30,
							y: -20
							}
						}
					},
					credits: {
					enabled: false
					},
					title: {
						text: '<? echo $nametype;?>',
					
					style: {
						fontSize: '14px'
					}
					},
					subtitle: {
						text: ''
					},
					xAxis: {
						type: 'datetime',
						//maxZoom: <? echo $maxZ;?>,
						minRange: '<? echo $a;?>' * 60 * 1000 * 6,
						minTickInterval: '<? echo $a;?>' * 60 * 1000,
						title: {
							text: null
						},
						labels:{
						rotation:-45,
						align:'right',
						fontSize: '8px'
							},
						dateTimeLabelFormats: {
						second: '%H:%M:%S',
						minute: '%H:%M',
						hour: '%H:%M',
						day: '%e %B %Y',
						week:'%e %B %Y',
						month:'%B %Y',
						year:'%Y'
					}
					},
					yAxis: {
						min: '<? echo $minva;?>',
						title: {
							text: '<? echo $yaname;?>'
						}
					},
					tooltip: {
						formatter: function() {
						return  Highcharts.dateFormat('<? echo $formatdd;?>',this.x) + '<br><b>' + this.y +'</b>'+'  มม.';
					}
					},
					plotOptions: {
						column: {
							pointPadding: 0.2,
							borderWidth: 0
						},
						series: {
						marker: {
							enabled:false,
							lineWidth: 0
						}
						}
						},
						scrollbar: {
						 enabled: true
						},
						series: [
							<?php echo $se_Tk2?>
							 <?php echo $se_Tk3?>
							 <?php echo $se_Tk4?>
							 <?php echo $se_Tk6?>
							 <?php echo $se_Tk7?>
							 <?php echo $se_Tk8?>
							 <?php echo $se_Tk9?>
							 <?php echo $se_Tk10?>
							 <?php echo $se_Tk11?>
							 <?php echo $se_Tk12?>
							 <?php echo $se_Tk13?>
							 <?php echo $se_Tk14?>
							 <?php echo $se_Tk15?>
							 <?php echo $se_Tk19?>
							 <?php echo $se_Tk20?>
							 <?php echo $se_Tk21?>
							 <?php echo $se_Tk22?>
							 <?php echo $se_Tk23?>
							]
						,
						exporting: {
					 url: 'http://telekolok.com/exporting_server/index.php'
				  }
				});
			});

		});
		</script>
		<?	
}

if($p_water=="Y")
{
	$nametype="กราฟ".$_cfg_data_type["wl"][0]; 
	$yname=$_cfg_data_type["wl"][1];
	$yaname=$_cfg_data_type["wl"][0]." ".$_cfg_data_type["wl"][1];
	$typess="line";
	$wlH="หน้า ปตร.";
	$wlL="ท้าย ปตร.";

    
	if($p_format=="f_15" || $p_format=="f_hr")
	{
		if($p_format=="f_15")
		{
			$p_date=date("Y-m-d",strtotime($p_day1));
			$maxZ= 3 * 60 * 60 * 1000;//3 * 3600000;
			$pointIn= 900 * 1000; // 15 min
			$mmdate=date("m",strtotime($p_day1))-1;
			$formatdd="%e. %B %Y %H:%M";
			$minva = $maxva = null;
			$a=15;
			$b=900;

			$strQuery = "SELECT CONVERT(varchar(16),DT,121) adate ";
						
				foreach($p_stn as $id)
				{
					$_value = cut($id);
					$ssite = $_value[0];
					$nname = $_value[4];

					$strQuery .=",Sum(case when STN_ID='".$ssite."' and sensor_id='200' then Value  end) WL_".$nname." ";
				}
				foreach($p_stn as $id)
				{
					$_value = cut($id);
					$ssite = $_value[0];
					$nname = $_value[4];

					$strQuery .=",Sum(case when STN_ID='".$ssite."' and sensor_id='201' then Value  end) WLE_".$nname." ";
				}
							
				$strQuery .="FROM [dbo].[DATA_Backup]
					WHERE 
					CONVERT(varchar(16),DT,121) between '".$p_day1." 00:00' and '".$p_day2." 23:45' AND (DATEPART(MINUTE ,DT))%15='0'
					GROUP BY 
						CONVERT(varchar(16),DT,121)
					ORDER BY 
						CONVERT(varchar(16),DT,121)	";
		}
		elseif($p_format=="f_hr")
		{
			$p_date=date("Y-m-d",strtotime($p_day1));
			$maxZ= 3 * 60 * 60 * 1000;//3 * 3600000;
			$pointIn= 3600 * 1000; // 15 min
			$mmdate=date("m",strtotime($p_day1))-1;
			$formatdd="%e. %B %Y %H:%M";
			$minva = $maxva = null;
			$a=60;
			$b=3600;

			$strQuery = "SELECT CONVERT(varchar(16),DT,121) adate ";	
			foreach($p_stn as $id)
			{
				$_value = cut($id);
				$ssite = $_value[0];
				$nname = $_value[4];

				$strQuery .=",Sum(case when STN_ID='".$ssite."' and sensor_id='200' then Value  end) WL_".$nname." ";
			}
			foreach($p_stn as $id)
			{
				$_value = cut($id);
				$ssite = $_value[0];
				$nname = $_value[4];

				$strQuery .=",Sum(case when STN_ID='".$ssite."' and sensor_id='201' then Value  end) WLE_".$nname." ";
			}				
			$strQuery .=" FROM [dbo].[DATA_Backup]
						WHERE CONVERT(varchar(16),DT,121) between '".$p_day1." 00:00' and '".$p_day2." 23:00' 
							AND (DATEPART(MINUTE ,DT))='00'
						GROUP BY 
							CONVERT(varchar(16),DT,121)
						ORDER BY 
							CONVERT(varchar(16),DT,121)	";
		}
		else{}

		//echo $strQuery;
		$result = odbc_exec($conn,$strQuery);
		//$checkrow=mssql_num_rows($result);

		$stagearray=array();
		$wl_tk1=array();
		$wl_tk2=array();
		$wl_tk3=array();
		$wl_tk4=array();
		$wl_tk5=array();
		$wl_tk6=array();
		$wl_tk7=array();
		$wl_tk8=array();
		$wl_tk9=array();
		$wl_tk10=array();
		$wl_tk11=array();
		$wl_tk12=array();	
		$wl_tk13=array();
		$wl_tk14=array();
		$wl_tk15=array();
		$wl_tk16=array();
		$wl_tk17=array();
		$wl_tk18=array();
		$wl_tk18E=array();
		$wl_tk19=array();
		$wl_tk19E=array();
		$wl_tk20=array();
		$wl_tk21=array();
		$wl_tk22=array();
		$wl_tk23=array();
		$wl_tk24=array();
		$wl_tk25=array();
		$wl_tk25E=array();

				$stadatey=date("Y",strtotime($p_day1));	
				$stadatem=date("m",strtotime($p_day1));	
				$stadated=date("d",strtotime($p_day1));

				$stadateh=date("H",strtotime($p_day1));
				$stadatei=date("i",strtotime($p_day1));
						
				$sm=$stadatey."-".$stadatem;
				
				if ($p_format=="f_15" or $p_format=="f_hr")
				{
					$stadate=strtotime($p_day1);
					$enddate=strtotime($p_day2)+86400;
				}
				else{}
		
				while($stadate < $enddate)
				{

					if ($row = odbc_fetch_array($result))
					{
						
						$sname=strtotime($row['adate']);
						
						while($stadate < $sname)
						{
							if(isset($Tk1))
							{ 
								array_push($wl_tk1,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk2))
							{ 
								array_push($wl_tk2,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk3))
							{ 
								array_push($wl_tk3,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk4))
							{ 
								array_push($wl_tk4,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk5))
							{ 
								array_push($wl_tk5,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk6))
							{ 
								array_push($wl_tk6,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk7))
							{ 
								array_push($wl_tk7,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk8))
							{ 
								array_push($wl_tk8,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk9))
							{ 
								array_push($wl_tk9,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk10))
							{ 
								array_push($wl_tk10,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk11))
							{ 
								array_push($wl_tk11,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk12))
							{ 
								array_push($wl_tk12,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk13))
							{ 
								array_push($wl_tk13,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk14))
							{ 
								array_push($wl_tk14,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk15))
							{ 
								array_push($wl_tk15,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk16))
							{ 
								array_push($wl_tk16,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk17))
							{ 
								array_push($wl_tk17,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk18))
							{ 
								array_push($wl_tk18,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
								array_push($wl_tk18E,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk19))
							{ 
								array_push($wl_tk19,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
								array_push($wl_tk19E,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk20))
							{ 
								array_push($wl_tk20,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk21))
							{ 
								array_push($wl_tk21,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk22))
							{ 
								array_push($wl_tk22,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk23))
							{ 
								array_push($wl_tk23,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk24))
							{ 
								array_push($wl_tk24,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk25))
							{ 
								array_push($wl_tk25,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
								array_push($wl_tk25E,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}


							if ($p_format=="f_15" or $p_format=="f_hr")
							{
								$stadatei+=$a;
								$stadate+=$a*60;
							}
						
						}

						if(isset($Tk1))
						{ 
							if($row['WL_'.$_nrow1.'']==null){$val_tk1="null";}else{$val_tk1=$row['WL_'.$_nrow1.''];}
							array_push($wl_tk1,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk1."]");
						}
						if(isset($Tk2))
						{ 
							if($row['WL_'.$_nrow2.'']==null){$val_tk2="null";}else{$val_tk2=$row['WL_'.$_nrow2.''];}
							array_push($wl_tk2,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk2."]");
						}
						if(isset($Tk3))
						{ 
							if($row['WL_'.$_nrow3.'']==null){$val_tk3="null";}else{$val_tk3=$row['WL_'.$_nrow3.''];}
							array_push($wl_tk3,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk3."]");
						}
						if(isset($Tk4))
						{ 
							if($row['WL_'.$_nrow4.'']==null){$val_tk4="null";}else{$val_tk4=$row['WL_'.$_nrow4.''];}
							array_push($wl_tk4,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk4."]");
						}
						if(isset($Tk5))
						{ 
							if($row['WL_'.$_nrow5.'']==null){$val_tk5="null";}else{$val_tk5=$row['WL_'.$_nrow5.''];}
							array_push($wl_tk5,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk5."]");
						}
						if(isset($Tk6))
						{ 
							if($row['WL_'.$_nrow6.'']==null){$val_tk6="null";}else{$val_tk6=$row['WL_'.$_nrow6.''];}
							array_push($wl_tk6,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk6."]");
						}
						if(isset($Tk7))
						{ 
							if($row['WL_'.$_nrow7.'']==null){$val_tk7="null";}else{$val_tk7=$row['WL_'.$_nrow7.''];}
							array_push($wl_tk7,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk7."]");
						}
						if(isset($Tk8))
						{ 
							if($row['WL_'.$_nrow8.'']==null){$val_tk8="null";}else{$val_tk8=$row['WL_'.$_nrow8.''];}
							array_push($wl_tk8,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk8."]");
						}
						if(isset($Tk9))
						{ 
							if($row['WL_'.$_nrow9.'']==null){$val_tk9="null";}else{$val_tk9=$row['WL_'.$_nrow9.''];}
							array_push($wl_tk9,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk9."]");
						}
						if(isset($Tk10))
						{ 
							if($row['WL_'.$_nrow10.'']==null){$val_tk10="null";}else{$val_tk10=$row['WL_'.$_nrow10.''];}
							array_push($wl_tk10,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk10."]");
						}
						if(isset($Tk11))
						{ 
							if($row['WL_'.$_nrow11.'']==null){$val_tk11="null";}else{$val_tk11=$row['WL_'.$_nrow11.''];}
							array_push($wl_tk11,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk11."]");
						}
						if(isset($Tk12))
						{ 
							if($row['WL_'.$_nrow12.'']==null){$val_tk12="null";}else{$val_tk12=$row['WL_'.$_nrow12.''];}
							array_push($wl_tk12,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk12."]");
						}
						if(isset($Tk13))
						{ 
							if($row['WL_'.$_nrow13.'']==null){$val_tk13="null";}else{$val_tk13=$row['WL_'.$_nrow13.''];}
							array_push($wl_tk13,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk13."]");
						}
						if(isset($Tk14))
						{ 
							if($row['WL_'.$_nrow14.'']==null){$val_tk14="null";}else{$val_tk14=$row['WL_'.$_nrow14.''];}
							array_push($wl_tk14,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk14."]");
						}
						if(isset($Tk15))
						{ 
							if($row['WL_'.$_nrow15.'']==null){$val_tk15="null";}else{$val_tk15=$row['WL_'.$_nrow15.''];}
							array_push($wl_tk15,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk15."]");
						}
						if(isset($Tk16))
						{ 
							if($row['WL_'.$_nrow16.'']==null){$val_tk16="null";}else{$val_tk16=$row['WL_'.$_nrow16.''];}
							array_push($wl_tk16,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk16."]");
						}
						if(isset($Tk17))
						{ 
							if($row['WL_'.$_nrow17.'']==null){$val_tk17="null";}else{$val_tk17=$row['WL_'.$_nrow17.''];}
							array_push($wl_tk17,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk17."]");
						}
						if(isset($Tk18))
						{ 
							if($row['WL_'.$_nrow18.'']==null){$val_tk18="null";}else{$val_tk18=$row['WL_'.$_nrow18.''];}
							array_push($wl_tk18,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk18."]");
							if($row['WLE_'.$_nrow18.'']==null){$val_tk18E="null";}else{$val_tk18E=$row['WLE_'.$_nrow18.''];}
							array_push($wl_tk18E,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk18E."]");
						}
						if(isset($Tk19))
						{ 
							if($row['WL_'.$_nrow19.'']==null){$val_tk19="null";}else{$val_tk19=$row['WL_'.$_nrow19.''];}
							array_push($wl_tk19,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk19."]");
							if($row['WLE_'.$_nrow19.'']==null){$val_tk19E="null";}else{$val_tk19E=$row['WLE_'.$_nrow19.''];}
							array_push($wl_tk19E,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk19E."]");
						}
						if(isset($Tk20))
						{ 
							if($row['WL_'.$_nrow20.'']==null){$val_tk20="null";}else{$val_tk20=$row['WL_'.$_nrow20.''];}
							array_push($wl_tk20,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk20."]");
						}
						if(isset($Tk21))
						{ 
							if($row['WL_'.$_nrow21.'']==null){$val_tk21="null";}else{$val_tk21=$row['WL_'.$_nrow21.''];}
							array_push($wl_tk21,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk21."]");
						}
						if(isset($Tk22))
						{ 
							if($row['WL_'.$_nrow22.'']==null){$val_tk22="null";}else{$val_tk22=$row['WL_'.$_nrow22.''];}
							array_push($wl_tk22,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk22."]");
						}
						if(isset($Tk23))
						{ 
							if($row['WL_'.$_nrow23.'']==null){$val_tk23="null";}else{$val_tk23=$row['WL_'.$_nrow23.''];}
							array_push($wl_tk23,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk23."]");
						}
						if(isset($Tk24))
						{ 
							if($row['WL_'.$_nrow24.'']==null){$val_tk24="null";}else{$val_tk24=$row['WL_'.$_nrow24.''];}
							array_push($wl_tk24,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk24."]");
						}
						if(isset($Tk25))
						{ 
							if($row['WL_'.$_nrow25.'']==null){$val_tk25="null";}else{$val_tk25=$row['WL_'.$_nrow25.''];}
							array_push($wl_tk25,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk25."]");
							if($row['WLE_'.$_nrow25.'']==null){$val_tk25E="null";}else{$val_tk25E=$row['WLE_'.$_nrow25.''];}
							array_push($wl_tk25E,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk25E."]");
						}

						if ($p_format=="f_15" or $p_format=="f_hr")
						{
							$stadatei+=$a;
							$stadate+=$a*60;
						}
					
					}
					else
					{
							if(isset($Tk1))
							{ 
								array_push($wl_tk1,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk2))
							{ 
								array_push($wl_tk2,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk3))
							{ 
								array_push($wl_tk3,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk4))
							{ 
								array_push($wl_tk4,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk5))
							{ 
								array_push($wl_tk5,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk6))
							{ 
								array_push($wl_tk6,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk7))
							{ 
								array_push($wl_tk7,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk8))
							{ 
								array_push($wl_tk8,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk9))
							{ 
								array_push($wl_tk9,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk10))
							{ 
								array_push($wl_tk10,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk11))
							{ 
								array_push($wl_tk11,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk12))
							{ 
								array_push($wl_tk12,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk13))
							{ 
								array_push($wl_tk13,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk14))
							{ 
								array_push($wl_tk14,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk15))
							{ 
								array_push($wl_tk15,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk16))
							{ 
								array_push($wl_tk16,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk17))
							{ 
								array_push($wl_tk17,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk18))
							{ 
								array_push($wl_tk18,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
								array_push($wl_tk18E,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk19))
							{ 
								array_push($wl_tk19,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
								array_push($wl_tk19E,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk20))
							{ 
								array_push($wl_tk20,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk21))
							{ 
								array_push($wl_tk21,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk22))
							{ 
								array_push($wl_tk22,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk23))
							{ 
								array_push($wl_tk23,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk24))
							{ 
								array_push($wl_tk24,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}
							if(isset($Tk25))
							{ 
								array_push($wl_tk25,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
								array_push($wl_tk25E,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
							}

							if ($p_format=="f_15" or $p_format=="f_hr")
							{
								$stadatei+=$a;
								$stadate+=$a*60;
							}							
					}
				}

				if(isset($Tk1))
				{ 
					$ponts_Tk1=implode(",",$wl_tk1);
				}
				if(isset($Tk2))
				{ 
					$ponts_Tk2=implode(",",$wl_tk2);
				}
				if(isset($Tk3))
				{ 
					$ponts_Tk3=implode(",",$wl_tk3);
				}
				if(isset($Tk4))
				{ 
					$ponts_Tk4=implode(",",$wl_tk4);
				}
				if(isset($Tk5))
				{ 
					$ponts_Tk5=implode(",",$wl_tk5);
				}
				if(isset($Tk6))
				{ 
					$ponts_Tk6=implode(",",$wl_tk6);
				}
				if(isset($Tk7))
				{ 
					$ponts_Tk7=implode(",",$wl_tk7);
				}
				if(isset($Tk8))
				{ 
					$ponts_Tk8=implode(",",$wl_tk8);
				}
				if(isset($Tk9))
				{ 
					$ponts_Tk9=implode(",",$wl_tk9);
				}
				if(isset($Tk10))
				{ 
					$ponts_Tk10=implode(",",$wl_tk10);
				}
				if(isset($Tk11))
				{ 
					$ponts_Tk11=implode(",",$wl_tk11);
				}
				if(isset($Tk12))
				{ 
					$ponts_Tk12=implode(",",$wl_tk12);
				}
				if(isset($Tk13))
				{ 
					$ponts_Tk13=implode(",",$wl_tk13);
				}
				if(isset($Tk14))
				{ 
					$ponts_Tk14=implode(",",$wl_tk14);
				}
				if(isset($Tk15))
				{ 
					$ponts_Tk15=implode(",",$wl_tk15);
				}
				if(isset($Tk16))
				{ 
					$ponts_Tk16=implode(",",$wl_tk16);
				}
				if(isset($Tk17))
				{ 
					$ponts_Tk17=implode(",",$wl_tk17);
				}
				if(isset($Tk18))
				{ 
					$ponts_Tk18=implode(",",$wl_tk18);
					$ponts_Tk18E=implode(",",$wl_tk18E);
				}
				if(isset($Tk19))
				{ 
					$ponts_Tk19=implode(",",$wl_tk19);
					$ponts_Tk19E=implode(",",$wl_tk19E);
				}
				if(isset($Tk20))
				{ 
					$ponts_Tk20=implode(",",$wl_tk20);
				}
				if(isset($Tk21))
				{ 
					$ponts_Tk21=implode(",",$wl_tk21);
				}
				if(isset($Tk22))
				{ 
					$ponts_Tk22=implode(",",$wl_tk22);
				}
				if(isset($Tk23))
				{ 
					$ponts_Tk23=implode(",",$wl_tk23);
				}
				if(isset($Tk24))
				{ 
					$ponts_Tk24=implode(",",$wl_tk24);
				}
				if(isset($Tk25))
				{ 
					$ponts_Tk25=implode(",",$wl_tk25);
					$ponts_Tk25E=implode(",",$wl_tk25E);
				}

				if(isset($Tk1))
			   {
						 $se_Tk1='
								{
								type: "line",
								name: "'.$_namec1.'",
								data: ['.$ponts_Tk1.'],
								color: "#228B22",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}	
				
			   if(isset($Tk2))
			   {
						 $se_Tk2='
								{
								type: "line",
								name: "'.$_namec2.'",
								data: ['.$ponts_Tk2.'],
								color: "#528B8B",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk3))
			   {
						 $se_Tk3='
								{
								type: "line",
								name: "'.$_namec3.'",
								data: ['.$ponts_Tk3.'],
								color: "#A0522D",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk4))
			   {
						 $se_Tk4='
								{
								type: "line",
								name: "'.$_namec4.'",
								data: ['.$ponts_Tk4.'],
								color: "#483D8B",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk5))
			   {
						 $se_Tk5='
								{
								type: "line",
								name: "'.$_namec5.'",
								data: ['.$ponts_Tk5.'],
								color: "#000080",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk6))
			   {
						 $se_Tk6='
								{
								type: "line",
								name: "'.$_namec6.'",
								data: ['.$ponts_Tk6.'],
								color: "#8B658B",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk7))
			   {
						 $se_Tk7='
								{
								type: "line",
								name: "'.$_namec7.'",
								data: ['.$ponts_Tk7.'],
								color: "#CD9B9B",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk8))
			   {
						 $se_Tk8='
								{
								type: "line",
								name: "'.$_namec8.'",
								data: ['.$ponts_Tk8.'],
								color: "#CD5555",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk9))
			   {
						 $se_Tk9='
								{
								type: "line",
								name: "'.$_namec9.'",
								data: ['.$ponts_Tk9.'],
								color: "#CD6839",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk10))
			   {
						 $se_Tk10='
								{
								type: "line",
								name: "'.$_namec10.'",
								data: ['.$ponts_Tk10.'],
								color: "#CD2626",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk11))
			   {
						 $se_Tk11='
								{
								type: "line",
								name: "'.$_namec11.'",
								data: ['.$ponts_Tk11.'],
								color: "#EE9A00",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk12))
			   {
						 $se_Tk12='
								{
								type: "line",
								name: "'.$_namec12.'",
								data: ['.$ponts_Tk12.'],
								color: "#CD6600",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk13))
			   {
						 $se_Tk13='
								{
								type: "line",
								name: "'.$_namec13.'",
								data: ['.$ponts_Tk13.'],
								color: "#CD0000",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk14))
			   {
						 $se_Tk14='
								{
								type: "line",
								name: "'.$_namec14.'",
								data: ['.$ponts_Tk14.'],
								color: "#CD1076",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk15))
			   {
						 $se_Tk15='
								{
								type: "line",
								name: "'.$_namec15.'",
								data: ['.$ponts_Tk15.'],
								color: "#8B4789",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk16))
			   {
						 $se_Tk16='
								{
								type: "line",
								name: "'.$_namec16.'",
								data: ['.$ponts_Tk16.'],
								color: "#C71585",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk17))
			   {
						 $se_Tk17='
								{
								type: "line",
								name: "'.$_namec17.'",
								data: ['.$ponts_Tk17.'],
								color: "#ECAB53",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk18))
			   {
						 $se_Tk18='
								{
								type: "line",
								name: "'.$_namec18.'",
								data: ['.$ponts_Tk18.'],
								color: "#008080",
								lineWidth: 1,
								dashStyle:"solid"
								
								},
								{
								type: "line",
								name: "'.$_namec18.'_E",
								data: ['.$ponts_Tk18E.'],
								color: "#008080",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},';

				}
				if(isset($Tk19))
			   {
						 $se_Tk19='
								{
								type: "line",
								name: "'.$_namec19.'",
								data: ['.$ponts_Tk19.'],
								color: "00BB00",
								lineWidth: 1,
								dashStyle:"solid"
								
								},
								{
								type: "line",
								name: "'.$_namec19.'_E",
								data: ['.$ponts_Tk19E.'],
								color: "#00BB00",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},';

				}
				if(isset($Tk20))
			   {
						 $se_Tk20='
								{
								type: "line",
								name: "'.$_namec20.'",
								data: ['.$ponts_Tk20.'],
								color: "#778899",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk21))
			   {
						 $se_Tk21='
								{
								type: "line",
								name: "'.$_namec21.'",
								data: ['.$ponts_Tk21.'],
								color: "#97FFFF",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk22))
			   {
						 $se_Tk22='
								{
								type: "line",
								name: "'.$_namec22.'",
								data: ['.$ponts_Tk22.'],
								color: "#FFE4B5",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk23))
			   {
						 $se_Tk23='
								{
								type: "line",
								name: "'.$_namec23.'",
								data: ['.$ponts_Tk23.'],
								color: "#4876FF",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk24))
			   {
						 $se_Tk24='
								{
								type: "line",
								name: "'.$_namec24.'",
								data: ['.$ponts_Tk24.'],
								color: "#B0E0E6",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk25))
			   {
						 $se_Tk25='
								{
								type: "line",
								name: "'.$_namec25.'",
								data: ['.$ponts_Tk25.'],
								color: "#7CFC00",
								lineWidth: 1,
								dashStyle:"solid"
								
								},
								{
								type: "line",
								name: "'.$_namec25.'_E",
								data: ['.$ponts_Tk25E.'],
								color: "#7CFC00",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},	';

				}
	}
	else
	{

			$p_date=date("Y-m-d 07:00",strtotime($p_day1));
			$maxZ= 3 * 60 * 60 * 1000;//3 * 3600000;
			$pointIn=  24 * 3600 * 1000; // 15 min
			$mmdate=date("m",strtotime($p_day1))-1;
			$formatdd="%e. %B %Y %H:%M";
			$minva = $maxva = null;
			$a=1440;
			$b=86400;

			$start = strtotime($p_day1);
			$end = strtotime($p_day2);

			$wl_tk1=array();
			$wl_tk2=array();
			$wl_tk3=array();
			$wl_tk4=array();
			$wl_tk5=array();
			$wl_tk6=array();
			$wl_tk7=array();
			$wl_tk8=array();
			$wl_tk9=array();
			$wl_tk10=array();
			$wl_tk11=array();
			$wl_tk12=array();	
			$wl_tk13=array();
			$wl_tk14=array();
			$wl_tk15=array();
			$wl_tk16=array();
			$wl_tk17=array();
			$wl_tk18=array();
			$wl_tk18E=array();
			$wl_tk19=array();
			$wl_tk19E=array();
			$wl_tk20=array();
			$wl_tk21=array();
			$wl_tk22=array();
			$wl_tk23=array();
			$wl_tk24=array();
			$wl_tk25=array();
			$wl_tk25E=array();

			for ( $tt = $start; $tt <= $end; $tt += 86400 )
			{	
				$dt=date("Y-m-d",$tt);
				
				if($p_format=="f_mean")
				{
					$strQuery = "SELECT Sum(case when STN_ID='' and sensor_id='' then Value end) aa";	
					foreach($p_stn as $id)
					{
						$_value = cut($id);
						$ssite = $_value[0];
						$nname = $_value[4];

						$strQuery .=" ,CONVERT(decimal(38,2),avg(case when STN_ID='".$ssite."' and sensor_id='200' then Value  end)) WL_".$nname." ";
						$strQuery .=" ,CONVERT(decimal(38,2),avg(case when STN_ID='".$ssite."' and sensor_id='201' then Value  end)) WLE_".$nname." ";
					}					
					$strQuery .=" FROM 	[dbo].[DATA_Backup]
							WHERE DT between (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)) 
							and dateAdd(dd, 1, (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)))	";
				}
				elseif($p_format=="f_min")
				{
					$strQuery = "SELECT Sum(case when STN_ID='' and sensor_id='' then Value end) aa";	
					foreach($p_stn as $id)
					{
						$_value = cut($id);
						$ssite = $_value[0];
						$nname = $_value[4];

						$strQuery .=" ,CONVERT(decimal(38,2),min(case when STN_ID='".$ssite."' and sensor_id='200' then Value  end)) WL_".$nname." ";
						$strQuery .=" ,CONVERT(decimal(38,2),min(case when STN_ID='".$ssite."' and sensor_id='201' then Value  end)) WLE_".$nname." ";
					}					
					$strQuery .=" FROM 	[dbo].[DATA_Backup]
							WHERE DT between (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)) 
							and dateAdd(dd, 1, (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)))	";
				}
				elseif($p_format=="f_max")
				{
					$strQuery = "SELECT Sum(case when STN_ID='' and sensor_id='' then Value end) aa";	
					foreach($p_stn as $id)
					{
						$_value = cut($id);
						$ssite = $_value[0];
						$nname = $_value[4];

						$strQuery .=" ,CONVERT(decimal(38,2),max(case when STN_ID='".$ssite."' and sensor_id='200' then Value  end)) WL_".$nname." ";
						$strQuery .=" ,CONVERT(decimal(38,2),max(case when STN_ID='".$ssite."' and sensor_id='201' then Value  end)) WLE_".$nname." ";
					}					
					$strQuery .=" FROM 	[dbo].[DATA_Backup]
							WHERE DT between (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)) 
							and dateAdd(dd, 1, (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)))	";
				}
				else{}
			
				//echo $strQuery;
				$result = odbc_exec($conn,$strQuery);
				//$checkrow=odbc_num_rows($objExec);
				$date_now = $dt.' 07:00';
				

				$stadatey=date("Y",strtotime($date_now));	
				$stadatem=date("m",strtotime($date_now));	
				$stadated=date("d",strtotime($date_now));
				$stadateh=date("H",strtotime($date_now));
				$stadatei=date("i",strtotime($date_now));
						
				$sm=$stadatey."-".$stadatem;
				
				$stadate=strtotime($date_now);
				$enddate=strtotime($date_now)+86400;
				$row = odbc_fetch_array($result);
		
					if(isset($Tk1))
					{ 
						if($row['WL_'.$_nrow1.'']==null){$val_tk1="null";}else{$val_tk1=$row['WL_'.$_nrow1.''];}
						array_push($wl_tk1,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk1."]");
					}
					if(isset($Tk2))
					{ 
						if($row['WL_'.$_nrow2.'']==null){$val_tk2="null";}else{$val_tk2=$row['WL_'.$_nrow2.''];}
						array_push($wl_tk2,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk2."]");
					}
					if(isset($Tk3))
					{ 
						if($row['WL_'.$_nrow3.'']==null){$val_tk3="null";}else{$val_tk3=$row['WL_'.$_nrow3.''];}
						array_push($wl_tk3,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk3."]");
					}
					if(isset($Tk4))
					{ 
						if($row['WL_'.$_nrow4.'']==null){$val_tk4="null";}else{$val_tk4=$row['WL_'.$_nrow4.''];}
						array_push($wl_tk4,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk4."]");
					}
					if(isset($Tk5))
					{ 
						if($row['WL_'.$_nrow5.'']==null){$val_tk5="null";}else{$val_tk5=$row['WL_'.$_nrow5.''];}
						array_push($wl_tk5,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk5."]");
					}
					if(isset($Tk6))
					{ 
						if($row['WL_'.$_nrow6.'']==null){$val_tk6="null";}else{$val_tk6=$row['WL_'.$_nrow6.''];}
						array_push($wl_tk6,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk6."]");
					}
					if(isset($Tk7))
					{ 
						if($row['WL_'.$_nrow7.'']==null){$val_tk7="null";}else{$val_tk7=$row['WL_'.$_nrow7.''];}
						array_push($wl_tk7,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk7."]");
					}
					if(isset($Tk8))
					{ 
						if($row['WL_'.$_nrow8.'']==null){$val_tk8="null";}else{$val_tk8=$row['WL_'.$_nrow8.''];}
						array_push($wl_tk8,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk8."]");
					}
					if(isset($Tk9))
					{ 
						if($row['WL_'.$_nrow9.'']==null){$val_tk9="null";}else{$val_tk9=$row['WL_'.$_nrow9.''];}
						array_push($wl_tk9,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk9."]");
					}
					if(isset($Tk10))
					{ 
						if($row['WL_'.$_nrow10.'']==null){$val_tk10="null";}else{$val_tk10=$row['WL_'.$_nrow10.''];}
						array_push($wl_tk10,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk10."]");
					}
					if(isset($Tk11))
					{ 
						if($row['WL_'.$_nrow11.'']==null){$val_tk11="null";}else{$val_tk11=$row['WL_'.$_nrow11.''];}
						array_push($wl_tk11,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk11."]");
					}
					if(isset($Tk12))
					{ 
						if($row['WL_'.$_nrow12.'']==null){$val_tk12="null";}else{$val_tk12=$row['WL_'.$_nrow12.''];}
						array_push($wl_tk12,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk12."]");
					}
					if(isset($Tk13))
					{ 
						if($row['WL_'.$_nrow13.'']==null){$val_tk13="null";}else{$val_tk13=$row['WL_'.$_nrow13.''];}
						array_push($wl_tk13,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk13."]");
					}
					if(isset($Tk14))
					{ 
						if($row['WL_'.$_nrow14.'']==null){$val_tk14="null";}else{$val_tk14=$row['WL_'.$_nrow14.''];}
						array_push($wl_tk14,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk14."]");
					}
					if(isset($Tk15))
					{ 
						if($row['WL_'.$_nrow15.'']==null){$val_tk15="null";}else{$val_tk15=$row['WL_'.$_nrow15.''];}
						array_push($wl_tk15,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk15."]");
					}
					if(isset($Tk16))
					{ 
						if($row['WL_'.$_nrow16.'']==null){$val_tk16="null";}else{$val_tk16=$row['WL_'.$_nrow16.''];}
						array_push($wl_tk16,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk16."]");
					}
					if(isset($Tk17))
					{ 
						if($row['WL_'.$_nrow17.'']==null){$val_tk17="null";}else{$val_tk17=$row['WL_'.$_nrow17.''];}
						array_push($wl_tk17,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk17."]");
					}
					if(isset($Tk18))
					{ 
						if($row['WL_'.$_nrow18.'']==null){$val_tk18="null";}else{$val_tk18=$row['WL_'.$_nrow18.''];}
						array_push($wl_tk18,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk18."]");
						if($row['WLE_'.$_nrow18.'']==null){$val_tk18E="null";}else{$val_tk18E=$row['WLE_'.$_nrow18.''];}
						array_push($wl_tk18E,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk18E."]");
					}
					if(isset($Tk19))
					{ 
						if($row['WL_'.$_nrow19.'']==null){$val_tk19="null";}else{$val_tk19=$row['WL_'.$_nrow19.''];}
						array_push($wl_tk19,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk19."]");
						if($row['WLE_'.$_nrow19.'']==null){$val_tk19E="null";}else{$val_tk19E=$row['WLE_'.$_nrow19.''];}
						array_push($wl_tk19E,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk19E."]");
					}
					if(isset($Tk20))
					{ 
						if($row['WL_'.$_nrow20.'']==null){$val_tk20="null";}else{$val_tk20=$row['WL_'.$_nrow20.''];}
						array_push($wl_tk20,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk20."]");
					}
					if(isset($Tk21))
					{ 
						if($row['WL_'.$_nrow21.'']==null){$val_tk21="null";}else{$val_tk21=$row['WL_'.$_nrow21.''];}
						array_push($wl_tk21,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk21."]");
					}
					if(isset($Tk22))
					{ 
						if($row['WL_'.$_nrow22.'']==null){$val_tk22="null";}else{$val_tk22=$row['WL_'.$_nrow22.''];}
						array_push($wl_tk22,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk22."]");
					}
					if(isset($Tk23))
					{ 
						if($row['WL_'.$_nrow23.'']==null){$val_tk23="null";}else{$val_tk23=$row['WL_'.$_nrow23.''];}
						array_push($wl_tk23,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk23."]");
					}
					if(isset($Tk24))
					{ 
						if($row['WL_'.$_nrow24.'']==null){$val_tk24="null";}else{$val_tk24=$row['WL_'.$_nrow24.''];}
						array_push($wl_tk24,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk24."]");
					}
					if(isset($Tk25))
					{ 
						if($row['WL_'.$_nrow25.'']==null){$val_tk25="null";}else{$val_tk25=$row['WL_'.$_nrow25.''];}
						array_push($wl_tk25,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk25."]");
						if($row['WLE_'.$_nrow25.'']==null){$val_tk25E="null";}else{$val_tk25E=$row['WLE_'.$_nrow25.''];}
						array_push($wl_tk25E,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk25E."]");
					}

			}

			if(isset($Tk1))
				{ 
					$ponts_Tk1=implode(",",$wl_tk1);
				}
				if(isset($Tk2))
				{ 
					$ponts_Tk2=implode(",",$wl_tk2);
				}
				if(isset($Tk3))
				{ 
					$ponts_Tk3=implode(",",$wl_tk3);
				}
				if(isset($Tk4))
				{ 
					$ponts_Tk4=implode(",",$wl_tk4);
				}
				if(isset($Tk5))
				{ 
					$ponts_Tk5=implode(",",$wl_tk5);
				}
				if(isset($Tk6))
				{ 
					$ponts_Tk6=implode(",",$wl_tk6);
				}
				if(isset($Tk7))
				{ 
					$ponts_Tk7=implode(",",$wl_tk7);
				}
				if(isset($Tk8))
				{ 
					$ponts_Tk8=implode(",",$wl_tk8);
				}
				if(isset($Tk9))
				{ 
					$ponts_Tk9=implode(",",$wl_tk9);
				}
				if(isset($Tk10))
				{ 
					$ponts_Tk10=implode(",",$wl_tk10);
				}
				if(isset($Tk11))
				{ 
					$ponts_Tk11=implode(",",$wl_tk11);
				}
				if(isset($Tk12))
				{ 
					$ponts_Tk12=implode(",",$wl_tk12);
				}
				if(isset($Tk13))
				{ 
					$ponts_Tk13=implode(",",$wl_tk13);
				}
				if(isset($Tk14))
				{ 
					$ponts_Tk14=implode(",",$wl_tk14);
				}
				if(isset($Tk15))
				{ 
					$ponts_Tk15=implode(",",$wl_tk15);
				}
				if(isset($Tk16))
				{ 
					$ponts_Tk16=implode(",",$wl_tk16);
				}
				if(isset($Tk17))
				{ 
					$ponts_Tk17=implode(",",$wl_tk17);
				}
				if(isset($Tk18))
				{ 
					$ponts_Tk18=implode(",",$wl_tk18);
					$ponts_Tk18E=implode(",",$wl_tk18E);
				}
				if(isset($Tk19))
				{ 
					$ponts_Tk19=implode(",",$wl_tk19);
					$ponts_Tk19E=implode(",",$wl_tk19E);
				}
				if(isset($Tk20))
				{ 
					$ponts_Tk20=implode(",",$wl_tk20);
				}
				if(isset($Tk21))
				{ 
					$ponts_Tk21=implode(",",$wl_tk21);
				}
				if(isset($Tk22))
				{ 
					$ponts_Tk22=implode(",",$wl_tk22);
				}
				if(isset($Tk23))
				{ 
					$ponts_Tk23=implode(",",$wl_tk23);
				}
				if(isset($Tk24))
				{ 
					$ponts_Tk24=implode(",",$wl_tk24);
				}
				if(isset($Tk25))
				{ 
					$ponts_Tk25=implode(",",$wl_tk25);
					$ponts_Tk25E=implode(",",$wl_tk25E);
				}

				if(isset($Tk1))
			   {
						 $se_Tk1='
								{
								type: "line",
								name: "'.$_namec1.'",
								data: ['.$ponts_Tk1.'],
								color: "#228B22",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}	
				
			   if(isset($Tk2))
			   {
						 $se_Tk2='
								{
								type: "line",
								name: "'.$_namec2.'",
								data: ['.$ponts_Tk2.'],
								color: "#528B8B",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk3))
			   {
						 $se_Tk3='
								{
								type: "line",
								name: "'.$_namec3.'",
								data: ['.$ponts_Tk3.'],
								color: "#A0522D",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk4))
			   {
						 $se_Tk4='
								{
								type: "line",
								name: "'.$_namec4.'",
								data: ['.$ponts_Tk4.'],
								color: "#483D8B",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk5))
			   {
						 $se_Tk5='
								{
								type: "line",
								name: "'.$_namec5.'",
								data: ['.$ponts_Tk5.'],
								color: "#000080",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk6))
			   {
						 $se_Tk6='
								{
								type: "line",
								name: "'.$_namec6.'",
								data: ['.$ponts_Tk6.'],
								color: "#8B658B",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk7))
			   {
						 $se_Tk7='
								{
								type: "line",
								name: "'.$_namec7.'",
								data: ['.$ponts_Tk7.'],
								color: "#CD9B9B",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk8))
			   {
						 $se_Tk8='
								{
								type: "line",
								name: "'.$_namec8.'",
								data: ['.$ponts_Tk8.'],
								color: "#CD5555",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk9))
			   {
						 $se_Tk9='
								{
								type: "line",
								name: "'.$_namec9.'",
								data: ['.$ponts_Tk9.'],
								color: "#CD6839",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk10))
			   {
						 $se_Tk10='
								{
								type: "line",
								name: "'.$_namec10.'",
								data: ['.$ponts_Tk10.'],
								color: "#CD2626",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk11))
			   {
						 $se_Tk11='
								{
								type: "line",
								name: "'.$_namec11.'",
								data: ['.$ponts_Tk11.'],
								color: "#EE9A00",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk12))
			   {
						 $se_Tk12='
								{
								type: "line",
								name: "'.$_namec12.'",
								data: ['.$ponts_Tk12.'],
								color: "#CD6600",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk13))
			   {
						 $se_Tk13='
								{
								type: "line",
								name: "'.$_namec13.'",
								data: ['.$ponts_Tk13.'],
								color: "#CD0000",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk14))
			   {
						 $se_Tk14='
								{
								type: "line",
								name: "'.$_namec14.'",
								data: ['.$ponts_Tk14.'],
								color: "#CD1076",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk15))
			   {
						 $se_Tk15='
								{
								type: "line",
								name: "'.$_namec15.'",
								data: ['.$ponts_Tk15.'],
								color: "#8B4789",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk16))
			   {
						 $se_Tk16='
								{
								type: "line",
								name: "'.$_namec16.'",
								data: ['.$ponts_Tk16.'],
								color: "#C71585",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk17))
			   {
						 $se_Tk17='
								{
								type: "line",
								name: "'.$_namec17.'",
								data: ['.$ponts_Tk17.'],
								color: "#ECAB53",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk18))
			   {
						 $se_Tk18='
								{
								type: "line",
								name: "'.$_namec18.'",
								data: ['.$ponts_Tk18.'],
								color: "#008080",
								lineWidth: 1,
								dashStyle:"solid"
								
								},
								{
								type: "line",
								name: "'.$_namec18.'_E",
								data: ['.$ponts_Tk18E.'],
								color: "#008080",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},';

				}
				if(isset($Tk19))
			   {
						 $se_Tk19='
								{
								type: "line",
								name: "'.$_namec19.'",
								data: ['.$ponts_Tk19.'],
								color: "00BB00",
								lineWidth: 1,
								dashStyle:"solid"
								
								},
								{
								type: "line",
								name: "'.$_namec19.'_E",
								data: ['.$ponts_Tk19E.'],
								color: "#00BB00",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},';

				}
				if(isset($Tk20))
			   {
						 $se_Tk20='
								{
								type: "line",
								name: "'.$_namec20.'",
								data: ['.$ponts_Tk20.'],
								color: "#778899",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk21))
			   {
						 $se_Tk21='
								{
								type: "line",
								name: "'.$_namec21.'",
								data: ['.$ponts_Tk21.'],
								color: "#97FFFF",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk22))
			   {
						 $se_Tk22='
								{
								type: "line",
								name: "'.$_namec22.'",
								data: ['.$ponts_Tk22.'],
								color: "#FFE4B5",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk23))
			   {
						 $se_Tk23='
								{
								type: "line",
								name: "'.$_namec23.'",
								data: ['.$ponts_Tk23.'],
								color: "#4876FF",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk24))
			   {
						 $se_Tk24='
								{
								type: "line",
								name: "'.$_namec24.'",
								data: ['.$ponts_Tk24.'],
								color: "#B0E0E6",
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk25))
			   {
						 $se_Tk25='
								{
								type: "line",
								name: "'.$_namec25.'",
								data: ['.$ponts_Tk25.'],
								color: "#7CFC00",
								lineWidth: 1,
								dashStyle:"solid"
								
								},
								{
								type: "line",
								name: "'.$_namec25.'_E",
								data: ['.$ponts_Tk25E.'],
								color: "#7CFC00",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},	';

				}


	}
		?>
		<BR>
		<div id="graphWL" style="<?echo $st;?>"></div>
			<script type="text/javascript">
			$(function () {
				var chart;
				$(document).ready(function() {
					Highcharts.setOptions({
					lang: {
						months: ['ม.ค.', 'ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.']		}
				});
					chart = new Highcharts.Chart({
						chart: {
							zoomType: 'x',
							renderTo: 'graphWL',
							type: 'line',
							spacingLeft: 25 ,
							resetZoomButton: {
								position: {
								// align: 'right', // by default
								 // verticalAlign: 'top', // by default
								x: -30,
								y: -20
								}
							}
						},
						credits: {
						enabled: false
						},
						title: {
							text: '<? echo $nametype;?>',
						
						style: {
							fontSize: '14px'
						}
						},
						subtitle: {
							text: ''
						},
						xAxis: {
							type: 'datetime',
							//maxZoom: <? echo $maxZ;?>,
							minRange: '<? echo $a;?>' * 60 * 1000 * 6,
							minTickInterval: '<? echo $a;?>' * 60 * 1000,
							title: {
								text: null
							},
							labels:{
							rotation:-45,
							align:'right',
							fontSize: '8px'
								},
							dateTimeLabelFormats: {
							day: '%e %B %Y',
							week:'%e %B %Y',
							month:'%B %Y',
							year:'%Y'
						}
						},
						yAxis: {
							//min: '<? echo $minva;?>',
							minPadding: 0,
							maxPadding: 0,
							title: {
								text: '<? echo $yaname;?>'
							}
						},
						tooltip: {
							formatter: function() {
							return  Highcharts.dateFormat('<? echo $formatdd;?>',this.x) + '<br><b>' + this.y +'</b>'+' <? echo $yname;?>';
						}
						},
						plotOptions: {
							series:{marker:{enabled:false}}
						},
						scrollbar: {
							 enabled: true
						},
						series: [
							 <?php echo $se_Tk1?>
							<?php echo $se_Tk2?>
							 <?php echo $se_Tk3?>
							 <?php echo $se_Tk4?>
							<?php echo $se_Tk5?>
							 <?php echo $se_Tk6?>
							 <?php echo $se_Tk7?>
							 <?php echo $se_Tk11?>
							 <?php echo $se_Tk12?>
							 <?php echo $se_Tk14?>
							<?php echo $se_Tk17?>
							<?php echo $se_Tk18?>
							 <?php echo $se_Tk19?>
							 <?php echo $se_Tk20?>
							 <?php echo $se_Tk21?>
							 <?php echo $se_Tk24?>
							 <?php echo $se_Tk25?>
							]
							,
							exporting: {
                         url: 'http://telekolok.com/exporting_server/index.php'
                      }
					});
				});

			});
			</script>
		<?	
}


if($p_flow=="Y")
{
	$nametype="กราฟ".$_cfg_data_type["fl"][0]; 
	$yname=$_cfg_data_type["fl"][1];
	$yaname=$_cfg_data_type["fl"][0]." ".$_cfg_data_type["fl"][1];
	$typess="line";
	$flH=$_cfg_data_type_3[0];
	$flL="อัตราการไหล ท้าย ปตร.";

	$yname2=$_cfg_data_type["wl"][1];
	$yaname2=$_cfg_data_type["wl"][0]." ".$_cfg_data_type["wl"][1];
	$wlH=$_cfg_data_type["wl"][0];
	$wlL="ท้าย ปตร.";
    
	if($p_format=="f_15" || $p_format=="f_hr")
	{
		if($p_format=="f_15")
		{
			$p_date=date("Y-m-d",strtotime($p_day1));
			$maxZ= 3 * 60 * 60 * 1000;//3 * 3600000;
			$pointIn= 900 * 1000; // 15 min
			$mmdate=date("m",strtotime($p_day1))-1;
			$formatdd="%e. %B %Y %H:%M";
			$minva = $maxva = null;
			$a=15;
			$b=900;

			$strQuery = "SELECT CONVERT(varchar(16),DT,121) adate ";
						
				foreach($p_stn as $id)
				{
					$_value = cut($id);
					$ssite = $_value[0];
					$nname = $_value[4];
					
					$strQuery .=",Sum(case when STN_ID='".$ssite."' and sensor_id='200' then Value  end) WL_".$nname." ";
					$strQuery .=",Sum(case when STN_ID='".$ssite."' and sensor_id='201' then Value  end) WLE_".$nname." ";
					$strQuery .=",Sum(case when STN_ID='".$ssite."' and sensor_id='300' then Value  end) FL_".$nname." ";
					$strQuery .=",Sum(case when STN_ID='".$ssite."' and sensor_id='305' then Value  end) FLE_".$nname." ";
				}
				
				$strQuery .="FROM [dbo].[DATA_Backup]
					WHERE CONVERT(varchar(16),DT,121) between '".$p_day1." 00:00' and '".$p_day2." 23:45' AND (DATEPART(MINUTE ,DT))%15='0'
					GROUP BY CONVERT(varchar(16),DT,121)	ORDER BY CONVERT(varchar(16),DT,121)";
		}
		elseif($p_format=="f_hr")
		{
			$p_date=date("Y-m-d",strtotime($p_day1));
			$maxZ= 3 * 60 * 60 * 1000;//3 * 3600000;
			$pointIn= 3600 * 1000; // 15 min
			$mmdate=date("m",strtotime($p_day1))-1;
			$formatdd="%e. %B %Y %H:%M";
			$minva = $maxva = null;
			$a=60;
			$b=3600;

			$strQuery = "SELECT CONVERT(varchar(16),DT,121) adate ";	
				foreach($p_stn as $id)
				{
					$_value = cut($id);
					$ssite = $_value[0];
					$nname = $_value[4];
					
					$strQuery .=",Sum(case when STN_ID='".$ssite."' and sensor_id='200' then Value  end) WL_".$nname." ";
					$strQuery .=",Sum(case when STN_ID='".$ssite."' and sensor_id='201' then Value  end) WLE_".$nname." ";
					$strQuery .=",Sum(case when STN_ID='".$ssite."' and sensor_id='300' then Value  end) FL_".$nname." ";
					$strQuery .=",Sum(case when STN_ID='".$ssite."' and sensor_id='305' then Value  end) FLE_".$nname."	";
				}
				
				$strQuery .=" FROM [dbo].[DATA_Backup]
							WHERE CONVERT(varchar(16),DT,121) between '".$p_day1." 00:00' and '".$p_day2." 23:00' 
								AND (DATEPART(MINUTE ,DT))='00'
							GROUP BY 
								CONVERT(varchar(16),DT,121)
							ORDER BY 
								CONVERT(varchar(16),DT,121)	";
		}
		else{}

		$result = odbc_exec($conn,$strQuery);
		//$checkrow=mssql_num_rows($result);

		$wt_tk1=array();
		$wt_tk1f=array();
		$wt_tk2=array();
		$wt_tk2f=array();
		$wt_tk3=array();
		$wt_tk3f=array();
		$wt_tk4=array();
		$wt_tk4f=array();
		$wt_tk5=array();
		$wt_tk5f=array();
		$wt_tk6=array();
		$wt_tk6f=array();
		$wt_tk7=array();
		$wt_tk7f=array();
		$wt_tk8=array();
		$wt_tk8f=array();
		$wt_tk9=array();
		$wt_tk9f=array();
		$wt_tk10=array();
		$wt_tk10f=array();
		$wt_tk11=array();
		$wt_tk11f=array();
		$wt_tk12=array();
		$wt_tk12f=array();
		$wt_tk13=array();
		$wt_tk13f=array();
		$wt_tk14=array();
		$wt_tk14f=array();
		$wt_tk15=array();
		$wt_tk15f=array();
		$wt_tk16=array();
		$wt_tk16f=array();
		$wt_tk17=array();
		$wt_tk17f=array();
		$wt_tk18=array();
		$wt_tk18f=array();
		$wt_tk18e=array();
		$wt_tk18fe=array();
		$wt_tk19=array();
		$wt_tk19f=array();
		$wt_tk19e=array();
		$wt_tk19fe=array();
		$wt_tk20=array();
		$wt_tk20f=array();
		$wt_tk21=array();
		$wt_tk21f=array();
		$wt_tk22=array();
		$wt_tk22f=array();
		$wt_tk23=array();
		$wt_tk23f=array();
		$wt_tk24=array();
		$wt_tk24f=array();
		$wt_tk25=array();
		$wt_tk25f=array();
		$wt_tk25e=array();
		$wt_tk25fe=array();

		$stadatey=date("Y",strtotime($p_day1));	
		$stadatem=date("m",strtotime($p_day1));	
		$stadated=date("d",strtotime($p_day1));

		$stadateh=date("H",strtotime($p_day1));
		$stadatei=date("i",strtotime($p_day1));
				
		$sm=$stadatey."-".$stadatem;
		
		if ($p_format=="f_15" or $p_format=="f_hr")
		{
			$stadate=strtotime($p_day1);
			$enddate=strtotime($p_day2)+86400;
		}
		else{}

		while($stadate < $enddate)
		{

			if ($row = odbc_fetch_array($result))
			{
				$sname=strtotime($row['adate']);
				
				while($stadate < $sname)
				{

					if(isset($Tk1))
					{ 
						array_push($wt_tk1,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk1f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Tk2))
					{ 
						array_push($wt_tk2,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk2f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Tk3))
					{ 
						array_push($wt_tk3,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk3f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Tk4))
					{ 
						array_push($wt_tk4,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk4f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Tk5))
					{ 
						array_push($wt_tk5,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk5f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Tk6))
					{ 
						array_push($wt_tk6,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk6f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Tk7))
					{ 
						array_push($wt_tk7,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk7f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Tk8))
					{ 
						array_push($wt_tk8,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk8f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Tk9))
					{ 
						array_push($wt_tk9,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk9f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Tk10))
					{ 
						array_push($wt_tk10,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk10f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Tk11))
					{ 
						array_push($wt_tk11,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk11f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Tk12))
					{ 
						array_push($wt_tk12,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk12f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Tk13))
					{ 
						array_push($wt_tk13,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk13f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Tk14))
					{ 
						array_push($wt_tk14,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk14f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Tk15))
					{ 
						array_push($wt_tk15,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk15f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Tk16))
					{ 
						array_push($wt_tk16,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk16f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Tk17))
					{ 
						array_push($wt_tk17,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk17f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Tk18))
					{ 
						array_push($wt_tk18,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk18f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk18e,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk18fe,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Tk19))
					{ 
						array_push($wt_tk19,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk19f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk19e,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk19fe,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Tk20))
					{ 
						array_push($wt_tk20,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk20f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Tk21))
					{ 
						array_push($wt_tk21,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk21f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Tk22))
					{ 
						array_push($wt_tk22,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk22f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Tk23))
					{ 
						array_push($wt_tk23,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk23f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Tk24))
					{ 
						array_push($wt_tk24,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk24f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Tk25))
					{ 
						array_push($wt_tk25,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk25f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk25e,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk25fe,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}

					if ($p_format=="f_15" or $p_format=="f_hr")
					{
						$stadatei+=$a;
						$stadate+=$a*60;
					}
				
				}

				if(isset($Tk1))
				{ 
					if($row['WL_'.$_nrow1.'']==null){$val_tk1="null";}else{$val_tk1=$row['WL_'.$_nrow1.''];}
					array_push($wt_tk1,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk1."]");
					if($row['FL_'.$_nrow1.'']==null){$val_tk1f="null";}else{$val_tk1f=$row['FL_'.$_nrow1.''];}
					array_push($wt_tk1f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk1f."]");
				}
				if(isset($Tk2))
				{ 
					if($row['WL_'.$_nrow2.'']==null){$val_tk2="null";}else{$val_tk2=$row['WL_'.$_nrow2.''];}
					array_push($wt_tk2,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk2."]");
					if($row['FL_'.$_nrow2.'']==null){$val_tk2f="null";}else{$val_tk2f=$row['FL_'.$_nrow2.''];}
					array_push($wt_tk2f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk2f."]");
				}
				if(isset($Tk3))
				{ 
					if($row['WL_'.$_nrow3.'']==null){$val_tk3="null";}else{$val_tk3=$row['WL_'.$_nrow3.''];}
					array_push($wt_tk3,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk3."]");
					if($row['FL_'.$_nrow3.'']==null){$val_tk3f="null";}else{$val_tk3f=$row['FL_'.$_nrow3.''];}
					array_push($wt_tk2f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk3f."]");
				}
				if(isset($Tk4))
				{ 
					if($row['WL_'.$_nrow4.'']==null){$val_tk4="null";}else{$val_tk4=$row['WL_'.$_nrow4.''];}
					array_push($wt_tk4,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk4."]");
					if($row['FL_'.$_nrow4.'']==null){$val_tk4f="null";}else{$val_tk4f=$row['FL_'.$_nrow4.''];}
					array_push($wt_tk4f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk4f."]");
				}
				if(isset($Tk5))
				{ 
					if($row['WL_'.$_nrow5.'']==null){$val_tk5="null";}else{$val_tk5=$row['WL_'.$_nrow5.''];}
					array_push($wt_tk5,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk5."]");
					if($row['FL_'.$_nrow5.'']==null){$val_tk5f="null";}else{$val_tk5f=$row['FL_'.$_nrow5.''];}
					array_push($wt_tk5f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk5f."]");
				}
				if(isset($Tk6))
				{ 
					if($row['WL_'.$_nrow6.'']==null){$val_tk6="null";}else{$val_tk6=$row['WL_'.$_nrow6.''];}
					array_push($wt_tk6,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk6."]");
					if($row['FL_'.$_nrow6.'']==null){$val_tk6f="null";}else{$val_tk6f=$row['FL_'.$_nrow6.''];}
					array_push($wt_tk6f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk6f."]");
				}
				if(isset($Tk7))
				{ 
					if($row['WL_'.$_nrow7.'']==null){$val_tk7="null";}else{$val_tk7=$row['WL_'.$_nrow7.''];}
					array_push($wt_tk7,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk7."]");
					if($row['FL_'.$_nrow7.'']==null){$val_tk7f="null";}else{$val_tk7f=$row['FL_'.$_nrow7.''];}
					array_push($wt_tk7f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk7f."]");
				}
				if(isset($Tk8))
				{ 
					if($row['WL_'.$_nrow8.'']==null){$val_tk8="null";}else{$val_tk8=$row['WL_'.$_nrow8.''];}
					array_push($wt_tk8,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk8."]");
					if($row['FL_'.$_nrow8.'']==null){$val_tk8f="null";}else{$val_tk8f=$row['FL_'.$_nrow8.''];}
					array_push($wt_tk8f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk8f."]");
				}
				if(isset($Tk9))
				{ 
					if($row['WL_'.$_nrow9.'']==null){$val_tk9="null";}else{$val_tk9=$row['WL_'.$_nrow9.''];}
					array_push($wt_tk9,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk9."]");
					if($row['FL_'.$_nrow9.'']==null){$val_tk9f="null";}else{$val_tk9f=$row['FL_'.$_nrow9.''];}
					array_push($wt_tk9f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk9f."]");
				}
				if(isset($Tk10))
				{ 
					if($row['WL_'.$_nrow10.'']==null){$val_tk10="null";}else{$val_tk10=$row['WL_'.$_nrow10.''];}
					array_push($wt_tk10,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk10."]");
					if($row['FL_'.$_nrow10.'']==null){$val_tk10f="null";}else{$val_tk10f=$row['FL_'.$_nrow10.''];}
					array_push($wt_tk10f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk10f."]");
				}
				if(isset($Tk11))
				{ 
					if($row['RF_'.$_nrow11.'']==null){$val_tk11="null";}else{$val_tk11=$row['RF_'.$_nrow11.''];}
					array_push($wt_tk11,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk11."]");
					if($row['FL_'.$_nrow11.'']==null){$val_tk11f="null";}else{$val_tk11f=$row['FL_'.$_nrow11.''];}
					array_push($wt_tk11f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk11f."]");
				}
				if(isset($Tk12))
				{ 
					if($row['WL_'.$_nrow12.'']==null){$val_tk12="null";}else{$val_tk12=$row['WL_'.$_nrow12.''];}
					array_push($wt_tk12,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk12."]");
					if($row['FL_'.$_nrow12.'']==null){$val_tk12f="null";}else{$val_tk12f=$row['FL_'.$_nrow12.''];}
					array_push($wt_tk12f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk12f."]");
				}
				if(isset($Tk13))
				{ 
					if($row['WL_'.$_nrow13.'']==null){$val_tk13="null";}else{$val_tk13=$row['RF_'.$_nrow13.''];}
					array_push($wt_tk13,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk13."]");
					if($row['FL_'.$_nrow13.'']==null){$val_tk13f="null";}else{$val_tk13f=$row['FL_'.$_nrow13.''];}
					array_push($wt_tk13f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk13f."]");
				}
				if(isset($Tk14))
				{ 
					if($row['WL_'.$_nrow14.'']==null){$val_tk14="null";}else{$val_tk14=$row['WL_'.$_nrow14.''];}
					array_push($wt_tk14,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk14."]");
					if($row['FL_'.$_nrow14.'']==null){$val_tk14f="null";}else{$val_tk14f=$row['FL_'.$_nrow14.''];}
					array_push($wt_tk14f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk14f."]");
				}
				if(isset($Tk15))
				{ 
					if($row['WL_'.$_nrow15.'']==null){$val_tk15="null";}else{$val_tk15=$row['WL_'.$_nrow15.''];}
					array_push($wt_tk15,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk15."]");
					if($row['FL_'.$_nrow15.'']==null){$val_tk15f="null";}else{$val_tk15f=$row['FL_'.$_nrow15.''];}
					array_push($wt_tk15f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk15f."]");
				}
				if(isset($Tk16))
				{ 
					if($row['WL_'.$_nrow16.'']==null){$val_tk16="null";}else{$val_tk16=$row['WL_'.$_nrow16.''];}
					array_push($wt_tk16,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk16."]");
					if($row['FL_'.$_nrow16.'']==null){$val_tk16f="null";}else{$val_tk16f=$row['FL_'.$_nrow16.''];}
					array_push($wt_tk16f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk16f."]");
				}
				if(isset($Tk17))
				{ 
					if($row['WL_'.$_nrow17.'']==null){$val_tk17="null";}else{$val_tk17=$row['WL_'.$_nrow17.''];}
					array_push($wt_tk17,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk17."]");
					if($row['FL_'.$_nrow17.'']==null){$val_tk17f="null";}else{$val_tk17f=$row['FL_'.$_nrow17.''];}
					array_push($wt_tk17f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk17f."]");
				}
				if(isset($Tk18))
				{ 
					if($row['WL_'.$_nrow18.'']==null){$val_tk18="null";}else{$val_tk18=$row['WL_'.$_nrow18.''];}
					array_push($wt_tk18,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk18."]");
					if($row['FL_'.$_nrow18.'']==null){$val_tk18f="null";}else{$val_tk18f=$row['FL_'.$_nrow18.''];}
					array_push($wt_tk18f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk18f."]");
					if($row['WLE_'.$_nrow18.'']==null){$val_tk18e="null";}else{$val_tk18e=$row['WLE_'.$_nrow18.''];}
					array_push($wt_tk18e,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk18e."]");
					if($row['FLE_'.$_nrow18.'']==null){$val_tk18ef="null";}else{$val_tk18ef=$row['FLE_'.$_nrow18.''];}
					array_push($wt_tk18fe,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk18ef."]");
				}
				if(isset($Tk19))
				{ 
					if($row['WL_'.$_nrow19.'']==null){$val_tk19="null";}else{$val_tk19=$row['WL_'.$_nrow19.''];}
					array_push($wt_tk19,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk19."]");
					if($row['FL_'.$_nrow19.'']==null){$val_tk19f="null";}else{$val_tk19f=$row['FL_'.$_nrow19.''];}
					array_push($wt_tk19f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk19f."]");
					if($row['WLE_'.$_nrow19.'']==null){$val_tk19e="null";}else{$val_tk19e=$row['WLE_'.$_nrow19.''];}
					array_push($wt_tk19e,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk19e."]");
					if($row['FLE_'.$_nrow19.'']==null){$val_tk19ef="null";}else{$val_tk19ef=$row['FLE_'.$_nrow19.''];}
					array_push($wt_tk19fe,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk19ef."]");
				}
				if(isset($Tk20))
				{ 
					if($row['WL_'.$_nrow20.'']==null){$val_tk20="null";}else{$val_tk20=$row['WL_'.$_nrow20.''];}
					array_push($wt_tk20,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk20."]");
					if($row['FL_'.$_nrow20.'']==null){$val_tk20f="null";}else{$val_tk20f=$row['FL_'.$_nrow20.''];}
					array_push($wt_tk20f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk20f."]");
				}
				if(isset($Tk21))
				{ 
					if($row['WL_'.$_nrow21.'']==null){$val_tk21="null";}else{$val_tk21=$row['WL_'.$_nrow21.''];}
					array_push($wt_tk21,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk21."]");
					if($row['FL_'.$_nrow21.'']==null){$val_tk21f="null";}else{$val_tk21f=$row['FL_'.$_nrow21.''];}
					array_push($wt_tk21f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk21f."]");
				}
				if(isset($Tk22))
				{ 
					if($row['WL_'.$_nrow22.'']==null){$val_tk22="null";}else{$val_tk22=$row['WL_'.$_nrow22.''];}
					array_push($wt_tk22,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk22."]");
					if($row['FL_'.$_nrow22.'']==null){$val_tk22f="null";}else{$val_tk22f=$row['FL_'.$_nrow22.''];}
					array_push($wt_tk22f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk22f."]");
				}
				if(isset($Tk23))
				{ 
					if($row['WL_'.$_nrow23.'']==null){$val_tk23="null";}else{$val_tk23=$row['WL_'.$_nrow23.''];}
					array_push($wt_tk23,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk23."]");
					if($row['FL_'.$_nrow23.'']==null){$val_tk23f="null";}else{$val_tk23f=$row['FL_'.$_nrow23.''];}
					array_push($wt_tk23f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk23f."]");
				}
				if(isset($Tk24))
				{ 
					if($row['WL_'.$_nrow24.'']==null){$val_tk24="null";}else{$val_tk24=$row['WL_'.$_nrow24.''];}
					array_push($wt_tk24,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk24."]");
					if($row['FL_'.$_nrow24.'']==null){$val_tk24f="null";}else{$val_tk24f=$row['FL_'.$_nrow24.''];}
					array_push($wt_tk24f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk24f."]");
				}
				if(isset($Tk25))
				{ 
					if($row['WL_'.$_nrow25.'']==null){$val_tk25="null";}else{$val_tk25=$row['WL_'.$_nrow25.''];}
					array_push($wt_tk25,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk25."]");
					if($row['FL_'.$_nrow25.'']==null){$val_tk25f="null";}else{$val_tk25f=$row['FL_'.$_nrow25.''];}
					array_push($wt_tk25f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk25f."]");
					if($row['WLE_'.$_nrow25.'']==null){$val_tk25e="null";}else{$val_tk25e=$row['WLE_'.$_nrow25.''];}
					array_push($wt_tk25e,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk25e."]");
					if($row['FLE_'.$_nrow25.'']==null){$val_tk25ef="null";}else{$val_tk25ef=$row['FLE_'.$_nrow25.''];}
					array_push($wt_tk25fe,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk25ef."]");
				}

				if ($p_format=="f_15" or $p_format=="f_hr")
				{
					$stadatei+=$a;
					$stadate+=$a*60;
				}
			
			}
			else
			{
				if(isset($Tk1))
					{ 
						array_push($wt_tk1,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk1f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Tk2))
					{ 
						array_push($wt_tk2,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk2f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Tk3))
					{ 
						array_push($wt_tk3,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk3f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Tk4))
					{ 
						array_push($wt_tk4,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk4f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Tk5))
					{ 
						array_push($wt_tk5,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk5f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Tk6))
					{ 
						array_push($wt_tk6,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk6f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Tk7))
					{ 
						array_push($wt_tk7,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk7f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Tk8))
					{ 
						array_push($wt_tk8,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk8f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Tk9))
					{ 
						array_push($wt_tk9,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk9f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Tk10))
					{ 
						array_push($wt_tk10,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk10f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Tk11))
					{ 
						array_push($wt_tk11,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk11f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Tk12))
					{ 
						array_push($wt_tk12,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk12f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Tk13))
					{ 
						array_push($wt_tk13,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk13f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Tk14))
					{ 
						array_push($wt_tk14,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk14f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Tk15))
					{ 
						array_push($wt_tk15,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk15f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Tk16))
					{ 
						array_push($wt_tk16,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk16f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Tk17))
					{ 
						array_push($wt_tk17,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk17f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Tk18))
					{ 
						array_push($wt_tk18,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk18f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk18e,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk18fe,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Tk19))
					{ 
						array_push($wt_tk19,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk19f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk19e,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk19fe,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Tk20))
					{ 
						array_push($wt_tk20,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk20f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Tk21))
					{ 
						array_push($wt_tk21,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk21f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Tk22))
					{ 
						array_push($wt_tk22,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk22f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Tk23))
					{ 
						array_push($wt_tk23,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk23f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Tk24))
					{ 
						array_push($wt_tk24,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk24f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}
					if(isset($Tk25))
					{ 
						array_push($wt_tk25,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk25f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk25e,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
						array_push($wt_tk25fe,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  null]");
					}

				if ($p_format=="f_15" or $p_format=="f_hr")
				{
					$stadatei+=$a;
					$stadate+=$a*60;
				}							
			}
		}
		
				if(isset($Tk1))
				{ 
					$ponts_Tk1=implode(",",$wt_tk1);
					$ponts_Tk1f=implode(",",$wt_tk1f);
				}
				if(isset($Tk2))
				{ 
					$ponts_Tk2=implode(",",$wt_tk2);
					$ponts_Tk2f=implode(",",$wt_tk2f);
				}
				if(isset($Tk3))
				{ 
					$ponts_Tk3=implode(",",$wt_tk3);
					$ponts_Tk3f=implode(",",$wt_tk3f);
				}
				if(isset($Tk4))
				{ 
					$ponts_Tk4=implode(",",$wt_tk4);
					$ponts_Tk4f=implode(",",$wt_tk4f);
				}
				if(isset($Tk5))
				{ 
					$ponts_Tk5=implode(",",$wt_tk5);
					$ponts_Tk5f=implode(",",$wt_tk5f);
				}
				if(isset($Tk6))
				{ 
					$ponts_Tk6=implode(",",$wt_tk6);
					$ponts_Tk6f=implode(",",$wt_tk6f);
				}
				if(isset($Tk7))
				{ 
					$ponts_Tk7=implode(",",$wt_tk7);
					$ponts_Tk7f=implode(",",$wt_tk7f);
				}
				if(isset($Tk8))
				{ 
					$ponts_Tk8=implode(",",$wt_tk8);
					$ponts_Tk8f=implode(",",$wt_tk8f);
				}
				if(isset($Tk9))
				{ 
					$ponts_Tk9=implode(",",$wt_tk9);
					$ponts_Tk9f=implode(",",$wt_tk9f);
				}
				if(isset($Tk10))
				{ 
					$ponts_Tk10=implode(",",$wt_tk10);
					$ponts_Tk10f=implode(",",$wt_tk10f);
				}
				if(isset($Tk11))
				{ 
					$ponts_Tk11=implode(",",$wt_tk11);
					$ponts_Tk11f=implode(",",$wt_tk11f);
				}
				if(isset($Tk12))
				{ 
					$ponts_Tk12=implode(",",$wt_tk12);
					$ponts_Tk12f=implode(",",$wt_tk12f);
				}
				if(isset($Tk13))
				{ 
					$ponts_Tk13=implode(",",$wt_tk13);
					$ponts_Tk13f=implode(",",$wt_tk13f);
				}
				if(isset($Tk14))
				{ 
					$ponts_Tk14=implode(",",$wt_tk14);
					$ponts_Tk14f=implode(",",$wt_tk14f);
				}
				if(isset($Tk15))
				{ 
					$ponts_Tk15=implode(",",$wt_tk15);
					$ponts_Tk15f=implode(",",$wt_tk15f);
				}
				if(isset($Tk16))
				{ 
					$ponts_Tk16=implode(",",$wt_tk16);
					$ponts_Tk16f=implode(",",$wt_tk16f);
				}
				if(isset($Tk17))
				{ 
					$ponts_Tk17=implode(",",$wt_tk17);
					$ponts_Tk17f=implode(",",$wt_tk17f);
				}
				if(isset($Tk18))
				{ 
					$ponts_Tk18=implode(",",$wt_tk18);
					$ponts_Tk18f=implode(",",$wt_tk18f);
					$ponts_Tk18e=implode(",",$wt_tk18e);
					$ponts_Tk18ef=implode(",",$wt_tk18fe);
				}
				if(isset($Tk19))
				{ 
					$ponts_Tk19=implode(",",$wt_tk19);
					$ponts_Tk19f=implode(",",$wt_tk19f);
					$ponts_Tk19e=implode(",",$wt_tk19e);
					$ponts_Tk19ef=implode(",",$wt_tk19fe);
				}
				if(isset($Tk20))
				{ 
					$ponts_Tk20=implode(",",$wt_tk20);
					$ponts_Tk20f=implode(",",$wt_tk20f);
				}
				if(isset($Tk21))
				{ 
					$ponts_Tk21=implode(",",$wt_tk21);
					$ponts_Tk21f=implode(",",$wt_tk21f);
				}
				if(isset($Tk22))
				{ 
					$ponts_Tk22=implode(",",$wt_tk22);
					$ponts_Tk22f=implode(",",$wt_tk22f);
				}
				if(isset($Tk23))
				{ 
					$ponts_Tk23=implode(",",$wt_tk23);
					$ponts_Tk23f=implode(",",$wt_tk23f);
				}
				if(isset($Tk24))
				{ 
					$ponts_Tk24=implode(",",$wt_tk24);
					$ponts_Tk24f=implode(",",$wt_tk24f);
				}
				if(isset($Tk25))
				{ 
					$ponts_Tk25=implode(",",$wt_tk25);
					$ponts_Tk25f=implode(",",$wt_tk25f);
					$ponts_Tk25e=implode(",",$wt_tk25e);
					$ponts_Tk25ef=implode(",",$wt_tk25fe);
				}

				if(isset($Tk1))
			   {
						 $se_Tk1='
								{
								type: "line",
								name: "'.$_namec1.'",
								data: ['.$ponts_Tk1f.'],
								color: "#228B22",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec1.'_WL",
								data: ['.$ponts_Tk1.'],
								color: "#228B22",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}	
				
			   if(isset($Tk2))
			   {
						 $se_Tk2='
								{
								type: "line",
								name: "'.$_namec2.'",
								data: ['.$ponts_Tk2f.'],
								color: "#528B8B",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec2.'_WL",
								data: ['.$ponts_Tk2.'],
								color: "#528B8B",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk3))
			   {
						 $se_Tk3='
								{
								type: "line",
								name: "'.$_namec3.'",
								data: ['.$ponts_Tk3f.'],
								color: "#A0522D",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec3.'_WL",
								data: ['.$ponts_Tk3.'],
								color: "#A0522D",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk4))
			   {
						 $se_Tk4='
								{
								type: "line",
								name: "'.$_namec4.'",
								data: ['.$ponts_Tk4f.'],
								color: "#483D8B",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec4.'_WL",
								data: ['.$ponts_Tk4.'],
								color: "#483D8B",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk5))
			   {
						 $se_Tk5='
								{
								type: "line",
								name: "'.$_namec5.'",
								data: ['.$ponts_Tk5f.'],
								color: "#000080",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec5.'_WL",
								data: ['.$ponts_Tk5.'],
								color: "#000080",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk6))
			   {
						 $se_Tk6='
								{
								type: "line",
								name: "'.$_namec6.'",
								data: ['.$ponts_Tk6f.'],
								color: "#8B658B",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec6.'_WL",
								data: ['.$ponts_Tk6.'],
								color: "#8B658B",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk7))
			   {
						 $se_Tk7='
								{
								type: "line",
								name: "'.$_namec7.'",
								data: ['.$ponts_Tk7f.'],
								color: "#CD9B9B",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec7.'_WL",
								data: ['.$ponts_Tk7.'],
								color: "#CD9B9B",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk8))
			   {
						 $se_Tk8='
								{
								type: "line",
								name: "'.$_namec8.'",
								data: ['.$ponts_Tk8f.'],
								color: "#CD5555",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec8.'_WL",
								data: ['.$ponts_Tk8.'],
								color: "#CD5555",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk9))
			   {
						 $se_Tk9='
								{
								type: "line",
								name: "'.$_namec9.'",
								data: ['.$ponts_Tk9f.'],
								color: "#CD6839",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec9.'_WL",
								data: ['.$ponts_Tk9.'],
								color: "#CD6839",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk10))
			   {
						 $se_Tk10='
								{
								type: "line",
								name: "'.$_namec10.'",
								data: ['.$ponts_Tk10f.'],
								color: "#CD2626",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec10.'_WL",
								data: ['.$ponts_Tk10.'],
								color: "#CD2626",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk11))
			   {
						 $se_Tk11='
								{
								type: "line",
								name: "'.$_namec11.'",
								data: ['.$ponts_Tk11f.'],
								color: "#EE9A00",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec11.'_WL",
								data: ['.$ponts_Tk11.'],
								color: "#EE9A00",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk12))
			   {
						 $se_Tk12='
								{
								type: "line",
								name: "'.$_namec12.'",
								data: ['.$ponts_Tk12f.'],
								color: "#CD6600",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec12.'_WL",
								data: ['.$ponts_Tk12.'],
								color: "#CD6600",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk13))
			   {
						 $se_Tk13='
								{
								type: "line",
								name: "'.$_namec13.'",
								data: ['.$ponts_Tk13f.'],
								color: "#CD0000",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec13.'_WL",
								data: ['.$ponts_Tk13.'],
								color: "#CD0000",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk14))
			   {
						 $se_Tk14='
								{
								type: "line",
								name: "'.$_namec14.'",
								data: ['.$ponts_Tk14f.'],
								color: "#CD1076",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec14.'_WL",
								data: ['.$ponts_Tk14.'],
								color: "#CD1076",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk15))
			   {
						 $se_Tk15='
								{
								type: "line",
								name: "'.$_namec15.'",
								data: ['.$ponts_Tk15f.'],
								color: "#8B4789",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec15.'_WL",
								data: ['.$ponts_Tk15.'],
								color: "#8B4789",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk16))
			   {
						 $se_Tk16='
								{
								type: "line",
								name: "'.$_namec16.'",
								data: ['.$ponts_Tk16f.'],
								color: "#C71585",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec16.'_WL",
								data: ['.$ponts_Tk16.'],
								color: "#C71585",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk17))
			   {
						 $se_Tk17='
								{
								type: "line",
								name: "'.$_namec17.'",
								data: ['.$ponts_Tk17f.'],
								color: "#ECAB53",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec17.'_WL",
								data: ['.$ponts_Tk17.'],
								color: "#ECAB53",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk18))
			   {
						 $se_Tk18='
								{
								type: "line",
								name: "'.$_namec18.'",
								data: ['.$ponts_Tk18f.'],
								color: "#008080",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec18.'_WL",
								data: ['.$ponts_Tk18.'],
								color: "#008080",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},
								{
								type: "line",
								name: "'.$_namec18.'_E",
								data: ['.$ponts_Tk18ef.'],
								color: "#008080",
								lineWidth: 1,
								dashStyle:"Dash"
								
								},
								{
								type: "line",
								name: "'.$_namec18.'_WLE",
								data: ['.$ponts_Tk18e.'],
								color: "#008080",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"LongDash"
								
								},';

				}
				if(isset($Tk19))
			   {
						 $se_Tk19='
								{
								type: "line",
								name: "'.$_namec19.'",
								data: ['.$ponts_Tk19f.'],
								color: "00BB00",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec19.'_WL",
								data: ['.$ponts_Tk19.'],
								color: "00BB00",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},
								{
								type: "line",
								name: "'.$_namec19.'_E",
								data: ['.$ponts_Tk19ef.'],
								color: "00BB00",
								lineWidth: 1,
								dashStyle:"Dash"
								
								},
								{
								type: "line",
								name: "'.$_namec19.'_WLE",
								data: ['.$ponts_Tk19e.'],
								color: "00BB00",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"LongDash"
								
								},';

				}
				if(isset($Tk20))
			   {
						 $se_Tk20='
								{
								type: "line",
								name: "'.$_namec20.'",
								data: ['.$ponts_Tk20f.'],
								color: "#778899",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec20.'_WL",
								data: ['.$ponts_Tk20.'],
								color: "#778899",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk21))
			   {
						 $se_Tk21='
								{
								type: "line",
								name: "'.$_namec21.'",
								data: ['.$ponts_Tk21f.'],
								color: "#97FFFF",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec21.'_WL",
								data: ['.$ponts_Tk21.'],
								color: "#97FFFF",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk22))
			   {
						 $se_Tk22='
								{
								type: "line",
								name: "'.$_namec22.'",
								data: ['.$ponts_Tk22f.'],
								color: "#FFE4B5",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec22.'_WL",
								data: ['.$ponts_Tk22.'],
								color: "#FFE4B5",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk23))
			   {
						 $se_Tk23='
								{
								type: "line",
								name: "'.$_namec23.'",
								data: ['.$ponts_Tk23f.'],
								color: "#4876FF",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec23.'_WL",
								data: ['.$ponts_Tk23.'],
								color: "#4876FF",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk24))
			   {
						 $se_Tk24='
								{
								type: "line",
								name: "'.$_namec24.'",
								data: ['.$ponts_Tk24f.'],
								color: "#B0E0E6",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec24.'_WL",
								data: ['.$ponts_Tk24.'],
								color: "#B0E0E6",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk25))
			   {
						 $se_Tk25='
								{
								type: "line",
								name: "'.$_namec25.'",
								data: ['.$ponts_Tk25f.'],
								color: "#7CFC00",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec25.'_WL",
								data: ['.$ponts_Tk25.'],
								color: "#7CFC00",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},
								{
								type: "line",
								name: "'.$_namec25.'_E",
								data: ['.$ponts_Tk25ef.'],
								color: "#7CFC00",
								lineWidth: 1,
								dashStyle:"Dash"
								
								},
								{
								type: "line",
								name: "'.$_namec25.'_WLE",
								data: ['.$ponts_Tk25e.'],
								color: "#7CFC00",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"Dash"
								
								},';

				}
	}
	else
	{

			$p_date=date("Y-m-d 07:00",strtotime($p_day1));
			$maxZ= 3 * 60 * 60 * 1000;//3 * 3600000;
			$pointIn=  24 * 3600 * 1000; // 15 min
			$mmdate=date("m",strtotime($p_day1))-1;
			$formatdd="%e. %B %Y %H:%M";
			$minva = $maxva = null;
			$a=1440;
			$b=86400;

			$start = strtotime($p_day1);
			$end = strtotime($p_day2);

			$wt_tk1=array();
			$wt_tk1f=array();
			$wt_tk2=array();
			$wt_tk2f=array();
			$wt_tk3=array();
			$wt_tk3f=array();
			$wt_tk4=array();
			$wt_tk4f=array();
			$wt_tk5=array();
			$wt_tk5f=array();
			$wt_tk6=array();
			$wt_tk6f=array();
			$wt_tk7=array();
			$wt_tk7f=array();
			$wt_tk8=array();
			$wt_tk8f=array();
			$wt_tk9=array();
			$wt_tk9f=array();
			$wt_tk10=array();
			$wt_tk10f=array();
			$wt_tk11=array();
			$wt_tk11f=array();
			$wt_tk12=array();
			$wt_tk12f=array();
			$wt_tk12e=array();
			$wt_tk12fe=array();
			$wt_tk13=array();
			$wt_tk13f=array();
			$wt_tk14=array();
			$wt_tk14f=array();
			$wt_tk15=array();
			$wt_tk15f=array();
			$wt_tk16=array();
			$wt_tk16f=array();
			$wt_tk17=array();
			$wt_tk17f=array();
			$wt_tk18=array();
			$wt_tk18f=array();
			$wt_tk19=array();
			$wt_tk19f=array();
			$wt_tk20=array();
			$wt_tk20f=array();
			$wt_tk21=array();
			$wt_tk21f=array();
			$wt_tk22=array();
			$wt_tk22f=array();
			$wt_tk23=array();
			$wt_tk23f=array();
			$wt_tk24=array();
			$wt_tk24f=array();
			$wt_tk25=array();
			$wt_tk25f=array();

			for ( $tt = $start; $tt <= $end; $tt += 86400 )
			{	
				$dt=date("Y-m-d",$tt);
				
				if($p_format=="f_mean")
				{
					$strQuery = "SELECT Sum(case when STN_ID='' and sensor_id='' then Value end) aa";	
					foreach($p_stn as $id)
					{
						$_value = cut($id);
						$ssite = $_value[0];
						$nname = $_value[4];

						$strQuery .=" ,CONVERT(decimal(38,2),avg(case when STN_ID='".$ssite."' and sensor_id='200' then Value  end)) WL_".$nname." ";
						$strQuery .=" ,CONVERT(decimal(38,2),avg(case when STN_ID='".$ssite."' and sensor_id='201' then Value  end)) WLE_".$nname." ";
						$strQuery .=" ,CONVERT(decimal(38,2),avg(case when STN_ID='".$ssite."' and sensor_id='300' then Value  end)) FL_".$nname." ";
						$strQuery .=" ,CONVERT(decimal(38,2),avg(case when STN_ID='".$ssite."' and sensor_id='305' then Value  end)) FLE_".$nname." ";
					}					
					$strQuery .=" FROM 	[dbo].[DATA_Backup]
							WHERE DT between (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)) 
							and dateAdd(dd, 1, (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)))	";
				}
				elseif($p_format=="f_min")
				{
					$strQuery = "SELECT Sum(case when STN_ID='' and sensor_id='' then Value end) aa";	
					foreach($p_stn as $id)
					{
						$_value = cut($id);
						$ssite = $_value[0];
						$nname = $_value[4];

						$strQuery .=" ,CONVERT(decimal(38,2),min(case when STN_ID='".$ssite."' and sensor_id='200' then Value  end)) WL_".$nname." ";
						$strQuery .=" ,CONVERT(decimal(38,2),min(case when STN_ID='".$ssite."' and sensor_id='201' then Value  end)) WLE_".$nname." ";
						$strQuery .=" ,CONVERT(decimal(38,2),min(case when STN_ID='".$ssite."' and sensor_id='300' then Value  end)) FL_".$nname." ";
						$strQuery .=" ,CONVERT(decimal(38,2),min(case when STN_ID='".$ssite."' and sensor_id='305' then Value  end)) FLE_".$nname." ";
					}					
					$strQuery .=" FROM 	[dbo].[DATA_Backup]
							WHERE DT between (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)) 
							and dateAdd(dd, 1, (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)))	";
				}
				elseif($p_format=="f_max")
				{
					$strQuery = "SELECT Sum(case when STN_ID='' and sensor_id='' then Value end) aa";	
					foreach($p_stn as $id)
					{
						$_value = cut($id);
						$ssite = $_value[0];
						$nname = $_value[4];

						$strQuery .=" ,CONVERT(decimal(38,2),max(case when STN_ID='".$ssite."' and sensor_id='200' then Value  end)) WL_".$nname." ";
						$strQuery .=" ,CONVERT(decimal(38,2),max(case when STN_ID='".$ssite."' and sensor_id='201' then Value  end)) WLE_".$nname." ";
						$strQuery .=" ,CONVERT(decimal(38,2),max(case when STN_ID='".$ssite."' and sensor_id='300' then Value  end)) FL_".$nname." ";
						$strQuery .=" ,CONVERT(decimal(38,2),max(case when STN_ID='".$ssite."' and sensor_id='305' then Value  end)) FLE_".$nname." ";
					}					
					$strQuery .=" FROM 	[dbo].[DATA_Backup]
							WHERE DT between (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)) 
							and dateAdd(dd, 1, (select convert(varchar(16),(convert(varchar(10),'".$dt."',120)+' 07:01'),120)))	";
				}
				else{}
			
				$result = odbc_exec($conn,$strQuery);
				//$checkrow=odbc_num_rows($objExec);
				$date_now = $dt.' 07:00';
				

				$stadatey=date("Y",strtotime($date_now));	
				$stadatem=date("m",strtotime($date_now));	
				$stadated=date("d",strtotime($date_now));
				$stadateh=date("H",strtotime($date_now));
				$stadatei=date("i",strtotime($date_now));
						
				$sm=$stadatey."-".$stadatem;
				
				$stadate=strtotime($date_now);
				$enddate=strtotime($date_now)+86400;
				$row = odbc_fetch_array($result);
		
				if(isset($Tk1))
				{ 
					if($row['WL_'.$_nrow1.'']==null){$val_tk1="null";}else{$val_tk1=$row['WL_'.$_nrow1.''];}
					array_push($wt_tk1,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk1."]");
					if($row['FL_'.$_nrow1.'']==null){$val_tk1f="null";}else{$val_tk1f=$row['FL_'.$_nrow1.''];}
					array_push($wt_tk1f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk1f."]");
				}
				if(isset($Tk2))
				{ 
					if($row['WL_'.$_nrow2.'']==null){$val_tk2="null";}else{$val_tk2=$row['WL_'.$_nrow2.''];}
					array_push($wt_tk2,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk2."]");
					if($row['FL_'.$_nrow2.'']==null){$val_tk2f="null";}else{$val_tk2f=$row['FL_'.$_nrow2.''];}
					array_push($wt_tk2f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk2f."]");
				}
				if(isset($Tk3))
				{ 
					if($row['WL_'.$_nrow3.'']==null){$val_tk3="null";}else{$val_tk3=$row['WL_'.$_nrow3.''];}
					array_push($wt_tk3,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk3."]");
					if($row['FL_'.$_nrow3.'']==null){$val_tk3f="null";}else{$val_tk3f=$row['FL_'.$_nrow3.''];}
					array_push($wt_tk2f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk3f."]");
				}
				if(isset($Tk4))
				{ 
					if($row['WL_'.$_nrow4.'']==null){$val_tk4="null";}else{$val_tk4=$row['WL_'.$_nrow4.''];}
					array_push($wt_tk4,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk4."]");
					if($row['FL_'.$_nrow4.'']==null){$val_tk4f="null";}else{$val_tk4f=$row['FL_'.$_nrow4.''];}
					array_push($wt_tk4f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk4f."]");
				}
				if(isset($Tk5))
				{ 
					if($row['WL_'.$_nrow5.'']==null){$val_tk5="null";}else{$val_tk5=$row['WL_'.$_nrow5.''];}
					array_push($wt_tk5,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk5."]");
					if($row['FL_'.$_nrow5.'']==null){$val_tk5f="null";}else{$val_tk5f=$row['FL_'.$_nrow5.''];}
					array_push($wt_tk5f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk5f."]");
				}
				if(isset($Tk6))
				{ 
					if($row['WL_'.$_nrow6.'']==null){$val_tk6="null";}else{$val_tk6=$row['WL_'.$_nrow6.''];}
					array_push($wt_tk6,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk6."]");
					if($row['FL_'.$_nrow6.'']==null){$val_tk6f="null";}else{$val_tk6f=$row['FL_'.$_nrow6.''];}
					array_push($wt_tk6f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk6f."]");
				}
				if(isset($Tk7))
				{ 
					if($row['WL_'.$_nrow7.'']==null){$val_tk7="null";}else{$val_tk7=$row['WL_'.$_nrow7.''];}
					array_push($wt_tk7,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk7."]");
					if($row['FL_'.$_nrow7.'']==null){$val_tk7f="null";}else{$val_tk7f=$row['FL_'.$_nrow7.''];}
					array_push($wt_tk7f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk7f."]");
				}
				if(isset($Tk8))
				{ 
					if($row['WL_'.$_nrow8.'']==null){$val_tk8="null";}else{$val_tk8=$row['WL_'.$_nrow8.''];}
					array_push($wt_tk8,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk8."]");
					if($row['FL_'.$_nrow8.'']==null){$val_tk8f="null";}else{$val_tk8f=$row['FL_'.$_nrow8.''];}
					array_push($wt_tk8f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk8f."]");
				}
				if(isset($Tk9))
				{ 
					if($row['WL_'.$_nrow9.'']==null){$val_tk9="null";}else{$val_tk9=$row['WL_'.$_nrow9.''];}
					array_push($wt_tk9,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk9."]");
					if($row['FL_'.$_nrow9.'']==null){$val_tk9f="null";}else{$val_tk9f=$row['FL_'.$_nrow9.''];}
					array_push($wt_tk9f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk9f."]");
				}
				if(isset($Tk10))
				{ 
					if($row['WL_'.$_nrow10.'']==null){$val_tk10="null";}else{$val_tk10=$row['WL_'.$_nrow10.''];}
					array_push($wt_tk10,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk10."]");
					if($row['FL_'.$_nrow10.'']==null){$val_tk10f="null";}else{$val_tk10f=$row['FL_'.$_nrow10.''];}
					array_push($wt_tk10f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk10f."]");
				}
				if(isset($Tk11))
				{ 
					if($row['RF_'.$_nrow11.'']==null){$val_tk11="null";}else{$val_tk11=$row['RF_'.$_nrow11.''];}
					array_push($wt_tk11,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk11."]");
					if($row['FL_'.$_nrow11.'']==null){$val_tk11f="null";}else{$val_tk11f=$row['FL_'.$_nrow11.''];}
					array_push($wt_tk11f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk11f."]");
				}
				if(isset($Tk12))
				{ 
					if($row['WL_'.$_nrow12.'']==null){$val_tk12="null";}else{$val_tk12=$row['WL_'.$_nrow12.''];}
					array_push($wt_tk12,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk12."]");
					if($row['FL_'.$_nrow12.'']==null){$val_tk12f="null";}else{$val_tk12f=$row['FL_'.$_nrow12.''];}
					array_push($wt_tk12f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk12f."]");
				}
				if(isset($Tk13))
				{ 
					if($row['WL_'.$_nrow13.'']==null){$val_tk13="null";}else{$val_tk13=$row['RF_'.$_nrow13.''];}
					array_push($wt_tk13,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk13."]");
					if($row['FL_'.$_nrow13.'']==null){$val_tk13f="null";}else{$val_tk13f=$row['FL_'.$_nrow13.''];}
					array_push($wt_tk13f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk13f."]");
				}
				if(isset($Tk14))
				{ 
					if($row['WL_'.$_nrow14.'']==null){$val_tk14="null";}else{$val_tk14=$row['WL_'.$_nrow14.''];}
					array_push($wt_tk14,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk14."]");
					if($row['FL_'.$_nrow14.'']==null){$val_tk14f="null";}else{$val_tk14f=$row['FL_'.$_nrow14.''];}
					array_push($wt_tk14f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk14f."]");
				}
				if(isset($Tk15))
				{ 
					if($row['WL_'.$_nrow15.'']==null){$val_tk15="null";}else{$val_tk15=$row['WL_'.$_nrow15.''];}
					array_push($wt_tk15,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk15."]");
					if($row['FL_'.$_nrow15.'']==null){$val_tk15f="null";}else{$val_tk15f=$row['FL_'.$_nrow15.''];}
					array_push($wt_tk15f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk15f."]");
				}
				if(isset($Tk16))
				{ 
					if($row['WL_'.$_nrow16.'']==null){$val_tk16="null";}else{$val_tk16=$row['WL_'.$_nrow16.''];}
					array_push($wt_tk16,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk16."]");
					if($row['FL_'.$_nrow16.'']==null){$val_tk16f="null";}else{$val_tk16f=$row['FL_'.$_nrow16.''];}
					array_push($wt_tk16f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk16f."]");
				}
				if(isset($Tk17))
				{ 
					if($row['WL_'.$_nrow17.'']==null){$val_tk17="null";}else{$val_tk17=$row['WL_'.$_nrow17.''];}
					array_push($wt_tk17,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk17."]");
					if($row['FL_'.$_nrow17.'']==null){$val_tk17f="null";}else{$val_tk17f=$row['FL_'.$_nrow17.''];}
					array_push($wt_tk17f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk17f."]");
				}
				if(isset($Tk18))
				{ 
					if($row['WL_'.$_nrow18.'']==null){$val_tk18="null";}else{$val_tk18=$row['WL_'.$_nrow18.''];}
					array_push($wt_tk18,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk18."]");
					if($row['FL_'.$_nrow18.'']==null){$val_tk18f="null";}else{$val_tk18f=$row['FL_'.$_nrow18.''];}
					array_push($wt_tk18f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk18f."]");
					if($row['WLE_'.$_nrow18.'']==null){$val_tk18e="null";}else{$val_tk18e=$row['WLE_'.$_nrow18.''];}
					array_push($wt_tk18e,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk18e."]");
					if($row['FLE_'.$_nrow18.'']==null){$val_tk18ef="null";}else{$val_tk18ef=$row['FLE_'.$_nrow18.''];}
					array_push($wt_tk18ef,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk18ef."]");
				}
				if(isset($Tk19))
				{ 
					if($row['WL_'.$_nrow19.'']==null){$val_tk19="null";}else{$val_tk19=$row['WL_'.$_nrow19.''];}
					array_push($wt_tk19,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk19."]");
					if($row['FL_'.$_nrow19.'']==null){$val_tk19f="null";}else{$val_tk19f=$row['FL_'.$_nrow19.''];}
					array_push($wt_tk19f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk19f."]");
					if($row['WLE_'.$_nrow19.'']==null){$val_tk19e="null";}else{$val_tk19e=$row['WLE_'.$_nrow19.''];}
					array_push($wt_tk19e,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk19e."]");
					if($row['FLE_'.$_nrow19.'']==null){$val_tk19ef="null";}else{$val_tk19ef=$row['FLE_'.$_nrow19.''];}
					array_push($wt_tk19ef,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk19ef."]");
				}
				if(isset($Tk20))
				{ 
					if($row['WL_'.$_nrow20.'']==null){$val_tk20="null";}else{$val_tk20=$row['WL_'.$_nrow20.''];}
					array_push($wt_tk20,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk20."]");
					if($row['FL_'.$_nrow20.'']==null){$val_tk20f="null";}else{$val_tk20f=$row['FL_'.$_nrow20.''];}
					array_push($wt_tk20f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk20f."]");
				}
				if(isset($Tk21))
				{ 
					if($row['WL_'.$_nrow21.'']==null){$val_tk21="null";}else{$val_tk21=$row['WL_'.$_nrow21.''];}
					array_push($wt_tk21,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk21."]");
					if($row['FL_'.$_nrow21.'']==null){$val_tk21f="null";}else{$val_tk21f=$row['FL_'.$_nrow21.''];}
					array_push($wt_tk21f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk21f."]");
				}
				if(isset($Tk22))
				{ 
					if($row['WL_'.$_nrow22.'']==null){$val_tk22="null";}else{$val_tk22=$row['WL_'.$_nrow22.''];}
					array_push($wt_tk22,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk22."]");
					if($row['FL_'.$_nrow22.'']==null){$val_tk22f="null";}else{$val_tk22f=$row['FL_'.$_nrow22.''];}
					array_push($wt_tk22f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk22f."]");
				}
				if(isset($Tk23))
				{ 
					if($row['WL_'.$_nrow23.'']==null){$val_tk23="null";}else{$val_tk23=$row['WL_'.$_nrow23.''];}
					array_push($wt_tk23,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk23."]");
					if($row['FL_'.$_nrow23.'']==null){$val_tk23f="null";}else{$val_tk23f=$row['FL_'.$_nrow23.''];}
					array_push($wt_tk23f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk23f."]");
				}
				if(isset($Tk24))
				{ 
					if($row['WL_'.$_nrow24.'']==null){$val_tk24="null";}else{$val_tk24=$row['WL_'.$_nrow24.''];}
					array_push($wt_tk24,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk24."]");
					if($row['FL_'.$_nrow24.'']==null){$val_tk24f="null";}else{$val_tk24f=$row['FL_'.$_nrow24.''];}
					array_push($wt_tk24f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk24f."]");
				}
				if(isset($Tk25))
				{ 
					if($row['WL_'.$_nrow25.'']==null){$val_tk25="null";}else{$val_tk25=$row['WL_'.$_nrow25.''];}
					array_push($wt_tk25,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk25."]");
					if($row['FL_'.$_nrow25.'']==null){$val_tk25f="null";}else{$val_tk25f=$row['FL_'.$_nrow25.''];}
					array_push($wt_tk25f,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk25f."]");
					if($row['WLE_'.$_nrow25.'']==null){$val_tk25e="null";}else{$val_tk25e=$row['WLE_'.$_nrow25.''];}
					array_push($wt_tk25e,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk25e."]");
					if($row['FLE_'.$_nrow25.'']==null){$val_tk25ef="null";}else{$val_tk25ef=$row['FLE_'.$_nrow25.''];}
					array_push($wt_tk25ef,"[ Date.UTC(".($stadatey+543).",".($stadatem-1).",".$stadated.",".$stadateh.",".$stadatei."),  ".$val_tk25ef."]");
				}
			}


			if(isset($Tk1))
				{ 
					$ponts_Tk1=implode(",",$wt_tk1);
					$ponts_Tk1f=implode(",",$wt_tk1f);
				}
				if(isset($Tk2))
				{ 
					$ponts_Tk2=implode(",",$wt_tk2);
					$ponts_Tk2f=implode(",",$wt_tk2f);
				}
				if(isset($Tk3))
				{ 
					$ponts_Tk3=implode(",",$wt_tk3);
					$ponts_Tk3f=implode(",",$wt_tk3f);
				}
				if(isset($Tk4))
				{ 
					$ponts_Tk4=implode(",",$wt_tk4);
					$ponts_Tk4f=implode(",",$wt_tk4f);
				}
				if(isset($Tk5))
				{ 
					$ponts_Tk5=implode(",",$wt_tk5);
					$ponts_Tk5f=implode(",",$wt_tk5f);
				}
				if(isset($Tk6))
				{ 
					$ponts_Tk6=implode(",",$wt_tk6);
					$ponts_Tk6f=implode(",",$wt_tk6f);
				}
				if(isset($Tk7))
				{ 
					$ponts_Tk7=implode(",",$wt_tk7);
					$ponts_Tk7f=implode(",",$wt_tk7f);
				}
				if(isset($Tk8))
				{ 
					$ponts_Tk8=implode(",",$wt_tk8);
					$ponts_Tk8f=implode(",",$wt_tk8f);
				}
				if(isset($Tk9))
				{ 
					$ponts_Tk9=implode(",",$wt_tk9);
					$ponts_Tk9f=implode(",",$wt_tk9f);
				}
				if(isset($Tk10))
				{ 
					$ponts_Tk10=implode(",",$wt_tk10);
					$ponts_Tk10f=implode(",",$wt_tk10f);
				}
				if(isset($Tk11))
				{ 
					$ponts_Tk11=implode(",",$wt_tk11);
					$ponts_Tk11f=implode(",",$wt_tk11f);
				}
				if(isset($Tk12))
				{ 
					$ponts_Tk12=implode(",",$wt_tk12);
					$ponts_Tk12f=implode(",",$wt_tk12f);
				}
				if(isset($Tk13))
				{ 
					$ponts_Tk13=implode(",",$wt_tk13);
					$ponts_Tk13f=implode(",",$wt_tk13f);
				}
				if(isset($Tk14))
				{ 
					$ponts_Tk14=implode(",",$wt_tk14);
					$ponts_Tk14f=implode(",",$wt_tk14f);
				}
				if(isset($Tk15))
				{ 
					$ponts_Tk15=implode(",",$wt_tk15);
					$ponts_Tk15f=implode(",",$wt_tk15f);
				}
				if(isset($Tk16))
				{ 
					$ponts_Tk16=implode(",",$wt_tk16);
					$ponts_Tk16f=implode(",",$wt_tk16f);
				}
				if(isset($Tk17))
				{ 
					$ponts_Tk17=implode(",",$wt_tk17);
					$ponts_Tk17f=implode(",",$wt_tk17f);
				}
				if(isset($Tk18))
				{ 
					$ponts_Tk18=implode(",",$wt_tk18);
					$ponts_Tk18f=implode(",",$wt_tk18f);
					$ponts_Tk18e=implode(",",$wt_tk18e);
					$ponts_Tk18ef=implode(",",$wt_tk18ef);
				}
				if(isset($Tk19))
				{ 
					$ponts_Tk19=implode(",",$wt_tk19);
					$ponts_Tk19f=implode(",",$wt_tk19f);
					$ponts_Tk19e=implode(",",$wt_tk19e);
					$ponts_Tk19ef=implode(",",$wt_tk19ef);
				}
				if(isset($Tk20))
				{ 
					$ponts_Tk20=implode(",",$wt_tk20);
					$ponts_Tk20f=implode(",",$wt_tk20f);
				}
				if(isset($Tk21))
				{ 
					$ponts_Tk21=implode(",",$wt_tk21);
					$ponts_Tk21f=implode(",",$wt_tk21f);
				}
				if(isset($Tk22))
				{ 
					$ponts_Tk22=implode(",",$wt_tk22);
					$ponts_Tk22f=implode(",",$wt_tk22f);
				}
				if(isset($Tk23))
				{ 
					$ponts_Tk23=implode(",",$wt_tk23);
					$ponts_Tk23f=implode(",",$wt_tk23f);
				}
				if(isset($Tk24))
				{ 
					$ponts_Tk24=implode(",",$wt_tk24);
					$ponts_Tk24f=implode(",",$wt_tk24f);
				}
				if(isset($Tk25))
				{ 
					$ponts_Tk25=implode(",",$wt_tk25);
					$ponts_Tk25f=implode(",",$wt_tk25f);
					$ponts_Tk25e=implode(",",$wt_tk25e);
					$ponts_Tk25ef=implode(",",$wt_tk25ef);
				}

				if(isset($Tk1))
			   {
						 $se_Tk1='
								{
								type: "line",
								name: "'.$_namec1.'",
								data: ['.$ponts_Tk1f.'],
								color: "#228B22",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec1.'_WL",
								data: ['.$ponts_Tk1.'],
								color: "#228B22",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}	
				
			   if(isset($Tk2))
			   {
						 $se_Tk2='
								{
								type: "line",
								name: "'.$_namec2.'",
								data: ['.$ponts_Tk2f.'],
								color: "#528B8B",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec2.'_WL",
								data: ['.$ponts_Tk2.'],
								color: "#528B8B",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk3))
			   {
						 $se_Tk3='
								{
								type: "line",
								name: "'.$_namec3.'",
								data: ['.$ponts_Tk3f.'],
								color: "#A0522D",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec3.'_WL",
								data: ['.$ponts_Tk3.'],
								color: "#A0522D",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk4))
			   {
						 $se_Tk4='
								{
								type: "line",
								name: "'.$_namec4.'",
								data: ['.$ponts_Tk4f.'],
								color: "#483D8B",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec4.'_WL",
								data: ['.$ponts_Tk4.'],
								color: "#483D8B",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk5))
			   {
						 $se_Tk5='
								{
								type: "line",
								name: "'.$_namec5.'",
								data: ['.$ponts_Tk5f.'],
								color: "#000080",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec5.'_WL",
								data: ['.$ponts_Tk5.'],
								color: "#000080",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk6))
			   {
						 $se_Tk6='
								{
								type: "line",
								name: "'.$_namec6.'",
								data: ['.$ponts_Tk6f.'],
								color: "#8B658B",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec6.'_WL",
								data: ['.$ponts_Tk6.'],
								color: "#8B658B",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk7))
			   {
						 $se_Tk7='
								{
								type: "line",
								name: "'.$_namec7.'",
								data: ['.$ponts_Tk7f.'],
								color: "#CD9B9B",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec7.'_WL",
								data: ['.$ponts_Tk7.'],
								color: "#CD9B9B",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk8))
			   {
						 $se_Tk8='
								{
								type: "line",
								name: "'.$_namec8.'",
								data: ['.$ponts_Tk8f.'],
								color: "#CD5555",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec8.'_WL",
								data: ['.$ponts_Tk8.'],
								color: "#CD5555",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk9))
			   {
						 $se_Tk9='
								{
								type: "line",
								name: "'.$_namec9.'",
								data: ['.$ponts_Tk9f.'],
								color: "#CD6839",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec9.'_WL",
								data: ['.$ponts_Tk9.'],
								color: "#CD6839",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk10))
			   {
						 $se_Tk10='
								{
								type: "line",
								name: "'.$_namec10.'",
								data: ['.$ponts_Tk10f.'],
								color: "#CD2626",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec10.'_WL",
								data: ['.$ponts_Tk10.'],
								color: "#CD2626",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk11))
			   {
						 $se_Tk11='
								{
								type: "line",
								name: "'.$_namec11.'",
								data: ['.$ponts_Tk11f.'],
								color: "#EE9A00",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec11.'_WL",
								data: ['.$ponts_Tk11.'],
								color: "#EE9A00",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk12))
			   {
						 $se_Tk12='
								{
								type: "line",
								name: "'.$_namec12.'",
								data: ['.$ponts_Tk12f.'],
								color: "#CD6600",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec12.'_WL",
								data: ['.$ponts_Tk12.'],
								color: "#CD6600",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk13))
			   {
						 $se_Tk13='
								{
								type: "line",
								name: "'.$_namec13.'",
								data: ['.$ponts_Tk13f.'],
								color: "#CD0000",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec13.'_WL",
								data: ['.$ponts_Tk13.'],
								color: "#CD0000",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk14))
			   {
						 $se_Tk14='
								{
								type: "line",
								name: "'.$_namec14.'",
								data: ['.$ponts_Tk14f.'],
								color: "#CD1076",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec14.'_WL",
								data: ['.$ponts_Tk14.'],
								color: "#CD1076",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk15))
			   {
						 $se_Tk15='
								{
								type: "line",
								name: "'.$_namec15.'",
								data: ['.$ponts_Tk15f.'],
								color: "#8B4789",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec15.'_WL",
								data: ['.$ponts_Tk15.'],
								color: "#8B4789",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk16))
			   {
						 $se_Tk16='
								{
								type: "line",
								name: "'.$_namec16.'",
								data: ['.$ponts_Tk16f.'],
								color: "#C71585",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec16.'_WL",
								data: ['.$ponts_Tk16.'],
								color: "#C71585",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk17))
			   {
						 $se_Tk17='
								{
								type: "line",
								name: "'.$_namec17.'",
								data: ['.$ponts_Tk17f.'],
								color: "#ECAB53",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec17.'_WL",
								data: ['.$ponts_Tk17.'],
								color: "#ECAB53",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk18))
			   {
						 $se_Tk18='
								{
								type: "line",
								name: "'.$_namec18.'",
								data: ['.$ponts_Tk18f.'],
								color: "#008080",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec18.'_WL",
								data: ['.$ponts_Tk18.'],
								color: "#008080",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},
								{
								type: "line",
								name: "'.$_namec18.'_E",
								data: ['.$ponts_Tk18ef.'],
								color: "#008080",
								lineWidth: 1,
								dashStyle:"Dash"
								
								},
								{
								type: "line",
								name: "'.$_namec18.'_WLE",
								data: ['.$ponts_Tk18e.'],
								color: "#008080",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"LongDash"
								
								},';

				}
				if(isset($Tk19))
			   {
						 $se_Tk19='
								{
								type: "line",
								name: "'.$_namec19.'",
								data: ['.$ponts_Tk19f.'],
								color: "00BB00",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec19.'_WL",
								data: ['.$ponts_Tk19.'],
								color: "00BB00",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},
								{
								type: "line",
								name: "'.$_namec19.'_E",
								data: ['.$ponts_Tk19ef.'],
								color: "00BB00",
								lineWidth: 1,
								dashStyle:"Dash"
								
								},
								{
								type: "line",
								name: "'.$_namec19.'_WLE",
								data: ['.$ponts_Tk19e.'],
								color: "00BB00",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"LongDash"
								
								},';

				}
				if(isset($Tk20))
			   {
						 $se_Tk20='
								{
								type: "line",
								name: "'.$_namec20.'",
								data: ['.$ponts_Tk20f.'],
								color: "#778899",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec20.'_WL",
								data: ['.$ponts_Tk20.'],
								color: "#778899",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk21))
			   {
						 $se_Tk21='
								{
								type: "line",
								name: "'.$_namec21.'",
								data: ['.$ponts_Tk21f.'],
								color: "#97FFFF",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec21.'_WL",
								data: ['.$ponts_Tk21.'],
								color: "#97FFFF",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk22))
			   {
						 $se_Tk22='
								{
								type: "line",
								name: "'.$_namec22.'",
								data: ['.$ponts_Tk22f.'],
								color: "#FFE4B5",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec22.'_WL",
								data: ['.$ponts_Tk22.'],
								color: "#FFE4B5",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk23))
			   {
						 $se_Tk23='
								{
								type: "line",
								name: "'.$_namec23.'",
								data: ['.$ponts_Tk23f.'],
								color: "#4876FF",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec23.'_WL",
								data: ['.$ponts_Tk23.'],
								color: "#4876FF",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk24))
			   {
						 $se_Tk24='
								{
								type: "line",
								name: "'.$_namec24.'",
								data: ['.$ponts_Tk24f.'],
								color: "#B0E0E6",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec24.'_WL",
								data: ['.$ponts_Tk24.'],
								color: "#B0E0E6",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},';

				}
				if(isset($Tk25))
			   {
						 $se_Tk25='
								{
								type: "line",
								name: "'.$_namec25.'",
								data: ['.$ponts_Tk25f.'],
								color: "#7CFC00",
								lineWidth: 1,
								dashStyle:"shortdot"
								
								},
								{
								type: "line",
								name: "'.$_namec25.'_WL",
								data: ['.$ponts_Tk25.'],
								color: "#7CFC00",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"solid"
								
								},
								{
								type: "line",
								name: "'.$_namec25.'_E",
								data: ['.$ponts_Tk25ef.'],
								color: "#7CFC00",
								lineWidth: 1,
								dashStyle:"Dash"
								
								},
								{
								type: "line",
								name: "'.$_namec25.'_WLE",
								data: ['.$ponts_Tk25e.'],
								color: "#7CFC00",
								yAxis: 1,
								lineWidth: 1,
								dashStyle:"LongDash"
								
								},';

				}
	}
		?>
		<BR>
		<div id="graphFL" ></div>
			<script type="text/javascript">
			$(function () {				 
				$(document).ready(function() {
					Highcharts.setOptions({
					lang: {	months: ['ม.ค.', 'ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.']		}
					});
					var chart = new Highcharts.Chart({
						chart: {
							renderTo: 'graphFL',
							zoomType: 'x',
							//height: 500,
						    //marginBottom: 110,
							spacingRight: 20,
							spacingLeft: 20 ,
								resetZoomButton: {
								position: {
								//align: 'right', // by default
								//verticalAlign: 'top', // by default
								x: -30,
								y: -20
								}
							}
						},
						credits: {
						enabled: false
						},
						title: {
							text: '<? echo $nametype;?>',
							x: -20, //center
						style: {
							fontSize: '14px'
						}
						},
						/*legend: {
							layout: 'vertical',
							align: 'left',
							verticalAlign: 'top',
							x: 100,
							y: 35,
							floating: true,
							borderWidth: 1,
							backgroundColor: '#FFFFFF'
						},*/
						subtitle: {
						style: {
							fontSize: '12px'
							},
						verticalAlign: 'bottom',
						x: 420,
						y: -460
						},		
						xAxis: {
							type: 'datetime',
							//maxZoom: <? echo $maxZ;?>,
							minRange: '<? echo $a;?>' * 60 * 1000 * 6,
							minTickInterval: '<? echo $a;?>' * 60 * 1000,
							title: {
								text: null
							},
							labels:{
							rotation:-45,
							align:'right',
							fontSize: '8px'
								},
							dateTimeLabelFormats: {
							day: '%e %B %Y',
							week:'%e %B %Y',
							month:'%B %Y',
							year:'%Y'
						}
						},
					   yAxis: [{
							//min: '<? echo $minva;?>',
				
							//minPadding: 0.5,
							//maxPadding: 0.5,
							title: {
								text: '<?php echo $yaname;?>'
							 }
							 }
							,
							{
							//minPadding: 0.5,
							//maxPadding: 0.5,
								title: {
									text: '<?php echo $yaname2;?>'
								},
									opposite: true
							}
						],
						tooltip: {
							formatter: function() {	
								var a=undefined;
								var b='WL';
								var c='E';
								var d='WLE';

								var x = this.point.series.name;
								var sname = x.split('_');
								//alert(this.point.series.name);
								//alert(a);
								if(sname[1] ==a || sname[1] ==c)
								{
									return  Highcharts.dateFormat('<? echo $formatdd;?>',this.x) + '<br><b>' + this.y +'</b>'+' <? echo $yname;?>';
								}
								else
								{
									return  Highcharts.dateFormat('<? echo $formatdd;?>',this.x) + '<br><b>' + this.y +'</b>'+' <? echo $yname2;?>';
								}
							}
						},
						plotOptions: {							
							series:{marker:{enabled:false}}
						},    
						scrollbar: {
							 enabled: true
						 },
						series: [
							 <?php echo $se_Tk1?>
							<?php echo $se_Tk2?>
							 <?php echo $se_Tk3?>
							 <?php echo $se_Tk4?>
							<?php echo $se_Tk5?>
							 <?php echo $se_Tk6?>
							 <?php echo $se_Tk7?>
							 <?php echo $se_Tk8?>
							 <?php echo $se_Tk9?>
							 <?php echo $se_Tk10?>
							 <?php echo $se_Tk11?>
							 <?php echo $se_Tk12?>
							 <?php echo $se_Tk13?>
							 <?php echo $se_Tk14?>
							 <?php echo $se_Tk15?>
							<?php echo $se_Tk16?>
							<?php echo $se_Tk17?>
							<?php echo $se_Tk18?>
							 <?php echo $se_Tk19?>
							 <?php echo $se_Tk20?>
							 <?php echo $se_Tk21?>
							 <?php echo $se_Tk22?>
							 <?php echo $se_Tk23?>
							 <?php echo $se_Tk24?>
							 <?php echo $se_Tk25?>
							]
							,
							exporting: {
                         url: 'http://telekolok.com/exporting_server/index.php'
                      }
					});
						
				});

			});
			</script>
<?}?>