<?php

declare(strict_types=1);

/*
 * This file is part of the TranslationBundle.
 *
 * (c) Runroom <runroom@runroom.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Runroom\TranslationBundle\Twig;

use Runroom\TranslationBundle\Service\TranslationService;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class TranslationExtension extends AbstractExtension
{
    private $service;

    public function __construct(TranslationService $service)
    {
        $this->service = $service;
    }

    public function getFilters(): array
    {
        return [
            new TwigFilter('translate', [$this, 'translate'], ['is_safe' => ['html']]),
        ];
    }

    public function translate(string $key, array $parameters = [], string $locale = null): string
    {
        return $this->service->translate($key, $parameters, $locale);
    }
}
