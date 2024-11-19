<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALMANTA - Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="/img/ALMANTA_logo.png" type="image/png">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container">
            <a href="index.php" class="navbar-brand">
                <img src="img/ALMANTA_logo2.png" alt="Almanta Logo" class="logo" width="300">
            </a>
            <a class="navbar-brand" href="index.php">Menu</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="catalog.php">Catalog</a></li>
                    <li class="nav-item"><a class="nav-link" href="cart.php">Cart</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>

                    <!-- User Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-2"></i>
                            <?php
                            // Verifica si el usuario está en sesión y muestra su nombre
                            echo isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'User';
                            ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <?php if (isset($_SESSION['user_id'])): ?>
                                <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                                <li><a class="dropdown-item" href="logout.php">Log out</a></li>
                            <?php else: ?>
                                <li><a class="dropdown-item" href="register.php">Register</a></li>
                                <li><a class="dropdown-item" href="login.php">Log in</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Product Section -->
    <div class="container py-5">
        <div class="row">
            <!-- Imagen del producto -->
            <div class="col-md-6">
                <img src="img/product_image.jpg" alt="Product Image" class="img-fluid">
            </div>
            <div class="col-md-6">
                <!-- precio -->
                <h3 class="text-secondary">$0 MXN</h3>
                <!-- producto -->
                <h1 class="mb-3">Nombre del Producto</h1>
                <!-- stock -->
                <p class="text-secondary mb-3">In Stock</p>
                <!-- descripción -->
                <p class="description">Descripción del producto.</p>
                <!-- origen -->
                <p class="origen">Origen del producto.</p>
                <!-- fabricante -->
                <p class="fabricante">Fabricante del producto.</p>
                <div class="d-flex align-items-center mb-3">
                    <label for="quantity" class="me-3">Qty</label>
                    <input type="number" id="quantity" class="form-control w-auto" value="1" min="1">
                </div>
                <button class="btn btn-custom btn-lg w-100">Add to cart</button>
            </div>
        </div>
    </div>
    </div>
    <script>
        // Función para obtener los parámetros de la URL
        function getQueryParams() {
            const params = new URLSearchParams(window.location.search);
            return params.get('id');
        }

        // Datos de todas las plantas
        const products = {
            "aloe": {
                "id": "",
                "nombre": "Aloe Vera",
                "precio": "$150 MXN",
                "fotos": "img/img_productos/Desierto/aloeVera.jpg",
                "descripcion": "Succulent plant with fleshy leaves, used in skin treatments for its hydrating and healing properties.",
                "cantidad_almacen": 45,
                "fabricante": "Vivero CactusLand",
                "origen": "North Africa"
            },
            "cactus": {
                "nombre": "Cactus",
                "precio": "$200 MXN",
                "fotos": "img/img_productos/Desierto/cactus.jpg",
                "descripcion": "Resilient columnar cactus, ideal for outdoor use, known for its fast growth.",
                "cantidad_almacen": 67,
                "fabricante": "Jardines del Sol",
                "origen": "Peru"
            },
            "euphorbia": {
                "nombre": "Euphorbia Trigona",
                "precio": "$220 MXN",
                "fotos": "img/img_productos/Desierto/Euphorbia_trigona.jpg",
                "descripcion": "Vertical plant with decorative spines, perfect for adding an exotic touch.",
                "cantidad_almacen": 34,
                "fabricante": "Cactáceas del Norte",
                "origen": "Africa"
            },
            "nopalitos": {
                "nombre": "Opuntia Microdasys (Nopalitos)",
                "precio": "$120 MXN",
                "fotos": "img/img_productos/Desierto/nopalitos.jpeg",
                "descripcion": "Cactus with small 'ears' and tiny spines, very decorative.",
                "cantidad_almacen": 50,
                "fabricante": "Cactus del Desierto",
                "origen": "Mexico"
            },
            "siempreviva": {
                "nombre": "Siempreviva de Palmer",
                "precio": "$130 MXN",
                "fotos": "img/img_productos/Desierto/siempreviva.jpeg",
                "descripcion": "Succulent with green leaves and reddish edges, drought-resistant with yellow flowers in spring. Ideal for low-maintenance gardens.",
                "cantidad_almacen": 75,
                "fabricante": "Suculentas del Sol",
                "origen": "Mexico"
            },
            "lirio": {
                "nombre": "Lirio de Agua",
                "precio": "$90 MXN",
                "fotos": "img/img_productos/Agua/lirio.jpg",
                "descripcion": "Floating plant with showy flowers, ideal for decorating ponds.",
                "cantidad_almacen": 20,
                "fabricante": "AquaFlores",
                "origen": "South America"
            },
            "jacinto": {
                "nombre": "Jacinto de Agua",
                "precio": "$100 MXN",
                "fotos": "img/img_productos/Agua/jacinto.jpg",
                "descripcion": "Floating plant that oxygenates the water and prevents algae formation.",
                "cantidad_almacen": 62,
                "fabricante": "AquaVida",
                "origen": "Amazon"
            },
            "cabomba": {
                "nombre": "Cabomba Caroliniana",
                "precio": "$70 MXN",
                "fotos": "img/img_productos/Agua/cabomba.jpeg",
                "descripcion": "Submerged plant with delicate leaves, useful for fish shelter.",
                "cantidad_almacen": 80,
                "fabricante": "AquaPlantas",
                "origen": "United States"
            },
            "musgo": {
                "nombre": "Musgo de Java",
                "precio": "$50 MXN",
                "fotos": "img/img_productos/Agua/musgoJava.webp",
                "descripcion": "Easy-to-care-for moss that enhances aquarium aesthetics.",
                "cantidad_almacen": 28,
                "fabricante": "GreenWater",
                "origen": "Asia"
            },
            "anubias": {
                "nombre": "Anubias Barteri",
                "precio": "$90 MXN",
                "fotos": "img/img_productos/Agua/anubias.jpeg",
                "descripcion": "Robust plant with thick leaves, ideal for low-maintenance aquariums.",
                "cantidad_almacen": 95,
                "fabricante": "AquaPlantas",
                "origen": "West Africa"
            },
            "helecho": {
                "nombre": "Helecho Boston",
                "precio": "$130 MXN",
                "fotos": "img/img_productos/Sombra/helecho.jpeg",
                "descripcion": "Lush plant that adds a natural touch to interiors and shaded gardens.",
                "cantidad_almacen": 60,
                "fabricante": "SombraVerde",
                "origen": "Florida, USA"
            },
            "calathea": {
                "nombre": "Calathea Orbifolia",
                "precio": "$280 MXN",
                "fotos": "img/img_productos/Sombra/calathea.jpg",
                "descripcion": "Tropical plant with large, striped leaves, ideal for decoration.",
                "cantidad_almacen": 33,
                "fabricante": "CasaCalathea",
                "origen": "South America"
            },
            "palmaKentia": {
                "nombre": "Palma Kentia",
                "precio": "$500 MXN",
                "fotos": "img/img_productos/Sombra/palmaKentia.jpg",
                "descripcion": "Elegant, slow-growing palm, perfect for dark interiors.",
                "cantidad_almacen": 41,
                "fabricante": "Jardines Kentia",
                "origen": "Australia"
            },
            "aspidistra": {
                "nombre": "Aspidistra Elatior",
                "precio": "$250 MXN",
                "fotos": "img/img_productos/Sombra/aspidistra.jpg",
                "descripcion": "Resistant plant, ideal for low-light spaces and minimal care.",
                "cantidad_almacen": 47,
                "fabricante": "SombraFeliz",
                "origen": "East Asia"
            },
            "dieffenbachia": {
                "nombre": "Dieffenbachia Seguine",
                "precio": "$180 MXN",
                "fotos": "img/img_productos/Sombra/dieffenbachia.jpeg",
                "descripcion": "Tropical plant with large leaves, perfect for shaded interiors.",
                "cantidad_almacen": 53,
                "fabricante": "VerdeTropical",
                "origen": "South America"
            },
            "lavanda": {
                "nombre": "Lavanda",
                "precio": "$100 MXN",
                "fotos": "img/img_productos/Aromaticas/lavanda .jpg",
                "descripcion": "Aromatic plant with purple flowers, used in essential oils and relaxation.",
                "cantidad_almacen": 38,
                "fabricante": "Aromas del Campo",
                "origen": "Mediterranean"
            },
            "romero": {
                "nombre": "Romero",
                "precio": "$80 MXN",
                "fotos": "img/img_productos/Aromaticas/romero.jpg",
                "descripcion": "Versatile herb in cooking and natural medicine, with digestive properties.",
                "cantidad_almacen": 27,
                "fabricante": "HierbasVivas",
                "origen": "Mediterranean Region"
            },
            "tomillo": {
                "nombre": "Tomillo",
                "precio": "$75 MXN",
                "fotos": "img/img_productos/Aromaticas/tomillo.jpeg",
                "descripcion": "Aromatic herb used in cooking and natural remedies, known for its antiseptic properties and distinctive flavor.",
                "cantidad_almacen": 43,
                "fabricante": "Aroma Natural",
                "origen": "Mediterranean"
            },
            "hierbabuena": {
                "nombre": "Hierbabuena",
                "precio": "$60 MXN",
                "fotos": "img/img_productos/Aromaticas/hierbabuena.jpg",
                "descripcion": "Refreshing plant used in beverages, desserts, and home remedies.",
                "cantidad_almacen": 50,
                "fabricante": "Aromas Verdes",
                "origen": "Asia"
            },
            "albahaca": {
                "nombre": "Albahaca",
                "precio": "$70 MXN",
                "fotos": "img/img_productos/Aromaticas/albahaca.jpg",
                "descripcion": "Aromatic leaf plant, essential in Mediterranean cuisine.",
                "cantidad_almacen": 22,
                "fabricante": "Herbario CasaVerde",
                "origen": "India"
            },
            "monstera": {
                "nombre": "Monstera Deliciosa",
                "precio": "$400 MXN",
                "fotos": "img/img_productos/Casa/monstera.jpeg",
                "descripcion": "Plant with large, holey leaves, perfect for decorating large spaces.",
                "cantidad_almacen": 18,
                "fabricante": "Hogar Verde",
                "origen": "Mexico and Central America"
            },
            "lengua": {
                "nombre": "Sansevieria (Lengua de Suegra)",
                "precio": "$150 MXN",
                "fotos": "img/img_productos/Casa/lenguaSuegra.jpeg",
                "descripcion": "Air-purifying plant, highly resilient.",
                "cantidad_almacen": 45,
                "fabricante": "VerdeBienestar",
                "origen": "West Africa"
            },
            "zamioculcas": {
                "nombre": "Zamioculcas Zamiifolia (ZZ Plant)",
                "precio": "$300 MXN",
                "fotos": "img/img_productos/Casa/zamioculcas.jpeg",
                "descripcion": "Low-maintenance plant, perfect for dark interiors.",
                "cantidad_almacen": 34,
                "fabricante": "PlantasZeta",
                "origen": "Tanzania"
            },
            "plantaChina": {
                "nombre": "Pilea Peperomioides (Chinese Money Plant)",
                "precio": "$160 MXN",
                "fotos": "img/img_productos/Casa/pilea.jpeg",
                "descripcion": "Plant with rounded leaves, popular in modern decor.",
                "cantidad_almacen": 59,
                "fabricante": "VerdeCasa",
                "origen": "China"
            },
            "paloBrasil": {
                "nombre": "Palo de Brasil",
                "precio": "$350 MXN",
                "fotos": "img/img_productos/Casa/paloBrasil.jpeg",
                "descripcion": "Decorative plant with bright green leaves, ideal for interiors due to its easy care and air-purifying ability.",
                "cantidad_almacen": 60,
                "fabricante": "CasaPlanta",
                "origen": "Brazil"
            },
            "ajenjo": {
                "nombre": "Ajenjo",
                "precio": "$85 MXN",
                "fotos": "img/img_productos/Medicinales/ajenjo.jpeg",
                "descripcion": "With digestive and antiparasitic properties, it is used in infusions to relieve gastrointestinal problems. Also used in making certain liqueurs.",
                "cantidad_almacen": 36,
                "fabricante": "HerbalNature",
                "origen": "Europe"
            },
            "echinacea": {
                "nombre": "Echinacea",
                "precio": "$90 MXN",
                "fotos": "img/img_productos/Medicinales/equinacea.jpeg",
                "descripcion": "Boosts the immune system, helping prevent and treat colds and other respiratory infections.",
                "cantidad_almacen": 48,
                "fabricante": "Herbales Del Bosque",
                "origen": "North America"
            },
            "manzanilla": {
                "nombre": "Manzanilla",
                "precio": "$65 MXN",
                "fotos": "img/img_productos/Medicinales/manzanilla.png",
                "descripcion": "Known for its calming properties, it is used in infusions to reduce stress, improve sleep, and relieve mild digestive discomfort.",
                "cantidad_almacen": 23,
                "fabricante": "NaturalHerbs",
                "origen": "Europe"
            },
            "ortiga": {
                "nombre": "Ortiga (Urtica Dioica)",
                "precio": "$70 MXN",
                "fotos": "img/img_productos/Medicinales/ortiga.jpeg",
                "descripcion": "With anti-inflammatory and diuretic properties, it is used to relieve allergy symptoms and treat fluid retention issues.",
                "cantidad_almacen": 77,
                "fabricante": "Hierbas Naturales",
                "origen": "Europe and Asia"
            },
            "salvia": {
                "nombre": "Salvia",
                "precio": "$100 MXN",
                "fotos": "img/img_productos/Medicinales/salvia.jpg",
                "descripcion": "Used to improve digestion and relieve menstrual pain. Also used in gargles for sore throat and oral issues.",
                "cantidad_almacen": 42,
                "fabricante": "NatureHerbs",
                "origen": "Mediterranean Region"
            }
        };



        // Obtener el id del producto desde los parámetros de la URL
        const productId = getQueryParams();

        // Obtener el producto correspondiente
        const product = products[productId];

        // Renderizar la información del producto
        if (product) {
            document.querySelector('h1').innerText = product.nombre;
            document.querySelector('h3').innerText = product.precio;
            document.querySelector('.img-fluid').src = product.fotos;
            document.querySelector('.img-fluid').alt = product.name;
            document.querySelector('p.text-secondary').innerText = product.cantidad_almacen > 0 ? "--- " + product.cantidad_almacen + " in stock ---" : "Out of stock";
            document.querySelector('p.description').innerText = product.descripcion;
            document.querySelector('p.origen').innerText = "Origin: " + product.origen;
            document.querySelector('p.fabricante').innerText = "Manufacturer: " + product.fabricante;
        } else {
            // Si no se encuentra el producto, mostrar un mensaje de error o redirigir
            document.querySelector('h1').innerText = "Product not found";
        }
    </script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>