<?php
	require_once('DB.php');
	$obj = new DB;
	if($_POST) {	
		$tasksForDayDB = $_POST['tasksForDayDB']; //список задач поставленных на этот день
		$taskTextDB = $_POST['taskTextDB'];//список проделанных дел в tasksList
		$sloganDB = $_POST['sloganDB'];
		$dateDB = $_POST['dateDB'];
		$timeWakeUpDB = $_POST['timeWakeUpDB'];
		$obj->doQuery('INSERT INTO SelectedDay VALUES("'.$dateDB.'","'.$timeWakeUpDB.'","'.$sloganDB.'")');
		if (count($taskTextDB) > 0) {
			for ($i=0; $i<count($taskTextDB); $i++) {
				$obj->doQuery('INSERT INTO TasksList VALUES("'.$taskTextDB[$i].'")');	
			}			
		}
		if (count($tasksForDayDB) > 0) {
			for ($i=0; $i<count($tasksForDayDB); $i++) {
				$obj->doQuery('INSERT INTO TasksForDay VALUES("'.$tasksForDayDB[$i].'")');	
			}
		}
		//$obj->doQuery('INSERT INTO selectedDay VALUES("","","","")');
		die("ok");
	} else
		die("fail");
	
?>