-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2018 at 11:31 AM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `voting`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
`id` int(255) NOT NULL,
  `adminid` varchar(300) NOT NULL,
  `username` varchar(300) NOT NULL,
  `password` varchar(64) NOT NULL,
  `salt` varchar(32) NOT NULL,
  `name` varchar(300) NOT NULL,
  `email` text NOT NULL,
  `imagelocation` text NOT NULL,
  `tokencode` text NOT NULL,
  `joined` datetime NOT NULL,
  `user_type` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `adminid`, `username`, `password`, `salt`, `name`, `email`, `imagelocation`, `tokencode`, `joined`, `user_type`) VALUES
(1, '1471436678', 'Admin', '4a2df0b527f121e79e7a36d336e02cd580de226447a44c5b530c3c6798349ef7', 'WÂ†˜e@È::Œ¾wŠÉ7Ê·«¾ß.R8]8H', 'Admin Voting', 'admin@voting.com', 'uploads/1512728387.jpg', '', '2016-08-17 14:24:38', 1);

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE IF NOT EXISTS `languages` (
`id` int(255) NOT NULL,
  `languageid` varchar(300) NOT NULL,
  `language` varchar(300) NOT NULL,
  `languages` varchar(300) NOT NULL,
  `language_lang` varchar(300) NOT NULL,
  `header` varchar(300) NOT NULL,
  `login` varchar(300) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `remember_me` varchar(300) NOT NULL,
  `register` varchar(300) NOT NULL,
  `forgot` varchar(300) NOT NULL,
  `home` varchar(300) NOT NULL,
  `page` varchar(300) NOT NULL,
  `settings` varchar(300) NOT NULL,
  `profile` varchar(300) NOT NULL,
  `logout` varchar(300) NOT NULL,
  `online` varchar(300) NOT NULL,
  `dashboard` varchar(300) NOT NULL,
  `voters` varchar(300) NOT NULL,
  `voter` varchar(300) NOT NULL,
  `add_add` varchar(300) NOT NULL,
  `list` varchar(300) NOT NULL,
  `organizations` varchar(300) NOT NULL,
  `organization` varchar(300) NOT NULL,
  `positions` varchar(300) NOT NULL,
  `position` varchar(300) NOT NULL,
  `nominees` varchar(300) NOT NULL,
  `nominee` varchar(300) NOT NULL,
  `control` varchar(300) NOT NULL,
  `panel` varchar(300) NOT NULL,
  `section` varchar(300) NOT NULL,
  `full` varchar(300) NOT NULL,
  `name` varchar(300) NOT NULL,
  `username` varchar(300) NOT NULL,
  `confirm` varchar(300) NOT NULL,
  `choose` varchar(300) NOT NULL,
  `image` varchar(300) NOT NULL,
  `submit` varchar(300) NOT NULL,
  `active` varchar(300) NOT NULL,
  `action` varchar(300) NOT NULL,
  `in_active` varchar(300) NOT NULL,
  `activate` varchar(300) NOT NULL,
  `deactivate` varchar(300) NOT NULL,
  `edit` varchar(300) NOT NULL,
  `delete_delete` varchar(300) NOT NULL,
  `details_details` varchar(300) NOT NULL,
  `change_change` varchar(300) NOT NULL,
  `picture` varchar(300) NOT NULL,
  `current` varchar(300) NOT NULL,
  `new` varchar(300) NOT NULL,
  `nominated` varchar(300) NOT NULL,
  `for_for` varchar(300) NOT NULL,
  `word` varchar(300) NOT NULL,
  `phrases` varchar(300) NOT NULL,
  `of` varchar(300) NOT NULL,
  `site` varchar(300) NOT NULL,
  `background` varchar(300) NOT NULL,
  `title` varchar(300) NOT NULL,
  `description` varchar(300) NOT NULL,
  `keywords` varchar(300) NOT NULL,
  `mail` varchar(300) NOT NULL,
  `select_select` varchar(300) NOT NULL,
  `default_default` varchar(300) NOT NULL,
  `admin` varchar(300) NOT NULL,
  `reset` varchar(300) NOT NULL,
  `votes` varchar(300) NOT NULL,
  `you` varchar(300) NOT NULL,
  `got` varchar(300) NOT NULL,
  `other` varchar(300) NOT NULL,
  `running` varchar(300) NOT NULL,
  `against` varchar(300) NOT NULL,
  `no` varchar(300) NOT NULL,
  `to_to` varchar(300) NOT NULL,
  `be` varchar(300) NOT NULL,
  `how` varchar(300) NOT NULL,
  `it` varchar(300) NOT NULL,
  `works` varchar(300) NOT NULL,
  `your` varchar(300) NOT NULL,
  `describe_describe` varchar(300) NOT NULL,
  `yourself` varchar(300) NOT NULL,
  `manifesto` varchar(300) NOT NULL,
  `please` varchar(300) NOT NULL,
  `vote` varchar(300) NOT NULL,
  `these` varchar(300) NOT NULL,
  `guys` varchar(300) NOT NULL,
  `search` varchar(300) NOT NULL,
  `and_and` varchar(300) NOT NULL,
  `view` varchar(300) NOT NULL,
  `error` varchar(300) NOT NULL,
  `success` varchar(300) NOT NULL,
  `have` varchar(300) NOT NULL,
  `changed` varchar(300) NOT NULL,
  `something` varchar(300) NOT NULL,
  `went` varchar(300) NOT NULL,
  `wrong` varchar(300) NOT NULL,
  `voted` varchar(300) NOT NULL,
  `successfully` varchar(300) NOT NULL,
  `personal` varchar(300) NOT NULL,
  `share` varchar(300) NOT NULL,
  `this` varchar(300) NOT NULL,
  `as_as` varchar(300) NOT NULL,
  `a` varchar(300) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `languageid`, `language`, `languages`, `language_lang`, `header`, `login`, `email`, `password`, `remember_me`, `register`, `forgot`, `home`, `page`, `settings`, `profile`, `logout`, `online`, `dashboard`, `voters`, `voter`, `add_add`, `list`, `organizations`, `organization`, `positions`, `position`, `nominees`, `nominee`, `control`, `panel`, `section`, `full`, `name`, `username`, `confirm`, `choose`, `image`, `submit`, `active`, `action`, `in_active`, `activate`, `deactivate`, `edit`, `delete_delete`, `details_details`, `change_change`, `picture`, `current`, `new`, `nominated`, `for_for`, `word`, `phrases`, `of`, `site`, `background`, `title`, `description`, `keywords`, `mail`, `select_select`, `default_default`, `admin`, `reset`, `votes`, `you`, `got`, `other`, `running`, `against`, `no`, `to_to`, `be`, `how`, `it`, `works`, `your`, `describe_describe`, `yourself`, `manifesto`, `please`, `vote`, `these`, `guys`, `search`, `and_and`, `view`, `error`, `success`, `have`, `changed`, `something`, `went`, `wrong`, `voted`, `successfully`, `personal`, `share`, `this`, `as_as`, `a`) VALUES
