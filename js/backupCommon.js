calendar = '<tr>';
var date = new Date(),
	options = {
	  year: 'numeric',
	  month: 'long',
	  day: 'numeric',
	  weekday: 'long'
	},
	lastDayOfMonth = new Date(date.getFullYear(), date.getMonth()+1, 0).getDate(),
	dayOfWeekOfLastDayMonth = new Date(date.getFullYear(), date.getMonth(), lastDayOfMonth).getDay(),
	dayOfWeekOfFirstDayMonth = new Date(date.getFullYear(), date.getMonth(), 1).getDay(),
	calendar_obj = new Vue({
  el: '#block_calendar',
  ready: function() {
  	this.setDefaultItems(date.getMonth());
  },
  data: {
  	year: date.getFullYear(),
  	months: [],
  },
  methods: {
  	setDefaultItems: function(monthNumber) {
  		var months = ["Январь", "Февраль", "Март", "Апрель", "Май" ,"Июнь", "Июль" ,"Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"];
  		this.months = months[monthNumber];//this.$set('months', months[monthNumber]);
			
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
  			if (i !== date.getDate()) {
  				if (new Date(date.getFullYear(), date.getMonth(), i).getDay() == 6 || 
  					new Date(date.getFullYear(), date.getMonth(), i).getDay() == 0) {
  					calendar += '<td class="holiday dayNumber" id="thisDate'+i+'" onclick="showDetails(thisDate'+i+');" fullDate="'+new Date(date.getFullYear(), date.getMonth(), i).toLocaleString('ru', options)+'">'+i+'</td>';
  				} else {
  					calendar += '<td class="dayNumber" id="thisDate'+i+'" onclick="showDetails(thisDate'+i+');" fullDate="'+new Date(date.getFullYear(), date.getMonth(), i).toLocaleString('ru', options)+'">'+i+'</td>';
  				}
  			} else {
  				calendar += '<td class="today dayNumber" id="thisDate'+i+'" onclick="showDetails(thisDate'+i+');" fullDate="'+new Date(date.getFullYear(), date.getMonth(), i).toLocaleString('ru', options)+'">'+i+'</td>';
  			}
  			if (new Date(date.getFullYear(), date.getMonth(), i).getDay() == 0) {
  				calendar += '<tr>';
  			}
  		}
  	}
  }
})
document.querySelector('#calendar').innerHTML += calendar;
function showDetails(day) {
	 alert(day.getAttribute('fullDate'));
}