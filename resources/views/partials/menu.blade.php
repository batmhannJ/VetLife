<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">{{ trans('panel.site_title') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route("admin.home") }}" class="nav-link">
                        <p>
                            <i class="fas fa-fw fa-tachometer-alt">

                            </i>
                            <span>{{ trans('global.dashboard') }}</span>
                        </p>
                    </a>
                </li>
                @can('user_management_access')
                    <li class="nav-item has-treeview {{ request()->is('admin/permissions*') ? 'menu-open' : '' }} {{ request()->is('admin/roles*') ? 'menu-open' : '' }} {{ request()->is('admin/users*') ? 'menu-open' : '' }} {{ request()->is('admin/audit-logs*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw fas fa-users">

                            </i>
                            <p>
                                <span>{{ trans('cruds.userManagement.title') }}</span>
                                <i class="right fa fa-fw fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('permission_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-unlock-alt">

                                        </i>
                                        <p>
                                            <span>{{ trans('cruds.permission.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-briefcase">

                                        </i>
                                        <p>
                                            <span>{{ trans('cruds.role.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('user_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-user">

                                        </i>
                                        <p>
                                            <span>{{ trans('cruds.user.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('audit_log_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.audit-logs.index") }}" class="nav-link {{ request()->is('admin/audit-logs') || request()->is('admin/audit-logs/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-file-alt">

                                        </i>
                                        <p>
                                            <span>{{ trans('cruds.auditLog.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('patient_management_access')
                    <li class="nav-item has-treeview {{ request()->is('admin/patients*') ? 'menu-open' : '' }} {{ request()->is('admin/tests*') ? 'menu-open' : '' }} {{ request()->is('admin/prescriptions*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw fas fa-user-alt">

                            </i>
                            <p>
                                <span>{{ trans('cruds.patientManagement.title') }}</span>
                                <i class="right fa fa-fw fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('patient_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.patients.index") }}" class="nav-link {{ request()->is('admin/patients') || request()->is('admin/patients/*') ? 'active' : '' }}">
                                        <i class="fa-fw far fa-user">

                                        </i>
                                        <p>
                                            <span>{{ trans('cruds.patient.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('test_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.tests.index") }}" class="nav-link {{ request()->is('admin/tests') || request()->is('admin/tests/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-medkit">

                                        </i>
                                        <p>
                                            <span>{{ trans('cruds.test.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('prescription_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.prescriptions.index") }}" class="nav-link {{ request()->is('admin/prescriptions') || request()->is('admin/prescriptions/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-file-prescription">

                                        </i>
                                        <p>
                                            <span>{{ trans('cruds.prescription.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('stock_management_access')
                    <li class="nav-item has-treeview {{ request()->is('admin/medicines*') ? 'menu-open' : '' }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw fas fa-pills">

                            </i>
                            <p>
                                <span>{{ trans('cruds.stockManagement.title') }}</span>
                                <i class="right fa fa-fw fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('medicine_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.medicines.index") }}" class="nav-link {{ request()->is('admin/medicines') || request()->is('admin/medicines/*') ? 'active' : '' }}">
                                        <i class="fa-fw fas fa-hospital-alt">

                                        </i>
                                        <p>
                                            <span>{{ trans('cruds.medicine.title') }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        <p>
                            <i class="fas fa-fw fa-sign-out-alt">

                            </i>
                            <span>{{ trans('global.logout') }}</span>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>