<x-layout.auth>

    <div
        class="flex justify-center items-center min-h-screen bg-[url('/assets/images/map.svg')] dark:bg-[url('/assets/images/map-dark.svg')] bg-cover bg-center">
        <div class="panel sm:w-[480px] m-6 max-w-lg w-full">
            <h2 class="font-bold text-2xl mb-3">Sign In</h2>
            <p class="mb-7">Enter your email and password to login</p>
            <form class="space-y-5" action="{{route('adminLoginPost')}}" method="post">
            @csrf
                <div>
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" class="form-input" placeholder="Enter Email" />
                </div>
                <div>
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" class="form-input" placeholder="Enter Password" />
                </div>
                <div>
                    <label class="cursor-pointer">
                        <input type="checkbox" class="form-checkbox" />
                        <span class="text-white-dark">Remember me</span>
                    </label>
                </div>
                <button type="submit" class="btn btn-primary w-full">SIGN IN</button>
            </form>


            <!-- <p class="text-center">Dont't have an account ? <a href="/auth/boxed-signup"
                    class="text-primary font-bold hover:underline">Sign Up</a></p> -->
        </div>
    </div>

</x-layout.auth>
