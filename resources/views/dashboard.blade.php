@extends('layouts.app')
@section('header')
  {{--  <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </div>
    </header>--}}
@stop
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div>
                        <ul id="messages">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-row flex-wrap flex-grow mt-2">
                    @include('partials._ticker_box')
                    @include('partials._ticker_box')
                    @include('partials._ticker_box')
                    @include('partials._ticker_box')
                    @include('partials._ticker_box')
                </div>
            </div>
        </div>
    </div>
@stop
@section('extra-scripts')
    <script src="{{ asset('js/stream.js') }}" defer></script>
@stop




{{--    <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                    <div>
                        <ul id="messages">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>--}}

