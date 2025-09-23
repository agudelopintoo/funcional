use bogarte;

DELIMITER //
CREATE PROCEDURE ActualizarUsuario(
    IN p_id_usuario INT,
    IN p_nombre VARCHAR(50),
    IN p_apellido VARCHAR(50),
    IN p_estado VARCHAR(50),
    IN p_email VARCHAR(100),
    IN p_contrasena VARCHAR(50)
)
BEGIN
    UPDATE usuarios
    SET nombre = p_nombre,
        apellido = p_apellido,
        estado = p_estado,
        email = p_email,
        contrasena = p_contrasena
    WHERE id_usuario = p_id_usuario;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE ActualizarRol(
    IN p_id_rol INT,
    IN p_nombre VARCHAR(50)
)
BEGIN
    UPDATE roles SET nombre = p_nombre WHERE id_rol = p_id_rol;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE ActualizarUsoRol(
    IN p_id_uso INT,
    IN p_id_rol INT,
    IN p_id_usuario INT
)
BEGIN
    UPDATE uso_roles SET id_rol = p_id_rol, id_usuario = p_id_usuario
    WHERE id_uso = p_id_uso;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE ActualizarLocalidad(
    IN p_id_localidad INT,
    IN p_nombre VARCHAR(100)
)
BEGIN
    UPDATE localidad SET nombre = p_nombre WHERE id_localidad = p_id_localidad;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE ActualizarEmpresa(
    IN p_id_empresa INT,
    IN p_direccion VARCHAR(100),
    IN p_sector VARCHAR(100)
)
BEGIN
    UPDATE empresa SET direccion = p_direccion, sector = p_sector
    WHERE id_empresa = p_id_empresa;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE ActualizarProducto(
    IN p_id_producto INT,
    IN p_nombre_producto VARCHAR(50),
    IN p_descripcion VARCHAR(500),
    IN p_stock INT,
    IN p_estado_producto VARCHAR(100)
)
BEGIN
    UPDATE producto 
    SET nombre_producto = p_nombre_producto,
        descripcion = p_descripcion,
        stock = p_stock,
        estado_producto = p_estado_producto
    WHERE id_producto = p_id_producto;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE ActualizarVenta(
    IN p_id_venta INT,
    IN p_ganancia DECIMAL(10,2)
)
BEGIN
    UPDATE venta SET ganancia = p_ganancia WHERE id_venta = p_id_venta;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE ActualizarDetalleVenta(
    IN p_id_pedido INT,
    IN p_cantidad INT,
    IN p_precio DECIMAL(10,2)
)
BEGIN
    UPDATE detalle_venta SET cantidad = p_cantidad, precio = p_precio
    WHERE id_pedido = p_id_pedido;
END //
DELIMITER ;
