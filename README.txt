1) Symfony 4 Api install

composer create-project symfony/skeleton my_project

composer require monolog 

composer require doctrine

composer require "lexik/jwt-authentication-bundle" 
(https://github.com/lexik/LexikJWTAuthenticationBundle/blob/master/Resources/doc/index.md#installation)

composer require ramsey/uuid-doctrine -vvv
(https://github.com/ramsey/uuid)

2) Generar clave privada y publica

$> mkdir config/jwt
$> cd config/jwt
$> openssl genrsa -out private.pem -aes256 4096 
    Nos pide clave ingresar la que colocamos en JWT_PASSPHRASE=mprod dentro del .env del proyecto

$> openssl rsa -pubout -in private.pem -out public.pem
    Nos pide clave ingresar la misma clave que arriba "mprod"

3) Una vez generado ejecutar el siguiente comando para validar la configuracion
    php bin/console lexik:jwt:check-config

    Salida OK: The configuration seems correct.
