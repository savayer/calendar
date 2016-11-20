<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="stylesheet" href="template/bootstrap/css/bootstrap.css">
<!-- 	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/
bootstrap.min.css"> -->
	<link rel="stylesheet" href="template/css/styles.css">
	<title>Document</title>
</head>
<body id="body">
	<div class="modal fade" id="modalTime">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<button type="button" class="close" data-dismiss="modal" title="exit">&times;</button>
				<div class="modal-header textHead">Время подъёма</div>
				<div class="modal-body">
					<div class="row">
						<form class="col-md-12" onsubmit="return false;"><input id="MaskTime" class="form-control" onkeydown="if (event.keyCode == 13) ChangeTimeInTable();" v-model="timeWakeUp"></form>
					</div>
					<button class="btn btn-danger btn-block" data-dismiss="modal" onclick="ChangeTimeInTable();" type="button">Сохранить</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="modalSlogan">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<button type="button" class="close" data-dismiss="modal" title="exit">&times;</button>
				<div class="modal-header textHead">Слоган</div>
				<div class="modal-body">
					<div class="row">
						<form class="col-md-12" onsubmit="return false;"><input class="form-control" v-model="slogan"></form>
					</div>
					<button class="btn btn-danger btn-block" data-dismiss="modal" type="button" >Сохранить</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="AddTask">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<button type="button" class="close" data-dismiss="modal" title="exit">&times;</button>
				<div class="modal-header textHead">Задача</div>
				<div class="modal-body">
					<div class="row">
						<form class="col-md-12" onsubmit="return false;"><input onkeydown="if (event.keyCode == 13) FuncAddTaskForDay();" class="form-control" id="textTask" ></form>
					</div>
					<button class="btn btn-danger btn-block" data-dismiss="modal" type="button" onclick="FuncAddTaskForDay();">Сохранить</button>
				</div>
			</div>
		</div>
	</div>
	<!-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ -->
	<div id="menu" class="slide">
		<div class="row">
			<span id="closeMenu" class="col-md-1 col-xs-1"><i class="glyphicon glyphicon-remove-sign"></i></span>
	 		<div class="col-md-2 col-xs-2"></div>
	 		<span id="Date" class="col-md-7 col-xs-7"></span>
		</div>

		<div class="row">
			<div class="col-md-3 col-xs-3 col-md-offset-1">
				<div id="timeWakeUpDB" class="timeWakeUpClass" data-toggle="modal" data-target="#modalTime" v-text="timeWakeUp"></div>
			</div>

			<div class="col-md-1 col-xs-1"></div>
			<div class="col-md-8 col-xs-8">
				<em id="sloganDB" v-text="slogan" data-toggle="modal" data-target="#modalSlogan"></em>
			</div>
		</div>

		<div class="row">
			<div class="col-md-1 col-xs-1"></div>
			<div class="col-md-10 col-xs-10">
				<div>
					<span data-toggle="modal" data-target="#AddTask"><i class="glyphicon glyphicon-plus"></i></span>
					Задачи на день:
				</div>
				<ol id="DayTasks"></ol>
			</div>
		</div>
		<form class="col-md-offset-10 col-xs-offset-9">
			<input type="button" value="Сохранить" id="saveToDB" class="btn btn-danger">
		</form><br>
 		<div class="table-responsive">
	 		<table id="TaskList" class="table table-striped table-bordered table-condensed">
	 			<tbody v-for="(i,j) in 18"> <!-- на сон 6 часов-->
				 	<tr>
				 		<td id="HourNumberInTable{{i}}" rowspan="2" class="col-md-1 col-xs-1"></td> <!--  {{ $index+6 }}-->
				 		<td contenteditable="true" class="col-md-10 col-xs-10" id="task{{i+j}}"></td>
				 		<td class="col-md-1 col-xs-1">
				 			<span class="glyphicon glyphicon-plus-sign" onclick="setRating(1,'task{{ i+j }}')"></span>
				 			<span class="glyphicon glyphicon-minus-sign" onclick="setRating(0,'task{{ i+j }}')"></span>
				 		</td>
				 		<tr>
				 			<td contenteditable="true" id="task{{i+j+1}}"></td>
				 			<td>
				 				<span class="glyphicon glyphicon-plus-sign" onclick="setRating(1,'task{{ i+j+1 }}')"></span>
				 				<span class="glyphicon glyphicon-minus-sign" onclick="setRating(0,'task{{ i+j+1 }}')"></span>
				 			</td>
				 		</tr>
				 	</tr>
	 			</tbody>
	 		</table>
	 	</div>

 	 	<div class="dayResult">
			<h2>Итоги дня:</h2>
			<p>Блаблабла</p>
			<h3>Статистика:</h3>
			<p>Бла бла бла</p>
		</div>
 	</div>
 	<!-- //////////////////////////////////////////////////////////////////////////////////// -->
	<div id="block_calendar">
	    <table id="full_calendar">
	    	<thead>
	    		<th><i id="prevMonth" class="glyphicon glyphicon-chevron-left"></i></th>
				<th colspan="5">
					<span id="month"></span>
					<span id="year"></span>
				</th>
	    		<th><i id="nextMonth" class="glyphicon glyphicon-chevron-right"></i></th>
		    	<tr>
		    		<td>Пн</td>
		    		<td>Вт</td>
		    		<td>Ср</td>
		    		<td>Чт</td>
		    		<td>Пт</td>
		    		<td>Сб</td>
		    		<td>Вс</td>
		    	</tr>
	    	</thead>
	    	<tbody id="calendar"></tbody>
	    </table>
 	</div>
 	<script src="template/js/vue.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
	<script src="template/bootstrap/js/bootstrap.min.js"></script>
	<script src="template/js/jquery.maskedinput.min.js"></script>
	<script src="template/js/calendar.js"></script>
	<script>
		$('#saveToDB').on('click', function () {
			var taskText = [],
				tasksForDay = [],
				DayTasksLi = document.querySelectorAll('#DayTasks li');

			for (i=0; i<DayTasksLi.length; i++ ) {
				if (DayTasksLi[i].innerHTML != '')
					tasksForDay[i] = DayTasksLi[i].innerHTML;
			}
			var j=0;
			for (i=0; i<18; i++) {
				if (document.querySelector('#task'+i).innerHTML != '')
					taskText[i] = document.querySelector('#task'+i).innerHTML;
					if (typeof(taskText[i]) != 'undefined')	j++;
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
					slogan: sloganDB.innerHTML
				}
			}).done(function (data) {
				//alert(data);
				if (data == "ok") {
					alert('Done');
				} else if (data == "fail") {
					alert('Bad request');
				} else alert('undefined error');
			});
		});

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
	</script>
</body>
</html>
