<?php


namespace App\Github;


/**
 * Pull request state
 *
 * @package App\Github\Service
 * @author Piotr Filipek <piotrek290@gmail.com>
 */
interface PullRequestState
{

    /**
     * @var string Open state
     */
    public const OPEN = 'open';

    /**
     * @var string Closed state
     */
    public const CLOSED = 'closed';

}