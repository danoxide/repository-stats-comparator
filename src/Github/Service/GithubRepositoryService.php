<?php


namespace App\Github\Service;


use App\Github\Dto\Repository;
use App\Github\Dto\RepositoryInfo;

/**
 * Class GithubRepositoryService
 *
 * @package App\Github
 * @author Piotr Filipek <piotrek290@gmail.com>
 */
class GithubRepositoryService
{

    /**
     * @var GithubService Github service
     */
    private GithubService $githubService;

    /**
     * RepositoryComparatorService constructor.
     *
     * @param GithubService $githubService
     */
    public function __construct(GithubService $githubService)
    {
        $this->githubService = $githubService;
    }

    /**
     * Prepare repository data
     *
     * @param Repository $repository Repository
     * @return RepositoryInfo
     * @throws \Exception
     */
    public function prepare(Repository $repository): RepositoryInfo
    {
        return $this->githubService->fetch(
            $repository,
            $repository->getUsername(),
            $repository->getRepository()
        );
    }

}