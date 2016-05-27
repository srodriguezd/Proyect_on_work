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
     * @Route("/tema_remove/{id}", name="app_admin_tema_remove")
     * @ParamConverter(name="Temas", class="AppBundle:Temas")
     */
    public function removeAction(Temas $tema)
    {
        $m = $this->getDoctrine()->getManager();
        $temm = $m->getRepository('AppBundle:Temas')->find($tema);
        $m->remove($temm);
        $m->flush();

        return $this->redirectToRoute('app_tema_temas');

    }
}