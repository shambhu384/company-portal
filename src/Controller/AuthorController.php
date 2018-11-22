<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AuthorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use App\Form\AuthorType;
use Symfony\Component\HttpFoundation\Request;

class AuthorController extends AbstractController
{
    /**
     * @Route("/author/{id}", name="author")
     */
    public function index($id, AuthorRepository $authorRepository, Request $request)
    {
       $em = $this->getDoctrine()->getManager();
        /**
         * @var $user User
         */
        $user = $authorRepository->findOneBy(['id' => $id]);
        $user->setFullname('OverSeas media');
        // save the records that are in the database first to compare them with the new one the user sent
        // make sure this line comes before the $form->handleRequest();
        $orignalExp = new ArrayCollection();
        foreach ($user->getBooks() as $exp) {
            $orignalExp->add($exp);
        }
        $form = $this->createForm(AuthorType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            // get rid of the ones that the user got rid of in the interface (DOM)
            foreach ($orignalExp as $exp) {
                // check if the exp is in the $user->getExp()
//                dump($user->getExp()->contains($exp));
                if ($user->getBooks()->contains($exp) === false) {
                    $em->remove($exp);
                }
            }
            $em->persist($user);
            $em->flush();
        }

        return $this->render('author/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
