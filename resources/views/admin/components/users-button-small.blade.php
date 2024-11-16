
<div>
    <button button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal"
    data-bs-id="{{$model->id}}" data-bs-email="{{$model->email}}" data-bs-pass="{{$model->password}}" data-bs-name="{{$model->name}}">
        <i class="fa-solid fa-pen-to-square"></i>
    </button> |
    <button href="{{ route('admin.users.delete', $model->id) }}" class="btn btn-danger btn-sm" id="delete">
        <i class="fa-solid fa-delete-left"></i>
    </button>
</div>
<x-button-action />