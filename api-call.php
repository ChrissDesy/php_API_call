<?php

    //declare variables
    $url = 'http://dummy.restapiexample.com/api/v1/employees';

    try {
        $ch = curl_init();

        // Check if initialization had gone wrong*    
        if ($ch === false) {
            throw new Exception('failed to initialize');
        }

        // Better to explicitly set URL
        curl_setopt($ch, CURLOPT_URL, $url);
        // That needs to be set; content will spill to STDOUT otherwise
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $content = curl_exec($ch);

        $info = json_decode($content);

        // Check the return value of curl_exec(), too
        if ($content === false) {
            throw new Exception(curl_error($ch), curl_errno($ch));
        }

        // Check HTTP return code, too; might be something else than 200
        $httpReturnCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // if($httpReturnCode == 200){
        //     $info = json_decode($content);


        //     foreach($info->data as $row) {
        //         echo $row->id;
        //     }
        // }
        // else{
        //     throw new Exception('Error response code: '. $httpReturnCode);
        // }

    } catch(Exception $e) {

        trigger_error(sprintf(
            'Curl failed with error #%d: %s',
            $e->getCode(), $e->getMessage()),
            E_USER_ERROR);

    } finally {
        // Close curl handle unless it failed to initialize
        if (is_resource($ch)) {
            curl_close($ch);
        }
    }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP API Call</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <main class="m-5 p-3">
        <h1 class="text-center">PHP API Call Test</h1>
        <div class="mt-4 container">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Salary</th>
                                    <th>Age</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php 

                                    foreach($info->data as $row) {
                                        ?>
                                            <tr>
                                                <td class="font-weight-bold"><?php echo $row->id ?></td>
                                                <td><?php echo $row->employee_name ?></td>
                                                <td><?php echo $row->employee_salary ?></td>
                                                <td><?php echo $row->employee_age ?></td>
                                            </tr>
                                        <?php
                                    }

                                ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>