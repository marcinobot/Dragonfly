<?php

namespace AdminBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserController extends Controller
{
    public function approveAction()
    {
        $id = $this->get('request')->get($this->admin->getIdParameter());

        $object = $this->admin->getObject($id);

        if (!$object) {
            throw new NotFoundHttpException(sprintf('Unable to find User with id : %s', $id));
        }

        if ($object->isEnabled() !== true) {

            $object->setEnabled(true);
            $this->admin->create($object);

            $mailer = $this->get('user.approval.email');
            $mailer->sendUserApprovalNotice($object);

            $this->addFlash('sonata_flash_success', 'User successfully approved.');
        }

        return new RedirectResponse($this->generateUrl('admin_user_list'));
    }
}