# Reto_Eventos
Reto Eventos.  

## Tecnologías usadas  

- [Symfony 6.0.4](https://symfony.com/doc/current/index.html) - Framework de PHP
- [Materialize](http://materializecss.com/) - Framework CSS
- [Material Design Iconic Font](http://zavoloklom.github.io/material-design-iconic-font/icons.html) - Iconos
- [Sweet Alert](http://t4t5.github.io/sweetalert/) - Plugin JS para alertas
- [jQuery custom content scroller](http://manos.malihu.gr/jquery-custom-content-scroller/) - Plugin JS para el Scroll

## Requisitos

- [PHP 8.0.2](https://www.php.net/downloads.php)  
- [Composer 2.2.6](https://getcomposer.org/download/)  
- [Scoop](https://www.onmsft.com/how-to/how-to-install-the-scoop-package-manager-in-windows-10)  
- [Yarn 1.23.0](https://classic.yarnpkg.com/lang/en/docs/install/#windows-stable)  
- [MySQL 8.0.3](https://dev.mysql.com/downloads/installer/)  

## Configurar base de datos 🔧

_Localizar el archivo '.env'_

Dentro del archivo descomentar la variable global de la aplicacion llamada 'DATABASE_URL' de acuerdo al manejador de base de datos que tengamos instalado, en mi caso MySQL 8.0.3

```
DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7"
```  
**db_user**: _Usuario para acceder al manejador_  
**db_password**: _Contraseña para acceder al manejador_  
**db_name**: _Nombre de la base de datos con la cual se quiera nombrar_  
  
**NOTA IMPORTANTE 📢**: Verificar que se tenga descomentado el controlador de PHP para su manejador de base de datos en los archivos _'php.init'_ tanto el principal, como el de desarrollo y el de producción.

## Packetes de composer    

Los paquetes implementados en el proyecto fueron:

* Symfony Route
```
**$** composer require annotations
```  
* Symfony twig
```
composer require twig
```  
* 

## Iniciando el proyecto 🚀   

_Abrir un interprete de comandos e instalamos el framework con el siguiente comando:_

```
scoop install symfony-cli
```  
_En la carpeta raíz del proyecto, ejecutar el siguiente comando para arrancar el proyecto (en mi caso utilizare el puerto 5000, por defecto se usa el 8000)_

```
scoop server:start --port=5000
```  

