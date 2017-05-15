<div class="titleNav">
	<p>当前所在位置：
		<a href="{{url('/')}}">首页</a>
		@if(!empty($level))
		<span class="sep">></span>
		{{$level}}
		@endif
		<span class="sep">></span>
		{{$name}}
		<div class="clear"></div>
	</p>
</div>