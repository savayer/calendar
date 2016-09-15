calendar = '<tr>';
var date = new Date(),
	options = {
	  year: 'numeric',
	  month: 'long',
	  day: 'numeric',
	  weekday: 'long'
	},
	months = ["Январь", "Февраль", "Март", "Апрель", "Май" ,"Июнь", "Июль" ,"Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],
	yearGlob = date.getFullYear(),
	monthGlob = date.getMonth(),
	lastDayOfMonth = new Date(yearGlob, monthGlob+1, 0).getDate(),
	dayOfWeekOfLastDayMonth = new Date(yearGlob, monthGlob, lastDayOfMonth).getDay(),
	dayOfWeekOfFirstDayMonth = new Date(yearGlob, monthGlob, 1).getDay();

function showMonth(year, monthNumber) {
	document.querySelector('#calendar').innerHTML = calendar = '';
	if (dayOfWeekOfFirstDayMonth !== 0) {
		for (i=1; i<dayOfWeekOfFirstDayMonth; i++) {
			calendar += "<td></td>";
		}
	} else {
		for (i=0; i<6; i++) {
			calendar += "<td></td>";
		}
	}
	for (i=1; i<=lastDayOfMonth; i++) {
		if (i !== date.getDate() || monthNumber !== date.getMonth() || year !== date.getFullYear() ) {
			if (new Date(year, monthNumber, i).getDay() == 6 || 
				new Date(year, monthNumber, i).getDay() == 0) {
				calendar += '<td class="holiday dayNumber" id="thisDate'+i+'" onclick="showDetails(thisDate'+i+');" fullDate="'+new Date(year, monthNumber, i).toLocaleString('ru', options)+'">'+i+'</td>';
			} else {
				calendar += '<td class="dayNumber" id="thisDate'+i+'" onclick="showDetails(thisDate'+i+');" fullDate="'+new Date(year, monthNumber, i).toLocaleString('ru', options)+'">'+i+'</td>';
			}
		} else {
			calendar += '<td class="today dayNumber" id="thisDate'+i+'" onclick="showDetails(thisDate'+i+');" fullDate="'+new Date(year, monthNumber, i).toLocaleString('ru', options)+'">'+i+'</td>';
		}
		if (new Date(year, monthNumber, i).getDay() == 0) {
			calendar += '<tr>';
		}
	}	
	document.querySelector('#month').innerHTML = months[monthNumber];
	document.querySelector('#year').innerHTML = year;
	document.querySelector('#calendar').innerHTML += calendar;
}

function showDetails(day) {
	//alert(day.getAttribute('fullDate'));
 	menu.classList.add('sld');
	 	
	var height = document.documentElement.clientHeight;
	menu.style.height = height+'px';
	block_calendar.classList.remove('backToCenter');
	block_calendar.classList.add('sld-cont');
	document.querySelector('#Date').innerHTML = day.getAttribute('fullDate');
}

closeMenu.onclick = function () {
	menu.classList.remove('sld');
	block_calendar.classList.remove('sld-cont');
	block_calendar.classList.add('backToCenter');
}

showMonth(date.getFullYear(), date.getMonth());

prevMonth.onclick = function () {
	if (monthGlob == 0) {
		monthGlob = 11;
		yearGlob = yearGlob - 1;
	} else {
		monthGlob = monthGlob - 1;
	}
	lastDayOfMonth = new Date(yearGlob, monthGlob+1, 0).getDate(),
	dayOfWeekOfLastDayMonth = new Date(yearGlob, monthGlob, lastDayOfMonth).getDay(),
	dayOfWeekOfFirstDayMonth = new Date(yearGlob, monthGlob, 1).getDay();
	showMonth(yearGlob, monthGlob);
}

nextMonth.onclick = function () {
	if (monthGlob == 11) {
		monthGlob = 0;
		yearGlob = yearGlob + 1;
	} else {
		monthGlob = monthGlob + 1;
	}
	lastDayOfMonth = new Date(yearGlob, monthGlob+1, 0).getDate(),
	dayOfWeekOfLastDayMonth = new Date(yearGlob, monthGlob, lastDayOfMonth).getDay(),
	dayOfWeekOfFirstDayMonth = new Date(yearGlob, monthGlob, 1).getDay();
	showMonth(yearGlob, monthGlob);
}

function editTask() {
	//получить выбранную дату и вставить в условие 
	if (monthGlob >= date.getMonth() && yearGlob >= date.getFullYear()) {
		//вставить записанное дело в инпут для редактирования

	}
} 