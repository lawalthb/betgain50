<x-layout.default>


  <script src="/assets/js/simple-datatables.js"></script>
  @include('admin_nav')
  <!-- progress table -->
  <div class="pb-16 lg:pb-10">
    <br />
    <br />
    <!-- form row -->
    <form class="">
      <div class="sm:flex justify-between items-center ml-6">
        <h1 class="text-lg mb-1 sm:mb-0">Edit Profile</h1>

      </div>
      <br />
    </form>

    @if ($message = Session::get('success'))
    <!-- secondary -->
    <div class="flex items-center p-3.5 rounded text-secondary bg-secondary-light dark:bg-secondary-dark-light">
      <span class="ltr:pr-2 rtl:pl-2"><strong class="ltr:mr-1 rtl:ml-1">Message!</strong>{{ $message }}.</span>

    </div>
    @endif

    <div class="table-responsive ml-6">

      <!-- column sizing -->
      @foreach ($admin_details as $admin_detail)
      <form method="POST" action="{{route('update_admin_profile')}}" enctype="multipart/form-data" role="form">
        {{csrf_field()}}
        <div class="grid grid-cols-1 mb-1 md:grid-cols-3 lg:grid-cols-4 gap-0">
          <label>Email:*</label>
        </div>
        <div class="grid grid-cols-1 mb-3 md:grid-cols-3 lg:grid-cols-4 gap-2">

          <input type="text" name="email" required readonly class="form-input lg:col-span-2" value="{{$admin_detail->email}}" />
        </div>

        <div class="grid grid-cols-1 mb-1 md:grid-cols-3 lg:grid-cols-4 gap-0">
          <label>Admin Role:*</label>
        </div>
        <div class="grid grid-cols-1 mb-3 md:grid-cols-3 lg:grid-cols-4 gap-2">

          <input type="text" name="email" required readonly class="form-input lg:col-span-2" value="{{$admin_detail->admin_role}}" />
        </div>



        <div class="grid grid-cols-1 mb-1 md:grid-cols-3 lg:grid-cols-4 gap-0">
          <label>User name:</label>
        </div>
        <div class="grid grid-cols-1 mb-3 md:grid-cols-3 lg:grid-cols-4 gap-2">

          <input type="text" name="username" placeholder="username" value="{{$admin_detail->username}}" class="form-input lg:col-span-2" />
        </div>





        <div class="grid grid-cols-1 mb-1 md:grid-cols-3 lg:grid-cols-4 gap-0">
          <label>Phone Number:</label>
        </div>
        <div class="grid grid-cols-1 mb-3 md:grid-cols-3 lg:grid-cols-4 gap-2">
          <input type="text" value="{{$admin_detail->phone_number}}" name="phone_number" class="form-input lg:col-span-2" />
        </div>




        <div class="grid grid-cols-1 mb-1 md:grid-cols-3 lg:grid-cols-4 gap-0">
          <label>Old password <br /> (Leave blank if you are not changing password)</label>
        </div>
        <div class="grid grid-cols-1 mb-3 md:grid-cols-3 lg:grid-cols-4 gap-2">
          <input type="text" name="password" placeholder="Optional" class="form-input lg:col-span-2" />
        </div>

        <div class="grid grid-cols-1 mb-1 md:grid-cols-3 lg:grid-cols-4 gap-0">
          <label>New password <br /> (Leave blank if you are not changing password)</label>
        </div>
        <div class="grid grid-cols-1 mb-3 md:grid-cols-3 lg:grid-cols-4 gap-2">
          <input type="text" name="password_new" placeholder="Optional" class="form-input lg:col-span-2" />

          <input type="text" name="id" hidden value="{{$admin_detail->id}}" class=" form-input lg:col-span-2" />
        </div>



        <input type="text" name="password_hidden" hidden value="{{$admin_detail->password}}" class=" form-input lg:col-span-2" />
    </div>

    <button type="submit" class="btn btn-primary mt-6">Update</button>
    </form>
    @endforeach
  </div>

  </div>


  <!-- script -->
  <script>

  </script>


</x-layout.default>
<script>
  async function DeleteChat() {
    const swalWithBootstrapButtons = window.Swal.mixin({
      customClass: {
        popup: 'sweet-alerts',
        confirmButton: 'btn btn-secondary',
        cancelButton: 'btn btn-dark ltr:mr-3 rtl:ml-3',
      },
      buttonsStyling: false,
    });
    swalWithBootstrapButtons
      .fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true,
        padding: '2em',
      })
      .then((result) => {
        if (result.value) {
          document.getElementById("DeleteForm").submit();
          swalWithBootstrapButtons.fire('Deleted!', 'Chat has been deleted.', 'success');
        } else if (result.dismiss === window.Swal.DismissReason.cancel) {
          swalWithBootstrapButtons.fire('Cancelled', 'Chat is safe :)', 'error');
        }
      });
  }
</script>