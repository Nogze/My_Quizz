<?php

namespace App\Controller;

use App\Entity\Answers;
use App\Entity\Questions;
use App\Entity\Quizz;
use App\Entity\QuizzResults;
use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuizzController extends AbstractController
{
    #[Route('/quizz/{id}/{questionNo}', name: 'app_quizz')]
    public function show(EntityManagerInterface $entityManager,ManagerRegistry $doctrine, int $id, int $questionNo): Response {

        $userId = null;
        $quizzRepository = $doctrine->getRepository(Quizz::class);
        $questionsRepository = $doctrine->getRepository(Questions::class);
        $answersRepository = $doctrine->getRepository(Answers::class);
        $quizz = $quizzRepository->find($id);
        $question = $quizz->getQuestions()->get($questionNo);

        if ($question) {
            $isOver = false;
            $answers = $questionsRepository->find($question)->getAnswers()->toArray();
            shuffle($answers);
        }
        else {
            $isOver = true;
            $answers = null;
        }

        $submittedAnswers = implode(",", $_POST);
        $rightAnswers = [];
        $score = 0;

        if ($isOver) {
            $submittedAnswers = explode(",", substr($submittedAnswers, 1));
            for ($i = 0; $i < count($submittedAnswers); $i++) {
                $currentQuestionChecked = $quizz->getQuestions()->get($i)->getId();
                $rightAnswer = $answersRepository->findBy([
                    'question' => $currentQuestionChecked,
                    'right_answer' => 1,
                ],)[0]->getAnswer();
                $rightAnswers[] = $rightAnswer;
                if ($submittedAnswers[$i] == $rightAnswer) {
                    $score += 1;
                }
            }
            $user = $this->getUser();
            if ($user) {
                $userId = $user->getId();
                $userRepository = $doctrine->getRepository(Users::class);
                $userEntity = $userRepository->find($userId);
                $quizz_result = new QuizzResults();
                $quizz_result->setUserId($userEntity);
                $quizz_result->setResult($score);
                $quizz_result->setQuizzId($quizz);
                $entityManager->persist($quizz_result);
                $entityManager->flush();
            }
        }

        return $this->render('quizz/index.html.twig', [
            'controller_name' => 'QuizzController',
            'quizz' => $quizz,
            'question' => $question,
            'answers' => $answers,
            'nextQuestion' => "/quizz/" . $id . "/" . $questionNo + 1,
            'isOver' => $isOver,
            'submittedAnswers' => $submittedAnswers,
            'rightAnswers' => $rightAnswers,
            'score' => $score,
            'userId' => $userId,
        ]);
    }

    #[Route('/quizz', name: 'app_quizzpage')]
    public function showQuizzpage(ManagerRegistry $doctrine) {

        $quizzRepository = $doctrine->getRepository(Quizz::class);
        $quizzList = $quizzRepository->findAll();

        return $this->render('quizzpage/quizzpage.html.twig', [
            'controller_name' => 'QuizzController',
            'quizzList' => $quizzList,
        ]);
    }
}