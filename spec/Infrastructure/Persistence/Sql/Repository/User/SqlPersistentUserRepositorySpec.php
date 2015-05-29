<?php

/*
 * This file is part of the ddd-symfony package.
 *
 * (c) Beñat Espiña <benatespina@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Infrastructure\Persistence\Sql\Repository\User;

use Domain\Model\User\User;
use Domain\Model\User\UserEmail;
use Domain\Model\User\UserId;
use Infrastructure\Persistence\Sql\Repository\User\SqlUserRepository;
use Infrastructure\Persistence\Sql\SqlManager;
use PhpSpec\ObjectBehavior;

/**
 * Class SqlPersistentUserRepositorySpec.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class SqlPersistentUserRepositorySpec extends ObjectBehavior
{
    function let(SqlManager $pdo)
    {
        $this->beConstructedWith($pdo);
    }

    function it_inserts(
        SqlManager $pdo,
        \PDOStatement $statement,
        User $user,
        UserId $userId,
        UserEmail $email
    ) {
        $user->id()->shouldBeCalled()->willReturn($userId);
        $userId->id()->shouldBeCalled()->willReturn('theid');
        $user->email()->shouldBeCalled()->willReturn($email);
        $email->getValue()->shouldBeCalled()->willReturn('ddd@symfony.com');
        $user->password()->shouldBeCalled()->willReturn('password');

        $pdo->execute(
            sprintf('SELECT COUNT(*) FROM %s WHERE id = :id', SqlUserRepository::TABLE_NAME), [':id' => 'theid']
        )->shouldBeCalled()->willReturn($statement);
        $statement->fetchColumn()->shouldBeCalled()->willReturn(0);

        $pdo->execute(
            sprintf(
                'INSERT INTO %s (id, email, password) VALUES (:id, :email, :password)', SqlUserRepository::TABLE_NAME
            ), ['id' => 'theid', 'email' => 'ddd@symfony.com', 'password' => 'password']
        )->shouldBeCalled()->willReturn($statement);

        $this->save($user);
    }

    function it_updates(
        SqlManager $pdo,
        \PDOStatement $statement,
        User $user,
        UserId $userId,
        UserEmail $email
    ) {
        $user->id()->shouldBeCalled()->willReturn($userId);
        $userId->id()->shouldBeCalled()->willReturn('theid');
        $user->email()->shouldBeCalled()->willReturn($email);
        $email->getValue()->shouldBeCalled()->willReturn('ddd@symfony.com');
        $user->password()->shouldBeCalled()->willReturn('password');

        $pdo->execute(
            sprintf('SELECT COUNT(*) FROM %s WHERE id = :id', SqlUserRepository::TABLE_NAME), [':id' => 'theid']
        )->shouldBeCalled()->willReturn($statement);
        $statement->fetchColumn()->shouldBeCalled()->willReturn(1);

        $pdo->execute(
            sprintf('UPDATE %s SET email = :email, password = :password WHERE id = :id', SqlUserRepository::TABLE_NAME),
            ['id' => 'theid', 'email' => 'ddd@symfony.com', 'password' => 'password']
        )->shouldBeCalled()->willReturn($statement);

        $this->save($user);
    }
}
