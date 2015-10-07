<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>

      <li class="treeview">
        <a href="/dashboard/account">
          <i class="fa fa-user"></i> <span>Account</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          @if(\Auth::user()->isOwner())
            <li><a href="/dashowner/admins">Manage Users</a></li>
          @endif
          <!-- <li><a href="#">Default Configuration</a></li> -->
          <!-- <li><a href="#">Manage Customers</a></li> -->
          <li><a href="/dashboard/account">Account Owner Details</a></li>
          <!-- <li><a href="#">Payment Information</a></li> -->
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-briefcase"></i> <span>Businesses</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          @if(\Auth::user()->isOwner())
            <li><a href="/dashowner/business">Manage Businesses</a></li>
          @elseif(\Auth::user()->isAdmin())
            <li><a href="/dashadmin/business">Manage Businesses</a></li>
          @endif
        </ul>
      <li  class="treeview">
        <a href="#">
          <i class="fa fa-bar-chart"></i> <span>Reports</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="/reports">Basic Reports</a></li>
        </ul>
      </li>

      <!-- <li  class="treeview">
        <a href="/dashboard/help">
          <i class="fa fa-question-circle"></i> <span>Help</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="#">Setup Guide</a></li>
          <li><a href="#">User Guide</a></li>
          <li><a href="#">Getting Started Videos</a></li>
        </ul>
      </li> -->

      <li>
        <a href="/auth/logout">
          <i class="fa fa-sign-out"></i> <span>Logout</span>
        </a>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
