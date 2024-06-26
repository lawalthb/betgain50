<button type="button" disabled id="withdrawBtn" class="btn btn-secondary ltr:mr-2 rtl:ml-2">Withdraw</button>



<!-- The Modal -->
<div id="withdrawModal" class="modal">

    <div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto" :class="open && '!block'">
        <div class="flex items-start justify-center min-h-screen px-5 mt-5" @click.self="open = false">
            <div x-show="open" x-transition x-transition.duration.300 class="panel border-0 p-0 rounded-lg overflow-hidden my-2 w-full max-w-lg">
                <div class="flex bg-[#fbfbfb] dark:bg-[#121c2c] items-center justify-between px-5 py-3">
                    <div class="font-bold text-lg">Wallet Withdraw</div>
                </div>
                <div class="p-2">
                    <div class="dark:text-white-dark/70 text-base font-medium text-[#1f2937] text-justify">
                        <div class="px-4 sm:px-10"> <b>Withholding Tax Notice:</b> <BR />
                            As provided for by the Income Tax Act, Cap 472, all gaming companies are required to withhold winnings at a rate of 20%. This is the Withholding Tax. In compliance with the law, BetGain will deduct and remit to Naira 20% of all winnings.
                        </div>

                        <div class="relative mb-3 px-4 sm:px-10">

                            <div class="mb-0.5">Amount <span>₦</span><br /></div>


                            <input type="number" class="form-input ltr:pl-10 rtl:pr-10" min="100" value="100" onkeyup="show_amount2withdraw(this.value)" id="withdrawing_amount" placeholder="Amount" name="withdrawing_amount" required />
                            <input type="hidden" class="" id="key" placeholder="key" name="key" value="{{env('PAYSTACK_KEY_PUBLIC')}}" />
                            <input type="hidden" class="" id="reference" placeholder="reference" name="reference" />
                            <input type="hidden" class="" id="email" placeholder="email" name="email" />
                            <input type="hidden" class="" id="callback_url" placeholder="callback_url" name="callback_url" value="{{url('/callback')}}" />


                        </div>

                        <input type="submit" class="btn btn-primary  ml-20 " id="withdrawNow" style="cursor: pointer" value="Withdraw" onclick="#">
                    </div>
                    <br />
                    <table>
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Amount</th>


                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>Available Balance</td>
                                <td class="whitespace-nowrap" id="available_wallet_balance">500</td>
                            </tr>

                            <tr>
                                <td>Withdraw Amount</td>
                                <td class="whitespace-nowrap" id="amount2withdraw">100</td>
                            </tr>

                            <tr>
                                <td>Withholding Tax</td>
                                <td class="whitespace-nowrap" id="withholding_tax2">-20</td>
                            </tr>

                            <tr>
                                <td>Withdraw Fee</td>
                                <td class="whitespace-nowrap" id="withdraw_fee">-16</td>
                            </tr>

                            <tr>
                                <td>Disbursed Amount</td>
                                <td class="whitespace-nowrap" id="disbursed_amount">64</td>
                            </tr>



                        </tbody>
                    </table>
                    <div class="flex justify-end items-center mt-8">
                        <button type="button" class="btn btn-outline-danger" id="closeWithdraw">Discard</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div id="select_bank_modal" class="modal">
    <!-- button -->

    <!-- modal -->
    <div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto" :class="open && '!block'" id="loginModal">
        <div class="flex items-start justify-center min-h-screen px-4" @click.self="open = false">
            <div x-show="open" x-transition x-transition.duration.300 class="panel border-0 py-1 px-4 rounded-lg overflow-hidden w-full max-w-sm my-8">
                <div class="flex items-center justify-between p-5 font-semibold text-lg dark:text-white">Bank Details
                    <span class="flex-right cursor-pointer" id="close_bank_login">X</span>
                </div>
                <div class="p-5">
                    <form method="POST" id="bank_details_form" role="form">
                        {{csrf_field()}}


                        <div class="relative mb-4">
                            <input type="text" placeholder="Amount" id="amount_value" style="display:none" name="amount" readonly class="form-input ltr:pl-10 rtl:pr-10" />

                            <input type="text" placeholder="Amount" id="user_amount" style="display:none" name="user_amount" readonly class="form-input ltr:pl-10 rtl:pr-10" />


                            <input type="number" placeholder="Account Number" id="account_number" name="account_number" required class="form-input ltr:pl-10 rtl:pr-10" />
                        </div>
                        <div class="relative mb-4 ">


                            <select id="bankSelect" name="bank_code" class="form-input ltr:pl-10 rtl:pr-10 sel_bank" required>
                                <!-- Placeholder option -->
                                <option value="">Select a bank</option>
                                <!-- <option selected value="011">First Bank</option> -->
                            </select>
                        </div>
                        <!-- <button type="button" class="btn btn-primary w-full">Login</button> -->
                        <input type="submit" id="verifyBtn" class="btn btn-primary w-full" style="cursor: pointer" value="Verify">
                    </form>
                    <form method="POST" id="initiate_form" role="form">
                        {{csrf_field()}}
                        <div class="relative mb-4 ">
                            <!-- <span id="amountSpan" style="display:none" >Amount: </span> -->
                            <input type="number" placeholder="Amount" id="amount_value" style="display:none" name="amount" readonly class="form-input ltr:pl-10 rtl:pr-10" />
                            <input type="number" placeholder="Amount" id="user_amount" style="display:none" name="user_amount" readonly class="form-input ltr:pl-10 rtl:pr-10" />
                            <input type="text" placeholder="account_name" id="account_name" style="display:none" name="account_name" readonly class="form-input ltr:pl-10 rtl:pr-10" />
                            <input type="hidden" placeholder="reference2" id="reference2" name="reference" readonly class="form-input ltr:pl-10 rtl:pr-10" />
                            <input type="hidden" placeholder="recipient_code" id="recipient_code" name="recipient_code" readonly class="form-input ltr:pl-10 rtl:pr-10" />
                        </div>
                        <input type="submit" id="TransferBtn" class="btn btn-primary w-full" style="cursor: pointer; display:none" value="Proceed">

                    </form>

                    <form method="POST" id="verify" role="form">
                        {{csrf_field()}}
                        <div class="relative mb-4 ">



                        </div>
                        <input type="submit" id="initiateBtn" class="btn btn-primary w-full" style="cursor: pointer; display:none" value="Please waiting..." disabled>

                    </form>

                </div>
                </footer>
            </div>
        </div>
    </div>
