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

namespace Runroom\TranslationBundle\Service;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Translation\TranslatorInterface;

class TranslationService
{
    private $repository;
    private $translator;

    public function __construct(EntityRepository $repository, TranslatorInterface $translator)
    {
        $this->repository = $repository;
        $this->translator = $translator;
    }

    public function translate(string $key, array $parameters = [], string $locale = null): string
    {
        $translation = $this->repository->findOneBy(['key' => $key]);

        if (null !== $translation) {
            return strtr($translation->translate($locale)->getValue(), $parameters);
        }

        return $this->translator->trans($key, $parameters, null, $locale);
    }
}
