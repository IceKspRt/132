<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.5.8/swiper-bundle.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.5.8/swiper-bundle.min.js"></script>
</head>

<style>
    @font-face {
        font-family: "HelveticaNow";
        src: url(https://assets.codepen.io/5286152/HelveticaNowText-Regular.ttf);
    }

    .introcontainer {
        width: 100%;
        height: 100%;
        margin: auto;
    }

    .swiper-container {
        width: 100%;
        height: 100vh;
        background: rgb(10, 10, 11);
    }

    .swiper-slide {
        width: 500px;
        height: 100%;
        display: flex;
        margin: auto;
        align-items: center;
        justify-content: center;
        background: rgb(10, 10, 11);
    }

    .cards {
        width: 100%;
        height: auto;
        display: flex;
        position: relative;
        align-items: center;
        justify-content: center;
    }

    .card img {
        object-fit: cover;
        width: 600px;
        border-radius: 5px;
        max-width: 100%;
        height: auto;
        min-height: 50vh;
        padding: 0;
        margin: 0;
    }

    .card.two img {
        filter: sepia(100%) hue-rotate(190deg) saturate(300%);
    }

    .card.three img {
        height: 50vh;
    }

    .card.four img {
        filter: invert(4%) sepia(75%) saturate(500%) hue-rotate(356deg) brightness(70%) contrast(103%);
    }

    .text {
        display: flex;
        align-items: center;
        justify-content: center;
        position: absolute;
        bottom: 0px;
        max-width: 100%;
        width: 500px;

    }

    .title-box {
        display: flex;
        text-align: left;
        max-width: 100%;
        flex-direction: column;
        flex-wrap: nowrap;
        position: absolute;
        top: 0;
        left: 50%;
        right: 0 !important;
        bottom: 50px;
        justify-content: center;
        color: #fff;
        opacity: 0;
        z-index: 15;
    }

    .title-box h1 {
        display: block;
        font-family: "Futura";
        font-weight: 700;
        line-height: normal;
        max-width: 100%;
        font-size: 3vmin;
    }

    .title-box p {
        font-family: "HelveticaNow";
        font-size: 2vmin;
        padding-top: 0;
        margin: 0;
        padding-left: 1%;
        max-width: 100%;
    }

    .card .title-box .seperator {
        height: 1px;
        width: 10%;
        background: white;
        position: absolute;
        content: "";
        left: -15%;
        top: 50%;
    }

    .swiper-slide .title-box {
        transform: translateX(-50%);
        transition: all .7s ease .3s;
    }

    .swiper-slide-active .title-box {
        transform: translateX(0%);
        opacity: 1;
        transition: all .7s ease;
    }

    .swiper-scrollbar {
        background: white;
    }

    .swiper-slide .card img {
        transition: filter .7s ease;
        filter: grayscale(100%);
    }

    .swiper-slide-active .card img {
        filter: grayscale(0%) brightness(60%);
    }

    .swiper-pagination-bullet-active {
        background: white !important;
        width: 25px !important;
        height: 5px !important;
        border-radius: 0 !important;
    }

    .swiper-pagination-bullet {
        background: whitesmoke !important;
        width: 25px !important;
        height: 5px !important;
        border-radius: 0 !important;
    }

    .swiper-arrows {
        width: 100%;
        height: 80px;
        position: absolute;
        display: flex;
        justify-content: center;
        align-items: center;
        bottom: 50%;
    }

    .swiper-button-prev,
    .swiper-button-next {
        width: 80px !important;
        height: 80px;
        background-image: none !important;
        display: flex;
        align-items: center;
        justify-content: center;
        top: 0;
        bottom: 0;
        margin: 0;
        border-radius: 5px;
        transition: all 0.3s ease;
    }

    .swiper-button-prev {
        left: 0px !important;
        right: auto !important;
        background-color: rgba(255, 255, 255, 0.7);
    }

    .swiper-button-next {
        right: 0px !important;
        background-color: rgba(255, 255, 255, 0.8);
    }

    .swiper-button-prev span,
    .swiper-button-next span {
        width: 10px;
        height: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: transparent;
        position: absolute;
        border: solid 2px #666;
        border-left: 0;
        border-bottom: 0;
        transition: all 0.1s ease;
    }

    .swiper-button-prev span {
        transform: rotate(-135deg);
        left: 49%;
    }

    .swiper-button-next span {
        transform: rotate(45deg);
        right: 49%;
    }

    .swiper-button-prev:hover span,
    .swiper-button-next:hover span {
        width: 5px;
        height: 5px;
    }

    .swiper-button-prev:after,
    .swiper-button-next:after {
        width: 0px;
        height: inherit;
        content: "";
        position: absolute;
        border-radius: 5px;
        background-color: white;
        transition: all 0.4s ease-in-out;
        z-index: -1;
        opacity: 0.8;
    }

    .swiper-button-prev:after {
        right: 0;
    }

    .swiper-button-next:after {
        left: 0;
    }

    .swiper-button-prev:hover:after,
    .swiper-button-next:hover:after {
        width: inherit;
    }

    .swiper-button-disabled {
        opacity: 1 !important;
    }

    .swiper-button-disabled.swiper-button-prev span,
    .swiper-button-disabled.swiper-button-next span {
        opacity: 0.2;
    }

    @media screen and (max-width: 512px) {

        .swiper-button-prev,
        .swiper-button-next {
            width: 60px;
            height: 60px;
            bottom: 0;
        }

        .swiper-arrows {
            height: 60px;
        }

        .swiper-button-prev {
            right: 60px;
        }

        .swiper-button-prev span {
            left: 45%;
        }

        .swiper-button-next span {
            right: 45%;
        }
    }

    .swiper-button-next::after,
    .swiper-container-rtl .swiper-button-prev::after {
        content: "attr" !important;
    }

    .swiper-button-prev::after,
    .swiper-container-rtl .swiper-button-prev::after {
        content: "attr" !important;
    }
</style>

<body>
    <div class="introcontainer">
        <!-- Slider main container -->
        <div class="swiper-container">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->
                <div class="swiper-slide">
                    <div class="cards">
                        <div class="card ong">
                            <img src="https://assets.codepen.io/5286152/pexels-wendy-wei-1886641_1.jpg" />
                            <div class="text">
                            </div>
                            <div class="title-box">
                                <h1>CREATIVE COLLECTIVE.</h1>
                                <p>The future of the creative industry starts here, by Creatives, for Creatives.</p>
                                <div class="seperator"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="cards">
                        <div class="card two">
                            <img src="https://assets.codepen.io/5286152/BW-DJ.jpeg" alt="" />
                            <div class="text">
                            </div>
                            <div class="title-box">
                                <h1>FOR ARTISTS.</h1>
                                <p>Learn, grow, and develop your skills -- Access tools that accelerate your career and
                                    build your audience.</p>
                                <div class="seperator"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="cards">
                        <div class="card three">
                            <img src="https://assets.codepen.io/5286152/stephany-lorena-TZ1A9R_WzGs-unsplash.jpg"
                                alt="" />
                            <div class="text">
                            </div>

                            <div class="title-box">
                                <h1>FOR CREATIVES.</h1>
                                <p>Share, distribute, and promote your artwork. We showcase and highlight creativity,
                                    helping you find and connect with clients and your fans.</p>
                                <div class="seperator"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="cards">
                        <div class="card four">
                            <img src="https://assets.codepen.io/5286152/clark-van-der-beken-1KBCgRD8BDc-unsplash.jpg"
                                alt="" />
                            <div class="text">
                            </div>

                            <div class="title-box">
                                <h1>FOR DESIGNERS.</h1>
                                <p> We design your digital presence and collaborate to develop your ideas into engaging,
                                    interactive, art and visual experiences that keep you in control and in the
                                    spotlight.</p>
                                <div class="seperator"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="cards">
                        <div class="card three">
                            <img src="https://assets.codepen.io/5286152/stephany-lorena-TZ1A9R_WzGs-unsplash.jpg"
                                alt="" />
                            <div class="text">
                            </div>

                            <div class="title-box">
                                <h1>FOR CREATIVES.</h1>
                                <p>Share, distribute, and promote your artwork. We showcase and highlight creativity,
                                    helping you find and connect with clients and your fans.</p>
                                <div class="seperator"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- If we need pagination -->
            <div class="swiper-pagination"></div>

            <!-- If we need navigation buttons -->
            <div class="swiper-arrows">
                <div class="swiper-button-prev"><span></span></div>
                <div class="swiper-button-next"><span></span></div>
            </div>

            <!-- If we need scrollbar -->
        </div>
    </div>
    <script>
        const swiper = new Swiper('.swiper-container', {
            speed: 500,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            centeredSlides: true,
            paginationClickable: true,
            watchSlidesProgress: true,
            loop: true,
            slidesPerView: 2,
            spaceBetween: 30,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    </script>
</body>

</html>
