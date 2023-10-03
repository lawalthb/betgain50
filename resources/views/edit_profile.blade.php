<div id="profileModal" class="modal">

  <div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto" :class="open && '!block'">
    <div class="flex items-start justify-center min-h-screen px-5 mt-5" @click.self="open = false">
      <div x-show="open" x-transition x-transition.duration.300 class="panel border-0 p-0 rounded-lg overflow-hidden my-2 w-full max-w-lg">
        <div class="flex bg-[#fbfbfb] dark:bg-[#121c2c] items-center justify-between px-5 py-3">
          <div class="font-bold text-lg text-white">Edit Profile</div>
        </div>
        <div class="p-4">
          <div class="dark:text-white-dark/70  font-medium text-[#1f2937] px-4 sm:px-10">

            <form method="POST" id="editprofile" action="{{route('edit_profile')}}" enctype="multipart/form-data" role="form">
              {{csrf_field()}}

              <div class="relative mb-4 mt-1">
                <div>Email<br /></div>
                <input type="email" name="email" class="form-input ltr:pl-10 rtl:pr-10" required id="upadate_email" disabled />
                <div>User name<br /></div>
                <input type="text" placeholder="Username" class="form-input ltr:pl-10 rtl:pr-10" required name="username" id="upadate_username" />
                <div>phone Number<br /></div>
                <input type="text" placeholder="phone" class="form-input ltr:pl-10 rtl:pr-10" required name="phone_number" id="upadate_phone_number" />
                <div>Photo<br /></div>
                <input type="file" id="photo" class="form-input ltr:pl-10 rtl:pr-10" name="image" />
                <input type="hidden" id="upadate_user_id" name="user_id" />
                <div>Password (leave it blank if you dont want to change it)<br /></div>
                <input type="text" id="password" class="form-input ltr:pl-10 rtl:pr-10" placeholder="Leave it blank to use same" name="password" />


              </div>
              <div class="relative items-center mb-4">

                <input type="submit" class="btn btn-primary  mt-2" style="cursor: pointer" value="Submit">
              </div>
            </form>
          </div>
          <div class="flex justify-end items-center mt-8">
            <button type="button" class="btn btn-outline-danger" id="closeprofile">Discard</button>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  dopositModal = document.getElementById('profileModal')
  //display deposit modal
  $("#openProfile").click(function(event) {

    $("#profileModal").css("display", "block")
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
  $("#closeprofile").click(function(event) {

    $("#profileModal").css("display", "none");

  })
</script>