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

use Rhumsaa\Uuid\Uuid;

/**
 * Class UserId.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class UserId
{
    /**
     * The string of id.
     *
     * @var string
     */
    private $id;

    /**
     * Constructor.
     *
     * @param string $anId The string of id
     */
    public function __construct($anId = null)
    {
        $this->id = null === $anId ? Uuid::uuid4()->toString() : $anId;
    }

    /**
     * Gets the id.
     *
     * @return string
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * Method that checks if the user id given is equal to the current.
     *
     * @param \Domain\Model\User\UserId $anId The user id
     *
     * @return bool
     */
    public function equals(UserId $anId)
    {
        return $this->id() === $anId->id();
    }

    /**
     * Magic method that represent the class in string format.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->id();
    }
}
