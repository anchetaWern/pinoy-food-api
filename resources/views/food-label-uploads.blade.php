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

        <table class="table table-striped dataTable" id="food-uploads-table">
            <thead>
                <tr>
                    <th>Food Image</th>
                    <th>Nutrition Label Image</th>
                    <th>Ingredients Image</th>
                    <th>Barcode Image</th>
                    <th>Created at</th>
                    <th>Updated at</th>
                </tr>
            </thead>

            <tbody>

            </tbody>
        </table>

        <div class="modal" tabindex="-1" id="modal-view-image">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Preview Image <span id="image-type"></span></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <img id="preview-image" />
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>

    <script>
    $("#food-uploads-table").DataTable({
        processing: true,
        serverSide: true,
        paging: true,
        lengthChange: true,
        ajax: {
            url: "/food-uploads-data",
            data: function (d) {
               
            },
        },
        columns: [
            { data: 'title_image', name: 'title_image' },
            { data: 'nutrition_label_image', name: 'nutrition_label_image' },
            { data: 'ingredients_image', name: 'ingredients_image' },
            { data: 'barcode_image', name: 'barcode_image' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' },
        ],
        // order: [[3, "desc"]],
    });

    const modal = new bootstrap.Modal('#modal-view-image');
    $("#food-uploads-table").on("click", ".view-image", function() {
        const self = $(this);

        $('#preview-image').prop('src', self.data('url'));
        $('#image-type').text(self.data('title'));

        modal.show();
    });
    </script>
</body>
</html>