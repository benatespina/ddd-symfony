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

use Domain\Model\User\UserEmail;
use Domain\Model\User\UserId;
use PhpSpec\ObjectBehavior;

/**
 * Class User.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class UserSpec extends ObjectBehavior
{
    function let(UserId $userId, UserEmail $email)
    {
        $this->beConstructedWith($userId, $email, 'password');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Domain\Model\User\User');
    }

    function its_id(UserId $userId)
    {
        $this->id()->shouldReturn($userId);
    }

    function its_email(UserEmail $email)
    {
        $this->email()->shouldReturn($email);
    }

    function its_password()
    {
        $this->password()->shouldReturn('password');
    }

    function it_does_not_change_the_password_because_it_is_invalid_password()
    {
        $this->shouldThrow(new \InvalidArgumentException('password'))->during('changePassword', [' ']);
    }

    function it_changes_the_password()
    {
        $this->changePassword('newpassword')->shouldReturn($this);
        $this->password()->shouldReturn('newpassword');
    }
}
