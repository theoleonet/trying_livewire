<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title></title>
  <script src="https://cdn.tailwindcss.com"></script>
  @livewireStyles
</head>

<body class="grid gap-7 p-10">
  @livewire('select-pagination')
  @livewire('search-term-field')
  @livewire('table', ['contacts' => $contacts])
</body>
@livewireScripts

</html>
