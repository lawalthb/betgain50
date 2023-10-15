<x-layout.default>
    <script defer src="/assets/js/apexcharts.js"></script>
    <input type="hidden" id="gt" class="float right" />
    <input type="hidden" id="gt2" class="float right" />
    @include('pusher_scripts')

    <div x-data="sales">


        <div class="pt-1 pb-4 xl:pb-0">

            <div class="grid xl:grid-cols-3 gap-3 xl:gap-6 mb-3 xl:mb-6">

                @include('gameplay')

                @include('playform')

                <div class="grid sm:grid-cols-2 xl:grid-cols-3 gap-6 mb-6">
                    @include('history')
                    @include('advert')
                    @include('public_chat')

                </div>

                @if(\Session::has('payment_msg'))

                <script>
                    alert('Money Added to Wallet Sucessfully');
                </script>
                @endif

            </div>



            @include('game_graph')




</x-layout.default>
<!-- modal to edit user profile -->

@include('edit_profile')
<!-- after profile update -->
@if(isset($_GET['logout']) and ($_GET['logout'] ==1))
<script>
    signout();
    //window.open("/", "_self");
</script>


@endif