<?php
 $options = [
            'sender_id' =>1,
            'user_id' =>2,
            'data' => [],
            'title' => "xin chao",
            'message' => '',
            'reference_id' => 0,
            'type' => 1,
            'source' => 0,
            'source_to' => 0,
            'screen' => '',
        ];
        foreach ($options as $key => $value) {

            $this->{$key} = $value;


        }
        dd($options);
?>
