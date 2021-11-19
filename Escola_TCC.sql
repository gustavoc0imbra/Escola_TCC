-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07-Nov-2021 às 21:59
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

-- --------------------------------------------------------

--
-- Estrutura da tabela `acervo`
--

use escola_tcc;

CREATE TABLE `acervo` (
  `codArquivo` int(11) NOT NULL,
  `arquivo` varchar(40) NOT NULL,
  `dataUp` datetime NOT NULL
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

--
-- Extraindo dados da tabela `administrador`
--

INSERT INTO `administrador` (`codAdm`, `nomeAdm`, `senhaAdm`) VALUES
(1, 'Paula Anjos', '$2y$10$kUF6w.muyXs1KobsvXE5FeM/yDRGy12rdnOt6c3bvF6qQP7awBb9O');

-- --------------------------------------------------------

--
-- Estrutura da tabela `armazinfo`
--

CREATE TABLE `armazinfo` (
  `notaAluno` int(2) NOT NULL,
  `mediaBimestre` decimal(20,0) NOT NULL,
  `frequenciaAluno` int(11) NOT NULL,
  `FKcodDisciplina` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina`
--

CREATE TABLE `disciplina` (
  `codDisciplina` int(11) NOT NULL,
  `nomeDisciplina` varchar(60) NOT NULL,
  `(FK)codProf` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `disciplina`
--

INSERT INTO `disciplina` (`codDisciplina`, `nomeDisciplina`, `(FK)codProf`) VALUES
(1, 'Matemática', '');

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
  `imagemEstudante` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `estudante`
--

INSERT INTO `estudante` (`codAluno`, `nomeAluno`, `senhaAluno`, `datanascAluno`, `RG`, `CPF`, `telefoneAluno`, `bairroAluno`, `ruaAluno`, `cidadeAluno`, `imagemEstudante`) VALUES
(2, 'Gustavo Silva Coimbra', '$2y$10$sA49l/tuIY7OOZNLir22u.hAc/tDlak7r5Utzenhvg6IJ8fjeSUDC', '2004-03-16', 58888, 48089258859, 3392, 'Vila Cerqueira', 'Rua Benedito Storani', 'Américo Brasiliense', NULL),
(3, 'Joao Paulo da Silva Rufino', '$2y$10$k1mJ2gB6ROE9rqPG2htUeeY7GaYvk977JOlkpAysGXeHKNkO5ZNja', '2004-03-20', 45465, 544546, 4002, 'Santa Terezinha', 'Não faço ideia', 'Américo Brasiliense', NULL),
(4, 'Kevin Fernando Santos de Olive', '$2y$10$3/RQFgzkgV6BFBc9V4Ehuev/l0H/.r/841iM3Aiqo6KTy/0UzB81S', '2003-03-17', 49426, 55259, 4002, 'São Rafael', 'Rua Divina Prandi Brandão', 'Araraquara', 'Imagens/kevin.png'),
(5, 'Tiago Costa Santos', '$2y$10$l2wUc.TkTLhoZ2T14qQLbulE7l8vYGnvl3VC9QOmQSqWrp1u0KV.m', '2003-06-05', 37250, 149325, 1699770, 'NaoSei', 'Groove St', 'Araraquara', NULL),
(6, 'Marcus Vinicius Revoredo', '$2y$10$aAufmELZD2isFeeu4DR8v.vRa/0zqYqY/B8nr2L8s//GKv4PK69KC', '2003-06-08', 4545, 532948, 997986934, 'Vale do Sol', 'Rua Gilda Renê ', 'Araraquara', NULL),
(7, 'Cauã Ferras Moreira Pereira', '$2y$10$G4RF2bAufop3QIiZU1x8L.B2g35OX38lAxMIvW47RKX6uDNcV.Mzm', '2004-03-13', 498927318, 555666, 16996122101, 'Jardim Botânico', 'Av. Dom Carlos Carmelo', 'Araraquara', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `informacoes`
--

CREATE TABLE `informacoes` (
  `(FK)notaAluno` int(2) NOT NULL,
  `(FK)mediaBimestre` decimal(20,0) NOT NULL,
  `(FK)frequenciaAluno` int(11) NOT NULL
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
  `codTurma` int(10) DEFAULT NULL,
  `nomeTurma` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `professor`
--

INSERT INTO `professor` (`codProf`, `nomeProf`, `senhaProf`, `datanascProf`, `celProf`, `telProf`, `bairroProf`, `ruaProf`, `cidadeProf`, `codDisciplina`, `imagemProfessor`, `codTurma`, `nomeTurma`) VALUES
(1, 'Eliane Fais Oliveira', '$2y$10$WsmhuoCp58CXmkcHyoqp4.Vkp/eIaaC0FChjG9s9FvojTqtQh4/B2', '0000-00-00', 0, 3333, 'Vila Xavier', 'NaoSei', 'Araraquara', 1, NULL, 1, '6-ANO-A');

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
  `codTurma` int(10) NOT NULL,
  `nomeTurma` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `turmas`
--

INSERT INTO `turmas` (`codTurma`, `nomeTurma`) VALUES
(1, '6-ANO-A');

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
-- Índices para tabela `informacoes`
--
ALTER TABLE `informacoes`
  ADD PRIMARY KEY (`(FK)notaAluno`);

--
-- Índices para tabela `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`codProf`),
  ADD KEY `codDisciplina` (`codDisciplina`),
  ADD KEY `codTurma` (`codTurma`);

--
-- Índices para tabela `responsaveis`
--
ALTER TABLE `responsaveis`
  ADD PRIMARY KEY (`codResponsavel`),
  ADD KEY `codAluno` (`codAluno`),
  ADD KEY `senhaAluno` (`senhaAluno`);

--
-- Índices para tabela `turmas`
--
ALTER TABLE `turmas`
  ADD PRIMARY KEY (`codTurma`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `acervo`
--
ALTER TABLE `acervo`
  MODIFY `codArquivo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `administrador`
--
ALTER TABLE `administrador`
  MODIFY `codAdm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `disciplina`
--
ALTER TABLE `disciplina`
  MODIFY `codDisciplina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `estudante`
--
ALTER TABLE `estudante`
  MODIFY `codAluno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `professor`
--
ALTER TABLE `professor`
  MODIFY `codProf` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `responsaveis`
--
ALTER TABLE `responsaveis`
  MODIFY `codResponsavel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `professor`
--
ALTER TABLE `professor`
  ADD CONSTRAINT `professor_ibfk_1` FOREIGN KEY (`codDisciplina`) REFERENCES `disciplina` (`codDisciplina`),
  ADD CONSTRAINT `professor_ibfk_2` FOREIGN KEY (`codTurma`) REFERENCES `turmas` (`codTurma`);

--
-- Limitadores para a tabela `responsaveis`
--
ALTER TABLE `responsaveis`
  ADD CONSTRAINT `responsaveis_ibfk_1` FOREIGN KEY (`codAluno`) REFERENCES `estudante` (`codAluno`),
  ADD CONSTRAINT `responsaveis_ibfk_2` FOREIGN KEY (`senhaAluno`) REFERENCES `estudante` (`codAluno`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
