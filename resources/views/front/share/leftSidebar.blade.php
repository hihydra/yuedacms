<div class="bk-left" style="width:130px;">
	<div class="titList">
		<div class="pname">个人中心</div>
		<ul class="titList_ul">
			<li><a href="{{url('user/collection')}}">我的收藏</a></li>
			<li><a href="{{url('user')}}">个人设置</a></li>
      <li><a href="{{url('user/address')}}">收货地址</a></li>
			<li><a href="{{url('user/share')}}">分享应用</a></li>
			<li><a href="{{url('user/suggest')}}">意见反馈</a></li>
			<li><a href="#">关于</a></li>
		</ul>
	</div>
</div>
<script type="text/javascript">
    @php
    $cate = app('request')->segment(2);
    @endphp
    $(document).ready(function(){
      var urlstr =  "{{$cate}}";
      var urlstatus = false;
      $(".titList_ul li a").each(function () {
        if ($(this).attr('href').indexOf(urlstr) > -1 && urlstr !='' ) {
          $(this).parent().addClass('selected'); urlstatus = true;
        }
      })
      if (!urlstatus) {$(".titList_ul li a").eq(1).parent().addClass('selected'); }
   });
</script>