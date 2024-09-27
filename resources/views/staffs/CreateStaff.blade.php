<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Tạo nhân viên</title>
</head>
<body>
    <div style="
            background: url('{{ asset('/assets/staffs/create-staff-bg.webp') }}') no-repeat center center;
            background-size: cover;
        " class="position-relative d-flex vh-100 justify-content-center align-items-center">
            <div style="
                position: absolute; /* Đặt vị trí tuyệt đối */
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: inherit;
                filter: blur(50px);
                z-index: 0;
            "></div>
        <div class="position-relative z-1 container d-flex justify-content-center align-items-center">
            <form style="max-width: 500px" class="w-100 row col-6 p-0 m-0 d-flex" action="/staff" method="POST">
                @csrf
                @foreach ($formInputs as $inputData)
                    <div class="form-group col-6">
                        <label class="text-white" for="{{ $inputData }}">{{ $inputData }}</label>
                        <input type="text" name="{{ $inputData }}" class="form-control my-2" id="{{ $inputData }}" value="{{ old($inputData) }}">
                        @error($inputData)
                            <small class="d-block form-text mb-2 text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                @endforeach
                
                <div class="d-flex justify-content-center mt-4">
                    <button type="submit" class="btn btn-primary">Tạo nhân viên</button>
                </div>
            </form>

            <div class="row mx-4 col-6">
                <img class="object-cover" width="100%" height="100%" alt="image/background" src="{{ asset("/assets/staffs/create-staff-form.jpg") }}" alt="">
            </div>
        </div>
    </div>
</body>
</html>