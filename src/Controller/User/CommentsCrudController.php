<?php

namespace App\Controller\User;

use App\Entity\Comments;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class CommentsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Comments::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Gestion des commentaires')
            ->setEntityLabelInSingular('Commentaire')
            ->setEntityLabelInPlural('Commentaires');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextEditorField::new('comment')
             ->setTrixEditorConfig([
                 'blockAttributes' => [
                     'default' => ['tagName' => 'p'],
                     'heading1' => ['breakOnReturn' => 'h2'],
                 ],
             ]),
            AssociationField::new('business')
            ->setFormTypeOptions([
                'choice_label' => 'name',
            ]),
        ];
    }
}
