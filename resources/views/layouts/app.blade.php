<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laravel App')</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: #f9fafb;
            color: #111827;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 0 20px;
            width: 100%;
        }

        header {
            background-color: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            padding: 16px 0;
        }

        .nav-wrap {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 18px;
            font-weight: 700;
            color: #111827;
            text-decoration: none;
        }

        nav a {
            margin-left: 20px;
            text-decoration: none;
            color: #6b7280;
            font-size: 14px;
            font-weight: 500;
            padding-bottom: 4px;
            transition: color 0.15s ease;
        }

        nav a:hover {
            color: #111827;
        }

        nav a.active {
            color: #111827;
            font-weight: 600;
            border-bottom: 2px solid #111827;
        }

        main {
            flex: 1;
            padding: 40px 0;
        }

        .hero {
            text-align: center;
            padding: 60px 0;
        }

        .hero h1 {
            font-size: 32px;
            margin-bottom: 12px;
            color: #111827;
        }

        .hero p {
            color: #4b5563;
            margin-bottom: 25px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            border: 1px solid transparent;
        }

        .btn-primary {
            background-color: #111827;
            color: #ffffff;
        }

        .btn-primary:hover {
            background-color: #374151;
        }

        .btn-secondary {
            background-color: #ffffff;
            color: #374151;
            border-color: #d1d5db;
            margin-left: 8px;
        }

        .btn-secondary:hover {
            background-color: #f3f4f6;
        }

        .card {
            background-color: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 24px;
            max-width: 500px;
            margin: 0 auto;
        }

        .card-full {
            max-width: 100%;
        }

        .card h2 {
            font-size: 20px;
            margin-bottom: 16px;
            color: #111827;
        }

        .form-group {
            margin-bottom: 14px;
        }

        label {
            display: block;
            font-size: 14px;
            margin-bottom: 4px;
            color: #374151;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 8px 10px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 14px;
            font-family: inherit;
            resize: vertical;
            max-width: 100%;
        }

        input:focus,
        textarea:focus {
            outline: none;
            border-color: #111827;
        }

        input.error,
        textarea.error {
            border-color: #ef4444;
        }

        .alert-success {
            background-color: #ecfdf5;
            color: #065f46;
            border: 1px solid #a7f3d0;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .alert-danger {
            background-color: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .alert-danger ul {
            margin-left: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            font-size: 14px;
        }

        th,
        td {
            padding: 10px 12px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        th {
            background-color: #f9fafb;
            color: #6b7280;
            font-size: 12px;
            text-transform: uppercase;
        }

        footer {
            background-color: #ffffff;
            border-top: 1px solid #e5e7eb;
            padding: 20px 0;
            text-align: center;
            font-size: 13px;
            color: #6b7280;
        }
    </style>
</head>
<body>

    @include('partials.header')

    <main class="container">
        @yield('content')
    </main>

    @include('partials.footer')

</body>
</html>