</div>

</div>
</div>

<br />

<button id="toggle-sound"> <svg id="s_on" style="display: block;" fill="white" height="20px" width="30px" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 512 512">
        <g>
            <g>
                <g>
                    <path d="m444.8,76.8c-6.8-9-19.7-10.9-28.8-4.2-9.1,6.7-11,19.4-4.2,28.4 64.8,85.9 64.8,225.6 0,311.5-6.8,9-5.1,21.9 4.2,28.4 11.4,7.9 24.8,1.2 28.8-4.2 74.9-99.1 74.9-260.6 0-359.9v-1.42109e-14z" />
                    <path d="m394.7,143.2c-6.8-9-19.7-10.8-28.8-4.2-9.1,6.7-11,19.4-4.2,28.4 36.6,48.4 36.6,130.3 0,178.7-6.8,9-5,21.8 4.2,28.4 11.7,8.3 24.8,1.2 28.8-4.2 48.1-63.6 48.1-163.4 0-227.1z" />
                    <path d="m291.9,438.3l-144.2-112.4v-138.2l144.2-112.3v362.9 5.68434e-14zm-185.4-122.8h-54.3v-117.7h54.3v117.7zm194.7-300.2l-180.1,141.9h-89.5c-11.4,0-20.6,9.1-20.6,20.3v158.2c0,11.2 9.2,20.3 20.6,20.3h91.2l178.4,140.7c12.8,10.1 31.9,1.1 31.9-15.1v-451.2c0-16.2-19-25.3-31.9-15.1z" />
                </g>
            </g>
        </g>
    </svg>
    <svg id="s_off" style="display: none;" width="20px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M10.6 5L13 3V8M3 3L21 21M13 18V21L7 16H5C3.89543 16 3 15.1046 3 14V10C3 9.63571 3.09739 9.29417 3.26756 9" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
    </svg>

</button>

<!-- Audio Element -->
<audio id="sound-effect" src="/assets/betgain_sound.m4a" preload="auto"></audio>

