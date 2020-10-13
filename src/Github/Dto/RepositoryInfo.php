<?php


namespace App\Github\Dto;


use DateTimeInterface;
use JsonSerializable;

/**
 * RepositoryInfo keeps repository data, such as subscribers, forks, stars, etc.
 *
 * @package App\Github\Dto
 * @author Piotr Filipek <piotrek290@gmail.com>
 */
class RepositoryInfo implements JsonSerializable
{

    /**
     * @var Repository Repository
     */
    private Repository $repository;

    /**
     * @var int Number of subscribers
     */
    private int $subscribers;

    /**
     * @var int Number of forks
     */
    private int $forks;

    /**
     * @var int Number of stars
     */
    private int $stars;

    /**
     * @var int Number of open pull requests
     */
    private int $openPullRequests;

    /**
     * @var int Number of closed pull requests
     */
    private int $closedPullRequests;

    /**
     * @var DateTimeInterface|null
     */
    private ?DateTimeInterface $latestRelease;

    /**
     * RepositoryInfo constructor.
     *
     * @param Repository $repository Repository
     * @param int $subscribers Number of subscribers
     * @param int $forks Number of forks
     * @param int $stars Number of stars
     * @param int $openPullRequests Number of open pull requests
     * @param int $closedPullRequests Number of closed pull requests
     * @param DateTimeInterface|null $latestRelease Latest release date
     */
    public function __construct(
        Repository $repository,
        int $subscribers,
        int $forks,
        int $stars,
        int $openPullRequests,
        int $closedPullRequests,
        ?DateTimeInterface $latestRelease
    ) {
        $this->repository = $repository;
        $this->subscribers = $subscribers;
        $this->forks = $forks;
        $this->stars = $stars;
        $this->openPullRequests = $openPullRequests;
        $this->closedPullRequests = $closedPullRequests;
        $this->latestRelease = $latestRelease;
    }

    /**
     * @return int
     */
    public function getSubscribers(): int
    {
        return $this->subscribers;
    }

    /**
     * @return int
     */
    public function getForks(): int
    {
        return $this->forks;
    }

    /**
     * @return int
     */
    public function getStars(): int
    {
        return $this->stars;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getLatestRelease(): ?DateTimeInterface
    {
        return $this->latestRelease;
    }

    /**
     * @return int
     */
    public function getClosedPullRequests(): int
    {
        return $this->closedPullRequests;
    }

    /**
     * @return int
     */
    public function getOpenPullRequests(): int
    {
        return $this->openPullRequests;
    }

    /**
     * @return Repository
     */
    public function getRepository(): Repository
    {
        return $this->repository;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'repository' => $this->repository,
            'subscribers' => $this->subscribers,
            'forks' => $this->forks,
            'stars' => $this->stars,
            'latest_release' => $this->latestRelease,
            'open_pull_requests' => $this->openPullRequests,
            'closed_pull_requests' => $this->closedPullRequests,
        ];
    }

}