 {{-- [
        'kode' => 'R5.3',
        'id_aset' => 4,
        'kerentanan' => 'Jalur komunikasi yang tidak terlindungi (tidak ada kebijakan izin pemutusan kabel dan ganti rugi yang jelas ke pihak UPT. TIK XYZ)',
        'ancaman' => 'Rugi secara finansial, waktu, tenaga dalam perbaikan infrastruktur yang hancur',
        'potensi_sebab' => 'Pembangunan yang Memutuskan kabel tanpa izin yang jelas',
        'potensi_efek' => 'Kerugian Secara Finansial, waktu, tenaga dalam perbaikan infrastruktur yang hancur',
        'severity' => 7,
        'occurrence' => 8,
        'detection' => 5,
    ], --}}
<div>
    <button button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal"
    data-bs-id="{{$model->id}}" data-bs-asset="{{$model->id_aset}}" data-bs-kode="{{$model->kode}}" data-bs-kerentanan="{{$model->kerentanan}}" data-bs-ancaman="{{$model->ancaman}}" data-bs-sebab="{{$model->potensi_sebab}}" data-bs-efek="{{$model->potensi_efek}}" data-bs-severity="{{$model->severity}}" data-bs-occurrence="{{$model->occurrence}}" data-bs-detection="{{$model->detection}}">
        <i class="fa-solid fa-pen-to-square"></i>
    </button> |
    <button href="{{ route('risk.owner.analyze.delete', $model->id) }}" class="btn btn-danger btn-sm" id="delete">
        <i class="fa-solid fa-delete-left"></i>
    </button>
</div>
<x-button-action />