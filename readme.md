<p align="center"><img src="http://www.code-jr.com.ar/img/code.jpg"></p>

# Integración de Mercado Libre para Laravel 5.8

> Se propone integrar la API de Mercado Libre en Laravel de una forma práctica, legible, y normalizado.

## Requisitos
Detallaremos los primeros pasos a saberse antes de implementar la *API de Mercado Libre*

### Registrar nuestra APP en Mercado Libre

Lo primero que hay que hacer es registrarse en Mercado Libre (si no tenes cuenta), y luego registrar la App, que vamos a crear
<a href="https://developers.mercadolibre.com.ar/es_ar/api-docs-es/" target="_blank"> Guia paso a paso </a>

### Primeros pasos

> Configurar los siguientes parametros luego de registrar la App.

* ID de la App: api key provista por ML.
* Key Secret: key provista por ML.
* Redirección: es donde va a redireccionar una vez logueado en ML.

Esto lo vamos a configurar en el archivo *ml.php* ubicado en **config/ml.php**