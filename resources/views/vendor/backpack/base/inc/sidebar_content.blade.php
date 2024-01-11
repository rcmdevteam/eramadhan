@role('Pendakwah')
<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<strong class="nav-item text-dark"><small class="ml-2 font-weight-bold">DAKWAH</small></strong>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
<li class='nav-item'><a class='nav-link' href='#''><i class='nav-icon la la-bar-chart'></i> Earnings</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('profiles') }}'><i class='nav-icon la la-briefcase'></i> My Profiles</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('profile-category') }}'><i class='nav-icon la la-pencil'></i> My Categories</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('profile-topics') }}'><i class='nav-icon la la-box-open'></i> Topics Cover</a></li>

<strong class="nav-item text-dark mt-2"><small class="ml-2 font-weight-bold">SPACE</small></strong>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('orders') }}'><i class='nav-icon la la-inbox'></i> Request <span class="badge badge-pill badge-primary">8</span></a></li>
{{-- <li class='nav-item'><a class='nav-link' href='{{ backpack_url('order-details') }}'><i class='nav-icon la la-question'></i> Order details</a></li> --}}
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('profile-sponsors') }}'><i class='nav-icon la la-coins'></i> My Sponsors <span class="badge badge-pill badge-primary">29</span></a></li>
@endrole

@role('Superadmin')
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
<strong class="nav-item text-dark mt-2"><small class="ml-2 font-weight-bold">SUPERADMIN</small></strong>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('categories') }}'><i class='nav-icon la la-box'></i> Categories</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('topics') }}'><i class='nav-icon la la-th-large'></i> Topics</a></li>
<!-- Users, Roles, Permissions -->
<li class="nav-item nav-dropdown">
	<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-group"></i> Authentication</a>
	<ul class="nav-dropdown-items">
	  <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i> <span>Users</span></a></li>
	  <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-user-tag"></i> <span>Roles</span></a></li>
	  <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i class="nav-icon la la-key"></i> <span>Permissions</span></a></li>
	</ul>
</li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('menu-item') }}'><i class='nav-icon la la-list'></i> <span>Menu</span></a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('setting') }}'><i class='nav-icon la la-cog'></i> <span>Settings</span></a></li>

<strong class="nav-item text-dark mt-2"><small class="ml-2 font-weight-bold">DEVELOPER</small></strong>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('log') }}'><i class='nav-icon la la-terminal'></i> Logs</a></li>
@endrole