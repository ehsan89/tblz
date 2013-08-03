<?php

namespace Tabloz\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class TablozUserBundle extends Bundle
{
    public function getParent()
    {
        return 'SonataUserBundle';
    }
}
