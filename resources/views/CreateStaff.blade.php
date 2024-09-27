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

    <div class="pt-4 vw-100 vh-100 d-flex justify-content-center align-items-center">
        <div class="container my-4 d-flex justify-content-center align-items-center">
            <form style="max-width: 500px" class="w-100 mt-4" action="/staff" method="POST">
                @csrf
    
                @foreach ($formInputs as $inputData)
                    <div class="form-group">
                        <label for="{{ $inputData }}">{{ $inputData }}</label>
                        <input type="text" name="{{ $inputData }}" class="form-control my-2" id="{{ $inputData }}" value="{{ old($inputData) }}">
                        @error($inputData)
                            <small class="d-block form-text mb-2 text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                @endforeach
                
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary">Tạo nhân viên</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>