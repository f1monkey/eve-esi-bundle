<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Event;

use F1monkey\EveEsiBundle\ValueObject\RequestInterface;
use Symfony\Contracts\EventDispatcher\Event;

/**
 * Class RequestBeforeEvent
 *
 * @package F1monkey\EveEsiBundle\Event
 */
class RequestBeforeEvent extends Event
{
    /**
     * @var RequestInterface
     */
    protected RequestInterface $request;

    /**
     * @var array<string, mixed>
     */
    protected array $options;

    /**
     * RequestBeforeEvent constructor.
     *
     * @param RequestInterface $request
     * @param array<string, mixed>           $options
     */
    public function __construct(RequestInterface $request, array $options)
    {
        $this->request = $request;
        $this->options = $options;
    }

    /**
     * @return RequestInterface
     */
    public function getRequest(): RequestInterface
    {
        return $this->request;
    }

    /**
     * @return array<string, mixed>
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @param array<string, mixed> $options
     *
     * @return RequestBeforeEvent
     */
    public function setOptions(array $options): RequestBeforeEvent
    {
        $this->options = $options;

        return $this;
    }
}