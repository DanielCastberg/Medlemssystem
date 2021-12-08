-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 08, 2021 at 03:52 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `klubbdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `aktiviteter`
--

CREATE TABLE `aktiviteter` (
  `id` int(10) NOT NULL,
  `navn` varchar(50) NOT NULL,
  `ansvarlig_id` int(11) NOT NULL,
  `dato` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `aktiviteter`
--

INSERT INTO `aktiviteter` (`id`, `navn`, `ansvarlig_id`, `dato`) VALUES
(1, 'Biljardturnering', 2, '2021-12-12'),
(2, 'Dartturnering', 1, '2021-11-12'),
(3, 'Fotballkurs', 1, '2021-05-05');

-- --------------------------------------------------------

--
-- Table structure for table `aktivitetspåmelding`
--

CREATE TABLE `aktivitetspåmelding` (
  `mid` int(11) NOT NULL,
  `aid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `aktivitetspåmelding`
--

INSERT INTO `aktivitetspåmelding` (`mid`, `aid`) VALUES
(1, 1),
(7, 2),
(7, 3),
(8, 2),
(9, 1),
(10, 2),
(11, 3);

-- --------------------------------------------------------

--
-- Table structure for table `interesser`
--

CREATE TABLE `interesser` (
  `id` int(11) NOT NULL,
  `navn` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `interesser`
--

INSERT INTO `interesser` (`id`, `navn`) VALUES
(1, 'Fotball'),
(2, 'Dart'),
(3, 'Biljard'),
(4, 'Dans');

-- --------------------------------------------------------

--
-- Table structure for table `interesseregister`
--

CREATE TABLE `interesseregister` (
  `mid` int(11) NOT NULL,
  `iid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `interesseregister`
--

INSERT INTO `interesseregister` (`mid`, `iid`) VALUES
(1, 1),
(2, 2),
(1, 3),
(7, 1),
(7, 2),
(7, 4),
(8, 2),
(2, 4),
(8, 4),
(3, 1),
(3, 2),
(4, 1),
(4, 4),
(5, 3),
(5, 2),
(6, 2),
(6, 1),
(2, 1),
(9, 3),
(9, 4),
(10, 3),
(10, 4),
(11, 3),
(11, 4);

-- --------------------------------------------------------

--
-- Table structure for table `medlemmer`
--

CREATE TABLE `medlemmer` (
  `id` int(11) NOT NULL,
  `fornavn` varchar(120) NOT NULL,
  `etternavn` varchar(120) NOT NULL,
  `adresse` varchar(120) NOT NULL,
  `postnummer` int(11) NOT NULL,
  `tlf` int(11) NOT NULL,
  `mail` varchar(120) NOT NULL,
  `fodselsdato` date NOT NULL,
  `kjonn` tinyint(1) NOT NULL,
  `medlemSidenDato` date NOT NULL,
  `kontigentstatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medlemmer`
--

INSERT INTO `medlemmer` (`id`, `fornavn`, `etternavn`, `adresse`, `postnummer`, `tlf`, `mail`, `fodselsdato`, `kjonn`, `medlemSidenDato`, `kontigentstatus`) VALUES
(1, 'Daniel', 'Castberg', 'Nordli 10', 4444, 12345678, 'post@mail.com', '1998-03-13', 1, '2020-01-01', 1),
(2, 'Steffen', 'Abrahamsen', 'Strandgaten 1', 1111, 23456789, 'post1@mail.com', '1994-01-01', 1, '2020-01-01', 1),
(3, 'Oda', 'Strand', 'Heia 123', 2222, 12345432, 'post2@mail.com', '2000-01-01', 0, '2020-02-02', 0),
(4, 'Arne', 'Strand', 'Svingen 1', 2222, 12349876, 'post3@mail.com', '1999-01-01', 1, '2005-01-01', 1),
(5, 'Hanne', 'Hansen', 'Skog 1', 2222, 23453245, 'post4@mail.com', '1985-10-09', 0, '2021-10-12', 0),
(6, 'Arne', 'Arnesen', 'Skog 4', 1111, 23457245, 'post5@mail.com', '1985-10-15', 1, '2021-10-12', 1),
(7, 'Anne', 'Holt', 'Skog 6', 1111, 99999999, 'post6@mail.com', '1984-10-17', 0, '2021-10-21', 1),
(8, 'Terje', 'Haug', 'Gata 98', 3333, 45674567, 'post7@mail.com', '1997-09-09', 1, '2021-10-27', 0),
(9, 'Knut', 'Sæther', 'SIA 123', 2222, 23453456, 'post8@mail.com', '2000-10-07', 1, '2021-10-21', 1),
(10, 'Nicolai', 'Bjørntvedt', 'Sentrum123', 1111, 12349999, 'post9@mail.com', '2000-01-01', 1, '2021-10-20', 1),
(11, 'Ida', 'Olsen', 'Stranda 123', 4444, 56785678, 'post10@mail.com', '2021-10-06', 0, '2021-10-07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `passordliste`
--

CREATE TABLE `passordliste` (
  `mid` int(11) NOT NULL,
  `passord` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `passordliste`
--

INSERT INTO `passordliste` (`mid`, `passord`) VALUES
(1, '$2y$10$MMxa3O8B9xzz.2CI5Kl9eOrF6HN/xn8lg0oqnX0u1JvuOQGkcwQma'),
(2, '$2y$10$zo1nm0B5ymqsWc3VOD7DNOiCDP1XU401rplOZ12HTrjc0bj7VNURW'),
(3, '$2y$10$q7cAya1qRI/x9CDZ5MuSOOmkNK.nJmyum0DJJWI4edVm3ATkw2.eq'),
(4, '$2y$10$FybMm92ot97JBmdwXkrgfeB4/ePSWtjpIkbwXdDBLI2aXFfbHLONG'),
(5, '$2y$10$mt2ZJKWW2.WrV0T9vS5LJeTLvAqj5DAZdHGGJfNmzUIP00INwrv7O'),
(6, '$2y$10$nqbfSb.J0sYDhsCrrdTzmeP/Az0/kclSeIzsTAIBicjmskPYUOwGm'),
(7, '$2y$10$78FQWE.Rtllq1kquzSIpfutnYe.A9j2QfPF0JlqfjWi7NxzvFv5uC'),
(8, '$2y$10$mE4M6LdONEELt7qUrYym/u2y2yT8SRwtZewDKu68ZK6UM0QDyJfii'),
(9, '$2y$10$CUhedQPbo7/08kywvJnirOYWcGGGjHKSSNfzVyGYBmVpXzFMsiE26'),
(10, '$2y$10$.Rg9D/Xi5tBb5.X1Sl1jMumd/ntFGtD.XLiBiey4arIHIT.9Y2DFq');

-- --------------------------------------------------------

--
-- Table structure for table `postnummer`
--

CREATE TABLE `postnummer` (
  `nr` int(11) NOT NULL,
  `sted` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `postnummer`
--

INSERT INTO `postnummer` (`nr`, `sted`) VALUES
(1111, 'Kristiansand'),
(2222, 'Kristiansand'),
(3333, 'Søgne'),
(4444, 'Vennesla');

-- --------------------------------------------------------

--
-- Table structure for table `roller`
--

CREATE TABLE `roller` (
  `id` int(11) NOT NULL,
  `navn` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roller`
--

INSERT INTO `roller` (`id`, `navn`) VALUES
(1, 'admin'),
(2, 'leder'),
(3, 'medlem');

-- --------------------------------------------------------

--
-- Table structure for table `rolleregister`
--

CREATE TABLE `rolleregister` (
  `mid` int(11) NOT NULL,
  `rid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rolleregister`
--

INSERT INTO `rolleregister` (`mid`, `rid`) VALUES
(1, 1),
(1, 2),
(2, 2),
(3, 3),
(4, 3),
(5, 3),
(2, 1),
(6, 3),
(7, 1),
(7, 2),
(8, 3),
(9, 2),
(9, 3),
(10, 3),
(11, 1),
(2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aktiviteter`
--
ALTER TABLE `aktiviteter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aktivitetspåmelding`
--
ALTER TABLE `aktivitetspåmelding`
  ADD KEY `mid` (`mid`),
  ADD KEY `aid` (`aid`);

--
-- Indexes for table `interesser`
--
ALTER TABLE `interesser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interesseregister`
--
ALTER TABLE `interesseregister`
  ADD KEY `interesseregister_ibfk_1` (`mid`),
  ADD KEY `iid` (`iid`);

--
-- Indexes for table `medlemmer`
--
ALTER TABLE `medlemmer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `postnummer` (`postnummer`);

--
-- Indexes for table `passordliste`
--
ALTER TABLE `passordliste`
  ADD KEY `mid` (`mid`);

--
-- Indexes for table `postnummer`
--
ALTER TABLE `postnummer`
  ADD PRIMARY KEY (`nr`);

--
-- Indexes for table `roller`
--
ALTER TABLE `roller`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `rolleregister`
--
ALTER TABLE `rolleregister`
  ADD KEY `mid` (`mid`),
  ADD KEY `rid` (`rid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aktiviteter`
--
ALTER TABLE `aktiviteter`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `medlemmer`
--
ALTER TABLE `medlemmer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aktivitetspåmelding`
--
ALTER TABLE `aktivitetspåmelding`
  ADD CONSTRAINT `aktivitetspåmelding_ibfk_2` FOREIGN KEY (`mid`) REFERENCES `medlemmer` (`id`),
  ADD CONSTRAINT `aktivitetspåmelding_ibfk_3` FOREIGN KEY (`aid`) REFERENCES `aktiviteter` (`id`);

--
-- Constraints for table `interesseregister`
--
ALTER TABLE `interesseregister`
  ADD CONSTRAINT `interesseregister_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `medlemmer` (`id`),
  ADD CONSTRAINT `interesseregister_ibfk_2` FOREIGN KEY (`iid`) REFERENCES `interesser` (`id`);

--
-- Constraints for table `medlemmer`
--
ALTER TABLE `medlemmer`
  ADD CONSTRAINT `medlemmer_ibfk_1` FOREIGN KEY (`postnummer`) REFERENCES `postnummer` (`nr`);

--
-- Constraints for table `passordliste`
--
ALTER TABLE `passordliste`
  ADD CONSTRAINT `passordliste_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `medlemmer` (`id`);

--
-- Constraints for table `rolleregister`
--
ALTER TABLE `rolleregister`
  ADD CONSTRAINT `rolleregister_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `medlemmer` (`id`),
  ADD CONSTRAINT `rolleregister_ibfk_2` FOREIGN KEY (`rid`) REFERENCES `roller` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
