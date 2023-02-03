<?php

namespace App\Controller;

use App\Repository\IngredientRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IngredientController extends AbstractController
{
    /**
     * @Route("/", name="home")
    */
    public function home()
    {
        return $this->render('recipie/home.html.twig');
    }

    #[Route('/ingredient', name: 'ingredient')]
    public function index(IngredientRepository $repo, PaginatorInterface $paginator,Request $request): Response
    {
        $ingredient = $paginator->paginate(
            $repo->findAll(),
            $request->query->getInt('page', 1), /*page number*/
            8 /*limit per page*/
        );
        return $this->render('ingredient/index.html.twig', [
            'ingredients' => $ingredient
        ]);
    }
}
