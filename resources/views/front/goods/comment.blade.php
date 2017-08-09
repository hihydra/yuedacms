<div class="f-info" style="margin-top:10px;">
	@if($datas)
	<div class="mt">
		<div class="comments-table">
			<div class="com-table-main">
				@foreach($datas as $data)
				<div class="comments-item">
					<div class="column column1">
						@if(!empty($data['face']))
						<div class="face"><img src="{{$data['face']}}"/></div>
						@endif
						<div class="uname">{{{$data['uname'] or ''}}}</div>
						<div class="grade"><div class="g-star g-star{{$data['grade']}}"></div></div>
						<div class="comment-time">{{$data['datelineTime']}}</div>
					</div>
					<div class="column column2">
						<div class="p-comment">
							{{{$data['content'] or ''}}}
						</div>
						@if(!empty($data['img']))
						<div class="p-show-img">
							<ul>
								<li><div class="show-more-pic"><img src="{{$data['img']}}" width="120px"/></div></li>
							</ul>
						</div>
						@endif
						<div class="clear"></div>
					</div>
					<div class="clear"></div>
				</div>
				@endforeach
			</div>
		</div>
		<!--分页-->
		@include('layouts.partials.pagination',['pagetheme'=>'js'])
		<div class="clear"></div>
	</div>
	@else
	<center>累计评价0</center>
	@endif
</div>