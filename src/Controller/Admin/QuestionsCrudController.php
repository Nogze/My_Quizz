<?php

namespace App\Controller\Admin;

use App\Entity\Questions;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use PhpParser\Node\Expr\Instanceof_;
use Symfony\Component\Console\Question\Question;

class QuestionsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Questions::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('quizz'),
            TextField::new('question'),
        ];
    }    
    
    public function deleteEntity(EntityManagerInterface $entityManager, $entityInstance): void{
        if(!$entityInstance instanceof Questions){
            return;
        }

        foreach ($entityInstance->getAnswers() as $answer) {
            $entityManager->remove($answer);
        }
        parent::deleteEntity($entityManager, $entityInstance);
    }
}
