<?php

/*
 * This file is part of the ddd-symfony package.
 *
 * (c) Beñat Espiña <benatespina@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Application\Service\User;

use Domain\Model\User\UserEmail;
use PhpSpec\ObjectBehavior;

/**
 * Class SignInUserRequestSpec.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class SignInUserRequestSpec extends ObjectBehavior
{
    function let(UserEmail $email)
    {
        $this->beConstructedWith($email, 'password');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Application\Service\User\SignInUserRequest');
    }

    function its_email(UserEmail $email)
    {
        $this->email()->shouldReturn($email);
    }

    function its_password()
    {
        $this->password()->shouldReturn('password');
    }
}
