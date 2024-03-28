<?php

return [

    /*
    |--------------------------------------------------------------------------
    | All messages Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used for various messages
    | that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'errors' => [
        'unauthorized' => 'Não autorizado!',
        'forbidden' => 'Acesso negado!',
        'unavailable' => 'Ops! Algo deu errado. Nossa equipe foi notificada e está trabalhando para corrigir.',
        'notfound' => 'Registro não encontrado!',
    ],

    'success' => [
        'created' => 'Registro cadastrado com sucesso!',
        'updated' => 'Registro atualizado com sucesso!',
        'removed' => 'Registro removido com sucesso!',
    ],

    'validation' => [
        'invalid' => ':attribute inválido!',
        'unavailable' => ':field indisponível',
        'time' => [
            'before' => 'O horário inicial deve ser menor que o horário final.',
            'past' =>  'O horário inicial não pode ser no passado.',
        ],
        'notallowed' => 'O status atual não permite realizar alterações!',
    ],

];
