<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D'RESTAURANT - KITCHEN PROCESS</title>

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Caveat&family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Outfit:wght@100..900&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="banner-kitchen">
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent fixed-top py-3">
        <div class="container">
            <a class="navbar-brand" class="d-inline-block align-text-top" style="font-size: 30px;" href="">Recent
                Orders</a>
        </div>
    </nav>
    <!-- Navbar End -->

    <section>
        <div class="container container-kitchen">
            <div class="card mb-3">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="order-label">Order #1</div>
                        <ul class="list-group list-group-flush mt-3">
                            <li class="list-group-item"><strong>Amount:</strong> $50.00</li>
                            <li class="list-group-item"><strong>Date:</strong> 2024-06-22</li>
                            <li class="list-group-item"><strong>Menu:</strong>
                                <ul>
                                    <li>Garlic Butter Shrimp Skewers</li>
                                    <li>Caesar Salad Supreme</li>
                                    <li>Beef Tenderloin with Red Wine Reduction</li>
                                    <li>Chocolate Lava Cake</li>
                                    <li>Freshly Squeezed Orange Juice</li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <button class="btn shadow-sm btn-outline-success p-4">Mark as Completed</button>
                </div>
            </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoB0ow4bGI+r9+gin1pD5z1qUGQZUk5fU3/hk7K7fmgK3pT"
        crossorigin="anonymous"></script>
</body>

<script src="{{ asset('js/script.js') }}"></script>

</html>