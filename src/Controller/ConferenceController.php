<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Conference;
use App\Form\Type\CommentFormType;
use App\Repository\CommentRepository;
use App\Repository\ConferenceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class ConferenceController extends AbstractController
{
    /**
     * @Route("/conferences", name="conferences")
     */
    public function index( Request $request, EntityManagerInterface $em, string $photoDir): Response
    {   
        $comment = new Comment();

        $form = $this->createForm(CommentFormType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if($photo = $form['photo']->getData())
            {
                $filename = bin2hex(random_bytes(6)) . '.' . $photo->guessExtension();

                try {
                    $photo->move($photoDir, $filename);
                }catch(FileException $f) {
                    $this->addFlash('error', "Error :  une erreur est survenue lors de l'enregistrement de l'image");
                }
                $comment->setPhotoFilename($filename);
            }

            $em->persist($comment);
            $em->flush();

            $this->addFlash('success', 'Merci pour votre retour');
            return $this->redirectToRoute('conferences');
        }

        return $this->render('conference/index.html.twig', [
            'commentForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/conference/{slug}", name="conference")
     */
    public function show(
        Request $request,
        Environment $twig, 
        Conference $conference, 
        CommentRepository $commentRepository
        ): Response 
    {
        // $comment->setAuthor()

        $offset = max(0, $request->query->getInt('offset',0));
        $paginator = $commentRepository->getCommentPaginator($conference, $offset);

        return  new Response($twig->render('conference/show.html.twig', [
            'conference' => $conference,
            'comments' => $paginator,
            'previous' => $offset - CommentRepository::PAGINATOR_PER_PAGE,
            'next' => min(count($paginator), $offset + CommentRepository::PAGINATOR_PER_PAGE),
        ]));
    }

}
