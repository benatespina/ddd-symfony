<?php

/*
 * This file is part of the ddd-symfony package.
 *
 * (c) Beñat Espiña <benatespina@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Infrastructure\Persistence\Sql\Repository\User;

use Domain\Model\User\User;
use Domain\Model\User\UserEmail;
use Domain\Model\User\UserId;
use Domain\Repository\User\UserRepository;
use Infrastructure\Persistence\Sql\SqlManager;

/**
 * Class UserRepository.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class SqlUserRepository implements UserRepository
{
    const TABLE_NAME = 'user';

    /**
     * The manager.
     *
     * @var \Infrastructure\Persistence\Sql\SqlManager
     */
    protected $pdo;

    /**
     * Constructor.
     *
     * @param \Infrastructure\Persistence\Sql\SqlManager $manager The manager
     */
    public function __construct(SqlManager $manager)
    {
        $this->pdo = $manager;
    }

    /**
     * {@inheritdoc}
     */
    public function remove(User $anUser)
    {
        $this->pdo->execute(
            sprintf('DELETE FROM %s WHERE id = :id', self::TABLE_NAME), ['id' => $anUser->id()->id()]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function userOfId(UserId $anId)
    {
        $statement = $this->pdo->execute(
            sprintf('SELECT * FROM %s WHERE id = :id', self::TABLE_NAME), ['id' => $anId->id()]
        );
        if ($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
            return $this->buildUser($row);
        }

        return;
    }

    /**
     * {@inheritdoc}
     */
    public function userOfEmail(UserEmail $anEmail)
    {
        $statement = $this->pdo->execute(
            sprintf('SELECT * FROM %s WHERE email = :email', self::TABLE_NAME), ['email' => $anEmail->getValue()]
        );
        if ($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
            return $this->buildUser($row);
        }

        return;
    }

    /**
     * {@inheritdoc}
     */
    public function query($specification)
    {
        if (!$specification instanceof SqlUserSpecification) {
            throw new \InvalidArgumentException('This argument must be a SQLUserSpecification');
        }

        return $this->retrieveAll(
            sprintf('SELECT * FROM %s WHERE %s', self::TABLE_NAME, $specification->toSqlClauses())
        );
    }

    /**
     * {@inheritdoc}
     */
    public function nextIdentity()
    {
        return new UserId();
    }

    /**
     * {@inheritdoc}
     */
    public function size()
    {
        return $this->pdo
            ->execute(sprintf('SELECT COUNT(*) FROM %s', self::TABLE_NAME))
            ->fetchColumn();
    }

    /**
     * Executes the sql given and returns the result in array of users.
     *
     * @param string $sql        The sql query
     * @param array  $parameters Array which contains the parameters
     *
     * @return array
     */
    private function retrieveAll($sql, array $parameters = [])
    {
        $statement = $this->pdo->execute($sql, $parameters);

        return array_map(function ($row) {
            return $this->buildUser($row);
        }, $statement->fetchAll(\PDO::FETCH_ASSOC));
    }

    /**
     * Builds an user object with the given sql row in array format.
     *
     * @param array $row The sql row in array format
     *
     * @return \Domain\Model\User\User
     */
    private function buildUser(array $row)
    {
        return new User(new UserId($row['id']), new UserEmail($row['email']), $row['password']);
    }
}
