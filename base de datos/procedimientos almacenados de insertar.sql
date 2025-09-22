use bogarte; 

DELIMITER //
CREATE PROCEDURE InsertarUsuario(
    IN p_nombre VARCHAR(50),
    IN p_apellido VARCHAR(50),
    IN p_tipo_documento VARCHAR(50),
    IN p_documento VARCHAR(50),
    IN p_telefono VARCHAR(20),
    IN p_fecha_registro DATETIME,
    IN p_estado VARCHAR(50),
    IN p_email VARCHAR(100),
    IN p_contrasena VARCHAR(50)
)
BEGIN
    INSERT INTO usuarios(nombre, apellido, tipo_documento, documento, telefono, fecha_registro, estado, email, contrasena)
    VALUES (p_nombre, p_apellido, p_tipo_documento, p_documento, p_telefono, p_fecha_registro, p_estado, p_email, p_contrasena);
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE InsertarRol(
    IN p_nombre VARCHAR(50)
)
BEGIN
    INSERT INTO roles(nombre) VALUES (p_nombre);
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE InsertarUsoRol(
    IN p_id_rol INT,
    IN p_id_usuario INT
)
BEGIN
    INSERT INTO uso_roles(id_rol, id_usuario) VALUES (p_id_rol, p_id_usuario);
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE InsertarLocalidad(
    IN p_nombre VARCHAR(100)
)
BEGIN
    INSERT INTO localidad(nombre) VALUES (p_nombre);
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE InsertarEmpresa(
    IN p_id_usuario INT,
    IN p_id_localidad INT,
    IN p_direccion VARCHAR(100),
    IN p_fecha_creacion DATE,
    IN p_sector VARCHAR(100)
)
BEGIN
    INSERT INTO empresa(id_usuario, id_localidad, direccion, fecha_creacion, sector)
    VALUES (p_id_usuario, p_id_localidad, p_direccion, p_fecha_creacion, p_sector);
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE InsertarProducto(
    IN p_nombre_producto VARCHAR(50),
    IN p_descripcion VARCHAR(500),
    IN p_unidad VARCHAR(50),
    IN p_stock INT,
    IN p_estado_producto VARCHAR(100),
    IN p_id_empresa INT
)
BEGIN
    INSERT INTO producto(nombre_producto, descripcion, unidad, stock, estado_producto, id_empresa)
    VALUES (p_nombre_producto, p_descripcion, p_unidad, p_stock, p_estado_producto, p_id_empresa);
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE InsertarVenta(
    IN p_ganancia DECIMAL(10,2)
)
BEGIN
    INSERT INTO venta(ganancia) VALUES (p_ganancia);
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE InsertarDetalleVenta(
    IN p_id_producto INT,
    IN p_cantidad INT,
    IN p_precio DECIMAL(10,2),
    IN p_fecha DATETIME,
    IN p_id_venta INT
)
BEGIN
    INSERT INTO detalle_venta(id_producto, cantidad, precio, fecha, id_venta)
    VALUES (p_id_producto, p_cantidad, p_precio, p_fecha, p_id_venta);
END //
DELIMITER ;
