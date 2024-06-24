@extends('components.layouts.main')

@section('container')
<main>
    {{-- Home --}}
    <section id="Hero" class="banner">
        <div class="container container-home text-white">
            <div class="text-center">
                <h1 class="heading1">Discover the Taste of Delight</h1>
                <p class="body-text-small mt-3">At D'Restaurant, we bring you a culinary experience like no other. Our menu is a celebration of flavors, crafted with love and the finest ingredients. Every dish is a testament to our commitment to quality and creativity, offering a unique and memorable dining experience.</p>
                <button type="button" class="btn-home mt-4" onclick="window.location.href='{{ route('reservation') }}'">Book A Table</button>
            </div>
        </div>
    </section>

    {{-- Our Story --}}
    <section>
        <div class="container container-about">
            <div class="row">
                <div class="col-3 d-flex flex-column justify-content-between">
                    <img src="./img/story2.png" class="img-fluid" alt="">
                    <img src="./img/story3.png" class="img-fluid" alt="">
                </div>
                <div class="col-3">
                    <img src="./img/story1.png" class="img-fluid img-style1" alt="">
                </div>
                <div class="col-6 d-flex align-items-center">
                    <div>
                        <h1 class="heading1" style="color: #896D3C;">Our Story</h1>
                        <p class="body-text">Founded with a passion for culinary excellence and a deep-rooted commitment to community. From our humble beginnings, we've evolved into a cherished local establishment known for our dedication to quality and hospitality. Every dish we create is a labor of love, crafted with the finest ingredients and a commitment to excellence. We believe that food has the power to unite, inspire, and create unforgettable moments. Come taste the difference, experience the warmth of our hospitality, and become part of our story at D'Restaurant.</p>
                        <a href="">
                            <p class="body-text mt-3" style="color: black; font-weight: 600; text-decoration-line: underline;">More about us</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Menu --}}
    <section id="Menu">
        <div class="" style="background-color: #232323;">
            <div class="container container-menu text-white py-5">
                <div class="row">
                    <div class="col-4">
                        <img src="./img/menu.png" class="img-fluid img-style1" alt="">
                    </div>
                    <div class="col-8">
                        <h3 class="heading3">O u r&nbsp;&nbsp;S p e c i a l</h3>
                        <h1 class="heading1 mb-4">Menu</h1>
                        <div class="mt-5">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="body-text" style="font-weight: 500;">Lorem ipsum dolor sit amet</h5>
                                    <p class="body-text-small" style="font-weight: 300;">Lorem ipsum dolor sit amet</p>
                                </div>
                                <p class="body-text-small" style="font-weight: 500;">50K</p>
                            </div>
                            <hr>
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="body-text" style="font-weight: 500;">Lorem ipsum dolor sit amet</h5>
                                    <p class="body-text-small" style="font-weight: 300;">Lorem ipsum dolor sit amet</p>
                                </div>
                                <p class="body-text-small" style="font-weight: 500;">50K</p>
                            </div>
                            <hr>

                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="body-text" style="font-weight: 500;">Lorem ipsum dolor sit amet</h5>
                                    <p class="body-text-small" style="font-weight: 300;">Lorem ipsum dolor sit amet</p>
                                </div>
                                <p class="body-text-small" style="font-weight: 500;">50K</p>
                            </div>
                            <hr>

                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="body-text" style="font-weight: 500;">Lorem ipsum dolor sit amet</h5>
                                    <p class="body-text-small" style="font-weight: 300;">Lorem ipsum dolor sit amet</p>
                                </div>
                                <p class="body-text-small" style="font-weight: 500;">50K</p>
                            </div>
                            <hr>

                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="body-text" style="font-weight: 500;">Lorem ipsum dolor sit amet</h5>
                                    <p class="body-text-small" style="font-weight: 300;">Lorem ipsum dolor sit amet</p>
                                </div>
                                <p class="body-text-small" style="font-weight: 500;">50K</p>
                            </div>
                            <hr>
                        </div>
                        <button type="button" class="btn-style1 mt-3">View More</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Reservation --}}
    <section id="Reservation">
        <div class="container container-reservation">
            <div class="row">
                <div class="col-7 d-flex align-items-center">
                    <div>
                        <h1 class="heading1" style="color: #232323;">Make Your Reservation</h1>
                        <p class="body-text">Book your experience with us today. Whether it's for a delightful brunch, a cozy lunch date, or an evening of fine dining, reserve your table now and savor moments of culinary bliss with us. Our team is dedicated to ensuring every visit is special, tailored to your preferences.</p>
                        <button type="button" class="btn-style1 mt-3" onclick="window.location.href='{{ route('reservation') }}'">Book A Table</button>
                    </div>
                </div>
                <div class="col-5">
                    <img src="./img/booking.jpg" class="img-fluid img-style1" alt="">
                </div>
            </div>
        </div>
    </section>
</main>
@endsection