<!-- Register -->
<div x-data="modal" id=remove-register-modal>
    <!-- <button type="button" class="btn btn-danger" @click="toggle">register</button> -->
    <p @click="toggle" class="cursor-pointer">Click here to register</p>
    <div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto" :class="open && '!block'">
        <div class="flex items-start justify-center min-h-screen px-4" @click.self="open = false">
            <div x-show="open" x-transition x-transition.duration.300 class="panel border-0 py-1 px-4 rounded-lg overflow-hidden w-full max-w-sm my-8">
                <div class="flex items-center justify-between p-5 font-semibold text-lg dark:text-white">
                    Register and Get ₦300
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

                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16.5562 12.9062L16.1007 13.359C16.1007 13.359 15.0181 14.4355 12.0631 11.4972C9.10812 8.55901 10.1907 7.48257 10.1907 7.48257L10.4775 7.19738C11.1841 6.49484 11.2507 5.36691 10.6342 4.54348L9.37326 2.85908C8.61028 1.83992 7.13596 1.70529 6.26145 2.57483L4.69185 4.13552C4.25823 4.56668 3.96765 5.12559 4.00289 5.74561C4.09304 7.33182 4.81071 10.7447 8.81536 14.7266C13.0621 18.9492 17.0468 19.117 18.6763 18.9651C19.1917 18.9171 19.6399 18.6546 20.0011 18.2954L21.4217 16.883C22.3806 15.9295 22.1102 14.2949 20.8833 13.628L18.9728 12.5894C18.1672 12.1515 17.1858 12.2801 16.5562 12.9062Z" fill="#1C274C" />
                                </svg>

                            </span>
                            <input type="text" placeholder="Phone Number" required name="phone_number" class="form-input ltr:pl-10 rtl:pr-10" />
                        </div>

                        <div class="relative mb-4">
                            <span class="absolute ltr:left-3 rtl:right-3 top-1/2 -translate-y-1/2 dark:text-white-dark">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.5 3.75C10.5335 3.75 9.75004 4.5335 9.75004 5.5C9.75004 6.4665 10.5335 7.25 11.5 7.25C12.4665 7.25 13.25 6.4665 13.25 5.5C13.25 4.5335 12.4665 3.75 11.5 3.75ZM8.25004 5.5C8.25004 3.70507 9.70511 2.25 11.5 2.25C13.295 2.25 14.75 3.70507 14.75 5.5C14.75 7.29493 13.295 8.75 11.5 8.75C9.70511 8.75 8.25004 7.29493 8.25004 5.5ZM19 6.25C19.4143 6.25 19.75 6.58579 19.75 7V21C19.75 21.4142 19.4143 21.75 19 21.75C18.5858 21.75 18.25 21.4142 18.25 21V10.9941C16.5565 11.9799 14.456 12.0665 12.6646 11.1708C12.6474 11.1622 12.6306 11.153 12.6141 11.1431C11.9234 10.7287 11.0363 11.1741 10.9562 11.9756L10.8876 12.6617C10.8294 13.243 11.1062 13.807 11.6016 14.1166L11.9349 14.3249C13.6853 15.4188 14.8215 17.2701 15.0044 19.3261L15.1474 20.9335C15.1842 21.3461 14.8795 21.7103 14.4669 21.747C14.0543 21.7838 13.6901 21.4791 13.6534 21.0665L13.5103 19.4591C13.3691 17.8713 12.4916 16.4417 11.1399 15.5969L10.8066 15.3886C9.82727 14.7765 9.2801 13.6616 9.39502 12.5125L9.46363 11.8264C9.65218 9.9409 11.7282 8.88835 13.3582 9.84044C14.9095 10.605 16.7667 10.3848 18.0966 9.27658L18.25 9.14869V7C18.25 6.58579 18.5858 6.25 19 6.25ZM9.19069 15.7746C9.59129 15.8799 9.83069 16.29 9.7254 16.6906L9.00004 16.5C9.7254 16.6906 9.72542 16.6906 9.7254 16.6906L9.72479 16.693L9.72356 16.6976L9.71923 16.7137L9.70334 16.7718C9.68959 16.8213 9.66959 16.892 9.64388 16.9791C9.59255 17.153 9.51791 17.3942 9.4242 17.665C9.24256 18.1898 8.9684 18.8881 8.62825 19.4097C8.27086 19.9577 7.70978 20.5113 7.2771 20.903C7.05385 21.1051 6.85091 21.2763 6.70355 21.3973C6.62971 21.4579 6.56943 21.5062 6.52703 21.5398L6.4773 21.579L6.46344 21.5897L6.45944 21.5928L6.45819 21.5938C6.45812 21.5939 6.45745 21.5944 6.00004 21L6.45819 21.5938C6.12993 21.8464 5.65829 21.7857 5.40567 21.4574C5.1531 21.1292 5.21434 20.6584 5.54242 20.4058C5.5424 20.4058 5.54245 20.4058 5.54242 20.4058L5.54468 20.404L5.55444 20.3964L5.59542 20.3642C5.63176 20.3354 5.6853 20.2925 5.75182 20.2379C5.88518 20.1284 6.0691 19.9732 6.27043 19.7909C6.6869 19.4139 7.12582 18.9675 7.37183 18.5903C7.60608 18.2311 7.83192 17.6794 8.00669 17.1744C8.09118 16.9303 8.15883 16.7117 8.20525 16.5544C8.22841 16.476 8.24615 16.4133 8.25792 16.3708L8.271 16.3231L8.27404 16.3117L8.27466 16.3094C8.27465 16.3094 8.27467 16.3094 8.27466 16.3094C8.38005 15.9089 8.79015 15.6694 9.19069 15.7746Z" fill="#1C274C" />
                                </svg>


                            </span>
                            <input type="text" placeholder="Referral Code (Optional)" name="referral_code" class="form-input ltr:pl-10 rtl:pr-10" />
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