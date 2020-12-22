# Laravel McqQuiz

1) create database and add it in env files
2) php artisan migrate (to create table)
3) add admin with hash password in database.
	INSERT INTO `users` (`id`, `name`, `password`, `created_at`)
	VALUES ('1', 'admin', '$2y$10$xSugoyKv765TY8DsERJ2/.mPIOwLNdM5Iw1n3x1XNVymBlHNG4cX6', '2020-12-19 00:00:00');
	'$2y$10$xSugoyKv765TY8DsERJ2/.mPIOwLNdM5Iw1n3x1XNVymBlHNG4cX6' is hashed  of  123456
4) admin can see the users name and score in datatable.
5) guest can add name and start the quiz. refresh page can change the questions.
	after clicking submit button score to be displayed in modal.
	and it redirect to login.
