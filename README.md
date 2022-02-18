# abaccor/php-api

[![Latest Stable Version](https://img.shields.io/packagist/v/abaccor/php-api?style=flat-square)](https://packagist.org/packages/abaccor/php-api)
[![Total Downloads](https://img.shields.io/packagist/dt/abaccor/php-api?style=flat-square)](https://packagist.org/packages/abaccor/php-api)

## Instalación usando Composer

```sh
$ composer require abaccor/php-api
```

## Ejemplo

````
$abaccor = new \Abaccor\Abaccor('https://sandbox-api.abaccor.com/', '**********************');

$data = [/* ... */];

try{
    $response = $abaccor->GenerarCfdi33($data);
}catch(AbaccorException $e){
    //Ocurrió un error
}
````
