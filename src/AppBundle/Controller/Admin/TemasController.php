<?php

namespace AppBundle\Controller\Admin;
use AppBundle\Entity\Temas;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
class TemasController extends Controller
{
    /**
     *
     * @Route("/products_remove/{id}", name="app_admin_tema_remove")
     * @ParamConverter(name="Temas", class="AppBundle:Temas")
     */
    public function removeAction(Temas $tema)
    {
        $m = $this->getDoctrine()->getManager();
        $m->remove($tema);
        $m->flush();
        $this->addFlash('messages', 'Eliminado');
        return $this->redirectToRoute('app_tema_temas');
    }
}