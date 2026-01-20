@php
    $single_panel = true;
    $width = 'max-w-md';
@endphp
@extends('layouts.auth')

@section('form_header')
    <h2 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-1">Lupa Password?</h2>
    <p class="text-sm text-gray-500">Kami akan membantu mengatur ulang password Anda.</p>
@endsection

@section('content')
    <!-- Alert Messages -->
    <div id="alert-container"></div>

    <!-- Form -->
    <form id="forgot-password-form" class="mt-4 space-y-6">
        @csrf
        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Alamat Email</label>
            <input id="email" name="email" type="email" autocomplete="email" required
                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition-all placeholder:text-gray-300"
                placeholder="nama@email.com">
            <span id="email-error" class="text-red-500 text-xs mt-1 font-medium hidden"></span>
        </div>

        <div>
            <button type="submit" id="submit-btn"
                class="group relative w-full flex justify-center py-3.5 px-4 border border-transparent text-sm font-bold rounded-xl text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 shadow-lg shadow-orange-600/20 transition-all duration-200 active:scale-[0.98]">
                <span id="btn-text">Kirim Link Reset Password</span>
                <span id="btn-loading" class="hidden">
                    <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                </span>
            </button>
        </div>
    </form>
@endsection

@section('form_footer')
    <div class="mt-10 text-center">
        <a href="{{ route('login') }}" class="font-bold text-orange-600 hover:text-orange-700 text-sm">
            Kembali ke Login
        </a>
    </div>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
    <script>
        // Initialize EmailJS
        emailjs.init({
            publicKey: "{{ config('services.emailjs.public_key') }}",
        });

        const form = document.getElementById('forgot-password-form');
        const emailInput = document.getElementById('email');
        const emailError = document.getElementById('email-error');
        const submitBtn = document.getElementById('submit-btn');
        const btnText = document.getElementById('btn-text');
        const btnLoading = document.getElementById('btn-loading');
        const alertContainer = document.getElementById('alert-container');

        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            // Reset errors
            emailError.classList.add('hidden');
            emailError.textContent = '';
            alertContainer.innerHTML = '';

            // Disable button
            submitBtn.disabled = true;
            btnText.classList.add('hidden');
            btnLoading.classList.remove('hidden');

            try {
                // Get CSRF token
                const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

                // Send request to backend to generate token
                const response = await fetch('{{ route('password.email') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        email: emailInput.value
                    })
                });

                const result = await response.json();

                if (response.ok && result.success) {
                    // Send email using EmailJS
                    const templateParams = {
                        to_email: result.data.email, // Target recipient
                        user_email: result.data.email, // Alias
                        email: result.data.email, // Alias

                        to_name: result.data.name, // Recipient name
                        user_name: result.data.name, // Alias

                        // sender variables
                        from_name: 'Ikan Bakar Nusantara',
                        sender_name: 'Ikan Bakar Nusantara',
                        name: 'Ikan Bakar Nusantara', // Common for From Name field

                        reset_link: result.data.reset_url,
                        reset_url: result.data.reset_url,
                        link: result.data.reset_url,
                        url: result.data.reset_url,
                        message: `Klik link berikut untuk reset password: ${result.data.reset_url}`
                    };

                    console.log('Sending EmailJS with params:', templateParams);

                    // Send email via EmailJS
                    const emailResponse = await emailjs.send(
                        "{{ config('services.emailjs.service_id') }}",
                        "{{ config('services.emailjs.template_id') }}",
                        templateParams
                    );

                    console.log('EmailJS Success:', emailResponse);

                    // Show success message
                    alertContainer.innerHTML = `
                        <div class="mb-6 p-4 rounded-xl bg-green-50 text-green-700 text-sm border border-green-100 flex items-start">
                            <svg class="h-5 w-5 text-green-400 mr-2 mt-0.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span>
                                <strong>Berhasil!</strong> Link reset password telah dikirim ke email Anda. Silakan cek inbox atau folder spam.
                            </span>
                        </div>
                    `;

                    // Clear form
                    emailInput.value = '';

                } else {
                    // Show error
                    if (result.errors && result.errors.email) {
                        emailError.textContent = result.errors.email[0];
                        emailError.classList.remove('hidden');
                    } else {
                        throw new Error(result.message || 'Terjadi kesalahan');
                    }
                }

            } catch (error) {
                console.error('Error:', error);
                alertContainer.innerHTML = `
                    <div class="mb-6 p-4 rounded-xl bg-red-50 text-red-700 text-sm border border-red-100 flex items-start">
                        <svg class="h-5 w-5 text-red-400 mr-2 mt-0.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                        <span>Gagal mengirim email. Silakan coba lagi.</span>
                    </div>
                `;
            } finally {
                // Enable button
                submitBtn.disabled = false;
                btnText.classList.remove('hidden');
                btnLoading.classList.add('hidden');
            }
        });
    </script>
@endsection
