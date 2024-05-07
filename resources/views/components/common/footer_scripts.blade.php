<script>
    $(document).ready(function() {
        let userID = localStorage.getItem('user_id');
        //alert(userID);
        let username = localStorage.getItem('username');
        let user_email = localStorage.getItem('user_email');
        let user_role = localStorage.getItem('user_role');

        if (userID == null) {
            //if user have not login
            $("#userImage").hide();
            $("#faq").hide();
            $("#referral").hide();
            $("#wallet").hide();
            $("#play").hide();


        } else {
            //if user have  login
            $("#login").css("display", "none");
            $("#login_modal").hide();
            $("#login").hide();
            $(".show_user_name3").text(username);
            $(".user_email").text(user_email);
            $('#depositBtn').prop('disabled', false);
            $('#withdrawBtn').prop('disabled', false);
            load_user_balance();
            load_user_bonus();
            load_user_previous();
            var pageURL = window.location.href;
            var serverURL = `{{url('/admin')}}`;
            if (pageURL != serverURL && user_role == 'admin') {
                window.open("/admin", "_self");
            }



        }
        // alert();
        // to get all user record for profile page
        var user_id = localStorage.getItem('user_id');
        var user_token = localStorage.getItem('user_token');
        if (user_token != null && user_id != null) {

            $.ajax({
                url: "/api/auth/user-info/" + user_id,
                type: "GET",
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('user_token')
                },
                success: function(data) {
                    if (data.status == true) {
                        //alert(data.message)

                        // var cookies_date = new Date(Date.now() + 3);
                        // cookies_date = cookies_date.toUTCString();

                        // document.cookie = "user_email="+data.user.email+"; cookies_date";
                        // document.cookie = "user_phone ="+data.user.phone_number+"; cookies_date";
                    }
                }

            });
            console.log(data);
        }
    });
</script>

<script>
    // to list all previous chat from DB
    (function() {
        var chatList = "/api/chats/list";
        $.ajaxSetup({

            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('user_token')
            },

        });
        $.getJSON(chatList, {

                format: "json",

            })
            .done(function(data) {
                const myJSON = JSON.stringify(data);
                //alert(myJSON);
                var output = "<span>";

                $.each(data, function(key, value) {
                    output += '<div class="flex items-center py-1.5 relative group "><div class="flex items-center"><img class="w-8 h-8 rounded-md ltr:mr-3 rtl:ml-3 object-cover" src="/assets/images/profile-6.jpeg" alt="avatar" /> <span class="whitespace-nowrap">' + value.username + ': </span>    </div>  <div class="flex-1">' + value.message + '</div>   <div class="ltr:ml-auto rtl:mr-auto text-xs text-white-dark dark:text-gray-500">' + value.created_at + '</div>  </div>';


                });

                $('.chats').append(output);

                $('.perfect-scrollbar').scrollTop($('.perfect-scrollbar')[0].scrollHeight);
                output += "</span>";

            });
    })();
</script>



<script>
    // // to list all banks from DB
    // (function() {
    //     var bankw = "/api/transfers/bank_list_within";
    //     $.ajaxSetup({

    //         headers: {
    //             'Authorization': 'Bearer ' + localStorage.getItem('user_token')
    //         },

    //     });
    //     $.getJSON(bankw, {

    //             format: "json",

    //         })
    //         .done(function(data) {
    //             const myJSON = JSON.stringify(data);
    //             //alert(myJSON);
    //             var output = "";

    //             $.each(data, function(key, value) {
    //                 console.log(value);
    //                 output += '<option value="' + value.cbn_code + '"> ' + value.bank_name + '</option>';


    //             });

    //             $('#sel_bank').append(output);


    //             output += "";

    //         });
    // })();
</script>


<script>
    // to list all previous history from DB
    // (function() {
    //   var chatList = "/api/history/list";

    //   $.getJSON( chatList, {

    //     format: "json"
    //   })
    //     .done(function( data ) {
    //         const myJSON = JSON.stringify(data);
    //         //alert(myJSON);
    //         var output = "<span>";

    //     $.each(data, function(key, value) {
    //       output += '<table><tr class="text-white-dark hover:text-black dark:hover:text-white-light/90 group"><td class="min-w-[150px] text-black dark:text-white"><div class="flex items-center"><img class="w-8 h-8 rounded-md ltr:mr-3 rtl:ml-3 object-cover" src="/assets/images/profile-6.jpeg" alt="avatar" /><span class="whitespace-nowrap">'+value.username+'</span></div></td><td class="text-primary">'+value.bet_crash+'</td><td>₦'+value.bet_amount+'</td><td>5a99c4f92360bb238d02e1cfdccb62aaf875d988b1f6f85a0fe34d8124bcf593</td></tr></table>';


    //     });

    //     $('.history').append(output);

    // $('.table-responsive').scrollTop($('.table-responsive')[0].scrollHeight);
    //     output += "</span>";

    //     });
    // })();
</script>


<script>
    // to show current user balance from DB
    async function load_user_balance() {
        let userID2 = localStorage.getItem('user_id');
        var user_balance = "/api/transactions/user_balance/" + userID2;
        $.ajaxSetup({

            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('user_token')
            },

        });
        $.getJSON(user_balance, {}).done(function(data) {

                const myJSON2 = JSON.stringify(data);
                // alert(myJSON2)
                var balance = data.balance;
                //alert(balance);

                $("#gt").val(balance);

                function formatNumber(num) {
                    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
                }

                $('#user_wallet_bal').text(formatNumber(balance));


            }).done(function() {
                // alert('getJSON request succeeded!');
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                $('#user_wallet_bal').text('0.00');
                $("#gt").val(0);

            })
            .always(function() {
                // alert('getJSON request ended!');
            });
    };

    async function load_user_bonus() {
        let userID2 = localStorage.getItem('user_id');
        var user_balance = "/api/transactions/user_bonus/" + userID2;
        $.ajaxSetup({

            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('user_token')
            },

        });
        $.getJSON(user_balance, {}).done(function(data) {

                const myJSON2 = JSON.stringify(data);
                // alert(myJSON2)
                var balance = data.balance;
                //alert(balance);

                $("#gt2").val(balance);

                function formatNumber(num) {
                    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
                }

                $('#user_wallet_bonus').text(formatNumber(balance));


            }).done(function() {
                // alert('getJSON request succeeded!');
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                $('#user_wallet_bonus').text('0.00');
                $("#gt2").val(0);

            })
            .always(function() {
                // alert('getJSON request ended!');
            });
    };
</script>

<script>
    // to show current user balance from DB
    async function load_user_previous() {

        let userID4 = localStorage.getItem('user_id');
        var user_previous = "/api/previous_game/" + userID4;
        $.ajaxSetup({

            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('user_token')
            },

        });
        $.getJSON(user_previous, {}).done(function(data) {

                const myJSON2 = JSON.stringify(data);
                //   alert(myJSON2);
                var previous_point = data.bet_crash;

                var previous_amount = data.bet_amount;


                $("#previous_bet_point").text(previous_point);
                $("#previous_bet_amount").text(previous_amount);

            }).done(function() {
                // alert('getJSON request succeeded!');
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                //    $('#user_wallet_bal').text('0.00');
                //     $("#gt").val(0);

            })
            .always(function() {
                // alert('getJSON request ended!');
            });
    };




</script>