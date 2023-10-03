<!-- Register -->
<div x-data="modal" id=remove-register-modal>
    <!-- <button type="button" class="btn btn-danger" @click="toggle">register</button> -->
    <p @click="toggle" class="cursor-pointer">Click here to register</p>
    <div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto" :class="open && '!block'">
        <div class="flex items-start justify-center min-h-screen px-4" @click.self="open = false">
            <div x-show="open" x-transition x-transition.duration.300 class="panel border-0 py-1 px-4 rounded-lg overflow-hidden w-full max-w-sm my-8">
                <div class="flex items-center justify-between p-5 font-semibold text-lg dark:text-white">
                    Register
                    <button type="button" @click="toggle" class="text-white-dark hover:text-danger">

                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>

                </div>
                <div class="p-5">
                    <form id="signup_form">
                        {{csrf_field()}}
                        <div class="relative mb-4">
                            <span class="absolute ltr:left-3 rtl:right-3 top-1/2 -translate-y-1/2 dark:text-white-dark">

                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                                    <circle cx="12" cy="6" r="4" stroke="currentColor" stroke-width="1.5" />
                                    <ellipse opacity="0.5" cx="12" cy="17" rx="7" ry="4" stroke="currentColor" stroke-width="1.5" />
                                </svg>
                            </span>
                            <input type="text" required placeholder="Username" name="username" class="form-input ltr:pl-10 rtl:pr-10" />
                        </div>
                        <div class="relative mb-4">
                            <span class="absolute ltr:left-3 rtl:right-3 top-1/2 -translate-y-1/2 dark:text-white-dark">

                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                                    <path d="M12 18C8.68629 18 6 15.3137 6 12C6 8.68629 8.68629 6 12 6C15.3137 6 18 8.68629 18 12C18 12.7215 17.8726 13.4133 17.6392 14.054C17.5551 14.285 17.4075 14.4861 17.2268 14.6527L17.1463 14.727C16.591 15.2392 15.7573 15.3049 15.1288 14.8858C14.6735 14.5823 14.4 14.0713 14.4 13.5241V12M14.4 12C14.4 13.3255 13.3255 14.4 12 14.4C10.6745 14.4 9.6 13.3255 9.6 12C9.6 10.6745 10.6745 9.6 12 9.6C13.3255 9.6 14.4 10.6745 14.4 12Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />


                                    <path opacity="0.5" d="M2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12Z" stroke="currentColor" stroke-width="1.5" />
                                </svg>
                            </span>
                            <input type="email" placeholder="Email" required name="email" class="form-input ltr:pl-10 rtl:pr-10" />
                        </div>
                        <div class="relative mb-4">
                            <span class="absolute ltr:left-3 rtl:right-3 top-1/2 -translate-y-1/2 dark:text-white-dark">

                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                                    <path d="M2 16C2 13.1716 2 11.7574 2.87868 10.8787C3.75736 10 5.17157 10 8 10H16C18.8284 10 20.2426 10 21.1213 10.8787C22 11.7574 22 13.1716 22 16C22 18.8284 22 20.2426 21.1213 21.1213C20.2426 22 18.8284 22 16 22H8C5.17157 22 3.75736 22 2.87868 21.1213C2 20.2426 2 18.8284 2 16Z" stroke="currentColor" stroke-width="1.5" />
                                    <path opacity="0.5" d="M6 10V8C6 4.68629 8.68629 2 12 2C15.3137 2 18 4.68629 18 8V10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                </svg>
                            </span>
                            <input type="password" placeholder="Password" required name="password" class="form-input ltr:pl-10 rtl:pr-10" />
                        </div>



                        <div class="relative mb-4">
                            <span class="absolute ltr:left-3 rtl:right-3 top-1/2 -translate-y-1/2 dark:text-white-dark">

                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                                    <path d="M2 16C2 13.1716 2 11.7574 2.87868 10.8787C3.75736 10 5.17157 10 8 10H16C18.8284 10 20.2426 10 21.1213 10.8787C22 11.7574 22 13.1716 22 16C22 18.8284 22 20.2426 21.1213 21.1213C20.2426 22 18.8284 22 16 22H8C5.17157 22 3.75736 22 2.87868 21.1213C2 20.2426 2 18.8284 2 16Z" stroke="currentColor" stroke-width="1.5" />
                                    <path opacity="0.5" d="M6 10V8C6 4.68629 8.68629 2 12 2C15.3137 2 18 4.68629 18 8V10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                </svg>
                            </span>
                            <input type="text" placeholder="Phone Numbrer" required name="phone_number" class="form-input ltr:pl-10 rtl:pr-10" />
                        </div>


                        <button type="submit" id="submit_register" class="btn btn-primary w-full">Submit</button>

                    </form>
                </div>
                <!-- <div
                                                class="my-4 text-center text-xs text-white-dark dark:text-white-dark/70">
                                                OR</div>
                                            <div class="flex items-center justify-center gap-3 mb-5">
                                                <a href="javascript:void(0);"
                                                    class="btn btn-outline-primary flex gap-1">

                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px"
                                                        height="24px" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="1.5"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        class="w-5 h-5">
                                                        <path
                                                            d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z">
                                                        </path>
                                                    </svg>
                                                    <span>Facebook</span>
                                                </a>
                                                <a href="javascript:void(0);"
                                                    class="btn btn-outline-danger flex gap-1">

                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px"
                                                        height="24px" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="1.5"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        class="w-5 h-5">
                                                        <path
                                                            d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22">
                                                        </path>
                                                    </svg>
                                                    <span>Github</span>
                                                </a>
                                            </div> -->

                <div class="p-5 border-t border-[#ebe9f1] dark:border-white/10">
                    <p class="text-center text-white-dark dark:text-white-dark/70">Already
                        have <a href="javascript:;" class="text-[#515365] hover:underline dark:text-white-dark">Login?</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    document.getElementById("signup_form").addEventListener("submit", async function(event) {
        event.preventDefault();
        const submit_register = document.getElementById('submit_register');
        submit_register.setAttribute('disabled', '');
        submit_register.innerText = 'Please Waiting...';

        const formData = new FormData(event.target);

        try {
            const response = await fetch('/api/auth/register', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }

            });

            if (response.ok) {
                const responseData = await response.json();
                const removeRegisterModal = document.getElementById('remove-register-modal');
                removeRegisterModal.style.display = 'none';
                register_successful_alert(responseData.message);

                console.log(responseData.message);
            } else if (response.status === 422) {
                const errors = await response.json();

                register_failed_alert(errors.message)
                submit_register.disabled = false;
                submit_register.innerText = 'Submit again';
                console.log("Validation errors:", errors);
            }
        } catch (error) {
            alert('Fatal Error');
            console.error('Error:', error);
        }
    });
</script>

<script>
    async function register_successful_alert(msg) {
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
            title: 'Registration Succesful',
            padding: '2em',
            customClass: 'sweet-alerts',
        });
    }

    async function register_failed_alert(msg) {

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