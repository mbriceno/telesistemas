<label>¡Bienvenid@ a Telesistema Web!</label>
<p>
Se ha creado una nueva cuenta de usuario, sus datos de acceso son los siguientes:<br><br>
Usuario: {{$data['name']}}<br>
Password: {{$data['password']}}<br>
</p>
<p>
	Por favor almacene estos datos en un lugar seguro y deseche este email.
</p>
<p>
	Atentamente,<br>
	{{$empresa->razon_social}}
</p>