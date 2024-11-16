<div>
    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal"
    data-bs-id="{{$model->id}}" data-bs-name="{{$model->name}}" data-bs-role="{{count($model->getRoleNames())> 0 ? $model->getRoleNames()[0] : '' }}" data-bs-email="{{$model->email}}" data-bs-pass="{{$model->password}}">
        Edit
    </button>

    <button href="{{ route('admin.users.delete', $model->id) }}" class="btn btn-danger btn-sm" id="delete">Hapus</button>
</div>
<x-button-action />
