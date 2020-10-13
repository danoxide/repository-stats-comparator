<?php


namespace App\Controller;


use App\Github\Service\CompareService;
use Exception;
use App\Github\Dto\Repository;
use App\Github\Service\GithubRepositoryService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Compare two repositories from GitHub.
 *
 * @package App\Controller
 * @author Piotr Filipek <piotrek290@gmail.com>
 */
class CompareController extends AbstractController
{

    /**
     * @Route("/compare", name="compare", methods={"GET"})
     */
    public function __invoke(
        Request $request,
        GithubRepositoryService $githubRepositoryService,
        CompareService $compareService
    ) {

        try {

            $firstRepositoryName = $request->query->get('first');
            $secondRepositoryName = $request->query->get('second');

            $firstRepository = new Repository($firstRepositoryName);
            $secondRepository = new Repository($secondRepositoryName);

            $output1 = $githubRepositoryService->prepare($firstRepository);
            $output2 = $githubRepositoryService->prepare($secondRepository);

            $summary = $compareService->compare($output1, $output2);

            $message = $this->renderView('summary.twig', [
                'first_repository_name' => $firstRepositoryName,
                'second_repository_name' => $secondRepositoryName,
                'summary' => $summary
            ]);

            return $this->json([
                'items' => [ $output1, $output2 ],
                'summary' => $message
            ]);

        } catch (Exception $exception) {

            return $this->json([
                'error_message' => $exception->getMessage()
            ], Response::HTTP_BAD_REQUEST);

        }

    }

}