<button type="button" disabled id="depositBtn" class="btn btn-success">Deposit</button>
<!-- The Modal -->
<div id="depositModal" class="modal">

    <div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto" :class="open && '!block'">
        <div class="flex items-start justify-center min-h-screen px-5 mt-5" @click.self="open = false">
            <div x-show="open" x-transition x-transition.duration.300 class="panel border-0 p-0 rounded-lg overflow-hidden my-2 w-full max-w-lg">
                <div class="flex bg-[#fbfbfb] dark:bg-[#121c2c] items-center justify-between px-5 py-3">
                    <div class="font-bold text-lg">Wallet Deposit</div>
                </div>
                <div class="p-4">
                    <div class="dark:text-white-dark/70  font-medium text-[#1f2937] px-4 sm:px-10">
                        <div>Amount <span>₦</span><br /></div>
                        <form method="POST" id="deposit_form" role="form">
                            {{csrf_field()}}

                            <div class="relative mb-4 mt-1">

                                <input type="number" class="form-input ltr:pl-10 rtl:pr-10" id="amount" placeholder="Amount" name="amount" required />
                                <input type="hidden" id="key" placeholder="key" name="key" value="{{env('PAYSTACK_KEY_PUBLIC')}}" />
                                <input type="hidden" id="reference" placeholder="reference" name="reference" />
                                <input type="hidden" id="email" placeholder="email" name="email" />
                                <input type="hidden" id="callback_url" placeholder="callback_url" name="callback_url" value="{{url('/callback')}}" />


                            </div>
                            <div class="relative items-center mb-4">
                                <div> Note: <BR />
                                    The minimum deposit required to get a bonus is NAIRA 300.
                                    Withdrawals will NOT be possible until the bonus is redeemed.<BR />
                                    See our bonus <a href="#" style="color:red"> term and conditions </a> for more information
                                </div>
                                <input type="submit" class="btn btn-primary  mt-2" id="depositPay" style="cursor: pointer" value="Deposit">
                            </div>
                        </form>
                    </div>
                    <div class="flex justify-end items-center mt-8">
                        <button type="button" class="btn btn-outline-danger" id="closeDeposit">Discard</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    dopositModal = document.getElementById('depositBtn')
    //display deposit modal
    $("#depositBtn").click(function(event) {

        $("#depositModal").css("display", "block")
        var ref = reff2(10, '1234567890ABCDEFGHIJKLMNOPQRSTUV');
        let user_email = localStorage.getItem('user_email');
        $('#email').val(user_email);
        $('#reference').val(ref);

        function reff2(len, arr) {
            let ans = '';
            for (let i = len; i > 0; i--) {
                ans += arr[(Math.floor(Math.random() * arr.length))];
            }

            return ans;
        }

    })
    //discard modal
    $("#closeDeposit").click(function(event) {

        $("#depositModal").css("display", "none");

    })
</script>


<script>
    $(document).ready(function() {

        $("#deposit_form").submit(function(event) {
            event.preventDefault();

            var amount = $('#amount').val();
            let token = $("input[name=_token]").val();;
            let user_id = localStorage.getItem('user_id');
            let user_email = localStorage.getItem('user_email');
            $('#email').val(user_email);
            let reference = $('#reference').val();;

            let callback_url = $('#callback_url').val();
            let phone = localStorage.getItem('user_phone');
            let key = $('#key').val();
            $('#depositPay').val("Please wait, Redirect...");
            $('#depositPay').prop('disabled', true);



            $.ajax({
                url: "{{ route('api_deposit') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                type: "POST",
                dataType: "json",
                data: {
                    'user_id': user_id,
                    'email': user_email,
                    'reference': reference,
                    '_token': token,
                    'callback_url': callback_url,
                    'phone': phone,
                    'amount': amount,

                },
                success: function(data) {
                    if (data.status == true) {
                        // alert(data.message);
                        //alert(data.transaction.reference);
                        var checkout_url = data.transaction.authorization_url;
                        deposit_successful_alert();
                        // window.open(checkout_url);
                        location.replace(checkout_url)

                    } else {
                        Deposit_failed_alert();

                    }
                    console.log(data);
                }
            });
            $("#depositModal").css("display", "none");
            $('#depositPay').val("Deposit");
            $('#depositPay').prop('disabled', false);
        });


        function reff(len, arr) {
            let ans = '';
            for (let i = len; i > 0; i--) {
                ans +=
                    arr[(Math.floor(Math.random() * arr.length))];
            }
            console.log(ans);
            return ans;
        }

    });
</script>

<script>
    async function deposit_successful_alert() {
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
            title: 'Deposit inProgress',
            padding: '2em',
            customClass: 'sweet-alerts',
        });
    }

    async function Deposit_failed_alert() {
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
            title: 'Deposit Fail',
            padding: '2em',
            customClass: 'sweet-alerts',
        });
    }
</script>