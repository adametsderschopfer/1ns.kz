<?php
	if(isset($_POST['name']) && $_POST['name'] != '') {
		$name = $_POST['name'];
		if(isset($_POST['phone']) && $_POST['phone'] != '') {
			$phone = $_POST['phone'];

			$to = "info@techmir.kz"; 
			$from = "support@techmir.kz"; 
			$subject = "Techmir.kz - Новая заявка";
			$message = $name . " заказал звонок на номер: ". $phone;

			$headers = "From:" . $from;

			mail($to,$subject,$message,$headers);

			echo "Успешно";

		} else {
			echo '<span class="request-form__text">Вы не заполнили номер телефона!</span><br><a class="request-form__button" extends AnotherClass implements Interface
			{
				
			}
			onclick="retryForm()">Повторить</a>';
		}
	} else {
		echo '<span class="request-form__text">Вы не заполнили имя!</span><br><a class="request-form__button" onclick="retryForm()">Повторить</a>'; 
	}
