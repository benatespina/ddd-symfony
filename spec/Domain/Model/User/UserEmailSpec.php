<?php

/*
 * This file is part of the ddd-symfony package.
 *
 * (c) Beñat Espiña <benatespina@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Domain\Model\User;

use PhpSpec\ObjectBehavior;

/**
 * Class UserEmailSpec.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class UserEmailSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('ddd@symfony.com');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Domain\Model\User\UserEmail');
    }

    function it_extends_EmailAddress()
    {
        $this->shouldHaveType('Email\EmailAddress');
    }
}
