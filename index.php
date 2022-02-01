<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Exercice 02</title>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="./style.css">

</head>

<body>

<?php
    // 100 + 200 + 300
    $expression1 = [
        "type" => "add",
        'children'=> [
            [
                "type" => "number",
                "value"=>100
            ],
            [
                "type" => "number",
                "value"=> 200
            ],
            [
                "type" => "number",
                "value"=> 300
            ]
        ]
    ];

    // 100 + 2 * (45 +5)
    $expression2 = [
            "type" => "add",
            'children'=> [
                    [
                            "type" => "number",
                            "value"=>100
                    ],
                    [
                            "type" => "multiply",
                            "children" =>[
                                    [
                                            "type" => "number",
                                            "value"=>2
                                    ],
                                    [
                                            "type" => "add",
                                            "children" =>[
                                                [
                                                    "type" => "number",
                                                    "value"=>5
                                                ],
                                                [
                                                    "type" => "number",
                                                    "value"=>45
                                                ]
                                            ]
                                    ]
                            ]
                    ]
            ]
    ];

    // 1 + 100 / 1000
    $expression3 = [
        "type" => "add",
        'children'=> [
            [
                "type" => "number",
                "value"=>1
            ],
            [
                "type" => "fraction",
                "top"=>
                    [
                        "type" => "number",
                        "value"=>100
                    ],
                "bottom"=>
                    [
                        "type" => "number",
                        "value"=>1000
                    ]
            ]
        ]
    ];
?>

        <h1>Exercice 02</h1>
        
<?php

        $expressionListe = [$expression1,$expression2,$expression3];

        include('./evaluation.php');

        $eval = function($a){
            static $j = 1;
            $evaluation_result = new evaluate_expression();

            echo "<h3>Expression 0" . $j . "</h3>"
            . "<div class='expression'>"
            . "<div class='calcul'>" . $evaluation_result->render($a) . " = </div>"
            . "<div class='result'>" . $evaluation_result->evaluate($a) . "</div>"
            . "</div>";
            $j++;
        };

        $evaluation = array_map($eval, $expressionListe);

        // for($i=0; $i<3; $i++) {
        //     $j = $i+1;
        //     echo "<h3>Expression 0" . $j . "</h3>"
        //     . "<div class='expression'>"
        //         . "<div class='calcul'>" . render($expressionListe[$i]) . " = </div>"
        //         . "<div class='result'>" . evaluate($expressionListe[$i]) . "</div>"
        //         . "</div>";
        // }
?>

</body>