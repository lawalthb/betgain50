<div class="dropdown" x-data="dropdown" @click.outside="open = false">
    <!-- basic -->
    <div x-data="modal" id="wallet">


        <a href="javascript:;" title="Wallet" class="relative block p-2 rounded-full bg-white-light/40 dark:bg-dark/40 hover:text-primary hover:bg-white-light/90 dark:hover:bg-dark/60" @click="toggle">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M6 8H10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M22 10.5C22 10.4226 22 9.96726 21.9977 9.9346C21.9623 9.43384 21.5328 9.03496 20.9935 9.00214C20.9583 9 20.9167 9 20.8333 9H18.2308C16.4465 9 15 10.3431 15 12C15 13.6569 16.4465 15 18.2308 15H20.8333C20.9167 15 20.9583 15 20.9935 14.9979C21.5328 14.965 21.9623 14.5662 21.9977 14.0654C22 14.0327 22 13.5774 22 13.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                <circle cx="18" cy="12" r="1" fill="currentColor" />
                <path d="M13 4C16.7712 4 18.6569 4 19.8284 5.17157C20.6366 5.97975 20.8873 7.1277 20.965 9M10 20H13C16.7712 20 18.6569 20 19.8284 18.8284C20.6366 18.0203 20.8873 16.8723 20.965 15M9 4.00093C5.8857 4.01004 4.23467 4.10848 3.17157 5.17157C2 6.34315 2 8.22876 2 12C2 15.7712 2 17.6569 3.17157 18.8284C3.82475 19.4816 4.69989 19.7706 6 19.8985" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
            </svg>


        </a>

        <!-- modal -->
        <div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto" :class="open && '!block'">
            <div class="flex items-start justify-center min-h-screen px-5 mt-5" @click.self="open = false">
                <div x-show="open" x-transition x-transition.duration.300 class="panel border-0 p-0 rounded-lg overflow-hidden my-2 w-full max-w-lg">
                    <div class="flex bg-[#fbfbfb] dark:bg-[#121c2c] items-center justify-between px-5 py-3">
                        <div class="font-bold text-lg"> Transaction records</div>



                    </div>
                    <div class="p-2">
                        <div class="dark:text-white-dark/70 text-base font-medium text-[#1f2937]">
                            <div class="table-responsive " style="height: 400px; overflow: auto;">
                                Deposits
                                <table id='data-table'>
                                    <thead>
                                        <tr>
                                            <!-- <th class="ltr:rounded-l-md rtl:rounded-r-md">Users</th> -->


                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Reference</th>


                                        </tr>
                                    </thead>
                                    <tbody style="color:whitesmoke" id="recent_trans" style="overflow: auto">

                                    </tbody>
                                </table>


                                <br />
                                Withdraw
                                <table id='data-table'>
                                    <thead>
                                        <tr>
                                            <!-- <th class="ltr:rounded-l-md rtl:rounded-r-md">Users</th> -->


                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Bank name</th>

                                            <th>Status</th>
                                            <th>Reference</th>


                                        </tr>
                                    </thead>
                                    <tbody style="color:whitesmoke" id="recent_withdraw" style="overflow: auto">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="flex justify-end items-center mt-8">
                            <button type="button" class="btn btn-outline-danger" @click="toggle">Discard</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- script -->
    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("modal", (initialOpenState = false) => ({
                open: initialOpenState,

                toggle() {
                    this.open = !this.open;
                },
            }));
        });
    </script>


</div>
<div class="dropdown" x-data="dropdown" @click.outside="open = false">
    <!-- basic -->