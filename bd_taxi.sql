-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 09-Jan-2017 às 02:37
-- Versão do servidor: 5.6.12-log
-- versão do PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `bd_taxi`
--
CREATE DATABASE IF NOT EXISTS `bd_taxi` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `bd_taxi`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_contato`
--

CREATE TABLE IF NOT EXISTS `tbl_contato` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Ilha` varchar(20) NOT NULL,
  `Cidade` varchar(50) NOT NULL,
  `Zona` varchar(50) NOT NULL,
  `Telenovel` int(11) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `BI` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_destino`
--

CREATE TABLE IF NOT EXISTS `tbl_destino` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Cidade` varchar(50) NOT NULL,
  `Zona` varchar(50) NOT NULL,
  `Endereco` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_empresa`
--

CREATE TABLE IF NOT EXISTS `tbl_empresa` (
  `NIF` int(11) NOT NULL,
  `Nome` varchar(30) NOT NULL,
  `Propietario` varchar(128) NOT NULL,
  `DataRegisto` date NOT NULL,
  `Ilha` varchar(20) NOT NULL,
  `Cidade` varchar(50) NOT NULL,
  `Zona` varchar(50) NOT NULL,
  `User` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  PRIMARY KEY (`NIF`),
  UNIQUE KEY `User` (`User`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbl_empresa`
--

INSERT INTO `tbl_empresa` (`NIF`, `Nome`, `Propietario`, `DataRegisto`, `Ilha`, `Cidade`, `Zona`, `User`, `Password`) VALUES
(123456789, 'MoreTaxi', 'Elton Moreno', '2017-01-02', 'Santiago', 'Praia', 'Fazenda', 'moretaxi', 'moretaxi');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_local`
--

CREATE TABLE IF NOT EXISTS `tbl_local` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Latitude` int(11) NOT NULL,
  `Longitude` int(11) NOT NULL,
  `Ilha` varchar(20) NOT NULL,
  `Cidade` varchar(50) NOT NULL,
  `Zona` varchar(50) NOT NULL,
  `Endereco` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_motorista`
--

CREATE TABLE IF NOT EXISTS `tbl_motorista` (
  `BI` int(11) NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `Apelido` varchar(50) NOT NULL,
  `DataNascimento` date NOT NULL,
  `NumeroCarta` int(11) NOT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `NomeUtilizador` varchar(50) DEFAULT NULL,
  `Password` varchar(50) NOT NULL,
  `DataRegisto` date NOT NULL,
  PRIMARY KEY (`BI`),
  UNIQUE KEY `uniqueUtilizador` (`NomeUtilizador`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbl_motorista`
--

INSERT INTO `tbl_motorista` (`BI`, `Nome`, `Apelido`, `DataNascimento`, `NumeroCarta`, `Email`, `NomeUtilizador`, `Password`, `DataRegisto`) VALUES
(1, 'Erica', 'Monteiro', '2001-03-25', 55996633, 'erica@hotmail.com', 'erica', 'erica', '2017-01-03'),
(399110, 'Elton', 'Moreno', '1995-11-28', 12345678, 'elton@hotmail.com', 'elton', 'elton', '2017-01-05');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_motorista_taxi`
--

CREATE TABLE IF NOT EXISTS `tbl_motorista_taxi` (
  `IdTaxi` int(11) NOT NULL,
  `BiMotorista` int(11) NOT NULL,
  `Data` date NOT NULL,
  `Estado` varchar(10) NOT NULL,
  PRIMARY KEY (`IdTaxi`,`BiMotorista`),
  KEY `fk_taxi_taxi` (`BiMotorista`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_pedido`
--

