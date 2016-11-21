<?php
	require_once('DB.php');
	$obj = new DB;
	if($_POST) {
		$dateChosen = $_POST['id_day'];
		$timeWakeUp = $_POST['timeWakeUp'];
		$slogan = $_POST['slogan'];
		$countTask = $_POST['countTask'];
		$countTaskDone = $_POST['countTaskDone'];
		//die($countTaskDone);
	    $taskDone = $_POST['arrayTaskDone'];
	    $tasklist = $_POST['tasks'];
	    $time = $_POST['timeDone'];
	    var_dump($time);
		$checkUpdate = $obj->doQuery('SELECT * FROM day WHERE id_day = '.$dateChosen)->fetch(PDO::FETCH_ASSOC);
		$obj->doQuery('UPDATE day SET slogan = "'.$slogan.'", timeWakeUp = "'.$timeWakeUp.'" WHERE id_day = '.$dateChosen);

		if ($checkUpdate['id_day'] != $dateChosen) {
			if ($dateChosen != '' && $timeWakeUp != '' && $slogan != '') {
				$obj->doQuery('INSERT INTO day VALUES("'.$dateChosen.'","'.$timeWakeUp.'","'.$slogan.'")');
			}
		}
		if ($countTask > 0) {			
			for ($i=0; $i<$countTask; $i++) {
				$checkTask = $obj->doQuery('SELECT COUNT(*) as count,text_task FROM tasksforday WHERE text_task = "'.$tasklist[$i].'" AND id_day = '.$dateChosen)->fetchColumn();
				if ($checkTask == 0) {
					$obj->doQuery('INSERT INTO tasksforday VALUES("","'.$tasklist[$i].'", "'.$dateChosen.'")');	
				}				
			}
			// for ($i=0; $i<count($_POST['tasks']); $i++) {
			// 	if ($i == count($_POST['tasks'])) {
			// 			$queryValues .= '('.$_POST['tasks'][$i].', '.$dateChosen.')';
			// 	}
			// 	$queryValues .= '('.$_POST['tasks'][$i].', '.$dateChosen.') ,';
			// }
			// $query = 'INSERT INTO tasksforday VALUES '+$queryValues;
			// $obj->doQuery($query);

			// foreach($tasklist as $index => $value) {
			// 	$query .= '('.$value.', '.$dateChosen.')'. count($tasklist) === $index ? ';' : ',';;
			// };
			// $obj->doQuery($query);
			// die($query);
		}
		if ($countTaskDone > 0) {
			for ($i=0; $i<$countTaskDone; $i++) {
				$checkTaskDone = $obj->doQuery('SELECT COUNT(*) FROM taskdone WHERE timeDone = "'.$time[$i].'" AND id_day = '.$dateChosen);
				if ($checkTaskDone->fetchColumn() == 0) { //если записи еще не добавлены, то добавить
					$obj->doQuery('INSERT INTO taskdone VALUES("","'.$time[$i].'", "'.$taskDone[$i].'", "'.$dateChosen.'")');
				} elseif ($checkTaskDone['text_taskDone'] != $taskDone[$i]) {
					$obj->doQuery('UPDATE taskdone SET text_taskDone = '.$taskDone[$i].' WHERE timeDone = '.$time[$i].' AND id_day = '.$dateChosen);
				}
			}
		}
		die("ok");
	} else
		die("fail");

?>
