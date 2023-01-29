-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2022 at 11:24 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `floraes`
--

-- --------------------------------------------------------

--
-- Table structure for table `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,
  `idPlanta` int(11) NOT NULL,
  `email` varchar(20) NOT NULL,
  `descripcion` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `fotos`
--

CREATE TABLE `fotos` (
  `idFoto` int(11) NOT NULL,
  `idPlanta` int(11) NOT NULL,
  `extension` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fotos`
--

INSERT INTO `fotos` (`idFoto`, `idPlanta`, `extension`) VALUES
(50, 58, '.jpg'),
(52, 60, '.jpg'),
(53, 61, '.jpg'),
(54, 6, '.jpg'),
(60, 64, '.jpg'),
(68, 60, '.webp');

-- --------------------------------------------------------

--
-- Table structure for table `localizacion`
--

CREATE TABLE `localizacion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `localizacion`
--

INSERT INTO `localizacion` (`id`, `nombre`) VALUES
(1, 'Vicalvaro'),
(2, 'Moncloa'),
(3, 'Aravaca'),
(4, 'Pozuelo');

-- --------------------------------------------------------

--
-- Table structure for table `localizacion_plantas`
--

CREATE TABLE `localizacion_plantas` (
  `idRelacion` int(11) NOT NULL,
  `idPlanta` int(11) NOT NULL,
  `idLocalizacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `localizacion_plantas`
--

INSERT INTO `localizacion_plantas` (`idRelacion`, `idPlanta`, `idLocalizacion`) VALUES
(8, 6, 3),
(9, 6, 4),
(77, 58, 2),
(81, 60, 1),
(82, 60, 2),
(83, 61, 2),
(84, 61, 3),
(134, 64, 1),
(135, 64, 2),
(136, 64, 3);

-- --------------------------------------------------------

--
-- Table structure for table `plantas`
--

