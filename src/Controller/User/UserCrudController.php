<?php

namespace App\Controller\User;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
        ->setPageTitle(Crud::PAGE_EDIT, 'Modifier l’utilisateur')
        ->overrideTemplate('crud/edit', 'user/index.html.twig');
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
                ->disable(Action::SAVE_AND_RETURN)
            ->update(Crud::PAGE_EDIT, Action::SAVE_AND_CONTINUE, function (Action $action) {
                return $action->setLabel('Sauvegarder')->setCssClass('btn btn-primary');
            });
    }

    public function configureFields(string $pageName): iterable
    {
        $fields = [
            TextField::new('email'),
            // BooleanField::new('isVerified', 'Email Vérifié'),
        ];

        $password = TextField::new('password')
            ->setFormType(RepeatedType::class)
            ->setFormTypeOptions([
                'type' => PasswordType::class,
                'first_options' => ['label' => 'Password'],
                'second_options' => ['label' => '(Repeat)'],
                'mapped' => false,
            ])
            ->setRequired(Crud::PAGE_NEW === $pageName)
            ->onlyOnForms()
        ;
        $fields[] = $password;

        return $fields;
    }

    #[Route('/dashboard/user/{id}/delete', name: 'dashboard_user_delete', methods: ['POST'])]
    public function deleteUser($id, EntityManagerInterface $entityManager): Response
    {
        $user = $entityManager->getRepository(User::class)->find($id);

        if (!$user) {
            $this->addFlash('error', 'Utilisateur non trouvé.');

            return $this->redirectToRoute('admin');
        }

        $entityManager->remove($user);
        $entityManager->flush();

        $this->addFlash('success', 'Votre compte a été supprimé.');

        return $this->redirectToRoute('app_logout'); // Redirige vers la déconnexion
    }
}
