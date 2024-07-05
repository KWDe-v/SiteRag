<?php if (defined('__ERROR__')): ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title> Erro Crítico</title>
		<style type="text/css" media="screen">
			body {
			    margin: 20px;
			    padding: 0;
			    font-family: "Arial", "Helvetica Neue", Helvetica, sans-serif;
			    background-color: #f4f4f9;
			    color: #000; /* Mudança da cor para um tom mais suave */
			    line-height: 1.6;
			}

			h2.heading {
			    font-family: "Segoe UI", "Roboto", "Gill Sans", "Lucida Grande", sans-serif;
			    font-weight: 600;
			    border-bottom: 2px solid black; 
			    color: black; 
			    padding-bottom: 10px;
			    margin-bottom: 20px;
			}

			p {
			    font-size: 1rem;
			    margin-bottom: 15px;
			    color: #000; 
			}

			pre {
			    font-family: "Courier New", Courier, "Lucida Console", monospace;
			    background-color: #f8f9fa;
			    padding: 15px; 
			    border: 1px solid #ddd;
			    border-radius: 4px;
			    overflow-x: auto;
			    color: #000; 
			}

			table.backtrace {
			    width: 100%;
			    font-size: 0.875rem;
			    border-spacing: 0;
			    border-collapse: collapse;
			    background-color: #fff;
			    margin-bottom: 20px;
			    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
			    border-radius: 5px; 
			    overflow: hidden; 
			}

			table.backtrace th, table.backtrace td {
			    padding: 12px; 
			    border: 1px solid #ddd;
			}

			table.backtrace th {
			    background-color: #f0f0f0; 
			    font-weight: 700; 
			    text-align: left;
			    color: #000
			}

			table.backtrace td {
			    background-color: #f5f5f5;
			    color: #555; 
			}

			table.backtrace tr:nth-child(even) td {
			    background-color: #fff;
			}

		</style>
	</head>
	
	<body>
    <h2 class="heading">Erro Crítico</h2>
    
    <p>Ocorreu um erro durante a execução da aplicação.</p>
    <p>Isso pode ser devido a uma variedade de problemas, como um bug na aplicação.</p>
    <p><strong>No entanto, normalmente é causado por <em>configuração incorreta</em>.</strong></p>
    
    <h2 class="heading">Detalhes da Exceção</h2>
    <p>Erro: <strong><?php echo get_class($e) ?></strong></p>
    <p>Mensagem: <em><?php echo nl2br(htmlspecialchars($e->getMessage())) ?></em></p>
    <p>Arquivo: <?php echo $e->getFile() ?>:<?php echo $e->getLine() ?></p>
    
    <?php if (count($e->getTrace())): ?>
    <!-- Rastreamento da Exceção -->
    <table class="backtrace">
        <tr>
            <th>Arquivo</th>
            <th>Linha</th>
            <th>Função/Método</th>
        </tr>
        <?php foreach ($e->getTrace() as $trace): ?>
        <tr>
            <td><?php echo $trace['file'] ?></td>
            <td><?php echo $trace['line'] ?></td>
            <td><?php echo isset($trace['class']) ? "$trace[class]::$trace[function]" : $trace['function'] ?>()</td>
        </tr>
        <?php endforeach ?>
    </table>
    
    <h2 class="heading">Rastreamento da Exceção Como String</h2>
    <pre><?php echo htmlspecialchars(preg_replace('/PDO->__construct\\((.+?)\\)/', 'PDO->__construct(*hidden*)', $e->getTraceAsString())) ?></pre>
    <?php endif ?>
</body>
</html>
<?php else: ?>
<h2>Erro</h2>
<p>Ocorreu um erro ao tentar processar sua solicitação.</p>
<p>Por favor, tente contatar um administrador: <a href="mailto:<?php echo $config['EmailAdmin']; ?>"><?php echo $config['EmailAdmin']; ?></a></p>
<?php endif ?>
