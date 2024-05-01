<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

<script>
  // Enable pusher logging - don't include this in production
  Pusher.logToConsole = true;

  var pusher = new Pusher('87892ed076b91483ee2a', {
    cluster: 'mt1'
  });
  var channel = pusher.subscribe('game');
  channel.bind('pusher:subscription_succeeded', function(e) {
   // alert('successfully subscribed!');
  });
</script>
<!-- var channel = pusher.subscribe('my-channel');
channel.bind('my-event', function(data) {
//alert("pusher is here")
$("#send_chat").show();
var chat = data.text;
var username = data.name;

var point = data.point;
var amount = data.amount;
var name2 = data.username;
//alert(name2+amount+point);
if (name2 != 0) {

//$('#history').text('update history');
$('.history').append('<table>
  <tr class="text-white-dark hover:text-black dark:hover:text-white-light/90 group">
    <td class="min-w-[150px] text-black dark:text-white">
      <div class="flex items-center"><img class="w-8 h-8 rounded-md ltr:mr-3 rtl:ml-3 object-cover" src="/assets/images/profile-6.jpeg" alt="avatar" /><span class="whitespace-nowrap">' + name2 + '</span></div>
    </td>
    <td class="text-primary">' + point + '</td>
    <td>₦' + amount + '</td>
    <td>5a99c4f92360bb238d02e1cfdccb62aaf875d988b1f6f85a0fe34d8124bcf593</td>
  </tr>
</table>');
$('.table-responsive').scrollTop($('.table-responsive')[0].scrollHeight);
$('#play').prop('disabled', false);
$('#play').text('Play');
} else {
$('.chats').append('<div class="flex items-center py-1.5 relative group ">
  <div class="flex items-center"><img class="w-8 h-8 rounded-md ltr:mr-3 rtl:ml-3 object-cover" src="/assets/images/profile-6.jpeg" alt="avatar" /> <span class="whitespace-nowrap">' + username + ': </span></div>
  <div class="flex-1">' + chat + '</div>
  <div class="ltr:ml-auto rtl:mr-auto text-xs text-white-dark dark:text-gray-500"> Just Now</div>
</div>');
$('#chats').val('');
$('.perfect-scrollbar').scrollTop($('.perfect-scrollbar')[0].scrollHeight);
}



});
</script>

 -->