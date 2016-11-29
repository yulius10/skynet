create database skynet;
use skynet;
CREATE TABLE empresa (idEmpresa INTEGER NOT NULL AUTO_INCREMENT,nombre VARCHAR(255) NOT NULL,nit VARCHAR(45) NOT NULL,cantidadCuentas INTEGER NOT NULL,PRIMARY KEY(idEmpresa));
CREATE TABLE usuario (idUsuario INTEGER NOT NULL AUTO_INCREMENT,empresa_idEmpresa INTEGER NOT NULL,nombre VARCHAR(150) NOT NULL,apellido VARCHAR(150) NOT NULL,cargo VARCHAR(150) NOT NULL,permiso VARCHAR(150) NOT NULL,PRIMARY KEY(idUsuario),FOREIGN KEY(empresa_idEmpresa)REFERENCES empresa(idEmpresa));
CREATE TABLE administrador (idAdministrador INTEGER NOT NULL AUTO_INCREMENT,usuario_idUsuario INTEGER NOT NULL,correo VARCHAR(150) NOT NULL,contrasena VARCHAR(150) NOT NULL,PRIMARY KEY(idAdministrador),FOREIGN KEY(usuario_idUsuario)REFERENCES usuario(idUsuario));
CREATE TABLE usuConsulta (idUsuConsulta INTEGER NOT NULL AUTO_INCREMENT,usuario_idUsuario INTEGER NOT NULL,correo VARCHAR(150) NOT NULL,contrasena VARCHAR(150) NOT NULL,PRIMARY KEY(idUsuConsulta),FOREIGN KEY(usuario_idUsuario)REFERENCES usuario(idUsuario));
CREATE TABLE matrizLegal (idMatrizLegal INTEGER NOT NULL AUTO_INCREMENT,administrador_idAdministrador INTEGER NOT NULL,tipo VARCHAR(255) NOT NULL,nombre VARCHAR(255) NOT NULL,anoPublicacion VARCHAR(255) NOT NULL,emisor VARCHAR(255) NOT NULL,fecha DATETIME NOT NULL,estado VARCHAR(1) NOT NULL,PRIMARY KEY(idMatrizLegal),FOREIGN KEY(administrador_idAdministrador)REFERENCES administrador(idAdministrador));
CREATE TABLE matrizLegalCalificacion (idMatrizLegalCalificacion INTEGER NOT NULL AUTO_INCREMENT,matrizLegal_idMatrizLegal INTEGER NOT NULL,tipoCalificacion VARCHAR(2) NOT NULL,calificacion INTEGER NOT NULL,PRIMARY KEY(idMatrizLegalCalificacion),FOREIGN KEY(matrizLegal_idMatrizLegal)REFERENCES matrizLegal(idMatrizLegal));
CREATE TABLE matrizLegalArticulo (idMatrizLegalArticulo INTEGER NOT NULL AUTO_INCREMENT,matrizLegal_idMatrizLegal INTEGER NOT NULL,articulo VARCHAR(255) NOT NULL,descripcion VARCHAR(255) NOT NULL,evidenciaAplicacion VARCHAR(255) NOT NULL,tema VARCHAR(255) NOT NULL,url VARCHAR(255) NOT NULL,PRIMARY KEY(idMatrizLegalArticulo),FOREIGN KEY(matrizLegal_idMatrizLegal)REFERENCES matrizLegal(idMatrizLegal));
CREATE TABLE panelCambios (idPanelCambios INTEGER NOT NULL AUTO_INCREMENT,matrizLegal_idMatrizLegal INTEGER NOT NULL,fecha DATE NOT NULL,motivo VARCHAR(255) NOT NULL,PRIMARY KEY(idPanelCambios),FOREIGN KEY(matrizLegal_idMatrizLegal)REFERENCES matrizLegal(idMatrizLegal));
CREATE TABLE matrizLegarlEncargado (idMatrizLegarlEncargado INTEGER NOT NULL AUTO_INCREMENT,matrizLegal_idMatrizLegal INTEGER NOT NULL,responsable VARCHAR(150) NOT NULL,fecuenciaRevision VARCHAR(150) NOT NULL,PRIMARY KEY(idMatrizLegarlEncargado),FOREIGN KEY(matrizLegal_idMatrizLegal)REFERENCES matrizLegal(idMatrizLegal));

insert into empresa(nombre,nit,cantidadCuentas) values('Bancolombia','123456789-abc',3);
insert into usuario (empresa_idEmpresa,nombre,apellido,cargo,permiso) values (1,"Felipe","Gomez","Webmaster","administrador");
insert into usuario (empresa_idEmpresa,nombre,apellido,cargo,permiso) values (1,"Andres","Lopez","Cajero","usuario");
insert into administrador (usuario_idUsuario,correo,contrasena) values (1,"feligomez160@gmail.com","123456789");
insert into administrador (usuario_idUsuario,correo,contrasena) values (2,"andresLopez@gmail.com","123456789");
