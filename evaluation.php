<?php

    interface expression_tree_node
    {
        public function evaluate($expression);

        public function render($expression);
    }

    //swtich aurait pu être utilisé à la place des multiples "If"
    //https://phpsandbox.io/n/mute-mud-b7rp-mhdmw > render() avec le switch

    class evaluate_expression implements expression_tree_node
    {
        function evaluate($expression){
            // TODO : add rendering code here

            if ($expression["type"] == "add"){ //pour gérer l'opération
                $result = 0;

                foreach ($expression["children"] as $key => $value){ //pour gérer le niveau suivant
                    $add = $this->evaluate($value);
                    $result = $result + $add; // pour effectuer l'opération
                };
            }

            elseif ($expression["type"] == "multiply"){
                $result = 1;

                foreach ($expression["children"] as $key => $value){
                    $multiply = $this->evaluate($value);
                    $result = $result * $multiply;
                };
            }

            elseif ($expression["type"] == "fraction"){

                $top = $this->evaluate($expression["top"]);
                $bottom = $this->evaluate($expression["bottom"]);

                if($bottom == 0){ //pour éviter une erreur de script
                    echo "Opération impossible, division par zéro";
                    exit;
                }

                $result = $top / $bottom;
            }

            elseif($expression["type"] == "number"){ //s'il s'agit d'un nombre
                $nbr = $expression["value"];
                return $nbr;
            }

            else{ //dans le cas d'une erreur d'écriture
                echo "Erreur, une valeur n\'est pas une opération ou un nombre.";
                exit;
            }

            return $result;
        }

        function render($expression){
            $result = "";
            $count = 0;

            if ($expression["type"] == "add"){

                foreach ($expression["children"] as $key => $value){
                    $add = $this->render($value);

                    if($count == 0){
                        $result = $add;
                        $count++;
                    }
                    else{
                        $result = $result . " + " . $add;
                    }
                    
                };
            }

            elseif ($expression["type"] == "multiply"){

                $result = $result . "(";

                foreach ($expression["children"] as $key => $value){
                    $multiply = $this->render($value);

                    if($count == 0){
                        $result = $multiply;
                        $count++;
                    }
                    else{
                        if($value["type"] != "number"){
                            $result = $result . " * (" . $multiply . ")";
                        }
                        else{
                            $result = $result . " * " . $multiply;
                        }
                    }
                    
                };
            }

            elseif ($expression["type"] == "fraction"){

                $top = $this->render($expression["top"]);
                $bottom = $this->render($expression["bottom"]);

                $result = $result . "<div class='division'><div class='division_top'>" . $top . "</div><div>" . $bottom . "</div></div>";
            }

            elseif($expression["type"] == "number"){
                $nbr = $expression["value"];
                return $nbr;
            }

            else{
                echo "Erreur, une valeur n\'est pas une opération ou un nombre.";
                exit;
            }

            return $result;
        }
    }

?>