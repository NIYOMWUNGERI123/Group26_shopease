@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>{{ $product->name }}</h2>
                    @if(auth()->user()->isSeller() && $product->seller_id === auth()->id())
                        <div class="float-end">
                            <a href="{{ route('products.edit', $product) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                            </form>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid mb-3" alt="{{ $product->name }}">
                    @endif
                    <p class="card-text">{{ $product->description }}</p>
                    <p class="card-text"><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
                    <p class="card-text"><strong>Stock:</strong> {{ $product->stock }}</p>
                    <p class="card-text"><strong>Seller:</strong> {{ $product->seller->name }}</p>
                    
                    @if(auth()->user()->isBuyer() && $product->stock > 0)
                        <a href="{{ route('orders.create', $product) }}" class="btn btn-success">Order Now</a>
                    @endif
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <h3>Comments</h3>
                </div>
                <div class="card-body">
                    @if(auth()->user()->isBuyer())
                        <form action="{{ route('comments.store', $product) }}" method="POST" class="mb-4">
                            @csrf
                            <div class="mb-3">
                                <label for="comment" class="form-label">Your Comment</label>
                                <textarea class="form-control @error('comment') is-invalid @enderror" id="comment" name="comment" rows="3" required>{{ old('comment') }}</textarea>
                                @error('comment')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="rating" class="form-label">Rating (1-5)</label>
                                <input type="number" class="form-control @error('rating') is-invalid @enderror" id="rating" name="rating" min="1" max="5" value="{{ old('rating') }}" required>
                                @error('rating')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Submit Comment</button>
                        </form>
                    @endif

                    @foreach($product->comments as $comment)
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h5 class="card-title">{{ $comment->user->name }}</h5>
                                    <div>
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $comment->rating)
                                                <span class="text-warning">★</span>
                                            @else
                                                <span class="text-secondary">★</span>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                                <p class="card-text">{{ $comment->comment }}</p>
                                <p class="card-text"><small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small></p>
                                @if(auth()->id() === $comment->user_id)
                                    <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this comment?')">Delete</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 