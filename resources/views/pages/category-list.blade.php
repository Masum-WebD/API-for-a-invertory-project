@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <table class="table table-striped" id="tableData">
            <thead>
                <tr>
                    <th scope="col">NO</th>
                    <th scope="col">Name</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody id="tableList">

            </tbody>
        </table>
    </div>
@endsection
@push('bottom_scripts')
    <script>
        getlist();
        async function getlist() {

            let res = await axios.get("/category-list");


            let tableList = $('#tableList');
            let tableData = $('#tableData');

            tableData.DataTable().destroy();
            tableData.empty();

            res.data.forEach(function(item, index) {
                let row = `<tr>
                    <td>${index+1}</td>
                        <td>${item['name']}</td>
                        <td>
                            <button type="button" class='btn btn-sm btn-outline-success' >Edit</button>
                            <button type="button"class='btn btn-sm btn-outline-danger' >Delete</button>
                            </td>
                    </tr>`;
                tableList.append(row);
            })

            tableData.DataTable({
                order: [
                    [0, 'desc'],
                ],
                lengthMenu: [5, 10, 15, 20, 30]
            })

        }
    </script>
@endpush
