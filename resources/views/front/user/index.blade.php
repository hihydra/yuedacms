@extends('layouts.front')
@section('title'){{$name}}-@endsection
@section('css')
@endsection
@section('content')
@include('front.share.leftSidebar')
<div class="M2" style="margin-top:10px; width:928px;">
	@include('front.share.crumb',['name'=>$name])
	<div class="fl-main">
		<div class="book-select" style="margin-top:0;">
			<div class="bs-info">
				<ul class="bs-ul" style="margin-top:0;">
					<li class="on">
						<a href="{{url('user')}}" class="smooth">{{trans('front/system.userInfo')}}</a>
						<b></b>
					</li>
					<li>
						<a href="{{url('user/safe')}}" class="smooth">{{trans('front/system.safe')}}</a>
						<b></b>
					</li>
					<div class="clear"></div>
				</ul>
			</div>
		</div>
		<div style="width:930px; margin:20px 0 10px 0;">
			<div class="item">
				<span class="label"><em>*</em> 昵称：</span>
				<div class="fl">
					<input class="itxt" name="nickname" maxlength="20" value="{{{$nickname or ''}}}" type="text" />
				</div>
			</div>
			<div class="clear"></div>
			<div class="item">
				<span class="label"><em>*</em> 性别：</span>
				<div class="left" style="height:28px; line-height:28px;">
					<input name="sex" class="jdradio" value="0" type="radio">
					<label class="mr">男</label>
					<input name="sex" class="jdradio" value="1" type="radio">
					<label class="mr">女</label>
				</div>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
			<div class="item">
				<span class="label"><em>*</em> 生日：</span>
				<div class="left" style="height:28px; line-height:28px;">
					<select class="selt sel_year" name="year" rel="{{date('Y',$birthday)}}"> </select>
					<label class="ml">年</label>
					<select class="selt sel_month" name="month" rel="{{date('m',$birthday)}}"> </select>
					<label class="ml">月</label>
					<select class="selt sel_day"  name="day" rel="{{date('d',$birthday)}}"> </select>
					<label class="ml">日</label>
				</div>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
			<div class="item">
				<span class="label"><em>*</em> 邀请码：</span>
				<div class="left">
					@if($invitationCode)
					<input class="itxt" maxlength="20" name="superiorCode" value="{{$invitationCode}}" type="text" disabled/>
					@else
					<input class="itxt" maxlength="20" name="superiorCode" value="" type="text"/>
					@endif
				</div>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
			<div class="item">
				<span class="label"><em>*</em> 修改头像：</span>

				<div class="left" style="position:relative;">
					<input type="file" class="photo-input" onchange="javascript:weiboAttachmentUpload(this,'weibo_form_upload','PHOTO')" name="file" accept="image/*" style="left:0; top:0; width:175px; height:45px;">
					<a class="Btn btn_blue">&nbsp;</a>
					<div style="padding:5px; border:1px solid #f1f1f1; width:200px;" class="item left preview_fake_1"><img src="{{asset('front/img/face.jpg')}}" style="width:100%;"></div>
				</div>
				<div class="item left preview_fake" style="width:260px; margin-left:20px;">
					<p style=" font-weight:bold;">预览</p>
					<div class="left">
						<p>仅支持IPG、GIF、PNG格式，文件小于5M（使用高质量图片，可生成高清头像）</p>
						<img src="{{asset('front/img/face.jpg')}}" style="padding:5px; border:1px solid #f1f1f1; width:50%;">
					</div>
					<div class="clear"></div>

				</div>
				<div class="clear"></div>
				<div class="item">
					<span class="label">&nbsp;</span>
					<div class="info-c">
						<a class="btn_red" href="javascript:saveInfo();">保存</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('js')
<script type="text/javascript" src="{{asset('vendors/birthday/birthday.js')}}"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$(".jdradio[value='{{$sex}}']").attr("checked",'checked');
		$.ms_DatePicker({
            YearSelector: ".sel_year",
            MonthSelector: ".sel_month",
            DaySelector: ".sel_day"
    	});
	})
	function saveInfo(){
		var nickname = $("input[name='nickname']").val();
		var sex = $("input[name='sex']:checked").val();
		var year = $("select[name='year'] option:selected").val();
		var month = $("select[name='month'] option:selected").val();
		var day = $("select[name='day'] option:selected").val();
		var superiorCode = $("input[name='superiorCode']").val();
		if(nickname.length==0){
			layer.msg("{{trans('front/system.nickname_error')}}");return;
		}
		if(year.length!=0 && month.length!=0 && day.length!=0){
			var date = new Date(year+'/'+month+'/'+day);
			var birthday = date.getTime()/1000;
		}
		if(superiorCode == {{$invitationCode}}){
			superiorCode = '';
		}
		$.post("{{url('user/saveInfo')}}",{'nickname':nickname,'sex':sex,'birthday':birthday,'superiorCode':superiorCode},function(result){
			layer.msg(result.message);
			if(result.result == 1){
				window.location.reload();
			}
		});
	}
</script>
@endsection
