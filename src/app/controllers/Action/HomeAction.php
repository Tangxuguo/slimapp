<?php
namespace App\Action;
use Slim\Views\PhpRenderer;
use Psr\Log\LoggerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
final class HomeAction
{

	private $view;
    private $logger;
    public function __construct($renderer, LoggerInterface $logger)
    {
        $this->view = $renderer;
        $this->logger = $logger;
    }
    public function __invoke(Request $request, Response $response, $args)
    {

        // Sample log message
        $this->logger->info("Slim-Skeleton '/' route");
        var_dump($args);
        // var_dump($request);
        var_dump($request->getQueryParams());

        // Render index view
        // return $this->view->render($response, 'index.phtml', $args);
        return $this->view->render($response, 'index.twig', $args);

    }
}
