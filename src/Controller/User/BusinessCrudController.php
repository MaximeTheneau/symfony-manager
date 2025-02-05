<?php

namespace App\Controller\User;

use App\Entity\Business;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Provider\AdminContextProvider;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class BusinessCrudController extends AbstractCrudController
{
    private $adminContextProvider;
    private $entityManager;
    private $tokenStorage;

    public function __construct(
        EntityManagerInterface $entityManager,
        AdminContextProvider $adminContextProvider,
        TokenStorageInterface $tokenStorage,
    ) {
        $this->entityManager = $entityManager;
        $this->adminContextProvider = $adminContextProvider;
        $this->tokenStorage = $tokenStorage;
    }

    public static function getEntityFqcn(): string
    {
        return Business::class;
    }

    public function edit($entityId)
    {
        $entity = $this->entityManager->getRepository(Business::class)->find($entityId);
        $context = $this->adminContextProvider->getContext();
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED');
        if ($this->getUser()->getId() !== (int) $entity->getOwner()->getId()) {
            throw new AccessDeniedException('Access denied');
        }

        return parent::edit($context);
    }

    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {
        $queryBuilder = parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters);

        if ('ROLE_ADMIN' === $this->getUser()->getRoles()[0]) {
            return $queryBuilder;
        }

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

    public function configureActions(Actions $actions): Actions
    {
        $detailAction = Action::new('detail', 'Voir les détails', 'fa fa-eye')
            ->linkToCrudAction('detail');

        return $actions
            ->add(Crud::PAGE_INDEX, $detailAction);
    }
}
