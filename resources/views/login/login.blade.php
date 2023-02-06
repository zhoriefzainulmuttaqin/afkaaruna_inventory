<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Login</title>
    <link rel="stylesheet" href="./css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
</head>

<body>
    <section class="vh-100" style="background-color: #3445b4">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem">
                        <div class="card-body p-5 text-center bg-body-tertiary rounded">
                            <h3 class="mb-5">Login</h3>
                            <form action="login" method="POST">
                                @csrf
                                <div class="form-outline mb-4">
                                    <input type="text" id="" class="form-control form-control-lg"
                                        name="username" placeholder="Username" />
                                    <!-- <label class="form-label" for="typeEmailX-2">Email</label> -->
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="password" id="" class="form-control form-control-lg"
                                        name="password" placeholder="Password" />
                                    <!-- <label class="form-label" for="typePasswordX-2">Password</label> -->
                                </div>

                                <!-- Checkbox -->
                                <div class="form-check d-flex justify-content-start mb-3">
                                    <input class="form-check-input" type="checkbox" value="" id="form1Example3" />
                                    <label class="form-check-label" for="form1Example3">
                                        Remember password
                                    </label>
                                </div>

                                <button class="btn btn-primary btn-lg btn-block" type="submit">
                                    Login
                                </button>

                                <hr class="my-4" />
                                @if ($message = Session::get('error'))
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
</body>

</html>
