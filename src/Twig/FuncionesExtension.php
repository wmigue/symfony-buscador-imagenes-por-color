<?php

namespace App\Twig;

use App\Entity\Imagenes;
use App\Entity\Users;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class FuncionesExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/3.x/advanced.html#automatic-escaping
            new TwigFilter('filter_name', [$this, 'doSomething']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('miFuncion', [$this, 'miFuncion']),
        ];
    }

    public function miFuncion(Imagenes $img)
    {
        $url=$img->getUrl();
        return $url;
    }
}