CREATE TABLE `plantas` (
  `id` int(11) NOT NULL,
  `nombreEs` varchar(50) NOT NULL,
  `nombreLa` varchar(50) NOT NULL,
  `etimologia` varchar(1500) NOT NULL,
  `floracion` varchar(50) NOT NULL,
  `parecidos` varchar(1500) NOT NULL,
  `tam` int(11) NOT NULL,
  `otrosNombres` varchar(1000) NOT NULL,
  `curiosidades` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `plantas`
--

INSERT INTO `plantas` (`id`, `nombreEs`, `nombreLa`, `etimologia`, `floracion`, `parecidos`, `tam`, `otrosNombres`, `curiosidades`) VALUES
(6, 'Abrepuños', 'Centaurea melitensis', 'El nombre genérico Centáurea proviene del latín “centaureus” que a su vez viene del griego Κένταυρος (kentauros), palabra con la que se designaba a los seres mitológicos mitad hombre y mitad caballo que habitaban en las montañas de Tesalia.\r\nEntre ellos destacaba Quirón, que fue un gran educador en música, arte, caza, moral, medicina y cirugía, sabio, prudente, y tutor de varios de los héroes más destacados en la mitología griega, como Aquiles y Hércules.\r\nPlinio el Viejo en su Historia Naturalis, cuenta que “Se dice que Quirón se curó con la ‘centaura’ cuando cayó sobre su pie una flecha al manejar las armas de Hércules, por lo cual algunos la llaman «planta de Quirón»”.\r\nHércules le disparó a Quirón accidentalmente una flecha envenenada con la sangre de la Hidra en el transcurso de una lucha con los centauros, que huían hacia la morada de Quirón. Éste contrajo una dolorosa herida incurable, que lo llevó a ceder su inmortalidad a Prometeo, para poder así morir y escapar del dolor. Fue ascendido al cielo como la constelación Sagitario, o según otras fuentes Centaurus.\r\n\r\nMelitensis se refiere a Melita, nombre antiguo de Malta.', 'Junio Abril - agosto', 'El género Centaurea cuenta con más de 70 especies en la península ibérica, que aún se están estudiando y delimitando, de forma que pueden ser bastantes más. Nuestra península es un centro de diversificación del género, cuya identificación se basa, fundamentalmente en las características de las brácteas del capítulo floral, que son espinosas, dentadas, ciliadas o con fimbrias o flecos, en diverso número, forma, longitud y ángulo.\r\nCentaurea ornata: capítulos más grandes. Apéndice decurrente. Las brácteas tienen como espinitas laterales (fimbrias). Capítulos solitarios. Hojas no decurrentes.\r\nCentaurea melitensis: espinas inferiores curvadas hacia abajo, con minúsculas espinitas en el ápice de la bráctea, junto a la base de la espina principal. Apéndice no decurrente. Capítulos solitarios o en grupos de 2 o 3. Hojas decurrentes.\r\nCentaurea solstitialis: espinas rectas, largas, mayores que el propio capítulo. Apéndice no decurrente. Hojas decurrentes, el limbo se prolonga sobre el tallo, con alas.\r\n', 43, 'Abrepuño, abrimanos, abrojos, argazolla amarilla, arzolla, cardo alazorado, cardo estrellado de flor amarilla, ramón pajarero. (RJB)\r\nCardo escarolado (Guia Omega)\r\nAbre puños (2), abremanos, abrepuño, abrepuños (5), ardolla, arzolla (2), cardo de la arzolla, cardo escarolado (3), cardo escrolado, centaura menor, raíz de la arzolla, risillas de la suegra. (Wikipedia, RJB)\r\n', 'Es nativa de la región mediterránea de Europa, África del Norte y del Oeste, y se encuentra en todo el mundo. Sin embargo la Centaurea ornata es endémica de la Peninsula Iberica.'),
(58, 'Conejitos', 'Lamium amplexicaule', 'Lamiun significa \"boca abierta\". Según otros, proviene del griego y significa garganta, debido al parecido con la forma de cuello de sus flores.\r\nAmplexicaule procede del latín amplector, abrazar, rodear, y del griego kaulos / latín caulis,  tallo; es decir, que abraza al tallo.\r\nZapatitos y conejitos es un nombre que recuerda a la forma de la flor. El nombre de ortiga muerta posiblemente se deba a que parece una ortiga pero no \"pica\" ni es irritante como las ortigas.\r\n', 'Desde mediados del invierno a principios de verano', 'Algunas ortigas, pero estas tienen las hojas más apuntadas.', 20, 'Alagüeña, candilillos, candilitos, chupamieles, chupas, chupetitos del niño Jesús, chupones, chupón, conejito, conejitos (6), conejos, flor rubí, gallitos (2), gargantilla, hierba del cura, lamio (4), manto de la Virgen, meluja de la chupeta, minutisa, ortiga muerta (4), ortiga muerta menor (3), patica de gallo, tirarrina, zapaticos del Señor, zapatillos, zapatitos de la Virgen (3), zapatitos de la virgen. (RJB)', 'Es una de las primeras flores que se abren en invierno.\r\nPosee dos tipos de flores, unas que necesitan de insectos polinizadores para ser fecundadas y otras que no llegan a abrirse y se autopolinizan. Esta peculiaridad permite a la planta estar presente incluso en los meses en los que no hay insectos, ya que no los necesita forzosamente para la polinización. \r\nLas semillas de la ortiga mansa tienen un solo apéndice que atrae a las hormigas que buscan comida. En consecuencia, la planta se dispersa a lugares nuevos gracias a las hormigas.\r\n'),
(60, 'Correhuela', 'Convolvulus Arvensis', 'El nombre Convolvulus arvensis deriva del latín “convolvo” que significa girar sobre sí mismo, que se retuerce.\r\nEl apelativo “arvensis” se refiere a arvense, o lo que es lo mismo, relativo a campos de cultivo.  \r\n', 'De mayo a otoño', '', 125, 'Altabaquillo, arruela, campanica, campanilla (10), campanilla de pobre, campanilla de pobres, campanilla pobre, campanilla silvestre (2), campanillas (4), campanuzas, campánula menor, carigüela, carihuela, carihuelas, carnigüela, carregüela, carrehuela, carreuela, carrigüela (9), carrigüela fina, carrihuela (8), carrihuela hembra, carrijuela, cerrihuela, cornigüela (2), cornigüelo , cornihuela (2), corrayuela, corredora, correguela (2), corregüela (21), corregüela menor (9), correhuela (33), correhuela blanda, correhuela de los campos, correhuela menor (2), correjuela (3), correola, correruela, correvuela (6), correyuela (3), corribuela, corriguala, corrigüela (14), corrigüela , corrigüela borde, corrigüela fina, corrigüela muerta, corrigüela viva, corrihuela (5), corrihuela , corriola (2), corriola blanca, corrivuela, corriyola, corriyuela (4), corroyuela (4), corroyuelas , corruela, corrugüelas, corruhuela, corrulluela, corruviela (2), corruviela , corruyuela (5), corrígela, curriol,', 'Al desarrollarse se enrolla sobre sí misma. Este mecanismo permite a la correhuela enredarse y trepar sobre otras plantas sin necesidad de usar zarcillos como hacen las plantas trepadoras.\r\nLa raíces y estolones de la correhuela pueden alcanzar los 2 metros de profundidad, por lo que resulta prácticamente imposible arrancarla de cuajo sin romperla. De los fragmentos rotos surgen nuevas plantas, así que tratar de arrancarla es ayudarla a desarrollarse con más vigor y con nuevas plántulas.\r\nDurante las fuertes horas de calor en verano las flores se pliegan y cierran.\r\nAunque produce flores atractivas, es a menudo una planta incómoda en los jardines considerada como una fastidiosa mala hierba debido a su crecimiento y que pueden estrangular rápidamente a otras plantas cultivadas. Ocupa muy fácilmente grandes superficies y se enreda a las plantas debilitándolas ya que les hace la competencia por la luz, el agua y los nutrientes.\r\n'),
(61, 'DRABA', 'Lepidium draba ', 'El nombre del género lepidium procede del latín, el martuerzo silvestre (Lepidium latifolium) y otros muchos autores lo derivan del griego lepís, escama, aludiendo a la forma de las silículas.\r\nCardaria proviene de la palabra griega kardia, que significa “corazón” y hace referencia a una marca identificatoria excelente de la planta: su fruto en forma de corazón.\r\nEl epíteto Draba es el nombre genérico que deriva de la palabra del griego antiguo drabe = \"acre\", utilizado por Dioscórides para describir el sabor de las hojas de ciertas plantas crucíferas.\r\n', 'De primavera a verano.\r\nDe marzo a julio.\r\n', '', 33, 'Babol, blanquilla, capellanes, capellán, cochlearia falsa, draba (8), flor de muerto, floreta (2), floretas, florida, hierba blanca, hinchace, lobón de huerta, mastuerzo bárbaro (5), mastuerzo oriental (8), masuerzo oriental, papola, saponaria. (RJB)', 'Tiene un curioso sistema para defenderse de los herbívoros: contiene un alcaloide no tóxico y una enzima hidrolítica (= que se activa al disolverse en agua y descompone otras sustancias), en compartimientos separados. Al ser mordida por un animal se mezclan el alcaloide y la enzima en contacto con la saliva y generan ácido cianhídrico, potentísimo veneno de sabor muy amargo y repelente.'),
(64, 'cicuta', 'Conium maculatum', '“Conium\", del griego Koneion,-ou n.; del latín conium (-ion),-y n.; \'la cicuta y su jugo\'. \r\nEl epíteto específico \"maculatum\", proviene del latín maculatus,-a,-um, que significa mácula, macular , manchado, salpicado de manchas, y está compuesto de Macul,-ae (f.) que significa mancha o mácula, y el sufijo -atus,-ata,-atum indica posesión, es decir que tiene o posee manchas o máculas.\r\n', 'Junio-septiembre', '', 130, 'Acebuda, acedura, alcafechos, amarroyos, anises, azecuta, budoños, canajeja, canaveira, caneja (3), canerla (2), capazos, caña jedio, cañaeja, cañafierro (2), cañafleja (4), cañafloja, cañaheja (8), cañaheja diversa de la ferula, cañaheja mala, cañaherla (2), cañahierla, cañahierra (2), cañahierro, cañahueca (2), cañajierra (2), cañaleha, cañaleja (5), cañaloca, cañas hierras (2), cañasiero (2), cañaveira, cañaveleira, cañavera (4), cañifrecha, cañigarro, cañiguerra (4), cañilero, cañonceja, cañuelaceguta, cecuta, ceguda (4), ceguta (5), chicuta, chifletes, cibuta (2), cicuta (34), cicuta manchada (3), cicuta mayor (14), cicuta menor, cicuta no fétida, cicuta oficinal (2), cicutilla, ciguda (3), ciguta (6), dibleto, embude (2), embudejo (2), embudo , embudos (2), embue (2), entremisa, falsa cicuta (2), floridos, garamasto, hierba loca, huelemanos, jecuta, linojo, marroyos, mastrancho, matabuey, mexacan (2), nabo del diablo, peregil lobuno (2), pereil lobuno, perejil, perejil bravo (2),', 'La sobredosis produce sequedad en la boca, dificultad al tragar, dilatación de las pupilas (midriasis), náuseas, parálisis muscular; paro respiratorio y asfixia, aunque la víctima permanece lúcida hasta el momento de su muerte. \r\nPosee una neurotoxina que inhibe el funcionamiento del sistema nervioso central produciendo el llamado \"cicutismo\". El efecto de esta toxina es semejante al curare. La concentración de la misma varía según la etapa de maduración y las condiciones climáticas, encontrándose principalmente en los frutos verdes (0,73-0,98%), seguidos de los frutos maduros (0,50%) y hallándose en menor proporción en las flores (0,09-0,24%). Algunos gramos de frutos verdes serían suficientes para provocar la muerte de un humano (los rumiantes y los pájaros parecen ser resistentes), el caballo y el burro son poco sensibles, pero es un veneno violento para los bóvidos, los conejos y los carnívoros. En el humano, la ingestión provoca sobre la hora que sigue trastornos digestivos (espec');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `email` varchar(20) NOT NULL,
  `contra` varchar(20) NOT NULL,
  `rol` enum('Usuario','Admin','','') NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`email`, `contra`, `rol`, `nombre`) VALUES
