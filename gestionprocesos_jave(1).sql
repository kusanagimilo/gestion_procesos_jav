-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 15, 2017 at 09:08 AM
-- Server version: 5.7.16
-- PHP Version: 7.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gestionprocesos_jave`
--

-- --------------------------------------------------------

--
-- Table structure for table `caso`
--

CREATE TABLE `caso` (
  `id_caso` int(11) NOT NULL,
  `id_tipo_proceso` int(11) DEFAULT NULL,
  `id_estado` int(11) DEFAULT NULL,
  `id_usuario_creo` int(11) DEFAULT NULL,
  `id_usuario_modifico` int(11) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `fecha_modificacion` datetime DEFAULT CURRENT_TIMESTAMP,
  `estado` varchar(2) DEFAULT NULL,
  `rol_creado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `caso`
--

INSERT INTO `caso` (`id_caso`, `id_tipo_proceso`, `id_estado`, `id_usuario_creo`, `id_usuario_modifico`, `fecha_creacion`, `fecha_modificacion`, `estado`, `rol_creado`) VALUES
(1, 1, 0, 2, NULL, '2017-05-07 07:14:53', '2017-05-07 19:14:53', 'AC', 8);

-- --------------------------------------------------------

--
-- Table structure for table `documento`
--

CREATE TABLE `documento` (
  `id_documento` int(11) NOT NULL,
  `extension` varchar(150) DEFAULT NULL,
  `nombre` varchar(150) DEFAULT NULL,
  `url` varchar(150) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT CURRENT_TIMESTAMP,
  `id_usr_creo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `documento`
--

INSERT INTO `documento` (`id_documento`, `extension`, `nombre`, `url`, `fecha_creacion`, `id_usr_creo`) VALUES
(1, 'application/pdf', 'Ficha CategorizaciÃ³n Profesor Catedra', 'lib/Documentos/Ficha-CategorizaciÂ¢n-Profesor-Câ€ tedra-1.pdf', '2017-02-21 22:03:31', 1),
(2, 'application/pdf', 'Formato Nivel Salarial', 'lib/Documentos/Formato-Nivel-Salarial-1.pdf', '2017-02-21 22:03:31', 1),
(3, 'image/png', 'FLUJOGRAMA DEL PROCESO', 'lib/Documentos/CategorizacioÌn-Profesor-CaÌtedra.png', '2017-02-21 22:03:31', 1),
(6, 'application/pdf', 'Ficha CategorizaciÃ³n Profesor Planta', 'lib/Documentos/Ficha-de-proceso-CategorizaciÂ¢n-Profesor-de-planta8-1.pdf', '2017-02-21 22:40:26', 1),
(7, 'image/png', 'FLUJOGRAMA DEL PROCESO', 'lib/Documentos/CategorizacioÌn-Profesor-Planta.png', '2017-02-21 22:40:26', 1),
(8, 'application/pdf', 'Ficha Compra de Servicios', 'lib/Documentos/Ficha-de-proceso-Compra-de-servicios33FaltaWeb-1.pdf', '2017-02-21 22:44:49', 1),
(9, 'image/png', 'FLUJOGRAMA DEL PROCESO', 'lib/Documentos/Compra-de-Servicios.png', '2017-02-21 22:44:49', 1),
(10, 'application/pdf', 'Ficha de proceso Compra Suministros', 'lib/Documentos/Ficha-de-proceso-Compra-suministros30-1.pdf', '2017-02-21 22:48:30', 1),
(11, 'image/png', 'FLUJOGRAMA DEL PROCESO', 'lib/Documentos/Compra-de-Suministros.png', '2017-02-21 22:48:30', 1),
(12, 'application/pdf', 'Ficha de Proceso', 'lib/Documentos/Ficha-de-proceso-Compra-y-pago-equipos-y-software31-1.pdf', '2017-02-21 22:51:49', 1),
(13, 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'FORMATO CREACION DE REFERENCIAS', 'lib/Documentos/FORMATO-CREACION-DE-REFERENCIAS-1.xlsx', '2017-02-21 22:51:49', 1),
(14, 'image/png', 'FLUJOGRAMA DEL PROCESO', 'lib/Documentos/Compra-y-Pago-de-Equipo-y-Software.png', '2017-02-21 22:51:49', 1),
(15, 'application/pdf', 'Ficha de proceso Consultoria', 'lib/Documentos/Ficha-de-proceso-Consuloria32-1.pdf', '2017-02-21 22:54:13', 1),
(16, 'image/png', 'FLUJOGRAMA DEL PROCESO', 'lib/Documentos/ConsultoriÌa.png', '2017-02-21 22:54:13', 1),
(17, 'application/pdf', 'Ficha de proceso ContrataciÃ³n personal administrativo', 'lib/Documentos/Ficha-de-proceso-ContrataciÂ¢n-personal-administrativo36-1.pdf', '2017-02-21 22:56:04', 1),
(18, 'image/png', 'FLUJOGRAMA DEL PROCESO', 'lib/Documentos/DIAGRAMA-1.png', '2017-02-21 22:56:04', 1),
(19, 'application/pdf', 'Ficha de proceso ContrataciÃ³n Profesor planta', 'lib/Documentos/Ficha-de-proceso-ContrataciÂ¢n-Profesor-planta20.pdf', '2017-02-21 22:58:03', 1),
(20, 'image/png', 'FLUJOGRAMA DEL PROCESO', 'lib/Documentos/DIAGRAMA-2.png', '2017-02-21 22:58:03', 1),
(21, 'application/pdf', 'Ficha de proceso CorreciÃ³n calificacion ingresada en el gradebook', 'lib/Documentos/Ficha-de-proceso-CorrecioÌn-calificacion-ingresada-en-el-gradebook.pdf', '2017-02-21 23:00:23', 1),
(22, 'application/pdf', 'Acta de modificaciÃ³n calificaciÃ³n definitiva', 'lib/Documentos/Acta-de-modificacioÌn-calificacioÌn-definitiva.pdf', '2017-02-21 23:00:23', 1),
(23, 'image/png', 'FLUJOGRAMA DEL PROCESO', 'lib/Documentos/CorreccioÌn-calificaciones-ingresadas-en-el-Gradebook.png', '2017-02-21 23:00:23', 1),
(24, 'application/pdf', 'Ficha de proceso EvaluaciÃ³n de desempeÃ±o Personal administrativo', 'lib/Documentos/Ficha-de-proceso-EvaluacioÌn-de-desempenÌƒo-administrativo39.pdf', '2017-02-21 23:04:27', 1),
(25, 'image/png', 'FLUJOGRAMA DEL PROCESO', 'lib/Documentos/EvaluacioÌn-de-DesempenÌƒo-Personal-Administrativo.png', '2017-02-21 23:04:27', 1),
(26, 'application/pdf', 'Ficha de proceso EvaluaciÃ³n de desempeÃ±o profesor', 'lib/Documentos/Ficha-de-proceso-EvaluacioÌn-de-desempenÌƒoprofesor28.pdf', '2017-02-21 23:06:26', 1),
(27, 'image/png', 'FLUJOGRAMA DEL PROCESO', 'lib/Documentos/EvaluacioÌn-de-DesempenÌƒo-Profesores.png', '2017-02-21 23:06:26', 1),
(28, 'application/pdf', 'Ficha de proceso EvaluaciÃ³n docencia', 'lib/Documentos/Ficha-de-proceso-EvaluacioÌn-docencia12.pdf', '2017-02-21 23:08:49', 1),
(29, 'image/png', 'FLUJOGRAMA DEL PROCESO', 'lib/Documentos/EvaluacioÌn-Docencia.png', '2017-02-21 23:08:49', 1),
(30, 'application/pdf', 'Ficha de proceso gestiÃ³n planeaciÃ³n departamento', 'lib/Documentos/Ficha-de-proceso-gestioÌn-planeacioÌn42.pdf', '2017-02-21 23:11:04', 1),
(31, 'image/png', 'FLUJOGRAMA DEL PROCESO', 'lib/Documentos/GestioÌn-del-Departamento.png', '2017-02-21 23:11:04', 1),
(32, 'application/pdf', 'Ficha de proceso HomologaciÃ³n o reconocimiento de asignaturas', 'lib/Documentos/Ficha-de-proceso-HomologacioÌn-o-reconocimiento-de-asignaturas23.pdf', '2017-02-21 23:12:39', 1),
(33, 'image/png', 'FLUJOGRAMA DEL PROCESO', 'lib/Documentos/HomologacioÌn-Reconocimiento-de-Asignaturas.png', '2017-02-21 23:12:39', 1),
(34, 'application/pdf', 'Ficha Ingreso de Calificaciones en el Gradebook', 'lib/Documentos/Ficha-Ingreso-de-Calificaciones-en-el-Gradebook.pdf', '2017-02-21 23:14:31', 1),
(35, 'image/png', 'FLUJOGRAMA DEL PROCESO', 'lib/Documentos/Ingreso-de-Calificaciones-en-el-Gradebook.png', '2017-02-21 23:14:31', 1),
(36, 'application/pdf', 'Ficha de proceso OrganizaciÃ³n eventos acadÃ©micos', 'lib/Documentos/Ficha-de-proceso-OrganizacioÌn-eventos-acadeÌmicos29.pdf', '2017-02-21 23:16:54', 1),
(37, 'image/png', 'FLUJOGRAMA DEL PROCESO', 'lib/Documentos/OrganizacioÌn-de-Eventos-AcadeÌmicos.png', '2017-02-21 23:16:54', 1),
(38, 'application/pdf', 'Ficha de proceso Pago monitor', 'lib/Documentos/Ficha-de-proceso-Pago-monitor25.pdf', '2017-02-21 23:18:12', 1),
(39, 'image/png', 'FLUJOGRAMA DEL PROCESO', 'lib/Documentos/Pago-de-Monitor.png', '2017-02-21 23:18:12', 1),
(40, 'application/pdf', 'Ficha de proceso PlaneaciÃ³n del Departamento', 'lib/Documentos/Ficha-de-proceso-PlaneacioÌn-del-Departamento41.pdf', '2017-02-21 23:20:08', 1),
(41, 'image/png', 'FLUJOGRAMA DEL PROCESO', 'lib/Documentos/PlaneacioÌn-del-Departamento.png', '2017-02-21 23:20:08', 1),
(42, 'application/pdf', 'Ficha de proceso PreparaciÃ³n y divulgaciÃ³n actividades del Depto', 'lib/Documentos/Ficha-de-proceso-PreparacioÌn-y-divulgacioÌn-actividades-del-Depto11.pdf', '2017-02-21 23:21:48', 1),
(43, 'image/png', 'FLUJOGRAMA DEL PROCESO', 'lib/Documentos/PreparacioÌn-de-Actividades-del-Departamento.png', '2017-02-21 23:21:48', 1),
(44, 'application/pdf', 'Ficha de proceso Presupuesto anual', 'lib/Documentos/Ficha-de-proceso-Presupuesto-anual13.pdf', '2017-02-21 23:24:13', 1),
(45, 'image/png', 'FLUJOGRAMA DEL PROCESO', 'lib/Documentos/Presupuesto-anual-300x155.png', '2017-02-21 23:24:13', 1),
(46, 'application/pdf', 'Ficha de proceso ProgramaciÃ³n exÃ¡menes en comÃºn', 'lib/Documentos/Ficha-de-proceso-ProgramacioÌn-exaÌmenes-en-comuÌn3.pdf', '2017-02-21 23:26:22', 1),
(47, 'image/png', 'FLUJOGRAMA DEL PROCESO', 'lib/Documentos/ProgramacioÌn-de-examenes-comunes-300x199.png', '2017-02-21 23:26:22', 1),
(48, 'image/png', 'FLUJOGRAMA DEL PROCESO', 'lib/Documentos/RecategorizacioÌn-Profesor-CaÌtedra.png', '2017-02-21 23:31:08', 1),
(49, 'image/png', 'FLUJOGRAMA DEL PROCESO', 'lib/Documentos/RecategorizacioÌn-Profesoral-Profesor-Planta.png', '2017-02-21 23:32:09', 1),
(50, 'image/png', 'FLUJOGRAMA DEL PROCESO', 'lib/Documentos/RecategorizacioÌn-Salarial-Profesor-Planta.png', '2017-02-21 23:33:36', 1),
(51, 'image/png', 'FLUJOGRAMA DEL PROCESO', 'lib/Documentos/RevisioÌn-Contenido-de-Asignaturas.png', '2017-02-21 23:34:58', 1),
(52, 'image/png', 'FLUJOGRAMA DEL PROCESO', 'lib/Documentos/SeleccioÌn-Monitor-AcadeÌmico-Administrativo.png', '2017-02-21 23:36:23', 1),
(53, 'application/pdf', 'Ficha de proceso SelecciÃ³n personal administrativo', 'lib/Documentos/Ficha-de-proceso-SeleccioÌn-personal-administrativo5.pdf', '2017-02-21 23:38:39', 1),
(54, 'image/png', 'FLUJOGRAMA DEL PROCESO', 'lib/Documentos/SeleccioÌn-Personal-Administrativo.png', '2017-02-21 23:38:39', 1),
(55, 'application/pdf', 'certificado_s.pdf', 'lib/Documentos/20170507071453_certificado_s.pdf', '2017-05-07 19:14:53', 2);

-- --------------------------------------------------------

--
-- Table structure for table `documento_caso`
--

CREATE TABLE `documento_caso` (
  `id_documento_caso` int(11) NOT NULL,
  `id_documento` int(11) NOT NULL,
  `id_caso` int(11) NOT NULL,
  `id_usuario_creo` int(11) NOT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `documento_caso`
--

INSERT INTO `documento_caso` (`id_documento_caso`, `id_documento`, `id_caso`, `id_usuario_creo`, `fecha_creacion`) VALUES
(1, 55, 1, 2, '2017-05-07 19:14:53');

-- --------------------------------------------------------

--
-- Table structure for table `documento_tipo_proceso`
--

CREATE TABLE `documento_tipo_proceso` (
  `id_documento_tipo_proceso` int(11) NOT NULL,
  `id_tipo_proceso` int(11) NOT NULL,
  `id_documento` int(11) NOT NULL,
  `fecha_creacion` datetime DEFAULT CURRENT_TIMESTAMP,
  `id_usr_creo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `documento_tipo_proceso`
--

INSERT INTO `documento_tipo_proceso` (`id_documento_tipo_proceso`, `id_tipo_proceso`, `id_documento`, `fecha_creacion`, `id_usr_creo`) VALUES
(1, 1, 1, '2017-02-21 22:03:31', 1),
(2, 1, 2, '2017-02-21 22:03:31', 1),
(3, 1, 3, '2017-02-21 22:03:31', 1),
(6, 3, 6, '2017-02-21 22:40:26', 1),
(7, 3, 7, '2017-02-21 22:40:26', 1),
(8, 4, 8, '2017-02-21 22:44:49', 1),
(9, 4, 9, '2017-02-21 22:44:49', 1),
(10, 5, 10, '2017-02-21 22:48:30', 1),
(11, 5, 11, '2017-02-21 22:48:30', 1),
(12, 6, 12, '2017-02-21 22:51:49', 1),
(13, 6, 13, '2017-02-21 22:51:49', 1),
(14, 6, 14, '2017-02-21 22:51:49', 1),
(15, 7, 15, '2017-02-21 22:54:13', 1),
(16, 7, 16, '2017-02-21 22:54:13', 1),
(17, 8, 17, '2017-02-21 22:56:04', 1),
(18, 8, 18, '2017-02-21 22:56:04', 1),
(19, 9, 19, '2017-02-21 22:58:03', 1),
(20, 9, 20, '2017-02-21 22:58:03', 1),
(21, 10, 21, '2017-02-21 23:00:23', 1),
(22, 10, 22, '2017-02-21 23:00:23', 1),
(23, 10, 23, '2017-02-21 23:00:23', 1),
(24, 11, 24, '2017-02-21 23:04:27', 1),
(25, 11, 25, '2017-02-21 23:04:27', 1),
(26, 12, 26, '2017-02-21 23:06:26', 1),
(27, 12, 27, '2017-02-21 23:06:26', 1),
(28, 13, 28, '2017-02-21 23:08:49', 1),
(29, 13, 29, '2017-02-21 23:08:49', 1),
(30, 14, 30, '2017-02-21 23:11:04', 1),
(31, 14, 31, '2017-02-21 23:11:04', 1),
(32, 15, 32, '2017-02-21 23:12:39', 1),
(33, 15, 33, '2017-02-21 23:12:39', 1),
(34, 16, 34, '2017-02-21 23:14:31', 1),
(35, 16, 35, '2017-02-21 23:14:31', 1),
(36, 17, 36, '2017-02-21 23:16:54', 1),
(37, 17, 37, '2017-02-21 23:16:54', 1),
(38, 18, 38, '2017-02-21 23:18:12', 1),
(39, 18, 39, '2017-02-21 23:18:12', 1),
(40, 19, 40, '2017-02-21 23:20:08', 1),
(41, 19, 41, '2017-02-21 23:20:08', 1),
(42, 20, 42, '2017-02-21 23:21:48', 1),
(43, 20, 43, '2017-02-21 23:21:48', 1),
(44, 21, 44, '2017-02-21 23:24:13', 1),
(45, 21, 45, '2017-02-21 23:24:13', 1),
(46, 22, 46, '2017-02-21 23:26:22', 1),
(47, 22, 47, '2017-02-21 23:26:22', 1),
(48, 23, 48, '2017-02-21 23:31:08', 1),
(49, 24, 49, '2017-02-21 23:32:09', 1),
(50, 25, 50, '2017-02-21 23:33:36', 1),
(51, 26, 51, '2017-02-21 23:34:58', 1),
(52, 27, 52, '2017-02-21 23:36:23', 1),
(53, 28, 53, '2017-02-21 23:38:39', 1),
(54, 28, 54, '2017-02-21 23:38:39', 1);

-- --------------------------------------------------------

--
-- Table structure for table `estado_proceso`
--

CREATE TABLE `estado_proceso` (
  `id_estado_proceso` int(11) NOT NULL,
  `estado_proceso` varchar(150) DEFAULT NULL,
  `estado` varchar(2) DEFAULT NULL,
  `id_usr_creo` int(11) DEFAULT NULL,
  `id_usr_modifico` int(11) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `fecha_modificacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `estado_proceso`
--

INSERT INTO `estado_proceso` (`id_estado_proceso`, `estado_proceso`, `estado`, `id_usr_creo`, `id_usr_modifico`, `fecha_creacion`, `fecha_modificacion`) VALUES
(0, 'Creado', 'AC', 1, NULL, '2016-11-21 00:00:00', '2016-11-21 12:04:25'),
(1, 'Solicitud Enviada', 'AC', 1, NULL, '2016-11-20 20:26:33', '2016-11-20 20:26:33'),
(2, 'Verificación Información', 'AC', 1, NULL, '2016-11-20 20:26:33', '2016-11-20 20:26:33'),
(3, 'Envío de comunicado', 'AC', 1, NULL, '2016-11-20 20:26:33', '2016-11-20 20:26:33'),
(5, 'Negociación', 'AC', 1, NULL, '2016-11-20 20:26:33', '2016-11-20 20:26:33'),
(6, 'Presentación propuesta', 'AC', 1, NULL, '2016-11-20 20:26:33', '2016-11-20 20:26:33'),
(7, 'Revisión Propuesta ', 'AC', 1, NULL, '2016-11-20 20:26:33', '2016-11-20 20:26:33'),
(8, 'Participación en convocatoria', 'AC', 1, NULL, '2016-11-20 20:26:33', '2016-11-20 20:26:33'),
(9, 'Ejecución Proyecto', 'AC', 1, NULL, '2016-11-20 20:26:33', '2016-11-20 20:26:33'),
(10, 'Cierre Proyecto', 'AC', 1, NULL, '2016-11-20 20:26:33', '2016-11-20 20:26:33'),
(11, 'Oferta laboral', 'AC', 1, NULL, '2016-11-20 20:26:33', '2016-11-20 20:26:33'),
(12, 'Contratación', 'AC', 1, NULL, '2016-11-20 20:26:33', '2016-11-20 20:26:33'),
(13, 'Realización de evaluación', 'AC', 1, NULL, '2016-11-20 20:26:33', '2016-11-20 20:26:33'),
(14, 'Plan de mejoramiento', 'AC', 1, NULL, '2016-11-20 20:26:33', '2016-11-20 20:26:33'),
(15, 'Recolección de información', 'AC', 1, NULL, '2016-11-20 20:26:33', '2016-11-20 20:26:33'),
(16, 'Análisis de información', 'AC', 1, NULL, '2016-11-20 20:26:33', '2016-11-20 20:26:33'),
(18, 'Recepción de bonos', 'AC', 1, NULL, '2016-11-20 20:26:33', '2016-11-20 20:26:33'),
(19, 'Entrega de bonos', 'AC', 1, NULL, '2016-11-20 20:26:33', '2016-11-20 20:26:33'),
(20, 'Redacción Boletín', 'AC', 1, NULL, '2016-11-20 20:26:33', '2016-11-20 20:26:33'),
(22, 'Cargue de Información', 'AC', 1, NULL, '2016-11-20 20:26:33', '2016-11-20 20:26:33'),
(23, 'Ajustes', 'AC', 1, NULL, '2016-11-20 20:26:33', '2016-11-20 20:26:33'),
(24, 'Finalizada', 'AC', 1, NULL, '2016-11-20 20:26:33', '2016-11-20 20:26:33'),
(25, 'Recepción de necesidades', 'AC', 1, NULL, '2016-11-20 20:26:33', '2016-11-20 20:26:33'),
(26, 'Solicitud de espacios', 'AC', 1, NULL, '2016-11-20 20:26:33', '2016-11-20 20:26:33'),
(27, 'Plan de acción', 'AC', 1, NULL, '2016-11-20 20:26:33', '2016-11-20 20:26:33'),
(28, 'Apertura Convocatoria', 'AC', 1, NULL, '2016-11-20 20:26:33', '2016-11-20 20:26:33'),
(29, 'Pruebas de selección', 'AC', 1, NULL, '2016-11-20 20:26:33', '2016-11-20 20:26:33'),
(30, 'Solicitud enviada a departamento', 'AC', 1, NULL, '2016-11-20 20:26:33', '2016-11-20 20:26:33'),
(31, 'Solicitud enviada por sistema', 'AC', 1, NULL, '2016-11-20 20:26:33', '2016-11-20 20:26:33'),
(32, 'Verificación de información', 'AC', 1, NULL, '2016-11-20 20:26:33', '2016-11-20 20:26:33'),
(33, 'Asignación de profesor', 'AC', 1, NULL, '2016-11-20 20:26:33', '2016-11-20 20:26:33'),
(34, 'Calificación de evaluación', 'AC', 1, NULL, '2016-11-20 20:26:33', '2016-11-20 20:26:33'),
(35, 'estadi1', 'AC', 1, NULL, '2016-12-13 11:40:50', '2016-12-13 11:40:50');

-- --------------------------------------------------------

--
-- Table structure for table `estado_tipo_proceso`
--

CREATE TABLE `estado_tipo_proceso` (
  `id_estado_tipo_proceso` int(11) NOT NULL,
  `id_tipo_proceso` int(11) NOT NULL,
  `id_estado_proceso` int(11) NOT NULL,
  `id_usr_creo` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `estado_tipo_proceso`
--

INSERT INTO `estado_tipo_proceso` (`id_estado_tipo_proceso`, `id_tipo_proceso`, `id_estado_proceso`, `id_usr_creo`, `fecha_creacion`) VALUES
(23, 1, 1, 2, '2017-05-15 13:14:55'),
(24, 1, 2, 2, '2017-05-15 13:14:55'),
(25, 3, 2, 2, '2017-05-15 13:27:54'),
(26, 3, 5, 2, '2017-05-15 13:27:54'),
(27, 3, 6, 2, '2017-05-15 13:27:54'),
(28, 3, 7, 2, '2017-05-15 13:27:54');

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE `links` (
  `id_links` int(11) NOT NULL,
  `link` varchar(150) NOT NULL,
  `accion` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `links`
--

INSERT INTO `links` (`id_links`, `link`, `accion`) VALUES
(1, 'USUARIOS', 'CargarVistaUsuarios()'),
(2, 'ROLES', 'CargarVistaRoles()'),
(3, 'ESTADOS', 'CargarVistaEstados()'),
(4, 'TIPO PROCESO', 'CargarTipoProceso()'),
(5, 'CREAR CASO', 'CargarCasosDisponi()'),
(6, 'VER CASOS', 'VerTotCasos()'),
(7, 'GRAFICAS', 'CargarVistaGraficas()'),
(8, 'VER MIS CASOS', 'VerMisCasos()');

-- --------------------------------------------------------

--
-- Table structure for table `links_rol`
--

CREATE TABLE `links_rol` (
  `id_links_rol` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `id_links` int(11) NOT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_usr_creo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `links_rol`
--

INSERT INTO `links_rol` (`id_links_rol`, `id_rol`, `id_links`, `fecha_creacion`, `id_usr_creo`) VALUES
(2, 8, 1, '2016-11-14 06:34:33', 2),
(5, 8, 4, '2016-11-14 06:48:36', 2),
(6, 8, 2, '2016-11-14 06:50:22', 2),
(7, 8, 3, '2016-11-14 06:50:26', 2),
(11, 8, 5, '2016-11-21 09:32:23', 3),
(12, 8, 6, '2016-11-21 12:57:50', 2),
(13, 8, 7, '2016-11-21 05:27:59', 2),
(14, 8, 8, '2016-11-26 09:11:47', 2),
(19, 14, 8, '2017-02-21 11:57:42', 2),
(20, 14, 5, '2017-02-21 11:57:48', 2),
(21, 16, 8, '2017-02-21 11:58:17', 2),
(22, 16, 5, '2017-02-21 11:58:20', 2),
(23, 15, 8, '2017-02-21 11:58:29', 2),
(24, 15, 5, '2017-02-21 11:58:33', 2),
(25, 13, 8, '2017-02-21 11:58:42', 2),
(26, 13, 5, '2017-02-21 11:58:46', 2);

-- --------------------------------------------------------

--
-- Table structure for table `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `rol` varchar(100) DEFAULT NULL,
  `id_usr_creo` int(11) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `id_usr_modifico` int(11) DEFAULT NULL,
  `fecha_modificacion` datetime DEFAULT CURRENT_TIMESTAMP,
  `estado` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rol`
--

INSERT INTO `rol` (`id_rol`, `rol`, `id_usr_creo`, `fecha_creacion`, `id_usr_modifico`, `fecha_modificacion`, `estado`) VALUES
(8, 'DIRECTOR DEL DEPARTAMENTO', 1, '2016-11-14 01:37:11', 1, '2016-11-14 13:37:11', 'AC'),
(13, 'PROFESOR PLANTA', 1, '2017-02-21 11:44:39', NULL, '2017-02-21 23:44:39', 'AC'),
(14, 'JEFE DE SECCION', 1, '2017-02-21 11:44:49', NULL, '2017-02-21 23:44:49', 'AC'),
(15, 'PROFESOR CATEDRA', 1, '2017-02-21 11:45:06', NULL, '2017-02-21 23:45:06', 'AC'),
(16, 'PERSONAL ADMINISTRATIVO', 1, '2017-02-21 11:45:18', NULL, '2017-02-21 23:45:18', 'AC');

-- --------------------------------------------------------

--
-- Table structure for table `rol_tipo_proceso`
--

CREATE TABLE `rol_tipo_proceso` (
  `id_rol_tipo_proceso` int(11) NOT NULL,
  `id_tipo_proceso` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `id_usr_creo` int(11) NOT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rol_tipo_proceso`
--

INSERT INTO `rol_tipo_proceso` (`id_rol_tipo_proceso`, `id_tipo_proceso`, `id_rol`, `id_usr_creo`, `fecha_creacion`) VALUES
(1, 1, 8, 2, '2017-02-21 10:05:26'),
(3, 3, 8, 2, '2017-02-21 10:40:39'),
(4, 4, 8, 2, '2017-02-21 10:48:38'),
(5, 5, 8, 2, '2017-02-21 10:48:41'),
(6, 6, 8, 2, '2017-02-21 11:00:37'),
(7, 7, 8, 2, '2017-02-21 11:00:40'),
(8, 8, 8, 2, '2017-02-21 11:00:43'),
(9, 9, 8, 2, '2017-02-21 11:00:45'),
(10, 10, 8, 2, '2017-02-21 11:00:48'),
(11, 11, 8, 2, '2017-02-21 11:27:34'),
(12, 12, 8, 2, '2017-02-21 11:27:39'),
(13, 13, 8, 2, '2017-02-21 11:27:43'),
(14, 14, 8, 2, '2017-02-21 11:27:46'),
(15, 15, 8, 2, '2017-02-21 11:27:49'),
(16, 16, 8, 2, '2017-02-21 11:27:52'),
(17, 17, 8, 2, '2017-02-21 11:27:55'),
(18, 18, 8, 2, '2017-02-21 11:27:58'),
(19, 19, 8, 2, '2017-02-21 11:28:01'),
(20, 20, 8, 2, '2017-02-21 11:28:04'),
(21, 21, 8, 2, '2017-02-21 11:28:08'),
(22, 22, 8, 2, '2017-02-21 11:28:12'),
(23, 23, 8, 2, '2017-02-21 11:39:08'),
(24, 24, 8, 2, '2017-02-21 11:39:13'),
(25, 25, 8, 2, '2017-02-21 11:39:18'),
(26, 26, 8, 2, '2017-02-21 11:39:22'),
(27, 27, 8, 2, '2017-02-21 11:39:26'),
(28, 28, 8, 2, '2017-02-21 11:39:31'),
(29, 3, 13, 2, '2017-02-21 11:48:22'),
(30, 4, 13, 2, '2017-02-21 11:48:31'),
(31, 5, 13, 2, '2017-02-21 11:48:35'),
(32, 6, 13, 2, '2017-02-21 11:48:42'),
(33, 7, 13, 2, '2017-02-21 11:48:45'),
(34, 9, 13, 2, '2017-02-21 11:48:56'),
(35, 10, 13, 2, '2017-02-21 11:49:05'),
(36, 12, 13, 2, '2017-02-21 11:49:22'),
(37, 13, 13, 2, '2017-02-21 11:49:35'),
(38, 16, 13, 2, '2017-02-21 11:49:53'),
(39, 17, 13, 2, '2017-02-21 11:50:02'),
(40, 24, 13, 2, '2017-02-21 11:50:38'),
(41, 25, 13, 2, '2017-02-21 11:50:47'),
(42, 1, 14, 2, '2017-02-21 11:52:21'),
(43, 4, 14, 2, '2017-02-21 11:52:29'),
(44, 5, 14, 2, '2017-02-21 11:52:38'),
(45, 6, 14, 2, '2017-02-21 11:52:44'),
(46, 7, 14, 2, '2017-02-21 11:52:49'),
(47, 10, 14, 2, '2017-02-21 11:53:00'),
(48, 12, 14, 2, '2017-02-21 11:53:11'),
(49, 13, 14, 2, '2017-02-21 11:53:22'),
(50, 15, 14, 2, '2017-02-21 11:53:28'),
(51, 16, 14, 2, '2017-02-21 11:53:39'),
(52, 17, 14, 2, '2017-02-21 11:53:49'),
(53, 22, 14, 2, '2017-02-21 11:54:00'),
(54, 8, 16, 2, '2017-02-21 11:55:14'),
(55, 11, 16, 2, '2017-02-21 11:55:25'),
(56, 27, 16, 2, '2017-02-21 11:55:38'),
(57, 28, 16, 2, '2017-02-21 11:55:45'),
(58, 1, 15, 2, '2017-02-21 11:56:28'),
(59, 10, 15, 2, '2017-02-21 11:56:38'),
(60, 12, 15, 2, '2017-02-21 11:56:47'),
(61, 13, 15, 2, '2017-02-21 11:56:54'),
(62, 16, 15, 2, '2017-02-21 11:57:04'),
(63, 23, 15, 2, '2017-02-21 11:57:16');

-- --------------------------------------------------------

--
-- Table structure for table `tipo_proceso`
--

CREATE TABLE `tipo_proceso` (
  `id_tipo_proceso` int(11) NOT NULL,
  `tipo_proceso` varchar(150) DEFAULT NULL,
  `icono` varchar(150) DEFAULT NULL,
  `id_usr_creo` int(11) DEFAULT NULL,
  `id_usr_modifico` int(11) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT CURRENT_TIMESTAMP,
  `fecha_modificacion` datetime DEFAULT CURRENT_TIMESTAMP,
  `estado` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipo_proceso`
--

INSERT INTO `tipo_proceso` (`id_tipo_proceso`, `tipo_proceso`, `icono`, `id_usr_creo`, `id_usr_modifico`, `fecha_creacion`, `fecha_modificacion`, `estado`) VALUES
(1, 'Categorización Profesor Catedra', 'ico_icono1.png', 1, NULL, '2017-02-21 10:03:31', '2017-02-21 22:03:31', 'AC'),
(3, 'Categorización Profesor Planta', 'ico_icono2.png', 1, NULL, '2017-02-21 10:40:26', '2017-02-21 22:40:26', 'AC'),
(4, 'Compra de Servicios', 'ico_icono3.png', 1, NULL, '2017-02-21 10:44:49', '2017-02-21 22:44:49', 'AC'),
(5, 'Compra de Suministros', 'ico_icono4.png', 1, NULL, '2017-02-21 10:48:30', '2017-02-21 22:48:30', 'AC'),
(6, 'Compra y Pago de Equipo de Software', 'ico_icono5.png', 1, NULL, '2017-02-21 10:51:49', '2017-02-21 22:51:49', 'AC'),
(7, 'Consultoría', 'ico_icono6.png', 1, NULL, '2017-02-21 10:54:13', '2017-02-21 22:54:13', 'AC'),
(8, 'Contratación Personal Administrativo', 'ico_icono7.png', 1, NULL, '2017-02-21 10:56:04', '2017-02-21 22:56:04', 'AC'),
(9, 'Contratación Profesor Planta', 'ico_icono8.png', 1, NULL, '2017-02-21 10:58:03', '2017-02-21 22:58:03', 'AC'),
(10, 'Corrección Calificación Gradebook', 'ico_icono9.png', 1, NULL, '2017-02-21 11:00:23', '2017-02-21 23:00:23', 'AC'),
(11, 'Evaluación de Desempeño Personal Administrativo', 'ico_icono10.png', 1, NULL, '2017-02-21 11:04:27', '2017-02-21 23:04:27', 'AC'),
(12, 'Evaluación de Desempeño Profesores', 'ico_icono11.png', 1, NULL, '2017-02-21 11:06:26', '2017-02-21 23:06:26', 'AC'),
(13, 'Evaluación Docencia', 'ico_icono12.png', 1, NULL, '2017-02-21 11:08:49', '2017-02-21 23:08:49', 'AC'),
(14, 'Gestión del Departamento', 'ico_icono13.png', 1, NULL, '2017-02-21 11:11:04', '2017-02-21 23:11:04', 'AC'),
(15, 'Homologación - Reconocimiento de Asignaturas', 'ico_icono14.png', 1, NULL, '2017-02-21 11:12:39', '2017-02-21 23:12:39', 'AC'),
(16, 'Ingreso de Calificaciones en el Gradebook', 'ico_icono15.png', 1, NULL, '2017-02-21 11:14:31', '2017-02-21 23:14:31', 'AC'),
(17, 'Organización de Eventos Académicos', 'ico_icono16.png', 1, NULL, '2017-02-21 11:16:54', '2017-02-21 23:16:54', 'AC'),
(18, 'Pago de Monitor', 'ico_icono17.png', 1, NULL, '2017-02-21 11:18:12', '2017-02-21 23:18:12', 'AC'),
(19, 'Planeación del Departamento', 'ico_icono18.png', 1, NULL, '2017-02-21 11:20:08', '2017-02-21 23:20:08', 'AC'),
(20, 'Preparación y divulgación actividades del Departamento', 'ico_icono19.png', 1, NULL, '2017-02-21 11:21:48', '2017-02-21 23:21:48', 'AC'),
(21, 'Presupuesto anual', 'ico_icono20.png', 1, NULL, '2017-02-21 11:24:13', '2017-02-21 23:24:13', 'AC'),
(22, 'Programación de examenes comunes', 'ico_icono21.png', 1, NULL, '2017-02-21 11:26:22', '2017-02-21 23:26:22', 'AC'),
(23, 'Recategorización Profesor Cátedra', 'ico_icono22.png', 1, NULL, '2017-02-21 11:31:08', '2017-02-21 23:31:08', 'AC'),
(24, 'Recategorización profesoral profesor planta', 'ico_icono23.png', 1, NULL, '2017-02-21 11:32:09', '2017-02-21 23:32:09', 'AC'),
(25, 'Recategorización salarial Profesor Planta', 'ico_icono24.png', 1, NULL, '2017-02-21 11:33:36', '2017-02-21 23:33:36', 'AC'),
(26, 'Revisión Contenido de Asignaturas', 'ico_icono25.png', 1, NULL, '2017-02-21 11:34:58', '2017-02-21 23:34:58', 'AC'),
(27, 'Selección Monitor Académico - Administrativo', 'ico_icono26.png', 1, NULL, '2017-02-21 11:36:23', '2017-02-21 23:36:23', 'AC'),
(28, 'Selección Personal Administrativo', 'ico_icono27.png', 1, NULL, '2017-02-21 11:38:39', '2017-02-21 23:38:39', 'AC');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(150) DEFAULT NULL,
  `nombres` varchar(150) DEFAULT NULL,
  `apellidos` varchar(150) DEFAULT NULL,
  `clave` varchar(300) DEFAULT NULL,
  `correo` varchar(150) DEFAULT NULL,
  `LDAP` varchar(5) DEFAULT NULL,
  `estado` varchar(2) DEFAULT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_modificacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre_usuario`, `nombres`, `apellidos`, `clave`, `correo`, `LDAP`, `estado`, `fecha_creacion`, `fecha_modificacion`) VALUES
(2, 'antares', 'Juan Camilo', 'Cruz Franco', 'f2ccf97e0987f5452ba6bf4e90560d7faf15f34030c2b1641294c0940edffc26eba798f6d372c72333a345006603f993b0a3d8e4bdadb2d96b43b65930b25335', 'kusanagimilo@gmail.com', 'NO', 'AC', '2016-11-14 03:08:36', '2016-11-14 15:08:36');

-- --------------------------------------------------------

--
-- Table structure for table `usuario_rol`
--

CREATE TABLE `usuario_rol` (
  `id_usuario_rol` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_rol` int(11) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuario_rol`
--

INSERT INTO `usuario_rol` (`id_usuario_rol`, `id_usuario`, `id_rol`, `fecha_creacion`) VALUES
(1, 2, 8, '2016-11-14 15:08:36'),
(24, 2, 13, '2017-02-21 23:45:33'),
(25, 2, 14, '2017-02-21 23:45:33'),
(26, 2, 15, '2017-02-21 23:45:33'),
(27, 2, 16, '2017-02-21 23:45:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `caso`
--
ALTER TABLE `caso`
  ADD PRIMARY KEY (`id_caso`);

--
-- Indexes for table `documento`
--
ALTER TABLE `documento`
  ADD PRIMARY KEY (`id_documento`);

--
-- Indexes for table `documento_caso`
--
ALTER TABLE `documento_caso`
  ADD PRIMARY KEY (`id_documento_caso`);

--
-- Indexes for table `documento_tipo_proceso`
--
ALTER TABLE `documento_tipo_proceso`
  ADD PRIMARY KEY (`id_documento_tipo_proceso`);

--
-- Indexes for table `estado_proceso`
--
ALTER TABLE `estado_proceso`
  ADD PRIMARY KEY (`id_estado_proceso`);

--
-- Indexes for table `estado_tipo_proceso`
--
ALTER TABLE `estado_tipo_proceso`
  ADD PRIMARY KEY (`id_estado_tipo_proceso`);

--
-- Indexes for table `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`id_links`);

--
-- Indexes for table `links_rol`
--
ALTER TABLE `links_rol`
  ADD PRIMARY KEY (`id_links_rol`);

--
-- Indexes for table `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indexes for table `rol_tipo_proceso`
--
ALTER TABLE `rol_tipo_proceso`
  ADD PRIMARY KEY (`id_rol_tipo_proceso`);

--
-- Indexes for table `tipo_proceso`
--
ALTER TABLE `tipo_proceso`
  ADD PRIMARY KEY (`id_tipo_proceso`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indexes for table `usuario_rol`
--
ALTER TABLE `usuario_rol`
  ADD PRIMARY KEY (`id_usuario_rol`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `caso`
--
ALTER TABLE `caso`
  MODIFY `id_caso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `documento`
--
ALTER TABLE `documento`
  MODIFY `id_documento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `documento_caso`
--
ALTER TABLE `documento_caso`
  MODIFY `id_documento_caso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `documento_tipo_proceso`
--
ALTER TABLE `documento_tipo_proceso`
  MODIFY `id_documento_tipo_proceso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `estado_proceso`
--
ALTER TABLE `estado_proceso`
  MODIFY `id_estado_proceso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `estado_tipo_proceso`
--
ALTER TABLE `estado_tipo_proceso`
  MODIFY `id_estado_tipo_proceso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `links`
--
ALTER TABLE `links`
  MODIFY `id_links` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `links_rol`
--
ALTER TABLE `links_rol`
  MODIFY `id_links_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `rol_tipo_proceso`
--
ALTER TABLE `rol_tipo_proceso`
  MODIFY `id_rol_tipo_proceso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT for table `tipo_proceso`
--
ALTER TABLE `tipo_proceso`
  MODIFY `id_tipo_proceso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `usuario_rol`
--
ALTER TABLE `usuario_rol`
  MODIFY `id_usuario_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
