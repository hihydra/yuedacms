@extends('layouts.front')
@section('title'){{$name}}-@endsection
@section('css')
<script type="text/javascript" src="{{asset('vendors/city-picker/city-picker.css')}}"></script>
@endsection
@section('content')
@include('front.share.leftSidebar')
<div class="M2" style="margin-top:10px; width:928px;">
	@include('front.share.crumb',['name'=>$name])
	<div class="fl-main">
		<div style="width:930px; margin:20px 0 10px 0;">
			<div class="item">
				<span class="label"><em>*</em> 收货人：</span>
				<div class="fl">
					<input class="itxt" name="nickname" maxlength="20" value="" type="text" placeholder="收货人姓名" />
				</div>
			</div>
			<div class="clear"></div>
			<div class="item">
				<span class="label"><em>*</em> 手机号：</span>
				<div class="fl">
					<input class="itxt" maxlength="20" name="superiorCode" value="" type="text" placeholder="收货人手机号码"/>
				</div>
			</div>
			<div class="clear"></div>
			<div class="item">
				<span class="label"><em>*</em> 详细地址：</span>
				<div class="fl">
					<textarea style="width:490px; height:70px; border:1px solid #ccc; padding:5px;" placeholder="建议您如实填写详细收货地址，例如街道名称，门牌号码，楼层和房间号等信息"></textarea>
				</div>
			</div>
			<div class="clear"></div>
			<div class="item">
				<span class="label"><em>*</em> 所在地区：</span>
				<div class="fl">
					<div id="distpicker">
						<div class="form-group">
							<div style="position: relative;">
								<input id="city-picker3" class="form-control" readonly type="text" value="江苏省/常州市/溧阳市" data-toggle="city-picker">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="clear"></div>
			<div class="item">
				<span class="label"><em></em></span>
				<div class="left">
					<input type="checkbox" class="i-chk" name="defaultAddress">
					<label>设置为默认收货地址</label>
				</div>
			</div>
			<div class="clear"></div>
			<div class="item">
				<span class="label">&nbsp;</span>
				<div class="info-c">
					<a class="btn_red" href="#">保存</a>
				</div>
			</div>

			<div class="clear"></div>
			<div class="item">
				<span class="label">&nbsp;</span>
				<div class="TabContent">
						<table class="perTable" cellspacing="0" cellpadding="0">
							<tbody>
								<tr>
									<th>收货人</th>
									<th>所在地区</th>
									<th>详细地址</th>
									<th>联系方式</th>
									<th>操作</th>
									<th></th>
								</tr>
								@foreach($addresslist as $address)
								<tr>
									<td>{{$address['name']}}</td>
									<td>{{$address['address']}}</td>
									<td>{{$address['village']}}</td>
									<td>{{$address['mobile']}}</td>
									<td><a href="">修改</a>|<a href="">删除</a></td>
									@if($address['isDefault'])
									<td><span class="btn_red">默认地址</span></td>
									@endif
								</tr>
								@endforeach
							</tbody>
						</table>
				</div>
			</div>

		</div>
	</div>
</div>
@endsection
@section('js')
<script type="text/javascript" src="{{asset('vendors/city-picker/city-picker.js')}}"></script>
<script type="text/javascript" src="{{asset('vendors/city-picker/city-picker.data.js')}}"></script>
<script type="text/javascript">
    var cityPicker = new IIInsomniaCityPicker({
        data: cityData,
        target: '#cityChoice',
        valType: 'k-v',
        hideCityInput: '#city',
        hideProvinceInput: '#province',
        callback: function(city_id){
        }
    });

    cityPicker.init();
	function saveInfo(){
		$.post("{{url('user/saveInfo')}}",{'nickname':nickname,'sex':sex,'birthday':birthday},function(result){
			layer.msg(result.message);
			if(result.result == 1){
				window.location.reload();
			}
		});
	}
</script>
@endsection
