<?php

namespace Config;

use Swagger\Swagger;

class SwaggerConfig
{
    public function __construct()
    {
        $this->swagger = new Swagger();
        $this->swagger->setTitle('API Documentation');
        $this->swagger->setDescription('Dokumentasi untuk API PoinMarket');
        $this->swagger->setVersion('1.0.0');
    }
}