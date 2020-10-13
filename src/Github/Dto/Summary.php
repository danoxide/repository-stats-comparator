<?php


namespace App\Github\Dto;


/**
 * Comparison summary
 *
 * @package App\Github\Dto
 * @author Piotr Filipek <piotrek290@gmail.com>
 */
class Summary
{

    /**
     * @var SummaryItem Repositories popularity
     */
    private SummaryItem $popularity;

    /**
     * @var SummaryItem Repositories development
     */
    private SummaryItem $development;

    /**
     * Summary constructor.
     *
     * @param SummaryItem $popularity Repositories popularity
     * @param SummaryItem $development Repositories development
     */
    public function __construct(SummaryItem $popularity, SummaryItem $development)
    {
        $this->popularity = $popularity;
        $this->development = $development;
    }

    /**
     * Get repositories popularity
     *
     * @return SummaryItem
     */
    public function getPopularity(): SummaryItem
    {
        return $this->popularity;
    }

    /**
     * Get repositories development
     *
     * @return SummaryItem
     */
    public function getDevelopment(): SummaryItem
    {
        return $this->development;
    }

}