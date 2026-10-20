<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Searching with auto suggestions</title>
</head>
<body class="bg-blue-100">
<div class="flex flex-row mt-25 justify-center">
    <div class="border w-md rounded-md relative">
        <input type="text" class="w-full p-3 pr-24" id="search" placeholder="Start typing to search...">
        <button class="p-3 index-100 absolute right-0 border-l top-0 h-full bg-blue-100 rounded-r-md hover:bg-blue-300">
            Search
        </button>
    </div>
    <div id="result">

    </div>
</div>
</body>
</html>

<script>
  const resultBlock = document.getElementById('result')

  async function suggest (keywords) {
    const response = await fetch(
      '/suggest?keywords=' + encodeURIComponent(keywords)
    );

    const result = await response.text();

    return JSON.parse(result);
  }

  document.getElementById('search').addEventListener('input', async function (element) {
    resultBlock.innerHTML = ''
    const result = await suggest(element.target.value)

    result.forEach(function (item) {
      const div = document.createElement('div')
      div.textContent = item
      resultBlock.appendChild(div)
    })
  })
</script>

