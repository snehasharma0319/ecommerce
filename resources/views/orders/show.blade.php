@extends('layouts.app')

@section('content')
<div class="bg-white">
    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-xl">
            <h1 class="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">Order #{{ $order->id }}</h1>
            <p class="mt-2 text-sm text-gray-500">Order placed on {{ $order->created_at->format('F j, Y') }}</p>
        </div>

        <div class="mt-8 bg-gray-50 rounded-lg px-4 py-6 sm:px-6">
            <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-6">
                <div>
                    <h3 class="text-lg font-medium text-gray-900">Shipping Information</h3>
                    <div class="mt-3">
                        <p class="text-gray-500">{{ $order->shipping_address }}</p>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-medium text-gray-900">Billing Information</h3>
                    <div class="mt-3">
                        <p class="text-gray-500">{{ $order->billing_address }}</p>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-medium text-gray-900">Payment Method</h3>
                    <div class="mt-3">
                        <p class="text-gray-500">{{ $order->payment_method }}</p>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-medium text-gray-900">Order Status</h3>
                    <div class="mt-3">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            @if($order->status === 'completed') bg-green-100 text-green-800
                            @elseif($order->status === 'pending') bg-yellow-100 text-yellow-800
                            @else bg-red-100 text-red-800 @endif">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8">
            <h2 class="sr-only">Order items</h2>

            <div class="space-y-8">
                <table class="w-full">
                    <caption class="sr-only">Products</caption>
                    <thead class="sr-only text-sm text-left text-gray-500 sm:not-sr-only">
                        <tr>
                            <th scope="col" class="sm:w-2/5 lg:w-1/3 pr-8 py-3 font-normal">Product</th>
                            <th scope="col" class="hidden w-1/5 pr-8 py-3 font-normal sm:table-cell">Price</th>
                            <th scope="col" class="hidden pr-8 py-3 font-normal sm:table-cell">Quantity</th>
                            <th scope="col" class="w-0 py-3 font-normal text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody class="border-b border-gray-200 divide-y divide-gray-200 text-sm sm:border-t">
                        @foreach ($order->items as $item)
                            <tr>
                                <td class="py-6 pr-8">
                                    <div class="flex items-center">
                                        <div class="w-16 h-16 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
                                            @if ($item->product->image)
                                                <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-full h-full object-center object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center bg-gray-100">
                                                    <span class="text-gray-400">No image</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="font-medium text-gray-900">{{ $item->product->name }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="hidden py-6 pr-8 sm:table-cell">${{ number_format($item->price, 2) }}</td>
                                <td class="hidden py-6 pr-8 sm:table-cell">{{ $item->quantity }}</td>
                                <td class="py-6 font-medium text-right whitespace-nowrap">${{ number_format($item->subtotal, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="sm:ml-auto sm:w-1/2 sm:pl-6">
                    <dl class="space-y-4">
                        <div class="flex justify-between">
                            <dt class="text-sm text-gray-600">Subtotal</dt>
                            <dd class="text-sm font-medium text-gray-900">${{ number_format($order->total_amount, 2) }}</dd>
                        </div>
                        <div class="border-t border-gray-200 pt-4 flex items-center justify-between">
                            <dt class="text-base font-medium text-gray-900">Order total</dt>
                            <dd class="text-base font-medium text-gray-900">${{ number_format($order->total_amount, 2) }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>

        <div class="mt-8 flex justify-end">
            <a href="{{ route('orders.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                Back to Orders<span aria-hidden="true"> &rarr;</span>
            </a>
        </div>
    </div>
</div>
@endsection 