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
use Domain\Repository\User\PersistentUserRepository;

/**
 * Class SqlPersistentUserRepository.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class SqlPersistentUserRepository extends SqlUserRepository implements PersistentUserRepository
{
    /**
     * {@inheritdoc}
     */
    public function save(User $anUser)
    {
        $this->exist($anUser) ? $this->update($anUser) : $this->insert($anUser);
    }

    /**
     * Checks that the user given exists into database.
     *
     * @param \Domain\Model\User\User $anUser The user
     *
     * @return bool
     */
    private function exist(User $anUser)
    {
        return $this->pdo->execute(
            sprintf('SELECT COUNT(*) FROM %s WHERE id = :id', self::TABLE_NAME),
            [':id' => $anUser->id()->id()]
        )->fetchColumn() == 1;
    }

    /**
     * Inserts the user given into database.
     *
     * @param \Domain\Model\User\User $anUser The user
     */
    private function insert(User $anUser)
    {
        $this->pdo->execute(
            sprintf('INSERT INTO %s (id, email, password) VALUES (:id, :email, :password)', self::TABLE_NAME),
            ['id' => $anUser->id()->id(), 'email' => $anUser->email()->getValue(), 'password' => $anUser->password()]
        );
    }

    /**
     * Updates the user given into database.
     *
     * @param \Domain\Model\User\User $anUser The user
     */
    private function update(User $anUser)
    {
        $this->pdo->execute(
            sprintf('UPDATE %s SET email = :email, password = :password WHERE id = :id', self::TABLE_NAME),
            ['id' => $anUser->id()->id(), 'email' => $anUser->email()->getValue(), 'password' => $anUser->password()]
        );
    }
}
