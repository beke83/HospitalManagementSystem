<?php

echo uniqid('TXN');
echo '<br />';

$permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
echo substr(str_shuffle($permitted_chars), 0, 8);

?>

<?php
echo '<br />';
$permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

function generate_string($input, $strength = 16)
{
    $input_length = strlen($input);
    $random_string = '';
    for ($i = 0; $i < $strength; $i++) {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }

    return $random_string;
}

// Output: iNCHNGzByPjhApvn7XBD
echo generate_string($permitted_chars, 11);
