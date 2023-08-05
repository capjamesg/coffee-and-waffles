<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <style>
            :root {
                --var-link-color: darkgreen;
            }
            * {
                padding: 0;
                margin: 0;
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
        </style>
    </head>
    <body>
        <nav>
            <ul>
                <li><a href="/">Coffee and Waffles</a></li>
                <li><a href="/">Trending</a></li>
                <li><a href="/">Newest</a></li>
                <li><a href="/">Submit</a></li>
            </ul>
            <ul>
                @if (Auth::check())
                    <li><a href="{{ Auth::user()->domain }} ">{{ Auth::user()->name }}</a></li>
                    <li><a href="/logout">Sign Out</a></li>
                @else
                    <li><a href="/login">Sign In</a></li>
                @endif
            </ul>
        </nav>
        <main>
            <ul>
                @foreach ($posts as $post)
                    <li>
                        <a href="{{ $post->post_url }}">
                            <div class="title">#{{ $post->id }}: {{ $post->title }}</div>
                            <div class="meta">{{ $post->domain }}</div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </main>
        <footer>
            <p>Made with love and waffles by <a href="https://jamesg.blog">capjamesg</a>.</p>
        </footer>
    </body>
</html>