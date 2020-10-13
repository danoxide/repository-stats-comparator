<?php


namespace App\Github\Service;


use App\Github\Dto\Repository;
use function count;
use App\Github\Dto\RepositoryInfo;
use App\Github\PullRequestState;
use Psr\Container\ContainerInterface;
use DateTimeImmutable;
use DateTimeInterface;
use Github\Client;

/**
 * Service to fetching data about the repository,
 * such as amount of subscribers, stars, pull requests, watchers
 * or latest release date.
 *
 * @package App\Github\Service
 * @author Piotr Filipek <piotrek290@gmail.com>
 */
class GithubService
{

    /**
     * @var Client Github client
     */
    private Client $client;

    /**
     * GithubService constructor.
     *
     * @param ContainerInterface $container Container
     * @param Client $client Github client
     */
    public function __construct(ContainerInterface $container, Client $client)
    {
        $client->authenticate(
            $container->getParameter('github.secret'),
            null,
            Client::AUTH_ACCESS_TOKEN
        );

        $this->client = $client;
    }

    /**
     * Fetch repository data from GitHub and returns filled RepositoryInfo object
     *
     * @param Repository $repositoryDto Repository
     * @return RepositoryInfo
     * @throws \Exception
     */
    public function fetch(Repository $repositoryDto): RepositoryInfo
    {
        $username = $repositoryDto->getUsername();
        $repository = $repositoryDto->getRepository();

        $result = $this->show($username, $repository);
        $latestRelease = $this->latestRelease($username, $repository);
        $openPullRequests = $this->pulls($username, $repository, PullRequestState::OPEN);
        $closedPullRequests = $this->pulls($username, $repository, PullRequestState::CLOSED);

        return new RepositoryInfo(
            $repositoryDto,
            $result['subscribers_count'],
            $result['forks_count'],
            $result['stargazers_count'],
            $openPullRequests,
            $closedPullRequests,
            $latestRelease
        );
    }

    /**
     * @param string $username Username
     * @param string $repository Repository
     * @return array
     */
    public function show(string $username, string $repository): array
    {
        return $this->client
            ->api('repository')
            ->show($username, $repository);
    }

    /**
     * Get number of pull requests
     *
     * @param string $username Username
     * @param string $repository Repository
     * @param string $state State
     * @return int
     */
    public function pulls(string $username, string $repository, string $state): int
    {
        $params = [
            'state' => $state,
            'per_page' => $this->getMaxPerPage(),
            'page' => 1
        ];

        $count = 0;
        $hasNext = true;

        while ($hasNext) {
            $results = $this->client
                ->api('pulls')
                ->all($username, $repository, $params);

            ++$params['page'];
            $count += count($results);
            $currentCount = count($results);

            $hasNext = $currentCount == $params['per_page'];
        }

        return $count;
    }

    /**
     * Get latest release date
     *
     * @param string $username Username
     * @param string $repository Repository
     * @return DateTimeInterface|null
     * @throws \Exception
     */
    public function latestRelease(string $username, string $repository): ?DateTimeInterface
    {
        try {
            $result = $this->client
                ->api('repo')
                ->releases()
                ->latest($username, $repository);

            return new DateTimeImmutable($result['published_at']);

        } catch (\RuntimeException $exception) {
            return null;
        }
    }

    /**
     * Max value for "per_page" key
     *
     * @return int
     */
    private function getMaxPerPage(): int
    {
        return 100;
    }

}