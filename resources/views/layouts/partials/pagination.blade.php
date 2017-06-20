<?php if(empty($totalPages)){$totalPages = 100;} ?>
@if(!empty($totalPages))
@if ($pagenum = round(config('settings.pagenum')/2)) @endif
<div class="pages">
		@if($totalPages>1)
		<?php
		$currentPage = app('request')->input('anchor',1);
		$url = Request::all();
		unset($url['anchor']);
		$url = url()->current().'?'.http_build_query($url);

		if(strpos($url,'=')){
			$url = $url.'&';
		}

		if($currentPage>$pagenum){
			$page = $currentPage-$pagenum;
			if($totalPages>($currentPage+$pagenum)){
				$forPage = $currentPage+$pagenum;
			}else{
				$forPage = $totalPages;
			}
		}else{
			$page = 1;
			if($totalPages>$pagenum*2){
				$forPage = $pagenum*2;
			}else{
				$forPage = $totalPages;
			}
		}

		?>

		@if(!empty($pagetheme) && $pagetheme == 'js')
			@if($currentPage>1)
			<a href="javascript:loadComment();">首页</a>
			<a  class="prev" href="javascript:loadComment({{$currentPage-1}});"><b></b>上一页</a>
			@endif

			@for ($page = $page; $page <= $forPage; $page++)
				@if($page == $currentPage)
					<strong>{{$page}}</strong>
				@else
					<a href="javascript:loadComment({{$page}});">{{$page}}</a>
				@endif
			@endfor

			@if($totalPages>$currentPage)
			<a class="next" href="javascript:loadComment({{$currentPage+1}});">下一页</a>
			<a href="javascript:loadComment({{$totalPages}});">尾页</a>
			@endif

		@else
			@if($currentPage>1)
			<a href="{{$url}}">首页</a>
			<a  class="prev" href="{{$url}}anchor={{$currentPage-1}}"><b></b>上一页</a>
			@endif

			@for ($page = $page; $page <= $forPage; $page++)
				@if($page == $currentPage)
					<strong>{{$page}}</strong>
				@else
					<a href="{{$url}}anchor={{$page}}">{{$page}}</a>
				@endif
			@endfor

			@if($totalPages>$currentPage)
			<a class="next" href="{{$url}}anchor={{$currentPage+1}}">下一页</a>
			<a href="{{$url}}anchor={{$totalPages}}">尾页</a>
			@endif
		@endif

		@endif
	</ul>
</div>
@endif