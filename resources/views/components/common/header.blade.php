<header :class="{ 'dark': $store.app.semidark && $store.app.menu === 'horizontal' }">


        @include('logoname')
        @if(Auth::guard('admin')->check())
        <a href="{{route('adminLogout')}}">LogOut</a> | &nbsp;&nbsp;
        <a href="{{route('admin_edit_profile', ['id' =>auth('admin')->id() ])}}">My Profile ({{ auth('admin')->user()->admin_role }})</a>
        @if(auth('admin')->user()->admin_role == "superadmin" )
        | &nbsp;&nbsp;
        <a href="{{route('manage_admins')}}">Manage Admins</a>
        @endif
        @endif
        @include('faq')

        @include('wallet')

        @include('referral')



        @include('screenmode')

        @include('profile')


</header>