<?php

namespace App\Controller\Admin;

use DateTimeInterface;
use App\Entity\Comment;
use App\Entity\Conference;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CommentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Comment::class;
    }

    public function configureActions(Actions $actions): Actions
    {   
        return $actions::new()

        ->add(Crud::PAGE_INDEX, Action::DELETE)
        
        // // ->setPermission(Action::NEW, 'ROLE_SUPER_ADMIN')
        // // ->setPermission(Action::EDIT, 'ROLE_SUPER_ADMIN')
        // // ->setPermission(Action::DELETE, 'ROLE_SUPER_ADMIN')
        // // // ->add(Crud::PAGE_INDEX, Action::DETAIL)
        ;
    }
    

    
    // public function configureFields(string $pageName): iterable
    // {
    //     return [
    //         IdField::new('id'),
    //         TextField::new('title'),
    //         TextEditorField::new('description'),
    //     ];
    // }
}
