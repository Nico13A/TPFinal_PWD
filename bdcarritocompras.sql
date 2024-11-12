SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- Base de datos: `bdcarritocompras`

-- Tabla `usuario`
CREATE TABLE `usuario` (
  `idusuario` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `usnombre` VARCHAR(50) NOT NULL,
  `uspass` VARCHAR(255) NOT NULL,
  `usmail` VARCHAR(50) NOT NULL,
  `usdeshabilitado` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla `compra`
CREATE TABLE `compra` (
  `idcompra` INT(11) NOT NULL AUTO_INCREMENT,
  `cofecha` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `idusuario` BIGINT(20) NOT NULL,
  PRIMARY KEY (`idcompra`),
  KEY `fkcompra_1` (`idusuario`),
  CONSTRAINT `fkcompra_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla `compraestadotipo`
CREATE TABLE `compraestadotipo` (
  `idcompraestadotipo` INT(11) NOT NULL AUTO_INCREMENT,
  `cetdescripcion` VARCHAR(50) NOT NULL,
  `cetdetalle` VARCHAR(256) NOT NULL,
  PRIMARY KEY (`idcompraestadotipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla `compraestado`
CREATE TABLE `compraestado` (
  `idcompraestado` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `idcompra` INT(11) NOT NULL,
  `idcompraestadotipo` INT(11) NOT NULL,
  `cefechaini` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cefechafin` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`idcompraestado`),
  KEY `fkcompraestado_1` (`idcompra`),
  KEY `fkcompraestado_2` (`idcompraestadotipo`),
  CONSTRAINT `fkcompraestado_1` FOREIGN KEY (`idcompra`) REFERENCES `compra` (`idcompra`) ON UPDATE CASCADE,
  CONSTRAINT `fkcompraestado_2` FOREIGN KEY (`idcompraestadotipo`) REFERENCES `compraestadotipo` (`idcompraestadotipo`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla `producto`
CREATE TABLE `producto` (
  `idproducto` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `pronombre` VARCHAR(255) NOT NULL,
  `prodetalle` VARCHAR(512) NOT NULL,
  `procantstock` INT(11) NOT NULL,
  `proprecio` INT(11) NOT NULL,
  `urlimagen` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`idproducto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla `compraitem`
CREATE TABLE `compraitem` (
  `idcompraitem` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `idproducto` BIGINT(20) NOT NULL,
  `idcompra` INT(11) NOT NULL,
  `cicantidad` INT(11) NOT NULL,
  PRIMARY KEY (`idcompraitem`),
  KEY `fkcompraitem_1` (`idcompra`),
  KEY `fkcompraitem_2` (`idproducto`),
  CONSTRAINT `fkcompraitem_1` FOREIGN KEY (`idcompra`) REFERENCES `compra` (`idcompra`) ON UPDATE CASCADE,
  CONSTRAINT `fkcompraitem_2` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla `menu`
CREATE TABLE `menu` (
  `idmenu` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `menombre` VARCHAR(50) NOT NULL COMMENT 'Nombre del item del menu',
  `medescripcion` VARCHAR(124) NOT NULL COMMENT 'Descripcion mas detallada del item del menu',
  `idpadre` BIGINT(20) DEFAULT NULL COMMENT 'Referencia al id del menu que es subitem',
  `medeshabilitado` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que el menu fue deshabilitado por ultima vez',
  PRIMARY KEY (`idmenu`),
  KEY `fkmenu_1` (`idpadre`),
  CONSTRAINT `fkmenu_1` FOREIGN KEY (`idpadre`) REFERENCES `menu` (`idmenu`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla `rol`
CREATE TABLE `rol` (
  `idrol` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `rodescripcion` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`idrol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla `menurol`
CREATE TABLE `menurol` (
  `idmenu` BIGINT(20) NOT NULL,
  `idrol` BIGINT(20) NOT NULL,
  PRIMARY KEY (`idmenu`, `idrol`),
  KEY `fkmenurol_2` (`idrol`),
  CONSTRAINT `fkmenurol_1` FOREIGN KEY (`idmenu`) REFERENCES `menu` (`idmenu`) ON UPDATE CASCADE,
  CONSTRAINT `fkmenurol_2` FOREIGN KEY (`idrol`) REFERENCES `rol` (`idrol`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla `usuariorol`
CREATE TABLE `usuariorol` (
  `idusuario` BIGINT(20) NOT NULL,
  `idrol` BIGINT(20) NOT NULL,
  PRIMARY KEY (`idusuario`, `idrol`),
  KEY `idusuario` (`idusuario`),
  KEY `idrol` (`idrol`),
  CONSTRAINT `fkmovimiento_1` FOREIGN KEY (`idrol`) REFERENCES `rol` (`idrol`) ON UPDATE CASCADE,
  CONSTRAINT `usuariorol_ibfk_2` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcado de datos para la tabla `compraestadotipo`
INSERT INTO `compraestadotipo` (`idcompraestadotipo`, `cetdescripcion`, `cetdetalle`) VALUES
(1, 'iniciada', 'cuando el usuario : cliente inicia la compra de uno o mas productos del carrito'),
(2, 'aceptada', 'cuando el usuario administrador da ingreso a uno de las compras en estado = 1 '),
(3, 'enviada', 'cuando el usuario administrador envia a uno de las compras en estado =2 '),
(4, 'cancelada', 'un usuario administrador podra cancelar una compra en cualquier estado y un usuario cliente solo en estado=1 ');

-- Auto-incremento para las tablas
ALTER TABLE `compra` MODIFY `idcompra` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `compraestado` MODIFY `idcompraestado` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `compraitem` MODIFY `idcompraitem` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `menu` MODIFY `idmenu` BIGINT(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
ALTER TABLE `producto` MODIFY `idproducto` BIGINT(20) NOT NULL AUTO_INCREMENT;
ALTER TABLE `rol` MODIFY `idrol` BIGINT(20) NOT NULL AUTO_INCREMENT;
ALTER TABLE `usuario` MODIFY `idusuario` BIGINT(20) NOT NULL AUTO_INCREMENT;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


-- Crear el usuario administrador
INSERT INTO `usuario` (`usnombre`, `uspass`, `usmail`, `usdeshabilitado`)
VALUES ('admin', MD5('admin123'), 'admin@example.com', NULL);

-- Creando roles
INSERT INTO `rol` (`rodescripcion`) VALUES ('ADMIN');
INSERT INTO `rol` (`rodescripcion`) VALUES ('CLIENTE');

-- Crear los menús
INSERT INTO `menu` (`idmenu`, `menombre`, `medescripcion`, `idpadre`, `medeshabilitado`) VALUES
(1, 'Productos', '../Cliente/productos.php', NULL, NULL),
(2, 'Mis Compras', '../Cliente/compras.php', NULL, NULL),
(3, 'Mi Perfil', '../Cliente/perfil.php', NULL, NULL),
(4, 'Usuarios', '../Admin/listaUsuarios.php', NULL, NULL),
(5, 'Roles', '../Admin/roles.php', NULL, NULL),
(6, 'Asignar roles', '../Admin/asignarRoles.php', NULL, NULL),
(7, 'Manejo de productos', '../Admin/manejoProductos.php', NULL, NULL),
(8, 'Estado de compras', '../Admin/gestionarCompras.php', NULL, NULL),
(9, 'Gestión de menú', '../Admin/manejoMenu.php', NULL, NULL);

-- Asignar el rol de administrador al usuario administrador
INSERT INTO `usuariorol` (`idusuario`, `idrol`) VALUES (1, 1);

-- Asignar los menús específicos al rol de administrador
INSERT INTO `menurol` (`idmenu`, `idrol`) VALUES
(4, 1), -- Usuarios
(5, 1), -- Roles
(6, 1), -- Asignar roles
(7, 1), -- Manejo de productos
(8, 1), -- Estado de compras
(9, 1); -- Gestión de menú
