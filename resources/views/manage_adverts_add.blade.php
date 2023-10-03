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
        <h1 class="text-lg mb-1 sm:mb-0">Add Adverts</h1>

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
      <form method="POST" action="{{route('store_advert')}}" enctype="multipart/form-data" role="form">
        {{csrf_field()}}
        <div class="grid grid-cols-1 mb-1 md:grid-cols-3 lg:grid-cols-4 gap-0">
          <label>Company name:*</label>
        </div>
        <div class="grid grid-cols-1 mb-3 md:grid-cols-3 lg:grid-cols-4 gap-2">

          <input type="text" name="company_name" required placeholder="Company Name" class="form-input lg:col-span-2" />
        </div>

        <div class="grid grid-cols-1 mb-1 md:grid-cols-3 lg:grid-cols-4 gap-0">
          <label>Product name:</label>
        </div>
        <div class="grid grid-cols-1 mb-3 md:grid-cols-3 lg:grid-cols-4 gap-2">

          <input type="text" name="product_name" placeholder="Optional" class="form-input lg:col-span-2" />
        </div>


        <div class="grid grid-cols-1 mb-1 md:grid-cols-3 lg:grid-cols-4 gap-0">
          <label>Start Date:</label>
        </div>
        <div class="grid grid-cols-1 mb-3 md:grid-cols-3 lg:grid-cols-4 gap-2">

          <input type="date" name="start_date" placeholder="Optional" class="form-input lg:col-span-2" />
        </div>
        <div class="grid grid-cols-1 mb-1 md:grid-cols-3 lg:grid-cols-4 gap-0">
          <label>End Date:</label>
        </div>
        <div class="grid grid-cols-1 mb-3 md:grid-cols-3 lg:grid-cols-4 gap-2">
          <input type="date" name="end_date" placeholder="Optional" class="form-input lg:col-span-2" />
        </div>

        <div class="grid grid-cols-1 mb-1 md:grid-cols-3 lg:grid-cols-4 gap-0">
          <label>Advert Image:*</label>
        </div>
        <div class="grid grid-cols-1 mb-3 md:grid-cols-3 lg:grid-cols-4 gap-2">
          <input type="file" required name="image" placeholder="Optional" class="form-input lg:col-span-2" />
        </div>
        <div class="grid grid-cols-1 mb-1 md:grid-cols-3 lg:grid-cols-4 gap-0">
          <label>Link to go when clicked:</label>
        </div>
        <div class="grid grid-cols-1 mb-3 md:grid-cols-3 lg:grid-cols-4 gap-2">
          <input type="text" name="link" placeholder="Optional" class="form-input lg:col-span-2" />
        </div>
        <div class="grid grid-cols-1 mb-1 md:grid-cols-3 lg:grid-cols-4 gap-0">
          <label>Email that will see report:</label>
        </div>
        <div class="grid grid-cols-1 mb-3 md:grid-cols-3 lg:grid-cols-4 gap-2">
          <input type="email" name="email" placeholder="Optional" class="form-input lg:col-span-2" />
        </div>

        <div class="grid grid-cols-1 mb-1 md:grid-cols-3 lg:grid-cols-4 gap-0">
          <label>Amount:</label>
        </div>
        <div class="grid grid-cols-1 mb-3 md:grid-cols-3 lg:grid-cols-4 gap-2">
          <input type="amount" name="amount" placeholder="Optional" class="form-input lg:col-span-2" />
        </div>
        <div class="grid grid-cols-1 mb-1 md:grid-cols-3 lg:grid-cols-4 gap-0">
          <label>Position (Select Order of arrangment):</label>
        </div>
        <div class="grid grid-cols-1 mb-3 md:grid-cols-3 lg:grid-cols-4 gap-2">
          <select name="position" class="form-select text-white-dark ">

            <option selected value="1">First</option>
            <option value="2">Second</option>
            <option value="3">Third</option>
            <option value="4">Forth</option>
            <option value="5">Fifth</option>
          </select>
        </div>


        <div>
          <label class="flex items-center cursor-pointer">
            <input type="checkbox" name="is_active" class="form-checkbox" checked />
            <span class=" text-white-dark">Is Ative</span>
          </label>
        </div>



        <button type="submit" class="btn btn-primary mt-6">Submit</button>
      </form>
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