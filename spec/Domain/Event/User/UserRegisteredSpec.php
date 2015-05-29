<?php

/*
 * This file is part of the ddd-symfony package.
 *
 * (c) Beñat Espiña <benatespina@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Domain\Event\User;

use Domain\Model\User\UserId;
use PhpSpec\ObjectBehavior;

/**
 * Class UserRegisteredSpec.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class UserRegisteredSpec extends ObjectBehavior
{
    function let(UserId $userId)
    {
        $this->beConstructedWith($userId);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Domain\Event\User\UserRegistered');
    }

    function it_implements_DomainEvent()
    {
        $this->shouldImplement('Ddd\Domain\DomainEvent');
    }

    function its_user_id(UserId $userId)
    {
        $this->userId()->shouldReturn($userId);
    }

    function its_occurred_on()
    {
        $this->occurredOn()->shouldBeLike(new \DateTime());
    }
}
