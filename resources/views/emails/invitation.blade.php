<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invitation à rejoindre notre application</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }
        .footer {
            margin-top: 30px;
            font-size: 0.9em;
            color: #666;
        }
    </style>
</head>
<body>
    <h2>Invitation à rejoindre notre application</h2>

    <p>Bonjour,</p>

    <p>Vous avez été invité(e) à rejoindre notre application. Pour finaliser votre inscription, veuillez cliquer sur le lien ci-dessous :</p>

    <a href="{{ url('/register?token=' . $token) }}" class="button">
        Créer mon compte
    </a>

    <p><strong>Attention :</strong> Ce lien d'invitation expire le {{ $expiration }}.</p>

    <div class="footer">
        <p>Si vous n'avez pas demandé cette invitation, vous pouvez ignorer cet email.</p>
        <p>Si le bouton ne fonctionne pas, copiez et collez ce lien dans votre navigateur :<br>
        {{ url('/register?token=' . $token) }}</p>
    </div>
</body>
</html>