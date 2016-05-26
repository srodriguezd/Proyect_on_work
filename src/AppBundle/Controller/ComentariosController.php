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

class ComentariosController extends Controller
{
    public function showFormAction($id)
    {
        $c = new Comentarios();
        $form = $this->createForm(ComentariosType::class, $c, ['action' => $this->generateUrl('app_comentario_new', ['id' => $id])]);
        return $this->render(':comentarios:show-form.html.twig',[

            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/new/{id}", name="app_comentario_new")
     * @Method(methods={"POST"})
     * @Security("has_role('ROLE_USER')")
     */
    public function submitComentarioAction(Request $request, Temas $tema)
    {
        $c = new Comentarios();
        $user = $this->getUser();
        $form = $this->createForm(ComentariosType::class, $c, [
            'action' => $this->generateUrl('app_comentario_new', ['id' => $tema->getId()])
        ]);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $c->setComentariosUser($user);
            //$user->addUserComentarios($c);
            $c->setComentariosTemas($tema);
            $m = $this->getDoctrine()->getManager();
            $m->persist($c);
            $m->flush();
            return $this->redirectToRoute('app_tema_show', ['id' => $tema->getId()]);
        }
        return $this->forward('AppBundle:Comentarios:showForm', ['id' => $tema->getId()]); //??
    }
    /**
     * @Route("/edit/{id}", name="app_comentario_edit")
     */
    public function editAction(Comentarios $comentario, Request $request)
    {
        if (!$this->isGranted('ROLE_ADMIN') and $this->getUser() != $comentario->getComentariosUser()) {
            throw $this->createAccessDeniedException('You are not allowed to do this');
        }
        $form = $this->createForm(ComentariosType::class, $comentario,[
            'submit_label' => 'Edit Comentario'
        ]);
        if ($request->getMethod() == Request::METHOD_POST) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $m = $this->getDoctrine()->getManager();
                $m->flush();
                return $this->redirectToRoute('app_tema_show', ['id' => $comentario->getComentariosTemas()->getId(), ]);
            }
        }
        return $this->render(':comentarios:show-form-edit-mode.html.twig',array('form' => $form->createView()));
    }

    /**
     * @Cache(smaxage=30)
     */
    public function lastCommentsAction()
    {
        $m = $this->getDoctrine()->getManager();
        $comentarioRepo = $m->getRepository('AppBundle:Comentarios');
        $comentarios = $comentarioRepo->lastComments();
        return $this->render(':comentarios:last.html.twig', ['comentarios' => $comentarios]);
    }
}
