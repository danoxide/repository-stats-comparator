<?php


namespace App\Tests;


use App\Github\Dto\Repository;
use DateTime;
use App\Github\Dto\RepositoryInfo;
use PHPUnit\Framework\TestCase;

class RepositoryInfoTest extends TestCase
{

    public function testCanCreateRepositoryInfoWithCorrectData(): void
    {
        $repository = new Repository('x/y');
        $repositoryInfo = new RepositoryInfo($repository, 1, 2,3,4,5, new DateTime());

        $this->assertIsInt(1, $repositoryInfo->getSubscribers());
        $this->assertIsInt(2, $repositoryInfo->getForks());
        $this->assertIsInt(3, $repositoryInfo->getStars());
        $this->assertIsInt(4, $repositoryInfo->getOpenPullRequests());
        $this->assertIsInt(5, $repositoryInfo->getClosedPullRequests());
        $this->assertInstanceOf(DateTime::class, $repositoryInfo->getLatestRelease());
    }

    public function testCanCreateRepositoryInfoWithNullDateTimeValue(): void
    {
        $repository = new Repository('x/y');
        $repositoryInfo = new RepositoryInfo($repository, 1, 2,3,4,5, null);

        $this->assertIsInt(1, $repositoryInfo->getSubscribers());
        $this->assertIsInt(2, $repositoryInfo->getForks());
        $this->assertIsInt(3, $repositoryInfo->getStars());
        $this->assertIsInt(4, $repositoryInfo->getOpenPullRequests());
        $this->assertIsInt(5, $repositoryInfo->getClosedPullRequests());
        $this->assertNull($repositoryInfo->getLatestRelease());
    }

    public function testIsValidJson(): void
    {
        $dateTime = new DateTime('2020-10-12 21:16:18');
        $repository = new Repository('x/y');
        $repositoryInfo = new RepositoryInfo($repository, 1, 2,3,4,5, $dateTime);

        $this->assertIsArray($repositoryInfo->jsonSerialize());
        $this->assertEquals('{"repository":{"username":"x","repository":"y"},"subscribers":1,"forks":2,"stars":3,"latest_release":{"date":"2020-10-12 21:16:18.000000","timezone_type":3,"timezone":"UTC"},"open_pull_requests":4,"closed_pull_requests":5}', json_encode($repositoryInfo->jsonSerialize()));
    }

}