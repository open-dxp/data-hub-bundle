<?php


namespace OpenDxp\Bundle\DataHubBundle\Event\GraphQL\Model;

use OpenDxp\Model\DataObject\OwnerAwareFieldInterface;
use OpenDxp\Model\Element\ElementInterface;
use Symfony\Contracts\EventDispatcher\Event;

class PermissionEvent extends Event
{
    /**
     * @var ElementInterface|OwnerAwareFieldInterface $element
     */
    protected $element;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var bool
     */
    protected $isGranted = true;

    /**
     * @return OwnerAwareFieldInterface|ElementInterface
     */
    public function getElement()
    {
        return $this->element;
    }

    /**
     * @param OwnerAwareFieldInterface|ElementInterface $element
     */
    public function setElement($element): void
    {
        $this->element = $element;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function isGranted(): bool
    {
        return $this->isGranted;
    }

    public function setIsGranted(bool $isGranted): void
    {
        $this->isGranted = $isGranted;
    }

    /**
     * @param ElementInterface|OwnerAwareFieldInterface $element
     * @param string $type
     */
    public function __construct($element, $type)
    {
        $this->element = $element;
        $this->type = $type;
    }
}
