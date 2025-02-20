<!--
Template Name: Tailnews - Tailwind News Template
Author: Aribudin
Website: https://www.tailwindtemplate.net
Contact: support@tailwindtemplate.net
Purchase: https://themes.tailwindtemplate.net/tailnews
License: You must have a valid license from official store to legally use the theme for your project.
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title  -->
    <title>Tailwind News Template | Tailnews</title>
    <meta name="description" content="Tailwind CSS News Template">

    <!-- Development css -->
    <link rel="stylesheet" href={{ asset('css/news/style.css') }}>
    <script src="https://cdn.tailwindcss.com"></script>


    <!-- Production css -->
    <!-- <link rel="stylesheet" href="dist/css/style.css"> -->

    <!-- google font -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;600;700&amp;display=swap" rel="stylesheet">

    <!-- Favicon  -->
    <link rel="icon" href="src/img/favicon.jpg">
    <link rel="icon" href="{{ asset('images/VietNamPool.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">

    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/flex-slider.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('css/templatemo-lugx-gaming.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.7.2-web/css/all.min.css') }}">
</head>

<body class="text-gray-700 pt-[90px]"
    style="    background-color: #21324C !important;
    background-image: url(../images/background-dots.png);">
    <!-- ========== { HEADER }==========  -->
    <x-notification />
    <x-menu />
    <!-- end header -->

    <!-- Mobile menu -->
    <div class="side-area fixed w-full h-full inset-0 z-50">
        <!-- bg open -->
        <div class="back-menu fixed bg-gray-900 bg-opacity-70 w-full h-full inset-x-0 top-0">
            <div class="cursor-pointer text-white absolute right-64 p-2">
                <svg class="bi bi-x" width="2rem" height="2rem" viewBox="0 0 16 16" fill="currentColor"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M11.854 4.146a.5.5 0 010 .708l-7 7a.5.5 0 01-.708-.708l7-7a.5.5 0 01.708 0z"
                        clip-rule="evenodd"></path>
                    <path fill-rule="evenodd"
                        d="M4.146 4.146a.5.5 0 000 .708l7 7a.5.5 0 00.708-.708l-7-7a.5.5 0 00-.708 0z"
                        clip-rule="evenodd"></path>
                </svg>
            </div>
        </div>

        <!-- Mobile navbar -->
        <nav id="mobile-nav"
            class="side-menu flex flex-col right-0 w-64 fixed top-0 bg-white dark:bg-gray-800 h-full overflow-auto z-40">
            <div class="mb-auto">
                <!--navigation-->
                <nav class="relative flex flex-wrap">
                    <div class="text-center py-4 w-full font-bold border-b border-gray-100">TAILNEWS</div>
                    <ul id="side-menu" class="w-full float-none flex flex-col">
                        <li class="relative">
                            <a href="#" class="block py-2 px-5 border-b border-gray-100 hover:bg-gray-50">Home</a>
                        </li>

                        <!-- dropdown with submenu-->
                        <li class="dropdown relative">
                            <a class="block py-2 px-5 border-b border-gray-100 hover:bg-gray-50" href="javascript:;">
                                News
                            </a>

                            <!-- dropdown menu -->
                            <ul class="dropdown-menu block rounded rounded-t-none top-full z-50 ml-4 py-0.5 text-left bg-white dark:bg-gray-800 mb-4"
                                style="min-width: 12rem">
                                <!--submenu-->
                                <li class="subdropdown relative">
                                    <a class="block w-full py-2 px-5 border-b border-gray-100 hover:bg-gray-50"
                                        href="javascript:;">
                                        Dropdown item
                                    </a>

                                    <!--dropdown submenu-->
                                    <ul class="dropdown-menu block rounded rounded-t-none top-full z-50 ml-4 py-0.5 text-left bg-white dark:bg-gray-800"
                                        style="min-width: 12rem">
                                        <li><a class="block w-full py-2 px-5 border-b border-gray-100 hover:bg-gray-50"
                                                href="#">Dropdown sub item</a></li>
                                        <li><a class="block w-full py-2 px-5 border-b border-gray-100 hover:bg-gray-50"
                                                href="#">Dropdown sub item</a></li>
                                        <li><a class="block w-full py-2 px-5 border-b border-gray-100 hover:bg-gray-50"
                                                href="#">Dropdown sub item</a></li>
                                        <li><a class="block w-full py-2 px-5 border-b border-gray-100 hover:bg-gray-50"
                                                href="#">Dropdown sub item</a></li>
                                    </ul>
                                </li><!--end submenu-->
                                <li class="relative"><a
                                        class="block w-full py-2 px-5 border-b border-gray-100 hover:bg-gray-50"
                                        href="#">Dropdown item</a></li>
                                <li class="relative"><a
                                        class="block w-full py-2 px-5 border-b border-gray-100 hover:bg-gray-50"
                                        href="#">Dropdown item</a></li>
                            </ul>
                        </li>

                        <li class="relative">
                            <a href="#"
                                class="block py-2 px-5 border-b border-gray-100 hover:bg-gray-50">Sport</a>
                        </li>

                        <li class="relative">
                            <a href="#"
                                class="block py-2 px-5 border-b border-gray-100 hover:bg-gray-50">Travel</a>
                        </li>

                        <li class="relative">
                            <a href="#"
                                class="block py-2 px-5 border-b border-gray-100 hover:bg-gray-50">Techno</a>
                        </li>

                        <li class="relative">
                            <a href="#"
                                class="block py-2 px-5 border-b border-gray-100 hover:bg-gray-50">Worklife</a>
                        </li>

                        <li class="relative">
                            <a href="#"
                                class="block py-2 px-5 border-b border-gray-100 hover:bg-gray-50">Future</a>
                        </li>

                        <li class="relative">
                            <a href="#"
                                class="block py-2 px-5 border-b border-gray-100 hover:bg-gray-50">More</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- copyright -->
            <div class="py-4 px-6 text-sm mt-6 text-center">
                <p>Copyright <a href="#">Tailnews</a> - All right reserved</p>
            </div>
        </nav>
    </div><!-- End Mobile menu -->

    <!-- =========={ MAIN }==========  -->
    <main id="content">
        <!-- advertisement -->
        <div class="bg-gray-50 py-4 hidden">
            <div class="xl:container mx-auto px-3 sm:px-4 xl:px-2">
                <div class="mx-auto table text-center text-sm">
                    <a class="uppercase" href="#">Advertisement</a>
                    <a href="#">
                        <img src={{ asset('images/news/ads/ads_728.jpg') }} alt="advertisement area">
                    </a>
                </div>
            </div>
        </div>

        <!-- hero big grid -->
        <div class="bg-white py-6">
            <div class="xl:container mx-auto px-3 sm:px-4 xl:px-2">
                <!-- big grid 1 -->
                <div class="flex flex-row flex-wrap">
                    <!--Start left cover-->
                    <div class="flex-shrink max-w-full w-full lg:w-1/2 pb-1 lg:pb-0 lg:pr-1">
                        <div class="relative hover-img max-h-98 overflow-hidden">
                            <a href="#">
                                <img class="max-w-full w-full mx-auto h-auto"
                                    src={{ asset('images/news/dummy/img1.jpg') }} alt="Image description">
                            </a>
                            <div class="absolute px-5 pt-8 pb-5 bottom-0 w-full bg-gradient-cover">
                                <a href="#">
                                    <h2 class="text-3xl font-bold capitalize text-white mb-3">Amazon Shoppers Are
                                        Ditching Designer Belts for This Best-Selling</h2>
                                </a>
                                <p class="text-gray-100 hidden sm:inline-block">This is a wider card with supporting
                                    text below as a natural lead-in to additional content. This very helpfull for
                                    generate default content..</p>
                                <div class="pt-2">
                                    <div class="text-gray-100">
                                        <div class="inline-block h-3 border-l-2 border-red-600 mr-2"></div>Europe
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Start box news-->
                    <div class="flex-shrink max-w-full w-full lg:w-1/2">
                        <div class="box-one flex flex-row flex-wrap">
                            <article class="flex-shrink max-w-full w-full sm:w-1/2">
                                <div class="relative hover-img max-h-48 overflow-hidden">
                                    <a href="#">
                                        <img class="max-w-full w-full mx-auto h-auto"
                                            src={{ asset('images/news/dummy/img2.jpg') }} alt="Image description">
                                    </a>
                                    <div class="absolute px-4 pt-7 pb-4 bottom-0 w-full bg-gradient-cover">
                                        <a href="#">
                                            <h2 class="text-lg font-bold capitalize leading-tight text-white mb-1">News
                                                magazines are becoming obsolete, replaced by gadgets</h2>
                                        </a>
                                        <div class="pt-1">
                                            <div class="text-gray-100">
                                                <div class="inline-block h-3 border-l-2 border-red-600 mr-2"></div>
                                                Techno
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <article class="flex-shrink max-w-full w-full sm:w-1/2">
                                <div class="relative hover-img max-h-48 overflow-hidden">
                                    <a href="#">
                                        <img class="max-w-full w-full mx-auto h-auto"
                                            src={{ asset('images/news/dummy/img2.jpg') }} alt="Image description">
                                    </a>
                                    <div class="absolute px-4 pt-7 pb-4 bottom-0 w-full bg-gradient-cover">
                                        <a href="#">
                                            <h2 class="text-lg font-bold capitalize leading-tight text-white mb-1">
                                                Minimalist designs are starting to be popular with the next generation
                                            </h2>
                                        </a>
                                        <div class="pt-1">
                                            <div class="text-gray-100">
                                                <div class="inline-block h-3 border-l-2 border-red-600 mr-2"></div>
                                                Architecture
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <article class="flex-shrink max-w-full w-full sm:w-1/2">
                                <div class="relative hover-img max-h-48 overflow-hidden">
                                    <a href="#">
                                        <img class="max-w-full w-full mx-auto h-auto"
                                            src={{ asset('images/news/dummy/img2.jpg') }} alt="Image description">
                                    </a>
                                    <div class="absolute px-4 pt-7 pb-4 bottom-0 w-full bg-gradient-cover">
                                        <a href="#">
                                            <h2 class="text-lg font-bold capitalize leading-tight text-white mb-1">Tips
                                                for decorating the interior of the living room</h2>
                                        </a>
                                        <div class="pt-1">
                                            <div class="text-gray-100">
                                                <div class="inline-block h-3 border-l-2 border-red-600 mr-2"></div>
                                                Interior
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <article class="flex-shrink max-w-full w-full sm:w-1/2">
                                <div class="relative hover-img max-h-48 overflow-hidden">
                                    <a href="#">
                                        <img class="max-w-full w-full mx-auto h-auto"
                                            src={{ asset('images/news/dummy/img2.jpg') }} alt="Image description">
                                    </a>
                                    <div class="absolute px-4 pt-7 pb-4 bottom-0 w-full bg-gradient-cover">
                                        <a href="#">
                                            <h2 class="text-lg font-bold capitalize leading-tight text-white mb-1">
                                                Online taxi users are increasing drastically ahead of the new year</h2>
                                        </a>
                                        <div class="pt-1">
                                            <div class="text-gray-100">
                                                <div class="inline-block h-3 border-l-2 border-red-600 mr-2"></div>
                                                Lifestyle
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- block news -->
        <div class="bg-white">
            <div class="xl:container mx-auto px-3 sm:px-4 xl:px-2">
                <div class="flex flex-row flex-wrap">
                    <!-- Left -->
                    <div class="flex-shrink max-w-full w-full lg:w-2/3 overflow-hidden">
                        <div class="w-full py-3">
                            <h2 class="text-gray-800 text-2xl font-bold">
                                <span class="inline-block h-5 border-l-3 border-red-600 mr-2"></span>Europe
                            </h2>
                        </div>
                        <div class="flex flex-row flex-wrap -mx-3">
                            <div
                                class="flex-shrink max-w-full w-full sm:w-1/3 px-3 pb-3 pt-3 sm:pt-0 border-b-2 sm:border-b-0 border-dotted border-gray-100">
                                <div class="flex flex-row sm:block hover-img">
                                    <a href="">
                                        <img class="max-w-full w-full mx-auto"
                                            src={{ asset('images/news/dummy/img2.jpg') }} alt="alt title">
                                    </a>
                                    <div class="py-0 sm:py-3 pl-3 sm:pl-0">
                                        <h3 class="text-lg font-bold leading-tight mb-2">
                                            <a href="#">5 Tips to Save Money Booking Your Next Hotel Room</a>
                                        </h3>
                                        <p class="hidden md:block text-gray-600 leading-tight mb-1">This is a wider
                                            card with supporting text below as a natural lead-in to additional content.
                                        </p>
                                        <a class="text-gray-500" href="#"><span
                                                class="inline-block h-3 border-l-2 border-red-600 mr-2"></span>Europe</a>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="flex-shrink max-w-full w-full sm:w-1/3 px-3 pb-3 pt-3 sm:pt-0 border-b-2 sm:border-b-0 border-dotted border-gray-100">
                                <div class="flex flex-row sm:block hover-img">
                                    <a href="">
                                        <img class="max-w-full w-full mx-auto"
                                            src={{ asset('images/news/dummy/img2.jpg') }} alt="alt title">
                                    </a>
                                    <div class="py-0 sm:py-3 pl-3 sm:pl-0">
                                        <h3 class="text-lg font-bold leading-tight mb-2">
                                            <a href="#">5 Tips to Save Money Booking Your Next Hotel Room</a>
                                        </h3>
                                        <p class="hidden md:block text-gray-600 leading-tight mb-1">This is a wider
                                            card with supporting text below as a natural lead-in to additional content.
                                        </p>
                                        <a class="text-gray-500" href="#"><span
                                                class="inline-block h-3 border-l-2 border-red-600 mr-2"></span>Europe</a>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="flex-shrink max-w-full w-full sm:w-1/3 px-3 pb-3 pt-3 sm:pt-0 border-b-2 sm:border-b-0 border-dotted border-gray-100">
                                <div class="flex flex-row sm:block hover-img">
                                    <a href="">
                                        <img class="max-w-full w-full mx-auto"
                                            src={{ asset('images/news/dummy/img2.jpg') }} alt="alt title">
                                    </a>
                                    <div class="py-0 sm:py-3 pl-3 sm:pl-0">
                                        <h3 class="text-lg font-bold leading-tight mb-2">
                                            <a href="#">5 Tips to Save Money Booking Your Next Hotel Room</a>
                                        </h3>
                                        <p class="hidden md:block text-gray-600 leading-tight mb-1">This is a wider
                                            card with supporting text below as a natural lead-in to additional content.
                                        </p>
                                        <a class="text-gray-500" href="#"><span
                                                class="inline-block h-3 border-l-2 border-red-600 mr-2"></span>Europe</a>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="flex-shrink max-w-full w-full sm:w-1/3 px-3 pb-3 pt-3 sm:pt-0 border-b-2 sm:border-b-0 border-dotted border-gray-100">
                                <div class="flex flex-row sm:block hover-img">
                                    <a href="">
                                        <img class="max-w-full w-full mx-auto"
                                            src={{ asset('images/news/dummy/img2.jpg') }} alt="alt title">
                                    </a>
                                    <div class="py-0 sm:py-3 pl-3 sm:pl-0">
                                        <h3 class="text-lg font-bold leading-tight mb-2">
                                            <a href="#">5 Tips to Save Money Booking Your Next Hotel Room</a>
                                        </h3>
                                        <p class="hidden md:block text-gray-600 leading-tight mb-1">This is a wider
                                            card with supporting text below as a natural lead-in to additional content.
                                        </p>
                                        <a class="text-gray-500" href="#"><span
                                                class="inline-block h-3 border-l-2 border-red-600 mr-2"></span>Europe</a>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="flex-shrink max-w-full w-full sm:w-1/3 px-3 pb-3 pt-3 sm:pt-0 border-b-2 sm:border-b-0 border-dotted border-gray-100">
                                <div class="flex flex-row sm:block hover-img">
                                    <a href="">
                                        <img class="max-w-full w-full mx-auto"
                                            src={{ asset('images/news/dummy/img2.jpg') }} alt="alt title">
                                    </a>
                                    <div class="py-0 sm:py-3 pl-3 sm:pl-0">
                                        <h3 class="text-lg font-bold leading-tight mb-2">
                                            <a href="#">5 Tips to Save Money Booking Your Next Hotel Room</a>
                                        </h3>
                                        <p class="hidden md:block text-gray-600 leading-tight mb-1">This is a wider
                                            card with supporting text below as a natural lead-in to additional content.
                                        </p>
                                        <a class="text-gray-500" href="#"><span
                                                class="inline-block h-3 border-l-2 border-red-600 mr-2"></span>Europe</a>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="flex-shrink max-w-full w-full sm:w-1/3 px-3 pb-3 pt-3 sm:pt-0 border-b-2 sm:border-b-0 border-dotted border-gray-100">
                                <div class="flex flex-row sm:block hover-img">
                                    <a href="">
                                        <img class="max-w-full w-full mx-auto"
                                            src={{ asset('images/news/dummy/img2.jpg') }} alt="alt title">
                                    </a>
                                    <div class="py-0 sm:py-3 pl-3 sm:pl-0">
                                        <h3 class="text-lg font-bold leading-tight mb-2">
                                            <a href="#">5 Tips to Save Money Booking Your Next Hotel Room</a>
                                        </h3>
                                        <p class="hidden md:block text-gray-600 leading-tight mb-1">This is a wider
                                            card with supporting text below as a natural lead-in to additional content.
                                        </p>
                                        <a class="text-gray-500" href="#"><span
                                                class="inline-block h-3 border-l-2 border-red-600 mr-2"></span>Europe</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- right -->
                    <div
                        class="flex-shrink max-w-full w-full lg:w-1/3 lg:pl-8 lg:pt-14 lg:pb-8 order-first lg:order-last">
                        <div class="w-full bg-gray-50 h-full">
                            <div class="text-sm py-6 sticky">
                                <div class="w-full text-center">
                                    <a class="uppercase" href="#">Advertisement</a>
                                    <a href="#">
                                        <img class="mx-auto" src={{ asset('images/news/dummy/img2.jpg') }}
                                            alt="advertisement area">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- slider news -->
        <div class="relative bg-gray-50"
            style="background-image: url('src/img/bg.jpg');background-size: cover;background-position: center center;background-attachment: fixed">
            <div class="bg-black bg-opacity-70">
                <div class="xl:container mx-auto px-3 sm:px-4 xl:px-2">
                    <div class="flex flex-row flex-wrap">
                        <div class="flex-shrink max-w-full w-full py-12 overflow-hidden">
                            <div class="w-full py-3">
                                <h2 class="text-white text-2xl font-bold text-shadow-black">
                                    <span class="inline-block h-5 border-l-3 border-red-600 mr-2"></span>American
                                </h2>
                            </div>
                            <div id="post-carousel" class="splide post-carousel">
                                <div class="splide__track">
                                    <ul class="splide__list">
                                        <li class="splide__slide">
                                            <div class="w-full pb-3">
                                                <div class="hover-img bg-white">
                                                    <a href="">
                                                        <img class="max-w-full w-full mx-auto"
                                                            src={{ asset('images/news/dummy/img2.jpg') }}
                                                            alt="alt title">
                                                    </a>
                                                    <div class="py-3 px-6">
                                                        <h3 class="text-lg font-bold leading-tight mb-2">
                                                            <a href="#">5 Tips to Save Money Booking Your Next
                                                                Hotel Room</a>
                                                        </h3>
                                                        <a class="text-gray-500" href="#"><span
                                                                class="inline-block h-3 border-l-2 border-red-600 mr-2"></span>Europe</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="splide__slide">
                                            <div class="w-full pb-3">
                                                <div class="hover-img bg-white">
                                                    <a href="">
                                                        <img class="max-w-full w-full mx-auto"
                                                            src={{ asset('images/news/dummy/img2.jpg') }}
                                                            alt="alt title">
                                                    </a>
                                                    <div class="py-3 px-6">
                                                        <h3 class="text-lg font-bold leading-tight mb-2">
                                                            <a href="#">5 Tips to Save Money Booking Your Next
                                                                Hotel Room</a>
                                                        </h3>
                                                        <a class="text-gray-500" href="#"><span
                                                                class="inline-block h-3 border-l-2 border-red-600 mr-2"></span>Europe</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="splide__slide">
                                            <div class="w-full pb-3">
                                                <div class="hover-img bg-white">
                                                    <a href="">
                                                        <img class="max-w-full w-full mx-auto"
                                                            src={{ asset('images/news/dummy/img2.jpg') }}
                                                            alt="alt title">
                                                    </a>
                                                    <div class="py-3 px-6">
                                                        <h3 class="text-lg font-bold leading-tight mb-2">
                                                            <a href="#">5 Tips to Save Money Booking Your Next
                                                                Hotel Room</a>
                                                        </h3>
                                                        <a class="text-gray-500" href="#"><span
                                                                class="inline-block h-3 border-l-2 border-red-600 mr-2"></span>Europe</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="splide__slide">
                                            <div class="w-full pb-3">
                                                <div class="hover-img bg-white">
                                                    <a href="">
                                                        <img class="max-w-full w-full mx-auto"
                                                            src={{ asset('images/news/dummy/img2.jpg') }}
                                                            alt="alt title">
                                                    </a>
                                                    <div class="py-3 px-6">
                                                        <h3 class="text-lg font-bold leading-tight mb-2">
                                                            <a href="#">5 Tips to Save Money Booking Your Next
                                                                Hotel Room</a>
                                                        </h3>
                                                        <a class="text-gray-500" href="#"><span
                                                                class="inline-block h-3 border-l-2 border-red-600 mr-2"></span>Europe</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="splide__slide">
                                            <div class="w-full pb-3">
                                                <div class="hover-img bg-white">
                                                    <a href="">
                                                        <img class="max-w-full w-full mx-auto"
                                                            src={{ asset('images/news/dummy/img2.jpg') }}
                                                            alt="alt title">
                                                    </a>
                                                    <div class="py-3 px-6">
                                                        <h3 class="text-lg font-bold leading-tight mb-2">
                                                            <a href="#">5 Tips to Save Money Booking Your Next
                                                                Hotel Room</a>
                                                        </h3>
                                                        <a class="text-gray-500" href="#"><span
                                                                class="inline-block h-3 border-l-2 border-red-600 mr-2"></span>Europe</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="splide__slide">
                                            <div class="w-full pb-3">
                                                <div class="hover-img bg-white">
                                                    <a href="">
                                                        <img class="max-w-full w-full mx-auto"
                                                            src={{ asset('images/news/dummy/img2.jpg') }}
                                                            alt="alt title">
                                                    </a>
                                                    <div class="py-3 px-6">
                                                        <h3 class="text-lg font-bold leading-tight mb-2">
                                                            <a href="#">5 Tips to Save Money Booking Your Next
                                                                Hotel Room</a>
                                                        </h3>
                                                        <a class="text-gray-500" href="#"><span
                                                                class="inline-block h-3 border-l-2 border-red-600 mr-2"></span>Europe</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- block news -->
        <div class="bg-white py-6">
            <div class="xl:container mx-auto px-3 sm:px-4 xl:px-2">
                <div class="flex flex-row flex-wrap">
                    <div class="flex-shrink max-w-full w-full overflow-hidden">
                        <div class="w-full py-3">
                            <h2 class="text-gray-800 text-2xl font-bold">
                                <span class="inline-block h-5 border-l-3 border-red-600 mr-2"></span>Africa
                            </h2>
                        </div>
                        <div class="flex flex-row flex-wrap -mx-3">
                            <div
                                class="flex-shrink max-w-full w-full sm:w-1/3 lg:w-1/4 px-3 pb-3 pt-3 sm:pt-0 border-b-2 sm:border-b-0 border-dotted border-gray-100">
                                <div class="flex flex-row sm:block hover-img">
                                    <a href="">
                                        <img class="max-w-full w-full mx-auto"
                                            src={{ asset('images/news/dummy/img2.jpg') }} alt="alt title">
                                    </a>
                                    <div class="py-0 sm:py-3 pl-3 sm:pl-0">
                                        <h3 class="text-lg font-bold leading-tight mb-2">
                                            <a href="#">5 Tips to Save Money Booking Your Next Hotel Room</a>
                                        </h3>
                                        <p class="hidden md:block text-gray-600 leading-tight mb-1">This is a wider
                                            card with supporting text below as a natural lead-in to additional content.
                                        </p>
                                        <a class="text-gray-500" href="#"><span
                                                class="inline-block h-3 border-l-2 border-red-600 mr-2"></span>Europe</a>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="flex-shrink max-w-full w-full sm:w-1/3 lg:w-1/4 px-3 pb-3 pt-3 sm:pt-0 border-b-2 sm:border-b-0 border-dotted border-gray-100">
                                <div class="flex flex-row sm:block hover-img">
                                    <a href="">
                                        <img class="max-w-full w-full mx-auto"
                                            src={{ asset('images/news/dummy/img2.jpg') }} alt="alt title">
                                    </a>
                                    <div class="py-0 sm:py-3 pl-3 sm:pl-0">
                                        <h3 class="text-lg font-bold leading-tight mb-2">
                                            <a href="#">5 Tips to Save Money Booking Your Next Hotel Room</a>
                                        </h3>
                                        <p class="hidden md:block text-gray-600 leading-tight mb-1">This is a wider
                                            card with supporting text below as a natural lead-in to additional content.
                                        </p>
                                        <a class="text-gray-500" href="#"><span
                                                class="inline-block h-3 border-l-2 border-red-600 mr-2"></span>Europe</a>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="flex-shrink max-w-full w-full sm:w-1/3 lg:w-1/4 px-3 pb-3 pt-3 sm:pt-0 border-b-2 sm:border-b-0 border-dotted border-gray-100">
                                <div class="flex flex-row sm:block hover-img">
                                    <a href="">
                                        <img class="max-w-full w-full mx-auto"
                                            src={{ asset('images/news/dummy/img2.jpg') }} alt="alt title">
                                    </a>
                                    <div class="py-0 sm:py-3 pl-3 sm:pl-0">
                                        <h3 class="text-lg font-bold leading-tight mb-2">
                                            <a href="#">5 Tips to Save Money Booking Your Next Hotel Room</a>
                                        </h3>
                                        <p class="hidden md:block text-gray-600 leading-tight mb-1">This is a wider
                                            card with supporting text below as a natural lead-in to additional content.
                                        </p>
                                        <a class="text-gray-500" href="#"><span
                                                class="inline-block h-3 border-l-2 border-red-600 mr-2"></span>Europe</a>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="flex-shrink max-w-full w-full sm:w-1/3 lg:w-1/4 px-3 pb-3 pt-3 sm:pt-0 border-b-2 sm:border-b-0 border-dotted border-gray-100">
                                <div class="flex flex-row sm:block hover-img">
                                    <a href="">
                                        <img class="max-w-full w-full mx-auto"
                                            src={{ asset('images/news/dummy/img2.jpg') }} alt="alt title">
                                    </a>
                                    <div class="py-0 sm:py-3 pl-3 sm:pl-0">
                                        <h3 class="text-lg font-bold leading-tight mb-2">
                                            <a href="#">5 Tips to Save Money Booking Your Next Hotel Room</a>
                                        </h3>
                                        <p class="hidden md:block text-gray-600 leading-tight mb-1">This is a wider
                                            card with supporting text below as a natural lead-in to additional content.
                                        </p>
                                        <a class="text-gray-500" href="#"><span
                                                class="inline-block h-3 border-l-2 border-red-600 mr-2"></span>Europe</a>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="flex-shrink max-w-full w-full sm:w-1/3 lg:w-1/4 px-3 pb-3 pt-3 sm:pt-0 border-b-2 sm:border-b-0 border-dotted border-gray-100">
                                <div class="flex flex-row sm:block hover-img">
                                    <a href="">
                                        <img class="max-w-full w-full mx-auto"
                                            src={{ asset('images/news/dummy/img2.jpg') }} alt="alt title">
                                    </a>
                                    <div class="py-0 sm:py-3 pl-3 sm:pl-0">
                                        <h3 class="text-lg font-bold leading-tight mb-2">
                                            <a href="#">5 Tips to Save Money Booking Your Next Hotel Room</a>
                                        </h3>
                                        <p class="hidden md:block text-gray-600 leading-tight mb-1">This is a wider
                                            card with supporting text below as a natural lead-in to additional content.
                                        </p>
                                        <a class="text-gray-500" href="#"><span
                                                class="inline-block h-3 border-l-2 border-red-600 mr-2"></span>Europe</a>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="flex-shrink max-w-full w-full sm:w-1/3 lg:w-1/4 px-3 pb-3 pt-3 sm:pt-0 border-b-2 sm:border-b-0 border-dotted border-gray-100">
                                <div class="flex flex-row sm:block hover-img">
                                    <a href="">
                                        <img class="max-w-full w-full mx-auto"
                                            src={{ asset('images/news/dummy/img2.jpg') }} alt="alt title">
                                    </a>
                                    <div class="py-0 sm:py-3 pl-3 sm:pl-0">
                                        <h3 class="text-lg font-bold leading-tight mb-2">
                                            <a href="#">5 Tips to Save Money Booking Your Next Hotel Room</a>
                                        </h3>
                                        <p class="hidden md:block text-gray-600 leading-tight mb-1">This is a wider
                                            card with supporting text below as a natural lead-in to additional content.
                                        </p>
                                        <a class="text-gray-500" href="#"><span
                                                class="inline-block h-3 border-l-2 border-red-600 mr-2"></span>Europe</a>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="flex-shrink max-w-full w-full sm:w-1/3 lg:w-1/4 px-3 pb-3 pt-3 sm:pt-0 border-b-2 sm:border-b-0 border-dotted border-gray-100">
                                <div class="flex flex-row sm:block hover-img">
                                    <a href="">
                                        <img class="max-w-full w-full mx-auto"
                                            src={{ asset('images/news/dummy/img2.jpg') }} alt="alt title">
                                    </a>
                                    <div class="py-0 sm:py-3 pl-3 sm:pl-0">
                                        <h3 class="text-lg font-bold leading-tight mb-2">
                                            <a href="#">5 Tips to Save Money Booking Your Next Hotel Room</a>
                                        </h3>
                                        <p class="hidden md:block text-gray-600 leading-tight mb-1">This is a wider
                                            card with supporting text below as a natural lead-in to additional content.
                                        </p>
                                        <a class="text-gray-500" href="#"><span
                                                class="inline-block h-3 border-l-2 border-red-600 mr-2"></span>Europe</a>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="flex-shrink max-w-full w-full sm:w-1/3 lg:w-1/4 px-3 pb-3 pt-3 sm:pt-0 border-b-2 sm:border-b-0 border-dotted border-gray-100">
                                <div class="flex flex-row sm:block hover-img">
                                    <a href="">
                                        <img class="max-w-full w-full mx-auto" src="src/img/dummy/img26.jpg"
                                            alt="alt title">
                                    </a>
                                    <div class="py-0 sm:py-3 pl-3 sm:pl-0">
                                        <h3 class="text-lg font-bold leading-tight mb-2">
                                            <a href="#">5 Tips to Save Money Booking Your Next Hotel Room</a>
                                        </h3>
                                        <p class="hidden md:block text-gray-600 leading-tight mb-1">This is a wider
                                            card with supporting text below as a natural lead-in to additional content.
                                        </p>
                                        <a class="text-gray-500" href="#"><span
                                                class="inline-block h-3 border-l-2 border-red-600 mr-2"></span>Europe</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- block news -->
        <div class="bg-gray-50 py-6">
            <div class="xl:container mx-auto px-3 sm:px-4 xl:px-2">
                <div class="flex flex-row flex-wrap">
                    <!-- Left -->
                    <div class="flex-shrink max-w-full w-full lg:w-2/3  overflow-hidden">
                        <div class="w-full py-3">
                            <h2 class="text-gray-800 text-2xl font-bold">
                                <span class="inline-block h-5 border-l-3 border-red-600 mr-2"></span>Asian
                            </h2>
                        </div>
                        <div class="flex flex-row flex-wrap -mx-3">
                            <div class="flex-shrink max-w-full w-full px-3 pb-5">
                                <div class="relative hover-img max-h-98 overflow-hidden">
                                    <!--thumbnail-->
                                    <a href="#">
                                        <img class="max-w-full w-full mx-auto h-auto" src="src/img/dummy/img2.jpg"
                                            alt="Image description">
                                    </a>
                                    <div class="absolute px-5 pt-8 pb-5 bottom-0 w-full bg-gradient-cover">
                                        <!--title-->
                                        <a href="#">
                                            <h2 class="text-3xl font-bold capitalize text-white mb-3">Amazon Shoppers
                                                Are Ditching Designer Belts for This Best-Selling</h2>
                                        </a>
                                        <p class="text-gray-100 hidden sm:inline-block">This is a wider card with
                                            supporting text below as a natural lead-in to additional content. This very
                                            helpfull for generate default content..</p>
                                        <!-- author and date -->
                                        <div class="pt-2">
                                            <div class="text-gray-100">
                                                <div class="inline-block h-3 border-l-2 border-red-600 mr-2"></div>
                                                Europe
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="flex-shrink max-w-full w-full sm:w-1/3 px-3 pb-3 pt-3 sm:pt-0 border-b-2 sm:border-b-0 border-dotted border-gray-100">
                                <div class="flex flex-row sm:block hover-img">
                                    <a href="">
                                        <img class="max-w-full w-full mx-auto" src="src/img/dummy/img27.jpg"
                                            alt="alt title">
                                    </a>
                                    <div class="py-0 sm:py-3 pl-3 sm:pl-0">
                                        <h3 class="text-lg font-bold leading-tight mb-2">
                                            <a href="#">5 Tips to Save Money Booking Your Next Hotel Room</a>
                                        </h3>
                                        <p class="hidden md:block text-gray-600 leading-tight mb-1">This is a wider
                                            card with supporting text below as a natural lead-in to additional content.
                                        </p>
                                        <a class="text-gray-500" href="#"><span
                                                class="inline-block h-3 border-l-2 border-red-600 mr-2"></span>Europe</a>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="flex-shrink max-w-full w-full sm:w-1/3 px-3 pb-3 pt-3 sm:pt-0 border-b-2 sm:border-b-0 border-dotted border-gray-100">
                                <div class="flex flex-row sm:block hover-img">
                                    <a href="">
                                        <img class="max-w-full w-full mx-auto" src="src/img/dummy/img3.jpg"
                                            alt="alt title">
                                    </a>
                                    <div class="py-0 sm:py-3 pl-3 sm:pl-0">
                                        <h3 class="text-lg font-bold leading-tight mb-2">
                                            <a href="#">5 Tips to Save Money Booking Your Next Hotel Room</a>
                                        </h3>
                                        <p class="hidden md:block text-gray-600 leading-tight mb-1">This is a wider
                                            card with supporting text below as a natural lead-in to additional content.
                                        </p>
                                        <a class="text-gray-500" href="#"><span
                                                class="inline-block h-3 border-l-2 border-red-600 mr-2"></span>Europe</a>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="flex-shrink max-w-full w-full sm:w-1/3 px-3 pb-3 pt-3 sm:pt-0 border-b-2 sm:border-b-0 border-dotted border-gray-100">
                                <div class="flex flex-row sm:block hover-img">
                                    <a href="">
                                        <img class="max-w-full w-full mx-auto" src="src/img/dummy/img4.jpg"
                                            alt="alt title">
                                    </a>
                                    <div class="py-0 sm:py-3 pl-3 sm:pl-0">
                                        <h3 class="text-lg font-bold leading-tight mb-2">
                                            <a href="#">5 Tips to Save Money Booking Your Next Hotel Room</a>
                                        </h3>
                                        <p class="hidden md:block text-gray-600 leading-tight mb-1">This is a wider
                                            card with supporting text below as a natural lead-in to additional content.
                                        </p>
                                        <a class="text-gray-500" href="#"><span
                                                class="inline-block h-3 border-l-2 border-red-600 mr-2"></span>Europe</a>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="flex-shrink max-w-full w-full sm:w-1/3 px-3 pb-3 pt-3 sm:pt-0 border-b-2 sm:border-b-0 border-dotted border-gray-100">
                                <div class="flex flex-row sm:block hover-img">
                                    <a href="">
                                        <img class="max-w-full w-full mx-auto" src="src/img/dummy/img5.jpg"
                                            alt="alt title">
                                    </a>
                                    <div class="py-0 sm:py-3 pl-3 sm:pl-0">
                                        <h3 class="text-lg font-bold leading-tight mb-2">
                                            <a href="#">5 Tips to Save Money Booking Your Next Hotel Room</a>
                                        </h3>
                                        <p class="hidden md:block text-gray-600 leading-tight mb-1">This is a wider
                                            card with supporting text below as a natural lead-in to additional content.
                                        </p>
                                        <a class="text-gray-500" href="#"><span
                                                class="inline-block h-3 border-l-2 border-red-600 mr-2"></span>Europe</a>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="flex-shrink max-w-full w-full sm:w-1/3 px-3 pb-3 pt-3 sm:pt-0 border-b-2 sm:border-b-0 border-dotted border-gray-100">
                                <div class="flex flex-row sm:block hover-img">
                                    <a href="">
                                        <img class="max-w-full w-full mx-auto" src="src/img/dummy/img6.jpg"
                                            alt="alt title">
                                    </a>
                                    <div class="py-0 sm:py-3 pl-3 sm:pl-0">
                                        <h3 class="text-lg font-bold leading-tight mb-2">
                                            <a href="#">5 Tips to Save Money Booking Your Next Hotel Room</a>
                                        </h3>
                                        <p class="hidden md:block text-gray-600 leading-tight mb-1">This is a wider
                                            card with supporting text below as a natural lead-in to additional content.
                                        </p>
                                        <a class="text-gray-500" href="#"><span
                                                class="inline-block h-3 border-l-2 border-red-600 mr-2"></span>Europe</a>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="flex-shrink max-w-full w-full sm:w-1/3 px-3 pb-3 pt-3 sm:pt-0 border-b-2 sm:border-b-0 border-dotted border-gray-100">
                                <div class="flex flex-row sm:block hover-img">
                                    <a href="">
                                        <img class="max-w-full w-full mx-auto" src="src/img/dummy/img7.jpg"
                                            alt="alt title">
                                    </a>
                                    <div class="py-0 sm:py-3 pl-3 sm:pl-0">
                                        <h3 class="text-lg font-bold leading-tight mb-2">
                                            <a href="#">5 Tips to Save Money Booking Your Next Hotel Room</a>
                                        </h3>
                                        <p class="hidden md:block text-gray-600 leading-tight mb-1">This is a wider
                                            card with supporting text below as a natural lead-in to additional content.
                                        </p>
                                        <a class="text-gray-500" href="#"><span
                                                class="inline-block h-3 border-l-2 border-red-600 mr-2"></span>Europe</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- right -->
                    <div
                        class="flex-shrink max-w-full w-full lg:w-1/3 lg:pl-8 lg:pt-14 lg:pb-8 order-first lg:order-last">
                        <div class="w-full bg-white">
                            <div class="mb-6">
                                <div class="p-4 bg-gray-100">
                                    <h2 class="text-lg font-bold">Most Popular</h2>
                                </div>
                                <ul class="post-number">
                                    <li class="border-b border-gray-100 hover:bg-gray-50">
                                        <a class="text-lg font-bold px-6 py-3 flex flex-row items-center"
                                            href="#">Why the world would end without political polls</a>
                                    </li>
                                    <li class="border-b border-gray-100 hover:bg-gray-50">
                                        <a class="text-lg font-bold px-6 py-3 flex flex-row items-center"
                                            href="#">Meet The Man Who Designed The Ducati Monster</a>
                                    </li>
                                    <li class="border-b border-gray-100 hover:bg-gray-50">
                                        <a class="text-lg font-bold px-6 py-3 flex flex-row items-center"
                                            href="#">2020 Audi R8 Spyder spy shots release</a>
                                    </li>
                                    <li class="border-b border-gray-100 hover:bg-gray-50">
                                        <a class="text-lg font-bold px-6 py-3 flex flex-row items-center"
                                            href="#">Lamborghini makes Huracán GT3 racer faster for 2019</a>
                                    </li>
                                    <li class="border-b border-gray-100 hover:bg-gray-50">
                                        <a class="text-lg font-bold px-6 py-3 flex flex-row items-center"
                                            href="#">ZF plans $14 billion autonomous vehicle push, concept
                                            van</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="text-sm py-6 sticky">
                            <div class="w-full text-center">
                                <a class="uppercase" href="#">Advertisement</a>
                                <a href="#">
                                    <img class="mx-auto" src="src/img/ads/250.jpg" alt="advertisement area">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- block news -->
        <div class="bg-gray-50 py-6">
            <div class="xl:container mx-auto px-3 sm:px-4 xl:px-2">
                <div class="flex flex-row flex-wrap">
                    <!-- post -->
                    <div class="flex-shrink max-w-full w-full lg:w-2/3 overflow-hidden">
                        <div class="w-full py-3">
                            <h2 class="text-gray-800 text-2xl font-bold">
                                <span class="inline-block h-5 border-l-3 border-red-600 mr-2"></span>Latest news
                            </h2>
                        </div>
                        <div class="flex flex-row flex-wrap -mx-3">
                            <div class="flex-shrink max-w-full w-full px-3 pb-5">
                                <div class="relative hover-img max-h-98 overflow-hidden">
                                    <!--thumbnail-->
                                    <a href="#">
                                        <img class="max-w-full w-full mx-auto h-auto" src="src/img/dummy/img15.jpg"
                                            alt="Image description">
                                    </a>
                                    <div class="absolute px-5 pt-8 pb-5 bottom-0 w-full bg-gradient-cover">
                                        <!--title-->
                                        <a href="#">
                                            <h2 class="text-3xl font-bold capitalize text-white mb-3">Amazon Shoppers
                                                Are Ditching Designer Belts for This Best-Selling</h2>
                                        </a>
                                        <p class="text-gray-100 hidden sm:inline-block">This is a wider card with
                                            supporting text below as a natural lead-in to additional content. This very
                                            helpfull for generate default content..</p>
                                        <!-- author and date -->
                                        <div class="pt-2">
                                            <div class="text-gray-100">
                                                <div class="inline-block h-3 border-l-2 border-red-600 mr-2"></div>
                                                Europe
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="flex-shrink max-w-full w-full sm:w-1/3 px-3 pb-3 pt-3 sm:pt-0 border-b-2 sm:border-b-0 border-dotted border-gray-100">
                                <div class="flex flex-row sm:block hover-img">
                                    <a href="">
                                        <img class="max-w-full w-full mx-auto" src="src/img/dummy/img24.jpg"
                                            alt="alt title">
                                    </a>
                                    <div class="py-0 sm:py-3 pl-3 sm:pl-0">
                                        <h3 class="text-lg font-bold leading-tight mb-2">
                                            <a href="#">5 Tips to Save Money Booking Your Next Hotel Room</a>
                                        </h3>
                                        <p class="hidden md:block text-gray-600 leading-tight mb-1">This is a wider
                                            card with supporting text below as a natural lead-in to additional content.
                                        </p>
                                        <a class="text-gray-500" href="#"><span
                                                class="inline-block h-3 border-l-2 border-red-600 mr-2"></span>Europe</a>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="flex-shrink max-w-full w-full sm:w-1/3 px-3 pb-3 pt-3 sm:pt-0 border-b-2 sm:border-b-0 border-dotted border-gray-100">
                                <div class="flex flex-row sm:block hover-img">
                                    <a href="">
                                        <img class="max-w-full w-full mx-auto" src="src/img/dummy/img7.jpg"
                                            alt="alt title">
                                    </a>
                                    <div class="py-0 sm:py-3 pl-3 sm:pl-0">
                                        <h3 class="text-lg font-bold leading-tight mb-2">
                                            <a href="#">5 Tips to Save Money Booking Your Next Hotel Room</a>
                                        </h3>
                                        <p class="hidden md:block text-gray-600 leading-tight mb-1">This is a wider
                                            card with supporting text below as a natural lead-in to additional content.
                                        </p>
                                        <a class="text-gray-500" href="#"><span
                                                class="inline-block h-3 border-l-2 border-red-600 mr-2"></span>Europe</a>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="flex-shrink max-w-full w-full sm:w-1/3 px-3 pb-3 pt-3 sm:pt-0 border-b-2 sm:border-b-0 border-dotted border-gray-100">
                                <div class="flex flex-row sm:block hover-img">
                                    <a href="">
                                        <img class="max-w-full w-full mx-auto" src="src/img/dummy/img17.jpg"
                                            alt="alt title">
                                    </a>
                                    <div class="py-0 sm:py-3 pl-3 sm:pl-0">
                                        <h3 class="text-lg font-bold leading-tight mb-2">
                                            <a href="#">5 Tips to Save Money Booking Your Next Hotel Room</a>
                                        </h3>
                                        <p class="hidden md:block text-gray-600 leading-tight mb-1">This is a wider
                                            card with supporting text below as a natural lead-in to additional content.
                                        </p>
                                        <a class="text-gray-500" href="#"><span
                                                class="inline-block h-3 border-l-2 border-red-600 mr-2"></span>Europe</a>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="flex-shrink max-w-full w-full sm:w-1/3 px-3 pb-3 pt-3 sm:pt-0 border-b-2 sm:border-b-0 border-dotted border-gray-100">
                                <div class="flex flex-row sm:block hover-img">
                                    <a href="">
                                        <img class="max-w-full w-full mx-auto" src="src/img/dummy/img25.jpg"
                                            alt="alt title">
                                    </a>
                                    <div class="py-0 sm:py-3 pl-3 sm:pl-0">
                                        <h3 class="text-lg font-bold leading-tight mb-2">
                                            <a href="#">5 Tips to Save Money Booking Your Next Hotel Room</a>
                                        </h3>
                                        <p class="hidden md:block text-gray-600 leading-tight mb-1">This is a wider
                                            card with supporting text below as a natural lead-in to additional content.
                                        </p>
                                        <a class="text-gray-500" href="#"><span
                                                class="inline-block h-3 border-l-2 border-red-600 mr-2"></span>Europe</a>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="flex-shrink max-w-full w-full sm:w-1/3 px-3 pb-3 pt-3 sm:pt-0 border-b-2 sm:border-b-0 border-dotted border-gray-100">
                                <div class="flex flex-row sm:block hover-img">
                                    <a href="">
                                        <img class="max-w-full w-full mx-auto" src="src/img/dummy/img12.jpg"
                                            alt="alt title">
                                    </a>
                                    <div class="py-0 sm:py-3 pl-3 sm:pl-0">
                                        <h3 class="text-lg font-bold leading-tight mb-2">
                                            <a href="#">5 Tips to Save Money Booking Your Next Hotel Room</a>
                                        </h3>
                                        <p class="hidden md:block text-gray-600 leading-tight mb-1">This is a wider
                                            card with supporting text below as a natural lead-in to additional content.
                                        </p>
                                        <a class="text-gray-500" href="#"><span
                                                class="inline-block h-3 border-l-2 border-red-600 mr-2"></span>Europe</a>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="flex-shrink max-w-full w-full sm:w-1/3 px-3 pb-3 pt-3 sm:pt-0 border-b-2 sm:border-b-0 border-dotted border-gray-100">
                                <div class="flex flex-row sm:block hover-img">
                                    <a href="">
                                        <img class="max-w-full w-full mx-auto" src="src/img/dummy/img8.jpg"
                                            alt="alt title">
                                    </a>
                                    <div class="py-0 sm:py-3 pl-3 sm:pl-0">
                                        <h3 class="text-lg font-bold leading-tight mb-2">
                                            <a href="#">5 Tips to Save Money Booking Your Next Hotel Room</a>
                                        </h3>
                                        <p class="hidden md:block text-gray-600 leading-tight mb-1">This is a wider
                                            card with supporting text below as a natural lead-in to additional content.
                                        </p>
                                        <a class="text-gray-500" href="#"><span
                                                class="inline-block h-3 border-l-2 border-red-600 mr-2"></span>Europe</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- sidebar -->
                    <div class="flex-shrink max-w-full w-full lg:w-1/3 lg:pr-8 lg:pt-14 lg:pb-8 order-first">
                        <div class="w-full bg-white">
                            <div class="mb-6">
                                <div class="p-4 bg-gray-100">
                                    <h2 class="text-lg font-bold">Most Popular</h2>
                                </div>
                                <ul class="post-number">
                                    <li class="border-b border-gray-100 hover:bg-gray-50">
                                        <a class="text-lg font-bold px-6 py-3 flex flex-row items-center"
                                            href="#">Why the world would end without political polls</a>
                                    </li>
                                    <li class="border-b border-gray-100 hover:bg-gray-50">
                                        <a class="text-lg font-bold px-6 py-3 flex flex-row items-center"
                                            href="#">Meet The Man Who Designed The Ducati Monster</a>
                                    </li>
                                    <li class="border-b border-gray-100 hover:bg-gray-50">
                                        <a class="text-lg font-bold px-6 py-3 flex flex-row items-center"
                                            href="#">2020 Audi R8 Spyder spy shots release</a>
                                    </li>
                                    <li class="border-b border-gray-100 hover:bg-gray-50">
                                        <a class="text-lg font-bold px-6 py-3 flex flex-row items-center"
                                            href="#">Lamborghini makes Huracán GT3 racer faster for 2019</a>
                                    </li>
                                    <li class="border-b border-gray-100 hover:bg-gray-50">
                                        <a class="text-lg font-bold px-6 py-3 flex flex-row items-center"
                                            href="#">ZF plans $14 billion autonomous vehicle push, concept
                                            van</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="text-sm py-6 sticky">
                            <div class="w-full text-center">
                                <a class="uppercase" href="#">Advertisement</a>
                                <a href="#">
                                    <img class="mx-auto" src="src/img/ads/250.jpg" alt="advertisement area">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main><!-- end main -->

    <!-- =========={ FOOTER }==========  -->
    <footer class="bg-black text-gray-400">
        <!--Footer content-->
        <div id="footer-content" class="relative pt-8 xl:pt-16 pb-6 xl:pb-12">
            <div class="xl:container mx-auto px-3 sm:px-4 xl:px-2 overflow-hidden">
                <div class="flex flex-wrap flex-row lg:justify-between -mx-3">
                    <div class="flex-shrink max-w-full w-full lg:w-2/5 px-3 lg:pr-16">
                        <div class="flex items-center mb-2">
                            <span class="text-3xl leading-normal mb-2 font-bold text-gray-100 mt-2">TailNews</span>
                            <!-- <img src="src/img-min/logo.png" alt="LOGO"> -->
                        </div>
                        <p>Tailwind News Template for build great newspapper, magazine and news portal.</p>
                        <ul class="space-x-3 mt-6 mb-6 Lg:mb-0">
                            <!--facebook-->
                            <li class="inline-block">
                                <a target="_blank" class="hover:text-gray-100" rel="noopener noreferrer"
                                    href="https://facebook.com" title="Facebook">
                                    <!-- <i class="fab fa-facebook fa-2x"></i> -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem"
                                        viewBox="0 0 512 512">
                                        <path fill="currentColor"
                                            d="M455.27,32H56.73A24.74,24.74,0,0,0,32,56.73V455.27A24.74,24.74,0,0,0,56.73,480H256V304H202.45V240H256V189c0-57.86,40.13-89.36,91.82-89.36,24.73,0,51.33,1.86,57.51,2.68v60.43H364.15c-28.12,0-33.48,13.3-33.48,32.9V240h67l-8.75,64H330.67V480h124.6A24.74,24.74,0,0,0,480,455.27V56.73A24.74,24.74,0,0,0,455.27,32Z">
                                        </path>
                                    </svg>
                                </a>
                            </li>
                            <!--twitter-->
                            <li class="inline-block">
                                <a target="_blank" class="hover:text-gray-100" rel="noopener noreferrer"
                                    href="https://twitter.com" title="Twitter">
                                    <!-- <i class="fab fa-twitter fa-2x"></i> -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem"
                                        viewBox="0 0 512 512">
                                        <path fill="currentColor"
                                            d="M496,109.5a201.8,201.8,0,0,1-56.55,15.3,97.51,97.51,0,0,0,43.33-53.6,197.74,197.74,0,0,1-62.56,23.5A99.14,99.14,0,0,0,348.31,64c-54.42,0-98.46,43.4-98.46,96.9a93.21,93.21,0,0,0,2.54,22.1,280.7,280.7,0,0,1-203-101.3A95.69,95.69,0,0,0,36,130.4C36,164,53.53,193.7,80,211.1A97.5,97.5,0,0,1,35.22,199v1.2c0,47,34,86.1,79,95a100.76,100.76,0,0,1-25.94,3.4,94.38,94.38,0,0,1-18.51-1.8c12.51,38.5,48.92,66.5,92.05,67.3A199.59,199.59,0,0,1,39.5,405.6,203,203,0,0,1,16,404.2,278.68,278.68,0,0,0,166.74,448c181.36,0,280.44-147.7,280.44-275.8,0-4.2-.11-8.4-.31-12.5A198.48,198.48,0,0,0,496,109.5Z">
                                        </path>
                                    </svg>
                                </a>
                            </li>
                            <!--youtube-->
                            <li class="inline-block">
                                <a target="_blank" class="hover:text-gray-100" rel="noopener noreferrer"
                                    href="https://youtube.com" title="Youtube">
                                    <!-- <i class="fab fa-youtube fa-2x"></i> -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem"
                                        viewBox="0 0 512 512">
                                        <path fill="currentColor"
                                            d="M508.64,148.79c0-45-33.1-81.2-74-81.2C379.24,65,322.74,64,265,64H247c-57.6,0-114.2,1-169.6,3.6-40.8,0-73.9,36.4-73.9,81.4C1,184.59-.06,220.19,0,255.79q-.15,53.4,3.4,106.9c0,45,33.1,81.5,73.9,81.5,58.2,2.7,117.9,3.9,178.6,3.8q91.2.3,178.6-3.8c40.9,0,74-36.5,74-81.5,2.4-35.7,3.5-71.3,3.4-107Q512.24,202.29,508.64,148.79ZM207,353.89V157.39l145,98.2Z">
                                        </path>
                                    </svg>
                                </a>
                            </li>
                            <!--instagram-->
                            <li class="inline-block">
                                <a target="_blank" class="hover:text-gray-100" rel="noopener noreferrer"
                                    href="https://instagram.com" title="Instagram">
                                    <!-- <i class="fab fa-instagram fa-2x"></i> -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem"
                                        viewBox="0 0 512 512">
                                        <path fill="currentColor"
                                            d="M349.33,69.33a93.62,93.62,0,0,1,93.34,93.34V349.33a93.62,93.62,0,0,1-93.34,93.34H162.67a93.62,93.62,0,0,1-93.34-93.34V162.67a93.62,93.62,0,0,1,93.34-93.34H349.33m0-37.33H162.67C90.8,32,32,90.8,32,162.67V349.33C32,421.2,90.8,480,162.67,480H349.33C421.2,480,480,421.2,480,349.33V162.67C480,90.8,421.2,32,349.33,32Z">
                                        </path>
                                        <path fill="currentColor"
                                            d="M377.33,162.67a28,28,0,1,1,28-28A27.94,27.94,0,0,1,377.33,162.67Z">
                                        </path>
                                        <path fill="currentColor"
                                            d="M256,181.33A74.67,74.67,0,1,1,181.33,256,74.75,74.75,0,0,1,256,181.33M256,144A112,112,0,1,0,368,256,112,112,0,0,0,256,144Z">
                                        </path>
                                    </svg>
                                </a>
                            </li><!--end instagram-->
                        </ul>
                    </div>
                    <div class="flex-shrink max-w-full w-full lg:w-3/5 px-3">
                        <div class="flex flex-wrap flex-row">
                            <div class="flex-shrink max-w-full w-1/2 md:w-1/4 mb-6 lg:mb-0">
                                <h4 class="text-base leading-normal mb-3 uppercase text-gray-100">Product</h4>
                                <ul>
                                    <li class="py-1 hover:text-white"><a href="#">Landing</a></li>
                                    <li class="py-1 hover:text-white"><a href="#">Pages</a></li>
                                    <li class="py-1 hover:text-white"><a href="#">Sections</a></li>
                                    <li class="py-1 hover:text-white"><a href="#">Sign Up</a></li>
                                    <li class="py-1 hover:text-white"><a href="#">Login</a></li>
                                </ul>
                            </div>
                            <div class="flex-shrink max-w-full w-1/2 md:w-1/4 mb-6 lg:mb-0">
                                <h4 class="text-base leading-normal mb-3 uppercase text-gray-100">Support</h4>
                                <ul>
                                    <li class="py-1 hover:text-white"><a href="#">Documentation</a></li>
                                    <li class="py-1 hover:text-white"><a href="#">Changelog</a></li>
                                    <li class="py-1 hover:text-white"><a href="#">Tools</a></li>
                                    <li class="py-1 hover:text-white"><a href="#">Icons</a></li>
                                </ul>
                            </div>
                            <div class="flex-shrink max-w-full w-1/2 md:w-1/4 mb-6 lg:mb-0">
                                <h4 class="text-base leading-normal mb-3 uppercase text-gray-100">Includes</h4>
                                <ul>
                                    <li class="py-1 hover:text-white"><a href="#">Utilities</a></li>
                                    <li class="py-1 hover:text-white"><a href="#">Components</a></li>
                                    <li class="py-1 hover:text-white"><a href="#">Example code</a></li>
                                    <li class="py-1 hover:text-white"><a href="#">Updates</a></li>
                                </ul>
                            </div>
                            <div class="flex-shrink max-w-full w-1/2 md:w-1/4 mb-6 lg:mb-0">
                                <h4 class="text-base leading-normal mb-3 uppercase text-gray-100">Legal</h4>
                                <ul>
                                    <li class="py-1 hover:text-white hover:text-white"><a href="#">Privacy
                                            Policy</a></li>
                                    <li class="py-1 hover:text-white"><a href="#">Terms of Use</a></li>
                                    <li class="py-1 hover:text-white"><a href="#">License</a></li>
                                    <li class="py-1 hover:text-white"><a href="#">GDPR</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Start footer copyright-->
        <div class="footer-dark">
            <div class="container py-4 border-t border-gray-200 border-opacity-10">
                <div class="row">
                    <div class="col-12 col-md text-center">
                        <p class="d-block my-3">Copyright © Your Company | All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div><!--End footer copyright-->
    </footer><!-- end footer -->

    <!-- =========={ SCROLL TO TOP }==========  -->
    <a href="#"
        class="back-top fixed p-4 rounded bg-gray-100 border border-gray-100 text-gray-500 dark:bg-gray-900 dark:border-gray-800 right-4 bottom-4 hidden"
        aria-label="Scroll To Top">
        <svg width="1rem" height="1rem" viewBox="0 0 16 16" fill="currentColor"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M8 3.5a.5.5 0 01.5.5v9a.5.5 0 01-1 0V4a.5.5 0 01.5-.5z" clip-rule="evenodd">
            </path>
            <path fill-rule="evenodd"
                d="M7.646 2.646a.5.5 0 01.708 0l3 3a.5.5 0 01-.708.708L8 3.707 5.354 6.354a.5.5 0 11-.708-.708l3-3z"
                clip-rule="evenodd"></path>
        </svg>
    </a>

    <!--Vendor js-->
    {{-- <script src="src/vendors/hc-sticky/dist/hc-sticky.js"></script>
    <script src="src/vendors/glightbox/dist/js/glightbox.min.js"></script>
    <script src="src/vendors/@splidejs/splide/dist/js/splide.min.js"></script>
    <script src="src/vendors/@splidejs/splide-extension-video/dist/js/splide-extension-video.min.js"></script>

    <!-- Start development js -->
    <script src="src/js/theme.js"></script> --}}
    <!-- End development js -->

    <!-- Production js -->
    <!-- <script src="dist/js/scripts.js"></script> -->
</body>

</html>
