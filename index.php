<!DOCTYPE html>
<html>
<head>
	<title>UTM Title</title>
</head>
<body>
	<?php
		$arHeader = array();
		$option["default_title"] = "Дефолтный заголовок";
		if (($handle = fopen("UTM.csv", "r")) !== FALSE) {
			$cnt = 0;
			while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
				if($cnt>0){
					$col = explode(";", $data[0]);
					$arHeader[$col[0]]["utm_term"] = $col[1];
					$arHeader[$col[0]]["title"] = $col[2];
				}
				$cnt++;
			}
			fclose($handle);
		}
		if(isset($_GET["utm_campaign"])){
			if (array_key_exists($_GET["utm_campaign"], $arHeader)) {
				$title = $arHeader[$_GET["utm_campaign"]]["title"];
			}else{
				$title = $option["default_title"];
			}
		}else{
			$title = $option["default_title"];
		}
	?>
	<h1><?=$title?></h1>
	<h2><a href="?utm_campaign=00000000">Тестируем</a> заголовок из файла <a href="UTM.csv">UTM.csv</a> для компании ЯД №00000000</h2>
</body>
</html>