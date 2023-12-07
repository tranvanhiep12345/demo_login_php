@extends('layout')

@section('title', 'Quyền truy cập')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex flex-wrap align-items-center justify-content-between mb-4" style="margin-top:20px">
                    <div style="display: flex; margin:auto">
                        <h4 class="mb-3">List Permission</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="table-responsive rounded mb-3">
                    <table class="data-table table mb-0 tbl-server-info">
                        <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>ID</th>
                            <th>Tên quyền truy cập</th>
                            <th>Mô tả</th>
                            <th>Tên role</th>
                        </tr>
                        </thead>
                        <tbody class="ligth-body">
                        @foreach ($permission as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->permission_name }}</td>
                                <td>{{ $item->permission_description }}</td>
                                <td>
                                    @foreach ($item->roles as $role)
                                        <span class="bg-secondary text-white">{{ $role->role_name }}</span>
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@endsection
