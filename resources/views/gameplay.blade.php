<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
<style>
    .parent {
        position: relative;
    }

    .child {
        position: absolute;
        top: 0px;
        left: 0px;
        z-index: 1;

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
            z-index: 0;
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


    .crash-text {
        font-size: 36px;
        color: red;
        font-weight: bold;
        text-shadow: 0 0 10px red;
        /* Initial shadow */
        animation: explode 0.5s ease-in-out forwards;
        /* Apply explosion animation */
    }
</style>

<style>
    .container {
        position: relative;
        top: 500px;

        left: -200px;

        @media only screen and (max-width: 768px) {
            top: 100px;

            left: -50px;

        }

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
        @media only screen and (max-width: 768px) {
            width: 70px;
            height: 100px;
            bottom: -80px;
            left: -80px;
        }
    }

    @keyframes fly {
        to {
            transform: translate(900px, -350px);
        }

    }

    .text_content {
        margin-left: 300px;
        margin-top: 200px;

        @media only screen and (max-width: 768px) {
            margin-left: 100px;
            margin-top: 50px;

        }
    }

    #point {
        margin-left: 250px;
        margin-top: 200px;
        font-size: 120px;
        font-weight: bold;
        color: violet;

        @media only screen and (max-width: 768px) {
            margin-left: 100px;
            margin-top: 100px;
            font-size: 50px;
            font-weight: bold;

        }
    }

    #timer {
        margin-left: 300px;
        margin-top: 200px;

        @media only screen and (max-width: 768px) {
            font-size: 30px;
            margin-left: 80px;
            margin-top: 100px;

        }
    }
</style>
<div class="panel h-[260px] xl:h-[500px] xl:col-span-2 " id="gp-bg" style="background-image: url({{url('assets/images/betgain.gif')}}); background-position: center; background-repeat: no-repeat; background-size: contain; ">
    <div class=" child  " class="text_content">

        <div class="container">
            <div class="rocket"><img src="{{'assets/rocket5.png'}}" alt=""></div>
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
                    <span id="timer" style="display: none; color:yellow ; " class=" crash-text">Crashed!</span>
                    <span id="point">0.0x</span><br /><span class="money ;" id="money" style="display: none;">#0</span>



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