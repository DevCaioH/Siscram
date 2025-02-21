-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql101.infinityfree.com
-- Tempo de geração: 02/07/2023 às 19:18
-- Versão do servidor: 10.4.17-MariaDB
-- Versão do PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `epiz_34343037_siscram`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `atestado`
--

CREATE TABLE `atestado` (
  `Id_Atestado` int(20) NOT NULL,
  `Endereco_consultorio` int(20) NOT NULL,
  `data_Consulta` varchar(40) NOT NULL,
  `CID` varchar(50) NOT NULL,
  `desc_atestado` varchar(500) NOT NULL,
  `motivo` varchar(180) NOT NULL,
  `nome_Paciente` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `atestado`
--

INSERT INTO `atestado` (`Id_Atestado`, `Endereco_consultorio`, `data_Consulta`, `CID`, `desc_atestado`, `motivo`, `nome_Paciente`) VALUES
(2, 1, '26/06/2023', 'H522', '. O mesmo deverÃ¡ permanecer de repouso durante o perÃ­odo de 2 Dia(s)', 'para realizaÃ§Ã£o de uma consulta mÃ©dica', 'Caio Henrique Pereira Antonio'),
(3, 2, '29/06/2023', 'M54', '. O mesmo deverÃ¡ permanecer de repouso durante o perÃ­odo de 2 Dia(s)', 'para realizaÃ§Ã£o de um exame', 'JOSE ROBERTO RIBEIRO'),
(4, 2, '29/06/2023', 'M545', '. O mesmo deverÃ¡ permanecer de repouso durante o perÃ­odo de 2 Dia(s)', 'para realizaÃ§Ã£o de um exame', 'JOSE ROBERTO RIBEIRO'),
(5, 2, '29/06/2023', 'M545', '. O mesmo deverÃ¡ permanecer de repouso durante o perÃ­odo de 10 Dia(s)', 'para realizaÃ§Ã£o de um exame', 'JOSE ROBERTO RIBEIRO');

-- --------------------------------------------------------

--
-- Estrutura para tabela `consultorios`
--

CREATE TABLE `consultorios` (
  `IDConsultorio` int(50) NOT NULL,
  `Nome_Consultorio` varchar(255) NOT NULL,
  `Endereco_Consultorio` varchar(255) NOT NULL,
  `Cidade` varchar(255) NOT NULL,
  `CEP` varchar(50) NOT NULL,
  `UF` varchar(50) NOT NULL,
  `Numero` int(11) NOT NULL,
  `Telefone` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `consultorios`
--

INSERT INTO `consultorios` (`IDConsultorio`, `Nome_Consultorio`, `Endereco_Consultorio`, `Cidade`, `CEP`, `UF`, `Numero`, `Telefone`) VALUES
(1, 'Fisioremanso', 'Rua Antônio Nelson Barbosa - Jardim do Bosque', 'Hortolândia', '13186-231', 'SP', 86, '(19)3819-8441'),
(2, 'Clinmed', 'Av. São Francisco de Assis - Vila Real', 'Hortolândia', '13183-090', 'SP', 289, '(19)3897-2011'),
(3, 'MedPlex Campinas', 'Av. Barão de Itapura - Taquaral', 'Campinas', '13020-430', 'SP', 610, '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `login`
--

CREATE TABLE `login` (
  `Id_User` int(10) NOT NULL,
  `User_name` varchar(40) NOT NULL,
  `User_pass` varchar(20) NOT NULL,
  `Nome_Usuario` varchar(50) NOT NULL,
  `IMG` varchar(500) NOT NULL,
  `Perfil_user_fk` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `login`
--

INSERT INTO `login` (`Id_User`, `User_name`, `User_pass`, `Nome_Usuario`, `IMG`, `Perfil_user_fk`) VALUES
(1, 'cacaio', '1234', 'Caio Henrique Pereira Antonio', 'img/isaac.png', 1),
(2, 'dr.ribeiro', 'joseribeiro', 'Dr. JosÃ© Roberto Ribeiro', 'img/', 2),
(4, 'ariane', '12345', 'Ariane', 'img/matriz-de-bordado-medicina-frete-gratis.jpg', 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `perfil`
--

CREATE TABLE `perfil` (
  `IdPerfil` int(10) NOT NULL,
  `Descricao_Perfil` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `perfil`
--

INSERT INTO `perfil` (`IdPerfil`, `Descricao_Perfil`) VALUES
(1, 'Super Administrador'),
(2, 'Médico'),
(3, 'Secretária');

-- --------------------------------------------------------

--
-- Estrutura para tabela `receita`
--

CREATE TABLE `receita` (
  `Id_Receita` int(10) NOT NULL,
  `Nome_paciente` varchar(100) NOT NULL,
  `Endereco` int(25) NOT NULL,
  `Data_atual` varchar(20) NOT NULL,
  `CID` varchar(40) NOT NULL,
  `Desc_Receita` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `receita`
--

INSERT INTO `receita` (`Id_Receita`, `Nome_paciente`, `Endereco`, `Data_atual`, `CID`, `Desc_Receita`) VALUES
(1, 'Caio Henrique Pereira Antonio', 2, '26/06/2023', 'H522', 'TESTE!!\r\n\r\nETSTE\r\n\r\nTESTE'),
(2, 'JOSE ROBERTO RIBEIRO', 2, '29/06/2023', 'M54', 'TESTE DE RECEITA MÃ‰DICA');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `atestado`
--
ALTER TABLE `atestado`
  ADD PRIMARY KEY (`Id_Atestado`),
  ADD KEY `fk_consultorio_atestado` (`Endereco_consultorio`);

--
-- Índices de tabela `consultorios`
--
ALTER TABLE `consultorios`
  ADD PRIMARY KEY (`IDConsultorio`);

--
-- Índices de tabela `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`Id_User`),
  ADD KEY `fk_perfil_usuario` (`Perfil_user_fk`);

--
-- Índices de tabela `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`IdPerfil`);

--
-- Índices de tabela `receita`
--
ALTER TABLE `receita`
  ADD PRIMARY KEY (`Id_Receita`),
  ADD KEY `fk_receita_consultorio` (`Endereco`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `atestado`
--
ALTER TABLE `atestado`
  MODIFY `Id_Atestado` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `consultorios`
--
ALTER TABLE `consultorios`
  MODIFY `IDConsultorio` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `login`
--
ALTER TABLE `login`
  MODIFY `Id_User` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `perfil`
--
ALTER TABLE `perfil`
  MODIFY `IdPerfil` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `receita`
--
ALTER TABLE `receita`
  MODIFY `Id_Receita` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `atestado`
--
ALTER TABLE `atestado`
  ADD CONSTRAINT `fk_consultorio_atestado` FOREIGN KEY (`Endereco_consultorio`) REFERENCES `consultorios` (`IDConsultorio`);

--
-- Restrições para tabelas `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `fk_perfil_usuario` FOREIGN KEY (`Perfil_user_fk`) REFERENCES `perfil` (`IdPerfil`);

--
-- Restrições para tabelas `receita`
--
ALTER TABLE `receita`
  ADD CONSTRAINT `fk_receita_consultorio` FOREIGN KEY (`Endereco`) REFERENCES `consultorios` (`IDConsultorio`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
