@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ __('Categories') }}</h5>
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('categories.create') }}" class="btn btn-light">
                            <i class="fas fa-plus"></i> {{ __('Add Category') }}
                        </a>
                    @endif
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="row">
                        @foreach($categories as $category)
                            <div class="col-md-4 mb-4">
                                <div class="card h-100">
                                    @if($category->image)
                                        <img src="{{ asset('images/' . $category->image) }}" class="card-img-top" alt="{{ $category->name }}">
                                    @else
                                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                            <i class="fas fa-image fa-3x text-muted"></i>
                                        </div>
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $category->name }}</h5>
                                        <p class="card-text">{{ $category->description }}</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <a href="{{ route('categories.show', $category) }}" class="btn btn-primary">
                                                <i class="fas fa-eye"></i> {{ __('View Products') }}
                                            </a>
                                            @if(auth()->user()->isAdmin())
                                                <div class="btn-group">
                                                    <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('{{ __('Are you sure you want to delete this category?') }}')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 