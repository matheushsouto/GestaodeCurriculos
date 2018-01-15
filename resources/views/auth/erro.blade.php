<link href="{{asset('/dist/css/reset.css')}}" rel="stylesheet">
<link href="{{asset('/dist/css/style.css')}}" rel="stylesheet">
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="style.css">
    <title>Acesso Negado</title>
</head>
<body>
<div id="access_denied">
    <h1>ACESSO NEGADO!</h1>
</div>

<div id="text">
    <img id="img" src="{{asset('img/logo_superpao.png')}}" align="right" width="40%">
    <p><strong>Devido as políticas de segurança da empresa este site está bloqueado.</strong></p>
    <p>Caso precise de liberação favor entrar em contato:</p>
    <div id="text_contato"></div>
    <p>Equipe de Infraestrutura: </p>
    <p><strong>E-mail:</strong> info.infra@superpao.com.br / Ramal: 605</p>
</div>

</body>
</html>