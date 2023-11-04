<header :class="{ 'dark': $store.app.semidark && $store.app.menu === 'horizontal' }">


        @include('logoname')
        @if(Auth::guard('admin')->check())
        <a href="{{route('adminLogout')}}">LogOut</a> | &nbsp;&nbsp;
        <a href="{{route('admin_edit_profile', ['id' =>auth('admin')->id() ])}}">My Profile</a> | &nbsp;&nbsp;
        <a href="{{route('manage_admins')}}">Manage Admins</a>
        @endif
        @include('faq')

        @include('wallet')

        @include('referral')



        @include('screenmode')

        @include('profile')


</header>