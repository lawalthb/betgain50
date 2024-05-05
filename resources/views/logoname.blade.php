<div class="shadow-sm">
    <div class="relative bg-white flex w-full items-center md:justify-between px-5 py-2.5 dark:bg-[#0e1726]">
        <div class="horizontal-logo flex lg:hidden justify-between items-center ltr:mr-2 rtl:ml-2">
            <a href="/" class="main-logo flex items-center shrink-0">
                <!-- <img class="w-8 ltr:-ml-1 rtl:-mr-1 inline" src="/assets/images/logo.svg" alt="image" /> -->
                <span class="text-2xl ltr:ml-1.5 rtl:mr-1.5  font-semibold  align-middle hidden md:inline dark:text-white-light transition-all duration-300"><img src="{{url('assets/images/logoname2png.png')}}" height="50px" width="100px"></span>
            </a>


        </div>

        <div x-data="header" class="flex space-x-1.5 lg:space-x-2 dark:text-[#d0d2d6]">
            <div class="bg-black/50 rounded-full p-1 flex xl:hidden ltr:pr-3 rtl:pl-3 items-center text-white font-semibold">
                <img class="w-8 h-8 rounded-full border-2 border-white/50 block object-cover ltr:mr-1 rtl:ml-1" src="/assets/images/award1.jpg" alt="image" />
                <span id="show_user_name2" class="show_user_name3">Please Login </span>
            </div>

            <button type="button" onclick="power_on();" id="power_on" class="ltr:ml-auto rtl:mr-auto flex xl:hidden items-center justify-between  h-9 bg-black text-white rounded-md hover:opacity-80">
                <img src="/assets/images/power_on.png" width="35" height="35" alt="">
            </button>
            <p id='user-wallet'></p>
            <div class="sm:ltr:mr-auto sm:rtl:ml-auto" x-data="{ search: false }" @click.outside="search = false">


            </div>




            <div class="dropdown" x-data="dropdown" @click.outside="open = false">
                <!-- basic -->

             