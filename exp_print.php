<? $id=$_GET["id"]; ?>

<meta HTTP-EQUIV="REFRESH" content="0; url=http://opik.fyysika.ee/index.php/exp/display/<? echo $id; ?>">

<? 

include("connect.php");
include("globals.php");



//echo $_POST["submit_value"];



$eh=$_GET["action"];

$id=$_GET["id"];

$domain=$_GET["domain"];

$result_exp=mysql_query("SELECT * FROM exp WHERE id='".$id."'" );

$line_exp=mysql_fetch_array($result_exp);

if($line_exp["gpid_demo"]==31)

{

?>

<html>

	<head>

		<title>Targad valemid</title>

		<meta name="author" content="Lauri Hämarik">

		<link href="valemid/slider/jquery.nouislider.min.css" rel="stylesheet">



		<script type="text/javascript" src="valemid/jquery-2.1.0.min.js"></script>

		<script type="text/javascript" src="valemid/highstock.js"></script>

		<script type="text/javascript" src="valemid/slider/jquery.nouislider.min.js"></script>

		

		<script type="text/javascript" src="http://tume-maailm.pri.ee/mathjax/MathJax.js?config=TeX-AMS_HTML-full"></script>

		<style type="text/css">

body{

	margin:10px;

}

#eq_choose_text{

	width:100%;

}

#eq_main .MathJax_Display{

	margin:0;

}

.eq_param{

	line-height:30px;

}

.eq_param0{

	float:left;

	width:60px;

}

.eq_param2{

	float:right;

	width:40px;

	text-align:center;

}

.eq_param3{

	float:right;

	width:40px;

	text-align:center;

}

.eq_param1{

	overflow:hidden;

	padding:6px 18px;

}

#eq_choose li{

	cursor:pointer;

	line-height:1.5em;

}



#eq_graph{

	overflow:hidden;

}

#eq_axis_y{

	float:left;

	width:30px;

}

#eq_axis_y1{

	width:400px;

	margin-left:-190px;

}

#eq_axis_y .MathJax_Display{

	height:400px;

	width:400px;

	text-align:left;

	display:table-cell;

	vertical-align:middle;

	-ms-transform:rotate(-90deg);

    -webkit-transform: rotate(-90deg);

	transform:rotate(-90deg);

}

#eq_data{

	margin-top: 5px;

	height: 195px;

}

#eq_data_text{

	width: 100%;

	height: 195px;

}

#eq_data_button{

	margin-top:-28px;

	margin-left:7px;

}

		</style>

	</head>











<? 

}

?>

<body>

<? 

if($line_exp["gpid_demo"]!=31)

{

	 ?><table align="center" width="700" border="0">

  <tr>

    <td><? echo $line_exp["kokku_est"]?></td>

  </tr>

 <? if($line_exp["gpid_demo"]==40)

{ ?>

  <tr>

    <td><? echo "<img src=\"http://ucukawu.havike.eenet.ee/wordpress/wp-content/uploads/2014/06/ETAg_TeaMe_EL-Sotsiaalfond_v.jpg\" class=\"header-image\" width=\"700\" height=\"133\" alt=\"\" /><br><span class=\"navi\"><a rel=\"license\" href=\"http://creativecommons.org/licenses/by-sa/3.0/\"><img alt=\"Creative Commonsi litsents\" style=\"border-width:0\" src=\"https://i.creativecommons.org/l/by-sa/4.0/88x31.png\" /></a><br />See teos on litsentseeritud <a rel=\"license\" href=\"http://creativecommons.org/licenses/by-sa/3.0/\">Creative Commonsi Autorile viitamine + Jagamine samadel tingimustel 3.0 Rahvusvaheline litsentsiga</a></span>";?></td>

  </tr>

  <? }?>

 

  

  

</table>

<? 

}

if($line_exp["gpid_demo"]==31)

