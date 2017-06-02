@if(!empty($totalPages))
@if ($pagenum = round(config('setting.pagenum')/2)) @endif
<div class="pages">
			@if($totalPages>1)
			<?php
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
				if($totalPages>$pagenum){
					$forPage = $pagenum;
				}else{
					$forPage = $totalPages;
				}
			}

			?>
			@if($currentPage>1)
			<a href="{{$url}}">首页</a>
			<a  class="prev icon-disable1" href="{{$url}}pageNo={{$currentPage-1}}"><b></b>上一页</a>
			@endif

			@for ($page = $page; $page <= $forPage; $page++)
			<a @if($page == $currentPage)class="active" @endif href="{{$url}}pageNo={{$page}}">{{$page}}</a>
			@endfor

			@if($totalPages>$currentPage)
			<a class="next" href="{{$url}}pageNo={{$currentPage+1}}">下一页</a>
			<a href="{{$url}}pageNo={{$totalPages}}">尾页</a>
			@endif
			@endif
		</ul>
		<a class="niTurnPage2_page">共<em>{{$totalPages}}</em>页</a>
</div>
@endif