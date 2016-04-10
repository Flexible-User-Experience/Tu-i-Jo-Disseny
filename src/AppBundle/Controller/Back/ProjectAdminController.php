<?php

namespace AppBundle\Controller\Back;

use AppBundle\Entity\Project;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class ProjectAdminController
 *
 * @category Controller
 * @package  AppBundle\Controller\Admin
 * @author   David Romaní <david@flux.cat>
 */
class ProjectAdminController extends BaseAdminController
{
    /**
     * Preview action
     *
     * @param int $id
     *
     * @return Response
     * @throws NotFoundHttpException If the object does not exist
     * @throws AccessDeniedException If access is not granted
     */
    public function previewAction($id)
    {
        /** @var Project $object */
        $object = $this->admin->getObject($id);

        if (!$object) {
            throw $this->createNotFoundException(sprintf('Unable to find the object with id : %s', $id));
        }

        return $this->redirect($this->generateUrl('front_project_detail', array(
            'slug' => $object->getSlug(),
        )));
    }
}