(1, '456316203361', 'English', 'Languages', 'Language', 'Header', 'Login', 'Email', 'Password', 'Remember Me', 'Register', 'Forgot', 'Home', 'Page', 'Settings', 'Profile', 'Logout', 'Online', 'Dashboard', 'Voters', 'Voter', 'Add', 'List', 'Organizations', 'Organization', 'Positions', 'Position', 'Nominees', 'Nominee', 'Control', 'Panel', 'Section', 'Full', 'Name', 'Username', 'Confirm', 'Choose', 'Image', 'Submit', 'Active', 'Action', 'In Active', 'Activate', 'Deactivate', 'Edit', 'Delete', 'Details', 'Change', 'Picture', 'Current', 'New', 'Nominated', 'For', 'Word', 'Phrases', 'of', 'Site', 'Background', 'Title', 'Description', 'Keywords', 'Mail', 'Select', 'Default', 'Admin', 'Reset', 'Votes', 'You', 'Got', 'Other', 'Running', 'Against', 'No', 'to', 'Be', 'How', 'it', 'works', 'Your', 'Describe', 'Yourself', 'Manifesto', 'Please', 'vote', 'these', 'guys', 'Search', 'and', 'View', 'Error', 'Success', 'have', 'changed', 'Something', 'Went', 'Wrong', 'voted', 'successfully', 'Personal', 'Share', 'this', 'as', 'a'),
(2, '492663265157', 'Spanish', 'Idiomas', 'Idioma', 'Encabezamiento', 'Iniciar sesiÃ³n', 'Email', 'ContraseÃ±a', 'RecuÃ©rdame', 'Registro', 'OlvidÃ³', 'Casa', 'PÃ¡gina', 'Configuraciones', 'Perfil', 'Cerrar sesiÃ³n', 'En lÃ­nea', 'Tablero', 'Votantes', 'Votante', 'AÃ±adir', 'Lista', 'Organizaciones', 'OrganizaciÃ³n', 'Posiciones', 'PosiciÃ³n', 'Nominados', 'Candidato', 'Controlar', 'Panel', 'SecciÃ³n', 'Completo', 'Nombre', 'Nombre de usuario', 'Confirmar', 'Escoger', 'Imagen', 'Enviar', 'Activo', 'AcciÃ³n', 'En activo', 'Activar', 'Desactivar', 'Editar', 'Borrar', 'Detalles', 'Cambio', 'Imagen', 'Corriente', 'Nuevo', 'Nominado', 'por', 'Palabra', 'Frases', 'de', 'Sitio', 'Fondo', 'TÃ­tulo', 'DescripciÃ³n', 'Palabras clave', 'Correo', 'Seleccionar', 'Defecto', 'AdministraciÃ³n', 'Reiniciar', 'Votos', 'TÃº', 'Tiene', 'Otro', 'Corriendo', 'En contra', 'No', 'A', 'Ser', 'CÃ³mo', 'Eso', 'Trabajos', 'Tu', 'Describir', 'TÃº mismo', 'Manifiesto', 'Por favor', 'votar', 'estas', 'muchachos', 'Buscar', 'y', 'Ver', 'Error', 'Ã‰xito', 'tener', 'cambiado', 'Alguna cosa', 'Fuimos', ' Incorrecto', 'votado', ' exitosamente', 'Personal', ' Compartir', 'esta', 'como', 'un');

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

