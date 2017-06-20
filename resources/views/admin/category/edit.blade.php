@inject('categoryPresenter','App\Presenters\Admin\CategoryPresenter')
<div class="ibox float-e-margins animated bounceIn formBox" id="editBox">
  <div class="ibox-title">
    <h5>{{trans('admin/category.edit')}}</h5>
    <div class="ibox-tools">
      <a class="close-link">
        <i class="fa fa-times"></i>
      </a>
    </div>
  </div>
  <div class="ibox-content">
    <form method="post" action="{{url('admin/category',[$category->id])}}" class="form-horizontal" id="editForm">
      {!!csrf_field()!!}
      {{method_field('PUT')}}
      <div class="row">
        <div class="tabs-container">
          <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true"> 基本信息</a>
            </li>
            <li class=""><a data-toggle="tab" href="#tab-2" aria-expanded="false"> 分类内容</a>
            </li>
          </ul>
          <div class="tab-content">
            <div id="tab-1" class="tab-pane active">
              <div class="panel-body">
                <input type="hidden" name="id" value="{{$category->id}}">
                <div class="form-group">
                  <label class="col-sm-2 control-label">{{trans('admin/category.model.name')}}</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="{{trans('admin/category.model.name')}}" name="name" value="{{$category->name}}">
                  </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">{{trans('admin/category.model.pid')}}</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="pid">
                      {!!$categoryPresenter->topMenuList($categories,$category->pid)!!}
                    </select>
                  </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">{{trans('admin/category.model.url')}}</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="{{trans('admin/category.model.url')}}" name="url" value="{{$category->url}}">
                  </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">{{trans('admin/category.model.icon')}}</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="{{trans('admin/category.model.icon')}}" name="icon" value="{{$category->icon}}">
                    <span class="help-block m-b-none">{!!trans('admin/category.moreIcon')!!}</span>
                  </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">{{trans('admin/category.model.sort')}}</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="{{trans('admin/category.model.sort')}}" name="sort" value="{{$category->sort}}">
                  </div>
                </div>
              </div>
            </div>
            <div id="tab-2" class="tab-pane">
              <div class="panel-body">
                <div class="col-sm-12">
                  <input type="hidden" name="content_html">
                  <div id="editor">{{$category->content_html}}</div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
          <div class="col-sm-4 col-sm-offset-2">
            <a class="btn btn-white close-link">{!!trans('admin/action.actionButton.close')!!}</a>
            <button class="btn btn-primary editButton ladda-button"  data-style="zoom-in">{!!trans('admin/action.actionButton.submit')!!}</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
<script type="text/javascript">
  $(function () {
    $('#editor').summernote({
      height: 400,
      lang : 'zh-CN',
      callbacks:{
        onSubmit:$("input[name='content_html']").val($('#editor').summernote('code')),
        onImageUpload: function(files) {
          var data=new FormData();
          data.append('editormd-image-file',files[0]);
          $.ajax({
            url: '/admin/article/upload',
            method: 'POST',
            data:data,
            processData: false,
            contentType: false,
            success: function(data) {
              if (data['success']=='1') {
                $("#editor").summernote('insertImage',data['url']);
              }
              else{
                alert(data['message']);
              }
            }
          });
        }
      }
    });
  });
</script>