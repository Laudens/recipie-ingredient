<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Form\IngredientType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CreateIngredientController extends AbstractController
{
    #[Route('/ingredient/create', name: 'create')]
    #[Route('/ingredient/{id}/edit', name: 'edit_mode')]
    public function form(Ingredient $ingredient = null, Request $request, EntityManagerInterface $manager): Response
    {
        if (!$ingredient) {
            $ingredient = new Ingredient();
        }

        $form = $this->createForm(IngredientType::class, $ingredient);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (!$ingredient->getId()) {
                $ingredient->setCreatAt(new \DateTimeImmutable());
            }
            $manager->persist($ingredient);

            $manager->flush();
            if(!$ingredient->getId()){
            $this->addFlash('success', 'ingredient à été crée avec succès ');
            }else{
            $this->addFlash('success', 'ingredient à été modifié avec succès !');
            }
            return  $this->redirectToRoute('ingredient');
        }
        return $this->render('create_ingredient/index.html.twig', [
            'formIngredient' => $form->createView(),
            'editMode' => $ingredient->getId() !== null
        ]);
    }
    #[Route('/ingredient/{id}/delete', name: 'delete_mode')]
    public function delete(Ingredient $ingredient, EntityManagerInterface $manager): Response
    {

            $manager->remove($ingredient);

            $manager->flush();

            $this->addFlash('success', 'ingredient à été supprimé avec succès !');

            return  $this->redirectToRoute('ingredient');

    }
}
