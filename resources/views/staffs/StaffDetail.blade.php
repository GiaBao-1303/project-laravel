<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
    <title>Profile</title>

    <style>
        body {
            background: rgb(99, 39, 120)
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #BA68C8
        }

        .profile-button {
            background: rgb(99, 39, 120);
            box-shadow: none;
            border: none
        }

        .profile-button:hover {
            background: #682773
        }

        .profile-button:focus {
            background: #682773;
            box-shadow: none
        }

        .profile-button:active {
            background: #682773;
            box-shadow: none
        }

        .back:hover {
            color: #682773;
            cursor: pointer
        }

        .labels {
            font-size: 11px
        }

        .add-experience:hover {
            background: #BA68C8;
            color: #fff;
            cursor: pointer;
            border: solid 1px #BA68C8
        }
    </style>
</head>

<body>
    <div class="container rounded bg-white mt-5 mb-5">

        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5"
                        width="150px"
                        src="{{ $emloyee->Gender === '0' ? asset('/assets/staffs/avatar-boy.png') : asset('/assets/staffs/avatar-girl.png') }}"><span
                        class="font-weight-bold">{{ $emloyee->LoginID }}</span>
                </div>
            </div>
            <div class="col-md-5 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Hồ Sơ</h4>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6"><label class="labels">NationalIDNumber</label>
                            <input disabled name="NationalIDNumber" type="text" class="form-control"
                                value="{{ $emloyee->NationalIDNumber }}">
                        </div>
                        <div class="col-md-6">
                            <label class="labels">LoginID</label>
                            <input disabled type="text" class="form-control" value="{{ $emloyee->LoginID }}">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label class="labels">OrganizationNode</label>
                            <input disabled type="text" class="form-control"
                                value="{{ $emloyee->OrganizationNode }}">
                        </div>
                        <div class="col-md-12">
                            <label class="labels">OrganizationLevel</label>
                            <input type="text" class="form-control" disabled
                                value="{{ $emloyee->OrganizationLevel }}">
                        </div>
                        <div class="col-md-12">
                            <label class="labels">JobTitle</label>
                            <input disabled type="text" class="form-control" value="{{ $emloyee->JobTitle }}">
                        </div>
                        <div class="col-md-12">
                            <label class="labels">BirthDate</label>
                            <input disabled type="text" class="form-control" value="{{ $emloyee->BirthDate }}">
                        </div>

                        <div class="col-md-12">
                            <label for="MaritalStatus" class="labels">MaritalStatus</label>
                            <div class="d-flex justify-content-around">
                                <div class="form-check">
                                    <input disabled {{ $emloyee->MaritalStatus === '0' ? 'checked' : '' }}
                                        value="0" class="form-check-input" type="radio" name="MaritalStatus"
                                        id="MaritalStatus">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Độc thân
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input disabled {{ $emloyee->MaritalStatus === '1' ? 'checked' : '' }}
                                        value="1" class="form-check-input" type="radio" name="MaritalStatus"
                                        id="MaritalStatus">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Đã kết hôn
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label for="MaritalStatus" class="labels">Gender</label>
                            <div class="d-flex justify-content-around">
                                <div class="form-check">
                                    <input disabled {{ $emloyee->Gender === '0' ? 'checked' : '' }} value="0"
                                        class="form-check-input" type="radio" name="Gender" id="MaritalStatus">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Nam
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input disabled {{ $emloyee->Gender === '1' ? 'checked' : '' }} value="1"
                                        class="form-check-input" type="radio" name="Gender" id="MaritalStatus">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Nữ
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label class="labels">HireDate</label>
                            <input disabled type="text" class="form-control" value="{{ $emloyee->HireDate }}">
                        </div>

                        <div class="col-md-12">
                            <label class="labels">VacationHours</label>
                            <input disabled type="text" class="form-control"
                                value="{{ $emloyee->VacationHours }}">
                        </div>

                        <div class="col-md-12">
                            <label class="labels">SickLeaveHours</label>
                            <input disabled type="text" class="form-control"
                                value="{{ $emloyee->SickLeaveHours }}">
                        </div>

                    </div>

                    <div class="d-flex justify-content-center">
                        <div class="mx-2 mt-5 text-center">
                            <a href="/staffs" class="btn btn-primary profile-button" type="button">
                                Trở về
                            </a>
                        </div>

                        <div class="mt-5 text-center">
                            <a href="/staffs/{{ $emloyee->BusinessEntityID }}/edit"
                                class="btn btn-primary profile-button" type="button">
                                Chỉnh sửa
                            </a>
                        </div>


                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center experience">
                        <span>Thông tin khác</span>
                    </div><br>
                    <div class="col-md-12">
                        <label class="labels">Ngày chỉnh sửa gần nhất</label>
                        <input disabled type="text" class="form-control" placeholder="experience"
                            value="{{ $emloyee->ModifiedDate }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

</body>

</html>
