@extends("app")

@section("content")
    <div class="container w-25 border p-4 my-4">
        <div class="row mx-auto">
            <form action="{{ route('categories.store')}}" method="POST">
                @csrf

                @if (session("success")) 
                    <h6 class="alert alert-success"> {{ session("success") }}</h6>
                @endif 

                @error("name")
                    <h6 class="alert alert-danger"> {{ $message }}</h6>
                @enderror

                <div class="mb-3">
                    <label for="name" class="form-label">Nombre de la categoria</label>
                    <input type="text" name="name" class="form-control" id="name">
                </div>  
                <div class="mb-3">
                    <label for="color" class="form-label">Color de la categoria</label>
                    <input type="color" name="color" class="form-control" id="color">
                </div>  

                <button type="submit" class="btn btn-primary">Crear nueva categoria</button>
            </form>

            <div>
                @foreach ($categories as $category)
                    <div class="row py-1">
                        <div class="col-md-9 d-flex align-items-center">
                            <a class="d-flex align-items-center gap-2" href="{{ route('categories.show', ['category' => $category->id]) }}">
                                <span class="color-container" style="background-color: {{ $category->color }};"></span> {{ $category->name }}
                            </a>
                        </div>
                        <div class="col-md-3 d-flex justify-content-end">
                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#{{ $category->id }}">
                                Eliminar
                            </button>
                        </div>
                    </div>

                    <div class="modal fade" id="{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Confirmar Eliminación</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    ¿Estás seguro de que deseas eliminar esta categoría?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <form action="{{ route('categories.destroy', ['category' => $category->id]) }}" method="POST">
                                        @method("DELETE")
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Eliminar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
