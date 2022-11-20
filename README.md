# Destinia - prueba técnica
___

__Tiempo de realización de la prueba: 4 horas y 30 minutos (aprox)__.

## Requirementos planteados
*Queremos implementar una pequeña aplicación en PHP que, tomando las tres primeras letras de la entrada estándar, devuelva por la salida estándar todas las coincidencias de hospedajes existentes en una determinada base de datos, ordenados por nombre, incluyendo sus características y su ubicación.*

*Tenemos dos tipos de hospedajes, Hoteles y Apartamentos, cada uno con sus características específicas. En el caso de los hoteles, además de su nombre, necesitamos conocer el número de estrellas y el tipo de habitación estándar que tienen (dejamos a tu elección proponer unos cuantos tipos de habitación como doble, doble con vistas, ...). En el caso de los apartamentos y además de su nombre, necesitamos conocer para cada propiedad cuantos apartamentos tienen disponibles y para cuantos adultos tienen capacidad, teniendo en cuenta que sólo tienen un tipo de apartamentos.*

*Para la ubicación de cualquier hospedaje nos basta con indicar la ciudad y provincia.*

*La salida (a mostrar por salida estándar) debería ser un listado del siguiente tipo:*

* *Hotel Azul, 3 estrellas, habitación doble con vistas, Valencia, Valencia*
* *Apartamentos Beach, 10 apartamentos, 4 adultos, Almeria, Almeria*
* *Hotel Blanco, 4 estrellas, habitación doble, Mojacar, Almeria*
* *Hotel Rojo, 3 estrellas, habitación sencilla, Sanlucar, Cádiz*
* *Apartamentos Sol y playa, 50 apartamentos, 6 adultos, Málaga, Málaga*

## Configurar fichero de variables de entorno

Windows:
```
copy .env.dist .env
```

Linux & Mac:
```bash
cp .env.dist .env
```

## Entorno docker

* PHP 8.1

Ejecutar en la directorio root del proyecto:
```bash
docker-compose -p destinia-prueba-tecnica --env-file .env up -d
```

## Instalar dependencias con composer

```bash
composer install
```

## Ejecución de pruebas

```bash
vendor/bin/phpunit
```

## Script de creación de la base de datos
Estructura de la base de datos:
```sql
create table room_type
(
    id          int auto_increment
        primary key,
    description varchar(128) not null
);

create table accommodation_place
(
    id             int auto_increment primary key,
    city           varchar(128)                 not null,
    province       varchar(128)                 not null,
    type           enum ('APARTMENTS', 'HOTEL') not null,
    canonical_name varchar(255)                 not null,
    slug           varchar(255)                 not null
)
    charset = utf8mb4;

create table apartments
(
    id               int not null,
    adults_allowed   int not null,
    amount_available int not null,
    constraint apartments_id_uindex
        unique (id),
    constraint apartments_accommodation_place_id_fk
        foreign key (id) references accommodation_place (id)
            on delete cascade
);

create table hotel
(
    id           int not null,
    stars_number int null,
    room_type_id int not null,
    constraint apartments_id_uindex
        unique (id),
    constraint hotel_accommodation_place_id_fk
        foreign key (id) references accommodation_place (id)
            on delete cascade,
    constraint hotel_room_type_id_fk
        foreign key (room_type_id) references room_type (id)
);

```

Fixtures para mínimos para la ejecución de programa:
```sql
INSERT INTO destinia_db.room_type (id, description) VALUES (1, 'Double room');
INSERT INTO destinia_db.room_type (id, description) VALUES (2, 'Simple room');
INSERT INTO destinia_db.room_type (id, description) VALUES (3, 'Double room with views');

INSERT INTO destinia_db.accommodation_place (id, city, province, type, canonical_name, slug) VALUES (1, 'Valencia', 'Valencia', 'HOTEL', 'Azul', 'azul');
INSERT INTO destinia_db.accommodation_place (id, city, province, type, canonical_name, slug) VALUES (2, 'Almería', 'Almería', 'APARTMENTS', 'Beach', 'beach');
INSERT INTO destinia_db.accommodation_place (id, city, province, type, canonical_name, slug) VALUES (3, 'Mojácar', 'Almería', 'HOTEL', 'Blanco', 'blanco');
INSERT INTO destinia_db.accommodation_place (id, city, province, type, canonical_name, slug) VALUES (4, 'Sanlúcar', 'Cádiz', 'HOTEL', 'Rojo', 'rojo');
INSERT INTO destinia_db.accommodation_place (id, city, province, type, canonical_name, slug) VALUES (5, 'Málaga', 'Málaga', 'APARTMENTS', 'Sol y playa', 'sol-y-playa');

INSERT INTO destinia_db.apartments (id, adults_allowed, amount_available) VALUES (2, 4, 10);
INSERT INTO destinia_db.apartments (id, adults_allowed, amount_available) VALUES (5, 6, 50);

INSERT INTO destinia_db.hotel (id, stars_number, room_type_id) VALUES (1, 3, 3);
INSERT INTO destinia_db.hotel (id, stars_number, room_type_id) VALUES (3, 4, 1);
INSERT INTO destinia_db.hotel (id, stars_number, room_type_id) VALUES (4, 3, 2);
```

## Ficheros de traducciones
Para cambiar el idioma de la interfaz es necesario modificar la variable de entorno 'LANGUAGE' en el fichero [.env](.env)

Directorio de traducciones de texto de la interfaz:
[locale](locale)

En caso de añadir un nuevo idioma se deberá añadir la instrucción necesaria en el proceso construcción de la imagen en el fichero
[Dockerfile](Dockerfile).

Ejecutar dentro del contenedor para actualizar los binarios no versionados:
```bash
msgfmt locale/es_ES/LC_MESSAGES/messages.po -o locale/es_ES/LC_MESSAGES/messages.mo
msgfmt locale/en_EN/LC_MESSAGES/messages.po -o locale/en_EN/LC_MESSAGES/messages.mo
```
