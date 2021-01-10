<?php

namespace App\Controller\Admin;

use App\Entity\Conference;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ConferenceCrudController extends AbstractCrudController
{   
    public static function getEntityFqcn(): string
    {
        return Conference::class;
    }
    
    public function configureActions(Actions $actions): Actions
    {   

        return $actions::new()
        ->add(Crud::PAGE_INDEX, Action::NEW)
        ->add(Crud::PAGE_NEW, Action::SAVE_AND_ADD_ANOTHER)
        ->add(Crud::PAGE_NEW, Action::SAVE_AND_RETURN)

        ->add(Crud::PAGE_INDEX, Action::EDIT)
        ->add(Crud::PAGE_EDIT, Action::SAVE_AND_ADD_ANOTHER)
        ->add(Crud::PAGE_EDIT, Action::SAVE_AND_RETURN)

        ->add(Crud::PAGE_INDEX, Action::DELETE)
        
        // ->setPermission(Action::NEW, 'ROLE_SUPER_ADMIN')
        // ->setPermission(Action::EDIT, 'ROLE_SUPER_ADMIN')
        // ->setPermission(Action::DELETE, 'ROLE_SUPER_ADMIN')
        // // ->add(Crud::PAGE_INDEX, Action::DETAIL)
        ;
    }
    
    // public function configureCrud(Crud $crud): Crud
    // {
    //     return $crud
    //     // ...
    //     ->showEntityActionsAsDropdown();
    // }
}
