<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>POOLSTAR</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href='https://fonts.googleapis.com/css?family=Kanit' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body style="background-color: blue; font-family: 'Kanit';">
    <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#price').on('input', function() {
                let price = parseFloat($(this).val());

                if (!isNaN(price)) {
                    let commission = price * 0.35; // Calculate commission as 35% of the price
                    $('#commission').val(commission.toFixed(2)); // Display the commission with 2 decimal places
                } else {
                    $('#commission').val(''); // Clear the commission field if the price is not a valid number
                }
            });
        });
    </script>
    <script>
        function copyLink(button) {
            /* Get the input field associated with the clicked button */
            var copyText = button.previousElementSibling;

            /* Create a temporary textarea element */
            var textarea = document.createElement("textarea");
            textarea.value = copyText.value;
            document.body.appendChild(textarea);

            /* Select the text field */
            textarea.select();
            textarea.setSelectionRange(0, textarea.value.length);

            try {
                /* Copy the text inside the textarea using the Clipboard API */
                document.execCommand("copy");
                console.log('Link copied to clipboard!');
            } catch (err) {
                console.error('Unable to copy link to clipboard', err);
            } finally {
                /* Remove the temporary textarea element */
                document.body.removeChild(textarea);
            }

            /* Alert the copied text */
            alert("Copied the link: " + copyText.value);
        }
    </script>
</body>

</html>
