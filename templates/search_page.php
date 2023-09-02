<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Поиск</title>

    <style>
        /* Reset and base styles  */
        * {
            padding: 0;
            margin: 0;
            border: none;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        :focus,
        :active {
            /*outline: none;*/
        }

        a:focus,
        a:active {
            /* outline: none;*/
        }

        /* Links */

        a, a:link, a:visited  {
            /* color: inherit; */
            text-decoration: none;
            /* display: inline-block; */
        }

        a:hover  {
            /* color: inherit; */
            text-decoration: none;
        }

        /* Common */

        aside, nav, footer, header, section, main {
            display: block;
        }

        h1, h2, h3, h4, h5, h6, p {
            font-size: inherit;
            font-weight: inherit;
        }

        ul, ul li {
            list-style: none;
        }

        img {
            vertical-align: top;
        }

        img, svg {
            max-width: 100%;
            height: auto;
        }

        address {
            font-style: normal;
        }

        /* Form */

        input, textarea, button, select {
            font-family: inherit;
            font-size: inherit;
            color: inherit;
            background-color: transparent;
        }

        input::-ms-clear {
            display: none;
        }

        button, input[type="submit"] {
            /*display: inline-block;*/
            box-shadow: none;
            /*background-color: transparent;*/
            /*background: none;*/
            cursor: pointer;
        }

        input:focus, input:active,
        button:focus, button:active {
            outline: none;
        }

        button::-moz-focus-inner {
            padding: 0;
            border: 0;
        }

        label {
            cursor: pointer;
        }

        legend {
            display: block;
        }

        body{
            width: 100vw;
            min-height: 100vh;
        }

        form{
            position: relative;

            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;

            width: 350px;
            min-height: 150px;

            margin: 25px auto;
            padding: 20px 30px;

            background: #bbb8b8;
            border-radius: 18px;
        }

        textarea{
            font-size: 16px;

            background: #ffffff;
            border-radius: 14px;
            padding: 10px 15px;

            resize: vertical;
            min-height: 70px;
            height: 70px;
            max-height: 400px;
            width: 100%;

            margin-bottom: 25px;
        }

        input[type='submit']{
            color: #fff;
            font-size: 18px;
            letter-spacing: 2px;
            font-weight: 500;

            background: #174ebe;
            border-radius: 14px;

            width: 175px;
            height: 50px;
        }
    </style>
</head>
<body>

<form action="/search" method="get">
    <textarea id="input-body" name="body" placeholder="Введите запрос"></textarea>
    <input id="input-submit" type="submit" value="НАЙТИ">
</form>

<pre>
    <?= $data ?>
</pre>

<script>

    const searchForm = document.querySelector("form");
    const textField = document.querySelector("form textarea");

    searchForm.addEventListener('submit', function (event) {
        if(textField.value.length <= 3)
            event.preventDefault();
    })

</script>
</body>
</html>