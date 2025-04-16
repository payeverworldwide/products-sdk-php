<?php

/**
 * PHP version 5.6 and 8
 *
 * @category  Action
 * @package   Payever\ThirdParty
 * @author    payever GmbH <service@payever.de>
 * @copyright 2017-2024 payever GmbH
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      https://docs.payever.org/api/payments/v3/getting-started-v3
 */

namespace Payever\Sdk\ThirdParty\Action;

use Payever\Sdk\Core\Base\MessageEntity;

/**
 * This class represents ActionResult
 * The ActionResult class encapsulates the results of an action operations
 *
 * @method int      getCreatedCount()
 * @method int      getUpdatedCount()
 * @method int      getDeletedCount()
 * @method int      getSkippedCount()
 * @method string[] getErrors();
 */
class ActionResult extends MessageEntity
{
    /** @var int $createdCount */
    protected $createdCount = 0;

    /** @var int $updatedCount */
    protected $updatedCount = 0;

    /** @var int $deletedCount */
    protected $deletedCount = 0;

    /** @var int $skippedCount */
    protected $skippedCount = 0;

    /** @var string[] $errors */
    protected $errors = [];

    /**
     * @return $this
     */
    public function incrementCreated()
    {
        $this->createdCount++;

        return $this;
    }

    /**
     * @return $this
     */
    public function incrementUpdated()
    {
        $this->updatedCount++;

        return $this;
    }

    /**
     * @return $this
     */
    public function incrementDeleted()
    {
        $this->deletedCount++;

        return $this;
    }

    /**
     * @return $this
     */
    public function incrementSkipped()
    {
        $this->skippedCount++;

        return $this;
    }

    /**
     * @return int
     */
    public function getErrorsCount()
    {
        return count($this->errors);
    }

    /**
     * @param string $error
     *
     * @return $this
     */
    public function addError($error)
    {
        $this->errors[] = $error;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasErrors()
    {
        return !empty($this->errors);
    }

    /**
     * @param \Exception $exception
     *
     * @return $this
     */
    public function addException(\Exception $exception)
    {
        $this->addError($exception->getMessage());

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toString()
    {
        return sprintf(
            "%s: [created=%d] [updated=%d] [deleted=%d] [skipped=%d] [errors=%d]",
            'Result',
            $this->getCreatedCount(),
            $this->getUpdatedCount(),
            $this->getDeletedCount(),
            $this->getSkippedCount(),
            $this->getErrorsCount()
        );
    }
}
