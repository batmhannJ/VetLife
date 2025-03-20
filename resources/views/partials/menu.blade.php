<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <div style="text-align: center;">
    <a href="{{ route('admin.home') }}">
        <img src="{{ asset('images/logo.png') }}" alt="CLSU-VETLIFE Logo" style="max-width: 200px; height:50px; padding-top: 10px;">
    </a>
</div>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('admin.home') }}" class="nav-link">
                        <p>
                            <i class="fas fa-fw fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </p>
                    </a>
                </li>

                <!-- Doctor Section -->
                <li class="nav-item has-treeview">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-user-md"></i>
                        <p>
                            <span>Doctor</span>
                            <i class="right fa fa-fw fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="padding-left: 20px; margin-left: 10px; border-left: 1px solid rgba(255,255,255,0.1);">
                        <li class="nav-item">
                            <a href="{{ route('admin.doctors.create') }}" class="nav-link">
                                <i class="fa-fw fas fa-plus"></i>
                                <p>Create Doctor</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.doctors.index') }}" class="nav-link">
                                <i class="fa-fw fas fa-list"></i>
                                <p>Doctor List</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Patient Section -->
                <li class="nav-item has-treeview">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-user-alt"></i>
                        <p>
                            <span>Patient</span>
                            <i class="right fa fa-fw fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="padding-left: 20px; margin-left: 10px; border-left: 1px solid rgba(255,255,255,0.1);">
                        <li class="nav-item">
                            <a href="{{ route('admin.patients.create') }}" class="nav-link">
                                <i class="fa-fw fas fa-plus"></i>
                                <p>Add New Patient</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.patients.index') }}" class="nav-link">
                                <i class="fa-fw fas fa-list"></i>
                                <p>Patient List</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Appointment Section -->
                <li class="nav-item has-treeview">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-calendar-check"></i>
                        <p>
                            <span>Appointment</span>
                            <i class="right fa fa-fw fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="padding-left: 20px; margin-left: 10px; border-left: 1px solid rgba(255,255,255,0.1);">
                        <li class="nav-item">
                            <a href="{{ route('admin.appointments.requests') }}" class="nav-link">
                                <i class="fa-fw fas fa-clock"></i>
                                <p>Appointment Request</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Prescription Section -->
                <li class="nav-item">
                    <a href="{{ route('admin.prescriptions.index') }}" class="nav-link">
                        <i class="fa-fw fas fa-file-prescription"></i>
                        <p>Prescription</p>
                    </a>
                </li>

                <!-- Payment Section -->
                <li class="nav-item has-treeview">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-money-bill"></i>
                        <p>
                            <span>Payment</span>
                            <i class="right fa fa-fw fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="padding-left: 20px; margin-left: 10px; border-left: 1px solid rgba(255,255,255,0.1);">
                        <li class="nav-item">
                            <a href="{{ route('admin.payments.setup') }}" class="nav-link">
                                <i class="fa-fw fas fa-cog"></i>
                                <p>Payment Setup</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.payments.index') }}" class="nav-link">
                                <i class="fa-fw fas fa-list"></i>
                                <p>Payment List</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Setup Data Section -->
                <li class="nav-item has-treeview">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-database"></i>
                        <p>
                            <span>Setup Data</span>
                            <i class="right fa fa-fw fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="padding-left: 20px; margin-left: 10px; border-left: 1px solid rgba(255,255,255,0.1);">
                        <li class="nav-item">
                            <a href="{{ route('admin.medicines.create') }}" class="nav-link">
                                <i class="fa-fw fas fa-plus"></i>
                                <p>Add Medicine</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.medicines.index') }}" class="nav-link">
                                <i class="fa-fw fas fa-list"></i>
                                <p>Medicine List</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Gateway Side -->
                <li class="nav-item">
                    <a href="{{ route('admin.gateway.index') }}" class="nav-link">
                        <i class="fa-fw fas fa-network-wired"></i>
                        <p>Gateway Side</p>
                    </a>
                </li>

                <!-- Schedule Section -->
                <li class="nav-item has-treeview">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-calendar-alt"></i>
                        <p>
                            <span>Schedule</span>
                            <i class="right fa fa-fw fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="padding-left: 20px; margin-left: 10px; border-left: 1px solid rgba(255,255,255,0.1);">
                        <li class="nav-item">
                            <a href="{{ route('admin.schedules.settings') }}" class="nav-link">
                                <i class="fa-fw fas fa-cog"></i>
                                <p>Clinic Schedule Settings</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Category -->
                <li class="nav-item">
                    <a href="{{ route('admin.categories.index') }}" class="nav-link">
                        <i class="fa-fw fas fa-th-list"></i>
                        <p>Category</p>
                    </a>
                </li>

                <!-- Service List -->
                <li class="nav-item">
                    <a href="{{ route('admin.services.index') }}" class="nav-link">
                        <i class="fa-fw fas fa-concierge-bell"></i>
                        <p>Service List</p>
                    </a>
                </li>

                <!-- Logout -->
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        <p>
                            <i class="fas fa-fw fa-sign-out-alt"></i>
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