<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instagram Post Section</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap">
    <style>
        /* CSS reset to ensure consistent styling */
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
        }

        .d {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: black;
            background-color: #FFF6EB;
            position: relative;
            z-index: 1;
            overflow: hidden;
        }

        .d::before {
            content: '';
            position: absolute;
            top: -5%;
            left: -5%;
            width: 110%;
            height: 110%;
            background-image: url('<?php echo FILE_ROOT; ?>/public/assets/images/bg-plain.png');
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            filter: blur(4px) brightness(80%);
            z-index: -1;
        }

        .d::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #D68421;
            background-image: linear-gradient(to bottom, rgba(255, 254, 252, 0) 50%, #FFF6EB 100%),
                linear-gradient(to top, rgba(255, 254, 252, 0) 80%, rgba(255, 157, 38, 1) 100%);
            z-index: -1;
        }

        /* Main container for the Instagram carousel section. */
        .insta-section {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;
            min-height: 800px;
            position: relative;
            background-color: var(--bg);
            font-family: "Montserrat", sans-serif;
            color: var(--text-primary);
            overflow: hidden;
        }

        /* Animation for the carousel slides */
        @keyframes insta-carousel-animate {
            0% {
                visibility: hidden;
                opacity: 0;
                transform: translateX(200%) scale(0.7);
            }

            4.2857142857%,
            14.2857142857% {
                visibility: visible;
                opacity: 0.8;
                transform: translateX(100%) scale(0.9);
            }

            18.5714285714%,
            28.5714285714% {
                visibility: visible;
                opacity: 1;
                transform: translateX(0) scale(1);
            }

            32.8571428571%,
            42.8571428571% {
                visibility: visible;
                opacity: 0.8;
                transform: translateX(-100%) scale(0.9);
            }

            47.1428571429% {
                visibility: visible;
                opacity: 0;
                transform: translateX(-200%) scale(0.9);
            }

            100% {
                visibility: hidden;
                opacity: 0;
                transform: translateX(-200%) scale(0.7);
            }
        }

        /* Root variables for theming and sizing */
        :root {
            --light: 0;
            --max-width-post: 330px;
            --primary: #FFF6EB;

            --bg: linear-gradient(to bottom, #e07b00ff 90%, #FFF6EB 100%);
            --text-primary: hsl(calc(60 * var(--light)),
                    calc(19% * var(--light)),
                    calc(97% - 89% * var(--light)));
            --font-size-sm: clamp(0.7rem, 0.91vw + 0.47rem, 1.2rem);
            --font-size-base: clamp(0.88rem, 1.14vw + 0.59rem, 1.5rem);
            --font-size-md: clamp(1.09rem, 1.42vw + 0.74rem, 1.88rem);
            --font-size-lg: clamp(1.37rem, 1.78vw + 0.92rem, 2.34rem);
            --font-size-xl: clamp(1.71rem, 2.22vw + 1.15rem, 2.93rem);
            --font-size-xxl: clamp(2.14rem, 2.77vw + 1.44rem, 3.66rem);
            --font-size-xxxl: clamp(2.67rem, 3.47vw + 1.8rem, 4.58rem);
        }

        /* Box sizing and margin reset for consistency */
        .insta-section *,
        .insta-section *::after,
        .insta-section *::before {
            box-sizing: border-box;
        }

        .insta-section h1,
        .insta-section h2,
        .insta-section h3,
        .insta-section h4,
        .insta-section h5,
        .insta-section h6 {
            margin: 0;
        }

        .insta-section .insta-container {
            --container-padding-horizontal: 32px;
            position: relative;
            padding-inline: var(--container-padding-horizontal);
            display: grid;
            place-items: center;
            height: 100%;
        }

        /* Carousel specific styling */
        .insta-section .insta-carousel {
            pointer-events: none;
            position: absolute;
            padding-block-start: 67px;
            padding-block-end: max(24px, calc(29px + var(--font-size-md)));
            perspective: 100px;
            width: 100%;
        }

        /* Responsive adjustments for the carousel */
        @media (max-width: 568px) {
            .insta-section .insta-carousel {
                padding-block-end: 52px;
            }
        }

        .insta-section .insta-carousel-wrapper {
            position: relative;
            display: flex;
            justify-content: center;
            height: 61.2vh;
        }

        /* Styling for each slide item */
        .insta-section .insta-carousel .insta-item {
            position: absolute;
            max-width: 328px;
            height: 100%;
            margin-inline: var(--container-padding-horizontal);
            opacity: 0;
            will-change: transform, opacity;
            animation: insta-carousel-animate 27s cubic-bezier(0.37, 0, 0.63, 1) infinite;
        }

        @media (max-width: 568px) {
            .insta-section .insta-carousel .insta-item {
                margin-inline: calc(var(--container-padding-horizontal) + 1px);
            }
        }

        /* Animation delays for each slide */
        .insta-section .insta-carousel .insta-item:nth-child(1) {
            animation-delay: calc(27s / 7 * -3);
        }

        .insta-section .insta-carousel .insta-item:nth-child(2) {
            animation-delay: calc(27s / 7 * -2);
        }

        .insta-section .insta-carousel .insta-item:nth-child(3) {
            animation-delay: calc(27s / 7 * -1);
        }

        .insta-section .insta-carousel .insta-item:nth-child(4) {
            animation-delay: calc(27s / 7 * 0);
        }

        .insta-section .insta-carousel .insta-item:nth-child(5) {
            animation-delay: calc(27s / 7 * 1);
        }

        .insta-section .insta-carousel .insta-item:nth-child(6) {
            animation-delay: calc(27s / 7 * 2);
        }

        .insta-section .insta-carousel .insta-item:nth-child(7) {
            animation-delay: calc(27s / 7 * 3);
        }

        .insta-section .insta-carousel img {
            max-width: 100%;
            object-fit: cover;
            height: 100%;
        }

        /* Main Instagram card styling */
        .insta-section .insta-card {
            --pading-horizontal: 16px;
            --border: 2px solid var(--primary);
            max-width: var(--max-width-post);
            width: 100%;
            border: var(--border);
            border-radius: 20px;
        }

        .insta-section .insta-header {
            padding-block: 12px;
            border-bottom: var(--border);
            color: var(--primary);
        }

        .insta-section .insta-header figure {
            padding-block: 0;
            padding-inline: var(--pading-horizontal);
            margin: 0;
            display: flex;
            align-items: center;
        }

        .insta-section .insta-header img {
            border-radius: 50%;
            object-fit: cover;
            border: var(--border);
            margin-inline-end: 8px;
        }

        .insta-section .insta-media {
            display: flex;
            border-bottom: var(--border);
        }

        .insta-section .insta-media .insta-img {
            max-width: 100%;
            height: 61.2vh;
        }

        .insta-section .insta-buttons {
            padding-block: 12px;
            padding-inline: var(--pading-horizontal);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .insta-section .insta-buttons-left {
            display: flex;
            align-items: center;
        }

        .insta-section .insta-buttons-left svg:nth-of-type(2) {
            margin-inline: 12px;
        }

        .insta-section .insta-icon {
            cursor: pointer;
            width: 1em;
            height: 1em;
            font-size: var(--font-size-md);
            min-width: 24px;
            min-height: 24px;
        }

        .insta-section .insta-icon:hover {
            opacity: 0.7;
        }

        .insta-section .insta-icon path {
            stroke: var(--primary);
            stroke-linejoin: round;
        }

        .insta-section .insta-icon-comment path {
            stroke-width: 2;
        }

        .insta-section .insta-icon-message {
            margin-block-start: 3px;
        }

        .insta-section .insta-icon-message path {
            stroke-width: 2;
        }

        .insta-section .insta-icon-saved path {
            stroke-width: 2;
        }

        .hello-text {
            text-align: center;
            font-family: 'pacifico';
            margin-top: 3rem;
            margin-bottom: -4rem;
            color: var(--primary);
            font-size: 3rem;

        }

        /* ipad */
        @media (max-width: 768px) {
            .hello-text {
                font-size: 2.5rem !important;
                margin-top: -6rem !important;
                margin-bottom: -0.5rem !important;
            }
        }

        /* ipad air */
        @media (min-width:820px) and (max-width: 821px) {
            .hello-text {
                font-size: 2.7rem !important;
                margin-top: -7rem !important;
                margin-bottom: 2rem !important;
            }
        }

        /* ipad pro */
        @media (min-width:1023px) and (max-width: 1024px) {
            .hello-text {
                font-size: 2.7rem !important;
                margin-top: -10rem !important;
                margin-bottom: 2rem !important;
            }
        }

        /* surface pro */
        @media (min-width:911px) and (max-width: 912px) {
            .hello-text {
                font-size: 2.7rem !important;
                margin-top: -10rem !important;
                margin-bottom: 2rem !important;
            }
        }

        /* zenbook fold pro */
        @media (min-width:852px) and (max-width: 854px) {
            .hello-text {
                font-size: 2.7rem !important;
                margin-top: -10rem !important;
                margin-bottom: 2rem !important;
            }
        }

        /* s8+ */
        @media (min-width:358px) and (max-width: 361px) {
            .hello-text {
                font-size: 2.5rem !important;
                margin-top: 1.5rem !important;
                margin-bottom: -5rem !important;
            }
        }

        /* galaxy ffold 5 */
        @media (min-width:340px) and (max-width: 345px) {
            .hello-text {
                font-size: 2.5rem !important;
                margin-top: -10rem !important;
                margin-bottom: 10rem !important;
            }
        }

        /* normal phones */
        @media (min-width:365px) and (max-width: 576px) {
            .hello-text {
                font-size: 2.5rem !important;
                margin-top: 1rem !important;
                margin-bottom: -2rem !important;
            }
        }

        /* iphone se*/
        @media (min-width:374px) and (max-width: 376px) {
            .hello-text {
                font-size: 2rem !important;
                margin-top: 1.5rem !important;
                margin-bottom: -7rem !important;
            }
        }

        /* iphone 12 */
        @media (min-width:390px) and (max-width: 391px) {
            .hello-text {
                margin-top: -2rem !imprtant;
                margin-bottom: -4rem !important;
            }
        }

        /* iphone 14 */
        @media (min-width:430px) and (max-width: 431px) {
            .hello-text {
                font-size: 2.5rem !important;
                margin-top: -1rem !important;
                margin-bottom: -2rem !important;
            }
        }
    </style>
</head>

<body>

    <div class="d">
        <p class="hello-text fs-1">Hello, Monday!</p>
        <section class="insta-section">
            <aside class="insta-carousel">
                <div class="insta-carousel-wrapper">
                    <div class="insta-item" id="slide-0">
                        <img src="<?php echo FILE_ROOT; ?>/public/assets/images/img_6.jpg" alt="" width="418"
                            height="418">
                    </div>
                    <div class="insta-item" id="slide-1">
                        <img src="<?php echo FILE_ROOT; ?>/public/assets/images/img_8.jpg" alt="" width="418"
                            height="418">
                    </div>
                    <div class="insta-item" id="slide-2">
                        <img src="<?php echo FILE_ROOT; ?>/public/assets/images/img_3.jpg" alt="" width="418"
                            height="418">
                    </div>
                    <div class="insta-item" id="slide-3">
                        <img src="<?php echo FILE_ROOT; ?>/public/assets/images/img_9.jpg" alt="" width="418"
                            height="418">
                    </div>
                    <div class="insta-item" id="slide-4">
                        <img src="<?php echo FILE_ROOT; ?>/public/assets/images/img_5.jpg" alt="" width="418"
                            height="418">
                    </div>
                    <div class="insta-item" id="slide-5">
                        <img src="<?php echo FILE_ROOT; ?>/public/assets/images/MERIENDA.jpg" alt="" width="418"
                            height="418">
                    </div>
                    <div class="insta-item" id="slide-6">
                        <img src="<?php echo FILE_ROOT; ?>/public/assets/images/img_7.jpg" alt="" width="418"
                            height="418">
                    </div>
                </div>
            </aside>
            <article class="insta-card">
                <header class="insta-header">
                    <figure>
                        <img src="<?php echo FILE_ROOT; ?>/public/assets/images/logo2.png" alt="Jake Dog" width="42"
                            height="42">
                        <figcaption>
                            <h4>Monday Mornings</h4>
                        </figcaption>
                    </figure>
                </header>
                <section class="insta-media">
                    <div class="insta-img"></div>
                </section>
                <footer class="insta-buttons">
                    <div class="insta-buttons-left">
                        <svg class="insta-icon insta-icon-heart" fill="none" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24">
                            <path
                                d="M16.8196 3.40477L16.8196 3.40468L16.8105 3.40435C15.9939 3.37401 15.1837 3.55848 14.4607 3.93934C13.7415 4.31818 13.1337 4.87813 12.6974 5.56376C12.3799 6.0141 12.1595 6.38237 12.0011 6.66645C11.841 6.38254 11.6182 6.01451 11.2971 5.5646C10.8588 4.88294 10.252 4.32584 9.53521 3.94728C8.81455 3.56666 8.00746 3.37954 7.19284 3.40423L7.19283 3.40408L7.18038 3.40477C5.73422 3.48471 4.37827 4.133 3.40801 5.20836C2.44041 6.28078 1.93462 7.69124 1.99999 9.13385C2.00344 10.8131 2.73878 12.1587 3.76066 13.3486C4.54375 14.2605 5.52952 15.1172 6.516 15.9745C6.80035 16.2216 7.08476 16.4688 7.36439 16.7173C7.71256 17.0283 8.0484 17.3289 8.36875 17.6156C9.03981 18.2163 9.64287 18.7561 10.1488 19.2024C10.8808 19.8482 11.4505 20.3358 11.7281 20.5156L11.9996 20.6915L12.2713 20.516C12.5291 20.3494 13.0097 19.9415 13.7041 19.3303C14.2257 18.8712 14.8883 18.2789 15.7018 17.5517C15.9935 17.2909 16.3047 17.0128 16.6357 16.7172C16.9253 16.4597 17.2205 16.2037 17.5157 15.9477C18.4876 15.105 19.4601 14.2617 20.2346 13.3628C21.2586 12.1744 21.9965 10.8264 22 9.13385C22.0653 7.69123 21.5596 6.28078 20.592 5.20836C19.6217 4.133 18.2657 3.48471 16.8196 3.40477ZM11.6142 4.35506L11.9954 4.80294L12.3761 4.35467C12.9155 3.71951 13.5913 3.21422 14.3531 2.87644C15.1144 2.53889 15.9419 2.37731 16.7742 2.40369C18.4866 2.47112 20.1027 3.21362 21.2694 4.46897C22.4364 5.72476 23.0588 7.39158 23.0003 9.10494L23 9.11347V9.122C23 12.4787 20.5608 14.6294 18.1924 16.6842C17.8966 16.94 17.598 17.2003 17.3031 17.462L17.3018 17.4632L16.3798 18.2872L16.3736 18.2927L16.3676 18.2985C15.2327 19.3827 14.0415 20.4065 12.7991 21.3656C12.5599 21.5162 12.2829 21.5962 12 21.5962C11.7171 21.5962 11.4402 21.5162 11.201 21.3657C9.9972 20.4352 8.84189 19.4436 7.73965 18.3948L7.73401 18.3894L7.7282 18.3842L6.7012 17.4662L6.70057 17.4657C6.43759 17.2314 6.17305 17.0015 5.91337 16.7758C5.88988 16.7554 5.86643 16.735 5.84303 16.7147C3.34442 14.5424 0.999982 12.4694 0.999982 9.122V9.11347L0.999691 9.10494C0.941196 7.39158 1.56352 5.72476 2.73058 4.46897C3.89709 3.21378 5.51295 2.47131 7.2251 2.40372C8.0557 2.37962 8.88112 2.54227 9.6405 2.87968C10.4006 3.21742 11.0751 3.72163 11.6142 4.35506Z"
                                stroke="var(--primary)" stroke-linejoin="round"></path>
                        </svg>
                        <svg class="insta-icon insta-icon-comment" fill="none" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24">
                            <path
                                d="M20.656 17.008C21.8711 14.9061 22.2795 12.4337 21.8048 10.0527C21.3301 7.67172 20.0048 5.54497 18.0765 4.06978C16.1482 2.59458 13.7488 1.87186 11.3266 2.0366C8.9043 2.20135 6.62486 3.24231 4.91408 4.96501C3.20329 6.68772 2.17817 8.97432 2.03024 11.3977C1.8823 13.821 2.62166 16.2153 4.1102 18.1334C5.59874 20.0514 7.73463 21.3619 10.1189 21.82C12.5031 22.2782 14.9726 21.8527 17.066 20.623L22 22L20.656 17.008Z"
                                stroke="var(--primary)" stroke-width="2" stroke-linejoin="round"></path>
                        </svg>
                        <svg class="insta-icon insta-icon-message" fill="none" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24">
                            <path d="M22 3 9.218 10.083M11.698 20.334 22 3.001H2L9.218 10.084 11.698 20.334Z"
                                stroke="var(--primary)" stroke-width="2" stroke-linejoin="round"></path>
                        </svg>
                    </div>
                    <div class="insta-buttons-right">
                        <svg class="insta-icon insta-icon-saved" fill="none" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24">
                            <path d="M20 21L12 13.44L4 21V3H20V21Z" stroke="var(--primary)" stroke-width="2"
                                stroke-linejoin="round"></path>
                        </svg>
                    </div>
                </footer>
            </article>
        </section>
    </div>
    <!-- <script>
        let CHECKED = false;
        document.addEventListener("pointerdown", (e) => {
            CHECKED = !CHECKED;
            document.documentElement.style.setProperty("--light", CHECKED ? 1 : 0);
        });
    </script> -->
</body>

</html>