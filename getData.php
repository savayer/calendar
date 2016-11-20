<?php
	require_once('DB.php');
	$data = new DB;
	$response = array();
	if ($_POST) {
		$dateChosen = $_POST['dateChosen'];
		//$result = $data->read_param('tasksforday','id_day', $_POST['dateChosen']);
		/*$result = $data->doQuery('SELECT tasksforday.text_task, day.slogan, day.timeWakeUp FROM day, tasksforday WHERE day.id_day = '.$dateChosen.' AND tasksforday.id_day = '.$dateChosen);
		$i = 0;
		while ($row = $result->fetchAll(PDO::FETCH_ASSOC)) {
			$response['tasks'][$i] = $row['text_task'];
			$response['slogan'] = $row['slogan'];
			$response['timeWakeUp'] = $row['timeWakeUp'];
			$i++;
		}*/
		$result1 = $data->doQuery('SELECT day.id_day, day.slogan, day.timeWakeUp FROM day WHERE day.id_day = '.$dateChosen)->fetchAll(PDO::FETCH_ASSOC);

		if ($result1 == []) {
				$result1 = $data->doQuery('SELECT day.id_day, day.slogan, day.timeWakeUp FROM day WHERE day.id_day = 0')->fetchAll(PDO::FETCH_ASSOC);
				$json = json_encode($result1);
				die($json);
		}
		$result2 = $data->doQuery('SELECT * FROM tasksforday WHERE id_day = '.$dateChosen)->fetchAll(PDO::FETCH_ASSOC);

		$result3 = $data->doQuery('SELECT text_taskDone FROM taskdone WHERE id_day = '.$dateChosen)->fetchAll(PDO::FETCH_ASSOC);
		$result = array_merge($result1, $result2, $result3);
		$json = json_encode($result);
		die($json);
		//var_dump($result);
	}
	else {
		die("fail");
	}

?>
