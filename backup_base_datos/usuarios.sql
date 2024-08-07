-- Configuración inicial (No es necesario en SQL Server)
-- SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
-- SET time_zone = "+00:00";

-- No son necesarias las configuraciones de MySQL en SQL Server
-- /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
-- /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
-- /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
-- /*!40101 SET NAMES utf8 */;

-- Levanto base de datos de backup
USE master;
GO
CREATE DATABASE junta
ON (FILENAME= '/var/opt/mssql/data/junta.mdf'),(FILENAME= '/var/opt/mssql/data/junta.ldf') FOR ATTACH;
GO


-- Usar la base de datos
USE junta;
GO

-- Crear la tabla `usuarios`
IF OBJECT_ID('usuarios', 'U') IS NULL
BEGIN
CREATE TABLE usuarios (
                          id INT NOT NULL IDENTITY(1,1) PRIMARY KEY,
                          nombres NVARCHAR(150) NULL,
                          apellidos NVARCHAR(150) NULL,
                          email NVARCHAR(150) NULL,
                          password NVARCHAR(120) NULL,
                          telefono NVARCHAR(15) NULL,
                          olvido_pass_iden NVARCHAR(32) NULL,
                          creado DATETIME NULL,
                          modificado DATETIME NULL,
                          estado NVARCHAR(1) DEFAULT '1'
);
END
GO
