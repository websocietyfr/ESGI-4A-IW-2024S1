<?php

namespace App\Twig\Extension;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class PriceExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/3.x/advanced.html#automatic-escaping
            new TwigFilter('price', [$this, 'priceFilter']),
        ];
    }

    public function priceFilter(float $price, int $decimals = 2, String $dec_point = '.', String $thousands_sep = ' '): String
    {
        $price = number_format($price, $decimals, $dec_point, $thousands_sep);
        $price = $price . ' €';
        return $price;
    }
}
