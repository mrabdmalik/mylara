<x-app-layout>
    <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <!-- {{ __('Dashboard') }} -->[
            &nbsp;<a href="{{ route('book') }}">Books</a>
            &nbsp;<a href="{{ route('find') }}">Find</a>
            &nbsp;<a href="{{ route('create') }}">New</a>
            &nbsp;<a href="{{ route('email') }}">Email</a>
            &nbsp;<a href="{{ route('softdelete') }}">Restore</a> ] [
            &nbsp;<a href="{{ route('yajradt') }}">Vajra Datatable</a> ] [
            &nbsp;<a href="{{ route('client') }}">Spatie image</a>
            &nbsp;<a href="{{ route('client.create') }}">New</a>]
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p><strong># </strong>{{ $book->id }}</p>
                    <p><strong>Title: </strong>{{ $book->title }}</p>
                    <p><strong>Price: </strong>Rm {{ $book->price }}</p>
                    <p><strong>Author: </strong>{{ $book->author }}</p>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>