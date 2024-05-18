<style>
    /* Hide scrollbar for Chrome, Safari and Opera */
    .table-responsive::-webkit-scrollbar {
        display: none;
    }

    /* Hide scrollbar for IE, Edge and Firefox */
    .table-responsive {
        -ms-overflow-style: none;
        /* IE and Edge */
        scrollbar-width: none;
        /* Firefox */
    }
</style>

<div class="panel h-full overflow-auto">

    <div class="flex items-center mb-5">
        <h5 class="font-semibold text-lg dark:text-white-light">History</h5>
    </div>
    <div>
        <div class="table-responsive " style="height: 400px; overflow: auto;">
            <table id='data-table'>
                <thead>
                    <tr>
                        <th class="ltr:rounded-l-md rtl:rounded-r-md">Users</th>


                        <th>Bust</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Round</th>
                        <th>Hash</th>

                    </tr>
                </thead>
                <tbody style="color:whitesmoke" id="recent_history" style="overflow: auto">

                </tbody>
            </table>
        </div>
    </div>
</div>




<script>
    $(document).ready(function() {

        function fetchMessages() {
            $.get('/messages', function(messages) {
                messages = messages.toReversed();
                $('#messages').empty();
                console.log(messages);
                messages.forEach(function(message) {
                    $('#messages').append('<div><strong>' + message.username + ':</strong> ' + message.message + '</div>');
                });
                $('.perfect-scrollbar').scrollTop($('.perfect-scrollbar')[0].scrollHeight);
            });
        }

        $('#sendButton').click(function() {
            var message = $('#messageInput').val();
            var csrftoken = $('#csrfTokenTextbox').val();
            $.post('/messages', {
                message: message,
                _token: csrftoken
            }, function() {
                $('#messageInput').val('');
                fetchMessages();
            });
        });

        fetchMessages();

        function fetchRecentHistory() {

            var statusa;
            $.get('/recent_history/recents', function(recent_historys) {

                $('#recent_history').empty();
                recent_historys.forEach(function(recent_history) {
                    if (recent_history.statusa == 'none') {
                        statusa = 'New';
                    } else {
                        statusa = recent_history.statusa;
                    }
                    $('#recent_history').append('<tr><td>' + recent_history.user.username + '</td><td>' + recent_history.bet + 'x</td><td>' + recent_history.stake_amount + '</td><td>' + statusa + '</td><td>' + recent_history.game_id + '</td><td>' + recent_history.hash + '</td></tr>')
                });

            });
        }
        fetchRecentHistory();

    });
</script>

<script>
    //get csrf token to textboxs
    document.addEventListener("DOMContentLoaded", function() {
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        document.getElementById('csrfTokenTextbox').value = csrfToken;
    });
</script>