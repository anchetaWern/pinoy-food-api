<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Uploads</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <style>
    .small-img {
        width: 40px;
    }
    </style>
</head>

<body>
    <div class="container mt-5">

        <table class="table table-striped dataTable" id="foods-table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Calories</th>
                    <th>Serving Size</th>
                    <th>Created at</th>
                    <th>Updated at</th>
                    <th>Edit</th>
                </tr>
            </thead>

            <tbody>

            </tbody>
        </table>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>

    <script>
    $("#foods-table").DataTable({
        processing: true,
        serverSide: true,
        paging: true,
        lengthChange: true,
        ajax: {
            url: "/foods-data",
            data: function (d) {
               
            },
        },
        columns: [
            { data: 'title_image', name: 'title_image' },
            { data: 'description', name: 'description' },
            { data: 'calories', name: 'calories' },
            { data: 'serving_size', name: 'serving_size' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' },
            { data: 'description_slug', name: 'description_slug' }
        ],
        order: [[4, "desc"]],
    });
    </script>
</body>
</html>