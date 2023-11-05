<x-layout.auth>

    <div class="flex justify-center items-center min-h-screen bg-[url('/assets/images/map.svg')] dark:bg-[url('/assets/images/map-dark.svg')] bg-cover bg-center">
        <div class="panel sm:w-[480px] m-6 max-w-lg w-full">
            <h2 class="font-bold text-2xl mb-3">Sign In</h2>
            <p class="mb-7">Enter your email and password to login</p>
            <form class="space-y-5" action="{{route('adminLoginPost')}}" method="post">
                @csrf
                <div>
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" class="form-input" required placeholder="Enter Email" />
                </div>
                <div>
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" class="form-input" required placeholder="Enter Password" />
                </div>
                <div>
                    <label class="cursor-pointer">
                        <input type="checkbox" class="form-checkbox" />
                        <span class="text-white-dark">Remember me</span>
                    </label>
                    <span class="text-white-dark float-right" onclick="showEmail()">Forgot Password</span>
                    </label>
                </div>
                <br>
                <button type="submit" class="btn btn-primary w-full">SIGN IN</button>
            </form>
            <div style="display: none;" id="forgotPasswordDiv">
                <div>
                    <form class="space-y-5" action="{{route('adminPassowrdReset')}}" method="post">
                        @csrf
                        <label for="email">Enter Email to rest your password</label>
                        <input id="email" name="email" type="email" id="email4forgot" class="form-input" required placeholder="Enter Email" />
                </div>
                <br>
                <button type="submit" class="btn btn-primary w-full">Submit</button>
                </form>
            </div>

            <script>
                function showEmail() {
                    const email4forgot = document.getElementById('email4forgot');
                    const forgotPasswordDiv = document.getElementById('forgotPasswordDiv');
                    forgotPasswordDiv.style.display = 'block';
                }
            </script>

            <!-- <p class="text-center">Dont't have an account ? <a href="/auth/boxed-signup"
                    class="text-primary font-bold hover:underline">Sign Up</a></p> -->
        </div>
    </div>

</x-layout.auth>