{



?> 

		<div id="eq_choose">

			<ul>

				<li>'{A = \frac{{m{v^2}}}{2}}','J',[['v','\frac{m}{s}',1,0,10],['m','kg',1,0.1,10]]</li>

				<li>'{v = \frac{{{m_1}{v_1}}}{{{m_1} + {m_2}}}}','\frac{m}{s}',[['m_1','kg',1,0,10],['m_2','kg',1,0.1,10],['v_1','\frac{m}{s}',1,0.1,10]]</li>

				<li>'{x = \sin (\omega * t)}','m',[['t','s',1,0,7],['\omega','\frac{rad}{s}',1,0.1,3]]</li>

				<li>'{x=at^2}','m',[['t','s',0,0,10],['a','\frac{m}{s^2}',1,0,10]]</li>

			</ul>

			<input type="text" id="eq_choose_text" />

			<input type="button" value="ok" id="eq_choose_go" />

		</div>

		<script type="text/javascript">

function Smart_equation() {

	this.draw_graph = function() {

		this.chart = new Highcharts.Chart({

			chart: {

				renderTo: 'eq_graph',

				animation: false,

				spacingBottom: 0,

				spacingLeft: 0

			},

			title: {

				text: '',

			},

			credits: {

		        enabled: false

	        },

			tooltip: {

				enabled: true,

			},

			xAxis: [{

				min: this.xmin,

				max: this.xmax,

				gridLineWidth: 0.2,

				startOnTick:true,

	            endOnTick:true,

			}],

			yAxis: [{

				title: {

					text: ''

				},

			}],

			legend: {

				enabled: false

			},

			exporting: {

				enabled: false

			},

			plotOptions: {

				series: {

					allowPointSelect: false,

					animation: false

				},

				line: {

					allowPointSelect: false,

					enableMouseTracking: true,

					states: {

	                    hover: {

	                        lineWidth: 1.5

	                    }

	                },

	                color: 'rgb(0,0,0)',

	                animation: false,

	                lineWidth: 1.5,

					marker: {

						enabled: false

					},

					tooltip: {

						headerFormat: '',

						pointFormat: '({point.x}, {point.y})',

						valueDecimals: 3

					}

				},

				scatter: {

					color: '#058DC7',

				}

			},

			tooltip: {

				formatter: function () {

					if (typeof this.y != 'undefined') {

						return '(' + this.x.toFixed(3) + ', ' + this.y.toFixed(3) + ')';

					}

				}

			},

			series: [{

				type: 'line',

				id: 'dataseries',

				data: [[this.xmin,0],[this.xmax,0]]

			},{

				type: 'flags',

				data: [{

					x: 5,

					title: 'E=12'

				}],

				onSeries: 'dataseries',

				shape: 'squarepin'

			},{

				type: 'scatter',

				data: []

			}]

		});

	}

	

	this_class	= this;

	

	this.draw_sliders = function() {

		var parms;

		for (var len=this.params.length, i=0; i<len; i++) {

			$('#eq_params').append('<div class="eq_param">'

				+ '<div class="eq_param0 eq_latex">$$' + this.params[i][0] + '$$</div>'

				+ '<div class="eq_param3">$$' + this.params[i][1] + '$$</div>'

				+ '<div class="eq_param2">' + this.params[i][2] + '</div>'

				+ '<div class="eq_param1"><div></div></div>'

			+ '</div>');

			

			parms	= {

				start: [this.params[i][2]],

				range: {

					'min': [this.params[i][3]],

					'max': [this.params[i][4]]

				}

			};

			

			if (i == 0) {

				$('#eq_main .eq_param div').last().noUiSlider(parms).on({slide: function(e){

					var $el	= $(e.target);

					$el.parent().parent().find('.eq_param2').text($el.val());

					this_class.calc(false);

				}});

			} else {

				$('#eq_main .eq_param div').last().noUiSlider(parms).on({slide: function(e){

					var $el	= $(e.target);

					$el.parent().parent().find('.eq_param2').text($el.val());

					this_class.calc(true);

				}});

			}

		}

	}

	

	this.format_val = function(value) {

		var val = value.toPrecision(3);

		if (val.indexOf('.') == -1) return val;

		return val.replace(/\.?0+$/, '').replace(/\.?(0+)e(.+)$/, 'e\$2');

	}

	

	this.resize	= function() {

		var height	= $(window).height() - $('#eq_tex').outerHeight(true)

			- $('#eq_axis_x').outerHeight(true) - $('#eq_params').outerHeight(true) - 30 - 200;

		$('#eq_graph').height(height);

		$('#eq_axis_y .MathJax_Display').height(height);

		smart_equation.chart.reflow();

	}

		

	this.calc = function(recalc) {

		if (this.calculating) {

			this.sliders_moved	= true;

		} else {

			this.calculating	= true;

			var eq	= this.equation_parsed;

			var $param_vals	= $('#eq_main .eq_param1 > div');

			for (var i=1; i < this.params.length; i+=1) {

				eq = eq.replace(new RegExp('(p'+i+')', 'g'), $param_vals.eq(i).val());

			}

			if (recalc) {

				var res	= [];

				var y;

				for (var x=this.calc_min; x<this.calc_max; x+=this.dx) {

					y	= eval(eq.replace(new RegExp('(p0)', 'g'), x));

					if (isNaN(y)) {

						console.log(y);

						continue;

					}

					res.push([x, y]);

				}

				this.chart.series[0].setData(res,false);

			}

			var x	= $param_vals.eq(0).val();

			y	= eval(eq.replace(new RegExp('(p0)', 'g'), x));

			x	= parseFloat(x);

			if (x == this.xmin) {

				x	= x + this.dx/10;

			}

			this.chart.series[1].data[0].remove(false);

			this.chart.series[1].addPoint({x:x,title:'('+this.format_val(x)+', '+this.format_val(y)+')'}, false);

			this.chart.redraw(false);

			if (this.sliders_moved) {

				this.sliders_moved	= false;

				this.calc();

			} else {

				this.calculating	= false;

			}

		}

	}

	

	this.find_bracket_right = function(str, start) {

		var nested	= 1;

		for (var i = start; i<str.length; i++) {

			if (str[i] == '(') {

				nested++;

			} else if (str[i] == ')') {

				nested--;

			}

			if (nested == 0) {

				return i+1;

			}

		}

		return -1;

	}

	

	this.find_bracket_left = function(str, end) {

		var nested	= 1;

		for (var i = end; i>-1; i--) {

			if (str[i] == ')') {

				nested++;

			} else if (str[i] == '(') {

				nested--;

			}

			if (nested == 0) {

				return i;

			}

		}

		return -1;

	}

	

	this.parse_eq = function() {

		var eq	= this.equation;

		

		var y	= eq.substring(0, eq.indexOf('='))

			.replace(new RegExp('{', 'g'), '(')

			.replace(new RegExp('}', 'g'), ')');

			

		while (y[0] == '(' && this.find_bracket_right(y, 1) == -1) {

			y	= y.substring(1);

		}

		this.ystr	= y

			.replace(new RegExp('\\(', 'g'), '{')

			.replace(new RegExp('\\)', 'g'), '}');

		

		eq	= eq.substring(eq.lastIndexOf('=') + 1)//equation right side

		

		for (var i=0; i < this.params.length; i+=1) {

			eq = eq.replace(new RegExp((this.params[i][0][0] == '\\'?'\\':'') + this.params[i][0], 'g'), '(p'+i+')');

		}

		

		console.log(eq);

		

		eq	= eq.replace(new RegExp('\\cdot', 'g'), '*')

			.replace(new RegExp('\\vec', 'g'), '')

			.replace(new RegExp('{', 'g'), '(')

			.replace(new RegExp('}', 'g'), ')')

			.replace(new RegExp(' ', 'g'), '')

			.replace(new RegExp('(\\\\|)sin', 'g'), 'Math.sin')

			.replace(new RegExp('(\\\\|)cos', 'g'), 'Math.cos')

			.replace(new RegExp('(\\\\|)tan', 'g'), 'Math.tan');

			

		while (eq[eq.length - 1] == ')' && this.find_bracket_left(eq, eq.length-2) == -1) {

			eq	= eq.substring(0, eq.length - 1);

		}

		

		console.log(eq);

			

		while ((index = eq.indexOf('\\frac')) > -1) {//frac{}{}->{}/{}

			end	= this.find_bracket_right(eq, index+6);

			eq	= eq.substring(0, index) + eq.substring(index+5, end) + '/' + eq.substring(end)

		}

		

		console.log(eq);

		

		while ((index = eq.indexOf('^')) > -1) {//a^b->Math.pow(a,b)

			//a^

			var pow_left;

			if (eq[index - 1] == ')') {//(a)^ -> Math.pow(a,

				index2	= this.find_bracket_left(eq, index - 2);

				pow_left	= eq.substring(0, index2) + 'Math.pow' + eq.substring(index2, index - 1);

			} else {//a^ -> Math.pow(a,

				//REDO:letter ends

				index2	= index - 2;

				pow_left	= eq.substring(0, index2) + 'Math.pow(' + eq.substring(index2, index - 1);

			}

		

			//^b

			var pow_right;

			if (eq[index + 1] == '(') {//^(b...) -> ,b...)

				pow_right	= eq.substring(index + 2)

			} else {//^b -> ,b)

				var index2	= eq.length;

				for (var i=index + 1; i< eq.length; i++) {

					//REDO:letter ends

					index2	= i + 1;

					break

				}

				pow_right	= eq.substring(index + 1, index2) + ')' + eq.substring(index2)

			}

			eq	= pow_left + ',' + pow_right;

			break;

		}

		

		eq	= eq.replace(new RegExp('\\)\\(', 'g'), ')*(')

				.replace(new RegExp('\\)Math', 'g'), ')*Math');

		

		console.log(eq);

		this.equation_parsed	= eq;

	}

	

	this.enterData = function() {

		var points	= [];

		var x, y;

		$.each($('#eq_data_text').val().split("\n"), function (i, line) {

			var parts	= line.split(/[;\t\s]+/);

			if (parts.length == 2) {

				x	= parseFloat(parts[0].replace(',', '.'));

				y	= parseFloat(parts[1].replace(',', '.'));

				if (!isNaN(x) && isFinite(x) && !isNaN(y) && isFinite(y)) {

					points.push([x, y]);

				}

			}

		});

		this_class.chart.series[2].setData(points);

	}

	

	this.show = function(equation, unit, params) {

		this.equation	= equation;

		this.yunit	= unit;

		this.xmin	= params[0][3];

		this.xmax	= params[0][4];

		this.dx	= (this.xmax - this.xmin) / 100;

		this.calc_min	= this.xmin;

		this.calc_max	= this.xmax + this.dx;

		this.params	= params;

		this.calculating	= false;

		this.sliders_moved	= false;

		this.parse_eq();

		$('body').append('<div id="eq_main"><div id="eq_tex">$$'+this.equation+'$$</div>'

			+ '<div id="eq_graph_cont">'

			+ '<div id="eq_axis_y"><div id="eq_axis_y1">$$' + this.ystr + '\\;(' + this.yunit + ')$$</div></div>'

			+ '<div id="eq_graph" style="height:400px;"></div></div>'

			+ '<div id="eq_axis_x">$$' + params[0][0] + '\\;(' + params[0][1] + ')$$</div>'

			+ '<div id="eq_params"></div>'

			+'<div id="eq_data"><textarea id="eq_data_text" placeholder="x1 y1\nx2 y2\n..."></textarea>'

			+'<input type="button" id="eq_data_button" value="Lisa" /></div></div>');

		this.draw_graph();

		this.draw_sliders();

		MathJax.Hub.Queue(["Typeset", MathJax.Hub, 'eq_tex']);

		MathJax.Hub.Queue(["Typeset", MathJax.Hub, 'eq_axis_y']);

		MathJax.Hub.Queue(["Typeset", MathJax.Hub, 'eq_axis_x']);

		MathJax.Hub.Queue(["Typeset", MathJax.Hub, 'eq_params']);

		this.calc(true);

		this.resize();

		$(window).resize(smart_equation.resize);

		$('#eq_data_button').click(smart_equation.enterData);

		this_class	= this;

	}

}



$(function(){

	smart_equation = new Smart_equation();

	//smart_equation.show('{v = \\frac{{{m_1}{v_1}}}{{{m_1} + {m_2}}}}', '\\frac{m}{s}', [['m_1', 'kg', 1, 0, 10],['m_2', 'kg', 1, 0.1, 10],['v_1', '\\frac{m}{s}', 1, 0.1, 10]]);

	<?php if ($line_exp['tex1'] != '') { ?>

	$('#eq_choose').hide();

	smart_equation.show(<?php echo str_replace('\\', '\\\\', $line_exp['tex1']); ?>);

	<?php } ?>

	$('#eq_choose li').click(function(e){

		var params	= $(e.target).text().replace(new RegExp('\\\\', 'g'), '\\\\');

		$('#eq_choose').hide();

		eval('smart_equation.show('+params+')');

	});

	$('#eq_choose_go').click(function(e){

		var params	= $('#eq_choose_text').val().replace(new RegExp('\\\\', 'g'), '\\\\');

		$('#eq_choose').hide();

		eval('smart_equation.show('+params+')');

	});

});

		</script>

 <? }?>

             

</body>

</html>

<?

?>