@extends('layouts.app')

@section('content')
<div class="bg-white">
    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:pb-24 lg:px-8">
        <div class="max-w-xl">
            <h1 class="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">Order history</h1>
            <p class="mt-2 text-sm text-gray-500">Check the status of recent orders, manage returns, and download invoices.</p>
        </div>

        <div class="mt-16">
            <h2 class="sr-only">Recent orders</h2>

            <div class="space-y-20">
                @forelse ($orders as $order)
                    <div>
                        <h3 class="sr-only">Order placed on {{ $order->created_at->format('F j, Y') }}</h3>

                        <div class="bg-gray-50 rounded-lg py-6 px-4 sm:px-6 sm:flex sm:items-center sm:justify-between sm:space-x-6 lg:space-x-8">
                            <dl class="divide-y divide-gray-200 space-y-6 text-sm text-gray-600 flex-auto sm:divide-y-0 sm:space-y-0 sm:grid sm:grid-cols-4 sm:gap-x-6 lg:w-1/2 lg:flex-none lg:gap-x-8">
                                <div class="flex justify-between sm:block">
                                    <dt class="font-medium text-gray-900">Date placed</dt>
                                    <dd class="sm:mt-1">{{ $order->created_at->format('F j, Y') }}</dd>
                                </div>

                                <div class="flex justify-between pt-6 sm:block sm:pt-0">
                                    <dt class="font-medium text-gray-900">Order number</dt>
                                    <dd class="sm:mt-1">#{{ $order->id }}</dd>
                                </div>

                                <div class="flex justify-between pt-6 sm:block sm:pt-0">
                                    <dt class="font-medium text-gray-900">Total amount</dt>
                                    <dd class="sm:mt-1">${{ number_format($order->total_amount, 2) }}</dd>
                                </div>

                                <div class="flex justify-between pt-6 sm:block sm:pt-0">
                                    <dt class="font-medium text-gray-900">Status</dt>
                                    <dd class="sm:mt-1">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            @if($order->status === 'completed') bg-green-100 text-green-800
                                            @elseif($order->status === 'pending') bg-yellow-100 text-yellow-800
                                            @else bg-red-100 text-red-800 @endif">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </dd>
                                </div>
                            </dl>

                            <a href="{{ route('orders.show', $order) }}" class="w-full flex items-center justify-center bg-white mt-6 py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:w-auto sm:mt-0">
                                View Order
                                <span class="sr-only">{{ $order->id }}</span>
                            </a>
                        </div>

                        <table class="mt-4 w-full text-gray-500 sm:mt-6">
                            <caption class="sr-only">Products</caption>
                            <thead class="sr-only text-sm text-gray-500 text-left sm:not-sr-only">
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
                    </div>
                @empty
                    <div class="text-center py-12">
                        <p class="text-lg text-gray-500">No orders found</p>
                        <div class="mt-6">
                            <a href="{{ route('products.index') }}" class="text-indigo-600 font-medium hover:text-indigo-500">
                                Start Shopping<span aria-hidden="true"> &rarr;</span>
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
 