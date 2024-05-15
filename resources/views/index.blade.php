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



            @include('referral_reg')


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

<script>
    $.getJSON('http://ip-api.com/json', {}).done(function(data) {

            const myJSON2 = JSON.stringify(data);
            //alert(myJSON2);
            var ip_address = data.query;
            localStorage.setItem('ip_address', ip_address);

            var city = data.city;
            localStorage.setItem('city', city);

            var region = data.region
            localStorage.setItem('region', region);

            var country = data.country
            localStorage.setItem('country', country);

            var nework_provider = data.isp
            localStorage.setItem('nework_provider', nework_provider);

        }).done(function() {
            // alert('getJSON request succeeded!');
        })
        .fail(function(jqXHR, textStatus, errorThrown) {

        })
        .always(function() {
            // alert('getJSON request ended!');
        });



    const apiUrl = '/api/visitor';
    const postData = {
        "city": localStorage.getItem('city'),
        "ip_address": localStorage.getItem('ip_address'),
        "region": localStorage.getItem('region'),
        "country": localStorage.getItem('country'),
        "nework_provider": localStorage.getItem('nework_provider'),
    }

    // Create the fetch request
    fetch(apiUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(postData),
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json(); // Parse the JSON response
        })
        .then(data => {
            // Handle the API response data

            console.log('API response:', data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
</script>