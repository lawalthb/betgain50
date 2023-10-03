const play = document.getElementById('play');
const betAmount = document.getElementById('bet_amount');
const betCrash = document.getElementById('bet_crash');
const busted = document.getElementById('busted');
const clearChart = document.querySelector('.take-out-graph');
const newRoundsCount = document.getElementById('count-down');
const bustedResponseWrap = document.createElement('div');
const messageStart = document.createElement('h2');
const messageMain = document.createElement('h2');
let point = document.getElementById('point');
let bustedValue;
const token = localStorage.getItem('user_token');

// const betAmountNumb = Number(betAmount.value);
// const userWalletBalance = localStorage.getItem('user_wallet_bal');
// const userWalletBalanceNumb = Number(userWalletBalance);
// console.log('wb = ', typeof userWalletBalanceNumb);

function startBet() {
    play.addEventListener('click', async () => {
        if (!betAmount.value) {
            alert('Please add amount');
        } else if (!betCrash.value) {
            alert('please add crash point');
        } else {
            const betAmountNumb = Number(betAmount.value);
            const userWalletBalance = localStorage.getItem('user_wallet_bal');
            const userWalletBalanceNumb = Number(userWalletBalance);

            if (betAmountNumb > userWalletBalanceNumb) {
                alert('no enough money');
            } else {
                play.setAttribute('disabled', '');
                play.innerText = 'Bet Placed';

                let userId = localStorage.getItem('user_id');
                let userName = localStorage.getItem('username');
                let token = $('input[name=_token]').val();

                const betDetails = {
                    user_id: userId,
                    username: userName,
                    bet_amount: betAmount.value,
                    bet_crash: betCrash.value,
                    token: token,
                    busted_value: bustedValue,
                };

                $.ajax({
                    url: '/api/setbet',
                    type: 'POST',
                    headers: {
                        Authorization: 'Bearer ' + localStorage.getItem('user_token'),
                    },
                    data: betDetails,
                    success: function (data) {
                        if (data.status == true) {
                            //alert(data.message);
                            //run ajax to minus money;
                            var user_bet_id = data.lastID;
                            localStorage.setItem('user_bet_id4next_round', user_bet_id);
                            localStorage.setItem('user_bet_value', betCrash.value);
                            load_new_balance();
                            play.innerText = 'Bet Placed for next round';
                            play.setAttribute('disabled', '');

                        }
                    },
                });
            }
        }
    });
}

function countDown() {
    let countDownValue = 6;

    const interval = setInterval(() => {
        countDownValue--;
        messageStart.innerText = 'Next Round In';
        messageMain.innerText = `${countDownValue}`;
        messageStart.classList.add('busted-text');
        messageMain.classList.add('busted-text', 'busted-text-other');
        busted.append(bustedResponseWrap);
        busted.classList.add('busted-wrap');
        bustedResponseWrap.append(messageStart);
        bustedResponseWrap.append(messageMain);

        if (countDownValue === 0) {
            clearInterval(interval);
            busted.innerText = '';
            busted.classList.remove('busted-wrap');
            messageMain.classList.remove('busted-text-other');
            clearChart.style.display = 'block';
            loadContent(0.0);
        }
    }, 1000);
}

 function loadContent(randomValueForInitial) {
 function get_settings() {
    $.get("/api/settings?name=min_game", function (data, status) {
       //  console.log(data)
        var min_crash = data[0].value;
       // alert(min_crash)
       localStorage.setItem('min_crash',min_crash);
    });
     }

     function get_settings2() {
    $.get("/api/settings?name=max_game", function (data, status) {
       //  console.log(data)
        var max_crash = data[0].value;
       // alert(min_crash)
       localStorage.setItem('max_crash',max_crash);
    });
}
     get_settings();
     get_settings2();
     const min_crash2 = localStorage.getItem('min_crash');
      const max_crash2 = localStorage.getItem('max_crash');
//alert(min_crash2 +" -"+max_crash2)
    const min =1;
     const max =10;
    var count = randomValueForInitial;
    let seconds = 0;

    play.removeAttribute('disabled');
    //get busted value to use on this round
    let user_bet_id4next_round = localStorage.getItem('user_bet_id4next_round');
    if (user_bet_id4next_round == null) {
        play.innerText = 'Play';
    } else {
        //get change user game id for db
        localStorage.setItem('user_bet_id', user_bet_id4next_round);
        play.innerText = 'Cash Out @';
        localStorage.removeItem('user_bet_id4next_round');
    }

    bustedValue = randomBustedValue(min, max);
    //console.log(bustedValue);
    const busted_value =  bustedValue;
    localStorage.setItem('busted_value',busted_value);
    $.post("api/save_busted_value", { busted_value: bustedValue, user_id: localStorage.getItem('user_id') });
    let initialDataValue = [];

    const interval = setInterval(() => {
        seconds += 1;
        point.innerText = `${count.toFixed(2)}x`;
        count += 0.01;
        let counter = Number(count.toFixed(2));
        //check_if_win when it counting;
        var getBustedValue = localStorage.getItem('busted_value');
        if (!typeof getBustedValue === null) {
            var bustednumber = getBustedValue;
        }

        var user_bet = localStorage.getItem('user_bet_value');

        if (counter == user_bet) {
            //congrat();
            win_alert();
            localStorage.removeItem('user_bet_value');
            localStorage.removeItem('busted_value');

        } else {
            localStorage.removeItem('user_bet_value');
            localStorage.removeItem('busted_value');
        }
        if (seconds <= 1000) {
            initialDataValue[seconds - 2] = counter;
            ///alert(initialDataValue)
            window.revenueChart.updateSeries([
                {
                    data: initialDataValue

                },
            ]);
        }

        if (counter >= bustedValue) {
            // Note: Changed to greater than or equal to make sure condition will met
            check_if_win();
            clearInterval(interval);
            point.innerHTML = '';
            clearChart.style.display = 'none';
            busted.append(bustedResponseWrap);
            messageStart.innerText = 'Busted';
            load_new_balance();
            messageMain.innerText = `@ ${count.toFixed(2)}x`;
            messageStart.classList.add('busted-text');
            messageMain.classList.add('busted-text');
            busted.append(bustedResponseWrap);
            busted.classList.add('busted-wrap');
            bustedResponseWrap.append(messageStart);
            bustedResponseWrap.append(messageMain);
            // play.setAttribute('disabled', '');
            // play.innerText = 'Betting...';
            setTimeout(countDown, 3000);
        }
    }, 100);
}

