<?php

namespace Database\Seeders;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\Option;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Mathematics Quiz
        $mathQuiz = Quiz::create([
            'title' => 'Mathematics Quiz',
            'description' => 'Test your math skills with these 5 questions',
            'duration' => 10,
            'is_active' => true,
        ]);

        $this->createMathQuestions($mathQuiz);

        // Create Science Quiz
        $scienceQuiz = Quiz::create([
            'title' => 'Science Quiz',
            'description' => 'Challenge yourself with science questions',
            'duration' => 10,
            'is_active' => true,
        ]);

        $this->createScienceQuestions($scienceQuiz);

        // Create History Quiz
        $historyQuiz = Quiz::create([
            'title' => 'History Quiz',
            'description' => 'Test your knowledge of historical events',
            'duration' => 10,
            'is_active' => true,
        ]);

        $this->createHistoryQuestions($historyQuiz);

        // Create Geography Quiz
        $geographyQuiz = Quiz::create([
            'title' => 'Geography Quiz',
            'description' => 'Test your knowledge of world geography',
            'duration' => 10,
            'is_active' => true,
        ]);

        $this->createGeographyQuestions($geographyQuiz);

        // Create Literature Quiz
        $literatureQuiz = Quiz::create([
            'title' => 'Literature Quiz',
            'description' => 'Challenge yourself with literature questions',
            'duration' => 10,
            'is_active' => true,
        ]);

        $this->createLiteratureQuestions($literatureQuiz);
    }

    private function createMathQuestions($quiz)
    {
        // Question 1
        $question1 = Question::create([
            'quiz_id' => $quiz->id,
            'question_text' => 'What is 2 + 2?',
        ]);

        Option::create([
            'question_id' => $question1->id,
            'option_text' => '3',
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => $question1->id,
            'option_text' => '4',
            'is_correct' => true,
        ]);

        Option::create([
            'question_id' => $question1->id,
            'option_text' => '5',
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => $question1->id,
            'option_text' => '6',
            'is_correct' => false,
        ]);

        // Question 2
        $question2 = Question::create([
            'quiz_id' => $quiz->id,
            'question_text' => 'What is 5 × 7?',
        ]);

        Option::create([
            'question_id' => $question2->id,
            'option_text' => '30',
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => $question2->id,
            'option_text' => '35',
            'is_correct' => true,
        ]);

        Option::create([
            'question_id' => $question2->id,
            'option_text' => '40',
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => $question2->id,
            'option_text' => '45',
            'is_correct' => false,
        ]);

        // Question 3
        $question3 = Question::create([
            'quiz_id' => $quiz->id,
            'question_text' => 'What is the square root of 64?',
        ]);

        Option::create([
            'question_id' => $question3->id,
            'option_text' => '6',
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => $question3->id,
            'option_text' => '7',
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => $question3->id,
            'option_text' => '8',
            'is_correct' => true,
        ]);

        Option::create([
            'question_id' => $question3->id,
            'option_text' => '9',
            'is_correct' => false,
        ]);

        // Question 4
        $question4 = Question::create([
            'quiz_id' => $quiz->id,
            'question_text' => 'What is 12 ÷ 4?',
        ]);

        Option::create([
            'question_id' => $question4->id,
            'option_text' => '2',
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => $question4->id,
            'option_text' => '3',
            'is_correct' => true,
        ]);

        Option::create([
            'question_id' => $question4->id,
            'option_text' => '4',
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => $question4->id,
            'option_text' => '5',
            'is_correct' => false,
        ]);

        // Question 5
        $question5 = Question::create([
            'quiz_id' => $quiz->id,
            'question_text' => 'What is 3² + 4²?',
        ]);

        Option::create([
            'question_id' => $question5->id,
            'option_text' => '7',
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => $question5->id,
            'option_text' => '25',
            'is_correct' => true,
        ]);

        Option::create([
            'question_id' => $question5->id,
            'option_text' => '49',
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => $question5->id,
            'option_text' => '16',
            'is_correct' => false,
        ]);
    }

    private function createScienceQuestions($quiz)
    {
        // Question 1
        $question1 = Question::create([
            'quiz_id' => $quiz->id,
            'question_text' => 'What is the chemical symbol for water?',
        ]);

        Option::create([
            'question_id' => $question1->id,
            'option_text' => 'O2',
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => $question1->id,
            'option_text' => 'CO2',
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => $question1->id,
            'option_text' => 'H2O',
            'is_correct' => true,
        ]);

        Option::create([
            'question_id' => $question1->id,
            'option_text' => 'N2',
            'is_correct' => false,
        ]);

        // Question 2
        $question2 = Question::create([
            'quiz_id' => $quiz->id,
            'question_text' => 'Which planet is known as the Red Planet?',
        ]);

        Option::create([
            'question_id' => $question2->id,
            'option_text' => 'Earth',
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => $question2->id,
            'option_text' => 'Mars',
            'is_correct' => true,
        ]);

        Option::create([
            'question_id' => $question2->id,
            'option_text' => 'Venus',
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => $question2->id,
            'option_text' => 'Jupiter',
            'is_correct' => false,
        ]);

        // Question 3
        $question3 = Question::create([
            'quiz_id' => $quiz->id,
            'question_text' => 'What is the largest organ in the human body?',
        ]);

        Option::create([
            'question_id' => $question3->id,
            'option_text' => 'Heart',
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => $question3->id,
            'option_text' => 'Liver',
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => $question3->id,
            'option_text' => 'Skin',
            'is_correct' => true,
        ]);

        Option::create([
            'question_id' => $question3->id,
            'option_text' => 'Brain',
            'is_correct' => false,
        ]);

        // Question 4
        $question4 = Question::create([
            'quiz_id' => $quiz->id,
            'question_text' => 'What is the process by which plants make their food?',
        ]);

        Option::create([
            'question_id' => $question4->id,
            'option_text' => 'Photosynthesis',
            'is_correct' => true,
        ]);

        Option::create([
            'question_id' => $question4->id,
            'option_text' => 'Respiration',
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => $question4->id,
            'option_text' => 'Digestion',
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => $question4->id,
            'option_text' => 'Excretion',
            'is_correct' => false,
        ]);

        // Question 5
        $question5 = Question::create([
            'quiz_id' => $quiz->id,
            'question_text' => 'What is the unit of electric current?',
        ]);

        Option::create([
            'question_id' => $question5->id,
            'option_text' => 'Volt',
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => $question5->id,
            'option_text' => 'Watt',
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => $question5->id,
            'option_text' => 'Ampere',
            'is_correct' => true,
        ]);

        Option::create([
            'question_id' => $question5->id,
            'option_text' => 'Ohm',
            'is_correct' => false,
        ]);
    }

    private function createHistoryQuestions($quiz)
    {
        // Question 1
        $question1 = Question::create([
            'quiz_id' => $quiz->id,
            'question_text' => 'In which year did World War II end?',
        ]);

        Option::create([
            'question_id' => $question1->id,
            'option_text' => '1943',
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => $question1->id,
            'option_text' => '1944',
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => $question1->id,
            'option_text' => '1945',
            'is_correct' => true,
        ]);

        Option::create([
            'question_id' => $question1->id,
            'option_text' => '1946',
            'is_correct' => false,
        ]);

        // Question 2
        $question2 = Question::create([
            'quiz_id' => $quiz->id,
            'question_text' => 'Who was the first President of the United States?',
        ]);

        Option::create([
            'question_id' => $question2->id,
            'option_text' => 'Thomas Jefferson',
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => $question2->id,
            'option_text' => 'John Adams',
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => $question2->id,
            'option_text' => 'George Washington',
            'is_correct' => true,
        ]);

        Option::create([
            'question_id' => $question2->id,
            'option_text' => 'Abraham Lincoln',
            'is_correct' => false,
        ]);

        // Question 3
        $question3 = Question::create([
            'quiz_id' => $quiz->id,
            'question_text' => 'Which empire was ruled by Genghis Khan?',
        ]);

        Option::create([
            'question_id' => $question3->id,
            'option_text' => 'Roman Empire',
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => $question3->id,
            'option_text' => 'Mongol Empire',
            'is_correct' => true,
        ]);

        Option::create([
            'question_id' => $question3->id,
            'option_text' => 'Ottoman Empire',
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => $question3->id,
            'option_text' => 'Byzantine Empire',
            'is_correct' => false,
        ]);

        // Question 4
        $question4 = Question::create([
            'quiz_id' => $quiz->id,
            'question_text' => 'In which year did the French Revolution begin?',
        ]);

        Option::create([
            'question_id' => $question4->id,
            'option_text' => '1776',
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => $question4->id,
            'option_text' => '1789',
            'is_correct' => true,
        ]);

        Option::create([
            'question_id' => $question4->id,
            'option_text' => '1798',
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => $question4->id,
            'option_text' => '1804',
            'is_correct' => false,
        ]);

        // Question 5
        $question5 = Question::create([
            'quiz_id' => $quiz->id,
            'question_text' => 'Who painted the Mona Lisa?',
        ]);

        Option::create([
            'question_id' => $question5->id,
            'option_text' => 'Vincent van Gogh',
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => $question5->id,
            'option_text' => 'Pablo Picasso',
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => $question5->id,
            'option_text' => 'Leonardo da Vinci',
            'is_correct' => true,
        ]);

        Option::create([
            'question_id' => $question5->id,
            'option_text' => 'Michelangelo',
            'is_correct' => false,
        ]);
    }

    private function createGeographyQuestions($quiz)
    {
        // Question 1
        $question1 = Question::create([
            'quiz_id' => $quiz->id,
            'question_text' => 'What is the capital of Australia?',
        ]);

        Option::create([
            'question_id' => $question1->id,
            'option_text' => 'Sydney',
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => $question1->id,
            'option_text' => 'Melbourne',
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => $question1->id,
            'option_text' => 'Canberra',
            'is_correct' => true,
        ]);

        Option::create([
            'question_id' => $question1->id,
            'option_text' => 'Perth',
            'is_correct' => false,
        ]);

        // Question 2
        $question2 = Question::create([
            'quiz_id' => $quiz->id,
            'question_text' => 'Which is the largest ocean on Earth?',
        ]);

        Option::create([
            'question_id' => $question2->id,
            'option_text' => 'Atlantic Ocean',
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => $question2->id,
            'option_text' => 'Indian Ocean',
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => $question2->id,
            'option_text' => 'Arctic Ocean',
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => $question2->id,
            'option_text' => 'Pacific Ocean',
            'is_correct' => true,
        ]);

        // Question 3
        $question3 = Question::create([
            'quiz_id' => $quiz->id,
            'question_text' => 'Which country is known as the Land of the Rising Sun?',
        ]);

        Option::create([
            'question_id' => $question3->id,
            'option_text' => 'China',
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => $question3->id,
            'option_text' => 'South Korea',
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => $question3->id,
            'option_text' => 'Japan',
            'is_correct' => true,
        ]);

        Option::create([
            'question_id' => $question3->id,
            'option_text' => 'Thailand',
            'is_correct' => false,
        ]);

        // Question 4
        $question4 = Question::create([
            'quiz_id' => $quiz->id,
            'question_text' => 'What is the longest river in the world?',
        ]);

        Option::create([
            'question_id' => $question4->id,
            'option_text' => 'Amazon River',
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => $question4->id,
            'option_text' => 'Nile River',
            'is_correct' => true,
        ]);

        Option::create([
            'question_id' => $question4->id,
            'option_text' => 'Mississippi River',
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => $question4->id,
            'option_text' => 'Yangtze River',
            'is_correct' => false,
        ]);

        // Question 5
        $question5 = Question::create([
            'quiz_id' => $quiz->id,
            'question_text' => 'Which desert is the largest in the world?',
        ]);

        Option::create([
            'question_id' => $question5->id,
            'option_text' => 'Gobi Desert',
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => $question5->id,
            'option_text' => 'Kalahari Desert',
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => $question5->id,
            'option_text' => 'Sahara Desert',
            'is_correct' => true,
        ]);

        Option::create([
            'question_id' => $question5->id,
            'option_text' => 'Arabian Desert',
            'is_correct' => false,
        ]);
    }

    private function createLiteratureQuestions($quiz)
    {
        // Question 1
        $question1 = Question::create([
            'quiz_id' => $quiz->id,
            'question_text' => 'Who wrote \'Romeo and Juliet\'?',
        ]);

        Option::create([
            'question_id' => $question1->id,
            'option_text' => 'Charles Dickens',
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => $question1->id,
            'option_text' => 'William Shakespeare',
            'is_correct' => true,
        ]);

        Option::create([
            'question_id' => $question1->id,
            'option_text' => 'Jane Austen',
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => $question1->id,
            'option_text' => 'Mark Twain',
            'is_correct' => false,
        ]);

        // Question 2
        $question2 = Question::create([
            'quiz_id' => $quiz->id,
            'question_text' => 'Which novel begins with the line \'It was the best of times, it was the worst of times\'?',
        ]);

        Option::create([
            'question_id' => $question2->id,
            'option_text' => 'Pride and Prejudice',
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => $question2->id,
            'option_text' => 'Great Expectations',
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => $question2->id,
            'option_text' => 'A Tale of Two Cities',
            'is_correct' => true,
        ]);

        Option::create([
            'question_id' => $question2->id,
            'option_text' => 'Oliver Twist',
            'is_correct' => false,
        ]);

        // Question 3
        $question3 = Question::create([
            'quiz_id' => $quiz->id,
            'question_text' => 'Who is the author of \'To Kill a Mockingbird\'?',
        ]);

        Option::create([
            'question_id' => $question3->id,
            'option_text' => 'Harper Lee',
            'is_correct' => true,
        ]);

        Option::create([
            'question_id' => $question3->id,
            'option_text' => 'J.K. Rowling',
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => $question3->id,
            'option_text' => 'Ernest Hemingway',
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => $question3->id,
            'option_text' => 'F. Scott Fitzgerald',
            'is_correct' => false,
        ]);

        // Question 4
        $question4 = Question::create([
            'quiz_id' => $quiz->id,
            'question_text' => 'Which of these is NOT one of the Harry Potter books?',
        ]);

        Option::create([
            'question_id' => $question4->id,
            'option_text' => 'Harry Potter and the Chamber of Secrets',
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => $question4->id,
            'option_text' => 'Harry Potter and the Goblet of Fire',
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => $question4->id,
            'option_text' => 'Harry Potter and the Cursed Child',
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => $question4->id,
            'option_text' => 'Harry Potter and the Mystic Wand',
            'is_correct' => true,
        ]);

        // Question 5
        $question5 = Question::create([
            'quiz_id' => $quiz->id,
            'question_text' => 'Who wrote \'1984\'?',
        ]);

        Option::create([
            'question_id' => $question5->id,
            'option_text' => 'Aldous Huxley',
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => $question5->id,
            'option_text' => 'George Orwell',
            'is_correct' => true,
        ]);

        Option::create([
            'question_id' => $question5->id,
            'option_text' => 'Ray Bradbury',
            'is_correct' => false,
        ]);

        Option::create([
            'question_id' => $question5->id,
            'option_text' => 'H.G. Wells',
            'is_correct' => false,
        ]);
    }
}
