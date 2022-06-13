<?php

namespace App\Controller\Admin;

use App\Entity\Quizz;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class QuizzCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Quizz::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            DateTimeField::new('creation_date')->hideOnForm(),
        ];
    }

    public function deleteEntity(EntityManagerInterface $entityManager, $entityInstance): void{
        if(!$entityInstance instanceof Quizz){
            return;
        }

        foreach ($entityInstance->getQuestions() as $question) {
            $entityManager->remove($question);
        }
        parent::deleteEntity($entityManager, $entityInstance);
    }
}