('', '', 'Usuario', ''),
('a@gmail.com', 'asd', 'Usuario', 'andres'),
('admin@mail', 'admin', 'Admin', ''),
('arbrom@yahoo.es', '03042001', 'Admin', ''),
('asdadasd2@gmail.com', 'qe', 'Usuario', 'asd'),
('asdadasd@gmail.com', 'asd', 'Usuario', 'andres'),
('asdahjdasd@gmail.com', 'asd', 'Usuario', 'hhh'),
('prueba@gmail.com', 'asd', 'Usuario', 'prueba'),
('usuario@mail', 'usuario', 'Usuario', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idPlanta` (`idPlanta`),
  ADD KEY `idUsuario` (`email`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `fotos`
--
ALTER TABLE `fotos`
  ADD PRIMARY KEY (`idFoto`),
  ADD KEY `idPlanta` (`idPlanta`);

--
-- Indexes for table `localizacion`
--
ALTER TABLE `localizacion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `localizacion_plantas`
--
ALTER TABLE `localizacion_plantas`
  ADD PRIMARY KEY (`idRelacion`),
  ADD KEY `idPlanta` (`idPlanta`),
  ADD KEY `idLocalizacion` (`idLocalizacion`);

--
-- Indexes for table `plantas`
--
ALTER TABLE `plantas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `fotos`
--
ALTER TABLE `fotos`
  MODIFY `idFoto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `localizacion`
--
ALTER TABLE `localizacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `localizacion_plantas`
--
ALTER TABLE `localizacion_plantas`
  MODIFY `idRelacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT for table `plantas`
--
ALTER TABLE `plantas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`email`) REFERENCES `usuarios` (`email`) ON UPDATE CASCADE,
  ADD CONSTRAINT `comentarios_ibfk_3` FOREIGN KEY (`idPlanta`) REFERENCES `plantas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fotos`
--
ALTER TABLE `fotos`
  ADD CONSTRAINT `fotos_ibfk_1` FOREIGN KEY (`idPlanta`) REFERENCES `plantas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `localizacion_plantas`
--
ALTER TABLE `localizacion_plantas`
  ADD CONSTRAINT `localizacion_plantas_ibfk_2` FOREIGN KEY (`idLocalizacion`) REFERENCES `localizacion` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `localizacion_plantas_ibfk_3` FOREIGN KEY (`idPlanta`) REFERENCES `plantas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
