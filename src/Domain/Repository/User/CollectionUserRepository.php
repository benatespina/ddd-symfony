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

/**
 * Interface CollectionUserRepository.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
interface CollectionUserRepository extends UserRepository
{
    /**
     * Adds the user given.
     *
     * @param \Domain\Model\User\User $anUser The user
     *
     * @return mixed
     */
    public function add(User $anUser);
}
