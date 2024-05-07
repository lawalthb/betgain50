<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
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

    #moving-image {
        position: absolute;
        top: 350px;
        left: 0;
        width: 100px;
        height: 150px;
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

    #videoContainer {
        position: relative;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }

    #videoBg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: -1;
    }

    .content {
        position: relative;
        z-index: 1;
        /* Additional styling for your content */
    }

    /* Define the keyframes for the animation */
    @keyframes shake {
        0% {
            transform: translateX(0);
        }

        25% {
            transform: translateX(-1px) rotate(-5deg);
        }

        50% {
            transform: translateX(1px) rotate(5deg);
        }

        75% {
            transform: translateX(-1px) rotate(-5deg);
        }

        100% {
            transform: translateX(0);
        }
    }


    /* Apply the animation to the div */
    .animatedBackground {

        animation: shake 0.5s ease-in-out infinite;
        /* Change '3s' to adjust the duration of the animation */
    }

    .crashed {
        font-size: 50px;
        margin-top: 50px;

        @media only screen and (max-width: 768px) {

            font-size: 30px;
        }
    }

    .money {
        margin-left: 250px;
        margin-top: 25px;
        font-size: 20px;
        color: orangered;
        font-weight: bolder;

        @media only screen and (max-width: 768px) {

            margin-left: 100px;
        }
    }
</style>

<style>
    .container {
        position: relative;
        width: 800px;
        height: 450px;
        /* border: 1px solid #ccc; */
        overflow: hidden;

        top: -200px;
        /* Adjust this value to move the container from the top */
        left: -270px;
        /* Adjust this value to move the container from the left */
        /* or */
        /* Ensures rocket doesn't fly out of bounds */
    }

    .rocket {
        position: absolute;
        width: 150px;
        height: 200px;
        /* background-color: #f00; */
        bottom: -150px;
        left: -80px;
        display: none;

        /* Initially hidden */
        @media only screen and (max-width: 768px) {}
    }

    @keyframes fly {
        to {
            transform: translate(750px, -350px);
        }


    }
</style>
<div class="panel h-[260px] xl:h-[500px] xl:col-span-2 " id="gp-bg" style="background-image: url({{url('assets/images/betgain.gif')}}); background-position: center; background-repeat: no-repeat; background-size: contain; ">
    <div class=" child "><span id="point">0.0x</span><br /><span class="money ;" id="money" style="display: none;">#0</span>
        <div class="container">
            <div class="rocket"><img src="{{'assets/rocket5.png'}}" alt="Moving Image"></div>

            <span id="timer" style="display: none; color:yellow ; " class="crashed">Crashed!</span>
        </div>

    </div>

    <div class="flex items-center dark:text-white-light mb-2 xl:mb-5" id="congrat">

        <div x-data="dropdown" @click.outside="open = false" class="dropdown ltr:ml-auto rtl:mr-auto">

            <a href="javascript:" @click="toggle">
                <svg class="w-5 h-5 text-black/70 dark:text-white/70 hover:!text-primary" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="5" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                    <circle opacity="0.5" cx="12" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                    <circle cx="19" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                </svg>
            </a>

            <!-- <ul x-cloak x-show="open" x-transition x-transition.duration.300ms class="ltr:right-0 rtl:left-0">
                <li><a href="javascript:" @click="toggle" onclick="bg_heros1();">background 1</a></li>
                <li><a href="javascript:" @click="toggle" onclick="bg_heros2();">background 2</a></li>
                <li><a href="javascript:" @click="toggle" onclick="bg_heros3();">background 3</a></li>
                <li><a href="javascript:" @click="toggle" onclick="bg_heros4();">background 4</a></li>
            </ul> -->
        </div>
    </div>

    <div id="busted" class='text-center'></div>
    <h3 id="count-down" class='text-center'></h3>


    <div class="relative parent take-out-graph" style="display: block; opacity: 0.8; height: 493px; margin-top:-55px">

        <div id="videoContainer">
            <video autoplay muted loop id="videoBg">
                <source src="{{asset('videos/vbg2.mp4')}}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <!-- Your content here -->
            <div class="content">
                <div id="rocket2" style="background-position-x: 2%; background-position-y: 100%;">
                    <!-- <img id="moving-image" src="{{'assets/rocket2.png'}}" alt="Moving Image"> -->

                </div>

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