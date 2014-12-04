<?php

namespace AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class UserAdmin extends Admin
{
    public function configure() {
        $this->baseRoutePattern = 'user';
        $this->baseRouteName = 'admin_user';
    }

    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('email')
            ->add('username', null, ['label' => 'User name'])
            ->add('phoneNumber')
            ->add('enabled', null, ['label' => 'Approved', 'required' => false])
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('email')
            ->add('username')
            ->add('phoneNumber')
            ->add('enabled')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->addIdentifier('email')
            ->add('username')
            ->add('phoneNumber')
            ->add('enabled', 'boolean')
            ->add('_action', 'actions', [
                'actions' => [
                    'approve' => [
                        'template' => 'AdminBundle:CRUD:list__action_approve.html.twig'
                    ],
                ]
            ])
        ;
    }

    // Route for custom sonata action
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('approve', $this->getRouterIdParameter() . '/approve');
    }

    // default delete removed
    public function getBatchActions()
    {
        return[];
    }
}
