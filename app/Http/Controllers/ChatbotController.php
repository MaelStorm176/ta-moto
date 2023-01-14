<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    private $workflow = [
        /**** START ***/
        'start' => [
            'message' => 'Bonjour, je suis le chatbot de TaMoto. Que voulez-vous savoir ?',
            'type' => 'select',
            'options' => [
                [
                    'label' => 'Je souhaite vérifier l’entretien de ma moto',
                    'next' => 'check_maintenance',
                ],
                [
                    'label' => 'Je veux avoir des informations sur les motos',
                    'next' => 'moto_info',
                ],
                [
                    'label' => 'Je souhaite vous contacter',
                    'next' => 'contact',
                ],
                [
                    'label' => 'Je souhaite quitter',
                    'next' => 'end',
                ],
            ],
        ],

        /**** CHECK MAINTENANCE ***/
        'check_maintenance' => [
            'message' => 'Quelle est l\'année de votre moto ?',
            'type' => 'input',
            'next' => 'check_maintenance_year',
        ],

        'check_maintenance_year' => [
            'message' => 'Quel est la date de votre dernière révision ?',
            'type' => 'select',
            'options' => [
                [
                    'label' => 'Moins d\'un an',
                    'next' => 'check_kilometers',
                ],
                [
                    'label' => 'Plus d\'un an',
                    'next' => 'check_disponibility',
                ],
            ],
        ],

        'check_disponibility' => [
            'message' => 'Votre moto est éligible à une révision.',
            'type' => 'select',
            'options' => [],
        ],

        'check_kilometers' => [
            'message' => 'Quel est le nombre de kilomètres parcourus depuis la dernière révision ?',
            'type' => 'input',
            'next' => 'check_kilometers',
            'condition' => [
                [
                    'type' => 'less_than',
                    'value' => 10000,
                    'next' => 'check_disponibility',
                ],
                [
                    'type' => 'more_or_equal',
                    'value' => 10000,
                    'next' => 'confirm_maintenance',
                ],
            ]
        ],

        'confirm_maintenance' => [
            'message' => 'Votre moto doit être révisée. Souhaitez-vous prendre rendez-vous ?',
            'type' => 'select',
            'options' => [
                [
                    'label' => 'Oui',
                    'next' => 'check_disponibility',
                ],
                [
                    'label' => 'Non',
                    'next' => 'end',
                ],
            ],
        ],

        /**** MOTO INFO ***/
        'moto_info' => [
            'message' => 'Quel est votre type d\'usage ?',
            'type' => 'select',
            'options' => [
                [
                    'label' => 'Je souhaite faire de la route',
                    'next' => 'moto_info_route',
                ],
                [
                    'label' => 'Je souhaite faire du tout-terrain',
                    'next' => 'moto_info_tt',
                ],
                [
                    'label' => 'Je souhaite faire du sport',
                    'next' => 'moto_info_sport',
                ],
            ],
        ],


        /**** CONTACT ****/
        'contact' => [
            'message' => 'Souhaitez-vous nous contacter par téléphone ou par mail ?',
            'type' => 'select',
            'options' => [
                [
                    'label' => 'Par téléphone',
                    'next' => 'phone',
                ],
                [
                    'label' => 'Par mail',
                    'next' => 'email',
                ],
            ],
        ],

        'phone' => [
            'message' => 'Notre numéro de téléphone est le 01 23 45 67 89',
            'type' => 'select',
            'options' => [
                [
                    'label' => 'Merci, au revoir',
                    'next' => 'end',
                ],
            ],
        ],

        /**** END ****/
        'end' => [
            'message' => 'Bye',
            'type' => null,
            'next' => null
        ]
    ];

    public function messages(Request $request): JsonResponse
    {
        $input = $request->input('input');
        $step = $request->get('step');

        $response = $this->workflow[$step];

        if ($response['type'] === 'input' && !empty($input) && isset($response['condition'])) {
            $index = $this->checkCondition($response['condition'], $input);
            //dd($response['condition'], $input, $index);
            $response = $this->workflow[$index];
        }

        return new JsonResponse($response);
    }

    private function checkCondition(array $conditions, $input)
    {
        foreach ($conditions as $condition) {
            switch ($condition['type']) {
                case 'less_than':
                    if ($input < $condition['value']) {
                        return $condition['next'];
                    }
                    break;
                case 'more_than':
                    if ($input > $condition['value']) {
                        return $condition['next'];
                    }
                    break;
                case 'equal':
                    if ($input === $condition['value']) {
                        return $condition['next'];
                    }
                    break;
                case 'not_equal':
                    if ($input !== $condition['value']) {
                        return $condition['next'];
                    }
                    break;
                case 'more_or_equal':
                    if ($input >= $condition['value']) {
                        return $condition['next'];
                    }
                    break;
                case 'less_or_equal':
                    if ($input <= $condition['value']) {
                        return $condition['next'];
                    }
                    break;
                default:
                    return $condition['next'];
            }
        }
        return null;
    }
}
