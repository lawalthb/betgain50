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
        <!-- <div class="text-green justify-between items-center flex mb-3 xl:mb-0" style="display: none;">
            <p class="text-xl">Bonus Balance</p>
            <h5 class="ltr:ml-auto rtl:mr-auto text-2xl">
                <span class="text-green-light  text-xl">₦</span><span id="user_wallet_bonus">xxx</span>
            </h5>

        </div> -->
    </div>
    <br />
    <div class="-mt-12 px-8 grid grid-cols-2 gap-5">
        <div class="bg-white rounded-md shadow px-4 py-2.5 dark:bg-[#060818]">
            <span class="flex justify-between items-center mb-4 dark:text-white">Bet Amount
                <svg class="w-4 h-4 text-success" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 15L12 9L5 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </span>
            <form method="post" id="betForm">
                {{csrf_field()}}

                <input type="number" id="bet_amount" name="bet_amount" required step="1" min="50" class="btn w-full  py-1 text-base shadow-none border-0 bg-[#ebedf2] dark:bg-black text-[#515365] dark:text-[#bfc9d4]" value="100" />
        </div>
        <div class="bg-white rounded-md shadow px-4 py-2.5 dark:bg-[#060818]">
            <span class="flex justify-between items-center mb-4 dark:text-white">Crash Point
                <svg class="w-4 h-4 text-danger" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 9L12 15L5 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </span>
            <input type="number" id="bet_crash" name="crash_point" required step="0.1" min="0.1" class="btn w-full  py-1 text-base shadow-none border-0 bg-[#ebedf2] dark:bg-black text-[#515365] dark:text-[#bfc9d4]" value="2.5" />

            <input type="hidden" id="current_game_id" name="current_game_id" value="curre" max="4">
            <input type="hidden" id="my_game_id" name="my_game_id" value="" max="4">
            <input type="hidden" id="user_bet_amt" name="user_bet_amt" value="" max="4">
            <input type="hidden" id="user_place_bet" value="0" max="4">
            <input type="hidden" id="user_place_point" max="4">


        </div>
    </div>
    <div class="text-center px-2 mt-3 flex justify-around">

        <button type="submit" class="btn btn-primary btnPlay" id="play">Play</button>
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
                <p class="text-base"><span>₦</span> <span class="font-semibold" id="previous_bet_amount">100</span></p>
            </div>
            <div class="flex items-center justify-between">
                <p class="text-[#515365] font-semibold">Previous Crash Point</p>
                <p class="text-base"><span class="font-semibold " id="previous_bet_point">2.50</span></p>
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
    const money = document.getElementById('money');
    const div = document.getElementById('gp-bg');

    channel.bind("CrashPoint", function(e) {
        // alert(e);

        pointElement.style.display = "block";
        timerElement.style.display = "none";
        div.classList.remove('animatedBackground');
        div.style.backgroundImage = "url('assets/images/betgain.gif')";
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
            money.style.display = "block";
            money.innerHTML = '₦' + parseInt(cash_out_value);

            user_cash_amount.value = cash_out_value;
            ruser_place_bet.value = 0;
            if (point >= ruser_place_point.value) {
                cash_btn.innerHTML = 'You have won';
                money.style.display = "none";
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
                money.style.display = "none";
            } else if (ruser_place_bet.value != 1) {
                rbet_btn.disabled = false
                rbet_btn.style.display = "block";
                rbet_btn.innerHTML = 'Place Bet!';
                cash_btn.style.display = "none";
                money.style.display = "none";
            }

        }
        // myChart.data.labels = Array.from({
        //     length: chartData.length
        // }, (_, i) => i.toString());
        // // Update chart dataset
        // myChart.data.datasets[0].data = chartData;
        // // Update the chart
        // myChart.update();

    });
    channel.bind("RemainTimeChanged", function(e) {

        getUserBalance();


        //div.style.backgroundImage = "url('assets/images/c.png')";
        pointElement.style.display = "none";
        timerElement.style.display = "block";
        timerElement.innerText = 'Crashed!';

        countdownFromFiveToZero(myCallbackFunction);
        // Call the function to display last 7 crashed games
        //displayLast7CrashedGames();

        // div.classList.add('animatedBackground');

    });
    channel.bind("betHistory", function(e) {
        // alert('new bet placed');
        updateHistory(e.betHistory);
    });
</script>
<script>
    //  const timerElement2 = document.getElementById('timer');

    function countdownFromFiveToZero(callbackFunction) {
        stopRocket()

        let count = 5;
        const countdownInterval = setInterval(() => {

            stopRocket()
            console.log(count);
            timerElement.innerText = "Next  Round: " + count;
            count--;

            if (count < 0) {
                clearInterval(countdownInterval);
                if (typeof callbackFunction === 'function') {
                    callbackFunction();


                    launchRocket();

                }

            }
        }, 1000);
        getUserBalance();
    }







    // Function to execute when countdown reaches 0
    function myCallbackFunction() {
        console.log("Countdown reached 0! Executing callback function...");
        console.log('display');
    }
