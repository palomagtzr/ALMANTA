<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plant Shop - Catalog</title>
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
    <!-- DESERT PLANTS -->
    <div id="desert-plants" class="container py-5">
        <h2 class="mb-4 text-center">DESERT PLANTS</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card m-2">
                    <img src="img/img_productos/Desierto/aloeVera.jpg" class="card-img-top" alt="Aloe Vera">
                    <div class="card-body text-center">
                        <h5 class="card-title">Aloe Vera</h5>
                        <p class="price">$150 MXN</p>
                        <a href="product.php?id=aloe" class="btn btn-custom">View Details</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card m-2">
                    <img src="img/img_productos/Desierto/cactus.jpg" class="card-img-top" alt="Cactus">
                    <div class="card-body text-center">
                        <h5 class="card-title">Cactus</h5>
                        <p class="price">$200 MXN</p>
                        <a href="product.php?id=cactus" class="btn btn-custom">View Details</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card m-2">
                    <img src="img/img_productos/Desierto/Euphorbia_trigona.jpg" class="card-img-top"
                        alt="Euphorbia Trigona">
                    <div class="card-body text-center">
                        <h5 class="card-title">Euphorbia Trigona</h5>
                        <p class="price">$220 MXN</p>
                        <a href="product.php?id=euphorbia" class="btn btn-custom">View Details</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card m-2">
                        <img src="img/img_productos/Desierto/nopalitos.jpeg" class="card-img-top" alt="Nopalitos">
                        <div class="card-body text-center">
                            <h5 class="card-title">Nopalitos</h5>
                            <p class="price">$120 MXN</p>
                            <a href="product.php?id=nopalitos" class="btn btn-custom">View Details</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card m-2">
                        <img src="img/img_productos/Desierto/siempreviva.jpeg" class="card-img-top" alt="Siempreviva">
                        <div class="card-body text-center">
                            <h5 class="card-title">Siempreviva de Palmer</h5>
                            <p class="price">$130 MXN</p>
                            <a href="product.php?id=siempreviva" class="btn btn-custom">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- WATER PLANTS -->
            <div id="water-plants" class="container py-5">
                <h2 class="mb-4 text-center">WATER PLANTS</h2>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="card m-2">
                            <img src="img/img_productos/Agua/anubias.jpeg" class="card-img-top" alt="Anubias">
                            <div class="card-body text-center">
                                <h5 class="card-title">Anubias Barteri</h5>
                                <p class="price">$90 MXN</p>
                                <a href="product.php?id=anubias" class="btn btn-custom">View Details</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card m-2">
                            <img src="img/img_productos/Agua/cabomba.jpeg" class="card-img-top" alt="Cabomba">
                            <div class="card-body text-center">
                                <h5 class="card-title">Cabomba Caroliniana</h5>
                                <p class="price">$70 MXN</p>
                                <a href="product.php?id=cabomba" class="btn btn-custom">View Details</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card m-2">
                            <img src="img/img_productos/Agua/jacinto.jpg" class="card-img-top" alt="Jacinto">
                            <div class="card-body text-center">
                                <h5 class="card-title">Jacinto de Agua</h5>
                                <p class="price">$100 MXN</p>
                                <a href="product.php?id=jacinto" class="btn btn-custom">View Details</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="card m-2">
                                <img src="img/img_productos/Agua/lirio.jpg" class="card-img-top" alt="Lirio">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Lirio de agua</h5>
                                    <p class="price">$90 MXN</p>
                                    <a href="product.php?id=lirio" class="btn btn-custom">View Details</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="card m-2">
                                <img src="img/img_productos/Agua/musgoJava.webp" class="card-img-top" alt="MusgoJava">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Musgo de Java</h5>
                                    <p class="price">$50 MXN</p>
                                    <a href="product.php?id=musgo" class="btn btn-custom">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- AROMATIC PLANTS -->
                    <div id="aromatic-plants" class="container py-5">
                        <h2 class="mb-4 text-center">AROMATIC PLANTS</h2>
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <div class="card m-2">
                                    <img src="img/img_productos/Aromaticas/albahaca.jpg" class="card-img-top"
                                        alt="Albahaca">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Albahaca</h5>
                                        <p class="price">$70 MXN</p>
                                        <a href="product.php?id=albahaca" class="btn btn-custom">View Details</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="card m-2">
                                    <img src="img/img_productos/Aromaticas/hierbabuena.jpg" class="card-img-top"
                                        alt="Hierbabuena">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Hierbabuena</h5>
                                        <p class="price">$60 MXN</p>
                                        <a href="product.php?id=hierbabuena" class="btn btn-custom">View Details</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="card m-2">
                                    <img src="img/img_productos/Aromaticas/lavanda .jpg" class="card-img-top"
                                        alt="Lavanda">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Lavanda</h5>
                                        <p class="price">$100 MXN</p>
                                        <a href="product.php?id=lavanda" class="btn btn-custom">View Details</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <div class="card m-2">
                                        <img src="img/img_productos/Aromaticas/romero.jpg" class="card-img-top"
                                            alt="Romero">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Romero</h5>
                                            <p class="price">$80 MXN</p>
                                            <a href="product.php?id=romero" class="btn btn-custom">View Details</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <div class="card m-2">
                                        <img src="img/img_productos/Aromaticas/tomillo.jpeg" class="card-img-top"
                                            alt="Tomillo">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Tomillo</h5>
                                            <p class="price">$75 MXN</p>
                                            <a href="product.php?id=tomillo" class="btn btn-custom">View Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- HOUSE PLANTS -->
                            <div id="house-plants" class="container py-5">
                                <h2 class="mb-4 text-center">HOUSE PLANTS</h2>
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <div class="card m-2">
                                            <img src="img/img_productos/Casa/lenguaSuegra.jpeg" class="card-img-top"
                                                alt="Lengua de Suegra">
                                            <div class="card-body text-center">
                                                <h5 class="card-title">Lengua de Suegra</h5>
                                                <p class="price">$150 MXN</p>
                                                <a href="product.php?id=lengua" class="btn btn-custom">View Details</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="card m-2">
                                            <img src="img/img_productos/Casa/monstera.jpeg" class="card-img-top"
                                                alt="Monstera Deliciosa">
                                            <div class="card-body text-center">
                                                <h5 class="card-title">Monstera Deliciosa</h5>
                                                <p class="price">$400 MXN</p>
                                                <a href="product.php?id=monstera" class="btn btn-custom">View
                                                    Details</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="card m-2">
                                            <img src="img/img_productos/Casa/paloBrasil.jpeg" class="card-img-top"
                                                alt="Palo de Brasil">
                                            <div class="card-body text-center">
                                                <h5 class="card-title">Palo de Brasil</h5>
                                                <p class="price">$350 MXN</p>
                                                <a href="product.php?id=paloBrasil" class="btn btn-custom">View
                                                    Details</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 mb-4">
                                            <div class="card m-2">
                                                <img src="img/img_productos/Casa/pilea.jpeg" class="card-img-top"
                                                    alt="Planta China del Dinero">
                                                <div class="card-body text-center">
                                                    <h5 class="card-title">Planta China del Dinero</h5>
                                                    <p class="price">$160 MXN</p>
                                                    <a href="product.php?id=plantaChina" class="btn btn-custom">View
                                                        Details</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <div class="card m-2">
                                                <img src="img/img_productos/Casa/zamioculcas.jpeg" class="card-img-top"
                                                    alt="Zamioculcas Zamiifolia">
                                                <div class="card-body text-center">
                                                    <h5 class="card-title">Zamioculcas Zamiifolia</h5>
                                                    <p class="price">$300 MXN</p>
                                                    <a href="product.php?id=zamioculcas" class="btn btn-custom">View
                                                        Details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- INDOOR PLANTS -->
                                    <div id="indoor-plants" class="container py-5">
                                        <h2 class="mb-4 text-center">INDOOR PLANTS</h2>
                                        <div class="row">
                                            <div class="col-md-4 mb-4">
                                                <div class="card m-2">
                                                    <img src="img/img_productos/Sombra/aspidistra.jpg"
                                                        class="card-img-top" alt="Aspidistra Elatior">
                                                    <div class="card-body text-center">
                                                        <h5 class="card-title">Aspidistra Elatior</h5>
                                                        <p class="price">$250 MXN</p>
                                                        <a href="product.php?id=aspidistra" class="btn btn-custom">View
                                                            Details</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-4">
                                                <div class="card m-2">
                                                    <img src="img/img_productos/Sombra/calathea.jpg"
                                                        class="card-img-top" alt="Calathea Orbifolia">
                                                    <div class="card-body text-center">
                                                        <h5 class="card-title">Calathea Orbifolia</h5>
                                                        <p class="price">$280 MXN</p>
                                                        <a href="product.php?id=calathea" class="btn btn-custom">View
                                                            Details</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-4">
                                                <div class="card m-2">
                                                    <img src="img/img_productos/Sombra/dieffenbachia.jpeg"
                                                        class="card-img-top" alt="Dieffenbachia Seguine">
                                                    <div class="card-body text-center">
                                                        <h5 class="card-title">Dieffenbachia Seguine</h5>
                                                        <p class="price">$180 MXN</p>
                                                        <a href="product.php?id=dieffenbachia"
                                                            class="btn btn-custom">View Details</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 mb-4">
                                                    <div class="card m-2">
                                                        <img src="img/img_productos/Sombra/helecho.jpeg"
                                                            class="card-img-top" alt="Helecho Boston">
                                                        <div class="card-body text-center">
                                                            <h5 class="card-title">Helecho Boston</h5>
                                                            <p class="price">$130 MXN</p>
                                                            <a href="product.php?id=helecho" class="btn btn-custom">View
                                                                Details</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-4">
                                                    <div class="card m-2 m-2">
                                                        <img src="img/img_productos/Sombra/palmaKentia.jpg"
                                                            class="card-img-top" alt="Palma Kentia">
                                                        <div class="card-body text-center">
                                                            <h5 class="card-title">Palma Kentia</h5>
                                                            <p class="price">$500 MXN</p>
                                                            <a href="product.php?id=palmaKentia"
                                                                class="btn btn-custom">View
                                                                Details</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- MEDICINAL PLANTS -->
                                            <div id="medicinal-plants" class="container py-5">
                                                <h2 class="mb-4 text-center">MEDICINAL PLANTS</h2>
                                                <div class="row">
                                                    <div class="col-md-4 mb-4">
                                                        <div class="card m-2">
                                                            <img src="img/img_productos/Medicinales/ajenjo.jpeg"
                                                                class="card-img-top" alt="Ajenjo">
                                                            <div class="card-body text-center">
                                                                <h5 class="card-title">Ajenjo</h5>
                                                                <p class="price">$85 MXN</p>
                                                                <a href="product.php?id=ajenjo"
                                                                    class="btn btn-custom">View
                                                                    Details</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-4">
                                                        <div class="card m-2">
                                                            <img src="img/img_productos/Medicinales/equinacea.jpeg"
                                                                class="card-img-top" alt="Echinacea">
                                                            <div class="card-body text-center">
                                                                <h5 class="card-title">Echinacea</h5>
                                                                <p class="price">$90 MXN</p>
                                                                <a href="product.php?id=echinacea"
                                                                    class="btn btn-custom">View
                                                                    Details</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-4">
                                                        <div class="card m-2">
                                                            <img src="img/img_productos/Medicinales/manzanilla.png"
                                                                class="card-img-top" alt="Manzanilla">
                                                            <div class="card-body text-center">
                                                                <h5 class="card-title">Manzanilla</h5>
                                                                <p class="price">$65 MXN</p>
                                                                <a href="product.php?id=manzanilla"
                                                                    class="btn btn-custom">View
                                                                    Details</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4 mb-4">
                                                            <div class="card m-2">
                                                                <img src="img/img_productos/Medicinales/ortiga.jpeg"
                                                                    class="card-img-top" alt="Ortiga">
                                                                <div class="card-body text-center">
                                                                    <h5 class="card-title">Ortiga</h5>
                                                                    <p class="price">$70 MXN</p>
                                                                    <a href="product.php?id=ortiga"
                                                                        class="btn btn-custom">View
                                                                        Details</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 mb-4">
                                                            <div class="card m-2">
                                                                <img src="img/img_productos/Medicinales/salvia.jpg"
                                                                    class="card-img-top" alt="Salvia">
                                                                <div class="card-body text-center">
                                                                    <h5 class="card-title">Salvia</h5>
                                                                    <p class="price">$100 MXN</p>
                                                                    <a href="product.php?id=salvia"
                                                                        class="btn btn-custom">View
                                                                        Details</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <script
                                                        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>