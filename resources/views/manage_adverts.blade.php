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
          <h1 class="text-lg mb-1 sm:mb-0">Manage Adverts</h1>
          @if((auth('admin')->user()->admin_role == "superadmin") || (auth('admin')->user()->admin_role == "manager") ) <a href="{{route('manageAdvertsAdd')}}"> <button type="button" class="btn btn-success w-4/4 ">Add New Advert</button></a>
          @endif
          <div class="sm:w-1/2 form-input flex items-center p-0">
            <input type="text" placeholder="Enter Company name" class="form-input rounded-r-none" />
            <button type="button" class="btn btn-primary w-1/4 rounded-l-none">Search</button>
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
              <th>Company</th>
              <th>product Name</th>
              <th>Image</th>
              <th>link</th>
              <th>Title</th>
              <th>Email address</th>
              <th>Active</th>
              <th>No of Clicks</th>
              <th>Start Date</th>
              <th>End Date</th>
              <th>Position</th>
              <th>Amount</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            @php $i =0; @endphp
            @foreach ($adverts as $advert)
            <tr>
              <td>{{ ++$i }}</td>

              <td>{{$advert->company_name}}</td>
              <td>{{$advert->product_name}}</td>
              <td> <img src="../../{{$advert->image}}" alt="Image" width="300" /></td>
              <td>{{$advert->link}}</td>
              <td>{{$advert->title}}</td>
              <td>{{$advert->email}}</td>
              <td>{{$advert->is_active}}</td>
              <td>{{$advert->no_click}}</td>
              <td>{{$advert->start_date}}</td>
              <td>{{$advert->end_date}}</td>
              <td>{{$advert->position}}</td>
              <td>₦{{number_format($advert->amount)}}</td>
              <td class="p-3 border-b border-[#ebedf2] dark:border-[#191e3a] text-center">
                @if((auth('admin')->user()->admin_role == "superadmin") || (auth('admin')->user()->admin_role == "manager") )
                <form action="{{ route('deleteAdverts') }}?Advert_id={{$advert->id}}" id="DeleteForm" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="button" @click="DeleteChat()" x-tooltip="Delete">
                    [Delete]
                  </button>

                  <a href="{{ route('Advert_edit',  ['advert_id'=>$advert->id]) }}"><button type="button" x-tooltip="Edit">
                      [Edit]
                    </button></a>
                </form>
                @endif
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
            swalWithBootstrapButtons.fire('Deleted!', 'Advert has been deleted.', 'success');
          } else if (result.dismiss === window.Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire('Cancelled', 'Advert is safe :)', 'error');
          }
        });
    }
  </script>