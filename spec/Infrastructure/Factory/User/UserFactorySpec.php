<?php

/*
 * This file is part of the ddd-symfony package.
 *
 * (c) Beñat Espiña <benatespina@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Infrastructure\Factory\User;

use Domain\Model\User\UserEmail;
use Domain\Model\User\UserId;
use PhpSpec\ObjectBehavior;

/**
 * Class UserFactorySpec.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class UserFactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Infrastructure\Factory\User\UserFactory');
    }

    function it_implements_UserFactory()
    {
        $this->shouldImplement('Domain\Factory\User\UserFactory');
    }

    function it_register(UserId $userId, UserEmail $email)
    {
        $this->register($userId, $email, 'password')->shouldReturnAnInstanceOf('Domain\Model\User\User');
    }
}
