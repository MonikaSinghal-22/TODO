<!DOCTYPE html>
<html lang="en">
<meta name="csrf-token" content="{{ csrf_token() }}">
@include('partials.head')
<body>

@include('partials.menu')

<div class="main">
@include('partials.header')
@include('partials.content')
</div>

@include('partials.footer')

</body>

</html>