<div id="pinModal" class="modal">
    <!-- button -->

    <!-- modal -->
    <div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto" :class="open && '!block'" id="loginModal">
        <div class="flex items-start justify-center min-h-screen px-4" @click.self="open = false">
            <div x-show="open" x-transition x-transition.duration.300 class="panel border-0 py-1 px-4 rounded-lg overflow-hidden w-full max-w-sm my-8">
                <div class="flex items-center justify-between p-5 font-semibold text-lg dark:text-white">Enter Your Pin
                    <span class="flex-right cursor-pointer" id="closeWithdrawPin">X</span>
                </div>
                <div class="p-5">
                    <form method="POST" id="withdraw_pin" role="form">
                        {{csrf_field()}}


                        <div class="relative mb-4">
                            <input type="password" placeholder="PIN" id="wpin" style="display:block" name="pin" class="form-input ltr:pl-10 rtl:pr-10" />


                        </div>

                        <!-- <button type="button" class="btn btn-primary w-full">Login</button> -->
                        <input type="submit" id="SubmitPin" class="btn btn-primary w-full" style="cursor: pointer" value="Submit Pin">
                    </form>


                </div>
                </footer>
            </div>
        </div>
    </div>
</div>
</div>
</div>





<script>
    //display withdraw modal
    $("#withdrawBtn").click(function(event) {

        $("#withdrawModal").css("display", "block");
        var user_wallet_bal = $("#user_wallet_bal").val();
        $("#available_wallet_balance").text(user_wallet_bal);

    })

    //discard modal
    $("#closeWithdraw").click(function(event) {

        $("#withdrawModal").css("display", "none")

    })

    $("#closeWithdrawPin").click(function(event) {

        $("#pinModal").css("display", "none")

    })


    //display withdraw modal
    $("#withdrawNow").click(function(event) {
        var amount_pro = $("#withdrawing_amount").val();
        var amount_bal = $("#user_wallet_bal").val();
        if (Number.parseInt(amount_pro) > Number.parseInt(amount_bal)) {
            alert("Amount is more than balance ");
        } else {
            pinModal();

        }


    })



    function show_amount2withdraw(amt) {
        $("#amount2withdraw").text(amt);
        var tax_amt = ((amt * 80) / 100) - amt;
        var tax_amt3 = Math.ceil(tax_amt);
        const myElement = document.getElementById("withholding_tax2");
        const withdrawingAmount = document.getElementById('withdrawing_amount');
        const disbursedAmount = document.getElementById('disbursed_amount');

        myElement.innerHTML = tax_amt3;
        // $("#withholding_tax").text(tax_amt2);
        if (amt > 1000) {
            $("#withdraw_fee").text('-23');
            var withdraw_fee = -23;
        } else {
            $("#withdraw_fee").text('-16');
            var withdraw_fee = -16;
        }

        var disbursed_amount = Number.parseInt(amt) + Number.parseInt(tax_amt3) + Number.parseInt(withdraw_fee);
        // if (!Number(withdrawingAmount.value)){
        //     disbursedAmount.innerText = 0;
        // } else{
        $("#disbursed_amount").text(disbursed_amount);
        // }


    }

    async function select_bank_modal() {

        $("#select_bank_modal").css("display", "block");
        var amount_value = $("#disbursed_amount").text();
        var withdrawing_amount = $("#withdrawing_amount").val();

        $("#amount_value").val(amount_value + '.00');
        $("#user_amount").val(withdrawing_amount + '.00');
        loadbanks();

    }
    $(document).ready(function() {


        $("#close_bank_login").click(function(event) {
            $("#select_bank_modal").css("display", "none");

        })

    });

    async function pinModal() {

        $("#pinModal").css("display", "block");
        var wpin = $("#wpin").text();



        loadbanks();

    }
    $(document).ready(function() {
        $("#close_bank_login").click(function(event) {
            $("#select_bank_modal").css("display", "none");
        })

    });
</script>


<script>
    // to list banks  from DB
    function loadbanks() {
        var bankw = "/api/transfers/bank_list_within";
        $.ajaxSetup({

            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('user_token')
            },

        });
        $.getJSON(bankw, {

                format: "json",

            })
            .done(function(data) {
                const myJSON2 = JSON.stringify(data);

                // const data = JSON.parse(jsonString);
                const bankSelect = document.getElementById('bankSelect');

                // Iterate through the data array and create options
                data.data.forEach((bank) => {
                    const option = document.createElement('option');
                    option.value = bank.cbn_code;
                    option.textContent = bank.bank_name;
                    bankSelect.appendChild(option);
                });



            });
    };
