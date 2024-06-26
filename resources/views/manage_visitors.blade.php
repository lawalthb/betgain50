<x-layout.default>


  <script src="/assets/js/simple-datatables.js"></script>
  @include('admin_nav')
  <!-- progress table -->
  <div class="pb-16 lg:pb-10">
    <br />
    <br />

    <!-- form row -->
    <form class="" action="{{ route('search_user') }}" method="post">
      @csrf
      <div class="sm:flex justify-between items-center">
        <h1 class="text-lg mb-1 sm:mb-0">Visitors log</h1>

        <div class="sm:w-1/2 form-input flex items-center p-0">
          <!-- <input type="text" placeholder="Enter Username" name="username" class="form-input rounded-r-none" />
          <button type="submit" class="btn btn-primary w-1/4 rounded-l-none">Search</button> -->
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
            <th>IP Address</th>
            <th>City</th>
            <th>State</th>
            <th>Country</th>
            <th>Nework Provider</th>
            <th class="text-center">Date-time</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($visitors as $visitor)
          <tr>
            <td>{{ ++$i }}</td>
            <td class="whitespace-nowrap">{{ $visitor->ip_address }}</td>
            <td>
              <div>
                <div>{{ $visitor->city }}</div>
              </div>
            </td>
            <td>
              <div>
                <div>{{ $visitor->region }}</div>
              </div>
            </td>
            <td>
              <div>
                <div>{{ $visitor->country }}</div>
              </div>
            </td>
            <td>
              <div>
                <div>{{ $visitor->nework_provider }}</div>
              </div>
            </td>

            <td class="p-3 border-b border-[#ebedf2] dark:border-[#191e3a] text-center">

              <div>
                <div>{{ $visitor->created_at }}</div>
              </div>
            </td>
          </tr>
          @endforeach


        </tbody>
      </table>
      <br />
      {!! $visitors->links() !!}
    </div>
  </div>

  <!-- script -->
  <script>

  </script>


</x-layout.default>
<script>
  async function DeleteUser() {
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
          swalWithBootstrapButtons.fire('Deleted!', 'User has been deleted.', 'success');
        } else if (result.dismiss === window.Swal.DismissReason.cancel) {
          swalWithBootstrapButtons.fire('Cancelled', 'User is safe :)', 'error');
        }
      });
  }
</script>