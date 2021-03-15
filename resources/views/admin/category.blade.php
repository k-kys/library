@extends('admin.master')

@section('title', 'Thể loại')

@push('js')
<script>
    $(function(){
            $("jsGrid").jsGrid({
                height: "100%",
                width: "100%",

                sorting: true,
                paging: true,

                data: db.categories,

                fields: [
                    {name: "id", type: "text", width: 50},
                    {name: "name", type: "text", width: 150},
                ]
            })
        })
</script>
@endpush
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Thể Loại</h3>
    </div>
    <div class="card-body">
        <div id="jsGrid"></div>
    </div>
</div>
@endsection
