@extends('layouts.front')
@section('title'){{$name}}-@endsection
@section('css')
<style type="text/css">
.perTable td a{color: #36c;}
.perTable tr:hover{background-color: #eee;}
.perTable .note-implicit{color:#fff;}
.perTable tr:hover .note-implicit{padding: 5px 5px; border-color: #f30; border-radius: 3px; background: #f30;color: #fff;}
.perTable .note{padding: 5px 5px; border-color: #ff3800; border-radius: 3px; background: #ffd6cc; color: #f30;}
.perTable td a:hover{color: #f30;}
</style>
@endsection
@section('content')
@include('front.share.leftSidebar')
<div class="M2" style="margin-top:10px; width:928px;">
	@include('front.share.crumb',['name'=>$name])
	<div class="fl-main">
		<div style="width:930px; margin:20px 0 10px 0;" id="signupForm">
			<div class="item">
				<span class="label"><em>*</em> 收货人：</span>
				<div class="fl">
					<input class="itxt" name="name" maxlength="20" value="" type="text" placeholder="收货人姓名" />
				</div>
			</div>
			<div class="clear"></div>
			<div class="item">
				<span class="label"><em>*</em> 手机号：</span>
				<div class="fl">
					<input class="itxt" maxlength="20" name="mobile" value="" type="text" placeholder="收货人手机号码"/>
				</div>
			</div>
			<div class="clear"></div>
			<div class="item">
				<span class="label"><em>*</em> 详细地址：</span>
				<div class="fl">
					<textarea style="width:490px; height:70px; border:1px solid #ccc; padding:5px;" placeholder="建议您如实填写详细收货地址，例如街道名称，门牌号码，楼层和房间号等信息" name="address"></textarea>
				</div>
			</div>
			<div class="clear"></div>
			<div class="item">
				<span class="label"><em>*</em> 小区/大厦：</span>
				<div class="fl">
					<div id="distpicker">
						<div class="form-group">
							<div style="position: relative;">
								<input class="itxt" maxlength="20" name="village" type="text" placeholder="收货人所在小区/大厦"/>
							</div>
						</div>
					</div>
				</div>
			</div>
			<input type="hidden" name="id">
			<div class="clear"></div>
			<div class="item">
				<span class="label"><em></em></span>
				<div class="left">
					<input type="checkbox" class="i-chk" name="isDefault">
					<label>设置为默认收货地址</label>
				</div>
			</div>
			<div class="clear"></div>
			<div class="item">
				<span class="label">&nbsp;</span>
				<div class="info-c">
					<a class="btn_red subAddress" href="javascript:saveAddress();">保存</a>
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
									<th>小区/大厦</th>
									<th>详细地址</th>
									<th>联系方式</th>
									<th>操作</th>
									<th></th>
								</tr>
								@foreach($addresslist as $address)
								<tr class="tr_{{$address['id']}}">
									<td class="name">{{$address['name']}}</td>
									<td class="village">{{{$address['village'] or ''}}}</td>
									<td class="address">{{$address['address']}}</td>
									<td class="mobile">{{$address['mobile']}}</td>
									<td><a href="javascript:editAddress({{$address['id']}});">修改 </a>|<a href="javascript:delAddress({{$address['id']}});"> 删除</a></td>
									<input type="hidden" class="isDefault" value="{{$address['isDefault']}}">
									<td class="thead-tbl-status">
									@if($address['isDefault'])
									<span class="note">默认地址</span>
									@else
									<a class="note-implicit"href="javascript:defaddrAddress({{$address['id']}});">设为默认</a>
									@endif
									</td>
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
<script type="text/javascript">
	function dataAddress(){
		var name = $("input[name='name']").val();
		var mobile = $("input[name='mobile']").val();
		var village = $("input[name='village']").val();
		var address = $("textarea[name='address']").val();
		var isDefault = $("input[name='isDefault']").is(':checked');
		var params = {'name':name,'mobile':mobile,'village':village,'address':address,'isDefault':isDefault};
		return params;
	}
	function saveAddress(){
		$.post("{{url('user/address')}}",dataAddress(),function(result){
			if(result.result == CODE_NETWORK_ERROR){
				layer.msg(result.message);
			}else{
				layer.msg('添加成功');
				window.location.reload();
			}
		});
	}
	function updateAddress(id){
		$.ajax({
		    url: "{{url('user/address')}}/"+id,
		    type: 'PUT',
		    data: dataAddress(),
		    success: function(result)
		    {
		    	layer.msg(result.message);
                if(result.result == CODE_SUCCESS){
                	window.location.reload();
				}
            }
		});
	}
	function delAddress(id){
		$.ajax({
		    url: "{{url('user/address')}}/"+id,
		    type: 'DELETE',
		    success: function(result)
		    {
		    	layer.msg(result.message);
                if(result.result == CODE_SUCCESS){
                	window.location.reload();
				}
            }
		});
	}
	function defaddrAddress(id){
		$.post("{{url('user/address/defaddr')}}/"+id,function(result){
			layer.msg(result.message);
            if(result.result == CODE_SUCCESS){
            	window.location.reload();
			}
		});
	}
	function editAddress(id){
		$("input[name='name']").val($.trim($('.tr_'+id+' .name').text()));
		$("input[name='mobile']").val($.trim($('.tr_'+id+' .mobile').text()));
		$("input[name='village']").val($.trim($('.tr_'+id+' .village').text()));
		$("textarea[name='address']").val($.trim($('.tr_'+id+' .address').text()));
		$("input[name='isDefault']").prop("checked",$('.tr_'+id+' .isDefault').val());
		$("input[name='id']").val(id);
		$('.subAddress').attr('href',"javascript:updateAddress("+id+");");
	}
</script>
@endsection