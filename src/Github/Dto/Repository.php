<?php


namespace App\Github\Dto;


use function explode;
use function preg_match;
use InvalidArgumentException;
use JsonSerializable;

/**
 * Class Repository
 *
 * @package App\Github\Dto
 * @author Piotr Filipek <piotrek290@gmail.com>
 */
class Repository implements JsonSerializable
{

    /**
     * @var string Username
     */
    private string $username;

    /**
     * @var string Repository name
     */
    private string $repository;

    /**
     * Repository constructor.
     *
     * @param mixed $value
     */
    public function __construct($value)
    {
        $this->ensureValid($value);

        [ $username, $repository ] = explode('/', $value);

        $this->username = $username;
        $this->repository = $repository;
    }

    /**
     * @param mixed $value
     */
    private function ensureValid($value): void
    {
        if (!is_string($value)) {
            throw new InvalidArgumentException('Given value is not a string type');
        }

        if (!preg_match('/^([A-Za-z\-\_]+)\/([A-Za-z\-\_]+)$/', $value)) {
            throw new InvalidArgumentException('Given username and repository are invalid value');
        }
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * Get repository name
     *
     * @return string
     */
    public function getRepository(): string
    {
        return $this->repository;
    }

    /**
     * @return mixed
     */
    public function jsonSerialize(): array
    {
        return [
            'username' => $this->username,
            'repository' => $this->repository,
        ];
    }

}