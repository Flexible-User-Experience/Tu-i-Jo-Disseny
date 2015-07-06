<?php

namespace AppBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class AppBundle extends Bundle
{
    /**
     * Get SonataUserBundle parent
     *
     * @return string
     */
    public function getParent()
    {
        return 'SonataUserBundle';
    }
}
