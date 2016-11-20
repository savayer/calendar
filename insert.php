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
		$checkUpdate = $obj->doQuery('SELECT * FROM day WHERE id_day = '.$dateChosen)->fetch(PDO::FETCH_ASSOC);
		$obj->doQuery('UPDATE day SET slogan = "'.$slogan.'", timeWakeUp = "'.$timeWakeUp.'" WHERE id_day = '.$dateChosen);

		if ($checkUpdate['id_day'] != $dateChosen) {
			if ($dateChosen != '' && $timeWakeUp != '' && $slogan != '') {
				$obj->doQuery('INSERT INTO day VALUES("'.$dateChosen.'","'.$timeWakeUp.'","'.$slogan.'")');
			}
		}
		if ($countTask > 0) {
			for ($i=0; $i<$countTask; $i++) {
				$obj->doQuery('INSERT INTO tasksforday VALUES("","'.$tasklist[$i].'", "'.$dateChosen.'")');
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
				$obj->doQuery('INSERT INTO taskdone VALUES("","'.$taskDone[$i].'", "'.$dateChosen.'")');
			}
		}
		// if ($countTaskDone > 0) {
		// 	$query = 'INSERT INTO taskdone VALUES ';
		// 	foreach($row as $index => $taskDone) {
		// 		$query .= '( "", "'.$taskDone.'", "'.$dateChosen.'")'. count($arr) === $index ? ';' : ',';;
		// 	};
		// 	$obj->doQuery($query);
		// }
		die("ok");
	} else
		die("fail");

?>
