@extends('master')

@section('title', 'Profile')

@section('content')

    <div class="container rounded bg-white mt-5 mb-5 shadow">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-4 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg" alt="Profile Picture">
                    <span class="font-weight-bold">{{ $user->name }}</span>
                    <span class="text-black-50">{{ $user->email }}</span>
                </div>
            </div>
            <div class="col-md-8">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Profile Settings</h4>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label for="name" class="labels">Name</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="First name" value="{{ old('name', $user->name) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="username" class="labels">Username</label>
                            <input type="text" id="username" name="username" class="form-control" value="{{ old('username', $user->username) }}" placeholder="Username" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label for="phone" class="labels">Mobile Number</label>
                            <input type="text" id="phone" name="phone" class="form-control no-spinners" placeholder="Enter phone number" value="{{ old('phone', $user->phone) }}" required>
                        </div>
                        <div class="col-md-12">
                            <label for="address" class="labels">Address</label>
                            <input type="text" id="address" name="address" class="form-control" placeholder="Enter address" value="{{ old('address', $user->address) }}" required>
                        </div>
                        <div class="col-md-12">
                            <label for="birthdate" class="labels">Birthdate</label>
                            <input type="date" id="birthdate" name="birthdate" class="form-control" placeholder="Enter birthdate" value="{{ old('birthdate', $user->birthdate) }}" required>
                        </div>
                        <div class="col-md-12">
                            <label for="email" class="labels">Email</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Enter email ID" value="{{ old('email', $user->email) }}" required>
                        </div>
                    </div>
                    <div class="mt-5 text-center">
                        <button class="btn btn-primary profile-button" type="submit">Save Profile</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

            </div>
        </div>
    </div>
</div>


<style>
.form-control:focus {
    box-shadow: none;
    border-color: #228be6;
}

.profile-button {
    background: #fff;
    box-shadow: none;
    border: 1px solid #228be6;
    color: #228be6;
}

.profile-button:hover {
    background: #228be6;
}

.profile-button:focus {
    background: #228be6;
    box-shadow: none;
}

.profile-button:active {
    background: #228be6;
    box-shadow: none;
}

.back:hover {
    color: #228be6;
    cursor: pointer;
}

.labels {
    font-size: 11px
}

.add-experience:hover {
    background: #228be6;
    color: #fff;
    cursor: pointer;
    border: solid 1px #228be6;
}
input[type="number"].no-spinners::-webkit-outer-spin-button,
    input[type="number"].no-spinners::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type="number"].no-spinners {
        -moz-appearance: textfield;
    }
</style>
@endsection
