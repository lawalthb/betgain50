<div class="panel h-full p-0 border-0 overflow-hidden">
    <div class="p-10 bg-gradient-to-r from-[#4361ee] to-[#160f6b] xl:min-h-[190px]">
        <div class="flex justify-between items-center xl:mb-6">
            <div class="bg-black/50 rounded-full p-1 hidden xl:flex ltr:pr-3 rtl:pl-3 items-center text-white font-semibold">
                <img class="w-8 h-8 rounded-full border-2 border-white/50 block object-cover ltr:mr-1 rtl:ml-1" src="/assets/images/award1.jpg" alt="image" />
                <span id="show_user_name2" class="show_user_name3">Please Login </span>
            </div>
            <button type="button" onclick="power_on();" id="power_on" class="ltr:ml-auto rtl:mr-auto hidden xl:flex items-center justify-between  h-9 bg-black text-white rounded-md hover:opacity-80">
                <img src="/assets/images/power_on.png" width="35" height="35" alt="">
            </button>
        </div>
        <div class="text-white justify-between items-center flex mb-3 xl:mb-0">
            <p class="text-xl">Wallet Balance</p>
            <h5 class="ltr:ml-auto rtl:mr-auto text-2xl">
                <span class="text-white-light">₦</span><span id="user_wallet_bal">xxx</span>
            </h5>

        </div>
        <div class="text-green justify-between items-center flex mb-3 xl:mb-0" style="display: none;">
            <p class="text-xl">Bonus Balance</p>
            <h5 class="ltr:ml-auto rtl:mr-auto text-2xl">
                <span class="text-green-light  text-xl">₦</span><span id="user_wallet_bonus">xxx</span>
            </h5>

        </div>
    </div>
    <br />
    <div class="-mt-12 px-8 grid grid-cols-2 gap-5">
        <div class="bg-white rounded-md shadow px-4 py-2.5 dark:bg-[#060818]">
            <span class="flex justify-between items-center mb-4 dark:text-white">Bet Amount
                <svg class="w-4 h-4 text-success" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 15L12 9L5 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </span>
            <form method="post">
                {{csrf_field()}}

                <input type="number" id="bet_amount" name="bet_amount" required step="1" min="50" class="btn w-full  py-1 text-base shadow-none border-0 bg-[#ebedf2] dark:bg-black text-[#515365] dark:text-[#bfc9d4]" value="100" />
        </div>
        <div class="bg-white rounded-md shadow px-4 py-2.5 dark:bg-[#060818]">
            <span class="flex justify-between items-center mb-4 dark:text-white">Crash Point
                <svg class="w-4 h-4 text-danger" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 9L12 15L5 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </span>
            <input type="number" id="bet_crash" name="bet_crash" required step="0.1" min="0.1" class="btn w-full  py-1 text-base shadow-none border-0 bg-[#ebedf2] dark:bg-black text-[#515365] dark:text-[#bfc9d4]" value="2.5" />
        </div>
    </div>
    <div class="text-center px-2 mt-3 flex justify-around">

        <button type="button" class="btn btn-primary" id="play">Play</button>
        <button type="button" class="btn btn-primary hidden	" id="cashOutBtn">Cash Out @<span id="cashout_amount">0.00</span></button>
        </form>

        @include('login')


    </div>
    <div class="p-5">
        <!-- <div class="mb-5">
            <span
                class="bg-[#1b2e4b] text-white text-xs rounded-full px-4 py-1.5 before:bg-white before:w-1.5 before:h-1.5 before:rounded-full ltr:before:mr-2 rtl:before:ml-2 before:inline-block">Online</span>
        </div> -->
        <div class="mb-5 space-y-1">
            <div class="flex items-center justify-between">
                <p class="text-[#515365] font-semibold">Previous Bet Amount</p>
                <p class="text-base"><span>₦</span> <span class="font-semibold" id="previous_bet_amount">xxx</span></p>
            </div>
            <div class="flex items-center justify-between">
                <p class="text-[#515365] font-semibold">Previous Crash Point</p>
                <p class="text-base"><span class="font-semibold " id="previous_bet_point">x.xx</span></p>
                <input type="hidden" id="round" value="">
            </div>
        </div>
        <div class=" px-2 flex justify-around">
            @include('depositModal')

            @include('withdrawModal')

        </div>
    </div>
</div>
</div>

@vite(['resources/js/playForm.js'])
@vite(['resources/css/game-play.css'])

<script>
    // power button to login/logout
    async function power_on() {

        let userID = localStorage.getItem('user_id');
        if (userID == null) {
            login_modal()
            //alert("run log in");
        } else {
            signout()
        }
    };
</script>