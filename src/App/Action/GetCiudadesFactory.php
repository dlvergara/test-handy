<?php

namespace App\Action;

use Interop\Container\ContainerInterface;

class GetCiudadesFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $em = $container->get('doctrine.entity_manager.orm_default');
        return new GetCiudadesAction($em);
    }
}
