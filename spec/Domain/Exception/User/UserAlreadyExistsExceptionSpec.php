<?php

/*
 * This file is part of the ddd-symfony package.
 *
 * (c) Beñat Espiña <benatespina@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Domain\Exception\User;

use PhpSpec\ObjectBehavior;

/**
 * Class UserAlreadyExistsExceptionSpec.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class UserAlreadyExistsExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Domain\Exception\User\UserAlreadyExistsException');
    }

    function it_extends_Exception()
    {
        $this->shouldHaveType('Exception');
    }
}
