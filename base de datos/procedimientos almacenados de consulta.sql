use bogarte; 

DELIMITER //
CREATE PROCEDURE ConsultarUsuarios(
    IN p_id_usuario INT
)
BEGIN
    IF p_id_usuario IS NULL THEN
        SELECT * FROM usuarios;
    ELSE
        SELECT * FROM usuarios WHERE id_usuario = p_id_usuario;
    END IF;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE ConsultarRoles(
    IN p_id_rol INT
)
BEGIN
    IF p_id_rol IS NULL THEN
        SELECT * FROM roles;
    ELSE
        SELECT * FROM roles WHERE id_rol = p_id_rol;
    END IF;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE ConsultarUsoRoles(
    IN p_id_uso INT
)
BEGIN
    IF p_id_uso IS NULL THEN
        SELECT ur.id_uso, u.nombre, u.apellido, r.nombre AS rol
        FROM uso_roles ur
        INNER JOIN usuarios u ON ur.id_usuario = u.id_usuario
        INNER JOIN roles r ON ur.id_rol = r.id_rol;
    ELSE
        SELECT ur.id_uso, u.nombre, u.apellido, r.nombre AS rol
        FROM uso_roles ur
        INNER JOIN usuarios u ON ur.id_usuario = u.id_usuario
        INNER JOIN roles r ON ur.id_rol = r.id_rol
        WHERE ur.id_uso = p_id_uso;
    END IF;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE ConsultarLocalidades(
    IN p_id_localidad INT
)
BEGIN
    IF p_id_localidad IS NULL THEN
        SELECT * FROM localidad;
    ELSE
        SELECT * FROM localidad WHERE id_localidad = p_id_localidad;
    END IF;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE ConsultarEmpresas(
    IN p_id_empresa INT
)
BEGIN
    IF p_id_empresa IS NULL THEN
        SELECT e.id_empresa, e.direccion, e.fecha_creacion, e.sector,
               u.nombre AS propietario, l.nombre AS localidad
        FROM empresa e
        INNER JOIN usuarios u ON e.id_usuario = u.id_usuario
        INNER JOIN localidad l ON e.id_localidad = l.id_localidad;
    ELSE
        SELECT e.id_empresa, e.direccion, e.fecha_creacion, e.sector,
               u.nombre AS propietario, l.nombre AS localidad
        FROM empresa e
        INNER JOIN usuarios u ON e.id_usuario = u.id_usuario
        INNER JOIN localidad l ON e.id_localidad = l.id_localidad
        WHERE e.id_empresa = p_id_empresa;
    END IF;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE ConsultarProductos(
    IN p_id_producto INT
)
BEGIN
    IF p_id_producto IS NULL THEN
        SELECT p.id_producto, p.nombre_producto, p.descripcion, p.stock,
               p.estado_producto, e.sector AS empresa
        FROM producto p
        INNER JOIN empresa e ON p.id_empresa = e.id_empresa;
    ELSE
        SELECT p.id_producto, p.nombre_producto, p.descripcion, p.stock,
               p.estado_producto, e.sector AS empresa
        FROM producto p
        INNER JOIN empresa e ON p.id_empresa = e.id_empresa
        WHERE p.id_producto = p_id_producto;
    END IF;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE ConsultarVentas(
    IN p_id_venta INT
)
BEGIN
    IF p_id_venta IS NULL THEN
        SELECT * FROM venta;
    ELSE
        SELECT * FROM venta WHERE id_venta = p_id_venta;
    END IF;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE ConsultarDetalleVentas(
    IN p_id_venta INT
)
BEGIN
    SELECT d.id_pedido, p.nombre_producto, d.cantidad, d.precio, d.fecha
    FROM detalle_venta d
    INNER JOIN producto p ON d.id_producto = p.id_producto
    WHERE d.id_venta = p_id_venta;
END //
DELIMITER ;
