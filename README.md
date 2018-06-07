# Dayscript Predictor

## Instalar

Se debe seguir el procedimiento normal de instalación de Laravel.
- Descargar repositorio
- `npm install`
- `composer install`
- Crear archivo `.env` e incluir credenciales de acceso a base de datos
- Correr migraciones: `php artisan migrate --step`
- Configurar el resto de variables de `.env`

## Cambio de textos multi-idioma

Para modificar los textos usados en la interfaz e usuario, se deben editar los archivos incluídos en `resources/lang/*`
Una vez modificados, es necesario ejecutar el comando:

```php artisan lang:js --no-lib```

Esto creará los archivos json necesarios para mostrar los textos. Para ver los cambios efectivamente en embiente local, se puede usar 
```npm run dev``` o ```npm run watch```  

Para publicar en producción siempre se debe ejecutar ```npm run prod```

## Estilos
Los estilos se modifican directamente en la carpeta `resources/assets/sass` Para ver los cambios efectivamente en embiente local, se puede usar ```npm run dev``` o ```npm run watch```   

Para publicar en producción siempre se debe ejecutar ```npm run prod```