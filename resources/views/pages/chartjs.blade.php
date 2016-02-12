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
			<div class="linechart">
				<canvas id="line-chart"></canvas>
			</div>
		</div>
		<div class="mdl-cell shadow mdl-cell--6-col mdl-cell--12-col-phone mdl-cell--12-col-tablet" style="background: white;">
			<div class="panel-header">
				Bar Chart
			</div>
			<div class="linechart">
				<canvas id="bar-chart"></canvas>
			</div>
		</div>
	</div>
	<div class="mdl-grid" style="margin-top:15px;">
		<div class="mdl-cell shadow mdl-cell--6-col mdl-cell--12-col-phone mdl-cell--12-col-tablet" style="background: white;">
			<div class="panel-header">
				Pie Chart
			</div>
			<div class="linechart">
				<div class="round-container">
					<canvas id="pie-chart"></canvas>
				</div>
			</div>
		</div>
		<div class="mdl-cell shadow mdl-cell--6-col mdl-cell--12-col-phone mdl-cell--12-col-tablet" style="background: white;">
			<div class="panel-header">
				Donut Chart
			</div>
			<div class="linechart">
				<canvas id="donut-chart"></canvas>
			</div>
		</div>
	</div>
@stop

@section('js')

    @parent

    <script>
    	$(function () {
			var data = {
			    labels: ["January", "February", "March", "April", "May", "June", "July"],
			    datasets: [
			        {
			            label: "My First dataset",
			            fillColor: "rgba(41,121,255,0.2)",
			            strokeColor: "rgba(41,121,255,1)",
			            pointColor: "rgba(41,121,255,1)",
			            pointStrokeColor: "#fff",
			            pointHighlightFill: "#fff",
			            pointHighlightStroke: "rgba(41,121,255,1)",
			            data: [65, 59, 80, 81, 56, 55, 40]
			        },
			        {
			            label: "My Second dataset",
			            fillColor: "rgba(0,213,84,0.2)",
			            strokeColor: "rgba(0,213,84,1)",
			            pointColor: "rgba(0,213,84,1)",
			            pointStrokeColor: "#fff",
			            pointHighlightFill: "#fff",
			            pointHighlightStroke: "rgba(151,187,205,1)",
			            data: [28, 48, 40, 19, 86, 27, 90]
			        }
			    ]
			};

			var LineChart = document.getElementById("line-chart").getContext("2d");

	        var chartCurves = new Chart(LineChart).Line(data, {
	        	responsive: true,
	            datasetStroke: false,
	            legendTemplate: false,
	            pointDotRadius : 6,
	            showTooltips: false	       
	        });

	        var data = {
			    labels: ["January", "February", "March", "April", "May", "June", "July"],
			    datasets: [
			        {
			            label: "My First dataset",
			            fillColor: "rgba(255,167,38,0.5)",
			            strokeColor: "rgba(255,167,38,0.8)",
			            highlightFill: "rgba(255,167,38,0.75)",
			            highlightStroke: "rgba(255,167,38,1)",
			            data: [65, 59, 80, 81, 56, 55, 40]
			        },
			        {
			            label: "My Second dataset",
			            fillColor: "rgba(255,64,129,0.5)",
			            strokeColor: "rgba(255,64,129,0.8)",
			            highlightFill: "rgba(255,64,129,0.75)",
			            highlightStroke: "rgba(255,64,129,1)",
			            data: [28, 48, 40, 19, 86, 27, 90]
			        }
			    ]
			};	

			var BarChart = document.getElementById("bar-chart").getContext("2d");

			var chartCurves2 = new Chart(BarChart).Bar(data, {
	        	responsive: true,
	            datasetStroke: false,
	            legendTemplate: false,
	            pointDotRadius : 6,
	            showTooltips: false	       
	        });

	        var data3 = [
			    {
			        value: 300,
			        color:"#ff4081",
			        highlight: "#FF5A5E",
			        label: "Red"
			    },
			    {
			        value: 50,
			        color: "#00D554",
			        highlight: "#5AD3D1",
			        label: "Green"
			    },
			    {
			        value: 100,
			        color: "#ffa726",
			        highlight: "#FFC870",
			        label: "Yellow"
			    }
			]
			var PieChart = document.getElementById("pie-chart").getContext("2d");	
			var DonutChart = document.getElementById("donut-chart").getContext("2d");	
			
			var chartCurves3 = new Chart(PieChart).Pie(data3, {
				responsive: true,
	            datasetStroke: false,
	            legendTemplate: false,
	            pointDotRadius : 6,
	            showTooltips: false	
			});		
			var chartCurves4 = new Chart(DonutChart).Doughnut(data3, {
				responsive: true,
	            datasetStroke: false,
	            legendTemplate: false,
	            pointDotRadius : 6,
	            showTooltips: false	
			});	
			$('.c-hamburger').click(function() {
				chartCurves.clear();
				chartCurves2.clear();
				chartCurves3.clear();
				chartCurves4.clear();
				
				setTimeout(function() {
					chartCurves.render();										
					chartCurves.resize();
					chartCurves2.render();										
					chartCurves2.resize();
					chartCurves3.render();										
					chartCurves3.resize();
					chartCurves4.render();										
					chartCurves4.resize();
				}, 500);
			});	
		});

    </script>

@endsection