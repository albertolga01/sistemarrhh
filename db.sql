/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.7.41 : Database - jkmpg7ol_adminpanel
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`jkmpg7ol_adminpanel` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `jkmpg7ol_adminpanel`;

/*Table structure for table `actividades` */

DROP TABLE IF EXISTS `actividades`;

CREATE TABLE `actividades` (
  `idActividades` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuario` int(11) DEFAULT NULL,
  `cambio` varchar(100) DEFAULT NULL,
  `fechaCambio` date DEFAULT NULL,
  PRIMARY KEY (`idActividades`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Table structure for table `candidatos` */

DROP TABLE IF EXISTS `candidatos`;

CREATE TABLE `candidatos` (
  `idcandidato` int(11) NOT NULL AUTO_INCREMENT,
  `nombreCandidato` varchar(100) DEFAULT NULL,
  `fechaEntrevista` date DEFAULT NULL,
  `psicometrico` tinyint(4) DEFAULT NULL,
  `referencias` text,
  `comentarios` text,
  `puesto` varchar(50) DEFAULT NULL,
  `telefono` varchar(12) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idcandidato`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `empleados` */

DROP TABLE IF EXISTS `empleados`;

CREATE TABLE `empleados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `domicilio` varchar(200) NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `escolaridad` varchar(50) NOT NULL,
  `curp` varchar(18) NOT NULL,
  `rfc` varchar(13) NOT NULL,
  `tipoSangre` varchar(3) NOT NULL,
  `puesto` varchar(80) NOT NULL,
  `area` varchar(80) NOT NULL,
  `tipoPerfil` varchar(80) NOT NULL,
  `celular` varchar(10) NOT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `salario` float DEFAULT NULL,
  `fechaIngreso` date NOT NULL,
  `tallaCamisa` int(11) NOT NULL,
  `tallaPantalon` int(11) DEFAULT NULL,
  `tallaBotas` int(11) DEFAULT NULL,
  `foto` varchar(80) NOT NULL,
  `nombreEmergencia` varchar(80) NOT NULL,
  `celularEmergencia` varchar(10) NOT NULL,
  `telefonoEmergencia` varchar(10) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL,
  `observaciones` text,
  `fechaBaja` date DEFAULT NULL,
  `numeroSeguro` varchar(11) NOT NULL,
  `estadoCivil` varchar(50) NOT NULL,
  `infonavitEmpleado` tinyint(4) DEFAULT NULL,
  `montoDescuento` float DEFAULT NULL,
  `fonacotEmpleado` tinyint(4) DEFAULT NULL,
  `numeroCredito` varchar(20) DEFAULT NULL,
  `CuentaBancaria` tinyint(4) DEFAULT NULL,
  `Banco` varchar(45) DEFAULT NULL,
  `numeroCuenta` varchar(10) DEFAULT NULL,
  `claveInterbancaria` varchar(18) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `hijos` */

DROP TABLE IF EXISTS `hijos`;

CREATE TABLE `hijos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombreHijo` varchar(100) DEFAULT NULL,
  `fechaNacimiento` datetime DEFAULT NULL,
  `idEmpleado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Table structure for table `uniformes` */

DROP TABLE IF EXISTS `uniformes`;

CREATE TABLE `uniformes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idEmpleado` int(11) NOT NULL,
  `nombreEmpleado` varchar(100) NOT NULL,
  `camisa` tinyint(1) NOT NULL,
  `pantalon` tinyint(1) NOT NULL,
  `botas` tinyint(1) NOT NULL,
  `fechaEntrega` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tipo` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
