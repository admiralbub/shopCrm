@extends('beautymail::templates.widgets')

@section('content')

	@include('beautymail::templates.widgets.articleStart', ['color' => '#59b210'])
        
		<h4 class="secondary"><strong>Добрий день, {{$name}}</strong></h4>
		<p>Ваше замовлення №{{$id}} було отримано. <br> Зачекайте, найближчим часом його буде прийнято в роботу.</p>
		<p>Ваше замовлення</p>
		<table width="100%" style="color:#888888">
			<tr>
				<th align="center"></th>
				<th align="center">Назва товару</th>
				<th align="center">Кіл.</th>
				<th align="center">Тара.</th>
				<th align="center">Ціна.</th>
				
			</tr>
			@foreach($products as $product)
				<tr>
					<td align="center"><img src="{{asset($product->image)}}" width="60px"></td>	
					<td align="center" height="25" ><a href="{{route('product.view',['slug'=>$product->slug])}}" style="text-decoration: none;color:#888888;">{{$product->name_ua}}</a></td>
					<td align="center" height="25">{{$product->pivot->quantity}}</td>
					<td align="center" height="25">{{$product->packs->first()->name_ua}}</td>
					<td align="center" height="25">{{$product->pivot->price}} грн</td>
				</tr>
			@endforeach
			
		</table>

		<br>
		<strong>Разом: {{$order_last->total}} грн.</strong><br>
		@if($order_last->bonus_discount !=0)
			<span>Бонусна знижка: {{$order_last->bonus_discount}} грн.</span><br>
			<span>Разом з бонусною знижкою: {{number_format($order->total - $order->bonus_discount, 2, '.', ' ')}} грн.</span><br>

		@elseif($order_last->promocode !="")
			<span>Бонусна знижка: {{$order_last->promocode_discount}} грн.</span><br>
			<span>Разом з бонусною знижкою: {{number_format($order_last->total - ($order_last->total * $order_last->promocode_discount) / 100, 2, '.', ' ')}} грн.</span><br>
        @endif
	@include('beautymail::templates.widgets.articleEnd')


@stop