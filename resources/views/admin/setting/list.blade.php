@extends('layouts.admin')
@section('css')
<link href="{{asset('vendors/jasny/jasny-bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('vendors/layui/css/layui.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2>{!!trans('admin/breadcrumb.setting.list')!!}</h2>
    <ol class="breadcrumb">
      <li>
        <a href="{{url('admin/dash')}}">{!!trans('admin/breadcrumb.home')!!}</a>
      </li>
      <li class="active">
        <strong>{!!trans('admin/breadcrumb.setting.list')!!}</strong>
      </li>
    </ol>
  </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>{!!trans('admin/breadcrumb.setting.list')!!}</h5>
          <div class="ibox-tools">
            <a class="collapse-link">
              <i class="fa fa-chevron-up"></i>
            </a>
            <a class="close-link">
              <i class="fa fa-times"></i>
            </a>
          </div>
        </div>
        <div class="ibox-content">
          @include('flash::message')
          <form method="post" action="{{url('admin/setting')}}" class="form-horizontal" role="form" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group">
              <label class="col-sm-2 control-label">{{trans('admin/setting.title')}}</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="title" value="{{$setting['title']}}" placeholder="{{trans('admin/setting.title')}}">
              </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
              <label class="col-sm-2 control-label">{{trans('admin/setting.keywords')}}</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="keywords" value="{{$setting['keywords']}}" placeholder="{{trans('admin/setting.keywords')}}">
              </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
              <label class="col-sm-2 control-label">{{trans('admin/setting.description')}}</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="description" value="{{$setting['description']}}" placeholder="{{trans('admin/setting.description')}}">
              </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
              <label class="col-sm-2 control-label">{{trans('admin/setting.about_title')}}</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="about_title" value="{{$setting['about_title']}}" placeholder="{{trans('admin/setting.about_title')}}">
              </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
              <label class="col-sm-2 control-label">{{trans('admin/setting.about_en_title')}}</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="about_en_title" value="{{$setting['about_en_title']}}" placeholder="{{trans('admin/setting.about_en_title')}}">
              </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
              <label class="col-sm-2 control-label">{{trans('admin/setting.about_content')}}</label>
              <div class="col-sm-10">
                <textarea class="layui-textarea" id="about_content" name="about_content" style="display: none">{!!$setting['about_content']!!}</textarea>
              </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
              <label class="col-sm-2 control-label">{{trans('admin/setting.contact_us')}}</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="contact_us" value="{{$setting['contact_us']}}" placeholder="{{trans('admin/setting.contact_us')}}">
              </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
              <label class="col-sm-2 control-label">{{trans('admin/setting.contact_email')}}</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="contact_email" value="{{$setting['contact_email']}}" placeholder="{{trans('admin/setting.contact_email')}}">
              </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
              <label class="col-sm-2 control-label">{{trans('admin/setting.logo')}}</label>
              <div class="col-sm-10">
                <div class="fileinput fileinput-new" data-provides="fileinput">
                  <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                    <img src="{{$setting['logo'] ? $setting['logo'] : asset('admin/img/no-image.png')}}">
                  </div>
                  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                  <div>
                    <span class="btn btn-default btn-file"><span class="fileinput-new">选择图片</span><span class="fileinput-exists">更换</span><input type="file" name="logo"></span>
                    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">移除</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
              <label class="col-sm-2 control-label">{{trans('admin/setting.download_app')}}</label>
              <div class="col-sm-10">
                <div class="fileinput fileinput-new" data-provides="fileinput">
                  <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                    <img src="{{$setting['download_app'] ? $setting['download_app'] : asset('admin/img/no-image.png')}}">
                  </div>
                  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                  <div>
                    <span class="btn btn-default btn-file"><span class="fileinput-new">选择图片</span><span class="fileinput-exists">更换</span><input type="file" name="download_app"></span>
                    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">移除</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
            <label class="col-sm-2 control-label">{{trans('admin/setting.download_android')}}</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="download_android" value="{{$setting['download_android']}}" placeholder="{{trans('admin/setting.download_ios')}}">
              </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
              <label class="col-sm-2 control-label">{{trans('admin/setting.download_ios')}}</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="download_ios" value="{{$setting['download_ios']}}" placeholder="{{trans('admin/setting.download_ios')}}">
              </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
              <label class="col-sm-2 control-label">{{trans('admin/setting.copyright')}}</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="copyright" value="{{$setting['copyright']}}" placeholder="{{trans('admin/setting.copyright')}}">
              </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
              <label class="col-sm-2 control-label">{{trans('admin/setting.statistics')}}</label>
              <div class="col-sm-10">
                <textarea name="statistics" class="form-control" placeholder="{{trans('admin/setting.statistics')}}">{{$setting['statistics']}}</textarea>
              </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
              <label class="col-sm-2 control-label">{{trans('admin/setting.share')}}</label>
              <div class="col-sm-10">
                <textarea name="share" class="form-control" placeholder="{{trans('admin/setting.share')}}">{{$setting['share']}}</textarea>
              </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
              <div class="col-sm-4 col-sm-offset-2">
                <a class="btn btn-white" href="{{url()->previous()}}">{!!trans('admin/action.actionButton.cancel')!!}</a>
                <button class="btn btn-primary submit-article" type="submit">{!!trans('admin/action.actionButton.submit')!!}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('js')
<script type="text/javascript" src="{{asset('vendors/jasny/jasny-bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('vendors/layui/layui.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/setting/setting.js')}}"></script>
@endsection