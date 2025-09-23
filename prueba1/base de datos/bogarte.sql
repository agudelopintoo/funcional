create database bogartestudio;
use bogartestudio;

create table roles(
    id_rol int primary key auto_increment,
    nombre varchar(50) not null
);

create table usuarios(
    id int primary key auto_increment,
    nombre varchar(50) not null,
    apellido varchar(50) not null,
    tipo_documento varchar(50) not null,
    documento varchar(50) not null,
    telefono varchar(20) not null,
    fecha_registro datetime,
    estado varchar(50) not null,
    email varchar(100) not null unique,
    password_hash VARCHAR(255) NOT NULL AFTER email;
);

create table uso_roles(
    id_uso int primary key auto_increment,
    id_rol int not null,
    foreign key (id_rol) references roles (id_rol),
    id_usuario int not null,
    foreign key (id_usuario) references usuarios (id_usuario)
);

create table localidad(
    id_localidad int primary key auto_increment,
    nombre varchar(100) not null
);

create table empresa(
    id_empresa int primary key auto_increment,
    id_usuario int not null,
    foreign key (id_usuario) references usuarios(id_usuario),
    id_localidad int not null,
    foreign key (id_localidad) references localidad(id_localidad),
    direccion varchar(100) not null,
    fecha_creacion date not null,
    sector varchar(100) not null
);

create table producto(
    id_producto int primary key auto_increment,
    nombre_producto varchar(50) not null,
    descripcion varchar(500) not null,
    unidad varchar(50) not null,
    stock int not null,
    estado_producto varchar(100) not null,
    id_empresa int not null,
    foreign key (id_empresa) references empresa (id_empresa)
);

create table venta(
    id_venta int primary key auto_increment,
    ganancia decimal(10,2)
);

create table detalle_venta(
    id_pedido int primary key auto_increment,
    id_producto int not null,
    foreign key (id_producto) references producto(id_producto),
    cantidad int not null,
    precio decimal(10,2) not null,
    fecha datetime not null,
    id_venta int not null,
    foreign key (id_venta) references venta(id_venta)
);
