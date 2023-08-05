<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield("title") - Waffles and Coffee</title>

        <meta name="description" content="@yield('description')">
        
        <meta property="og:title" content="@yield('title') - Waffles and Coffee">
        <meta property="og:description" content="@yield('description')">
        <meta property="og:type" content="website">

        <meta name="og:image" content="https://screenshots.jamesg.blog/?url={{ urlencode(Request::url()) }}&width=1200&height=630&full_page=true&device_scale=2&format=png&cache_seconds=86400">

        <link rel="manifest" href="/manifest.json">
        
        <style>
            :root {
                --var-link-color: darkgreen;
            }
            * {
                padding: 0;
                margin: 0;
                line-height: 1.5;
            }
            html {
                font-family: 'Inter', sans-serif;
                background-color: #f7f7f7;
                box-sizing: border-box;
            }
            body {
                max-width: 35em;
                margin: auto;
                margin-top: 3em;
            }
            a {
                color: darkgreen;
                text-decoration: none;
            }
            main {
                padding-top: 2em;
                padding-bottom: 2em;
            }
            nav {
                display: flex;
            }
            nav ul {
                list-style-type: none;
                display: flex;
            }
            nav ul li {
                padding-right: 10px;
            }
            main ul {
                list-style-type: none;
            }
            main li {
                padding-top: 10px;
                padding-bottom: 10px;
                border-bottom: 1px solid lightgrey;
            }
            .meta {
                padding-top: 5px;
            }
            input, textarea {
                display: block;
                margin-bottom: 10px;
            }
            input[type="submit"] {
                background-color: var(--var-link-color);
                color: white;
                border: none;
                padding: 10px;
                border-radius: 5px;
            }
            input[type="text"], input[type="email"], input[type="password"], textarea {
                padding: 10px;
                border-radius: 5px;
                border: 1px solid lightgrey;
                width: 100%;
            }
            footer {
                margin-top: 3em;
                text-align: center;
            }
            #content {
                background-color: white;
                padding: 10px;
                border-radius: 5px;
                margin-top: 10px;
                margin-bottom: 10px;
            }
            label {
                display: block;
                margin-bottom: 5px;
                font-weight: bold;
            }
            section {
                margin-top: 10px;
                margin-bottom: 10px;
            }
            nav ul:last-child {
                margin-left: auto;
            }
        </style>
    </head>
    <body>
        <nav>
            <ul>
                <li><a href="/">Coffee and Waffles</a></li>
                <li><a href="/new">Newest</a></li>
                <li><a href="/post">Submit</a></li>
            </ul>
            <ul>
                @if (Auth::check())
                    <li><a href="/user/{{ Auth::user()->name }}">{{ Auth::user()->name }}</a></li>
                    <li><a href="/logout">Sign Out</a></li>
                @else
                    <li><a href="/login">Sign In</a></li>
                @endif
            </ul>
        </nav>
        <main>
            @yield('content')
        </main>
        <footer>
            <p>Made with ❤️ and 🧇 by <a href="https://jamesg.blog">capjamesg</a>.</p>
        </footer>
    </body>
</html>