@extends('partials.dashboard')

@section('page_title')
	ChartJS
@stop

@section('dashboard-content')
	<div class="mdl-grid" style="margin-top:15px;">
		<div class="mdl-cell shadow mdl-cell--6-col mdl-cell--12-col-phone mdl-cell--12-col-tablet" style="background: white;">
			<div class="panel-header">
				Line Chart
			</div>
			<div class="panel-body forms">
				<div id="line-chart"></div>
			</div>
		</div>
		<div class="mdl-cell shadow mdl-cell--6-col mdl-cell--12-col-phone mdl-cell--12-col-tablet" style="background: white;">
			<div class="panel-header">
				Bar Chart
			</div>
			<div class="panel-body forms">
				<div id="bar-chart"></div>
			</div>
		</div>
	</div>
	<div class="mdl-grid" style="margin-top:15px;">
		<div class="mdl-cell shadow mdl-cell--6-col mdl-cell--12-col-phone mdl-cell--12-col-tablet" style="background: white;">
			<div class="panel-header">
				Pie Chart
			</div>
			<div class="panel-body forms">
				<div class="round-container">
					<div id="pie-chart"></div>
				</div>
			</div>
		</div>
		<div class="mdl-cell shadow mdl-cell--6-col mdl-cell--12-col-phone mdl-cell--12-col-tablet" style="background: white;">
			<div class="panel-header">
				Donut Chart
			</div>
			<div class="panel-body forms">
				<div id="donut-chart"></div>
			</div>
		</div>
	</div>
@stop

@section('js')

    @parent

    <script>
    	$(function () {
			var chart = c3.generate({
	        	bindto: '#line-chart',
			    data: {
			        columns: [
			            ['Players', 30, 200, 100, 400, 150, 250, 200, 120, 80, 180, 40, 90, 220, 110, 20],
			            ['Times', 30, 150, 80, 250, 150, 270, 240, 180, 280, 140, 120, 70, 140, 190, 220]
			        ],
			        type: 'line'
			    },
			    bar: {
			        width: {
			            width: 50 // this makes bar width 50% of length between ticks
			        }
			        // or
			        //width: 100 // this makes bar width 100px
			    },
			    color: {
				  pattern: ['#00D554','#2979ff']
				},
				padding: {
					left: 10,
					right: 10,
					top: 10
				},
				legend: {
					hide: true
				}
			}); 

			var chart2 = c3.generate({
	        	bindto: '#bar-chart',
			    data: {
			        columns: [
			            ['Players', 30, 200, 100, 400, 150, 250, 200, 120, 80, 180, 40, 90, 220, 110, 20],
			            ['Times', 30, 150, 80, 250, 150, 270, 240, 180, 280, 140, 120, 70, 140, 190, 220]
			        ],
			        type: 'bar'
			    },
			    bar: {
			        width: {
			            width: 80 // this makes bar width 50% of length between ticks
			        }
			        // or
			        //width: 100 // this makes bar width 100px
			    },
			    color: {
				  pattern: ['#00D554','#ff4081']
				},
				padding: {
					left: 10,
					right: 10,
					top: 10
				},
				legend: {
					hide: true
				}
			}); 

			var chart3 = c3.generate({
				bindto: '#pie-chart',
			    data: {
			        // iris data from R
			        columns: [
			            ['data1', 30],
			            ['data2', 120],
			            ['data3', 80],
			            ['data4', 45],
			        ],
			        type : 'pie',
			        onclick: function (d, i) { console.log("onclick", d, i); },
			        onmouseover: function (d, i) { console.log("onmouseover", d, i); },
			        onmouseout: function (d, i) { console.log("onmouseout", d, i); }
			    },
			    legend: {
					hide: true
				},
				color: {
				  pattern: ['#00D554','#ff4081','#2979ff','#ffa726']
				},
			});
			var chart4 = c3.generate({
				bindto: '#donut-chart',
			    data: {
			        // iris data from R
			        columns: [
			            ['data1', 30],
			            ['data2', 120],
			            ['data3', 80],
			            ['data4', 45],
			        ],
			        type : 'donut',
			        onclick: function (d, i) { console.log("onclick", d, i); },
			        onmouseover: function (d, i) { console.log("onmouseover", d, i); },
			        onmouseout: function (d, i) { console.log("onmouseout", d, i); }
			    },
			    legend: {
					hide: true
				},
				color: {
				  pattern: ['#00D554','#ff4081','#2979ff','#ffa726']
				},
			});
			$('.c-hamburger').click(function() {
				
				setTimeout(function() {
					chart.resize();
					chart2.resize();
					chart3.resize();
					chart4.resize();				
				}, 150);
			});	

		});

    </script>

@endsection