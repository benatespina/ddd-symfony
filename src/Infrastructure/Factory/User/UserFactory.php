<?php

/*
 * This file is part of the ddd-symfony package.
 *
 * (c) Beñat Espiña <benatespina@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Infrastructure\Factory\User;

use Domain\Model\User\User;
use Domain\Model\User\UserEmail;
use Domain\Model\User\UserId;
use Domain\Factory\User\UserFactory as BaseUserFactory;

/**
 * Class UserFactory.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class UserFactory implements BaseUserFactory
{
    /**
     * {@inheritdoc}
     */
    public function register(UserId $anId, UserEmail $anEmail, $aPassword)
    {
        return new User($anId, $anEmail, $aPassword);
    }
}
