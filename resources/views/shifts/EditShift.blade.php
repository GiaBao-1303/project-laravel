<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Sửa Ca Làm Việc</title>
</head>

<body>
    <div style="
            background: url('{{ asset('/assets/departments/department-bg.jpg') }}') no-repeat center center;
            background-size: cover;
        "
        class="position-relative d-flex vh-100 justify-content-center align-items-center">
        <div
            style="
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: inherit;
                filter: blur(50px);
                z-index: 0;
            ">
        </div>
        <div class="position-relative z-1 container d-flex justify-content-center align-items-center">
            <form style="max-width: 500px" class="w-100 row col-6 p-0 m-0 d-flex"
                action="/shifts/{{ $shift->ShiftID }}/edit" method="POST">
                @method('PUT')
                @csrf
                <div class="form-group col-6">
                    <label class="text-white" for="Name">Tên Ca Làm</label>
                    <input value="{{ old('Name') ? old('Name') : $shift->Name }}" type="text" name="Name"
                        class="form-control my-2" id="Name" value="{{ old('Name') }}">
                    @error('Name')
                        <small class="d-block form-text mb-2 text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                <div class="form-group col-6">
                    <label class="text-white" for="StartTime">Thời gian bắt đầu</label>
                    <input value="{{ old('StartTime') ? old('StartTime') : $shift->StartTime }}" type="text"
                        name="StartTime" class="form-control my-2" id="StartTime" value="{{ old('StartTime') }}">
                    @error('StartTime')
                        <small class="d-block form-text mb-2 text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                <div class="form-group col-6">
                    <label class="text-white" for="EndTime">Thời gian kết thúc</label>
                    <input value="{{ old('EndTime') ? old('EndTime') : $shift->EndTime }}" type="text" name="EndTime"
                        class="form-control my-2" id="EndTime" value="{{ old('EndTime') }}">
                    @error('EndTime')
                        <small class="d-block form-text mb-2 text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                <div class="d-flex justify-content-center mt-4">
                    <button type="submit" class="btn btn-primary">Sửa Ca Làm việc</button>
                </div>
            </form>

            <div class="row mx-4 col-6">
                <img class="object-cover" width="100%" height="100%" alt="image/background"
                    src="{{ asset('/assets/shifts/shift-form.jpg') }}" alt="">
            </div>
        </div>
    </div>
</body>

</html>
