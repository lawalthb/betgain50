<!-- login -->
<button type="button" onclick="login_modal()" id="login" class="btn btn-danger">Login To Play</button>

<div id="login_modal" class="modal">
    <!-- button -->

    <!-- modal -->
    <div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto" :class="open && '!block'" id="loginModal">
        <div class="flex items-start justify-center min-h-screen px-4" @click.self="open = false">
            <div x-show="open" x-transition x-transition.duration.300 class="panel border-0 py-1 px-4 rounded-lg overflow-hidden w-full max-w-sm my-8">
                <div class="flex items-center justify-between p-5 font-semibold text-lg dark:text-white" id="login_title">Login
                    <span class="flex-right cursor-pointer hover:text-danger" id="close_login">X</span>
                </div>
                <div class="p-5 mb-4">
                    <form method="POST" id="signin_form" role="form">
                        {{csrf_field()}}

                        <div class="relative mb-4">

                            <input type="text" id="forgot_email" placeholder="Email or Username" name="email" required class="form-input ltr:pl-10 rtl:pr-10" />
                        </div>
                        <div class="relative mb-4">

                            <input type="password" id="forgot_password_text" name="password" required placeholder="Password" class="form-input ltr:pl-10 rtl:pr-10" />
                        </div>
                        <!-- <button type="button" class="btn btn-primary w-full">Login</button> -->
                        <input type="submit" id="login_button" class="btn btn-primary w-full" style="cursor: pointer" value="Login">

                    </form>



                    <form method="POST" id="forget_form" role="form" style=" display:none">
                        {{csrf_field()}}

                        <div class="relative mb-4">

                            <input type="text" id="forgot_email" placeholder="Email or Username" name="email" required class="form-input ltr:pl-10 rtl:pr-10" />
                        </div>


                        <input type="submit" id="forgot_button" class="btn btn-primary w-full" style="cursor: pointer" value="Submit Email">
                    </form>
                    <span class="float-right mt-3 cursor-pointer hover:text-primary" id="forgotPasswordLink">Forgot Password</span>
                </div>

                <div class="p-5 border-t border-[#ebe9f1] dark:border-white/10 hover:text-white">
                    @include('register')
                    <!-- <p class="text-center text-white-dark dark:text-white-dark/70">Looking to <a href="javascript:;" id="loginLink" class="text-[#515365] hover:underline dark:text-white-dark">create an account?</a></p> -->
                    </footer>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    async function login_modal() {
        $("#login_modal").css("display", "block");
    }
    $(document).ready(function() {

        // $("#login").click(function (event) {
        //     $("#login_modal").css("display", "block");

        // })

        $("#close_login").click(function(event) {
            $("#login_modal").css("display", "none");

        });

        document.getElementById("signin_form").addEventListener("submit", async function(event) {
            event.preventDefault();

            const formData = new FormData(event.target);

            try {
                const response = await fetch("{{ route('api-login')}}", {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                if (response.ok) {
                    const responseData = await response.json();
                    console.log(responseData.message);
                    login_successful_alert(responseData.message);
                    // showAlert()
                    var token = responseData.token;
                    var user_role = responseData.user.user_role;
                    let cookies_date = new Date(Date.now() + 3);
                    cookies_date = cookies_date.toUTCString();

                    localStorage.setItem("user_token", responseData.token);
                    localStorage.setItem("user_id", responseData.user.id);
                    localStorage.setItem("username", responseData.user.username);
                    localStorage.setItem("user_email", responseData.user.email);
                    localStorage.setItem("user_phone", responseData.user.phone_number);
                    localStorage.setItem("user_role", responseData.user.user_role);
                    document.cookie = "loginToken=" + token + "; cookies_date";
                    document.cookie = "username=" + responseData.user.username + "; cookies_date";
                    document.cookie = "user_role =" + responseData.user.user_role + "; cookies_date";

                    document.cookie = "user_email=" + responseData.user.email + "; cookies_date";
                    document.cookie = "user_phone =" + responseData.user.phone_number + "; cookies_date";
                    load_user_previous()
                    load_user_balance();
                    load_user_bonus();
                    $("#play").show();
                    $("#login").hide();
                    $("#login_modal").hide();
                    $("#userImage").show();
                    $("#show_user_name2").text(responseData.user.username);
                    $(".show_user_name3").text(responseData.user.username);
                    $(".user_email").text(responseData.user.email);
                    $("#upadate_email").val(responseData.user.email);
                    $("#upadate_username").val(responseData.user.username);
                    $("#upadate_phone_number").val(responseData.user.phone_number);
                    $("#upadate_user_id").val(responseData.user.id);
                    $("#faq").show();
                    $("#referral").show();
                    $("#wallet").show();
                    $('#depositBtn').prop('disabled', false);
                    $('#withdrawBtn').prop('disabled', false);
                    var pageURL = window.location.href;
                    var serverURL = `{{url('/')}}`;
                    //alert(serverURL)
                    if (pageURL != serverURL && user_role == "admin") {
                        window.open("/admin", "_self");
                    }

                } else if (response.status === 422) {
                    const errors = await response.json();

                    login_failed_alert(errors.message);
                    console.log("Validation errors:", errors.message);
                }
            } catch (error) {
                console.error('Error:', error);
            }
        });



    });
</script>

<script>
    async function login_successful_alert(msg) {
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
            title: msg,
            padding: '2em',
            customClass: 'sweet-alerts',
        });
    }

    async function login_failed_alert(msg) {

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
            title: msg,
            padding: '2em',
            customClass: 'sweet-alerts',
        });
    }
</script>
<script>
    $("#forgotPasswordLink").click(function(event) {
        const forgot_email = document.getElementById('forgot_email');
        $("#forgot_email").val("");
        $('#forgot_email').attr('placeholder', 'Enter Email');

        $("#login_title").text("Forgot Password");

        $("#signin_form").css("display", "none");
        $("#forget_form").css("display", "block");


    });
</script>

<script>
    document.getElementById("forget_form").addEventListener("submit", async function(event) {
        event.preventDefault();
        const formData = new FormData(event.target);


        $('#forgot_button').prop('disabled', true);
        try {
            const response = await fetch("{{ route('forgot_password') }}", {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            if (response.ok) {
                const responseData = await response.json();
                console.log(responseData.message);
                login_successful_alert(responseData.message);
                // showAlert()


            } else if (response.status === 422) {
                const errors = await response.json();

                login_failed_alert(errors.message);
                console.log("Validation errors:", errors.message);
                $('#forgot_button').prop('disabled', false);
            }
        } catch (error) {
            console.error('Error:', error);
        }
    })
</script>