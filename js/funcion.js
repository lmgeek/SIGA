function digiClock ( )  
    {  
    var crTime = new Date ( );  
    var crHrs = crTime.getHours ( );  
    var crMns = crTime.getMinutes ( );  
    var crScs = crTime.getSeconds ( );  
    crMns = ( crMns < 10 ? "0" : "" ) + crMns;  
    crScs = ( crScs < 10 ? "0" : "" ) + crScs;  
    var timeOfDay = ( crHrs < 12 ) ? "AM" : "PM";  
    crHrs = ( crHrs > 12 ) ? crHrs - 12 : crHrs;  
    crHrs = ( crHrs == 0 ) ? 12 : crHrs;  
    var crTimeString = crHrs + ":" + crMns + ":" + crScs + " " + timeOfDay;  
  
    $("#clock").html(crTimeString);  
  
 }  
  
$(document).ready(function()  
{  
   setInterval('digiClock()', 1000);  
  
});  