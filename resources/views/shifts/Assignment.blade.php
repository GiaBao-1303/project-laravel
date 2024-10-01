<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Bootstrap User Management Data Table</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <style>
        body {
            color: #566787;
            background: #f5f5f5;
            font-family: 'Varela Round', sans-serif;
            font-size: 13px;
        }

        .table-responsive {
            margin: 30px 0;
        }

        .table-wrapper {
            min-width: 1000px;
            background: #fff;
            padding: 20px 25px;
            border-radius: 3px;
            box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
        }

        .table-title {
            padding-bottom: 15px;
            background: #299be4;
            color: #fff;
            padding: 16px 30px;
            margin: -20px -25px 10px;
            border-radius: 3px 3px 0 0;
        }

        .table-title h2 {
            margin: 5px 0 0;
            font-size: 24px;
        }

        .table-title .btn {
            color: #566787;
            float: right;
            font-size: 13px;
            background: #fff;
            border: none;
            min-width: 50px;
            border-radius: 2px;
            border: none;
            outline: none !important;
            margin-left: 10px;
        }

        .table-title .btn:hover,
        .table-title .btn:focus {
            color: #566787;
            background: #f2f2f2;
        }

        .table-title .btn i {
            float: left;
            font-size: 21px;
            margin-right: 5px;
        }

        .table-title .btn span {
            float: left;
            margin-top: 2px;
        }

        table.table tr th,
        table.table tr td {
            border-color: #e9e9e9;
            padding: 12px 15px;
            vertical-align: middle;
        }

        table.table tr th:first-child {
            width: 60px;
        }

        table.table tr th:last-child {
            width: 100px;
        }

        table.table-striped tbody tr:nth-of-type(odd) {
            background-color: #fcfcfc;
        }

        table.table-striped.table-hover tbody tr:hover {
            background: #f5f5f5;
        }

        table.table th i {
            font-size: 13px;
            margin: 0 5px;
            cursor: pointer;
        }

        table.table td:last-child i {
            opacity: 0.9;
            font-size: 22px;
            margin: 0 5px;
        }

        table.table td a {
            font-weight: bold;
            color: #566787;
            display: inline-block;
            text-decoration: none;
        }

        table.table td a:hover {
            color: #2196F3;
        }

        table.table td a.settings {
            color: #2196F3;
        }

        table.table td a.delete {
            color: #F44336;
        }

        table.table td i {
            font-size: 19px;
        }

        table.table .avatar {
            border-radius: 50%;
            vertical-align: middle;
            margin-right: 10px;
        }

        .status {
            font-size: 30px;
            margin: 2px 2px 0 0;
            display: inline-block;
            vertical-align: middle;
            line-height: 10px;
        }

        .text-success {
            color: #10c469;
        }

        .text-info {
            color: #62c9e8;
        }

        .text-warning {
            color: #FFC107;
        }

        .text-danger {
            color: #ff5b5b;
        }

        .pagination {
            float: right;
            margin: 0 0 5px;
        }

        .pagination li a {
            border: none;
            font-size: 13px;
            min-width: 30px;
            min-height: 30px;
            color: #999;
            margin: 0 2px;
            line-height: 30px;
            border-radius: 2px !important;
            text-align: center;
            padding: 0 6px;
        }

        .pagination li a:hover {
            color: #666;
        }

        .pagination li.active a,
        .pagination li.active a.page-link {
            background: #03A9F4;
        }

        .pagination li.active a:hover {
            background: #0397d6;
        }

        .pagination li.disabled i {
            color: #ccc;
        }

        .pagination li i {
            font-size: 16px;
            padding-top: 6px
        }

        .hint-text {
            float: left;
            margin-top: 10px;
            font-size: 13px;
        }

        .form {

            position: relative;
        }

        .form .fa-search {

            position: absolute;
            top: 20px;
            left: 20px;
            color: #9ca3af;

        }

        .form span {

            position: absolute;
            right: 17px;
            top: 13px;
            padding: 2px;
            border-left: 1px solid #d1d5db;

        }

        .left-pan {
            padding-left: 7px;
        }

        .left-pan i {

            padding-left: 10px;
        }

        .form-input {

            height: 55px;
            text-indent: 33px;
            border-radius: 10px;
        }

        .form-input:focus {

            box-shadow: none;
            border: none;
        }
    </style>
</head>

<body>
    <form method="POST" action="/shifts/{{ $shift->ShiftID }}/assignment" class="container-xl">
        @csrf
        @error('DepartmentError')
            <div class="mt-4 alert alert-danger" role="alert">
                {{ $message }}
            </div>
        @enderror
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-5">
                            <h2>Phân Công <b>Ca Làm Việc</b></h2>
                        </div>
                        <div class="col-sm-7">
                            <button type="submit" class="btn btn-secondary"><i class="material-icons">&#xE147;</i>
                                <span>Lưu</span></button>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th></th>
                            <th>NationalIDNumber</th>
                            <th>LoginId</th>
                            <th>JobTitle</th>
                            <th>Gender</th>
                            <th>MaritalStatus</th>
                            <th>BirthDate</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($emloyees as $emloyee)
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="business_entity_ids[]"
                                            value="{{ $emloyee->BusinessEntityID }}"
                                            id="flexCheckChecked_{{ $emloyee->BusinessEntityID }}">
                                        <label class="form-check-label"></label>
                                    </div>
                                </td>
                                <td>{{ $emloyee->BusinessEntityID }}</td>
                                <td>{{ $emloyee->NationalIDNumber }}</td>
                                <td>
                                    <a href="/staffs/{{ $emloyee->BusinessEntityID }}">
                                        <img width="50px" height="50px"
                                            src="{{ $emloyee->Gender === '0' ? asset('/assets/staffs/avatar-boy.png') : asset('/assets/staffs/avatar-girl.png') }}"
                                            class="avatar" alt="Avatar">
                                        {{ $emloyee->LoginID }}
                                    </a>
                                </td>
                                <td>{{ $emloyee->JobTitle }}</td>
                                <td>{{ $emloyee->Gender === '0' ? 'Nam' : 'Nữ' }}</td>
                                <td>{{ $emloyee->MaritalStatus === '0' ? 'Độc thân' : 'Đã kết hôn' }}</td>
                                <td><span class="status text-success">&bull;</span> {{ $emloyee->BirthDate }}</td>
                            </tr>
                        @endforeach

                        @foreach ($employeesAlreadyAssign as $emloyee)
                            <tr>
                                <td>{{ $shift->Name }}</td>
                                <td>{{ $emloyee->BusinessEntityID }}</td>
                                <td>{{ $emloyee->NationalIDNumber }}</td>
                                <td>
                                    <a href="/staffs/{{ $emloyee->BusinessEntityID }}">
                                        <img width="50px" height="50px"
                                            src="{{ $emloyee->Gender === '0' ? asset('/assets/staffs/avatar-boy.png') : asset('/assets/staffs/avatar-girl.png') }}"
                                            class="avatar" alt="Avatar">
                                        {{ $emloyee->LoginID }}
                                    </a>
                                </td>
                                <td>{{ $emloyee->JobTitle }}</td>
                                <td>{{ $emloyee->Gender === '0' ? 'Nam' : 'Nữ' }}</td>
                                <td>{{ $emloyee->MaritalStatus === '0' ? 'Độc thân' : 'Đã kết hôn' }}</td>
                                <td><span class="status text-success">&bull;</span> {{ $emloyee->BirthDate }}</td>

                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </form>


</body>

</html>
