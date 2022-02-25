CREATE SCHEMA IF NOT EXISTS inventory;

USE inventory;

CREATE TABLE IF NOT EXISTS `user`(
    id              INTEGER(10) PRIMARY KEY AUTO_INCREMENT,
    `username`      VARCHAR(30) NOT NULL,
    `password`      VARCHAR(40) NOT NULL,
    `admin`         BOOLEAN DEFAULT FALSE,
    `delete`        BOOLEAN DEFAULT FALSE,
    create_at       TIMESTAMP DEFAULT NOW(),
    update_at       TIMESTAMP DEFAULT NOW(),
    delete_at       TIME
);

CREATE TABLE IF NOT EXISTS brand(
    id              INTEGER(10) PRIMARY KEY AUTO_INCREMENT,
    `name`          VARCHAR(30) NOT NULL,
    `delete`        BOOLEAN DEFAULT FALSE
);

CREATE TABLE IF NOT EXISTS unittype(
    id              INTEGER(10) PRIMARY KEY AUTO_INCREMENT,
    `name`          VARCHAR(30) NOT NULL,
    `delete`        BOOLEAN DEFAULT FALSE
);

DROP TABLE inventory;

CREATE TABLE IF NOT EXISTS inventory(
    id              INTEGER(10) PRIMARY KEY AUTO_INCREMENT,
    userid          INTEGER(10) NOT NULL,
    idUnitType      INTEGER(10) NOT NULL,
    idBrand         INTEGER(10) NOT NULL,
    model           VARCHAR(20) NOT NULL,
    `serial`        VARCHAR(30) NOT NULL,
    `delete`        BOOLEAN DEFAULT FALSE,
    `state`         VARCHAR(20) DEFAULT 'available' CHECK(`state` IN ('available','assigned')),
    create_at       TIMESTAMP DEFAULT NOW(),
    update_at       TIMESTAMP DEFAULT NOW(),
    delete_at       DATE DEFAULT NULL,           
    FOREIGN KEY(idUnitType) REFERENCES unittype(id),
    FOREIGN KEY(idBrand) REFERENCES brand(id),
    FOREIGN KEY(userid) REFERENCES `user`(id)
);


CREATE TABLE IF NOT EXISTS department(
    id              INTEGER(10) PRIMARY KEY AUTO_INCREMENT,
    `name`          VARCHAR(30) NOT NULL,
    `description`   LONGTEXT NOT NULL,
    `delete`        BOOLEAN DEFAULT FALSE,
    create_at       TIMESTAMP DEFAULT NOW(),
    delete_at       INTEGER(15) DEFAULT 0
);

-- DROP TABLE employee,department;

CREATE TABLE IF NOT EXISTS employee(
    id              INTEGER(10) PRIMARY KEY AUTO_INCREMENT,
    `name`          VARCHAR(30) NOT NULL,
    lastname        VARCHAR(30) NOT NULL,
    email           VARCHAR(30) NOT NULL,
    extentionnumber VARCHAR(10) NOT NULL,
    `date_add`      DATE DEFAULT NULL,
    `delete`        BOOLEAN DEFAULT FALSE,
    idDepartment    INTEGER(10) NOT NULL,
    create_at       TIMESTAMP DEFAULT NOW(),
    update_at       TIMESTAMP DEFAULT NOW(),
    delete_at       INTEGER(15) DEFAULT 0,
    FOREIGN KEY(idDepartment) REFERENCES department(id)
);

CREATE TABLE IF NOT EXISTS assigned(
    id              INTEGER(10) PRIMARY KEY AUTO_INCREMENT,
    idInventory     INTEGER(10) NOT NULL,
    idEmployee      INTEGER(10) NOT NULL,
    `state`         VARCHAR(20) CHECK(`state` IN ('new', 'used')),
    `delete`        BOOLEAN DEFAULT FALSE,
    create_at       TIMESTAMP DEFAULT NOW(),
    update_at       DATE DEFAULT NULL
);

