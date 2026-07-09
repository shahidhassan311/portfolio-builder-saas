<x-guest-layout>

    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold">Verify Email</h2>

        <p class="mt-2 text-gray-600">
            We have sent a 6-digit OTP to
            <strong>{{ $user->email }}</strong>
        </p>
    </div>


    {{-- Success Message --}}
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif


    {{-- Error Message --}}
    @if(session('error'))
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
            {{ session('error') }}
        </div>
    @endif


    {{-- Validation Error --}}
    @if($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
            {{ $errors->first() }}
        </div>
    @endif



    {{-- OTP Verify Form --}}
    <form method="POST" action="{{ route('otp.verify', $user) }}">
        @csrf

        <div>
            <x-input-label for="otp" value="OTP Code" />

            <x-text-input
                id="otp"
                name="otp"
                type="text"
                maxlength="6"
                class="block mt-1 w-full text-center tracking-widest"
                autofocus
            />

            <x-input-error
                :messages="$errors->get('otp')"
                class="mt-2"
            />
        </div>


        <div class="mt-6">
            <x-primary-button class="w-full justify-center">
                Verify OTP
            </x-primary-button>
        </div>

    </form>



    {{-- Resend OTP --}}
    <div class="mt-5 text-center">

        <form method="POST" action="{{ route('otp.resend', $user) }}">
            @csrf

            <button
                id="resendBtn"
                type="submit"
                class="text-blue-600 hover:underline disabled:text-gray-400"
                disabled
            >
                Resend OTP in
                <span id="timer">60</span> seconds
            </button>

        </form>

    </div>



<script>

let time = 60;

let timer = document.getElementById('timer');
let resendBtn = document.getElementById('resendBtn');


let countdown = setInterval(function(){

    time--;

    timer.innerHTML = time;


    if(time <= 0){

        clearInterval(countdown);

        resendBtn.disabled = false;

        resendBtn.innerHTML = "Resend OTP";

    }


},1000);


</script>


</x-guest-layout>
