# Prueba técnica PHP. - Rene Huanco Choque

Este proyecto es una aplicación escrita en **PHP** con una arquitectura basada en controladores, entidades y repositorios, y utiliza **Docker** para su configuración de entorno.

## Contenido

- [Requisitos](#requisitos)
- [Instalación](#instalación)
- [Configuración](#configuración)
- [Ejecución del Proyecto](#ejecución-del-proyecto)
- [Estructura del Proyecto](#estructura-del-proyecto)
- [Pruebas](#pruebas)
- [Licencia](#licencia)

## Requisitos

Antes de comenzar, asegúrate de tener instalados los siguientes componentes:

- [Docker](https://www.docker.com/) y Docker Compose
- PHP 8.4 o superior (opcional si ejecutas fuera de Docker)
- Composer para la gestión de dependencias
- Extensiones de PHP necesarias (se instalan mediante Docker)

## Instalación

1. Clona este repositorio:

   ``` bash
   git clone https://github.com/abhuanco/rene-huanco-choque.git
   cd rene-huanco-choque
   ```

2. Construye y levanta los contenedores con Docker Compose:

   ```bash
   docker compose up --build
   ```

3. Instala las dependencias con Composer dentro del contenedor:

   ```bash
   docker exec -it app.test composer install
   ```

## Configuración

El contenedor Docker viene configurado con Apache y PHP. Estos son algunos archivos relevantes que puedes ajustar según tus necesidades:

- **`docker-compose.yml`**: Configuración principal para los servicios Docker.
- **`Dockerfile`**: Configuración específica de PHP.
- **`php.ini`**: Ajustes de PHP personalizados en `docker/config/php/`.
- **`default.conf`**: Configuración customizada de Apache en `docker/config/apache/`.

## Pruebas unitarias
   ```bash
   docker exec -it app.test php ./vendor/bin/phpunit tests
   ```