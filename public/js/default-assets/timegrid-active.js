document.addEventListener("DOMContentLoaded",function(){var e=document.getElementById("calendar");new FullCalendar.Calendar(e,{plugins:["dayGrid","timeGrid"],header:{left:"prev,next today",center:"title",right:"dayGridMonth,timeGridWeek"},defaultDate:"2019-04-12",events:[{start:"2019-04-11T10:00:00",end:"2019-04-11T16:00:00",rendering:"background",color:"#ff9f89"},{start:"2019-04-13T10:00:00",end:"2019-04-13T16:00:00",rendering:"background",color:"#ff9f89"},{start:"2019-04-24",end:"2019-04-28",overlap:!1,rendering:"background"},{start:"2019-04-06",end:"2019-04-08",overlap:!1,rendering:"background"}]}).render()});