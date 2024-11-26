-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Nov 23, 2024 at 03:01 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tienda`
--

-- --------------------------------------------------------

--
-- Table structure for table `carrito`
--

CREATE TABLE `carrito` (
  `id_producto_carrito` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `historial`
--

CREATE TABLE `historial` (
  `id_compra` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `historial`
--

INSERT INTO `historial` (`id_compra`, `id_usuario`, `id_producto`, `cantidad`) VALUES
(1, 2, 31, 2),
(2, 2, 13, 1),
(3, 1, 3, 1),
(4, 1, 16, 3),
(5, 1, 22, 1),
(6, 3, 30, 1),
(7, 3, 24, 2),
(8, 3, 12, 1),
(9, 4, 20, 1),
(10, 1, 18, 3),
(11, 1, 13, 1),
(12, 1, 11, 2),
(13, 5, 3, 29),
(14, 1, 22, 1),
(15, 1, 17, 3),
(16, 1, 7, 1),
(17, 1, 2, 2),
(18, 1, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `alt_nombre` varchar(50) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `fotos` varchar(255) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad_almacen` int(10) UNSIGNED NOT NULL,
  `fabricante` varchar(255) NOT NULL,
  `origen` varchar(255) NOT NULL,
  `seccion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `alt_nombre`, `descripcion`, `fotos`, `precio`, `cantidad_almacen`, `fabricante`, `origen`, `seccion`) VALUES
(1, 'Aloe Vera', 'aloe', 'Succulent plant with fleshy leaves, used in skin treatments for its hydrating and healing properties.', 'img/img_productos/Desierto/aloeVera.jpg', 150.00, 42, 'Vivero CactusLand', 'África del Norte', 'Desierto'),
(2, 'Cactus', 'cactus', 'Resilient columnar cactus, ideal for outdoor use, known for its fast growth.', 'img/img_productos/Desierto/cactus.jpg', 200.00, 63, 'Jardines del Sol', 'Perú', 'Desierto'),
(3, 'Euphorbia Trigona', 'euphorbia', 'Vertical plant with decorative spines, perfect for adding an exotic touch.', 'img/img_productos/Desierto/Euphorbia_trigona.jpg', 220.00, 28, 'Cactáceas del Norte', 'África', 'Desierto'),
(4, 'Opuntia Microdasys (Nopalitos)', 'nopalitos', 'Cactus with small ears and tiny spines, very decorative.', 'img/img_productos/Desierto/nopalitos.jpeg', 120.00, 50, 'Cactus del Desierto', 'México', 'Desierto'),
(5, 'Siempreviva de Palmer', 'siempreviva', 'Succulent with green leaves and reddish edges, drought-resistant with yellow flowers in spring. Ideal for low-maintenance gardens.', 'img/img_productos/Desierto/siempreviva.jpeg', 130.00, 75, 'Suculentas del Sol', 'México', 'Desierto'),
(6, 'Lirio de Agua', 'lirio', 'Floating plant with showy flowers, ideal for decorating ponds.', 'img/img_productos/Agua/lirio.jpg', 90.00, 20, 'AquaFlores', 'América del Sur', 'Agua'),
(7, 'Jacinto de Agua', 'jacinto', 'Floating plant that oxygenates the water and prevents algae formation.', 'img/img_productos/Agua/jacinto.jpg', 100.00, 61, 'AquaVida', 'Amazonas', 'Agua'),
(8, 'Cabomba Caroliniana', 'cabomba', 'Submerged plant with delicate leaves, useful for fish shelter.', 'img/img_productos/Agua/cabomba.jpeg', 70.00, 80, 'AquaPlantas', 'Estados Unidos', 'Agua'),
(9, 'Musgo de Java', 'musgo', 'Easy-to-care-for moss that enhances aquarium aesthetics.', 'img/img_productos/Agua/musgoJava.webp', 50.00, 28, 'GreenWater', 'Asia', 'Agua'),
(10, 'Anubias Barteri', 'anubias', 'Robust plant with thick leaves, ideal for low-maintenance aquariums.', 'img/img_productos/Agua/anubias.jpeg', 90.00, 95, 'AquaPlantas', 'África Occidental', 'Agua'),
(11, 'Helecho Boston', 'helecho', 'Lush plant that adds a natural touch to interiors and shaded gardens.', 'img/img_productos/Sombra/helecho.jpeg', 130.00, 58, 'SombraVerde', 'Florida, EE. UU.', 'Sombra'),
(12, 'Calathea Orbifolia', 'calathea', 'Tropical plant with large, striped leaves, ideal for decoration.', 'img/img_productos/Sombra/calathea.jpg', 280.00, 32, 'CasaCalathea', 'América del Sur', 'Sombra'),
(13, 'Palma Kentia', 'palmaKentia', 'Elegant, slow-growing palm, perfect for dark interiors.', 'img/img_productos/Sombra/palmaKentia.jpg', 500.00, 39, 'Jardines Kentia', 'Australia', 'Sombra'),
(14, 'Aspidistra Elatior', 'aspidistra', 'Resistant plant, ideal for low-light spaces and minimal care.', 'img/img_productos/Sombra/aspidistra.jpg', 250.00, 47, 'SombraFeliz', 'Asia Oriental', 'Sombra'),
(15, 'Dieffenbachia Seguine', 'dieffenbachia', 'Tropical plant with large leaves, perfect for shaded interiors.', 'img/img_productos/Sombra/dieffenbachia.jpeg', 180.00, 53, 'VerdeTropical', 'América del Sur', 'Sombra'),
(16, 'Lavanda', 'lavanda', 'Aromatic plant with purple flowers, used in essential oils and relaxation.', 'img/img_productos/Aromaticas/lavanda .jpg', 100.00, 19, 'Aromas del Campo', 'Mediterráneo', 'Aromaticas'),
(17, 'Romero', 'romero', 'Versatile herb in cooking and natural medicine, with digestive properties.', 'img/img_productos/Aromaticas/romero.jpg', 80.00, 33, 'HierbasVivas', 'Región Mediterránea', 'Aromaticas'),
(18, 'Tomillo', 'tomillo', 'Aromatic herb used in cooking and natural remedies, known for its antiseptic properties and distinctive flavor.', 'img/img_productos/Aromaticas/tomillo.jpeg', 75.00, 15, 'Aroma Natural', 'Mediterráneo', 'Aromaticas'),
(19, 'Hierbabuena', 'hierbabuena', 'Refreshing plant used in beverages, desserts, and home remedies.', 'img/img_productos/Aromaticas/hierbabuena.jpg', 60.00, 31, 'Aromas Verdes', 'Asia', 'Aromaticas'),
(20, 'Albahaca', 'albahaca', 'Aromatic leaf plant, essential in Mediterranean cuisine.', 'img/img_productos/Aromaticas/albahaca.jpg', 70.00, 44, 'Herbario CasaVerde', 'India', 'Aromaticas'),
(21, 'Monstera Deliciosa', 'monstera', 'Plant with large, holey leaves, perfect for decorating large spaces.', 'img/img_productos/Casa/monstera.jpeg', 400.00, 13, 'Hogar Verde', 'México y América Central', 'Casa'),
(22, 'Sansevieria (Lengua de Suegra)', 'lengua', 'Air-purifying plant, highly resilient.', 'img/img_productos/Casa/lenguaSuegra.jpeg', 150.00, 34, 'VerdeBienestar', 'África Occidental', 'Casa'),
(23, 'Zamioculcas Zamiifolia (ZZ Plant)', 'zamioculcas', 'Low-maintenance plant, perfect for dark interiors.', 'img/img_productos/Casa/zamioculcas.jpeg', 300.00, 55, 'PlantasZeta', 'Tanzania', 'Casa'),
(24, 'Pilea Peperomioides (Planta China del Dinero)', 'plantaChina', 'Plant with rounded leaves, popular in modern decor.', 'img/img_productos/Casa/pilea.jpeg', 160.00, 38, 'VerdeCasa', 'China', 'Casa'),
(25, 'Palo de Brasil', 'paloBrasil', 'Decorative plant with bright green leaves, ideal for interiors due to its easy care and air-purifying ability.', 'img/img_productos/Casa/paloBrasil.jpeg', 350.00, 10, 'CasaPlanta', 'Brasil', 'Casa'),
(26, 'Ajenjo', 'ajenjo', 'With digestive and antiparasitic properties, it is used in infusions to relieve gastrointestinal problems. Also used in making certain liqueurs.', 'img/img_productos/Medicinales/ajenjo.jpeg', 85.00, 25, 'HerbalNature', 'Europa', 'Medicinales'),
(27, 'Echinacea', 'echinacea', 'Boosts the immune system, helping prevent and treat colds and other respiratory infections.', 'img/img_productos/Medicinales/equinacea.jpeg', 90.00, 29, 'Herbales Del Bosque', 'América del Norte', 'Medicinales'),
(28, 'Manzanilla', 'manzanilla', 'Known for its calming properties, it is used in infusions to reduce stress, improve sleep, and relieve mild digestive discomfort.', 'img/img_productos/Medicinales/manzanilla.png', 65.00, 49, 'NaturalHerbs', 'Europa', 'Medicinales'),
(29, 'Ortiga (Urtica Dioica)', 'ortiga', 'With anti-inflammatory and diuretic properties, it is used to relieve allergy symptoms and treat fluid retention issues.', 'img/img_productos/Medicinales/ortiga.jpeg', 70.00, 63, 'Hierbas Naturales', 'Europa y Asia', 'Medicinales'),
(30, 'Salvia', 'salvia', 'Used to improve digestion and relieve menstrual pain. Also used in gargles for sore throat and oral issues.', 'img/img_productos/Medicinales/salvia.jpg', 100.00, 51, 'NatureHerbs', 'Región Mediterránea', 'Medicinales'),
(31, 'Ficus Elastica (Árbol del caucho)', 'ficus', 'Indoor plant with large, shiny dark green leaves, ideal for shady environments.', 'img/img_productos/Sombra/ficus.jpg', 220.00, 23, 'Hogar Natural', 'India', 'Sombra');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `num_tarjeta_bancaria` varchar(20) NOT NULL,
  `direccion_postal` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `contraseña`, `fecha_nacimiento`, `num_tarjeta_bancaria`, `direccion_postal`) VALUES
(1, 'Paloma Gutierrez', 'palomagutric@gmail.com', '$2y$10$wZ6llYkyVWk2i4JlmSohAOrVWNKDLMdrGdq9VV7mGwjeLfttT0eB.', '2002-04-01', '01234567890123456789', '52787'),
(2, 'María Ricaud Velasco', 'mariaricaud@gmail.com', '$2y$10$PvrPS3BRzkDSRsIlH5HWqO.PqhWdJyqPSjjb6c4VFPBByz4NpUf5C', '1974-03-23', '12345678901234567890', 'Paseo de ahuahuetes 198, México, 52783'),
(3, 'Juan Dominguez Rodriguez', 'juandomr1980@hotmail.com', '$2y$10$sFP8.lEeEv.fxOXuLji2BuSyYCaOt9cnTWGhj1oA7JcaryqaxAYK.', '1980-02-03', '10293874656547389201', 'Bosques de las Lomas, México, 52293'),
(4, 'Tania Solis Mena', 'taniasolis23@yahoo.com.mx', '$2y$10$357UKLWJPviH2DXzpOX5RurLUHGBuNgul/.KKrNu/VT/97qN2LY0O', '1999-11-21', '1357913579012384', 'Av. Horacio 187, México, 28643'),
(5, 'Bruno', 'bruno@correo.com', '$2y$10$S7DSGh41Bhhylz4vIYwI4.vJX1HZe26Xp9eZHPCZ6Ifs1H54088oC', '2001-06-10', '123456789', '12345');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id_producto_carrito`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indexes for table `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`id_compra`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_email` (`correo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id_producto_carrito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `historial`
--
ALTER TABLE `historial`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `carrito_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`);

--
-- Constraints for table `historial`
--
ALTER TABLE `historial`
  ADD CONSTRAINT `historial_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
