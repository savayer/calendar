$('#saveToDB').on('click', function () {
	var taskText = [],
		tasksForDay = [], timeDone = [],
		DayTasksLi = document.querySelectorAll('#DayTasks li');
		timeNow = timeWakeUpDB.innerHTML.substr(0,2);
	for (i=0; i<DayTasksLi.length; i++ ) {
		if (DayTasksLi[i].innerHTML != '')
			tasksForDay[i] = DayTasksLi[i].innerHTML;
	}
	var j=0;
	for (i=0; i<36; i++) {
		if (document.querySelector('#task'+i).innerHTML != '')
			taskText[i] = document.querySelector('#task'+i).innerHTML;
			if (timeNow.match(/0[0-9]/g)) timeNow = timeNow.substr(1,1);
			//alert(timeNow);
			//return;
			timeDone[i] = timeNow;
			timeNow = (timeNow*1)+0.5+'';
			if (timeNow == 24) {
				timeNow = '0';
			}
			//alert(timeNow);
			if (typeof(taskText[i]) != 'undefined')	j++;//j - количество записей в таблице дел

	}
	// alert(dateChosen);
	// alert(timeWakeUpDB.innerHTML);
	// alert(sloganDB.innerHTML);
	$.ajax({
		url: 'insert.php'
		, type: 'post'
		, data: {
			id_day: dateChosen,
			arrayTaskDone: taskText,
			countTask: DayTasksLi.length,
			countTaskDone: j,
			tasks: tasksForDay,
			timeWakeUp: timeWakeUpDB.innerHTML,
			slogan: sloganDB.innerHTML,
			timeDone: timeDone
		}
	}).done(function (data) {
		alert(data);
		// if (data == "ok") {
		// 	alert('Done');
		// } else if (data == "fail") {
		// 	alert('Bad request');
		// } else alert('undefined error');
	});
	});
//////////////////////////////////////////////////////////////////////////////////////
full_calendar.onclick = function(event) {
	var target = event.target;

	while (target != full_calendar) {
		if (target.tagName == 'TD') {
			var numMonth = (target.getAttribute('monthnumber'))*1+1;
			var numYear = (target.getAttribute('yearnumber'));
			numYear = numYear.substr(2,2);
			if (numMonth < 10) {
				numMonth = '0'+numMonth;
			}
		dateChosen = target.innerHTML+numMonth+numYear;
			//alert(dateChosen);
	  $.ajax({
	  	url: 'getData.php',
	  	type: 'post',
	  	data: {
	  		dateChosen: dateChosen
	  	}
	  }).done(function(response) {
	  	//console.log(response);
	  	if (response != 'fail') {
	  		DayTasks.innerHTML = '';
	  		sloganDB.innerHTML = '';
	  		timeWakeUpDB.innerHTML = '';
					var taskj = 0;
					for (i=0;i<18;i++) {
						TaskList.querySelector('td[id="task'+i+'"]').innerHTML = '';
					}
	  		//console.log(JSON.parse(response));
	  		response = JSON.parse(response);
					vm.timeWakeUp = response[0]['timeWakeUp'];
					ChangeTimeInTable();

					sloganDB.innerHTML = response[0]['slogan'];
					timeWakeUpDB.innerHTML = response[0]['timeWakeUp'];

	  		for (i=0; i<response.length; i++) {
				if (typeof(response[i]['text_task']) != 'undefined') {
					var newLi = document.createElement('li');
				newLi.innerHTML = response[i]['text_task'];
				DayTasks.appendChild(newLi);
				}
				if (typeof(response[i]['text_taskDone']) != 'undefined') {
					TaskList.querySelector('td[id="task'+taskj+'"]').innerHTML = response[i]['text_taskDone'];
					taskj++;
				}
				//console.log(response[i]['text_taskDone']);
	  		}
	  		/*, function (key, value) {
	  			// if (key == 'tasklist') {
					var newLi = document.createElement('li');
	      		newLi.innerHTML = value;
	      		DayTasks.appendChild(newLi);
	      	//}
	      	response.forEach(function(value, i, response) {
	      		var newLi = document.createElement('li');
	      		newLi.innerHTML = value;
	      		DayTasks.appendChild(newLi);
	      	});*/
	  	}
	  })
	  return;
	}
	target = target.parentNode;
	}
}
