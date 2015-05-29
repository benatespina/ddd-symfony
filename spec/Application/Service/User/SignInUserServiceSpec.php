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

use Application\Service\User\SignInUserRequest;
use Domain\Exception\User\UserAlreadyExistsException;
use Domain\Factory\User\UserFactory;
use Domain\Model\User\User;
use Domain\Model\User\UserEmail;
use Domain\Model\User\UserId;
use Domain\Repository\User\PersistentUserRepository;
use Domain\Repository\User\UserRepository;
use PhpSpec\ObjectBehavior;

/**
 * Class SignInUserServiceSpec.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class SignInUserServiceSpec extends ObjectBehavior
{
    function let(PersistentUserRepository $repository, UserFactory $factory)
    {
        $this->beConstructedWith($repository, $factory);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Application\Service\User\SignInUserService');
    }

    function it_implements_ApplicationService()
    {
        $this->shouldImplement('Ddd\Application\Service\ApplicationService');
    }

    function it_does_not_register_because_the_request_is_not_SignInUserRequest_instance()
    {
        $this->shouldThrow(
            new \InvalidArgumentException('The request must be SignInUserRequest instance')
        )->during('execute', [null]);
    }

    function it_does_not_register_because_the_user_is_already_exists(
        SignInUserRequest $request,
        UserEmail $email,
        UserRepository $repository,
        User $user
    ) {
        $request->email()->shouldBeCalled()->willReturn($email);
        $request->password()->shouldBeCalled()->willReturn('password');

        $repository->userOfEmail($email)->shouldBeCalled()->willReturn($user);

        $this->shouldThrow(new UserAlreadyExistsException())->during('execute', [$request]);
    }

    function it_registers_the_user(
        SignInUserRequest $request,
        UserEmail $email,
        PersistentUserRepository $repository,
        User $user,
        UserFactory $factory,
        UserId $userId
    ) {
        $request->email()->shouldBeCalled()->willReturn($email);
        $request->password()->shouldBeCalled()->willReturn('password');

        $repository->userOfEmail($email)->shouldBeCalled()->willReturn(null);
        $repository->nextIdentity()->shouldBeCalled()->willReturn($userId);
        $factory->register($userId, $email, 'password')->shouldBeCalled()->willReturn($user);
        $repository->save($user)->shouldBeCalled();

        $this->execute($request)->shouldReturn($user);
    }
}