CREATE TABLE IF NOT EXISTS `tbl_pedido` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `BI` int(11) NOT NULL,
  `IdTaxi` int(11) NOT NULL,
  `IdLocal` int(11) NOT NULL,
  `IdDestino` int(11) NOT NULL,
  `Data` date NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `fk_taxi_pediso` (`IdTaxi`),
  KEY `fk_local_pediso` (`IdLocal`),
  KEY `fk_destino_pediso` (`IdDestino`),
  KEY `fk_usuario_pedido` (`BI`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_taxi`
--

CREATE TABLE IF NOT EXISTS `tbl_taxi` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Matricula` varchar(15) NOT NULL,
  `Marca` varchar(30) NOT NULL,
  `Modelo` varchar(30) NOT NULL,
  `Ilha` varchar(20) NOT NULL,
  `Cidade` varchar(30) NOT NULL,
  `IdEmpresa` int(11) DEFAULT NULL,
  `DataRegisto` date NOT NULL,
  `DataCompra` date DEFAULT NULL,
  `Garantia` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `fk_empresa_taxi` (`IdEmpresa`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Extraindo dados da tabela `tbl_taxi`
--

INSERT INTO `tbl_taxi` (`ID`, `Matricula`, `Marca`, `Modelo`, `Ilha`, `Cidade`, `IdEmpresa`, `DataRegisto`, `DataCompra`, `Garantia`) VALUES
(1, 'ST-55-DC', 'BMW', 'X5', 'Santiago', 'Praia', NULL, '2017-01-08', '2016-12-12', 3),
(2, 'ST-00-EL', 'Toyota', 'Corola', 'Santiago', 'Praia', NULL, '2017-01-08', '2017-01-08', 4),
(3, 'SV-54-MI', 'Ferari', 'F8', 'Sal', 'Sal Rei', NULL, '2017-01-08', '2004-09-05', 10),
(5, 'ST-20-MO', 'Audi', 'Q7', 'Santiago', 'Santa Catarina', NULL, '2017-01-08', '2007-05-14', 9),
(7, 'SA-01-KE', 'Toytota', 'Corola', 'Santo AntÃ£o', 'Porto Novo', NULL, '2017-01-09', '2013-09-05', 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_usuario`
--

CREATE TABLE IF NOT EXISTS `tbl_usuario` (
  `BI` int(11) NOT NULL,
  `Nome` varchar(30) NOT NULL,
  `Apelido` text NOT NULL,
  `DataNascimento` date NOT NULL,
  `Sexo` varchar(10) NOT NULL,
  `DataRegisto` date NOT NULL,
  `Password` varchar(150) NOT NULL,
  `Email` varchar(50) NOT NULL,
  PRIMARY KEY (`BI`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbl_usuario`
--

INSERT INTO `tbl_usuario` (`BI`, `Nome`, `Apelido`, `DataNascimento`, `Sexo`, `DataRegisto`, `Password`, `Email`) VALUES
(2, 'Varela', 'Mendes', '2016-12-14', '1', '2016-12-29', 'varela', 'varela@hotmail.com'),
(10, 'Moreno', 'Silva', '1993-05-12', '1', '2016-12-31', '123', 'moreno@hotmail.com'),
(33, '33', '33', '2016-12-31', '1', '2016-12-31', '12345', '33@hotmail.com'),
(100, 'silva', 'Henrique', '1995-11-28', '1', '2016-12-29', '11111', 'silva@hotmail.com'),
(12345, 'Keila', 'Sofia', '1996-09-30', '1', '2016-12-31', 'keila', 'keila@hotmail.com'),
(399110, 'Elton', 'Moreno', '1995-11-28', '1', '2016-12-29', '12345', 'elton@hotmail.com'),
(492935, 'reihh', 'Moreno', '2001-03-25', '1', '2016-12-31', '11111', 'morenoerica58@gmail.com');

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `tbl_motorista_taxi`
--
ALTER TABLE `tbl_motorista_taxi`
  ADD CONSTRAINT `fk_taxi_motorista` FOREIGN KEY (`IdTaxi`) REFERENCES `tbl_taxi` (`ID`),
  ADD CONSTRAINT `fk_taxi_taxi` FOREIGN KEY (`BiMotorista`) REFERENCES `tbl_motorista` (`BI`);

--
-- Limitadores para a tabela `tbl_pedido`
--
ALTER TABLE `tbl_pedido`
  ADD CONSTRAINT `fk_destino_pediso` FOREIGN KEY (`IdDestino`) REFERENCES `tbl_destino` (`ID`),
  ADD CONSTRAINT `fk_local_pediso` FOREIGN KEY (`IdLocal`) REFERENCES `tbl_local` (`ID`),
  ADD CONSTRAINT `fk_taxi_pediso` FOREIGN KEY (`IdTaxi`) REFERENCES `tbl_taxi` (`ID`),
  ADD CONSTRAINT `fk_usuario_pedido` FOREIGN KEY (`BI`) REFERENCES `tbl_usuario` (`BI`);

--
-- Limitadores para a tabela `tbl_taxi`
--
ALTER TABLE `tbl_taxi`
  ADD CONSTRAINT `fk_empresa_taxi` FOREIGN KEY (`IdEmpresa`) REFERENCES `tbl_empresa` (`NIF`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
