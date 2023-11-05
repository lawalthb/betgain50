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
        <h1 class="text-lg mb-1 sm:mb-0">Edit Admin</h1>

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
      @foreach($admin_dts as $admin)
      <form method="POST" action="{{route('manage_admin_update')}}" role="form">
        {{csrf_field()}}
        <div class="grid grid-cols-1 mb-1 md:grid-cols-3 lg:grid-cols-4 gap-0">
          <label>Email:*</label>
        </div>
        <div class="grid grid-cols-1 mb-3 md:grid-cols-3 lg:grid-cols-4 gap-2">

          <input type="email" name="email" value="{{$admin->email}}" required class="form-input lg:col-span-2" />
        </div>

        <div class="grid grid-cols-1 mb-1 md:grid-cols-3 lg:grid-cols-4 gap-0">
          <label>Admin Role:*</label>
        </div>
        <div class="grid grid-cols-1 mb-3 md:grid-cols-3    lg:grid-cols-4 gap-2">
          <select name="admin_role" class="form-input lg:col-span-2">
            <option selected value="{{$admin->admin_role}}">{{$admin->admin_role}} </option>
            <option value="supervisor">Supervisor </option>
            <option value="manager">Manager </option>
            <option value="superadmin">Super Admin </option>
          </select>

        </div>



        <div class="grid grid-cols-1 mb-1 md:grid-cols-3 lg:grid-cols-4 gap-0">
          <label>User name:</label>
        </div>
        <div class="grid grid-cols-1 mb-3 md:grid-cols-3 lg:grid-cols-4 gap-2">

          <input type="text" name="username" placeholder="username" value="{{$admin->username}}" class="form-input lg:col-span-2" />
        </div>

        <div class="grid grid-cols-1 mb-1 md:grid-cols-3 lg:grid-cols-4 gap-0">
          <label>Phone Number:</label>
        </div>
        <div class="grid grid-cols-1 mb-3 md:grid-cols-3 lg:grid-cols-4 gap-2">
          <input type="text" value="{{$admin->phone_number}}" name="phone_number" class="form-input lg:col-span-2" />

          <input type="hidden" value="{{$admin->id}}" name="id" class="form-input lg:col-span-2" />


        </div>

        <div class="grid grid-cols-1 mb-1 md:grid-cols-3 lg:grid-cols-4 gap-0">
          <label>Is Active:*</label>
        </div>
        <div class="grid grid-cols-1 mb-3 md:grid-cols-3    lg:grid-cols-4 gap-2">
          <select name="is_active" class="form-input lg:col-span-2">
            <option selected value="{{$admin->is_active}}">{{$admin->is_active}} </option>
            <option value="Yes">Yes </option>
            <option value="No">No </option>

          </select>

        </div>


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