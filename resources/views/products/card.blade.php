@foreach($products as $product)
    <div class="col-12 col-md-6 col-lg-4 col-xl-3">
        <!-- TODO: добавлять синюю рамку карточке товара (класс border-primary), если на товар можно потратить баллы -->
        <article class="card mt-5 overflow-hidden {{ $product->discount ? 'border-primary' : '' }}">
            <div class="img-wrap">
                <img class="w-100" src="{{ asset('storage/' . $product->image) }}" alt="Изображение товара">
            </div>
            <div class="p-3">
                <h3 class="fs-6 mb-3">
                    {{$product->title}}
                </h3>
                <div class="d-flex align-items-center justify-content-between">
                    <p class="fw-bold fs-5 m-0">
                        {{$product->price}} ₽
                    </p>



                    @if(auth()->check() && $product->orders()->where('user_id', auth()->user()->id)->where('product_id', $product->id)->exists())
                         <div class="d-flex align-items-center gap-3">
                             <form action="{{ route('cart.remove', $product) }}" method="post">
                                 @csrf
                                 <button type="submit" class="btn btn-outline-primary">-</button>
                             </form>

                             <span>{{ $product->orders()->where('product_id', $product->id)->first()->pivot->count }} </span>
                             <form action="{{ route('cart.add', $product) }}" method="post">
                                 @csrf
                                 <button type="submit" class="btn btn-outline-primary">+</button>
                             </form>

                        </div>
                    @else
                        <form action="{{ route('cart.add', $product) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                В корзину
                            </button>
                        </form>
                    @endif

                </div>
            </div>
        </article>
    </div>
@endforeach
