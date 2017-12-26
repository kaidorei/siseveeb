// JavaScript Document
// JavaScript Document
function startTimer()
{
  var DSTAdjust = 0;
  oneMinute = 1000 * 60;
  var oneDay = oneMinute * 60 * 24;
  var expired = 0;
  time = new Date();
  if (time.getTime() > timerEnd.getTime())
  {
    expired = 1;
  }
  else
  {
    DSTAdjust = (timerEnd.getTimezoneOffset( ) - time.getTimezoneOffset( )) * oneMinute;
    var diff = Math.abs(timerEnd.getTime( ) - time.getTime( )) - DSTAdjust;

    var days = Math.floor(diff/oneDay);
    var hours = Math.floor(diff/(60*oneMinute)) % 24;
    var minutes = Math.floor(diff/oneMinute) % 60;
    var seconds = Math.floor(diff/1000) % 60;
    var mseconds = diff % 1000;
  }
  if (expired)
  {
    document.getElementById('timer').innerHTML = "<tr><td><big>EXPIRED</big></td></tr>";
  }
  else
  {
    document.getElementById('days2').innerHTML = Math.floor(days/100);
    document.getElementById('days1').innerHTML = Math.floor((days%100)/10);
    document.getElementById('days0').innerHTML = days % 10;

    document.getElementById('hours1').innerHTML = Math.floor(hours/10);
    document.getElementById('hours0').innerHTML = hours % 10;

    document.getElementById('mins1').innerHTML = Math.floor(minutes/10);
    document.getElementById('mins0').innerHTML = minutes % 10;

    document.getElementById('secs1').innerHTML = Math.floor(seconds/10);
    document.getElementById('secs0').innerHTML = seconds % 10;

    document.getElementById('msecs2').innerHTML = Math.floor(mseconds/100);
    document.getElementById('msecs1').innerHTML = Math.floor((mseconds%100)/10);
    document.getElementById('msecs0').innerHTML = mseconds % 10;
    setTimeout('startTimer()', 100);
  }
}

document.write("<table id='timer' align='center' class='timer' cellpadding='0' cellspacing='0'>"+
      "<tr><td id='days2'>0</td><td id='days1'>0</td><td id='days0'>0</td><td>&nbsp;</td><td id='hours1'>0</td><td id='hours0'>0</td><td>&nbsp;</td><td id='mins1'>0</td><td id='mins0'>0</td><td>&nbsp;</td><td id='secs1'>0</td><td id='secs0'>0</td><td>&nbsp;</td><td id='msecs2'>0</td><td id='msecs1'>0</td><td id='msecs0'>0</td></tr>"+
      "<tr class='labels'><td colspan='3' align='center'>päeva</td><td>&nbsp;</td><td colspan='2' align='center'>tundi</td><td>&nbsp;</td><td colspan='2' align='center'>min</td><td>&nbsp;</td><td colspan='2' align='center'>sek</td><td>&nbsp;</td><td colspan='3' align='center'>msek</td></tr></table>");

window.onload=startTimer;
