@extends('layouts.main')

@section('title', 'Корзина товаров')

@section('content')

    <main>
        <div class="container">
            <h1 class="text-center mt-5">Корзина</h1>
            <div class="row mb-4">
                <div class="col-12 col-lg-8">
                    @if($order !== null)
                        @foreach($order->products as $product)

                            <article class="card mt-4 overflow-hidden">
                                <div class="row">
                                    <div class="col-12 col-sm-4">
                                        <div class="img-wrap">
                                            <img class="w-100" src="{{ asset('storage/' . $product->image) }}" alt="Изображение товара">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-8 d-flex align-items-center">
                                        <div class="p-3">
                                            <h3 class="fs-6 mb-2">
                                                {{ $product->title }}
                                            </h3>
                                            <p>Кол-во - {{ $product->pivot->count }} шт.
                                            </p>
                                            <p class="fw-bold fs-6 m-0">
                                                цена без скидки - {{ $product->price }} ₽ / шт.
                                            </p>
                                            <p class="fw-bold fs-6 m-0">
                                                с учётом скидки <span>5%</span> - 734 616 ₽ / шт.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </article>

                        @endforeach

                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="card p-3 mt-4">
                            <p class="fs-4">Общая сумма заказа:</p>
                            <p class="fw-bold">{{ $order->getFullPrice() }} ₽</p>
                            <p class="fs-4">Общая сумма заказа c учётом скидки <span>5%</span>:</p>
                            <p class="fw-bold">734 616 ₽</p>
                            <button class="btn btn-primary">Заказать</button>
                        </div>
                    </div>
                    @else
                        <h3>В корзине нет товаров</h3>
                    @endif


            </div>
        </div>
    </main>

@endsection

