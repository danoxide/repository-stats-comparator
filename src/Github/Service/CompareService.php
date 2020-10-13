<?php


namespace App\Github\Service;


use App\Github\Dto\RepositoryInfo;
use App\Github\Dto\Summary;
use App\Github\Dto\SummaryItem;

/**
 * Comparison service
 *
 * @package App\Github\Service
 * @author Piotr Filipek <piotrek290@gmail.com>
 */
class CompareService
{

    /**
     * Compare two repositories and return summary
     *
     * @param RepositoryInfo $first First repository info
     * @param RepositoryInfo $second Second repository info
     * @return Summary
     */
    public function compare(RepositoryInfo $first, RepositoryInfo $second): Summary
    {
        $firstRepositoryPopularity = $first->getSubscribers() + $first->getStars();
        $secondRepositoryPopularity = $second->getSubscribers() + $second->getStars();

        $firstRepositoryDevelopment = $first->getOpenPullRequests() + $first->getClosedPullRequests();
        $secondRepositoryDevelopment = $second->getOpenPullRequests() + $second->getClosedPullRequests();

        $popularity = new SummaryItem($firstRepositoryPopularity, $secondRepositoryPopularity);
        $development = new SummaryItem($firstRepositoryDevelopment, $secondRepositoryDevelopment);

        return new Summary($popularity, $development);
    }

}