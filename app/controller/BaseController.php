<?php


namespace App\Controller;


class BaseController
{
    public function validate($request,$rules)
    {
        $exist = [];
        foreach($request as $key => $value){
            foreach($rules as $rule){
                if($rule === $key){
                    array_push($exist, $rule);
                }
            }
        }

        $notSet = array_diff($rules, $exist);
        if (count($notSet) == 0) {
            return;
        } else {
            $validationMessage = new \stdClass();
            foreach($notSet as $ns){
                $validationMessage->$ns = "Kjo fushë duhet të plotësohet patjeter";
            }
            redirectBack($validationMessage);
        }
    }
}
