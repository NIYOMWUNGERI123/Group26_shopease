@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>Order Details</h2>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h5>Order Information</h5>
                            <p><strong>Order ID:</strong> {{ $order->id }}</p>
                            <p><strong>Date:</strong> {{ $order->created_at->format('M d, Y H:i') }}</p>
                            <p><strong>Status:</strong> 
                                <span class="badge bg-{{ 
                                    $order->status === 'completed' ? 'success' : 
                                    ($order->status === 'processing' ? 'primary' : 
                                    ($order->status === 'cancelled' ? 'danger' : 'warning')) 
                                }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <h5>Customer Information</h5>
                            <p><strong>Name:</strong> {{ $order->buyer->name }}</p>
                            <p><strong>Email:</strong> {{ $order->buyer->email }}</p>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-header">
                            <h5>Product Details</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    @if($order->product->image)
                                        <img src="{{ asset('storage/' . $order->product->image) }}" class="img-fluid" alt="{{ $order->product->name }}">
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    <h5>{{ $order->product->name }}</h5>
                                    <p><strong>Seller:</strong> {{ $order->product->seller->name }}</p>
                                    <p><strong>Price per unit:</strong> ${{ number_format($order->product->price, 2) }}</p>
                                    <p><strong>Quantity:</strong> {{ $order->quantity }}</p>
                                    <p><strong>Total Price:</strong> ${{ number_format($order->total_price, 2) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(auth()->user()->isSeller() && $order->product->seller_id === auth()->id())
                        <div class="card">
                            <div class="card-header">
                                <h5>Update Order Status</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('orders.status', $order) }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select class="form-select" id="status" name="status" required>
                                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                                            <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update Status</button>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 