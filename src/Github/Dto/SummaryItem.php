<?php


namespace App\Github\Dto;


use function abs;

/**
 * Summary item that keeps repositories values from comparison
 *
 * @package App\Github\Dto
 * @author Piotr Filipek <piotrek290@gmail.com>
 */
class SummaryItem
{

    /**
     * @var int First repository value
     */
    private int $firstRepositoryValue;

    /**
     * @var int Second repository value
     */
    private int $secondRepositoryValue;

    /**
     * SummaryItem constructor.
     *
     * @param int $firstRepositoryValue First repository value
     * @param int $secondRepositoryValue Second repository value
     */
    public function __construct(int $firstRepositoryValue, int $secondRepositoryValue)
    {
        $this->firstRepositoryValue = $firstRepositoryValue;
        $this->secondRepositoryValue = $secondRepositoryValue;
    }

    /**
     * Get first repository value
     *
     * @return int
     */
    public function getFirstRepositoryValue(): int
    {
        return $this->firstRepositoryValue;
    }

    /**
     * Get second repository value
     *
     * @return int
     */
    public function getSecondRepositoryValue(): int
    {
        return $this->secondRepositoryValue;
    }

    /**
     * Get diff between first and second repository
     *
     * @return int
     */
    public function getDiff(): int
    {
        return abs($this->firstRepositoryValue - $this->secondRepositoryValue);
    }

    /**
     * If first repository value is greater than second repository value
     *
     * @return bool
     */
    public function isFirstGreater(): bool
    {
        return $this->firstRepositoryValue > $this->secondRepositoryValue;
    }

}