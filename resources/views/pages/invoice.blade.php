@extends('partials.dashboard')

@section('page_title')
	Invoice
@stop

@section('dashboard-content')
	
	<div class="mdl-grid">
  		<div class="mdl-cell mdl-cell--12-col shadow" style="background: white; padding: 20px;">
			<div class="invoice-logo">
				Material 
				<div class="lighter">
					Dashboard
				</div>
			</div>
			<div class="right name">
				<strong>#1233219 / 01 Jan 2014 <br>
				Lorem ipsum dolor sit amet</strong>
			</div>
			<div class="mdl-grid">
				<div class="mdl-cell mdl-cell--6-col">
					<h5>Client:</h5>
					<div class="address">
						<strong>Customer Company, Inc.</strong> <br>
						1 Infinite Loop <br>
						Cupertino, CA 95014 <br>
						P: (123) 456-7890 <br>
						<strong>E-mail:</strong> info@customer.com
					</div>
				</div>
				<div class="mdl-cell mdl-cell--6-col">
					<h5>Payment Details:</h5>
					<div class="info">
						<strong>V.A.T Reg #:</strong> 233243444 <br>
						<strong>Account Name:</strong> Company Ltd <br>
						<strong>SWIFT code:</strong> 1233F4343ABCDEW <br>
						<strong>DATE:</strong> 01/01/2014 <br>
						<strong>DUE:</strong> 11/02/2014
					</div>
				</div>
			</div>
			<table class="mdl-data-table mdl-js-data-table" style="width: 100%; margin-top: 15px;">
				<thead>
					<tr>
						<th class="mdl-data-table__cell--non-numeric">#</th>
						<th class="mdl-data-table__cell--non-numeric" style="border-left: 1px solid #C7C7CB;">Name</th>
						<th class="mdl-data-table__cell--non-numeric" style="border-left: 1px solid #C7C7CB;">Description</th>
						<th class="mdl-data-table__cell--non-numeric" style="border-left: 1px solid #C7C7CB;">Age</th>
						<th class="mdl-data-table__cell--non-numeric" style="border-left: 1px solid #C7C7CB;">Price</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="mdl-data-table__cell--non-numeric">12</td>
						<td class="mdl-data-table__cell--non-numeric" style="border-left: 1px solid #C7C7CB;">John Doe</td>
						<td class="mdl-data-table__cell--non-numeric" style="border-left: 1px solid #C7C7CB;">Lorem</td>
						<td class="mdl-data-table__cell--non-numeric" style="border-left: 1px solid #C7C7CB;">25</td>
						<td class="mdl-data-table__cell--non-numeric" style="border-left: 1px solid #C7C7CB;">$54</td>
					</tr>
					<tr>
						<td class="mdl-data-table__cell--non-numeric">13</td>
						<td class="mdl-data-table__cell--non-numeric" style="border-left: 1px solid #C7C7CB;">Jane Doe</td>
						<td class="mdl-data-table__cell--non-numeric" style="border-left: 1px solid #C7C7CB;">Ipsum</td>
						<td class="mdl-data-table__cell--non-numeric" style="border-left: 1px solid #C7C7CB;">32</td>
						<td class="mdl-data-table__cell--non-numeric" style="border-left: 1px solid #C7C7CB;">$22</td>
					</tr>
					<tr>
						<td class="mdl-data-table__cell--non-numeric">14</td>
						<td class="mdl-data-table__cell--non-numeric" style="border-left: 1px solid #C7C7CB;">Jimmy Done</td>
						<td class="mdl-data-table__cell--non-numeric" style="border-left: 1px solid #C7C7CB;">Dolor</td>
						<td class="mdl-data-table__cell--non-numeric" style="border-left: 1px solid #C7C7CB;">29</td>
						<td class="mdl-data-table__cell--non-numeric" style="border-left: 1px solid #C7C7CB;">$85</td>
					</tr>
				</tbody>
			</table>
			<div class="right" style="margin-top: 20px;">
				<strong>Sub-Total:</strong> $12,876 <br>
				<strong>Discount:</strong> 9.9% <br>
				<strong>VAT:</strong> 22% <br>
				<strong>Total:</strong> $11,400 <br><br>
				<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent right" style="margin-left: 5px;">
					Print
				</button>
				<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent right">
					Submit
				</button>
			</div>
  		</div>
  	</div>
	
@stop