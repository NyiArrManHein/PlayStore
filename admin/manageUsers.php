<?php
if (!isset($_GET['manageUser'])) {
    header("location:../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../styles.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        #wrapper {
            width: min(1100px, 100% - 3rem);
            margin-inline: auto;
        }

        table {
            width: 100%;
            /* border: 1px solid;
            border-collapse: collapse; */
        }

        th {
            text-align: start;
        }

        th,
        td {
            padding: 1rem;
        }

        @media (max-width: 650px) {
            th {
                display: none;
            }

            td {
                display: block;
                padding: 0.5rem 1rem;
            }

            td::before {
                content: attr(data-cell) ": ";
                font-weight: 700;
                word-spacing: 20px;
            }

            td:first-child {
                padding-top: 2rem;
            }

            td:last-child {
                padding-bottom: 2rem;
            }
        }
    </style>
</head>

<body>
    <div id="wrapper">
        <h1>Customers</h1>
        <table class="mt-3" id="usersTable"></table>
    </div>

    <script>
        $(document).ready(function() {
            fetch();

            $(document).on('click', '.userDelete', function() {
                var value = $(this).closest('tr').find('.userId').val();
                $.ajax({
                    url: 'Users.php',
                    method: 'POST',
                    data: {
                        'deleteUser': 1,
                        'value': value
                    },
                    success: function() {
                        fetch();
                    }
                })
            })

            function fetch() {
                $.ajax({
                    url: 'Users.php',
                    method: 'POST',
                    data: {
                        "select": 1
                    },
                    success: function(result) {
                        $('#usersTable').html(result);
                    }
                })
            }
        })
    </script>
</body>

</html>