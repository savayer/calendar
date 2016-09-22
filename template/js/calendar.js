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
 	menu.classList.add('slide-open-right');
	 	
	var height = document.documentElement.clientHeight;
	menu.style.height = height+'px';
	block_calendar.style.marginLeft = '-450px';
	block_calendar.style.transition = 'all 1s';
	document.querySelector('#Date').innerHTML = day.getAttribute('fullDate');
}

closeMenu.onclick = function () {
	menu.classList.remove('slide-open-right');
	block_calendar.style.marginLeft = '0';
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

/////////////////////////////////////////////////////////////////////

$(function() {
	$('#MaskTime').mask('99:99');
});
var hour = new Date().getHours(),
	minute = new Date().getMinutes();
if (hour < 10) hour = '0'+hour;
if (minute < 10) minute = '0'+minute;
var	vm = new Vue({
        el:'#body',
        data: {
        	hour: hour,
        	timeWakeUp: hour+':'+minute,
            slogan: "На пути к совершенству"
        }, 
        methods: {
        	startFromSetHourInTable: function() {
        		this.hour = this.timeWakeUp.substring(0,2);
        	} 
        }
    });
//vm.startFromSetHourInTable();
function FuncAddTaskForDay() {
	document.querySelector('#DayTasks').innerHTML += '<li>'+document.querySelector("#textTask").value+'</li>';
	document.querySelector('#textTask').value = '';
}

function setRating(index, SomeTask) {
	if (index == 1)
		document.querySelector('#'+SomeTask).style.cssText = 'background: #B5FF9F'; //green
	if (index == 0)
		document.querySelector('#'+SomeTask).style.cssText = 'background: #FF9F9F'; //red
}
ChangeTimeInTable();
function ChangeTimeInTable() {
	var h = vm.timeWakeUp.substring(0,2),
		m = vm.timeWakeUp.substring(3),
		end = 18;
	if (m*1 >= 45) h = h*1+1;

	for (i=0,j=0; i<end; i++, j++) {
    	if (i > 24-h*1) {
    		end = end - i;
    		i = 0;
    		h = 0;
    	}
    	document.querySelector('#HourNumberInTable'+j).innerHTML = i+h*1;
    }
}