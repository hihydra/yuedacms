@extends('layouts.front')
@section('title'){{$name}}-@endsection
@section('css')
<link rel="stylesheet" href="{{asset('vendors/Jcrop/css/jquery.Jcrop.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/jquery.inputbox/jquery.inputbox.css')}}">
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
			<form id="saveInfo"  method="post" action="{{url('user/saveInfo')}}" enctype="multipart/form-data">
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
					<span class="label"><em>*</em> 常去门店：</span>
					<div class="fl">
						<div name="city" type="selectbox">
							<div class="opts">
								<a class="selected">请选择城市</a>
								@foreach($regionList as $region)
								<a href="javascript:getStore({{$region['id']}});" val="{{$region['id']}}">{{$region['name']}}</a>
								@endforeach
							</div>
						</div>
						<div name="storeId" type="selectbox">
							<div class="opts">
								<a class="selected">请选择门店</a>
							</div>
						</div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="item">
					<span class="label"></span>
					<div class="fl">
						<span style="color:red;">{{{$storeName or ''}}}</span>
					</div>
					<div class="clear"></div>
				</div>
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
					<div class="left choosePic" style="position:relative;">
						<input type="hidden" id="x" name="x">
						<input type="hidden" id="y" name="y">
						<input type="hidden" id="w" name="w">
						<input type="hidden" id="h" name="h">
						<input type="file" class="photo-input UploadImg" name="file" accept="image/*" style="left:0; top:0; width:175px; height:45px;">
						<a class="Btn btn_blue">&nbsp;</a>
						<div style="padding:5px; border:1px solid #f1f1f1; width:200px;" class="item left previewPic"><img src="{{asset('front/img/face.jpg')}}" style="width:100%;" id="cropbox"></div>
					</div>
					<div class="clear"></div>
					<div class="item">
						<span class="label">&nbsp;</span>
						<div class="info-c">
							<a class="btn_red" href="javascript:saveInfo();">保存</a>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
@section('js')
<script type="text/javascript" src="{{asset('vendors/jquery.inputbox/jquery.inputbox.js')}}"></script>
<script type="text/javascript" src="{{asset('vendors/birthday/birthday.js')}}"></script>
<script type="text/javascript" src="{{asset('vendors/Jcrop/js/jquery.Jcrop.min.js')}}"></script>
<script type="text/javascript" src="{{asset('vendors/jquery.ajaxupload/jquery.ajaxupload.js')}}"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$(".jdradio[value='{{$sex}}']").attr("checked",'checked');
		$.ms_DatePicker({
			YearSelector: ".sel_year",
			MonthSelector: ".sel_month",
			DaySelector: ".sel_day"
		});
	})
	$('div[name="city"]').inputbox({
		height:30,
		width:156
	});
	$('div[name="storeId"]').inputbox({
		height:30,
		width:156
	});
	function getStore(regionId){
		var params = {};
	    params.url = "{{url('store/ajaxStorefront')}}/"+regionId;
	    params.postType = 'get';
	    params.mustCallBack = true;// 是否必须回调
	    params.callBack = function(json) {
      		$('div[name="storeId"] .selected').html('请选择门店');
			$('input[name="storeId"]').val('');
			var html ="<a class='selected'>请选择门店</a>";
			$.each(json.data.datas,function(i,data){
				html+="<a val="+data.id+">"+ data.name +"</a>";
			});
			$('div[name="storeId"] .opts').html(html);
	    };
	    ajaxJSON(params);
	}
	//上传头像预览
	$('.choosePic').on('change', '.UploadImg', function(){
		var file = this.files[0];
		if(file == ''){
			return false;
		}
	    //判断类型是不是图片
	    if(!/image\/\w+/.test(file.type)){
	    	layer.msg('文件只能为图片类型');
	    	return false;
	    }

	    //判断照片是否小于2M
	    if(file.size > 2*1024*1024){
	    	layer.msg('图片大小不能超过2M');
	    	return false;
	    }

	    var reader = new FileReader();
	    reader.readAsDataURL(file);
	    reader.onload = function(e){
	        $('.previewPic img').attr('src',this.result) //就是base64
	        $('#cropbox').Jcrop({
	        	aspectRatio: 1,
	        	onSelect: updateCoords
	        });
	    }
	});
	function updateCoords(c){
		$('#x').val(c.x);
		$('#y').val(c.y);
		$('#w').val(c.w);
		$('#h').val(c.h);
	}
	function checkCoords(){
		if (parseInt($('#w').val())) {
			return true;
		};
		layer.msg('请先选择要裁剪的区域后，再提交。');
		return false;
	}
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
		$('#saveInfo').submit();
		/*
		if(superiorCode == {{$invitationCode}}){
			superiorCode = '';
		}
		$.ajax({
			url  : "{{url('user/saveInfo')}}",
			type : "post",
			data : new FormData($('#saveInfo')[0]),
			dataType: "json",
			contentType : false,
			processData : false,
			success : function(result) {
				layer.msg(result.message);
				if(result.result == 1){
					window.location.reload();
				}
			},
		});
		*/
	}
</script>
@endsection
