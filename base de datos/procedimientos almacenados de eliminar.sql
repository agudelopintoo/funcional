use bogarte;

DELIMITER //
CREATE PROCEDURE EliminarUsuario(
    IN p_id_usuario INT
)
BEGIN
    DELETE FROM usuarios WHERE id_usuario = p_id_usuario;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE EliminarRol(
    IN p_id_rol INT
)
BEGIN
    DELETE FROM roles WHERE id_rol = p_id_rol;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE EliminarUsoRol(
    IN p_id_uso INT
)
BEGIN
    DELETE FROM uso_roles WHERE id_uso = p_id_uso;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE EliminarLocalidad(
    IN p_id_localidad INT
)
BEGIN
    DELETE FROM localidad WHERE id_localidad = p_id_localidad;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE EliminarEmpresa(
    IN p_id_empresa INT
)
BEGIN
    DELETE FROM empresa WHERE id_empresa = p_id_empresa;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE EliminarProducto(
    IN p_id_producto INT
)
BEGIN
    DELETE FROM producto WHERE id_producto = p_id_producto;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE EliminarVenta(
    IN p_id_venta INT
)
BEGIN
    DELETE FROM venta WHERE id_venta = p_id_venta;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE EliminarDetalleVenta(
    IN p_id_pedido INT
)
BEGIN
    DELETE FROM detalle_venta WHERE id_pedido = p_id_pedido;
END //
DELIMITER ;
