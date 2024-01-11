<!-- This file is used to store topbar (left) items -->

<li class="nav-item px-3"><a class="nav-link" href="#">Hi, {{ ucwords(auth()->user()->name) }}!</a></li>
{{-- <li class="nav-item px-3"><a class="nav-link" href="#">Users</a></li> --}}
{{-- <li class="nav-item px-3"><a class="nav-link" href="#">Settings</a></li> --}}

@impersonating($guard = null)
    <a href="{{ backpack_url('impersonate/leave') }}">Leave impersonation</a>
@endImpersonating
