<!DOCTYPE html>
<html lang="ru">
<head>
<title>Заголовок страницы</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
</head>
<body>
<p>Регистрация</p>


<form method="post" action="http://localhost:81/api/users">

<input type="text" name="username"/><label for="">username</label><br>
<input type="password" name="password"/><label for="">password</label><br>
<input type="text" name="first_name"/><label for="">first_name</label><br>
<input type="text" name="last_name"/><label for="">last_name</label><br>
<input type="data" name="birthday"/><label for="">birthday</label><br>
<input type="email" name="email"/><label for="">email</label><br>


<input type="submit" name="send" value="Войти" /><br>

</form>
</body>
</html>
