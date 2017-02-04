<?php

namespace Karhabty\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class KarhabtyUserBundle extends Bundle
{


    public function getParent()
    {
        return 'FOSUserBundle';
    }

}
