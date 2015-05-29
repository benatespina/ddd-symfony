<?php

/*
 * This file is part of the ddd-symfony package.
 *
 * (c) Beñat Espiña <benatespina@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application\Service\User;

use Domain\Model\User\UserEmail;

/**
 * Class SignInUserRequest.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class SignInUserRequest
{
    /**
     * The user email.
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
     * @param \Domain\Model\User\UserEmail $email    The user email
     * @param string                       $password The password
     */
    public function __construct(UserEmail $email, $password)
    {
        $this->email = $email;
        $this->password = $password;
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
}
