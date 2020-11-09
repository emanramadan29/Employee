<!-- Left side column. contains the sidebar -->
@if(Auth::check())
<aside class="main-sidebar" style="background-color: #0e2624">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar"  >

      <ul class="sidebar-menu">
          @can('view_roles')
              <li class="@yield('roles')"><a href="/admin/roles">
                      <i class="fa fa-key"></i> @lang('lang.roles')</a>
              </li>
          @endcan
              @can('view_users')
                  <li class="@yield('admins')"><a href="/admin/users">
                          <i class="fa fa-users"></i> @lang('lang.admins')</a>
                  </li>
              @endcan

              @can('view_employees')
                  <li class="@yield('employees')"><a href="/admin/employee">
                          <i class="fa fa-user-circle"></i> @lang('lang.employees')</a>
                  </li>
              @endcan
      </ul>



  </section>
</aside>
@endif
