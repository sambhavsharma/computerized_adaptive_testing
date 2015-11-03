Note: This is a very basic php application, and because of my lack of experience in writing production level php applications, I recommend to use this application only as a reference and to search for best practices in php.

# Computerized Adaptive Quiz
This is a adaptive quiz web application. The questions presented to the user are selected on based of his skills. The logic behind the adaptiveness is very simple. The questions are divided into levels (1, 2, 3 etc), 1 being the easiest. Each question is also given a score of anything between 0 and 1, 1 being the toughest. This score helps in calculating the skill of the user since for each correct answer the competence level of the user is updated with this score (addition). For every wrong answer (1-score) is subtracted from the competence level, with the notion that if the user gives wrong answer for an easier question he should be penalised more than when he gives wrong answer for a tougher question.
Next if the competence level becomes greater than the current level, because of subsequent correct answers, the user is then presented with questions from higher level. Every user starts with a basic competence level of 1.

The score also helps in overall scoring. A simple formula like sigma of (level*score) can be applied to calculate the final overall score of the user. I have not implemented any login for this application but we do ask for a username, which helps us identify the user uniquely for storing his/her answers in the database. Though I delete the users' answers whenever he logs off. This can/should be changed depending on the required behavior of the application.

This application definitely needs better session management and local_storage/cookie usage. Other basic features which this application lacks are:

* Form validations. For example invalidate answer submit if no option is chosen.

* Giving a complete feedback at the result page with all question and their correct answers, and whether the user's answer was correct or incorrect.

* Allowing the user to navigate back to the previous question.

* Showing a summary of all answers to the user and allowing him to make any changes before submitting the answers.

* Timer implementation.

# Database Architecture
The database has four qtables.

* users

Attributes: id(pk), username

This table stores username and unique user id.


* questions

Attributes: id (pk), question, score, level, is_deleted

This tables stored question's unique id, the question, it's level, it's score and if it is deleted.
The is_deleted bit helps to check if the question has been deleted by the administrator. So we basically do a soft delete here.


* answers

Attributes: id(pk), question_id(fk to questions), answer, is_correct

This table stores the multiple choice answers for each question, their ids, the question's id and if the answer is the correct answer or not.


* user_answers

Attributes: user_id(fk to users), question_id(fk to questions), answer_id(fk to answers), is_correct

This table stores the user's answers for that current session, user's id, and if the answer is correct or not.

# Setting up the application and running it

Setup Database:

	mysql -u {user} -p{password} < {app_root}/lib/quiz.sql

Change the database configuration in conf/config.php file

Starting application on local php server (port 8080)

Inside application root folder:

	$ php -S localhost:8080
