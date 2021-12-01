-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30-Nov-2021 às 18:15
-- Versão do servidor: 10.4.20-MariaDB
-- versão do PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
create database escola_tcc;
use escola_tcc;

CREATE TABLE `acervo` (
  `codArquivo` int(11) NOT NULL,
  `path` varchar(150) NOT NULL,
  `dataUp` datetime NOT NULL DEFAULT current_timestamp(),
  `nome` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `acervo`
--

INSERT INTO `acervo` (`codArquivo`, `path`, `dataUp`, `nome`) VALUES
(29, 'Arquivos/61a51589229d4.mp3', '2021-11-29 15:01:45', 'AC_DC - Back In Black (Official Video).mp3'),
(30, 'Arquivos/61a519089452e.jpg', '2021-11-29 15:16:40', '862674.jpg');

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
(1, 'Paula', '$2y$10$HiH3hGdDr/hEE2X8Ppw5gea8xkIRVQi5L.suWE.Pc4VNpZuC6xd8i'),
(2, 'Guzera_GOD', '$2y$10$nHg2LvXyuxkSGL8Q2sCE7OrxoD4bL6jW80nbuFYUJ9NjDGwPmZNwO');

-- --------------------------------------------------------

--
-- Estrutura da tabela `armazinfo`
--

CREATE TABLE `armazinfo` (
  `notaAluno` int(2) NOT NULL,
  `mediaBimestre` decimal(20,0) NOT NULL,
  `frequenciaAluno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `armazinfo`
--

INSERT INTO `armazinfo` (`notaAluno`, `mediaBimestre`, `frequenciaAluno`) VALUES
(4, '4', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina`
--

CREATE TABLE `disciplina` (
  `codDisciplina` int(11) NOT NULL,
  `nomeDisciplina` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `disciplina`
--

INSERT INTO `disciplina` (`codDisciplina`, `nomeDisciplina`) VALUES
(1, 'Matematica'),
(2, 'Portugues'),
(3, 'Historia'),
(4, 'Geografia'),
(5, 'Física'),
(6, 'Inglês');

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplinasturma1`
--

CREATE TABLE `disciplinasturma1` (
  `cod` int(11) NOT NULL,
  `disciplinas` int(11) DEFAULT NULL,
  `professores` int(11) DEFAULT NULL,
  `extraProf` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `disciplinasturma1`
--

INSERT INTO `disciplinasturma1` (`cod`, `disciplinas`, `professores`, `extraProf`) VALUES
(1, 3, 10, 0),
(2, 4, 11, 0),
(3, 6, 0, 0),
(4, 5, 0, 0),
(5, 2, 8, 9);

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplinasturmab`
--

CREATE TABLE `disciplinasturmab` (
  `cod` int(11) NOT NULL,
  `disciplinas` int(11) DEFAULT NULL,
  `professores` int(11) DEFAULT NULL,
  `extraProf` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `disciplinasturmab`
--

INSERT INTO `disciplinasturmab` (`cod`, `disciplinas`, `professores`, `extraProf`) VALUES
(1, 2, 8, 0),
(2, 6, 0, 0),
(3, 3, 10, 0),
(4, 5, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplinasturmac`
--

CREATE TABLE `disciplinasturmac` (
  `cod` int(11) NOT NULL,
  `disciplinas` int(11) DEFAULT NULL,
  `professores` int(11) DEFAULT NULL,
  `extraProf` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `disciplinasturmac`
--

INSERT INTO `disciplinasturmac` (`cod`, `disciplinas`, `professores`, `extraProf`) VALUES
(1, 5, 0, 0),
(2, 6, 0, 0),
(3, 2, 9, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplinasturmad`
--

CREATE TABLE `disciplinasturmad` (
  `cod` int(11) NOT NULL,
  `disciplinas` int(11) DEFAULT NULL,
  `professores` int(11) DEFAULT NULL,
  `extraProf` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `disciplinasturmad`
--

INSERT INTO `disciplinasturmad` (`cod`, `disciplinas`, `professores`, `extraProf`) VALUES
(1, 5, 0, 0),
(2, 2, 8, 0),
(3, 4, 11, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplinasturmae`
--

CREATE TABLE `disciplinasturmae` (
  `cod` int(11) NOT NULL,
  `disciplinas` int(11) DEFAULT NULL,
  `professores` int(11) DEFAULT NULL,
  `extraProf` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `disciplinasturmae`
--

INSERT INTO `disciplinasturmae` (`cod`, `disciplinas`, `professores`, `extraProf`) VALUES
(1, 2, 8, 0);

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

--
-- Extraindo dados da tabela `estudante`
--

INSERT INTO `estudante` (`codAluno`, `nomeAluno`, `senhaAluno`, `datanascAluno`, `RG`, `CPF`, `telefoneAluno`, `bairroAluno`, `ruaAluno`, `cidadeAluno`, `imagemEstudante`, `turma`) VALUES
(1, 'Gustavo Silva Coimbra', '$2y$10$X.yZJADoAuV7vuQsSl0SEeqjhaniiV5Sd.HABOFPcnc6JzLF5loqq', '0000-00-00', 194, 48089258859, 3392, 'Vila Cerqueira', 'Rua Benedito Storani', 'Américo Brasiliense', NULL, 0),
(2, 'Gustavo Silva Coimbra', '$2y$10$rLnqenoJOKG00dBYMwXRxerrcL9IGica/krbBEuaGfbXOBIIlLaaW', '2004-03-16', 194, 48089258859, 4002, 'Vila Cerqueira', 'Rua Benedito Storani', 'Américo Brasiliense', 'Imagens/gustavo.png', 46),
(4, 'João Paulo da Silva Rufino', '$2y$10$fptkJkuJexc.bC6PEy.OxuYfA66QBZJn0EfnMhMiYPdGetK5nl54a', '0000-00-00', 33204, 702533, 4002, 'Santa Terezinha', 'Groove Street', 'Américo Brasiliense', NULL, 46),
(5, 'Vinícius Inhesta Santos', '$2y$10$vZWnI1CFZDVMdfXP.l7Uze3.PWFFgT1la38C.NFzEjhp5ehUYrE.K', '2003-11-13', 34159, 809768, 169455684, 'Biagioni', 'Rua da biqueira', 'Araraquara', NULL, 46),
(6, 'Tiago Costa Santos', '$2y$10$K37e5lM7/9/CIfLk1VXTGOttJs2xZdUsKEoUiXvt7JvAEdps8Mhv2', '2003-06-05', 34159, 468654, 4002, 'Acapucu', 'Groove Street', 'Araraquara', NULL, 47),
(7, 'Cauã Ferras Moreira Pereira', '$2y$10$M2fooEny7qunmecMSXRHaOMB57Y4xupI5gf9ozxOj9sQfXYDwMcGm', '2004-03-13', 112, 60, 99612, 'Botafogo', 'Washington Luiz', 'Votuporanga', NULL, 44),
(8, 'Cauã Ferras Moreira Pereira', '$2y$10$6PI1DtuzY4yBVDPScYadL.XFTxJgLbjGIxvpWCKvUwtHoOkne09YK', '2004-03-13', 200551, 20683, 99612, 'Maracanã', 'caralhada', 'Campo Grande', NULL, 46),
(9, 'Caio Silva Coimbra', '$2y$10$HsRPDT4gcyOJ3TQIYd2UvuyakLN/Kmjf1ioMFiQtZwrphr4P5hbrO', '2009-08-08', 545567, 48089258859, 4002, 'Vale do Sol ', 'Washington Luiz', 'Araraquara', NULL, NULL),
(10, 'Letícia', '$2y$10$RtDdET4NIR2yAKiyrVXqNeUlGuF0TvJsH5i3dUY9zPV/0DrfML8Sa', '2004-07-12', 59456, 702533, 0, 'Jd Califórnia', 'NaoSei', 'Araraquara', NULL, NULL),
(11, 'Danilo Pereira Mathias', '$2y$10$HrIrnEnJxMXHov/QXwblHOnMtfy9JUiC4Kf3oSPBOkfQCJXOi.5oy', '0000-00-00', 194, 123123, 4002, 'Jd São Bento', 'NaoSei', 'Araraquara', 'Array', NULL),
(14, 'Marcus Vinicius Revoredo', '$2y$10$3Pt3ekQPylRNOgfnJNNrj.9jT2UjdnqnWtf1Z7xdJuZi4wO1gVmuO', '2003-06-08', 1111111111, 11111111111, 0, 'Vale do Sol', 'NaoSei', 'Araraquara', 'UsersImage/Array', NULL),
(17, 'Tiago Costa Santos', '$2y$10$4nYZKJGR3djdjlLYGktFWe4LWV0JQbtPpR22yWqDEKZALNsRtlTB2', '0000-00-00', 111111111, 111111111, 11111111, 'NaoSei', 'NaoSei', 'Araraquara', 'UsersImage/61a659f851682', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `horarioturma1`
--

CREATE TABLE `horarioturma1` (
  `cod` int(11) NOT NULL,
  `dias` varchar(30) DEFAULT NULL,
  `horario` varchar(30) DEFAULT NULL,
  `seg` int(11) DEFAULT NULL,
  `ter` int(11) DEFAULT NULL,
  `quar` int(11) DEFAULT NULL,
  `quin` int(11) DEFAULT NULL,
  `sex` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `horarioturma1`
--

INSERT INTO `horarioturma1` (`cod`, `dias`, `horario`, `seg`, `ter`, `quar`, `quin`, `sex`) VALUES
(1, 'seg', '7:20', 3, 4, 6, 5, 2),
(2, 'ter', '8:10', 2, 2, 2, 2, 2),
(3, 'quar', '9:00', 2, 2, 2, 2, 2),
(4, 'quin', '9:30', 0, 0, 0, 0, 0),
(5, 'sex', '10:20', 2, 2, 2, 2, 2),
(6, '', '11:10', 2, 2, 2, 2, 2),
(7, '', '12:00', 2, 2, 2, 2, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `horarioturmab`
--

CREATE TABLE `horarioturmab` (
  `cod` int(11) NOT NULL,
  `dias` varchar(30) DEFAULT NULL,
  `horario` varchar(30) DEFAULT NULL,
  `seg` int(11) DEFAULT NULL,
  `ter` int(11) DEFAULT NULL,
  `quar` int(11) DEFAULT NULL,
  `quin` int(11) DEFAULT NULL,
  `sex` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `horarioturmab`
--

INSERT INTO `horarioturmab` (`cod`, `dias`, `horario`, `seg`, `ter`, `quar`, `quin`, `sex`) VALUES
(1, 'seg', '7:20', 2, 2, 2, 2, 2),
(2, 'ter', '8:10', 2, 2, 2, 2, 2),
(3, 'quar', '9:00', 2, 2, 2, 2, 2),
(4, 'quin', '9:50', 2, 2, 6, 2, 2),
(5, 'sex', '10:40', 3, 5, 2, 2, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `horarioturmac`
--

CREATE TABLE `horarioturmac` (
  `cod` int(11) NOT NULL,
  `dias` varchar(30) DEFAULT NULL,
  `horario` varchar(30) DEFAULT NULL,
  `seg` int(11) DEFAULT NULL,
  `ter` int(11) DEFAULT NULL,
  `quar` int(11) DEFAULT NULL,
  `quin` int(11) DEFAULT NULL,
  `sex` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `horarioturmac`
--

INSERT INTO `horarioturmac` (`cod`, `dias`, `horario`, `seg`, `ter`, `quar`, `quin`, `sex`) VALUES
(1, 'seg', '4:0', 5, 6, 2, 2, 2),
(2, 'ter', '4:15', 2, 2, 2, 2, 2),
(3, 'quar', '4:30', 2, 2, 2, 2, 2),
(4, 'quin', '4:45', 2, 2, 2, 2, 2),
(5, 'sex', '5:00', 2, 2, 2, 2, 2),
(6, '', '5:15', 2, 2, 2, 2, 2),
(7, '', '5:30', 2, 2, 2, 2, 2),
(8, '', '5:45', 2, 2, 2, 2, 2),
(9, '', '6:00', 2, 2, 2, 2, 2),
(10, '', '6:15', 2, 2, 2, 2, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `horarioturmad`
--

CREATE TABLE `horarioturmad` (
  `cod` int(11) NOT NULL,
  `dias` varchar(30) DEFAULT NULL,
  `horario` varchar(30) DEFAULT NULL,
  `seg` int(11) DEFAULT NULL,
  `ter` int(11) DEFAULT NULL,
  `quar` int(11) DEFAULT NULL,
  `quin` int(11) DEFAULT NULL,
  `sex` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `horarioturmad`
--

INSERT INTO `horarioturmad` (`cod`, `dias`, `horario`, `seg`, `ter`, `quar`, `quin`, `sex`) VALUES
(1, 'seg', '7:30', 5, 2, 2, 2, 2),
(2, 'ter', '8:20', 4, 2, 2, 2, 4),
(3, 'quar', '9:10', 2, 2, 2, 2, 2),
(4, 'quin', '10:00', 2, 2, 2, 2, 2),
(5, 'sex', '10:50', 0, 0, 0, 0, 0),
(6, '', '11:40', 2, 2, 2, 2, 2),
(7, '', '12:30', 2, 2, 2, 2, 2),
(8, '', '13:20', 2, 2, 2, 2, 2),
(9, '', '14:10', 2, 2, 2, 2, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `horarioturmae`
--

CREATE TABLE `horarioturmae` (
  `cod` int(11) NOT NULL,
  `dias` varchar(30) DEFAULT NULL,
  `horario` varchar(30) DEFAULT NULL,
  `seg` int(11) DEFAULT NULL,
  `ter` int(11) DEFAULT NULL,
  `quar` int(11) DEFAULT NULL,
  `quin` int(11) DEFAULT NULL,
  `sex` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `horarioturmae`
--

INSERT INTO `horarioturmae` (`cod`, `dias`, `horario`, `seg`, `ter`, `quar`, `quin`, `sex`) VALUES
(1, 'seg', '7:30', 2, 2, 2, 2, 2),
(2, 'ter', '8:20', 2, 2, 2, 2, 2),
(3, 'quar', '9:10', 2, 2, 2, 2, 2),
(4, 'quin', '10:00', 2, 2, 2, 2, 2),
(5, 'sex', '11:00', 0, 0, 0, 0, 0),
(6, '', '11:50', 2, 2, 2, 2, 2),
(7, '', '12:40', 2, 2, 2, 2, 2),
(8, '', '13:30', 2, 2, 2, 2, 2),
(9, '', '14:20', 2, 2, 2, 2, 2);

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

--
-- Extraindo dados da tabela `notas`
--

INSERT INTO `notas` (`cod`, `aluno`, `disciplina`, `n1`, `n2`, `n3`, `n4`, `final`) VALUES
(0, 1, 3, 5, 6, 7, 8, 9);

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

--
-- Extraindo dados da tabela `professor`
--

INSERT INTO `professor` (`codProf`, `nomeProf`, `senhaProf`, `datanascProf`, `celProf`, `telProf`, `bairroProf`, `ruaProf`, `cidadeProf`, `codDisciplina`, `imagemProfessor`, `codTurma`) VALUES
(7, 'Eliane ', '$2y$10$LF5MLXVLs3EBRFbiXdQz9OyJ/wMGd0Yjj/p.0c31xHasbqeopcNUq', '0000-00-00', 46, 546, '54', '5', '546', 1, NULL, NULL),
(8, 'Cris', '$2y$10$UgZyXsx/ecm/sqZWSDx.dOntQ/u8cfisWmsdEYykVrEMqT3TMHhcS', '0000-00-00', 65, 465, '546', '65', '46', 2, NULL, NULL),
(9, 'Mario hanada', '$2y$10$q6oSAz2oKx6bxWGC8x/LCeXPnBppgO7hUY8IW0gLylzCviO1shdJi', '0000-00-00', 654, 654, '65', '654', '654', 2, NULL, NULL),
(10, 'Leia Barreto', '$2y$10$xrOzX9l2usbkwwsGD2En4.IVkks.BYWbJDvodimL/ZJRPRJZbvDxi', '0000-00-00', 654, 654, '65654', '65', '64', 3, NULL, NULL),
(11, 'Silvia helena ', '$2y$10$pmNRD9ZzCuP22HnkNDkN4Oa.a4Wgic6S137U2X/gHavRXLrykUj8K', '0000-00-00', 654, 654, '56', '321', '654', 4, NULL, NULL),
(12, 'Laís Sachs', '$2y$10$clKp9lNHzqDhdlhBb05C7OXppXRKkqAkWIj4e8Og2xf.C/vvoRRPm', '0000-00-00', 999999999, 0, 'Hortencia', 'NaoSei', 'Araraquara', 4, NULL, NULL);

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
-- Extraindo dados da tabela `turmas`
--

INSERT INTO `turmas` (`cod`, `codTurma`, `nomeTurma`, `tempPorAula`, `intervalo`) VALUES
(0, '0', 'Sem Turma', 0, 0),
(44, 'B', 'Desenvolvimento de sistemas', 0, 0),
(45, 'C', '005', 0, 0),
(46, 'D', 'Informática para internet', 0, 50),
(47, 'E', 'ADM', 0, 60);

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
-- Índices para tabela `disciplinasturma1`
--
ALTER TABLE `disciplinasturma1`
  ADD PRIMARY KEY (`cod`);

--
-- Índices para tabela `disciplinasturmab`
--
ALTER TABLE `disciplinasturmab`
  ADD PRIMARY KEY (`cod`);

--
-- Índices para tabela `disciplinasturmac`
--
ALTER TABLE `disciplinasturmac`
  ADD PRIMARY KEY (`cod`);

--
-- Índices para tabela `disciplinasturmad`
--
ALTER TABLE `disciplinasturmad`
  ADD PRIMARY KEY (`cod`);

--
-- Índices para tabela `disciplinasturmae`
--
ALTER TABLE `disciplinasturmae`
  ADD PRIMARY KEY (`cod`);

--
-- Índices para tabela `estudante`
--
ALTER TABLE `estudante`
  ADD PRIMARY KEY (`codAluno`),
  ADD KEY `turma` (`turma`);

--
-- Índices para tabela `horarioturma1`
--
ALTER TABLE `horarioturma1`
  ADD PRIMARY KEY (`cod`);

--
-- Índices para tabela `horarioturmab`
--
ALTER TABLE `horarioturmab`
  ADD PRIMARY KEY (`cod`);

--
-- Índices para tabela `horarioturmac`
--
ALTER TABLE `horarioturmac`
  ADD PRIMARY KEY (`cod`);

--
-- Índices para tabela `horarioturmad`
--
ALTER TABLE `horarioturmad`
  ADD PRIMARY KEY (`cod`);

--
-- Índices para tabela `horarioturmae`
--
ALTER TABLE `horarioturmae`
  ADD PRIMARY KEY (`cod`);

--
-- Índices para tabela `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`cod`);

--
-- Índices para tabela `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`codProf`),
  ADD KEY `codDisciplina` (`codDisciplina`);

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
  ADD PRIMARY KEY (`cod`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `acervo`
--
ALTER TABLE `acervo`
  MODIFY `codArquivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `administrador`
--
ALTER TABLE `administrador`
  MODIFY `codAdm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `disciplina`
--
ALTER TABLE `disciplina`
  MODIFY `codDisciplina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `disciplinasturma1`
--
ALTER TABLE `disciplinasturma1`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `disciplinasturmab`
--
ALTER TABLE `disciplinasturmab`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `disciplinasturmac`
--
ALTER TABLE `disciplinasturmac`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `disciplinasturmad`
--
ALTER TABLE `disciplinasturmad`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `disciplinasturmae`
--
ALTER TABLE `disciplinasturmae`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `estudante`
--
ALTER TABLE `estudante`
  MODIFY `codAluno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `horarioturma1`
--
ALTER TABLE `horarioturma1`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `horarioturmab`
--
ALTER TABLE `horarioturmab`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `horarioturmac`
--
ALTER TABLE `horarioturmac`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `horarioturmad`
--
ALTER TABLE `horarioturmad`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `horarioturmae`
--
ALTER TABLE `horarioturmae`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `professor`
--
ALTER TABLE `professor`
  MODIFY `codProf` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `responsaveis`
--
ALTER TABLE `responsaveis`
  MODIFY `codResponsavel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `turmas`
--
ALTER TABLE `turmas`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `estudante`
--
ALTER TABLE `estudante`
  ADD CONSTRAINT `estudante_ibfk_1` FOREIGN KEY (`turma`) REFERENCES `turmas` (`cod`);

--
-- Limitadores para a tabela `professor`
--
ALTER TABLE `professor`
  ADD CONSTRAINT `professor_ibfk_1` FOREIGN KEY (`codDisciplina`) REFERENCES `disciplina` (`codDisciplina`),
  ADD CONSTRAINT `professor_ibfk_2` FOREIGN KEY (`codDisciplina`) REFERENCES `disciplina` (`codDisciplina`);

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
