  <x-layout.default>


    <script src="/assets/js/simple-datatables.js"></script>
    @include('admin_nav')
    <!-- progress table -->
    <div class="pb-16 lg:pb-10">
      <br />
      <br />
      <!-- form row -->
      <form class="">
        <div class="sm:flex justify-between items-center">
          <h1 class="text-lg mb-1 sm:mb-0">Manage Admins</h1>
          <a href="{{route('manage_admin_add')}}"> <button type="button" class="btn btn-success w-4/4 ">Add New admin</button></a>
          <div class="sm:w-1/2 form-input flex items-center p-0">
            <!-- <input type="text" placeholder="Enter Company name" class="form-input rounded-r-none" />
            <button type="button" class="btn btn-primary w-1/4 rounded-l-none">Search</button> -->
          </div>
        </div>
        <br />
      </form>
      @if ($message = Session::get('success'))
      <!-- secondary -->
      <div class="flex items-center p-3.5 rounded text-secondary bg-secondary-light dark:bg-secondary-dark-light">
        <span class="ltr:pr-2 rtl:pl-2"><strong class="ltr:mr-1 rtl:ml-1">Message!</strong>{{ $message }}.</span>

      </div>
      @endif

      <div class="table-responsive">
        <table>
          <thead>
            <tr>
              <th>#</th>
              <th>Email</th>
              <th>Admin Name</th>
              <th>Phone</th>
              <th>Admin Role</th>
              <th>Date Join</th>

              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            @php $i =0; @endphp
            @foreach ($admin_list as $admin)
            <tr>
              <td>{{ ++$i }}</td>

              <td>{{$admin->email}}</td>
              <td>{{$admin->username}}</td>

              <td>{{$admin->phone_number}}</td>
              <td>{{$admin->admin_role}}</td>
              <td>{{$admin->date_join}}</td>

              <td class="p-3 border-b border-[#ebedf2] dark:border-[#191e3a] text-center">
                <form action="{{ route('deleteAdmin') }}?admin_id={{$admin->id}}" id="DeleteForm" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="button" @click="DeleteChat()" x-tooltip="Delete">
                    [Delete]
                  </button>

                  <a href="{{ route('Admin_edit',  ['admin_id'=>$admin->id]) }}"><button type="button" x-tooltip="Edit">
                      [Edit]
                    </button></a>
                </form>

              </td>
            </tr>
            @endforeach


          </tbody>
        </table>
        <br />

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
            swalWithBootstrapButtons.fire('Deleted!', 'Admin has been deleted.', 'success');
          } else if (result.dismiss === window.Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire('Cancelled', 'Admin is safe :)', 'error');
          }
        });
    }
  </script>