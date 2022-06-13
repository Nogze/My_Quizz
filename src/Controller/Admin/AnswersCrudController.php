<?php

namespace App\Controller\Admin;

use App\Entity\Answers;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class AnswersCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Answers::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('question'),
            TextField::new('answer'),
            IntegerField::new('right_answer'),

        ];
    }
}
