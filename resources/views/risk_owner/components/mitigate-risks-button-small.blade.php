 {{-- [
        'kode' => 'R5.3',
        'mitigation' => 3
    ], --}}
 <div>
     <button button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal"
         data-bs-id="{{ $model->id }}" data-bs-kode="{{ $model->kode }}"
          data-bs-mitigation="{{ $model->mitigation }}">
         <i class="fa-solid fa-pen-to-square"></i>
     </button> |
     <button href="{{ route('risk.owner.manage.delete', $model) }}" class="btn btn-danger btn-sm" id="delete">
         <i class="fa-solid fa-delete-left"></i>
     </button>
 </div>
 <x-button-action />
 </div>
