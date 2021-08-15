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
                    <form action="{{ route('store') }}" method="POST">
                        <h4>Create a New Book</h4><hr><br>
                        @csrf
                        <p>
                            <label>Title</label>
                            <input type="text" name="title" value="{{ old('title') }}" />
                            @error('title')
                            <br><small style="color:red">{{ $message }}</small>
                            @enderror
                        </p>
                        <p>
                            <label>Author</label>
                            <input type="text" name="author" value="{{ old('author') }}" />
                            @error('author')
                            <br><small style="color:red">{{ $message }}</small>
                            @enderror
                        </p>
                        <p>
                            <label>Price</label>
                            <input type="text" name="price" value="{{ old('price') }}" />
                            @error('price')
                            <br><small style="color:red">{{ $message }}</small>
                            @enderror
                        </p>
                        <br>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                            Save
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>