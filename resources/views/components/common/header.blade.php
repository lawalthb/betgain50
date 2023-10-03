<header :class="{ 'dark': $store.app.semidark && $store.app.menu === 'horizontal' }">
       

        @include('logoname')
        @if(Auth::guard('admin')->check())
     <a href="{{route('adminLogout')}}">LogOut</a>
    @endif
        @include('faq')
       
        @include('wallet')
        
        @include('referral')
       
       
        
        @include('screenmode')

        @include('profile')


</header>

