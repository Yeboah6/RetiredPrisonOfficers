@extends('layouts.app')

@section('content')

<!-- [ auth-signin ] start -->
<div class="auth-wrapper">
	<div class="auth-content">
		<div class="card">
			<div class="row align-items-center text-center">
				<div class="col-md-12">
					<div class="card-body">
						<h4 class="mb-3 f-w-400">Log In</h4>
                        <form action="{{ url('/login') }}" method="POST">
                            @if (Session::has('success'))
							    <div class="alert alert-success">{{ Session::get('success') }}</div>
						    @endif
						    @if (Session::has('fail'))
						    	<div class="alert alert-danger">{{ Session::get('fail') }}</div>
						    @endif

                            @csrf
						<div class="form-group mb-3">
							<label class="floating-label" for="Email">Email address</label>
							<input type="text" name="email" class="form-control" id="Email" value="{{old('email')}}">
						</div>
						<div class="form-group mb-4">
							<label class="floating-label" for="Password">Password</label>
							<input type="password" name="password" class="form-control" id="Password" placeholder="">
						</div>
						<button class="btn btn-block mb-4" type="submit" style="background-color: #A52A2A;color: #fff">Login</button>
                    </form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- [ auth-signin ] end -->

@endsection
