<?php

/*
 * This file is part of the ddd-symfony package.
 *
 * (c) Beñat Espiña <benatespina@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Domain\Model\User;

use Ddd\Domain\DomainEventPublisher;
use Domain\Event\User\UserRegistered;

/**
 * Class User.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class User
{
    /**
     * The user id.
     *
     * @var \Domain\Model\User\UserId
     */
    private $userId;

    /**
     * The user email address.
     *
     * @var \Domain\Model\User\UserEmail
     */
    private $email;

    /**
     * The password.
     *
     * @var string
     */
    private $password;

    /**
     * Constructor.
     *
     * @param \Domain\Model\User\UserId    $anId      The user id
     * @param \Domain\Model\User\UserEmail $anEmail   The email address
     * @param string                       $aPassword The password
     */
    public function __construct(UserId $anId, UserEmail $anEmail, $aPassword)
    {
        $this->userId = $anId;
        $this->email = $anEmail;
        $this->changePassword($aPassword);

        DomainEventPublisher::instance()->publish(new UserRegistered($this->userId));
    }

    /**
     * Gets the id.
     *
     * @return \Domain\Model\User\UserId
     */
    public function id()
    {
        return $this->userId;
    }

    /**
     * Gets the email.
     *
     * @return \Domain\Model\User\UserEmail
     */
    public function email()
    {
        return $this->email;
    }

    /**
     * Gets the password.
     *
     * @return string
     */
    public function password()
    {
        return $this->password;
    }

    /**
     * Changes the password for the password given.
     *
     * @param string $password The password
     *
     * @return self $this Domain\Model\User
     */
    public function changePassword($password)
    {
        $password = trim($password);
        if (!$password) {
            throw new \InvalidArgumentException('password');
        }
        $this->password = $password;

        return $this;
    }
}
