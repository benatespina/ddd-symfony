<?php

/*
 * This file is part of the ddd-symfony package.
 *
 * (c) Beñat Espiña <benatespina@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Domain\Repository\User;

use Domain\Model\User\User;
use Domain\Model\User\UserEmail;
use Domain\Model\User\UserId;

/**
 * Interface UserRepository.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
interface UserRepository
{
    /**
     * Removes the user given.
     *
     * @param \Domain\Model\User\User $anUser The user
     *
     * @return mixed
     */
    public function remove(User $anUser);

    /**
     * Gets the user of id given.
     *
     * @param \Domain\Model\User\UserId $anId The user id
     *
     * @return mixed
     */
    public function userOfId(UserId $anId);

    /**
     * Gets the user of email given.
     *
     * @param \Domain\Model\User\UserEmail $anEmail The user email
     *
     * @return mixed
     */
    public function userOfEmail(UserEmail $anEmail);

    /**
     * Gets the user/users that match with the given criteria.
     *
     * @param mixed $specification The specification criteria
     *
     * @return mixed
     */
    public function query($specification);

    /**
     * Returns the next available id.
     *
     * @return \Domain\Model\User\UserId
     */
    public function nextIdentity();

    /**
     * Counts the number of users.
     *
     * @return mixed
     */
    public function size();
}
