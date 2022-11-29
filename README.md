# abaccor/php-api

[![Latest Stable Version](https://img.shields.io/packagist/v/abaccor/php-api?style=flat-square)](https://packagist.org/packages/abaccor/php-api)
[![Total Downloads](https://img.shields.io/packagist/dt/abaccor/php-api?style=flat-square)](https://packagist.org/packages/abaccor/php-api)

## Instalación usando Composer

```sh
$ composer require abaccor/php-api
```

## Ejemplo 3.3

````
$abaccor = new \Abaccor\Abaccor('https://sandbox-api.abaccor.com/', '**********************');

$data = [/* ... */];

try{
    $response = $abaccor->GenerarCfdi33($data);
}catch(AbaccorException $e){
    //Ocurrió un error
}
````

## Ejemplo 4.0

````
$abaccor = new \Abaccor\Abaccor('https://sandbox-api.abaccor.com/', '**********************');

$data = [/* ... */];

try{
    $response = $abaccor->GenerarCfdi40($data);
}catch(AbaccorException $e){
    //Ocurrió un error
}
````
