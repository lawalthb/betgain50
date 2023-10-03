<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
    .parent {
        position: relative;

    }

    .child {
        /* ... */
        position: absolute;

        top: 200px;
        left: 300px;
        z-index: 1;
        font-size: 10rem
    }

    .apexcharts-svg,
    .chart-wrap {
        height: 325px;
    }

    @media only screen and (max-width: 767px) {
        .child {
            font-size: 5rem;
            left: 100px;
            top: 150px;
            height: 200px;
            z-index: 1;
        }

        .apexcharts-svg,
        .chart-wrap {
            height: 200px;
        }

        .take-out-graph {
            height: 100px;
        }
    }
</style>


<div class="panel h-[260px] xl:h-[500px] xl:col-span-2  " id="gp-bg" style="background-image: url({{url('assets/images/loader.png')}}); background-position: center; background-repeat: no-repeat; background-size: contain; ">
    <div class=" child "><span id="point">0.0</span></div>
    <div class="flex items-center dark:text-white-light mb-2 xl:mb-5" id="congrat">
        <h5 class="font-semibold text-sm xl:text-lg">Game Play</h5>
        <div x-data="dropdown" @click.outside="open = false" class="dropdown ltr:ml-auto rtl:mr-auto">

            <a href="javascript:" @click="toggle">
                <svg class="w-5 h-5 text-black/70 dark:text-white/70 hover:!text-primary" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="5" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                    <circle opacity="0.5" cx="12" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                    <circle cx="19" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                </svg>
            </a>

            <ul x-cloak x-show="open" x-transition x-transition.duration.300ms class="ltr:right-0 rtl:left-0">
                <li><a href="javascript:" @click="toggle" onclick="bg_heros1();">background 1</a></li>
                <li><a href="javascript:" @click="toggle" onclick="bg_heros2();">background 2</a></li>
                <li><a href="javascript:" @click="toggle" onclick="bg_heros3();">background 3</a></li>
                <li><a href="javascript:" @click="toggle" onclick="bg_heros4();">background 4</a></li>
            </ul>
        </div>
    </div>
    <p class="text-sm xl:text-lg dark:text-white-light/90">Maximum bet<span class="text-primary ml-2">₦10,840</span></p>
    <div id="busted" class='text-center'></div>
    <h3 id="count-down" class='text-center'></h3>


    <div class="relative parent take-out-graph" style="display: block; opacity: 0.8; height: 200px;">

        <div x-ref="revenueChart" class=" bg-white dark:bg-black rounded-lg h-0 chart-wrap ">

            <div class="min-h-[200px] h-[101px] grid place-content-center bg-white-light/30 dark:bg-dark dark:bg-opacity-[0.08] ">
                <span class=" animate-spin border-2 border-black dark:border-white !border-l-transparent rounded-full w-5 h-5 inline-flex"></span>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        var user_bg_hero = localStorage.getItem("user_bg_hero");

        $("#gp-bg").css("background-image", user_bg_hero);


    });

    function bg_heros1() {
        $("#gp-bg").css("background-image", "url({{url('assets/images/heros1.jpg')}})");
        var bg_heros = "url({{url('assets/images/heros1.jpg')}})";
        localStorage.setItem("user_bg_hero", bg_heros);
    }

    function bg_heros2() {
        $("#gp-bg").css("background-image", "url({{url('assets/images/heros2.jpg')}})");
        var bg_heros = "url({{url('assets/images/heros2.jpg')}})";
        localStorage.setItem("user_bg_hero", bg_heros);
    }

    function bg_heros3() {
        $("#gp-bg").css("background-image", "url({{url('assets/images/heros3.jpg')}})");
        var bg_heros = "url({{url('assets/images/heros3.jpg')}})";
        localStorage.setItem("user_bg_hero", bg_heros);
    }

    function bg_heros4() {
        $("#gp-bg").css("background-image", "url({{url('assets/images/heros4.png')}})");
        var bg_heros = "url({{url('assets/images/heros4.png')}})";
        localStorage.setItem("user_bg_hero", bg_heros);
    }
</script>