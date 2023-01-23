<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Simple URL Shortener</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.tailwindcss.com"></script>      
    </head>
    <body class="p-6 flex justify-items-start flex-col">
        <h1 class="shrink-0">Simple URL Shortener Service (SUS Service)</h1>
        
        @if (session('success'))
        <div class="bg-green-300 p-4 rounded-sm" role="alert">
            {{ session('success') }}
            <button type="button" class="rounded-sm bg-red-300 text-white">Close</button>
        </div>
        @endif

        <form class="max-w-sm p-6 border-2 border-black" method="POST" action="{{ route('url.shorten') }}">
            @csrf
            <label for="url">Enter a URL:</label>
            <input name="url" type="text" placeholder="Paste a URL here..." />
            <br>
            <button>Submit</button>
        </form>
    </body>
</html>