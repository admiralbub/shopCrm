@extends('beautymail::templates.widgets')

@section('content')

	@include('beautymail::templates.widgets.articleStart', ['color' => '#59b210'])

		<h4 class="secondary"><strong>Вас вітає команда Зелений майстер!</strong></h4>
		<p>Ми щойно отримали запит на зміну вашого пароля.</p>
        <p>Якщо ви не відправляли такий запит, проігноруйте це повідомлення. </p>
        <p>Проте, якщо ви не пам'ятаєте старий пароль, натисніть на посилання нижче, щоб створити новий пароль.</p>
		<p><a href="{{ route('reset.password.get', $token) }}">Відновити пароль</a></p>


	@include('beautymail::templates.widgets.articleEnd')


@stop