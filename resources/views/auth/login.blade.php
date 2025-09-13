<!DOCTYPE html>
<html lang="id">

<head>
  <script src="https://static.readdy.ai/static/e.js"></script>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - Sistem Manajemen Cuti Karyawan</title>
  <script src="https://cdn.tailwindcss.com/3.4.16"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" />
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

  <main class="flex items-center justify-center min-h-[calc(100vh-80px)] px-6 py-12">
    <div class="w-full max-w-md">
      <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
        <div class="px-8 py-10">
          <div class="text-center mb-8">
            <div class="font-bold text-3xl text-primary mb-4">
              SMCK
            </div>
            <h1 class="text-2xl font-bold text-gray-900 mb-2">
              Masuk ke Akun
            </h1>
            <p class="text-gray-600">Kelola blog dan artikel Anda</p>
          </div>


          <form method="POST" action="{{ route('login') }}" class="space-y-6" id="loginForm">
            @csrf
            <meta name="csrf-token" content="{{ csrf_token() }}" ) <div class="space-y-2">
            <label for="email" class="block text-sm font-medium text-gray-700">Email atau NIP</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <div class="w-5 h-5 flex items-center justify-center">
                  <i class="ri-user-line text-gray-400"></i>
                </div>
              </div>
              <input type="text" id="email" name="email" required
                value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>"
                class="input-field w-full pl-10 pr-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent outline-none text-sm"
                placeholder="Masukkan email atau NIP" />
            </div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <div class="w-5 h-5 flex items-center justify-center">
                  <i class="ri-lock-line text-gray-400"></i>
                </div>
              </div>
              <input type="password" id="password" name="password" required
                class="input-field w-full pl-10 pr-12 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent outline-none text-sm"
                placeholder="Masukkan password" />
              <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                <div class="w-5 h-5 flex items-center justify-center password-toggle" id="togglePassword">
                  <i class="ri-eye-off-line text-gray-400"></i>
                </div>
              </div>
            </div>
            <button type="submit"
              class="w-full bg-primary text-white py-3 px-4 !rounded-button hover:bg-blue-600 focus:ring-4 focus:ring-blue-200 transition-all duration-300 font-medium text-sm whitespace-nowrap disabled:opacity-50 disabled:cursor-not-allowed">
              Masuk
            </button>
            <div class="mt-6 text-center">
              <p class="text-sm text-gray-600">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-primary hover:underline font-medium">
                  Daftar di sini
                </a>
              </p>
            </div>
        </div>

        </form>
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
          passwordInput.getAttribute("type") === "password" ?
            "text" :
            "password";
        passwordInput.setAttribute("type", type);

        if (type === "password") {
          toggleIcon.className = "ri-eye-off-line text-gray-400";
        } else {
          toggleIcon.className = "ri-eye-line text-gray-400";
        }
      });

      // Handle form submission
      const loginForm = document.getElementById('loginForm');
      const submitBtn = loginForm.querySelector('button[type="submit"]');

      loginForm.addEventListener('submit', function (e) {
        // Disable submit button to prevent double submission
        submitBtn.disabled = true;
        submitBtn.innerHTML = 'Sedang Login...';

        // Re-enable after 3 seconds if form hasn't submitted
        setTimeout(function () {
          submitBtn.disabled = false;
          submitBtn.innerHTML = 'Masuk Sekarang';
        }, 3000);
      });

      // Update CSRF token if needed
      const csrfToken = document.querySelector('meta[name="csrf-token"]');
      if (csrfToken) {
        const csrfInput = document.querySelector('input[name="_token"]');
        if (csrfInput) {
          csrfInput.value = csrfToken.getAttribute('content');
        }
      }
    });
  </script>
</body>

</html>