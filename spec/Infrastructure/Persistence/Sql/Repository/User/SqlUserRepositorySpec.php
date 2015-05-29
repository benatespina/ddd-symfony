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
use Infrastructure\Persistence\Sql\Repository\User\SqlUserSpecification;
use Infrastructure\Persistence\Sql\SqlManager;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class SqlUserRepositorySpec.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class SqlUserRepositorySpec extends ObjectBehavior
{
    function let(SqlManager $pdo)
    {
        $this->beConstructedWith($pdo);
    }

    function it_removes(SqlManager $pdo, \PDOStatement $statement, User $user, UserId $userId)
    {
        $user->id()->shouldBeCalled()->willReturn($userId);
        $userId->id()->shouldBeCalled()->willReturn('theid');

        $pdo->execute(
            sprintf('DELETE FROM %s WHERE id = :id', SqlUserRepository::TABLE_NAME), ['id' => 'theid']
        )->shouldBeCalled()->willReturn($statement);

        $this->remove($user);
    }

    function its_user_of_id_when_it_does_not_exist(SqlManager $pdo, \PDOStatement $statement, UserId $userId)
    {
        $userId->id()->shouldBeCalled()->willReturn('theid');

        $pdo->execute(
            sprintf('SELECT * FROM %s WHERE id = :id', SqlUserRepository::TABLE_NAME), ['id' => 'theid']
        )->shouldBeCalled()->willReturn($statement);

        $statement->fetch(\PDO::FETCH_ASSOC)->shouldBeCalled()->willReturn(0);

        $this->userOfId($userId)->shouldReturn(null);
    }

    function its_user_of_id(SqlManager $pdo, \PDOStatement $statement, UserId $userId)
    {
        $userId->id()->shouldBeCalled()->willReturn('theid');

        $pdo->execute(
            sprintf('SELECT * FROM %s WHERE id = :id', SqlUserRepository::TABLE_NAME), ['id' => 'theid']
        )->shouldBeCalled()->willReturn($statement);

        $statement->fetch(\PDO::FETCH_ASSOC)->shouldBeCalled()->willReturn(
            ['id' => 'theid', 'email' => 'ddd@symfony.com', 'password' => 'password']
        );

        $this->userOfId($userId)->shouldReturnAnInstanceOf('Domain\Model\User\User');
    }

    function its_user_of_email_when_it_does_not_exist(SqlManager $pdo, \PDOStatement $statement, UserEmail $email)
    {
        $email->getValue()->shouldBeCalled()->willReturn('ddd@symfony.com');

        $pdo->execute(
            sprintf('SELECT * FROM %s WHERE email = :email', SqlUserRepository::TABLE_NAME),
            ['email' => 'ddd@symfony.com']
        )->shouldBeCalled()->willReturn($statement);

        $statement->fetch(\PDO::FETCH_ASSOC)->shouldBeCalled()->willReturn(0);

        $this->userOfEmail($email)->shouldReturn(null);
    }

    function its_user_of_email(SqlManager $pdo, \PDOStatement $statement, UserEmail $email)
    {
        $email->getValue()->shouldBeCalled()->willReturn('ddd@symfony.com');

        $pdo->execute(
            sprintf('SELECT * FROM %s WHERE email = :email', SqlUserRepository::TABLE_NAME),
            ['email' => 'ddd@symfony.com']
        )->shouldBeCalled()->willReturn($statement);

        $statement->fetch(\PDO::FETCH_ASSOC)->shouldBeCalled()->willReturn(
            ['id' => 'theid', 'email' => 'ddd@symfony.com', 'password' => 'password']
        );

        $this->userOfEmail($email)->shouldReturnAnInstanceOf('Domain\Model\User\User');
    }

    function its_query_when_the_specification_is_not_a_sql_user_specification()
    {
        $this->shouldThrow(new \InvalidArgumentException('This argument must be a SQLUserSpecification'))
            ->during('query', [Argument::not('Infrastructure\Persistence\Sql\Repository\User\SqlUserSpecification')]);
    }

    function its_query(SqlManager $pdo, \PDOStatement $statement, SqlUserSpecification $specification)
    {
        $specification->toSqlClauses()->shouldBeCalled()->willReturn('1 = 1');
        $pdo->execute(
            sprintf('SELECT * FROM %s WHERE %s', SqlUserRepository::TABLE_NAME, '1 = 1'), []
        )->shouldBeCalled()->willReturn($statement);

        $statement->fetchAll(\PDO::FETCH_ASSOC)->shouldBeCalled()->willReturn(
            [['id' => 'theid', 'email' => 'ddd@symfony.com', 'password' => 'password']]
        );

        $this->query($specification);
    }

    function its_next_identity()
    {
        $this->nextIdentity()->shouldReturnAnInstanceOf('Domain\Model\User\UserId');
    }

    function its_size(SqlManager $pdo, \PDOStatement $statement, SqlUserSpecification $specification)
    {
        $pdo->execute(
            sprintf('SELECT COUNT(*) FROM %s', SqlUserRepository::TABLE_NAME)
        )->shouldBeCalled()->willReturn($statement);

        $statement->fetchColumn()->shouldBeCalled()->willReturn(2);

        $this->size()->shouldReturn(2);
    }
}
