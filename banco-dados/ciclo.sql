-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 18/09/2024 às 18:15
-- Versão do servidor: 8.2.0
-- Versão do PHP: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ciclo`
--
CREATE DATABASE IF NOT EXISTS `ciclo` DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci;
USE `ciclo`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `alunos`
--

DROP TABLE IF EXISTS `alunos`;
CREATE TABLE IF NOT EXISTS `alunos` (
  `idAluno` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `dataNascimento` date DEFAULT NULL,
  `idade` int DEFAULT NULL,
  `sexo` varchar(10) DEFAULT NULL,
  `cpf` varchar(15) NOT NULL,
  `rg` varchar(15) DEFAULT NULL,
  `telefone` varchar(45) DEFAULT NULL,
  `celular` varchar(45) NOT NULL,
  `cep` varchar(15) DEFAULT NULL,
  `estado` varchar(100) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `dataCadastro` date DEFAULT NULL,
  `situacao` varchar(45) NOT NULL,
  PRIMARY KEY (`idAluno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura para tabela `anamnese`
--

DROP TABLE IF EXISTS `anamnese`;
CREATE TABLE IF NOT EXISTS `anamnese` (
  `idAnamnese` int NOT NULL AUTO_INCREMENT,
  `atividade` varchar(45) DEFAULT NULL,
  `objetivo` varchar(45) DEFAULT NULL,
  `fumante` varchar(45) DEFAULT NULL,
  `alcool` varchar(45) DEFAULT NULL,
  `historicoFam` varchar(100) DEFAULT NULL,
  `hipertensao` varchar(45) DEFAULT NULL,
  `colesterol` varchar(45) DEFAULT NULL,
  `diabetes` varchar(45) DEFAULT NULL,
  `cardiaco` varchar(100) DEFAULT NULL,
  `cirurgia` varchar(100) DEFAULT NULL,
  `fratura` varchar(100) DEFAULT NULL,
  `lesao` varchar(100) DEFAULT NULL,
  `dor` varchar(100) DEFAULT NULL,
  `movimentos` varchar(100) DEFAULT NULL,
  `artrite` varchar(100) DEFAULT NULL,
  `medicamentos` varchar(100) DEFAULT NULL,
  `outros` varchar(100) DEFAULT NULL,
  `alimentacao` varchar(200) DEFAULT NULL,
  `dataCadastro` date DEFAULT NULL,
  `idAluno` int NOT NULL,
  PRIMARY KEY (`idAnamnese`),
  KEY `fk_anamnese_alunos1_idx` (`idAluno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura para tabela `medidas`
--

DROP TABLE IF EXISTS `medidas`;
CREATE TABLE IF NOT EXISTS `medidas` (
  `idMedidas` int NOT NULL AUTO_INCREMENT,
  `dataCadastro` date DEFAULT NULL,
  `peso` float DEFAULT NULL,
  `altura` float DEFAULT NULL,
  `freqCard` int DEFAULT NULL,
  `pressaoArterial` varchar(45) DEFAULT NULL,
  `torax` float DEFAULT NULL,
  `cintura` float DEFAULT NULL,
  `abdomen` float DEFAULT NULL,
  `quadril` float DEFAULT NULL,
  `bracoDireito` float DEFAULT NULL,
  `bracoEsquerdo` float DEFAULT NULL,
  `antebracoDireito` float DEFAULT NULL,
  `antebracoEsquerdo` float DEFAULT NULL,
  `coxaDireita` float DEFAULT NULL,
  `coxaEsquerda` float DEFAULT NULL,
  `panturrilhaDireita` float DEFAULT NULL,
  `panturrilhaEsquerda` float DEFAULT NULL,
  `peitoral` float DEFAULT NULL,
  `axilarMedia` float DEFAULT NULL,
  `abdominal` float DEFAULT NULL,
  `supraIliaca` float DEFAULT NULL,
  `subEscapular` float DEFAULT NULL,
  `tricipital` float DEFAULT NULL,
  `coxa` float DEFAULT NULL,
  `idAluno` int NOT NULL,
  PRIMARY KEY (`idMedidas`),
  KEY `fk_medidas_alunos_idx` (`idAluno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura para tabela `professor`
--

DROP TABLE IF EXISTS `professor`;
CREATE TABLE IF NOT EXISTS `professor` (
  `idProfessor` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `dataNascimento` date DEFAULT NULL,
  `sexo` varchar(10) DEFAULT NULL,
  `cpf` varchar(15) NOT NULL,
  `celular` varchar(45) NOT NULL,
  `cep` varchar(15) DEFAULT NULL,
  `cref` varchar(45) DEFAULT NULL,
  `estado` varchar(100) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `situacao` varchar(45) NOT NULL,
  `senha` varchar(255) NOT NULL,
  PRIMARY KEY (`idProfessor`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `professor`
--

INSERT INTO `professor` (`idProfessor`, `nome`, `dataNascimento`, `sexo`, `cpf`, `celular`, `cep`, `cref`, `estado`, `cidade`, `endereco`, `email`, `situacao`, `senha`) VALUES
(1, 'Professor Teste', '1990-05-23', 'M', '111.111.111-11', '(19)999998888', '13720-000', '099999-G/SP', 'SP', 'São José do Rio Pardo', 'Av. Brasil, 100, Centro', 'profteste@gmail.com', 'ATIVO', '$2y$10$peg9u/CYPAb7ZWe7ysCFOecOX6D/ZOBwRP86d7Bei5Wd1G78q0lRK');

-- --------------------------------------------------------

--
-- Estrutura para tabela `testevo2`
--

DROP TABLE IF EXISTS `testevo2`;
CREATE TABLE IF NOT EXISTS `testevo2` (
  `idTesteVO2` int NOT NULL AUTO_INCREMENT,
  `dataCadastro` date DEFAULT NULL,
  `velocidadeInicial` int DEFAULT NULL,
  `velocidadeFinal` int DEFAULT NULL,
  `fcInicial` varchar(45) DEFAULT NULL,
  `fcFinal` varchar(45) DEFAULT NULL,
  `tempoTeste` int DEFAULT NULL,
  `esforcoTeste` int DEFAULT NULL,
  `idAluno` int NOT NULL,
  PRIMARY KEY (`idTesteVO2`),
  KEY `fk_testeVO2_alunos1_idx` (`idAluno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `anamnese`
--
ALTER TABLE `anamnese`
  ADD CONSTRAINT `fk_anamnese_alunos1` FOREIGN KEY (`idAluno`) REFERENCES `alunos` (`idAluno`);

--
-- Restrições para tabelas `medidas`
--
ALTER TABLE `medidas`
  ADD CONSTRAINT `fk_medidas_alunos` FOREIGN KEY (`idAluno`) REFERENCES `alunos` (`idAluno`);

--
-- Restrições para tabelas `testevo2`
--
ALTER TABLE `testevo2`
  ADD CONSTRAINT `fk_testeVO2_alunos1` FOREIGN KEY (`idAluno`) REFERENCES `alunos` (`idAluno`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
