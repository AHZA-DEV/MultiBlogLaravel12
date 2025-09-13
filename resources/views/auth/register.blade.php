<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register - Multi Blog</title>
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css"
    />
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              primary: "#3B82F6",
              secondary: "#64748B",
            },
            borderRadius: {
              none: "0px",
              sm: "4px",
              DEFAULT: "8px",
              md: "12px",
              lg: "16px",
              xl: "20px",
              "2xl": "24px",
              "3xl": "32px",
              full: "9999px",
              button: "8px",
            },
          },
        },
      };
    </script>
    <style>
      :where([class^="ri-"])::before {
        content: "\f3c2";
      }
      .gradient-bg {
        background: linear-gradient(135deg, #f8fafc 0%, #b2d8ff 100%);
      }
      .input-field {
        transition: all 0.3s ease;
      }
      .input-field:focus {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
      }
      .password-toggle {
        cursor: pointer;
        transition: color 0.2s ease;
      }
      .password-toggle:hover {
        color: #3b82f6;
      }
    </style>
  </head>
  <body class="gradient-bg min-h-screen">

    <main
      class="flex items-center justify-center min-h-[calc(100vh-80px)] px-6 py-12"
    >
      <div class="w-full max-w-md">
        <div
          class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden"
        >
          <div class="px-8 py-10">
            <div class="text-center mb-8">
              <div class="font-bold text-3xl text-primary mb-4">
                Multi Blog
              </div>
              <h1 class="text-2xl font-bold text-gray-900 mb-2">
                Daftar Akun Baru
              </h1>
              <p class="text-gray-600">Bergabung sebagai penulis</p>
            </div>

            @if ($errors->any())
            <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
              <ul class="text-red-600 text-sm space-y-1">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
              @csrf
              
              <div class="space-y-2">
                <label
                  for="name"
                  class="block text-sm font-medium text-gray-700"
                  >Nama Lengkap</label
                >
                <div class="relative">
                  <div
                    class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
                  >
                    <div class="w-5 h-5 flex items-center justify-center">
                      <i class="ri-user-line text-gray-400"></i>
                    </div>
                  </div>
                  <input
                    type="text"
                    id="name"
                    name="name"
                    required
                    value="{{ old('name') }}"
                    class="input-field w-full pl-10 pr-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent outline-none text-sm @error('name') border-red-500 @enderror"
                    placeholder="Masukkan nama lengkap"
                  />
                </div>
              </div>

              <div class="space-y-2">
                <label
                  for="email"
                  class="block text-sm font-medium text-gray-700"
                  >Email</label
                >
                <div class="relative">
                  <div
                    class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
                  >
                    <div class="w-5 h-5 flex items-center justify-center">
                      <i class="ri-mail-line text-gray-400"></i>
                    </div>
                  </div>
                  <input
                    type="email"
                    id="email"
                    name="email"
                    required
                    value="{{ old('email') }}"
                    class="input-field w-full pl-10 pr-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent outline-none text-sm @error('email') border-red-500 @enderror"
                    placeholder="Masukkan email"
                  />
                </div>
              </div>

              <div class="space-y-2">
                <label
                  for="password"
                  class="block text-sm font-medium text-gray-700"
                  >Password</label
                >
                <div class="relative">
                  <div
                    class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
                  >
                    <div class="w-5 h-5 flex items-center justify-center">
                      <i class="ri-lock-line text-gray-400"></i>
                    </div>
                  </div>
                  <input
                    type="password"
                    id="password"
                    name="password"
                    required
                    class="input-field w-full pl-10 pr-12 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent outline-none text-sm @error('password') border-red-500 @enderror"
                    placeholder="Minimal 8 karakter"
                  />
                  <div
                    class="absolute inset-y-0 right-0 pr-3 flex items-center"
                  >
                    <div
                      class="w-5 h-5 flex items-center justify-center password-toggle"
                      id="togglePassword"
                    >
                      <i class="ri-eye-off-line text-gray-400"></i>
                    </div>
                  </div>
                </div>
              </div>

              <div class="space-y-2">
                <label
                  for="password_confirmation"
                  class="block text-sm font-medium text-gray-700"
                  >Konfirmasi Password</label
                >
                <div class="relative">
                  <div
                    class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
                  >
                    <div class="w-5 h-5 flex items-center justify-center">
                      <i class="ri-lock-line text-gray-400"></i>
                    </div>
                  </div>
                  <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    required
                    class="input-field w-full pl-10 pr-12 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent outline-none text-sm"
                    placeholder="Ulangi password"
                  />
                  <div
                    class="absolute inset-y-0 right-0 pr-3 flex items-center"
                  >
                    <div
                      class="w-5 h-5 flex items-center justify-center password-toggle"
                      id="togglePasswordConfirm"
                    >
                      <i class="ri-eye-off-line text-gray-400"></i>
                    </div>
                  </div>
                </div>
              </div>

              <button
                type="submit"
                class="w-full bg-primary text-white py-3 px-4 !rounded-button hover:bg-blue-600 focus:ring-4 focus:ring-blue-200 transition-all duration-300 font-medium text-sm whitespace-nowrap disabled:opacity-50 disabled:cursor-not-allowed"
              >
                Daftar Sekarang
              </button>
            </form>

            <div class="mt-6 text-center">
              <p class="text-sm text-gray-600">
                Sudah punya akun? 
                <a href="{{ route('login') }}" class="text-primary hover:underline font-medium">
                  Masuk di sini
                </a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </main>

    <script>
      document.addEventListener("DOMContentLoaded", function () {
        // Password toggle
        const passwordInput = document.getElementById("password");
        const togglePassword = document.getElementById("togglePassword");
        const toggleIcon = togglePassword.querySelector("i");

        togglePassword.addEventListener("click", function () {
          const type =
            passwordInput.getAttribute("type") === "password"
              ? "text"
              : "password";
          passwordInput.setAttribute("type", type);

          if (type === "password") {
            toggleIcon.className = "ri-eye-off-line text-gray-400";
          } else {
            toggleIcon.className = "ri-eye-line text-gray-400";
          }
        });

        // Password confirmation toggle
        const passwordConfirmInput = document.getElementById("password_confirmation");
        const togglePasswordConfirm = document.getElementById("togglePasswordConfirm");
        const toggleConfirmIcon = togglePasswordConfirm.querySelector("i");

        togglePasswordConfirm.addEventListener("click", function () {
          const type =
            passwordConfirmInput.getAttribute("type") === "password"
              ? "text"
              : "password";
          passwordConfirmInput.setAttribute("type", type);

          if (type === "password") {
            toggleConfirmIcon.className = "ri-eye-off-line text-gray-400";
          } else {
            toggleConfirmIcon.className = "ri-eye-line text-gray-400";
          }
        });
      });
    </script>
  </body>
</html>