CREATE TABLE IF NOT EXISTS `organization` (
`id` int(255) NOT NULL,
  `organizationid` varchar(300) NOT NULL,
  `name` varchar(300) NOT NULL,
  `imagelocation` varchar(300) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `organization`
--

INSERT INTO `organization` (`id`, `organizationid`, `name`, `imagelocation`) VALUES
(1, '214407771051', 'The Masha Brand Company', 'uploads/15172161218080-png.png'),
(2, '148404653372', 'Harvard Campus Election', 'uploads/1517253664rd.png'),
(3, '191158759771', 'Republican National Committee', 'uploads/1517253431.png'),
(4, '398673516259', 'Democratic National Committee', 'uploads/1517253449.png'),
(5, '357540792223', 'Women''s March', 'uploads/1517253521.jpg'),
(6, '340866181644', 'Grammy Awards', 'uploads/1517253546ys.jpg'),
(7, '162452339739', 'Oscars Awards', 'uploads/1517253570s.jpg'),
(8, '283787111660', 'Book Club', 'uploads/1517253591lub.png'),
(9, '171039999680', 'Women''s Club', 'uploads/1517253612sclub.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE IF NOT EXISTS `position` (
`id` int(255) NOT NULL,
  `positionid` varchar(300) NOT NULL,
  `organizationid` varchar(300) NOT NULL,
  `name` varchar(300) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`id`, `positionid`, `organizationid`, `name`, `date_added`) VALUES
(1, '238770789328', '214407771051', 'President', '2018-01-26 13:02:46'),
(2, '251972032522', '214407771051', 'Vice President', '2018-01-26 19:06:01'),
(3, '560276340920', '148404653372', 'President', '2018-01-28 10:10:28'),
(4, '412962962113', '148404653372', 'Vice President', '2018-01-28 10:10:47'),
(5, '745669717915', '148404653372', 'Student Affairs', '2018-01-28 10:10:57'),
(6, '347430924766', '214407771051', 'Chief Technology Officer', '2018-01-29 14:17:46'),
(7, '103340182199', '191158759771', 'Chairperson', '2018-01-29 20:29:40'),
(8, '241668248976', '191158759771', 'Finance Chairperson', '2018-01-29 20:30:00'),
(9, '241076521744', '398673516259', 'Chairperson', '2018-01-29 20:30:12'),
(10, '293103170219', '398673516259', 'Finance Chairperson', '2018-01-29 20:30:20'),
(11, '269813323988', '357540792223', 'President', '2018-01-29 20:30:54'),
(12, '228801942709', '357540792223', 'Vice President', '2018-01-29 20:31:02'),
(13, '400615859433', '340866181644', 'Album of the Year', '2018-01-29 20:33:49'),
(14, '720544137830', '340866181644', 'Song of the Year', '2018-01-29 20:34:09'),
(15, '476114483752', '162452339739', 'Best Picture', '2018-01-29 20:36:09'),
(16, '167960082338', '162452339739', 'Best Actor', '2018-01-29 20:36:23'),
(17, '316802760480', '162452339739', 'Best Actress', '2018-01-29 20:36:40'),
(18, '896697567888', '283787111660', 'Chairperson', '2018-01-29 20:39:28'),
(19, '240272469336', '283787111660', 'Vice Chairperson', '2018-01-29 20:39:55'),
(20, '578529258290', '171039999680', 'Chairperson', '2018-01-29 20:40:08'),
(21, '301903363884', '171039999680', 'Vice Chairperson', '2018-01-29 20:40:19');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
`id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `sitename` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `smail` varchar(300) NOT NULL,
  `smailpass` varchar(300) NOT NULL,
  `languageid` varchar(300) NOT NULL,
  `bgimage` varchar(300) NOT NULL,
  `google_analytics` longtext NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `title`, `description`, `keywords`, `sitename`, `url`, `smail`, `smailpass`, `languageid`, `bgimage`, `google_analytics`) VALUES
(1, 'Online Voting Platform', 'Online Voting Platform', 'Online Voting Platform, voting ', 'Voting', 'http://localhost/projects/workspace/Voting/', 'danielkibetkorir@gmail.com', '2643176745', '456316203361', 'uploads/1517252709.jpg', '<script>\r\n  (function(i,s,o,g,r,a,m){i[''GoogleAnalyticsObject'']=r;i[r]=i[r]||function(){\r\n  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),\r\n  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)\r\n  })(window,document,''script'',''https://www.google-analytics.com/analytics.js'',''ga'');\r\n\r\n  ga(''create'', ''UA-79656468-4'', ''auto'');\r\n  ga(''send'', ''pageview'');\r\n\r\n</script>');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(255) NOT NULL,
  `userid` varchar(300) NOT NULL,
  `username` varchar(300) NOT NULL,
  `password` varchar(64) NOT NULL,
  `salt` varchar(32) NOT NULL,
  `name` varchar(300) NOT NULL,
  `email` text NOT NULL,
  `imagelocation` text NOT NULL,
  `bgimage` text NOT NULL,
  `tokencode` text NOT NULL,
  `joined` datetime NOT NULL,
  `active` int(11) NOT NULL,
  `delete_remove` int(11) NOT NULL,
  `user_type` int(11) NOT NULL,
  `organizationid` varchar(300) NOT NULL,
  `positionid` varchar(300) NOT NULL,
  `describe_yourself` longtext NOT NULL,
  `manifesto` longtext NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `userid`, `username`, `password`, `salt`, `name`, `email`, `imagelocation`, `bgimage`, `tokencode`, `joined`, `active`, `delete_remove`, `user_type`, `organizationid`, `positionid`, `describe_yourself`, `manifesto`) VALUES
(2, '454243422562', 'AvatarOne', 'a035b153eed45531c520d85ef4fb453834627144d58635c962d1001b2b3e87e7', 'ümCÈJíÝu4¶¦×‚O“ìµÈÞÌE­ŽÓòè7', 'Avatar One', 'avatar1@gmail.com', 'uploads/1515501792.jpg', 'uploads/bg/1475741847.jpg', '', '2016-09-27 18:50:04', 1, 0, 1, '', '', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.<br></p>', ''),
(3, '461111766379', 'AvatarTwo', '77be846280a08523a3ce5259c37d862f5ecdda03afed3bfb6f76ceab5ac29b66', '×Ä{rlÙL*˜a®bxéYr1/¼|;…Â', 'Avatar Two', 'avatar2@gmail.com', 'uploads/1515501847.jpg', 'uploads/bg/1481364849-1.jpg', '', '2016-10-23 11:42:10', 1, 0, 1, '', '', '<p><span style="font-family: &quot;Abhaya Libre&quot;, serif; font-size: 18px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span><br></p>', ''),
(4, '691501275360', 'AvatarThree', '7b530f5d7c754a0f7811b9dadfb54b27667bde5b0aa8188430cf1670a5b729a3', 'i;+bFZf³_9ÜÄJÿ »g7ÚÃŒôó£ ƒ', 'Avatar Three', 'avatar3@gmail.com', 'uploads/1515502047.jpg', 'uploads/bg/1481365287.jpg', '', '2016-12-10 13:20:00', 1, 0, 1, '', '', '<p><span style="font-family: &quot;Abhaya Libre&quot;, serif; font-size: 18px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span><br></p>', ''),
(5, '471506861293', 'AvatarFour', 'a6c552a62162ccf146899be932f92f722add8832f57741c9733ca7cf19cd18a8', 'V¿ÙÆà•J9zLÇùô)$–‘ÛÄ=à·.\0˜•öK^ß', 'Avatar Four', 'avatar4@gmail.com', 'uploads/1515502269.jpg', '', '', '2017-01-05 13:33:34', 1, 0, 1, '', '', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.<br></p>', ''),
(6, '270814326257', 'AvatarFive', 'a36f8f1dd79f7c3fdc7e2473ecf2ce3320104abd3cde05045df1582eee4f4e3a', 'ÎÅ››&õ4¼EùMÃÌ&Å?½Mü„ˆ2ß¤;ßÂ®Ï', 'Avatar Five', 'avatar5@gmail.com', 'uploads/1515502747.jpg', '', '', '2017-02-04 10:45:05', 1, 0, 1, '', '', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.<br></p>', ''),
(7, '1512380752', 'AvatarSix', 'fd934c4266bea50c347ce877fe584d56463144b06403718babe446b249334c6f', 'Ÿâ÷Þžbè˜54/”"rˆHuò¦Óh*3UUnŒ]ß', 'Avatar Six', 'avatar6@gmail.com', 'uploads/1515502801.jpg', '', '', '2017-12-04 10:45:52', 1, 0, 1, '', '', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque aliquet\r\n ipsum sapien, sed iaculis neque egestas in. Sed dignissim velit non dui\r\n vulputate finibus. In a pharetra ante. Phasellus tempus nibh sapien. \r\nPhasellus nisl dolor, ultrices nec congue nec, eleifend a velit. Aenean \r\npretium tortor eget odio tincidunt, sed ultrices justo finibus. \r\nVestibulum ac tortor et eros mollis eleifend sed at dui.\r\n</p><p>\r\nMauris ut ipsum vitae mauris tempor pulvinar at vel erat. Donec ultrices\r\n eros vel dictum scelerisque. Suspendisse potenti. Phasellus sagittis, \r\nelit nec maximus sagittis, ipsum velit viverra turpis, a feugiat urna \r\nsapien sit amet nulla. Fusce et elementum odio. Vestibulum ac imperdiet \r\nipsum. Aenean luctus neque at auctor tempor. Pellentesque ac lorem \r\nconsectetur, imperdiet dui vitae, fermentum nibh. Aliquam a augue odio. \r\nDonec magna libero, egestas efficitur felis in, gravida iaculis dolor. \r\nMaecenas ultrices blandit porta. Nunc est felis, ultrices quis massa \r\nvitae, venenatis faucibus lectus.\r\n</p>', ''),
(8, '1512497685', 'AvatarSeven', '5eb4f8b11980a6e07ee7308f35c7efb97df61b37193d1b19e46bc4874b3b0645', ':''¨è”kôðŸ!É*ÜTóaÚQ\n¼%ó†Œ¼à', 'Avatar Seven', 'avatar7@gmail.com', 'uploads/1515502852.jpg', '', '', '2017-12-05 19:14:45', 1, 0, 1, '', '', '<p>\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ut sapien\r\n a dui condimentum dapibus. Curabitur vehicula, nisi a efficitur \r\nblandit, nunc velit sodales ligula, nec ornare urna lectus vel est. \r\nNulla malesuada lorem ac nisi laoreet, sit amet dignissim tortor \r\npharetra. Mauris et arcu orci. In suscipit nulla augue, eu tristique \r\nmassa luctus sed. Nunc risus ipsum, cursus ac ornare ut, hendrerit \r\nrutrum magna. Sed ac orci sed nisi placerat pulvinar. Donec convallis, \r\nmagna quis auctor lobortis, odio leo feugiat odio, ut dapibus massa nisi\r\n in diam.\r\n</p><p>\r\n<br></p><p>\r\nMaecenas in bibendum justo. In hac habitasse platea dictumst. Quisque \r\nmollis convallis lacinia. Nunc ac facilisis dolor, eget luctus purus. \r\nDuis vitae sem eu eros ornare vehicula non at dui. Curabitur vestibulum \r\nat felis non viverra. Pellentesque hendrerit, erat id dictum facilisis, \r\nlectus elit venenatis mi, commodo rutrum elit ipsum eget quam.\r\n</p>', ''),
(9, '406470927698', 'AvatarEight', 'c9b1685bd6afb9c2c55408f47433170b8fdb5f16fda13477ece625e7b37cc97e', '''ž€Õn–½^±ÅÜV„`ÿX\rs¢‹ô•ø1œÅ”4“', 'Avatar Eight', 'avatar8@gmail.com', 'uploads/1515502949.jpg', '', '840e98c258ebdf0db98d6808e0709643', '2017-12-07 04:53:34', 1, 0, 1, '', '', '<p><span style="font-family: &quot;Abhaya Libre&quot;, serif; font-size: 18px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span><br></p>', ''),
(10, '242819232275', 'AvatarNine', '29395d245d99484bca57cf3dfc0262c5604b1c0c57277a25c10f79599dc4c4e2', 'nžÌ‰ã‹Ú-*ú1\n›`«I\nf44:+eÉn­ä´', 'Avatar Nine', 'avatar9@gmail.com', 'uploads/1515502997.jpg', '', '', '2017-12-08 04:31:54', 1, 0, 1, '', '', '<p><span style="font-family: &quot;Abhaya Libre&quot;, serif; font-size: 18px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span><br></p>', ''),
(11, '467426610337', 'AvatarTen', '42d821dfab409026b914e05222d02962bd0f67ce24444230647c226f9f6dfdfd', 'Ã{ŸÍ˜Ò|ÚÅ\0ý5l7%¶¡_ÒÂ¾\Zñ&œ+žùøH', 'Avatar Ten', 'avatar10@gmail.com', 'uploads/1515503065.jpg', '', '', '2018-01-09 14:04:25', 1, 0, 1, '', '', '<p><span style="font-family: &quot;Abhaya Libre&quot;, serif; font-size: 18px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span><br></p>', ''),
(12, '460106748446', 'AvatarEleven', '44b9c24c296c65553371b5461d1ee01346bb993e15d37b6f0676701144a5e051', 'Þá-oº´²³øoÜi¢æC²©$„zbúŽYé”vþœI_', 'Avatar Eleven', 'avatar11@gmail.com', 'uploads/1515503124.jpg', '', '', '2018-01-09 14:05:24', 1, 0, 1, '', '', '<p><span style="font-family: &quot;Abhaya Libre&quot;, serif; font-size: 18px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span><br></p>', ''),
(13, '492493061580', 'AvatarTwelve', '9a09e4fb9bfa2528eb2f31465a427dff83f32c5fb0bb36ae6c68e15006b84529', 'æb–à¬þ<l¾´œé~a|gTÇ¡jLÕú/HŸ', 'Avatar Twelve', 'avatar12@gmail.com', 'uploads/1515503159.jpg', '', '', '2018-01-09 14:05:59', 1, 0, 1, '', '', '<p><span style="font-family: &quot;Abhaya Libre&quot;, serif; font-size: 18px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span><br></p>', ''),
(14, '166190079925', 'AvatarThirteen', '7ae7b4b5383393d9ce853405c66da7bb086a67a3562369fafb9b14031d1e0245', '''ŸLwÀiWâÚ4zÑ®Ôüümj>LD}·úíÞí', 'Avatar Thirteen', 'avatar13@gmail.com', 'uploads/1515503191.png', '', '', '2018-01-09 14:06:31', 1, 0, 1, '', '', '<p><span style="font-family: &quot;Abhaya Libre&quot;, serif; font-size: 18px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span><br></p>', ''),
(15, '381058138688', 'AvatarFourteen', '25a823dfdfb09cf7069325e4659a2aec02fe7f36321c26f1c2aa395a51202943', '„\0_heDû¶á¢:Ç÷Ÿ>Ê~S/\\ÿm–Ý¬e§', 'Avatar Fourteen', 'avatar14@gmail.com', 'uploads/1515503256.png', '', '', '2018-01-09 14:07:36', 1, 0, 1, '', '', '<p><span style="font-family: &quot;Abhaya Libre&quot;, serif; font-size: 18px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span><br></p>', ''),
(16, '700920271162', 'AvatarFifteen', '818ff093a4a2a50bb8c89c86fc30708af5a1cac098caca5c067a853534ca5631', '—Ù*lÑ5ótÇ%{Ú´ŸïÝ„t¢C3Ô ª\0‚ï', 'Avatar Fifteen', 'avatar15@gmail.com', 'uploads/1515503289.png', '', '', '2018-01-09 14:08:09', 1, 0, 1, '', '', '<p><span style="font-family: &quot;Abhaya Libre&quot;, serif; font-size: 18px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span><br></p>', ''),
(17, '599836216035', 'AvatarSixteen', 'd6eb943ef3b6c0d337a748c118515e739769671d66baef4a7da1a9bc708c7a07', '~s“å›8Ë‚—à¬,5›„©H4®Ý\Z9QÄãK­½', 'Avatar Sixteen', 'avatar16@gmail.com', 'uploads/1515503325.png', '', '', '2018-01-09 14:08:45', 1, 0, 1, '', '', '<p><span style="font-family: &quot;Abhaya Libre&quot;, serif; font-size: 18px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span><br></p>', ''),
(18, '222945698995', 'AvatarSeventeen', '7c11a6247a7c126702f9909cb7cd730439d984d722197f2b6be157c2de2db752', 'öX¨äS=\\©#>uº5h$‘ØÔ‚$‚Ù-JðìÛ…5\0AA', 'Avatar Seventeen', 'avatar17@gmail.com', 'uploads/1515503358.png', '', '', '2018-01-09 14:09:18', 1, 0, 1, '', '', '<p><span style="font-family: &quot;Abhaya Libre&quot;, serif; font-size: 18px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span><br></p>', ''),
(19, '410822666009', 'AvatarEighteen', '660cf1d78f5580c0d96de53ba64b0304a31a75feedfcd6125b9d68e748f0e915', '5Ñiè²²sÅ~|ªÿû·×ïÞ–³¢ÿº‘x±0‘ÑzVÄ', 'Avatar Eighteen', 'avatar18@gmail.com', 'uploads/1515503416.png', '', '', '2018-01-09 14:10:16', 1, 0, 1, '', '', '<p><span style="font-family: &quot;Abhaya Libre&quot;, serif; font-size: 18px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span><br></p>', ''),
(20, '241707645559', 'AvatarNineteen', '81b373b31432114301048e08f4d14a5972883f6d846503bd28935a35f9dc2b9c', '4NÍ¹ÀŽ°µ±õ“É•¼r0ê¿Ó»¥ÏHùF·ø´)', 'Avatar Nineteen', 'avatar19@gmail.com', 'uploads/1515503452.png', '', '', '2018-01-09 14:10:52', 1, 0, 1, '', '', '<p><span style="font-family: &quot;Abhaya Libre&quot;, serif; font-size: 18px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span><br></p>', ''),
(21, '174616311656', 'AvatarTwenty', '7ad40a9ed829bba9a5df19c9bfaec1dc327a5671204a550d7afd75b736f10405', 'AG§aHéR ”-HSf€\0÷Kñ¨`#Óvp€éWž¨', 'Avatar Twenty', 'avatar20@gmail.com', 'uploads/1515503485.jpg', '', '', '2018-01-09 14:11:26', 1, 0, 1, '', '', '<p><span style="font-family: &quot;Abhaya Libre&quot;, serif; font-size: 18px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</span><br></p>', ''),
(22, '474877446628', 'NomineeOne', '3978707358340571855a650478e0a7eddba7c0b522dd18e41dd152b080023680', 'šQ¹Â¼;‡­ˆÍÂ„²87Û½Rø>ó:á	ïÔD', 'Nominee One', 'nominee1@gmail.com', 'uploads/151713187001792.jpg', '', '', '2018-01-28 10:31:10', 1, 0, 2, '214407771051', '238770789328', '<p><span style="font-family: &quot;Abhaya Libre&quot;, serif; font-size: 15px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; text-align: center;">Hi I''m Johnathn Deo,has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type.</span><br></p>', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.<br></p>'),
(23, '270324952048', 'NomineeTwo', 'f6b7c81e3317bcfbb68e43b6ec8372261a393a05fc1ee3d1773cb63cd12f0790', '†oAe¨¤nÖë‡ã»éø|g’Bþˆ¬FÞèl', 'Nominee Two', 'nominee2@gmail.com', 'uploads/151714531401847.jpg', '', '', '2018-01-28 14:15:14', 1, 0, 2, '214407771051', '238770789328', '<p><span style="font-family: &quot;Abhaya Libre&quot;, serif; font-size: 15px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; text-align: center;">Hi I''m Johnathn Deo,has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type.</span><br></p>', '<p><span style="font-family: &quot;Abhaya Libre&quot;, serif; font-size: 18px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</span><br></p>'),
(24, '303823529393', 'NomineeThree', 'e8eebb29eb47feb04ecb4eeb48c2da999756c173943f70ce11026b998000e4e5', '>£0ÏPvcžÑF¹ûúnKtõºX6¨g³¾™à''`', 'Nominee Three', 'nominee3@gmail.com', 'uploads/151714535802047.jpg', '', '', '2018-01-28 14:15:58', 1, 0, 2, '214407771051', '238770789328', '<p><span style="font-family: &quot;Abhaya Libre&quot;, serif; font-size: 15px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; text-align: center;">Hi I''m Johnathn Deo,has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type.</span><br></p>', '<p><span style="font-family: &quot;Abhaya Libre&quot;, serif; font-size: 18px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</span><br></p>'),
(25, '166688767734', 'NomineeFour', '5b1c8106e45e0674df766a8fb26208a1f65b70199d98f101d8dad291bbf5ff96', 'mÛÙÿÕü@&¬DòÀ{''Ú²åGw­íÂ#T˜V', 'Nominee Four', 'nominee4@gmail.com', 'uploads/151714542402269.jpg', '', '', '2018-01-28 14:17:04', 1, 0, 2, '214407771051', '251972032522', '<p><span style="font-family: &quot;Abhaya Libre&quot;, serif; font-size: 15px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; text-align: center;">Hi I''m Johnathn Deo,has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type</span><br></p>', '<p><span style="font-family: &quot;Abhaya Libre&quot;, serif; font-size: 18px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</span><br></p>'),
(26, '632346227728', 'NomineeFive', 'd4d98c0e81c94a195e38702fe655ab0c732934b840fbdb169601fdcfeb5f231d', 'fô >·ŒMlåA¾0Î ´É{Á›\0‰Â¿-S)Æ', 'Nominee Five', 'nominee5@gmail.com', 'uploads/151714546002747.jpg', '', '', '2018-01-28 14:17:40', 1, 0, 2, '214407771051', '251972032522', '<p><span style="font-family: &quot;Abhaya Libre&quot;, serif; font-size: 15px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; text-align: center;">Hi I''m Johnathn Deo,has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type.</span><br></p>', '<p><span style="font-family: &quot;Abhaya Libre&quot;, serif; font-size: 18px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</span><br></p>'),
(27, '577880727425', 'NomineeSix', '07fde7c9910e83a6f00eb6db86b26c97d04a7f8568e208eb9e19dd09a59ee7f7', '!3·¨0Ò2üŒ>H]×l9mˆa¸ë[ò÷(ý\rùËÀ', 'Nominee Six', 'nominee6@gmail.com', 'uploads/151714551702801.jpg', '', '', '2018-01-28 14:18:37', 1, 0, 2, '214407771051', '251972032522', '<p><span style="font-family: &quot;Abhaya Libre&quot;, serif; font-size: 15px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; text-align: center;">Hi I''m Johnathn Deo,has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type.</span><br></p>', '<p><span style="font-family: &quot;Abhaya Libre&quot;, serif; font-size: 18px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</span><br></p>'),
(28, '311457383112', 'NomineeSeven', 'cd9694b0179b622f4b1928883e6866083674e5b4f279689abf315314ed647b4b', 'þŠwx¯†þôQ5ÜŒÜÊj_Ä#Î˜ØwM*Ü¬Ñ\Z‚', 'Nominee Seven', 'nominee7@gmail.com', 'uploads/151723199002852.jpg', '', '', '2018-01-29 14:19:51', 1, 0, 2, '214407771051', '347430924766', '', ''),
(29, '453121345460', 'NomineeEight', '8b932e92902f6894c1c877da3e50b1f200d703b1ffab6b58f2c43831e4c6a4b4', 'ê;ßÈ”uåó#$bÈQîÌ]®+!Ð’5yÑ¬@z3û1X', 'Nominee Eight', 'nominee8@gmail.com', 'uploads/151723202902949.jpg', '', '', '2018-01-29 14:20:29', 1, 0, 2, '214407771051', '347430924766', '', ''),
(30, '350268194064', 'NomineeNine', '0cb2c523302b831016f972e14eccf8ad60f690838d54710681881c9388a2f9ca', 'uØW"G—¦kìÙbÕmÄ7»kW¨Ú*±äWût÷', 'Nominee Nine', 'nominee9@gmail.com', 'uploads/151723206302997.jpg', '', '', '2018-01-29 14:21:03', 1, 0, 2, '214407771051', '347430924766', '', ''),
(31, '458484136448', 'NomineeTen', '589faf8b94cbbf1890a627978067f384bcab7f0edeeea2d4c6748be00155e5b6', 'v±úÉºÅ~¡üØmÃåjWv#Sl2CoÕØåtè=|O', 'Nominee Ten', 'nominee10@gmail.com', 'uploads/151725506803065.jpg', '', '', '2018-01-29 20:44:28', 1, 0, 2, '148404653372', '560276340920', '', ''),
(32, '491272034333', 'NomineeEleven', 'f1927683b565c6dcaa67c520ff234b7edfa6627f440213c95f34bbf04e7b283d', '<!"nŠÀI§cúþ©1oÔoòÝ¿½ƒ”hN)', 'Nominee Eleven', 'nominee11@gmail.com', 'uploads/151725511703124.jpg', '', '', '2018-01-29 20:45:17', 1, 0, 2, '148404653372', '560276340920', '', ''),
(33, '178429218340', 'NomineeThirteen', '98d27c8e08bddb85ace4227806e58cfd4db3093679533da0a5a4414d39e4ac75', '¹òíÀO§w¢Wé9›×i-TW¶×¼‚£IÅä8,#', 'Nominee Thirteen', 'nominee13@gmail.com', 'uploads/151725525803191.png', '', '', '2018-01-29 20:47:38', 1, 0, 2, '148404653372', '412962962113', '', ''),
(34, '452187627756', 'NomineeTwelve', '082000b5790e2f981c16de77ebf88272242bcf3a62bf73139a1d0439b12414b2', ']´Ô§e(DÞ’3ú›¥ÕY/²z­*J¿\\¼I·ÅÏ', 'Nominee Twelve', 'nominee12@gmail.com', 'uploads/151725540303256.png', '', '', '2018-01-29 20:50:03', 1, 0, 2, '148404653372', '412962962113', '', ''),
(35, '389358122577', 'NomineeFourteen', '5978a8245633ca5599e36d3667c02730c35526aa8675bb61aac75e769780eb7e', '\\N.fçŒ\n\\ë\n&ñ€ÊSóG‰¼dZƒ‰¯k §', 'Nominee Fourteen', 'nominee14@gmail.com', 'uploads/151725556303256.png', '', '', '2018-01-29 20:52:43', 1, 0, 2, '191158759771', '103340182199', '', ''),
(36, '289507545043', 'NomineeFifteen', '3f9140f37d922bc7000260ac6cf62167a84e98191ca4e4c70becec437322b9ad', 'Ó2¹Ãzû\ZUZ—¨\ZR?óH£Õ?ì*¨ÃÿƒôVÁ}', 'Nominee Fifteen', 'nominee15@gmail.com', 'uploads/151725562103289.png', '', '', '2018-01-29 20:53:41', 1, 0, 2, '191158759771', '103340182199', '', ''),
(37, '258767957588', 'NomineeSixteen', 'fc4b6c119469db6b92ff7d0eb8acee5495ec0b156437ccdf434b6261458abee4', '»n»QØ>À\\ªÒõqùi|„è<ßÀ4µ­œ~h}EhÊ', 'Nominee Sixteen', 'nominee16@gmail.com', 'uploads/151725568803325.png', '', '', '2018-01-29 20:54:48', 1, 0, 2, '191158759771', '241668248976', '', ''),
(38, '496870910062', 'NomineeSeventeen', '910dfe0e624f06b4b36ea64e600ff82254b04dbd2ebe1f85a820550b427408e4', 'Ô¬Lì¹#AÖ•_)_=äÎËÓˆ~ªãœ·f€dã†', 'Nominee Seventeen', 'nominee17@gmail.com', 'uploads/151725574103358.png', '', '', '2018-01-29 20:55:41', 1, 0, 2, '191158759771', '241668248976', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users_session`
--

CREATE TABLE IF NOT EXISTS `users_session` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hash` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE IF NOT EXISTS `votes` (
`id` int(255) NOT NULL,
  `voterid` varchar(300) NOT NULL,
  `nomineeid` varchar(300) NOT NULL,
  `organizationid` varchar(300) NOT NULL,
  `positionid` varchar(300) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `voterid`, `nomineeid`, `organizationid`, `positionid`) VALUES
(1, '174616311656', '270324952048', '214407771051', '238770789328'),
(2, '174616311656', '577880727425', '214407771051', '251972032522'),
(3, '454243422562', '303823529393', '214407771051', '238770789328'),
(4, '454243422562', '632346227728', '214407771051', '251972032522'),
(5, '454243422562', '453121345460', '214407771051', '347430924766'),
(6, '461111766379', '270324952048', '214407771051', '238770789328'),
(7, '461111766379', '577880727425', '214407771051', '251972032522'),
(8, '461111766379', '453121345460', '214407771051', '347430924766'),
(9, '461111766379', '389358122577', '191158759771', '103340182199'),
(10, '461111766379', '258767957588', '191158759771', '241668248976'),
(11, '454243422562', '389358122577', '191158759771', '103340182199'),
(12, '454243422562', '258767957588', '191158759771', '241668248976'),
(13, '691501275360', '270324952048', '214407771051', '238770789328'),
(14, '691501275360', '577880727425', '214407771051', '251972032522'),
(15, '691501275360', '453121345460', '214407771051', '347430924766'),
(16, '471506861293', '270324952048', '214407771051', '238770789328'),
(17, '471506861293', '577880727425', '214407771051', '251972032522'),
(18, '471506861293', '453121345460', '214407771051', '347430924766'),
(19, '471506861293', '389358122577', '191158759771', '103340182199'),
(20, '471506861293', '258767957588', '191158759771', '241668248976'),
(21, '691501275360', '389358122577', '191158759771', '103340182199'),
(22, '691501275360', '258767957588', '191158759771', '241668248976'),
(23, '270814326257', '270324952048', '214407771051', '238770789328'),
(24, '270814326257', '577880727425', '214407771051', '251972032522'),
(25, '270814326257', '453121345460', '214407771051', '347430924766'),
(26, '270814326257', '389358122577', '191158759771', '103340182199'),
(27, '270814326257', '258767957588', '191158759771', '241668248976'),
(28, '1512380752', '270324952048', '214407771051', '238770789328'),
(29, '1512380752', '577880727425', '214407771051', '251972032522'),
(30, '1512380752', '453121345460', '214407771051', '347430924766'),
(31, '1512380752', '389358122577', '191158759771', '103340182199'),
(32, '1512380752', '258767957588', '191158759771', '241668248976'),
(33, '1512497685', '270324952048', '214407771051', '238770789328'),
(34, '1512497685', '577880727425', '214407771051', '251972032522'),
(35, '1512497685', '453121345460', '214407771051', '347430924766'),
(36, '1512497685', '389358122577', '191158759771', '103340182199'),
(37, '1512497685', '258767957588', '191158759771', '241668248976'),
(38, '406470927698', '474877446628', '214407771051', '238770789328'),
(39, '406470927698', '632346227728', '214407771051', '251972032522'),
(40, '406470927698', '350268194064', '214407771051', '347430924766'),
(41, '406470927698', '289507545043', '191158759771', '103340182199'),
(42, '406470927698', '496870910062', '191158759771', '241668248976'),
(43, '242819232275', '289507545043', '191158759771', '103340182199'),
(44, '242819232275', '496870910062', '191158759771', '241668248976'),
(45, '242819232275', '474877446628', '214407771051', '238770789328'),
(46, '242819232275', '632346227728', '214407771051', '251972032522'),
(47, '242819232275', '311457383112', '214407771051', '347430924766'),
(48, '467426610337', '303823529393', '214407771051', '238770789328'),
(49, '467426610337', '166688767734', '214407771051', '251972032522'),
(50, '467426610337', '350268194064', '214407771051', '347430924766'),
(51, '467426610337', '289507545043', '191158759771', '103340182199'),
(52, '467426610337', '496870910062', '191158759771', '241668248976'),
(53, '460106748446', '458484136448', '148404653372', '560276340920'),
(54, '460106748446', '178429218340', '148404653372', '412962962113'),
(55, '492493061580', '458484136448', '148404653372', '560276340920'),
(56, '492493061580', '178429218340', '148404653372', '412962962113'),
(57, '166190079925', '458484136448', '148404653372', '560276340920'),
(58, '166190079925', '178429218340', '148404653372', '412962962113'),
(59, '381058138688', '458484136448', '148404653372', '560276340920'),
(60, '381058138688', '178429218340', '148404653372', '412962962113'),
(61, '700920271162', '458484136448', '148404653372', '560276340920'),
(62, '700920271162', '178429218340', '148404653372', '412962962113'),
(63, '599836216035', '491272034333', '148404653372', '560276340920'),
(64, '599836216035', '452187627756', '148404653372', '412962962113'),
(65, '222945698995', '491272034333', '148404653372', '560276340920'),
(66, '222945698995', '452187627756', '148404653372', '412962962113'),
(67, '410822666009', '491272034333', '148404653372', '560276340920'),
(68, '410822666009', '452187627756', '148404653372', '412962962113'),
(69, '241707645559', '491272034333', '148404653372', '560276340920'),
(70, '241707645559', '452187627756', '148404653372', '412962962113'),
(71, '174616311656', '458484136448', '148404653372', '560276340920'),
(72, '174616311656', '178429218340', '148404653372', '412962962113');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organization`
--
ALTER TABLE `organization`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_session`
--
ALTER TABLE `users_session`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `organization`
--
ALTER TABLE `organization`
MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `users_session`
--
ALTER TABLE `users_session`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=73;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
