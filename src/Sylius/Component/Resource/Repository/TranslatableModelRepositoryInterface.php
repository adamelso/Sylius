<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Component\Resource\Repository;

use Sylius\Component\Resource\Repository\RepositoryInterface;
use Sylius\Component\Locale\Context\LocaleContextInterface;

/**
 * @author Gonzalo Vilaseca <gvilaseca@reiss.co.uk>
 */
interface TranslatableModelRepositoryInterface extends RepositoryInterface
{
    /**
     * Sets the locale context
     *
     * @param LocaleContextInterface $localeContext
     *
     * @return TranslatableModelRepositoryInterface
     */
    public function setLocaleContext(LocaleContextInterface $localeContext);

    /**
     * Sets the translatable fields
     *
     * @param array $translatableFields
     *
     * @return TranslatableModelRepositoryInterface
     */
    public function setTranslatableFields(array $translatableFields);
}