document.addEventListener('DOMContentLoaded', () => {
    let randomValueForInitial = randomBustedValue(0.1, 1.85);
    loadContent(randomValueForInitial);
    startBet();
});

function randomBustedValue(min, max) {
    let value = Number((Math.random() * (max - min + 1) + min).toFixed(2));
    return value;
}
// to determine if user play and win
function check_if_win() {
    //user last user bet store id retrived and his username
    var user_bet_id = localStorage.getItem('user_bet_id');
    var userb_id = localStorage.getItem('user_id');
    $.ajax({
        url: '/api/check_if_win',
        type: 'POST',
        headers: {
            Authorization: 'Bearer ' + localStorage.getItem('user_token'),
        },
        data: {
            user_bet_id: user_bet_id,
            user_id: userb_id,
        },
        success: function (data) {
            if (data.status == true) {
                //alert(data.message);
                win_alert();
                //if user wins money will be add to his/her account
                var user_bet_id = data.lastID;
                //clear user bet id
                localStorage.removeItem('user_bet_id');
            } else {
                lose_alert();
                //if user wins money will be add to his/her account
                var user_bet_id = data.lastID;
                //clear user bet id
                localStorage.removeItem('user_bet_id');
            }
        },
    });
}

// to show current user balance from DB
async function load_new_balance() {
    let userID2 = localStorage.getItem('user_id');
    var user_balance = '/api/transactions/user_balance/' + userID2;
    $.ajaxSetup({
        headers: {
            Authorization: 'Bearer ' + localStorage.getItem('user_token'),
        },
    });
    $.getJSON(user_balance, {})
        .done(function (data) {
            const myJSON2 = JSON.stringify(data);
            // alert(myJSON2)
            var balance = data.balance;
            //alert(balance);
            localStorage.setItem('user_wallet_bal', balance);

            function formatNumber(num) {
                return num.toString().replace(/(\d)(?=(\d{ 3 })+(?!\d))/g, '$1,');
            }

            $('#user_wallet_bal').text(formatNumber(balance));
        })
        .done(function () {
            // alert('getJSON request succeeded!');
        })
        .fail(function (jqXHR, textStatus, errorThrown) {
            $('#user_wallet_bal').text('0.00');
            localStorage.setItem('user_wallet_bal', 0);
        })
        .always(function () {
            // alert('getJSON request ended!');
        });
}

async function win_alert() {
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
        title: 'Hurray!!! you won',
        padding: '2em',
        customClass: 'sweet-alerts',
    });
}

async function lose_alert() {
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
        title: 'You lose bet, try again',
        padding: '2em',
        customClass: 'sweet-alerts',
    });
}

//encryt function
const crypt = (salt, text) => {
    var text = String(text)
    const textToChars = (text) => text.split("").map((c) => c.charCodeAt(0));
    const byteHex = (n) => ("0" + Number(n).toString(16)).substr(-2);
    const applySaltToChar = (code) => textToChars(salt).reduce((a, b) => a ^ b, code);

    return text
        .split("")
        .map(textToChars)
        .map(applySaltToChar)
        .map(byteHex)
        .join("");
};
//decrypt function
const decrypt = (salt, encoded) => {
    const textToChars = (text) => text.split("").map((c) => c.charCodeAt(0));
    const applySaltToChar = (code) => textToChars(salt).reduce((a, b) => a ^ b, code);
    return encoded
        .match(/.{1,2}/g)
        .map((hex) => parseInt(hex, 16))
        .map(applySaltToChar)
        .map((charCode) => String.fromCharCode(charCode))
        .join("");
};