</script>
<script>
    $("#bank_details_form").submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();
        console.log(formData);

        $.ajax({

            url: "{{ route('resolve_account') }}",

            type: "GET",
            dataType: "json",
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('user_token')
            },
            data: formData,
            success: function(data) {
                if (data.status == true) {
                    // alert(data.message);
                    $("#verifyBtn").css("display", "none");
                    $("#account_name").css("display", "block");
                    $("#account_name").val(data.gateway_response.account_name);
                    $("#recipient_code").val(data.recipient_code);
                    $("#reference2").val(data.reference);
                    $("#amountSpan").css("display", "block");
                    $("#amount_value").css("display", "block");
                    // $("#TransferBtn").css("display", "block");
                } else {
                    login_failed_alert();
                }
                console.log(data);
            }
        });

    })
</script>
<script>
    $("#initiate_form").submit(function(event) {
        event.preventDefault();
        //alert(312)
        $("#password").css("display", "block");
        $("#initiateBtn").css("display", "block");

        $("#TransferBtn").css("display", "none");
        var formData = $(this).serialize();
        console.log(formData);
        var amount = $("#amount_value").val();

        var recipient_code = $("#recipient_code").val()
        var reference = $("#reference2").val()

        $.ajax({

            url: "{{ route('initiate_transfer') }}",
            type: "POST",
            dataType: "json",
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('user_token')
            },
            data: {
                "amount": amount,
                "recipient_code": recipient_code,
                "reference": reference
            },
            success: function(data) {
                //     alert(data);
                if (data.status == true) {
                    alert(data.message);
                    location.reload();



                    $("#initiateBtn").css("display", "block");
                    //    $("#amount_value").css("display", "block");
                    //    $("#TransferBtn").css("display", "block");

                } else {
                    alert('2' + data.message);

                }
                //  console.log(data);
            }
        });

    })
</script>

<script>
    $("#bank_details_form").submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();
        console.log(formData);

        $.ajax({
            url: "{{ route('resolve_account') }}",
            type: "GET",
            dataType: "json",
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('user_token')
            },
            data: formData,
            success: function(data) {
                if (data.status == true) {
                    // alert(data.message);
                    $("#verifyBtn").css("display", "none");
                    $("#account_name").css("display", "block");
                    $("#account_name").val(data.gateway_response.account_name);
                    $("#recipient_code").val(data.recipient_code);
                    $("#reference2").val(data.reference);
                    $("#amountSpan").css("display", "block");
                    $("#amount_value").css("display", "block");
                    $("#TransferBtn").css("display", "block");
                } else {
                    login_failed_alert();

                }
                console.log(data);
            }
        });

    })
</script>



<script>
    // check if pin correct
    $("#withdraw_pin").submit(function(event) {
        event.preventDefault();
        // alert(366)
        var formData = $(this).serialize();
        console.log(formData);
        var wpin = $("#wpin").val()


        $.ajax({

            url: "{{ route('check_wpin') }}",

            type: "POST",
            dataType: "json",
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('user_token')
            },
            data: {
                "wpin": wpin,
                "user_id": localStorage.getItem('user_id'),

            },
            success: function(data) {

                if (data.status == true) {
                    $("#pinModal").css("display", "none");

                    select_bank_modal();
                } else if (data.status == false) {
                    alert('Invalid Pin');
                    pin_msg('Invalid Pin')

                }
                console.log(data);
            }
        });

    })
</script>

<script>
    document.getElementById("verify").addEventListener("submit", async function(event) {
        event.preventDefault();
        var reference2 = $("#reference2").val()
        var password2 = $("#password").val()
        var user_id8 = localStorage.getItem('user_id');

        const formData = new FormData(event.target);
        const approval = "/transfer_approval/" + reference2;
        try {
            const response = await fetch('/api/transfers/verify/' + reference2 + '/' + password2 + '/' + user_id8, {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                }).then(response => {
                    if (!response.ok) {
                        //  console.log(response.message)
                        console.log(1);
                        console.log(response)
                        throw new Error('Error');
                    }
                    return response.text();

                    console.log(response)
                })
                .then(data => {
                    // Handle the API response here
                    console.log(3);
                    alert("Transfer Successful");

                    location.replace(approval)
                    //  alert(data); // Display the response in an alert
                });

            if (response.ok) {
                const responseData = await response.json();
                console.log(4);
                console.log(responseData.message);
                alert(responseData.message);
                // alert('reload1');


            } else if (response.status === 500) {
                const errors = await response.json();
                alert('4' + responseData.message);
                //alert('reload2');
                console.log("Validation errors:", errors.message);
            }
        } catch (error) {
            //alert('No money to transfer');
            //location.reload();
            // console.error('Error:', error);
        }
    });
</script>


<script>
    async function pin_msg(msg) {
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