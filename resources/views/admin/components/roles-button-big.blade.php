<div>
    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal"
        data-bs-id="{{$model->id}}" data-bs-name="{{$model->name}}">
        Edit
    </button>

    <button href="{{ route('admin.roles.delete', $model) }}" class="btn btn-danger btn-sm" id="delete">Hapus</button>
</div>
<x-button-action />
