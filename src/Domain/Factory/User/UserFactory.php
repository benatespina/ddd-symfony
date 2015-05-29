<?php

/*
 * This file is part of the ddd-symfony package.
 *
 * (c) Beñat Espiña <benatespina@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Domain\Factory\User;

use Domain\Model\User\UserEmail;
use Domain\Model\User\UserId;

/**
 * Interface UserFactory.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
interface UserFactory
{
    /**
     * Creation method that registers a new user into domain.
     *
     * @param \Domain\Model\User\UserId    $anId      The user id
     * @param \Domain\Model\User\UserEmail $anEmail   The user email address
     * @param string                       $aPassword The password
     *
     * @return \Domain\Model\User\User
     */
    public function register(UserId $anId, UserEmail $anEmail, $aPassword);
}
