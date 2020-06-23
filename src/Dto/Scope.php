<?php
declare(strict_types=1);

namespace F1Monkey\EveEsiBundle\Dto;

use Stringable;

/**
 * Class Scope
 *
 * @package App\EveApi\Dto
 */
class Scope implements Stringable
{
    /**
     * @var string
     */
    protected string $code;

    /**
     * Scope constructor.
     *
     * @param string $code
     */
    public function __construct(string $code)
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getCode();
    }
}