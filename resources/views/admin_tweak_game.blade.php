<x-layout.default>


    <script src="/assets/js/simple-datatables.js"></script>
    @include('admin_nav')
    <!-- progress table -->
    <div class="pb-16 lg:pb-10">
        <br />
        <br />
        <!-- form row -->

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

                        <th>Settings ID</th>
                        <th>Name</th>
                        <th>Value</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($settings as $setting)
                    <tr>
                        <td>{{ $setting->id }}</td>
                        <td class="whitespace-nowrap">{{ $setting->name }}</td>
                        <form action="{{ route('update_settings') }}" id="UpdateForm" method="POST">
                            @csrf
                            <td>
                                <div>
                                    <div>
                                        <input type="hidden" name="id" placeholder="Enter Value" value="{{ $setting->id }}" class="form-input lg:col-span-4" />

                                        <input type="text" name="value" placeholder="Enter Value" value="{{ $setting->value }}" class="form-input lg:col-span-4" />
                                    </div>
                                </div>
                            </td>

                            <td class="p-3 border-b border-[#ebedf2] dark:border-[#191e3a] text-center">
                                @if((auth('admin')->user()->admin_role == "superadmin") || (auth('admin')->user()->admin_role == "manager") )
                                <button type="submit" x-tooltip="Update">
                                    [Update]
                                </button>
                                @endif
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
    <script></script>


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