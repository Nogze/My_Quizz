<?php

namespace App\Controller\Admin;

use App\Entity\Users;
use phpDocumentor\Reflection\Types\Boolean;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UsersCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Users::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            TextField::new('email'),
            TextField::new('password'),
            ArrayField::new('roles'),
            DateTimeField::new('created_at')->hideOnForm(),
            DateTimeField::new('login_at')->hideOnForm(),
            BooleanField::new('isVerified'),
        ];
    }
}
    // #[ORM\Column(type: 'json')]
    // private $roles = [];
