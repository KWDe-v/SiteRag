<?php
return [
    // Configuração de exemplo do servidor. Você pode ter mais arrays como este
    // para especificar múltiplos grupos de servidores (no entanto, eles devem
    // compartilhar o mesmo servidor de login, embora possam ter múltiplos pares
    // de char/map).
    [
        'ServerName'     => 'brFluxRO',
        // Configuração global do banco de dados (exclui a configuração do banco de dados de logs).
        'DbConfig'       => [
            //'Socket'     => '/tmp/mysql.sock',
            //'Port'       => 3306,
            //'Encoding'   => 'utf8', // Codificação da conexão -- use aqui a mesma que a collation das suas tabelas MySQL.
            'Convert'    => 'utf8',
            // -- A opção 'Convert' só funciona quando a opção 'Encoding' está especificada e iconv (http://php.net/iconv) está disponível.
            // -- Ela especifica a codificação para converter seus dados MySQL no site (provavelmente precisa ser utf8).
            'Hostname'   => '127.0.0.1',
            'Username'   => 'ragnarok',
            'Password'   => 'ragnarok',
            'Database'   => 'ragnarok',
            'Persistent' => true,
            'Timezone'   => null // Exemplo: '+0:00' é UTC.
            // Os valores possíveis para 'Timezone' são conforme documentado no site do MySQL:
            // "O valor pode ser dado como uma string indicando um deslocamento de UTC, como '+10:00' ou '-6:00'."
            // "O valor pode ser dado como um fuso horário nomeado, como 'Europe/Helsinki', 'US/Eastern', ou 'MET'." (veja abaixo a continuação!)
            // **"Fusos horários nomeados só podem ser usados se as tabelas de informações de fuso horário no banco de dados mysql tiverem sido criadas e populadas."
        ],
        // Isso é mantido separado porque muitas pessoas optam por ter o banco de dados de logs
        // acessível sob credenciais diferentes e, muitas vezes, em um servidor
        // diferente para garantir a confiabilidade dos dados de log.
        'LogsDbConfig'   => [
            //'Socket'     => '/tmp/mysql.sock',
            //'Port'       => 3306,
            //'Encoding'   => null, // Codificação da conexão -- use aqui a mesma que a collation das suas tabelas MySQL.
            'Convert'    => 'utf8',
            // -- A opção 'Convert' só funciona quando a opção 'Encoding' está especificada e iconv (http://php.net/iconv) está disponível.
            // -- Ela especifica a codificação para converter seus dados MySQL no site (provavelmente precisa ser utf8).
            'Hostname'   => '127.0.0.1',
            'Username'   => 'ragnarok',
            'Password'   => 'ragnarok',
            'Database'   => 'ragnarok',
            'Persistent' => true,
            'Timezone'   => null // Valores possíveis são conforme descritos no comentário em DbConfig.
        ],
        // Configuração do servidor web.
        'WebDbConfig'    => [
            'Hostname'   => '127.0.0.1',
            'Username'   => 'ragnarok',
            'Password'   => 'ragnarok',
            'Database'   => 'ragnarok',
            'Persistent' => true
        ],
        // Configuração do servidor de login.
        'LoginServer'    => [
            'Address'  => '127.0.0.1',
            'Port'     => 6900,
            'UseMD5'   => false,
            'NoCase'   => true, // Sensibilidade a maiúsculas e minúsculas em contas rA; Padrão: Insensível a maiúsculas/minúsculas (true).
            'GroupID'  => 0,    // ID do grupo de conta padrão durante o registro.
            //'Database' => 'ragnarok'
        ],
        'CharMapServers' => [
            [
                'ServerName'      => 'brFluxRO',
                'Renewal'         => false,
                'MaxCharSlots'    => 9,
                'DateTimezone'    => null, // Especifica o fuso horário do servidor de jogo para este par char/map. (Veja: http://php.net/timezones)
                //'ResetDenyMaps'   => 'sec_pri', // Padrão é 'sec_pri'. Este valor pode ser um array de nomes de mapas.
                //'Database'        => 'ragnarok', // Padrão é DbConfig.Database
                'ExpRates' => [
                    'Base'        => 100, // Taxa na qual (base) exp é dada
                    'Job'         => 100, // Taxa na qual a exp de trabalho é dada
                    'Mvp'         => 100  // Taxa de bônus de exp de MVP
                ],
                'DropRates' => [
                    // Se a taxa de drop estiver abaixo deste valor e o bônus for aplicado, o bônus não pode exceder este valor.
                    'DropRateCap' => 9000,
                    // A taxa na qual itens comuns (na aba ETC, exceto carta) são dropados
                    'Common'      => 100,
                    'CommonBoss'  => 100,
                    'CommonMVP'   => 100,
                    'CommonMin'   => 1,
                    'CommonMax'   => 10000,
                    // A taxa na qual itens de cura (que restauram HP ou SP) são dropados
                    'Heal'        => 100,
                    'HealBoss'    => 100,
                    'HealMVP'     => 100,
                    'HealMin'     => 1,
                    'HealMax'     => 10000,
                    // A taxa na qual itens utilizáveis (na aba de itens, exceto itens de cura) são dropados
                    'Useable'     => 100,
                    'UseableBoss' => 100,
                    'UseableMVP'  => 100,
                    'UseableMin'  => 1,
                    'UseableMax'  => 10000,
                    // A taxa na qual equipamentos são dropados
                    'Equip'       => 100,
                    'EquipBoss'   => 100,
                    'EquipMVP'    => 100,
                    'EquipMin'    => 1,
                    'EquipMax'    => 10000,
                    // A taxa na qual cartas são dropadas
                    'Card'        => 100,
                    'CardBoss'    => 100,
                    'CardMVP'     => 100,
                    'CardMin'     => 1,
                    'CardMax'     => 10000,
                    // A taxa de ajuste para os itens MVP que o MVP recebe diretamente no seu inventário
                    'MvpItem'     => 100,
                    'MvpItemMin'  => 1,
                    'MvpItemMax'  => 10000,
                    // 0 - ordem oficial (Mostrar mensagem "Nota: Apenas um drop de MVP será recompensado."), 2 - todos os itens
                    'MvpItemMode' => 0,
                ],
                'CharServer'      => [
                    'Address'     => '127.0.0.1',
                    'Port'        => 6121
                ],
                'MapServer'       => [
                    'Address'     => '127.0.0.1',
                    'Port'        => 5121
                ],
                // -- Dias e horários do WoE --
                // Primeiro parâmetro: Dia de início 0=Domingo / 1=Segunda / 2=Terça / 3=Quarta / 4=Quinta / 5=Sexta / 6=Sábado
                // Segundo parâmetro: Hora de início no formato 24 horas.
                // Terceiro parâmetro: Dia de término (valor possível é o mesmo do dia de início).
                // Quarto (final) parâmetro: Hora de término no formato 24 horas.
                // ** (Nota, horários inválidos são ignorados silenciosamente.)
                'WoeDayTimes'   => [
                    // array(0, '12:00', 0, '14:00'), // Exemplo: Começa domingo 12:00 e termina domingo 14:00
                    // array(3, '14:00', 3, '15:00')  // Exemplo: Começa quarta-feira 14:00 PM e termina quarta-feira 15:00 PM
                ],
                // Módulos e/ou ações para desabilitar o acesso durante o WoE.
                'WoeDisallow'   => [
                    ['module' => 'character', 'action' => 'online'],  // Desabilitar acesso à página "Quem está Online" durante o WoE.
                    ['module' => 'character', 'action' => 'mapstats'] // Desabilitar acesso à página "Estatísticas do Mapa" durante o WoE.
                ]
            ]
        ]
    ]
];
?>