-- drop table `file`;
CREATE TABLE IF NOT EXISTS `file`(
    idEmployee      INTEGER(10) PRIMARY KEY NOT NULL,
    `filename`      VARCHAR(50) NOT NULL,
    extension       VARCHAR(5) NOT NULL,
    `delete`        BOOLEAN DEFAULT FALSE,
    create_at       TIMESTAMP DEFAULT NOW(),
    update_at       DATE DEFAULT NULL
);

drop table assigned;

/* insertando usuarios por defecto */
INSERT INTO 
    `user`(username, `password`, `admin`) 
VALUES
    ('rafaga21', md5('1234'), true), 
    ('rafaga22', md5('1234'), false);

/* insertando marcas */
INSERT INTO 
    brand(`name`) 
VALUES
    ('Lenovo'), ('HP'), ('Acer'), 
    ('Apple'),('Alienware'),('Toshiba'),
    ('Dell'),('Asus'),('Samsung'),('Gateway'),
    ('Sony'),('MSI'),('LG');

-- insertando departamentos
INSERT INTO 
    department(`name`,`description`) 
VALUES
    ('Financiero', 'El departamento financiero consigue financiación para las necesidades de la empresa (inversiones o circulante), planifica para que esta siempre tenga dinero para afrontar sus pagos puntualmente y tenga una situación patrimonial saneada, y controla que la actividad resulte rentable.'), 
    ('Recursos Humanos', 'El objetivo del departamento de recursos humanos es conseguir y conservar un grupo humano de trabajo cuyas características vayan de acuerdo con los objetivos de la empresa, a través de programas adecuados y reclutamiento, de selección, de capacitación, y desarrollo.'), 
    ('Marketing', 'El departamento de marketing colabora con el departamento comercial para conseguir más ventas y atender mejor a los clientes.'), 
    ('Comercial', 'Las funciones del departamento comercial, vienen marcadas por las estrategias marcadas en el área de marketing.'), 
    ('Compras', 'La principal función del departamento de compras es adquirir buenas materias primas, a buen precio, siempre y cuando es necesario, sin roturas de stock.'), 
    ('Logística y Operaciones', 'El sector de la Logística es actualmente un motor esencial para la competitividad de las empresas y para el desarrollo económico en todos los países avanzados, y su importancia aumentará en los próximos años.'), 
    ('Control de Gestión', 'El departamento de control de gestión es un instrumento administrativo creado y apoyado por la dirección de la empresa que le permite obtener las informaciones necesarias, fiables y oportunas, para la toma de decisiones operativas.'), 
    ('Dirección General', 'Este departamento es la cabeza de la empresa. En las pequeñas empresas es el propietario. Es quien sabe hacia dónde va la empresa y establece los objetivos de la misma, se basa en su plan de negocios, sus metas personales y sus conocimientos, por lo que toma las decisiones en situaciones críticas.'), 
    ('Comité de Dirección', 'la Alta Dirección forma parte del Comité Directivo o Comité Ejecutivo que se reúne con una frecuencia determinada y marcan la línea estratégica a seguir por esa Compañía.');

-- Insertando empleados
INSERT INTO 
    employee(`name`,lastname,email,extentionnumber,`date_add`,idDepartment)
VALUES
    ('Rafael', 'Minaya Beltrán', 'rminaya@vopm.net', '2453', '2021-11-15', 6);

-- Insertando asignaciones de dispositivos
INSERT INTO assigned(idEmployee,idInventary,`state`) VALUES(1,5,'new');

-- Insertando medios
INSERT INTO 
    unittype(`name`)
VALUES
    ('Laptop'), ('Teclado'), ('Mouse'), 
    ('Cargador'), ('Base de Laptop'), ('MousePad'), 
    ('Monitor'), ('Celular'), ('Teléfono IP'), ('Audífonos USB'), 
    ('Audífonos RJ'), ('Adaptador de Red USB'), ('Micrófono'), ('Joystick'),
    ('Sensor de huella digital'), ('Cámara digital'), ('Cámara web'), ('Joystick');