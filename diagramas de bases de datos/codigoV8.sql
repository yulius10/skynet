create database skynet;
use skynet;

CREATE TABLE empresa (idEmpresa INTEGER NOT NULL AUTO_INCREMENT,nombre VARCHAR(255) NOT NULL,nit VARCHAR(45) NOT NULL,cantidadCuentas INTEGER NOT NULL,sectorEconomico VARCHAR(250) NOT NULL,urlLogo VARCHAR(250) NOT NULL,estado VARCHAR(1) NOT NULL,PRIMARY KEY(idEmpresa));

CREATE TABLE AdministradorSistema (idAdministradorSistema INTEGER NOT NULL AUTO_INCREMENT,nombre VARCHAR(150) NOT NULL,apellido VARCHAR(150) NOT NULL,correo VARCHAR(150) NOT NULL,contrasena VARCHAR(150) NOT NULL,PRIMARY KEY(idAdministradorSistema));

CREATE TABLE usuario (idUsuario INTEGER NOT NULL AUTO_INCREMENT,empresa_idEmpresa INTEGER NOT NULL,nombre VARCHAR(150) NOT NULL,apellido VARCHAR(150) NOT NULL,cargo VARCHAR(150) NOT NULL,permiso VARCHAR(150) NOT NULL,correo VARCHAR(150) NOT NULL,contrasena VARCHAR(150) NOT NULL,PRIMARY KEY(idUsuario),FOREIGN KEY(empresa_idEmpresa)REFERENCES empresa(idEmpresa));

CREATE TABLE matrizlegal (idmatrizLegal INTEGER NOT NULL AUTO_INCREMENT,usuario_idUsuario INTEGER NOT NULL,tema VARCHAR(255) NOT NULL,tipoNorma VARCHAR(255) NOT NULL,normaAplicar VARCHAR(255) NOT NULL,fecha DATETIME NOT NULL,estado VARCHAR(1) NOT NULL,subtema VARCHAR(255) NOT NULL,idEmpresa INTEGER NOT NULL,PRIMARY KEY(idmatrizLegal),FOREIGN KEY(usuario_idUsuario)REFERENCES usuario(idUsuario));
CREATE TABLE matrizlegalcalificacion (idmatrizLegalCalificacion INTEGER NOT NULL AUTO_INCREMENT,matrizlegal_idmatrizLegal INTEGER NOT NULL,cumplimiento VARCHAR(255) NOT NULL,evaluacionCumplimiento VARCHAR(255) NOT NULL,controlesCumplimiento VARCHAR(255) NOT NULL,evidenciaCumplimiento VARCHAR(255) NOT NULL,urlCumplimiento VARCHAR(255) NOT NULL,PRIMARY KEY(idmatrizLegalCalificacion),FOREIGN KEY(matrizlegal_idmatrizLegal)REFERENCES matrizlegal(idmatrizLegal));
CREATE TABLE matrizlegalcomplemento (idmatrizLegalComplemento INTEGER NOT NULL AUTO_INCREMENT,matrizlegal_idmatrizLegal INTEGER NOT NULL,procesoAplicacion VARCHAR(255) NOT NULL,urlNorma VARCHAR(255) NOT NULL,anotaciones VARCHAR(255) NOT NULL,descripcionArticulo VARCHAR(255) NOT NULL,PRIMARY KEY(idmatrizLegalComplemento),FOREIGN KEY(matrizlegal_idmatrizLegal)REFERENCES matrizlegal(idmatrizLegal));
CREATE TABLE matrizlegalemisor (idmatrizLegalEmisor INTEGER NOT NULL AUTO_INCREMENT,matrizlegal_idmatrizLegal INTEGER NOT NULL,anoPublicacion VARCHAR(6) NOT NULL,enteEmisor VARCHAR(255) NOT NULL,descripcionNorma VARCHAR(255) NOT NULL,articulo VARCHAR(255) NOT NULL,fechaEmision DATE NOT NULL,PRIMARY KEY(idmatrizLegalEmisor),FOREIGN KEY(matrizlegal_idmatrizLegal)REFERENCES matrizlegal(idmatrizLegal));

CREATE TABLE panelcambios (idPanelCambios INTEGER NOT NULL AUTO_INCREMENT,usuario_idUsuario INTEGER NOT NULL,fecha DATE NOT NULL,motivo VARCHAR(255) NOT NULL,version INTEGER NOT NULL,idEmpresa INTEGER NOT NULL,PRIMARY KEY(idPanelCambios),FOREIGN KEY(usuario_idUsuario)REFERENCES usuario(idUsuario));

insert into empresa(nombre,nit,cantidadCuentas,sectorEconomico,urlLogo,estado) values('Bancolombia','123456789-abc',3,'bancario','logoEmpresas/Bancolombia.png','A');
insert into usuario (empresa_idEmpresa,nombre,apellido,cargo,permiso,correo,contrasena) values (1,"Felipe","Gomez","Webmaster","administrador","feligomez160@gmail.com","123456789");
insert into usuario (empresa_idEmpresa,nombre,apellido,cargo,permiso,correo,contrasena) values (1,"Andres","Lopez","Cajero","usuario","andresLopez@gmail.com","123456789");
insert into AdministradorSistema (nombre,apellido,correo,contrasena) values ("Felipe","Gomez","feligomez160@gmail.com","123456789");