CREATE TABLE empresa (
  idEmpresa INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(255) NOT NULL,
  nit VARCHAR(45) NOT NULL,
  cantidadCuentas INTEGER UNSIGNED NOT NULL,
  sectorEconomico VARCHAR(250) NOT NULL,
  PRIMARY KEY(idEmpresa)
);

CREATE TABLE usuario (
  idUsuario INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  empresa_idEmpresa INTEGER UNSIGNED NOT NULL,
  nombre VARCHAR(150) NOT NULL,
  apellido VARCHAR(150) NOT NULL,
  cargo VARCHAR(150) NOT NULL,
  permiso VARCHAR(150) NOT NULL,
  correo VARCHAR(150) NOT NULL,
  contrasena VARCHAR(150) NOT NULL,
  PRIMARY KEY(idUsuario),
  INDEX usuario_FKIndex1(empresa_idEmpresa),
  FOREIGN KEY(empresa_idEmpresa)
    REFERENCES empresa(idEmpresa)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE matrizlegal (
  idmatrizLegal INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  usuario_idUsuario INTEGER UNSIGNED NOT NULL,
  tema VARCHAR(255) NOT NULL,
  tipoNorma VARCHAR(255) NOT NULL,
  normaAplicar VARCHAR(255) NOT NULL,
  fecha DATETIME NOT NULL,
  estado VARCHAR(1) NOT NULL,
  subtema VARCHAR(255) NOT NULL,
  PRIMARY KEY(idmatrizLegal),
  INDEX matrizLegal_FKIndex1(usuario_idUsuario),
  FOREIGN KEY(usuario_idUsuario)
    REFERENCES usuario(idUsuario)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE matrizlegalcalificacion (
  idmatrizLegalCalificacion INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  matrizlegal_idmatrizLegal INTEGER UNSIGNED NOT NULL,
  cumplimiento VARCHAR(255) NOT NULL,
  evaluacionCumplimiento VARCHAR(255) NOT NULL,
  controlesCumplimiento VARCHAR(255) NOT NULL,
  evidenciaCumplimiento VARCHAR(255) NOT NULL,
  urlCumplimiento VARCHAR(255) NOT NULL,
  PRIMARY KEY(idmatrizLegalCalificacion),
  INDEX matrizLegalCalificacion_FKIndex1(matrizlegal_idmatrizLegal),
  FOREIGN KEY(matrizlegal_idmatrizLegal)
    REFERENCES matrizlegal(idmatrizLegal)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE matrizlegalcomplemento (
  idmatrizLegalComplemento INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  matrizlegal_idmatrizLegal INTEGER UNSIGNED NOT NULL,
  procesoAplicacion VARCHAR(255) NOT NULL,
  urlNorma VARCHAR(255) NOT NULL,
  anotaciones VARCHAR(255) NOT NULL,
  descripcionArticulo VARCHAR(255) NOT NULL,
  PRIMARY KEY(idmatrizLegalComplemento),
  INDEX matrizLegalComplemento_FKIndex1(matrizlegal_idmatrizLegal),
  FOREIGN KEY(matrizlegal_idmatrizLegal)
    REFERENCES matrizlegal(idmatrizLegal)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE matrizlegalemisor (
  idmatrizLegalEmisor INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  matrizlegal_idmatrizLegal INTEGER UNSIGNED NOT NULL,
  anoPublicacion DATE NOT NULL,
  enteEmisor VARCHAR(255) NOT NULL,
  descripcionNorma VARCHAR(255) NOT NULL,
  articulo VARCHAR(255) NOT NULL,
  fechaEmision DATE NOT NULL,
  PRIMARY KEY(idmatrizLegalEmisor),
  INDEX matrizLegalEmisor_FKIndex1(matrizlegal_idmatrizLegal),
  FOREIGN KEY(matrizlegal_idmatrizLegal)
    REFERENCES matrizlegal(idmatrizLegal)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE panelcambios (
  idPanelCambios INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  usuario_idUsuario INTEGER UNSIGNED NOT NULL,
  fecha DATE NOT NULL,
  motivo VARCHAR(255) NOT NULL,
  version INTEGER UNSIGNED NOT NULL,
  responsableCambio VARCHAR(255) NOT NULL,
  PRIMARY KEY(idPanelCambios),
  INDEX panelCambios_FKIndex1(usuario_idUsuario),
  FOREIGN KEY(usuario_idUsuario)
    REFERENCES usuario(idUsuario)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);


