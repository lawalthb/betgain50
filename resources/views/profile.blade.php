<div id="userImage" class="dropdown flex-shrink-0" x-data="dropdown" @click.outside="open = false">
    <a href="javascript:;" class="relative group" @click="toggle()">
        <span><img class="w-9 h-9 rounded-full object-cover saturate-50 group-hover:saturate-100" src="/assets/images/user-profile.jpeg" alt="image" /></span>
    </a>
    <ul x-cloak x-show="open" x-transition x-transition.duration.300ms class="ltr:right-0 rtl:left-0 text-dark dark:text-white-dark top-11 !py-0 w-[230px] font-semibold dark:text-white-light/90">
        <li>
            <div class="flex items-center px-4 py-4">
                <div class="flex-none">
                    <img class="rounded-md w-10 h-10 object-cover" src="/assets/images/user-profile.jpeg" alt="image" />
                </div>
                <div class="ltr:pl-4 rtl:pr-4">
                    <h4 class="text-base show_user_name">Username<span class="text-xs bg-success-light rounded text-success px-1 ltr:ml-2 rtl:ml-2">o</span>
                    </h4>
                    <a class="text-black/60 user_email  hover:text-primary dark:text-dark-light/60 dark:hover:text-white" href="javascript:;">email</a>
                </div>
            </div>
        </li>
        <li>
            <a href="#" id="openProfile" class="dark:hover:text-white" @click="toggle">
                <svg class="w-4.5 h-4.5 ltr:mr-2 rtl:ml-2" width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="12" cy="6" r="4" stroke="currentColor" stroke-width="1.5" />
                    <path opacity="0.5" d="M20 17.5C20 19.9853 20 22 12 22C4 22 4 19.9853 4 17.5C4 15.0147 7.58172 13 12 13C16.4183 13 20 15.0147 20 17.5Z" stroke="currentColor" stroke-width="1.5" />
                </svg>
                Profile</a>
        </li>
        <!-- <li>
            <a href="/apps/mailbox" class="dark:hover:text-white" @click="toggle">
                <svg class="w-4.5 h-4.5 ltr:mr-2 rtl:ml-2" width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.5" d="M2 12C2 8.22876 2 6.34315 3.17157 5.17157C4.34315 4 6.22876 4 10 4H14C17.7712 4 19.6569 4 20.8284 5.17157C22 6.34315 22 8.22876 22 12C22 15.7712 22 17.6569 20.8284 18.8284C19.6569 20 17.7712 20 14 20H10C6.22876 20 4.34315 20 3.17157 18.8284C2 17.6569 2 15.7712 2 12Z" stroke="currentColor" stroke-width="1.5" />
                    <path d="M6 8L8.1589 9.79908C9.99553 11.3296 10.9139 12.0949 12 12.0949C13.0861 12.0949 14.0045 11.3296 15.8411 9.79908L18 8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                </svg>
                Inbox</a>
        </li> -->

        <li class="border-t border-white-light dark:border-white-light/10">
            <a href="javascript:;" id="sign_out2" onclick="signout();" class=" text-danger !py-3" @click="toggle">
                <svg class="w-4.5 h-4.5 ltr:mr-2 rtl:ml-2 rotate-90" width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.5" d="M17 9.00195C19.175 9.01406 20.3529 9.11051 21.1213 9.8789C22 10.7576 22 12.1718 22 15.0002V16.0002C22 18.8286 22 20.2429 21.1213 21.1215C20.2426 22.0002 18.8284 22.0002 16 22.0002H8C5.17157 22.0002 3.75736 22.0002 2.87868 21.1215C2 20.2429 2 18.8286 2 16.0002L2 15.0002C2 12.1718 2 10.7576 2.87868 9.87889C3.64706 9.11051 4.82497 9.01406 7 9.00195" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                    <path d="M12 15L12 2M12 2L15 5.5M12 2L9 5.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                Sign Out
            </a>
        </li>
    </ul>
</div>
</div>
</div>


</div>

<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
<script>
    async function signout() {
        //alert('sign out');
        // alert(localStorage.getItem('user_token'));

        $.ajax({
            url: "/api/auth/logout",
            type: "GET",
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('user_token')
            },
            success: function(data) {
                if (data.status == true) {
                    //alert(data.message);
                    signoutAlert();
                    var token = "";
                    var user_role = "";
                    var username = "";
                    var user_phone = "";
                    var user_email = "";
                    var user_id = "";
                    $('#play').hide();
                    $("#userImage").hide();
                    $('#login').show();
                    $('#login_modal').show();
                    $("#faq").hide();
                    $("#referral").hide();
                    $("#wallet").hide();
                    $("#play").hide();
                    $('#depositBtn').prop('disabled', true);
                    $('#withdrawBtn').prop('disabled', true);
                    $('#user_wallet_bal').text('xxx');
                    localStorage.removeItem('user_token');
                    localStorage.removeItem('user_id');
                    localStorage.removeItem('user_role');
                    localStorage.removeItem('username');
                    localStorage.removeItem('user_phone');
                    localStorage.removeItem('user_email');
                    $("#gt").val(0);
                    localStorage.removeItem('user_wallet_bal');
                    document.cookie = "loginToken=" + token + "; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                    document.cookie = "username=" + username + "; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                    document.cookie = "user_phone=" + user_phone + "; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                    document.cookie = "user_email=" + user_email + "; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                    document.cookie = "user_id=" + user_id + "; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                    document.cookie = "user_role=" + user_role + "; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                    var pageURL = window.location.href;
                    var serverURL = `{{url('/admin')}}`;
                    if (pageURL == serverURL) {
                        window.open("/", "_self");
                    }
                    //document.cookie = "user_role"=0; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                    // window.open("/","_self");
                } else {
                    alert(data.message)
                }
            }

        });
        //console.log(data);
    };
</script>
<script>
    async function signoutAlert() {
        const toast = window.Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000,
            padding: '2em',
            customClass: 'sweet-alerts',
        });
        toast.fire({
            icon: 'success',
            title: 'Signed Out  successfully',
            padding: '2em',
            customClass: 'sweet-alerts',
        });
    }
</script>