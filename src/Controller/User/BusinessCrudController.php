<?php

namespace App\Controller\User;

use App\Entity\Business;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class BusinessCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Business::class;
    }

    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {
        $queryBuilder = parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters);

        $queryBuilder
            ->andWhere('entity.owner = :user')
            ->setParameter('user', $this->getUser());

        return $queryBuilder;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            AssociationField::new('owner')
            ->hideOnForm()
            ->hideOnIndex()
            ->hideOnDetail(),
        ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if ($entityInstance instanceof Business) {
            $user = $this->getUser();

            if (null === $entityInstance->getOwner()) {
                $entityInstance->setOwner($user);
            }

            $entityManager->persist($entityInstance);
            $entityManager->flush();
        }
    }
}
