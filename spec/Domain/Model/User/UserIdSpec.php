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

use Domain\Model\User\UserId;
use PhpSpec\ObjectBehavior;

/**
 * Class UserId.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class UserIdSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('theid');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Domain\Model\User\UserId');
    }

    function its_id()
    {
        $this->id()->shouldReturn('theid');
    }

    function it_should_not_be_equals(UserId $userId)
    {
        $userId->id()->shouldBeCalled()->willReturn('otherid');

        $this->equals($userId)->shouldReturn(false);
    }

    function it_should_be_equals(UserId $userId)
    {
        $userId->id()->shouldBeCalled()->willReturn('theid');

        $this->equals($userId)->shouldReturn(true);
    }

    function its_to_string()
    {
        $this->__toString()->shouldReturn('theid');
    }
}
