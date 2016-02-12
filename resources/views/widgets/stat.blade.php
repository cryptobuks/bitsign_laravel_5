<div class="stat">
	<div class="chart-container">
		<div id="{{ $chartID }}" data-percent="{{ $value }}"></div>
		<div class="value"> {{ $value }}%</div>
	</div>
	<div class="stat-values">
		{{ $header }} 
		<div class="bottom-stat">
			<span class="{{ $arrow }}"></span>&nbsp;
			<span class="lighter"> {{ $footer }}</span>
		</div>
	</div>
</div>