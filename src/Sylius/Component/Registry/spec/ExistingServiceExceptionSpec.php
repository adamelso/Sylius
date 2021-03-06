<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Sylius\Component\Registry;

use PhpSpec\ObjectBehavior;

/**
 * @author Saša Stamenković <umpirsky@gmail.com>
 */
class ExistingServiceExceptionSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('Service', 'foo');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Sylius\Component\Registry\ExistingServiceException');
    }

    function it_is_an_exception()
    {
        $this->shouldHaveType(\Exception::class);
    }

    function it_is_an_invalid_argument_exception()
    {
        $this->shouldHaveType('InvalidArgumentException');
    }
}
