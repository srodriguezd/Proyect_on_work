<?php

namespace AppBundle\Controller\Admin;
use AppBundle\Entity\Comentarios;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
class ComentariosController extends Controller
{

    /**
    * @Route("/comentario_remove/{id}", name="app_admin_comentario_remove")
    * @ParamConverter(name="Comentarios", class="AppBundle:Comentarios")
    */
        public function removeAction(Comentarios $comentario)
        {
            $m = $this->getDoctrine()->getManager();
            $comm = $m->getRepository('AppBundle:Comentarios')->find($comentario);
            $m->remove($comm);
            $m->flush();

            return $this->redirectToRoute('app_tema_show', ['id' => $comm->getComentariosTemas()->getId()]);

        }
}