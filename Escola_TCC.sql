-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06-Dez-2021 às 19:01
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `escola_tcc`
--
CREATE DATABASE IF NOT EXISTS `escola_tcc` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `escola_tcc`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `acervo`
--

CREATE TABLE `acervo` (
  `codArquivo` int(11) NOT NULL,
  `path` varchar(150) NOT NULL,
  `dataUp` datetime NOT NULL DEFAULT current_timestamp(),
  `nome` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `administrador`
--

CREATE TABLE `administrador` (
  `codAdm` int(11) NOT NULL,
  `nomeAdm` varchar(60) NOT NULL,
  `senhaAdm` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `armazinfo`
--

CREATE TABLE `armazinfo` (
  `notaAluno` int(2) NOT NULL,
  `mediaBimestre` decimal(20,0) NOT NULL,
  `frequenciaAluno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina`
--

CREATE TABLE `disciplina` (
  `codDisciplina` int(11) NOT NULL,
  `nomeDisciplina` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `estudante`
--

CREATE TABLE `estudante` (
  `codAluno` int(11) NOT NULL,
  `nomeAluno` varchar(80) NOT NULL,
  `senhaAluno` varchar(60) DEFAULT NULL,
  `datanascAluno` date NOT NULL,
  `RG` bigint(12) NOT NULL,
  `CPF` bigint(12) NOT NULL,
  `telefoneAluno` bigint(11) NOT NULL,
  `bairroAluno` varchar(60) NOT NULL,
  `ruaAluno` varchar(60) NOT NULL,
  `cidadeAluno` varchar(60) NOT NULL,
  `imagemEstudante` varchar(50) DEFAULT NULL,
  `turma` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `frequencia`
--

CREATE TABLE `frequencia` (
  `cod` int(11) NOT NULL,
  `aluno` int(11) DEFAULT NULL,
  `disciplina` int(11) DEFAULT NULL,
  `aulas` int(11) DEFAULT NULL,
  `faltas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `notas`
--

CREATE TABLE `notas` (
  `cod` int(11) NOT NULL,
  `aluno` int(11) DEFAULT NULL,
  `disciplina` int(11) DEFAULT NULL,
  `n1` int(11) DEFAULT NULL,
  `n2` int(11) DEFAULT NULL,
  `n3` int(11) DEFAULT NULL,
  `n4` int(11) DEFAULT NULL,
  `final` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `professor`
--

CREATE TABLE `professor` (
  `codProf` int(11) NOT NULL,
  `nomeProf` varchar(60) NOT NULL,
  `senhaProf` varchar(60) DEFAULT NULL,
  `datanascProf` date NOT NULL,
  `celProf` bigint(11) NOT NULL,
  `telProf` int(8) NOT NULL,
  `bairroProf` varchar(60) NOT NULL,
  `ruaProf` varchar(90) NOT NULL,
  `cidadeProf` varchar(60) NOT NULL,
  `codDisciplina` int(11) DEFAULT NULL,
  `imagemProfessor` varchar(50) DEFAULT NULL,
  `codTurma` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `responsaveis`
--

CREATE TABLE `responsaveis` (
  `codResponsavel` int(11) NOT NULL,
  `cpfMae` bigint(12) NOT NULL,
  `rgMae` bigint(12) NOT NULL,
  `codAluno` int(11) NOT NULL,
  `senhaAluno` int(11) NOT NULL,
  `nomeResponsavel` varchar(60) DEFAULT NULL,
  `senhaResponsavel` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `turmas`
--

CREATE TABLE `turmas` (
  `cod` int(11) NOT NULL,
  `codTurma` varchar(20) DEFAULT NULL,
  `nomeTurma` varchar(60) DEFAULT NULL,
  `tempPorAula` int(11) DEFAULT NULL,
  `intervalo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `acervo`
--
ALTER TABLE `acervo`
  ADD PRIMARY KEY (`codArquivo`);

--
-- Índices para tabela `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`codAdm`);

--
-- Índices para tabela `armazinfo`
--
ALTER TABLE `armazinfo`
  ADD PRIMARY KEY (`notaAluno`);

--
-- Índices para tabela `disciplina`
--
ALTER TABLE `disciplina`
  ADD PRIMARY KEY (`codDisciplina`);

--
-- Índices para tabela `estudante`
--
ALTER TABLE `estudante`
  ADD PRIMARY KEY (`codAluno`);

--
-- Índices para tabela `frequencia`
--
ALTER TABLE `frequencia`
  ADD PRIMARY KEY (`cod`);

--
-- Índices para tabela `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`codProf`);

--
-- Índices para tabela `turmas`
--
ALTER TABLE `turmas`
  ADD PRIMARY KEY (`cod`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `acervo`
--
ALTER TABLE `acervo`
  MODIFY `codArquivo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `disciplina`
--
ALTER TABLE `disciplina`
  MODIFY `codDisciplina` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `estudante`
--
ALTER TABLE `estudante`
  MODIFY `codAluno` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `frequencia`
--
ALTER TABLE `frequencia`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `professor`
--
ALTER TABLE `professor`
  MODIFY `codProf` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `turmas`
--
ALTER TABLE `turmas`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
