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
use AppBundle\Entity\Temas;
use AppBundle\Form\TemasType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;


class TemasController extends Controller
{
    /**
     * indexAction
     *
     * @Route(path="/noticeme_index", name="app_noticeme")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $m = $this->getDoctrine()->getManager();
        $repository = $m->getRepository('AppBundle:Temas');
        /**
         * @var Temas $temas
         */
        $temas = $repository->findAll();
        return $this->render(':gotcha:noticias.html.twig',
            [
                'temas' => $temas,
            ]
        );
    }
    /**
     * @Route(  path="/noticeme_insert", name="app_noticeme_insert")
     */
    public function insertAction()
    {
        $temas = new Temas();
        $form = $this->createForm(TemasType::class, $temas);
        return $this->render(':gotcha:insert.html.twig',
            [
                'form'      => $form->createView(),
                'action'    => $this->generateUrl('app_noticeme_do-insert')
            ]
        );
    }
    /**
     * @Route("/noticeme_do-insert", name="app_noticeme_do-insert")
     */
    public function doInsert(Request $request)
    {
        $temas = new Temas();
        $form = $this->createForm(temasType::class, $temas);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $m = $this->getDoctrine()->getManager();
            $m->persist($temas);
            $m->flush();
            $this->addFlash('messages', 'añadido');
            return $this->redirectToRoute('app_noticeme');
        }
        $this->addFlash('messages', 'Review your form data');
        return $this->render(':gotcha:insert.html.twig',
            [
                'form'      => $form->createView(),
                'action'    => $this->generateUrl('app_noticeme_do-insert')
            ]
        );
    }



    /**
     * @Route("/noticeme_update/{id}", name="app_noticeme_update")
     */
    public function updateAction($id)
    {
        $m = $this->getDoctrine()->getManager();
        $repository = $m->getRepository('AppBundle:Temas');
        $temas = $repository->find($id);
        $form = $this->createForm(TemasType::class, $temas);
        return $this->render(':gotcha:insert.html.twig',
            [
                'form'      => $form->createView(),
                'action'    => $this->generateUrl('app_noticeme_do-update', ['id' => $id])
            ]
        );
    }
    /**
     * @Route("/noticeme_do-update/{id}", name="app_noticeme_do-update")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function doUpdateAction($id, Request $request)
    {
        $m          = $this->getDoctrine()->getManager();
        $repository = $m->getRepository('AppBundle:Temas');
        $temas       = $repository->find($id);
        $form       = $this->createForm(TemasType::class, $temas);
        // user is updated with incoming data
        $form->handleRequest($request);
        if ($form->isValid()) {
            $m->flush();
            $this->addFlash('messages', 'Actualizado');
            return $this->redirectToRoute('app_noticeme');
        }
        $this->addFlash('messages', 'Review your form');
        return $this->render(':gotcha:insert.html.twig',
            [
                'form'      => $form->createView(),
                'action'    => $this->generateUrl('app_noticeme', ['id' => $id]),
            ]
        );
    }
    /**
     *
     * @Route("/noticeme_remove/{id}", name="app_noticeme_remove")
     * @ParamConverter(name="Temas", class="AppBundle:Temas")
     */
    public function removeAction(temas $temas)
    {
        $m = $this->getDoctrine()->getManager();
        $m->remove($temas);
        $m->flush();
        $this->addFlash('messages', 'Eliminado');
        return $this->redirectToRoute('app_noticeme');
    }
}
