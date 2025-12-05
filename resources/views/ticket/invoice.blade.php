@extends('layout.user')
@section('title','Invoice')
@section('content')
    <!-- CDN Links -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Payment Invoice</h1>
                    <p class="text-gray-600 mt-1">Bus Ticket Purchase Receipt</p>
                </div>
                <div class="text-right">

                    <p class="text-sm text-gray-500 mt-2">INV#{{ $data->transaction_id }}</p>
                </div>
            </div>

            <!-- Invoice Card -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <!-- Header Section -->
                <div class="px-8 py-6 bg-gradient-to-r from-blue-600 to-indigo-700 text-white">
                    <div class="flex justify-between items-center">
                        <div>
                            <h2 class="text-2xl font-bold">HotBytes</h2>
                            <p class="text-blue-100">Your Journey, Our Priority</p>
                        </div>
                        <div class="text-right">
                            <p class="text-lg font-semibold">E-Ticket Invoice</p>
                            <p class="text-blue-100 text-sm">
                                {{\Carbon\Carbon::parse($data->created_at)->format('F d, Y')}}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Company & Customer Info -->
                <div class="px-8 py-6 grid grid-cols-1 md:grid-cols-2 gap-8 border-b">
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-3">Bus Details</h3>
                        <p class="font-medium text-gray-900">{{$data->slots->busInfo->bus_owner_info}}</p>
                        <p class="text-gray-600">{{$data->slots->busInfo->bus_name}}</p>
                        <p class="text-gray-600">{{$data->slots->busInfo->registration_number}}</p>
                        <p class="text-gray-600">contact@hotbytes.com</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-3">Passenger Details</h3>
                        <p class="font-medium text-gray-900">{{ $data->user->name }}</p>
                        <p class="text-gray-600">
                            {{ $data->user->email }}
                        </p>
                        <p class="text-gray-600">
                            {{ $data->user->phone }}
                        </p>

                    </div>
                </div>

                <!-- Journey Details -->
                <div class="px-8 py-6 border-b">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Journey Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="flex items-center mb-3">
                                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Departure</p>
                                    <p class="font-semibold text-gray-900">{{ $data->slots->busRoute->start_location }}</p>
                                </div>
                            </div>
                            <p class="text-sm font-medium text-gray-900 mt-2">
                                {{\Carbon\Carbon::parse($data->slots->schedule)->format('F d,Y | h:i A')}}
                            </p>
                        </div>

                        <div class="flex items-center justify-center">
                            <div class="relative">
                                <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="flex items-center mb-3">
                                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Arrival</p>
                                    <p class="font-semibold text-gray-900">{{ $data->slots->busRoute->end_location }}</p>
                                </div>
                            </div>

                            <p class="text-sm font-medium text-gray-900 mt-2">
                                {{\Carbon\Carbon::parse($data->slots->schedule)->format('F d,Y | h:i A')}}
                            </p>
                        </div>
                    </div>

                    <!-- Additional Journey Info -->
                    <div class="mt-6 grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="text-center p-3 bg-blue-50 rounded-lg">
                            <p class="text-sm text-gray-500">Bus Number</p>
                            <p class="font-semibold text-gray-900">{{ $data->slots->busInfo->bus_code }}</p>
                        </div>
                        <div class="text-center p-3 bg-blue-50 rounded-lg">
                            <p class="text-sm text-gray-500">Seat Number</p>
                            <p class="font-semibold text-gray-900">
                                {{ $cart->sit_list }}

                            </p>
                        </div>
                        <div class="text-center p-3 bg-blue-50 rounded-lg">
                            <p class="text-sm text-gray-500">Type</p>
                            <p class="font-semibold text-gray-900">{{ $data->slots->busInfo->type  }}</p>
                        </div>
                        <div class="text-center p-3 bg-blue-50 rounded-lg">
                            <p class="text-sm text-gray-500">Gender</p>
                            <p class="font-semibold text-gray-900">{{ ucfirst($cart->gender)  }}</p>
                        </div>
                    </div>
                </div>

                <!-- Payment Details -->
                <div class="px-8 py-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Payment Summary</h3>
                    <div class="overflow-hidden rounded-lg border">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unit Price</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{$data->slots->busInfo->bus_name}}</div>
                                    <div class="text-sm text-gray-500">{{ $data->slots->busRoute->start_location }}  to {{ $data->slots->busRoute->end_location }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{$cart->sit_count}}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">BDT {{$data->slots->price}}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">BDT {{$cart->sit_count*$data->slots->price}}</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">Company Discount</div>
                                    <div class="text-sm text-gray-500">General</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{$data->slots->discount}}%</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">BDT {{$data->slots->price*($data->slots->discount/100)}}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">BDT {{($data->slots->price*($data->slots->discount/100))*$cart->sit_count}}</td>
                            </tr>
                            @if($cart->coupon!=null)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">Coupon Discount</div>
                                    <div class="text-sm text-gray-500">{{$cart->coupons->name}}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{$cart->coupons->discount}}%</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">BDT {{$data->slots->price*($cart->coupons->discount/100)}}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" style="color:red;">BDT {{$data->slots->price*($cart->coupons->discount/100)*$cart->sit_count}}</td>
                            </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>

                    <!-- Total Amount -->
                    <div class="mt-6 flex justify-end">
                        <div class="w-full max-w-md">
                            <div class="space-y-3">
                                <div class="pt-3 flex justify-between text-lg font-bold">
                                    <span class="text-gray-900">Total Amount</span>
                                    <span class="text-blue-600">BDT
                                        @if($cart->coupon!=null)
                                            {{ $cart->sit_count*($data->slots->price-($data->slots->price*(($data->slots->discount+intval($cart->coupons->discount))/100))) }}
                                        @else
                                            {{ $cart->sit_count*($data->slots->price-($data->slots->price*(($data->slots->discount)/100))) }}
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-8 flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
                <div class="text-sm text-gray-500">
                    <p>Need help? Contact our customer support at support@busexpresspro.com</p>
                </div>
                <div class="flex space-x-4">
                    <button onclick="window.print()" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                        </svg>
                        Print Invoice
                    </button>
                </div>
            </div>

            <!-- Important Notes -->
            <div class="mt-8 p-6 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl border border-blue-100">
                <h4 class="text-sm font-semibold text-gray-700 uppercase tracking-wider mb-3">Important Information</h4>
                <ul class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm text-gray-600">
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-blue-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Present this invoice or e-ticket at the boarding point
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-blue-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Arrive at least 30 minutes before departure
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-blue-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Carry valid government-issued photo ID
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-blue-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Cancellation policy: 24 hours before departure
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Print Styles -->
    <style>
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                background: white !important;
            }
            .bg-white {
                background: white !important;
            }
            .shadow-xl {
                box-shadow: none !important;
            }
            .border {
                border-color: #e5e7eb !important;
            }
        }
    </style>
@endsection
