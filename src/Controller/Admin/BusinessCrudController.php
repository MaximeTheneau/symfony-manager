<?php

namespace App\Controller\Admin;

use App\Entity\Business;
use App\Form\CommentFormType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class BusinessCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Business::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            TextEditorField::new('title'),

            CollectionField::new('comments')
                ->setEntryType(CommentFormType::class)
                ->setEntryIsComplex()
                ->setFormTypeOptions([
                    'by_reference' => false,
                ]),
        ];
    }
}
