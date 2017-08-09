@inject('menuPresenter','App\Presenters\Admin\MenuPresenter')
<nav class="navbar-default navbar-static-side" role="navigation">
  <div class="sidebar-collapse">
    <ul class="nav metismenu" id="side-menu">
      <li class="nav-header">
          <div class="dropdown profile-element"> <span>
                  <img alt="image" class="img-circle" src="{{asset('admin/img/profile_small.jpg')}}" />
                   </span>
              <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                  <span class="clear"> <span class="block m-t-xs"><strong class="font-bold"></strong>
                   </span> <span class="text-muted text-xs block"> {{getUser()->name}}  <b class="caret"></b></span> </span> </a>
              <ul class="dropdown-menu animated fadeInRight m-t-xs">
              <!--
                  <li><a href="profile.html">个人资料</a></li>
                  <li class="divider"></li>
              -->
                  <li><a href="{{ url('admin/logout') }}">退出</a></li>
              </ul>
          </div>
          <div class="logo-element">
              ID
          </div>
      </li>
      {!!$menuPresenter->sidebarMenuList($sidebarMenu)!!}
    </ul>
  </div>
</nav>