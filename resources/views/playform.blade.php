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

            <input type="text" id="current_game_id" name="current_game_id" value="curre" max="4">
            <input type="text" id="my_game_id" name="my_game_id" value="" max="4">
            <input type="text" id="user_bet_amt" name="user_bet_amt" value="" max="4">
            <input type="text" id="user_place_bet" value="0" max="4">
            <input type="text" id="user_place_point" max="4">


        </div>
    </div>
    <div class="text-center px-2 mt-3 flex justify-around">

        <button type="button" class="btn btn-primary" id="play">Play</button>
        <button type="button" class="btn btn-primary hidden	" id="cashOutBtn">Cash Out @<span id="cashout_amount">0.00</span></button>
        </form>
        <button type="button" class="btn btn-default" style="background-color:#3656ff ; color:white; width:250px; display:none" id="cash_btn" onclick="cashOut()">Cash out</button>
        <input type="hidden" id="user_cash_amount" max="4">
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



<script>
    const pointElement = document.getElementById('point');
    const timerElement = document.getElementById('timer');
    const current_game_idElement = document.getElementById('current_game_id');
    // const betElement = document.getElementById('bet');
    // const resultElement = document.getElementById('result');
    const my_cur_game = document.getElementById('my_game_id');
    const rbet_btn = document.getElementById('play');
    const cash_btn = document.getElementById('cash_btn');
    const ruser_place_bet = document.getElementById('user_place_bet');
    const ruser_place_point = document.getElementById('user_place_point');
    const user_cash_amount = document.getElementById('user_cash_amount');
    
    channel.bind("CrashPoint", function(e) {
        // alert(e);
        pointElement.style.display = "block";
        timerElement.style.display = "none";
        const user_bet_amt = document.getElementById('user_bet_amt');
        pointElement.innerText = e.point + 'x';
        var point = e.point;

        var current_game = e.current_game_id;
        // alert(current_game);
        current_game_idElement.value = Number(current_game + 1);

        // Update chart labels (if applicable)
        console.log("Current point: " + point)
        console.log("bet amountt: " + user_bet_amt.value)
        var cash_out_value = parseFloat(point) * parseFloat(user_bet_amt.value);
        if (current_game == my_cur_game.value) {
            //rbet_btn.disabled = false;
            rbet_btn.style.display = "none";
            cash_btn.style.display = "block";
            cash_btn.disabled = false;
            cash_btn.innerHTML = 'Cash Out @ ₦' + parseInt(cash_out_value);
            user_cash_amount.value = cash_out_value;
            ruser_place_bet.value = 0;
            if (point >= ruser_place_point.value) {
                cash_btn.innerHTML = 'You have won';
                cash_btn.disabled = true;
                user_cash_amount.value = '';
                getUserBalance();
            }
        } else {
            if (ruser_place_bet.value == 1) {
                rbet_btn.disabled = true
                rbet_btn.style.display = "block";
                rbet_btn.innerHTML = 'Bet Placed for next round!';
                cash_btn.style.display = "none";
                user_cash_amount.value = '';
            } else {
                rbet_btn.disabled = false
                rbet_btn.style.display = "block";
                rbet_btn.innerHTML = 'Place Bet!';
                cash_btn.style.display = "none";
            }

        }
        // myChart.data.labels = Array.from({
        //     length: chartData.length
        // }, (_, i) => i.toString());
        // // Update chart dataset
        // myChart.data.datasets[0].data = chartData;
        // // Update the chart
        // myChart.update();

    })
</script>