<?php


namespace App\Tests;


use InvalidArgumentException;
use App\Github\Dto\Repository;
use PHPUnit\Framework\TestCase;

class RepositoryTest extends TestCase
{

    public function testCannotCreateEmptyRepositoryObject(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Given value is not a string type');

        new Repository(null);
    }

    public function testCannotCreateRepositoryWithTooMuchSlashes(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Given username and repository are invalid value');

        new Repository('wrong_repository_name/zz/xx');
    }

    public function testCannotCreateRepositoryWithTooFewSlashes(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Given username and repository are invalid value');

        new Repository('too_few_slashes_name');
    }

    public function testCannotCreateRepositoryWithNotAllowedChars(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Given username and repository are invalid value');

        new Repository('xyz*/4%');
    }

    public function testCannotCreateRepositoryFromOtherTypeThanString(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Given value is not a string type');

        new Repository(1);
    }

    public function testCanCreateRepositoryObjectWithCorrectUsernameAndRepositoryName(): void
    {
        $repository = new Repository('drupal/core');

        $this->assertInstanceOf(Repository::class, $repository);
        $this->assertEquals('drupal', $repository->getUsername());
        $this->assertEquals('core', $repository->getRepository());
        $this->assertIsArray($repository->jsonSerialize());
        $this->assertEquals('{"username":"drupal","repository":"core"}', json_encode($repository->jsonSerialize()));
    }

}