</script>

<script>
    const current_balance = document.getElementById('user_wallet_bal');
    const bet_btn = document.getElementById('play');
    const current_g_id = document.getElementById('current_game_id');
    const my_game_id = document.getElementById('my_game_id');
    const form_bet_amt = document.getElementById('user_bet_amt');
    const user_place_bet = document.getElementById('user_place_bet');
    const user_place_point = document.getElementById('user_place_point');
    const bet_cash_amount = document.getElementById('user_cash_amount');
    const crash_point = document.getElementById("bet_crash");


    document.getElementById('betForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(this);
        console.log(formData);
        fetch('/bets/placebet', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                // Handle response from the API
                console.log(data);
                if (data.success == false) {
                    alert(data.message);
                }
                if (data.success == true) {

                    var g_id = current_g_id.value;

                    current_balance.innerHTML = data.user_balance;
                    bet_btn.disabled = true;
                    bet_btn.innerHTML = 'Bet Placed for next round';
                    my_game_id.value = g_id;
                    var betamount = bet_amount.value;
                    form_bet_amt.value = betamount;
                    var crash_point2 = crash_point.value;
                    user_place_point.value = crash_point2;
                    user_place_bet.value = 1;
                }
                // Optionally, reset the form
                // document.getElementById('betForm').reset();
            })
            .catch(error => {
                console.error('Error:', error);
                alert(error);
                alert('Failed to place bet. Please try again.');
            });
    });
</script>
<script>
    function cashOut() {
        var cashAmt = parseInt(bet_cash_amount.value);
        //alert(cashAmt);
        fetch('/bets/cashout?cashAmt=' + cashAmt, {
                method: 'get',

            })
            .then(response => response.json())
            .then(data => {
                // Handle response from the API
                console.log(data);
                if (data.success == false) {
                    alert(data.message);
                }
                if (data.success == true) {

                    var g_id = current_g_id.value;

                    current_balance.innerHTML = data.user_balance;

                    cash_btn.innerHTML = 'Cashed Out';
                    my_game_id.value = '';

                    form_bet_amt.value = '';

                    user_place_point.value = '';

                    user_place_bet.value = 0;
                    cashout_msg(data.message);
                    getUserBalance();
                }
                // Optionally, reset the form
                // document.getElementById('betForm').reset();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to cash out. Please try again.');
            });
    }
</script>


<script>
    //get user current balance
    function getUserBalance() {

        fetch('/user/balance', {
                method: 'GET',
                headers: {

                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem('user_token')
                }
            })
            .then(response => response.json())
            .then(data => {
                // Handle the response
                console.log('User balance:', data.balance);
                // Update the UI with the user balance

                if (data.balance === undefined) {
                    current_balance.innerText = 'xx';
                } else {
                    current_balance.innerText = data.balance;
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
</script>

<script>
    function displayLast7CrashedGames() {
        fetch('/games/lastgames')
            .then(response => response.json())
            .then(data => {
                const lastCrashedContainer = document.getElementById('last_crashed');
                lastCrashedContainer.innerHTML = ''; // Clear previous content

                // Loop through the data and create HTML elements
                data.forEach(game => {
                    const badge = document.createElement('span');
                    badge.classList.add('badge');
                    badge.classList.add('bg-' + game.color); // Assuming each game has a color attribute
                    badge.innerText = game.multiplier + 'x'; // Assuming each game has a multiplier attribute

                    lastCrashedContainer.appendChild(badge);
                });
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    // Call the function to display last 7 crashed games
    //displayLast7CrashedGames();
</script>



<script>
    async function cashout_msg(msg) {
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
    let rocketFlying = false;

    function launchRocket() {
        const rocket = document.querySelector(".rocket");
        if (!rocketFlying) {
            rocket.style.display = "block"; // Show rocket
            rocket.style.animation = "fly 8s linear forwards"; // Start animation
            rocketFlying = true;
        }
    }

    function stopRocket() {
        const rocket = document.querySelector(".rocket");
        rocket.style.animation = "none"; // Stop animation
        rocketFlying = false;
    }
</script>


<script>
    function updateHistory(betHistory) {
        //alert('history is coming');
        var statusa;
        recent_historys = betHistory;
        // console.log(recent_historys);
        $('#recent_history').empty(); // Clear previous recent_Historys
        recent_historys.forEach(function(recent_history) {
            if (recent_history.statusa == 'none') {
                statusa = 'New';
            } else {
                statusa = recent_history.statusa;
            }
            $('#recent_history').append('<tr><td>' + recent_history.user.username + '</td><td>' + recent_history.bet + 'x</td><td>' + recent_history.stake_amount + '</td><td>' + statusa + '</td><td>' + recent_history.game_id + '</td><td>' + recent_history.hash + '</td></tr>')

        });
    }
</script>