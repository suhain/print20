<?php

function execute_calc($input_file) {
    $calc = "runner.jar";
    $java_command = "java -jar -Dfile.encoding=UTF8";
    shell_exec($java_command . ' ' . $calc . ' ' . $input_file);
}
// java -jar -Dfile.encoding=UTF8 runner.jar product
?>
