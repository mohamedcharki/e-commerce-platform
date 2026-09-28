<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Lumière</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #0f172a;
            color: #f8fafc;
            font-family: 'Inter', sans-serif;
        }
        .glass {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .input-dark {
            background: rgba(0,0,0,0.2);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #f8fafc;
            transition: all 0.3s ease;
        }
        .input-dark:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
            outline: none;
        }
        .btn-primary {
            background: #6366f1;
            color: white;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background: #4f46e5;
            transform: translateY(-1px);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">

    <div class="glass w-full max-w-md rounded-2xl p-8 shadow-2xl relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-500 to-purple-600"></div>

        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold tracking-tight mb-2">
                <i class="fa-solid fa-bolt text-indigo-500 mr-2"></i>LUMIÈRE ADMIN
            </h1>
            <p class="text-gray-400">Sign in to manage the platform</p>
        </div>

        @if(session('success'))
            <div class="mb-4 p-3 rounded-xl bg-green-500/20 border border-green-500/30 text-green-300 text-sm text-center">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-4 p-3 rounded-xl bg-red-500/20 border border-red-500/30 text-red-300 text-sm text-center">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.post') }}" class="space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Email Address</label>
                <div class="relative">
                    <i class="fa-solid fa-envelope absolute left-4 top-3.5 text-gray-400"></i>
                    <input type="email" name="email" value="{{ old('email', 'admin@aura.com') }}"
                           required class="input-dark w-full rounded-xl pl-12 pr-4 py-3"
                           placeholder="admin@aura.com">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                <div class="relative">
                    <i class="fa-solid fa-lock absolute left-4 top-3.5 text-gray-400"></i>
                    <input type="password" name="password" required
                           class="input-dark w-full rounded-xl pl-12 pr-4 py-3"
                           placeholder="••••••••">
                </div>
            </div>

            <button type="submit" class="btn-primary w-full py-3.5 rounded-xl font-bold flex justify-center items-center gap-2">
                <i class="fa-solid fa-right-to-bracket"></i>
                <span>Sign In</span>
            </button>
        </form>
    </div>

</body>
</html>
