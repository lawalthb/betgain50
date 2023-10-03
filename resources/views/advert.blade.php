<div class="panel h-full">
    <div class="flex items-center justify-between dark:text-white-light mb-5">
        <h5 class="font-semibold text-lg">Advertise here</h5>
    </div>
    <div class="ads">


    </div>
</div>

<script>
    // to list all previous chat from DB
    (function() {
        var chatList = "/api/adverts";
        $.getJSON(chatList, {

                format: "json",

            })
            .done(function(data) {
                const myJSON = JSON.stringify(data);
                //alert(myJSON);
                var output = "<span>";

                $.each(data, function(key, value) {
                    output += '<a href="' + value.link + '" target="_blank"><img src = "' + value.image + '" alt = "advertise image" title="' + value.title + '" ></a>';
                });

                $('.ads').append(output);


                output += "</span>";

            });
    })();
</script>