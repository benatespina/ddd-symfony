<?php

/*
 * This file is part of the ddd-symfony package.
 *
 * (c) Beñat Espiña <benatespina@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Domain\Event\User;

use Ddd\Domain\DomainEvent;
use Domain\Model\User\UserId;

/**
 * Class UserRegistered.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class UserRegistered implements DomainEvent
{
    /**
     * The user id.
     *
     * @var \Domain\Model\User\UserId
     */
    private $userId;

    /**
     * Constructor.
     *
     * @param \Domain\Model\User\UserId $anId The user id
     */
    public function __construct(UserId $anId)
    {
        $this->userId = $anId;
        $this->occurredOn = new \DateTime();
    }

    /**
     * Gets the user id.
     *
     * @return \Domain\Model\User\UserId
     */
    public function userId()
    {
        return $this->userId;
    }

    /**
     * Gets the occurred on.
     *
     * @return \DateTime
     */
    public function occurredOn()
    {
        return $this->occurredOn;
    }
}
