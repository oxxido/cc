<!-- Left side column. contains the sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          

          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>

@//if ($user->isAdmin)

            <li class="treeview">
              <a href="/dashboard/account">
                <i class="fa fa-user"></i> <span>Settings</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="#">Online Review Links</a></li>
                <li><a href="#">Email Templates</a></li>
                <li><a href="#">Feedback Settings</a></li>
                <li><a href="#">Testimonials Widget</a></li>
                <li><a href="#">Notification Settings</a></li>
                <li><a href="#">Kiosk Mode</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="/dashboard/account">
                <i class="fa fa-user"></i> <span>Account</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="/dashboard/manageUsers">Manage Users</a></li>
                <li><a href="#">Account Owner Details</a></li>
                <li><a href="#">Payment Information</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="/dashboard/business">
                <i class="fa fa-briefcase"></i> <span>Businesses</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="#">Manage Businesses</a></li>
              </ul>
            </li>
            <li  class="treeview">
              <a href="/dashboard/reports">
                <i class="fa fa-bar-chart"></i> <span>Reports</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              <li><a href="#">Performance Report</a></li>
              <li><a href="#">Online Review Monitor</a></li>
                <li><a href="#">Customer Level Reporting</a></li>
              </ul>
            </li>
            <li  class="treeview">
              <a href="/dashboard/help">
                <i class="fa fa-question-circle"></i> <span>Help</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="#">Setup Guide</a></li>
                <li><a href="#">User Guide</a></li>
                <li><a href="#">Getting Started Videos</a></li>
              </ul>
            </li>
            <li>
              <a href="/auth/logout">
                <i class="fa fa-sign-out"></i> <span>Logout</span>
              </a>
            </li>
@//else
<!--
            <li class="treeview">
              <a href="/dashboard/account">
                <i class="fa fa-user"></i> <span>Account</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="#">Default Configuration</a></li>
                <li><a href="#">Manage Customers</a></li>
                <li><a href="#">Account Owner Details</a></li>
                <li><a href="#">Payment Information</a></li>
              </ul>
            </li>
            <li  class="treeview">
              <a href="/dashboard/reports">
                <i class="fa fa-bar-chart"></i> <span>Reports</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="#">Business Level Reporting</a></li>
              </ul>
            </li>
            <li  class="treeview">
              <a href="/dashboard/help">
                <i class="fa fa-question-circle"></i> <span>Help</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="#">Setup Guide</a></li>
                <li><a href="#">User Guide</a></li>
                <li><a href="#">Getting Started Videos</a></li>
              </ul>
            </li>
            <li>
              <a href="/auth/logout">
                <i class="fa fa-sign-out"></i> <span>Logout</span>
              </a>
            </li>
            <!-- 
            <li class="header">LABELS</li>
            <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
            -->
@//endif
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
