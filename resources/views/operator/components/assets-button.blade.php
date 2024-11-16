<div>
    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal"
        data-bs-id="{{$model->id}}" data-bs-kategori="{{$model->id_kategori}}" data-bs-aset="{{$model->name}}" data-bs-deskripsi="{{$model->deskripsi}}">
        Edit
    </button>

    <button href="{{ route('operator.assets.delete', $model) }}" class="btn btn-danger btn-sm" id="delete">Hapus</button>
</div>
<x-button-action />
