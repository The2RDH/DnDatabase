<?php

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;
    public function getCacheDir(): string
    {
        return '/dev/shm/symfony/cache/' . $this->getEnvironment();
    }

    public function getLogDir(): string
    {
        return '/dev/shm/symfony/log';
    }
}
