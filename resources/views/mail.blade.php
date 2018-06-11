<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
            font-size: 100%;
            font-family: 'Avenir Next', "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
            line-height: 1.65;
        }

        img {
            max-width: 100%;
            margin: 0 auto;
            display: block;
        }

        body,
        .body-wrap {
            width: 100% !important;
            height: 100%;
            background: #efefef;
            -webkit-font-smoothing: antialiased;
            -webkit-text-size-adjust: none;
        }

        a {
            color: #71bc37;
            text-decoration: none;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;
        }

        .button {
            display: inline-block;
            color: white;
            background: #71bc37;
            border: solid #71bc37;
            border-width: 10px 20px 8px;
            font-weight: bold;
            border-radius: 4px;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin-bottom: 20px;
            line-height: 1.25;
        }

        h1 {
            font-size: 32px;
            text-shadow: -1px -1px #fff, -2px -2px #fff, -1px 1px #fff, -2px 2px #fff, 1px 1px #fff, 2px 2px #fff, 1px -1px #fff, 2px -2px #fff, -3px -3px 2px #bbb, -3px 3px 2px #bbb, 3px 3px 2px #bbb, 3px -3px 2px #bbb;
            color: #4682b4;
            transition: all 1s;
        }

        h1:hover {
            color: #9acd32;
        }

        h2 {
            font-size: 28px;
        }

        h3 {
            font-size: 24px;
        }

        h4 {
            font-size: 20px;
        }

        h5 {
            font-size: 16px;
        }

        p,
        ul,
        ol {
            font-size: 16px;
            font-weight: normal;
            margin-bottom: 20px;
        }

        .container {
            display: block !important;
            clear: both !important;
            margin: 0 auto !important;
            max-width: 580px !important;
        }

        .container table {
            width: 100% !important;
            border-collapse: collapse;
        }

        .container .masthead {
            padding: 80px 0;
            background: url(http://sections.loc/images/header.jpg) no-repeat;
            background-size: cover;
            color: white;
        }

        .container .masthead h1 {
            margin: 0 auto !important;
            max-width: 90%;
            text-transform: uppercase;
        }

        .container .content {
            background: white;
            padding: 30px 35px;
        }

        .container .content.footer {
            background: none;
        }

        .container .content.footer p {
            margin-bottom: 0;
            color: #888;
            text-align: center;
            font-size: 14px;
        }

        .container .content.footer a {
            color: #888;
            text-decoration: none;
            font-weight: bold;
        }

    </style>
</head>

<body>
<table class="body-wrap">
    <tr>
        <td class="container">

            <!-- Message start -->
            <table>
                <tr>
                    <td align="center" class="masthead">

                        <h1>Секции, студии, кружки</h1>

                    </td>
                </tr>
                <tr>
                    <td class="content">

                        <h2>{{$subject}}</h2>

                        <p>{{$msg}}</p>

                        <p><em>– {{$name}}</em></p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td class="container">

            <!-- Message start -->
            <table>
                <tr>
                    <td class="content footer" align="center">
                        <p>Контактные данные:</p>
                        <p><span>{{$email}}</span> | <span>{{$phone}}</span></p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
