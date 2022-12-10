-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09-Dez-2022 às 03:20
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `cdevent`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `eventos`
--

CREATE TABLE `eventos` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` varchar(300) NOT NULL,
  `dia` varchar(11) NOT NULL,
  `horario` varchar(11) NOT NULL,
  `capa` varchar(300) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `municipio` varchar(50) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `limiteP` int(11) NOT NULL,
  `categoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `eventos`
--

INSERT INTO `eventos` (`id`, `nome`, `descricao`, `dia`, `horario`, `capa`, `endereco`, `municipio`, `uf`, `limiteP`, `categoria`) VALUES
(1, 'Workshop LideranÃ§a Corportamental', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Illum vel culpa dolor reprehenderit consectetur hic deserunt ipsum, modi ratione voluptate cum neque impedit! Quis ab inventore perferendis porro nam perspiciatis.', '2022-12-09', '09:30', 'https://diariodonordeste.verdesmares.com.br/image/contentid/policy:1.3280204:1663693566/Escritorio.jpg?f=16x9&h=720&q=0.8&w=1280&$p$f$h$q$w=81acb55', 'Hotel Jangada, 2083', 'caraguatatuba', 'SP', 20, 'workshops'),
(2, 'Undertake Experience', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Illum vel culpa dolor reprehenderit consectetur hic deserunt ipsum, modi ratione voluptate cum neque impedit! Quis ab inventore perferendis porro nam perspiciatis.', '2023-01-28', '09:00', 'https://www.uts.edu.au/sites/default/files/styles/wysiwyg_generic_large_x1/public/2018-11/fass-prac-ed_0.png?itok=eNtrmSCG', 'EspaÃ§o Ocean', 'caraguatatuba', 'SP', 15, 'festas'),
(3, 'ConexÃ£o 12 em 1', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Illum vel culpa dolor reprehenderit consectetur hic deserunt ipsum, modi ratione voluptate cum neque impedit! Quis ab inventore perferendis porro nam perspiciatis.', '2023-02-04', '10:00', 'https://www.fulltimenetworking.app.br/conexao12em1/images/conexao12em1.png', 'EspaÃ§o Ocean, 986', 'caraguatatuba', 'SP', 100, 'palestras'),
(4, 'Undertake DAY', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Illum vel culpa dolor reprehenderit consectetur hic deserunt ipsum, modi ratione voluptate cum neque impedit! Quis ab inventore perferendis porro nam perspiciatis.', '2022-12-17', '10:05', 'https://s3.amazonaws.com/wordpress-cdn.eadbox.com/2018/03/15172319/1303-e-business.png', 'Empiricus, 873', 'caraguatatuba', 'SP', 20, 'palestras'),
(5, 'Halowindowns', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Illum vel culpa dolor reprehenderit consectetur hic deserunt ipsum, modi ratione voluptate cum neque impedit! Quis ab inventore perferendis porro nam perspiciatis.', '2023-10-14', '20:00', 'http://c.files.bbci.co.uk/11DE7/production/_104019137_gettyimages-844232562.jpg', 'Event Master, 980', 'Blumenau', 'SC', 30, 'halloween'),
(6, 'Pokas', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Illum vel culpa dolor reprehenderit consectetur hic deserunt ipsum, modi ratione voluptate cum neque impedit! Quis ab inventore perferendis porro nam perspiciatis.', '2022-12-10', '17:00', 'https://jumpercursos.com.br/wp-content/uploads/2020/07/xpokas.jpg.pagespeed.ic_.RD2ExYvuwi.jpg', 'Teatro Municipal, 765', 'SÃ£o Paulo', 'SP', 60, 'standUP'),
(7, 'Oscara', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Illum vel culpa dolor reprehenderit consectetur hic deserunt ipsum, modi ratione voluptate cum neque impedit! Quis ab inventore perferendis porro nam perspiciatis.', '2023-01-15', '19:30', 'https://revistaanamaria.com.br/media/_versions/2022-03/tapa-na-cara-no-oscar_widemd.jpg', 'Girus Disco Show, 765', 'Extrema', 'MG', 20, 'standUP'),
(8, 'Proparoxitona', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Illum vel culpa dolor reprehenderit consectetur hic deserunt ipsum, modi ratione voluptate cum neque impedit! Quis ab inventore perferendis porro nam perspiciatis.', '2023-01-07', '18:30', 'https://i.ytimg.com/vi/IRirqw082XI/maxresdefault.jpg', 'Teatro Mario Covas, 83', 'caraguatatuba', 'SP', 150, 'standUP'),
(9, 'Revoada do TITI', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Illum vel culpa dolor reprehenderit consectetur hic deserunt ipsum, modi ratione voluptate cum neque impedit! Quis ab inventore perferendis porro nam perspiciatis.', '2022-12-17', '22:00', 'http://f.i.uol.com.br/fotografia/2017/04/07/680045-970x600-1.jpeg', 'Casa love', 'Praia Grande', 'SP', 25, 'festas');

-- --------------------------------------------------------

--
-- Estrutura da tabela `foto`
--

CREATE TABLE `foto` (
  `id` int(11) NOT NULL,
  `capa` varchar(200) NOT NULL,
  `titulo` varchar(20) NOT NULL,
  `descricao` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `foto`
--

INSERT INTO `foto` (`id`, `capa`, `titulo`, `descricao`) VALUES
(3, 'https://wallpaperaccess.com/full/4205651.jpg', 'Hallowcasa', 'Lorem ipsum dolor sit amet consectetur adipisicing'),
(4, 'https://s1.1zoom.me/big7/514/Birds_Mountains_Waterfalls_Trees_518188_1920x720.jpg', 'VIva a vida', 'Lorem ipsum dolor sit amet consectetur adipisicing');

-- --------------------------------------------------------

--
-- Estrutura da tabela `participantes`
--

CREATE TABLE `participantes` (
  `id` int(11) NOT NULL,
  `cpf` int(11) NOT NULL,
  `nomeP` varchar(100) NOT NULL,
  `sexo` varchar(1) NOT NULL,
  `descricaoP` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `participantes`
--

INSERT INTO `participantes` (`id`, `cpf`, `nomeP`, `sexo`, `descricaoP`) VALUES
(1, 987654321, 'CÃ¡ssio', 'm', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Illum vel culpa dolor reprehenderit consectetur hic deserunt ipsum, modi ratione voluptate cum neque impedit! Quis ab inventore perferendis porro nam perspiciatis.'),
(2, 2147483647, 'JhosÃ©', 'm', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Illum vel culpa dolor reprehenderit consectetur hic deserunt ipsum, modi ratione voluptate cum neque impedit! Quis ab inventore perferendis porro nam perspiciatis.'),
(3, 568978568, 'Lucas', 'm', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Illum vel culpa dolor reprehenderit consectetur hic deserunt ipsum, modi ratione voluptate cum neque impedit! Quis ab inventore perferendis porro nam perspiciatis.'),
(4, 2147483647, 'JhosÃ©', 'm', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Illum vel culpa dolor reprehenderit consectetur hic deserunt ipsum, modi ratione voluptate cum neque impedit! Quis ab inventore perferendis porro nam perspiciatis.'),
(5, 2147483647, 'Fred', 'm', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Illum vel culpa dolor reprehenderit consectetur hic deserunt ipsum, modi ratione voluptate cum neque impedit! Quis ab inventore perferendis porro nam perspiciatis.'),
(6, 2147483647, 'Tiago Ventura', 'm', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Illum vel culpa dolor reprehenderit consectetur hic deserunt ipsum, modi ratione voluptate cum neque impedit! Quis ab inventore perferendis porro nam perspiciatis.'),
(7, 587964852, 'William maite', 'm', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Illum vel culpa dolor reprehenderit consectetur hic deserunt ipsum, modi ratione voluptate cum neque impedit! Quis ab inventore perferendis porro nam perspiciatis.'),
(8, 945386745, 'Whindersson Nuna', 'm', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Illum vel culpa dolor reprehenderit consectetur hic deserunt ipsum, modi ratione voluptate cum neque impedit! Quis ab inventore perferendis porro nam perspiciatis.'),
(9, 2147483647, 'Giovanna', 'f', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Illum vel culpa dolor reprehenderit consectetur hic deserunt ipsum, modi ratione voluptate cum neque impedit! Quis ab inventore perferendis porro nam perspiciatis.');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `cpf` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dataNascimento` date NOT NULL,
  `nome` varchar(220) CHARACTER SET utf8 NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 NOT NULL,
  `sexo` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usuario` varchar(220) CHARACTER SET utf8 NOT NULL,
  `senha_usuario` varchar(250) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `cpf`, `dataNascimento`, `nome`, `email`, `sexo`, `usuario`, `senha_usuario`) VALUES
(8, '490.401.288-71', '2003-07-18', 'Vitor', 'vitormariotto03@gmail.com', 'M', 'vitor', '$2y$10$UP1ERbKtsQl7MA2mWIz22eNTn4Igdlsd4K5y0DvicH97JlLsKlkmS');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `participantes`
--
ALTER TABLE `participantes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `foto`
--
ALTER TABLE `foto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `participantes`
--
ALTER TABLE `participantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
