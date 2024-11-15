<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plant Shop - Product</title>
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
            <!-- Product Image -->
            <div class="col-md-6">
                <img src="img/product_image.jpg" alt="Product Image" class="img-fluid">
            </div>
            <div class="col-md-6">
                <h3 class="text-success">$15.00</h3>
                <h1 class="mb-3">Nombre del Producto</h1>
                <div class="d-flex align-items-center mb-3">
                    <span class="me-2">★★★★★</span>
                    <a href="#" class="ms-3 text-muted">Write A Review</a>
                </div>
                <p class="text-success mb-3">In Stock</p>
                <p class="description">Descripción del producto.</p>
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
                "name": "Aloe Vera",
                "price": "$150 MXN",
                "image": "img/img_productos/Desierto/aloeVera.jpg",
                "description": "Planta suculenta con hojas carnosas que se usa en tratamientos de piel por sus propiedades hidratantes y curativas.",
                "stock": "In Stock"
            },
            "cactus": {
                "name": "Cactus",
                "price": "$200 MXN",
                "image": "img/img_productos/Desierto/cactus.jpg",
                "description": "Cactus columnar resistente, ideal para exteriores, conocido por su rápido crecimiento.",
                "stock": "In Stock"
            },
            "euphorbia": {
                "name": "Euphorbia Trigona",
                "price": "$220 MXN",
                "image": "img/img_productos/Desierto/Euphorbia_trigona.jpg",
                "description": "Planta vertical con espinas decorativas, perfecta para dar un toque exótico.",
                "stock": "In Stock"
            },
            "nopalitos": {
                "name": "Opuntia Microdasys (Nopalitos)",
                "price": "$120 MXN",
                "image": "img/img_productos/Desierto/nopalitos.jpeg",
                "description": "Cactus de 'orejas' pequeñas con espinas diminutas, muy decorativo.",
                "stock": "In Stock"
            },
            "siempreviva": {
                "name": "Siempreviva de Palmer",
                "price": "$130 MXN",
                "image": "img/img_productos/Desierto/siempreviva.jpeg",
                "description": "Suculenta de hojas verdes con bordes rojizos, resistente a la sequía y con flores amarillas en primavera. Ideal para jardines de bajo mantenimiento.",
                "stock": "In Stock"
            },
            "lirio": {
                "name": "Lirio de Agua",
                "price": "$90 MXN",
                "image": "img/img_productos/Agua/lirio.jpg",
                "description": "Planta flotante con flores vistosas, ideal para decorar estanques.",
                "stock": "In Stock"
            },
            "jacinto": {
                "name": "Jacinto de Agua",
                "price": "$100 MXN",
                "image": "img/img_productos/Agua/jacinto.jpg",
                "description": "Planta flotante que oxigena el agua y previene la formación de algas.",
                "stock": "In Stock"
            },
            "cabomba": {
                "name": "Cabomba Caroliniana",
                "price": "$70 MXN",
                "image": "img/img_productos/Agua/cabomba.jpeg",
                "description": "Planta sumergida con hojas delicadas, útil para refugio de peces.",
                "stock": "In Stock"
            },
            "musgo": {
                "name": "Musgo de Java",
                "price": "$50 MXN",
                "image": "img/img_productos/Agua/musgoJava.webp",
                "description": "Musgo fácil de cuidar que mejora la estética de acuarios.",
                "stock": "In Stock"
            },
            "anubias": {
                "name": "Anubias Barteri",
                "price": "$90 MXN",
                "image": "img/img_productos/Agua/anubias.jpeg",
                "description": "Planta robusta de hojas gruesas, ideal para acuarios de bajo mantenimiento.",
                "stock": "In Stock"
            },
            "helecho": {
                "name": "Helecho Boston",
                "price": "$130 MXN",
                "image": "img/img_productos/Sombra/helecho.jpeg",
                "description": "Planta frondosa que da un toque natural a interiores y jardines sombreados.",
                "stock": "In Stock"
            },
            "calathea": {
                "name": "Calathea Orbifolia",
                "price": "$280 MXN",
                "image": "img/img_productos/Sombra/calathea.jpg",
                "description": "Planta tropical con hojas grandes y rayadas, ideal para decoración.",
                "stock": "In Stock"
            },
            "palmaKentia": {
                "name": "Palma Kentia",
                "price": "$500 MXN",
                "image": "img/img_productos/Sombra/palmaKentia.jpg",
                "description": "Palma elegante y de crecimiento lento, perfecta para interiores oscuros.",
                "stock": "In Stock"
            },
            "aspidistra": {
                "name": "Aspidistra Elatior",
                "price": "$250 MXN",
                "image": "img/img_productos/Sombra/aspidistra.jpg",
                "description": "Planta resistente, ideal para espacios con poca luz y cuidado mínimo.",
                "stock": "In Stock"
            },
            "dieffenbachia": {
                "name": "Dieffenbachia Seguine",
                "price": "$180 MXN",
                "image": "img/img_productos/Sombra/dieffenbachia.jpeg",
                "description": "Planta tropical con hojas grandes, perfecta para interiores con sombra.",
                "stock": "In Stock"
            },
            "lavanda": {
                "name": "Lavanda",
                "price": "$100 MXN",
                "image": "img/img_productos/Aromaticas/lavanda .jpg",
                "description": "Planta aromática con flores púrpuras, usada en aceites esenciales y relajación.",
                "stock": "In Stock"
            },
            "romero": {
                "name": "Romero",
                "price": "$80 MXN",
                "image": "img/img_productos/Aromaticas/romero.jpg",
                "description": "Hierba versátil en cocina y medicina natural, con propiedades digestivas.",
                "stock": "In Stock"
            },
            "tomillo": {
                "name": "Tomillo",
                "price": "$75 MXN",
                "image": "img/img_productos/Aromaticas/tomillo.jpeg",
                "description": "Hierba aromática usada en cocina y remedios naturales, conocida por sus propiedades antisépticas y su sabor característico.",
                "stock": "In Stock"
            },
            "hierbabuena": {
                "name": "Hierbabuena",
                "price": "$60 MXN",
                "image": "img/img_productos/Aromaticas/hierbabuena.jpg",
                "description": "Planta refrescante utilizada en bebidas, postres y remedios caseros.",
                "stock": "In Stock"
            },
            "albahaca": {
                "name": "Albahaca",
                "price": "$70 MXN",
                "image": "img/img_productos/Aromaticas/albahaca.jpg",
                "description": "Planta de hojas aromáticas, esencial en cocina mediterránea.",
                "stock": "In Stock"
            },
            "monstera": {
                "name": "Monstera Deliciosa",
                "price": "$400 MXN",
                "image": "img/img_productos/Casa/monstera.jpeg",
                "description": "Planta de hojas grandes con agujeros, ideal para decorar espacios amplios.",
                "stock": "In Stock"
            },
            "lengua": {
                "name": "Sansevieria (Lengua de Suegra)",
                "price": "$150 MXN",
                "image": "img/img_productos/Casa/lenguaSuegra.jpeg",
                "description": "Planta purificadora de aire, muy resistente.",
                "stock": "In Stock"
            },
            "zamioculcas": {
                "name": "Zamioculcas Zamiifolia (ZZ Plant)",
                "price": "$300 MXN",
                "image": "img/img_productos/Casa/zamioculcas.jpeg",
                "description": "Planta de bajo mantenimiento, perfecta para interiores oscuros.",
                "stock": "In Stock"
            },
            "plantaChina": {
                "name": "Pilea Peperomioides (Planta China del Dinero)",
                "price": "$160 MXN",
                "image": "img/img_productos/Casa/pilea.jpeg",
                "description": "Planta de hojas redondeadas, popular en decoración moderna.",
                "stock": "In Stock"
            },
            "paloBrasil": {
                "name": "Palo de Brasil",
                "price": "$350 MXN",
                "image": "img/img_productos/Casa/paloBrasil.jpeg",
                "description": "Planta decorativa de hojas verdes brillantes, ideal para interiores por su fácil cuidado y capacidad purificadora de aire.",
                "stock": "In Stock"
            },
            "ajenjo": {
                "name": "Ajenjo",
                "price": "$85 MXN",
                "image": "img/img_productos/Medicinales/ajenjo.jpeg",
                "description": "Con propiedades digestivas y antiparasitarias, el ajenjo se usa en infusiones para aliviar problemas gastrointestinales. También se utiliza en la elaboración de ciertos licores.",
                "stock": "In Stock"
            },
            "echinacea": {
                "name": "Echinacea",
                "price": "$90 MXN",
                "image": "img/img_productos/Medicinales/equinacea.jpeg",
                "description": "Estimula el sistema inmunológico, ayudando a prevenir y tratar resfriados y otras infecciones respiratorias.",
                "stock": "In Stock"
            },
            "manzanilla": {
                "name": "Manzanilla",
                "price": "$65 MXN",
                "image": "img/img_productos/Medicinales/manzanilla.png",
                "description": "Conocida por sus propiedades calmantes, la manzanilla se usa en infusiones para reducir el estrés, mejorar el sueño y aliviar molestias digestivas leves.",
                "stock": "In Stock"
            },
            "ortiga": {
                "name": "Ortiga (Urtica Dioica)",
                "price": "$70 MXN",
                "image": "img/img_productos/Medicinales/ortiga.jpeg",
                "description": "Con propiedades antiinflamatorias y diuréticas, la ortiga se utiliza para aliviar síntomas de alergias y para tratar problemas de retención de líquidos.",
                "stock": "In Stock"
            },
            "salvia": {
                "name": "Salvia",
                "price": "$100 MXN",
                "image": "img/img_productos/Medicinales/salvia.jpg",
                "description": "Utilizada para mejorar la digestión y aliviar dolores menstruales. También se emplea en gárgaras para tratar dolor de garganta y problemas bucales.",
                "stock": "In Stock"
            }
        };

        // Obtener el id del producto desde los parámetros de la URL
        const productId = getQueryParams();

        // Obtener el producto correspondiente
        const product = products[productId];

        // Renderizar la información del producto
        if (product) {
            document.querySelector('h1').innerText = product.name;
            document.querySelector('h3').innerText = product.price;
            document.querySelector('.img-fluid').src = product.image;
            document.querySelector('.img-fluid').alt = product.name;
            document.querySelector('p.text-success').innerText = product.stock;
            document.querySelector('p.description').innerText = product.description;
        } else {
            // Si no se encuentra el producto, mostrar un mensaje de error o redirigir
            document.querySelector('h1').innerText = "Producto no encontrado";
        }
    </script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>