<?php
/**
 * Created by PhpStorm.
 * User: sara
 * Date: 10/02/16
 * Time: 16:08
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Comentarios;
use AppBundle\Entity\Temas;
use AppBundle\Form\TemasType;
use AppBundle\Form\ComentariosType;
use Trascastro\UserBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


class TemasController extends Controller
{
    /**
     * @Route("/principal", name="app_tema_temas")
     * @Cache(smaxage=60)
     */
    public function temaAction(Request $request)
    {
        $m = $this->getDoctrine()->getManager();
        $temasRepo = $m->getRepository('AppBundle:Temas');

        $query = $temasRepo->queryAllTemas();
        $paginator = $this->get('knp_paginator');
        $temas = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            Temas::PAGINATION_ITEMS,
            [
                'wrap-queries' => true, // https://github.com/KnpLabs/knp-components/blob/master/doc/pager/config.md
            ]
        );
        $response = $this->render(':tema:temas.html.twig', [
            'temas'  => $temas,
            'title'     => 'Temas'
        ]);

        return $response;
    }
    /**
     * @Route("/new", name="app_tema_new")
     * @Security("has_role('ROLE_USER')")
     */
    public function newAction(Request $request)
    {
        $t = new Temas();
        $form = $this->createForm(TemasType::class, $t);
        if ($request->getMethod() == Request::METHOD_POST) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $m = $this->getDoctrine()->getManager();
          //      $tagRepo = $m->getRepository('AppBundle:Tag');
           //     $tagRepo->addTagsIfAreNew($a);
                $t->setTemasUser($this->getUser()); //PETA AQUI
                $m->persist($t);
                $m->flush();
                return $this->redirectToRoute('app_tema_show', ['id' => $t->getId()]);
            }
        }
        return $this->render(':tema:form.html.twig', [
            'form'  => $form->createView(),
            'title' => 'New Tema',
        ]);
    }
    /**
     * @Route("edit/{id}.html", name="app_tema_edit")
     */
    public function editAction(Temas $tema, Request $request)
    {
        /*
         * Without voter
         */
         if (!$this->isGranted('ROLE_ADMIN') and $tema->getTemasUser() != $this->getUser()) {
           throw $this->createAccessDeniedException('You cannot access this page');
         }
       // $this->denyAccessUnlessGranted(TemasVoter::EDIT_ARTICLE, $tema);
        $form = $this->createForm(TemasType::class, $tema, [

       ]);
        $now = new \DateTime();
        $sinceCreated = $now->diff($tema->getCreatedAt());
        $minutes = $sinceCreated->days * 24 * 60 + $sinceCreated->h * 60 + $sinceCreated->i;
        if ($minutes > 4 and !$this->isGranted('ROLE_ADMIN')) {
            $form->remove('title');
        }
        if ($request->getMethod() == Request::METHOD_POST) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $m = $this->getDoctrine()->getManager();
                //$tagRepo = $m->getRepository('AppBundle:Tag');
                //$tagRepo->addTagsIfAreNew($article);
                $m->flush();
                return $this->redirectToRoute('app_tema_show', ['id' => $tema->getId()]);
            }
        }
        return $this->render(':tema:form.html.twig', [
            'form'  => $form->createView(),
            'title' => 'Edit Tema',
        ]);
    }
    /**
     * @Route("/{id}.html", name="app_tema_show")
     */
    public function showAction(Temas $tema, Request $request)
    {
        $m = $this->getDoctrine()->getManager();
        $commentRepo = $m->getRepository('AppBundle:Comentarios');
        $query = $commentRepo->queryComentariosByTema($tema->getId());
        $paginator = $this->get('knp_paginator');
        $comentarios = $paginator->paginate($query, $request->query->getInt('page', 1), Comentarios::PAGINATION_ITEMS);
        return $this->render(':tema:tema.html.twig', [
            'tema'   => $tema,
            'comentarios'  => $comentarios,
        ]);
    }

    /**
     * @Route("/temas/user/{username}", name="app_temas_byUser")

    public function temasByUserAction(User $user, Request $request)
    {
        $m = $this->getDoctrine()->getManager();
        $temaRepo = $m->getRepository('AppBundle:Temas');
        $query = $temaRepo->queryTemasByUserId($user->getId());
        $paginator = $this->get('knp_paginator');
        $temas = $paginator->paginate($query, $request->query->getInt('page', 1), Tema::PAGINATION_ITEMS);
        return $this->render(':tema:temas.html.twig', [
            'temas'  => $temas,
            'title'     => '@' . $user->getUsername(),
        ]);
    }*/
}
