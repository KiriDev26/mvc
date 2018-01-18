<form method="POST" action="/?controller=UserController&action=create">
	<input name="User[name]"  value= "<?=$user->name?>" > 
	<input name="User[surname]"  value= "<?=$user->surname?>" > 
	<input name="User[email]"  value= "<?=$user->email?>" > 
	<input name="User[password]"  value= "<?=$user->password?>" > 
	<input type="submit" >
</form>
