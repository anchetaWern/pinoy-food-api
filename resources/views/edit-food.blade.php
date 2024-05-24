<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Food</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .fixed-img {
            width: 525px !important;
            position: fixed;
        }
    </style>
</head>
<body>
    <div class="container mt-5">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('alert'))
        <div class="alert alert-{{ session('alert.type') }}">
            {{ session('alert.text') }}
        </div>
        @endif

        <div class="row">
            <div class="col-5">

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="title-tab" data-bs-toggle="tab" href="#tab-title" role="tab" aria-controls="tab-title" aria-selected="true">Title</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="nutrition-tab" data-bs-toggle="tab" href="#nutrition" role="tab" aria-controls="nutrition" aria-selected="false">Nutrition</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" id="ingredients-tab" data-bs-toggle="tab" href="#tab-ingredients" role="tab" aria-controls="tab-ingredients" aria-selected="false">Ingredients</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="barcode-tab" data-bs-toggle="tab" href="#tab-barcode" role="tab" aria-controls="tab-barcode" aria-selected="false">Barcode</a>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tab-title" role="tabpanel" aria-labelledby="title-tab">
                        <img src="{{ asset($food->title_image) }}" class="fixed-img">
                    </div>

                    <div class="tab-pane fade" id="nutrition" role="tabpanel" aria-labelledby="nutrition-tab">
                        <img src="{{ asset($food->nutrition_label_image) }}" class="fixed-img">   
                    </div>

                    <div class="tab-pane fade" id="tab-ingredients" role="tabpanel" aria-labelledby="ingredients-tab">
                        @if ($food->ingredients_image)
                        <img src="{{ asset($food->ingredients_image) }}" class="fixed-img">
                        @endif
                    </div>

                    <div class="tab-pane fade" id="tab-barcode" role="tabpanel" aria-labelledby="barcode-tab">
                        
                        @if ($food->barcode_image)
                        <img src="{{ asset($food->barcode_image) }}" class="fixed-img">
                        @endif
                    </div>
                </div>

            </div>

            <div class="col-7">
                <div class="mt-3 mb-3">
                    <form action="/foods/{{ $food->description_slug }}" method="POST">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{ $food->id }}">

                        <div class="row">
                            <div class="col-8">
                                <div class="mt-2 mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <input type="text" class="form-control" id="description" name="description" value="{{ old('description', $food->description) }}" placeholder="Anchor milk">
                                </div>
                            </div>

                            <div class="col">
                                <div class="mt-2 mb-3">
                                    <label for="barcode" class="form-label">Barcode</label>
                                    <input type="text" class="form-control" id="barcode" name="barcode" value="{{ old('barcode', $food->barcode ? $food->barcode->barcode : '') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mt-2 mb-3">
                                    <label for="ingredients" class="form-label">Ingredients</label>
                                    <textarea class="form-control" name="ingredients" id="ingredients">{{ old('ingredients', $food->ingredients) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mt-2 mb-3">
                                    <label for="allergen_information" class="form-label">Allergen Information</label>
                                    <textarea class="form-control" name="allergen_information" id="allergen_information">{{ old('allergen_information', $food->allergen_information) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mt-2 mb-3">
                                    <label for="serving_size" class="form-label">Serving size</label>
                                    <input type="text" class="form-control" id="serving_size" name="serving_size" value="{{ old('serving_size', $food->serving_size . $food->serving_size_unit) }}" placeholder="100g">
                                </div>
                            </div>

                            <div class="col">
                                <div class="mt-2 mb-3">
                                    <label for="servings_per_container" class="form-label">Servings per container</label>
                                    <input type="text" class="form-control" id="servings_per_container" name="servings_per_container" value="{{ old('servings_per_container', $food->servings_per_container) }}" placeholder="3">
                                </div>
                            </div>

                            <div class="col">
                                <div class="mt-2 mb-3">
                                    <label for="weight" class="form-label">Weight</label>
                                    <input type="text" class="form-control" id="weight" name="weight" value="{{ old('weight', $food->weight . $food->weight_unit) }}" placeholder="30g">
                                </div>
                            </div>

                            <div class="col">
                                <div class="mt-2 mb-3">
                                    <label for="calories" class="form-label">Calories</label>
                                    <input type="text" class="form-control" id="calories" name="calories" value="{{ old('calories', $food->calories . $food->calories_unit) }}" placeholder="100kcal">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <div class="mt-2 mb-3">
                                    <label for="target_age_group" class="form-label">Target age group</label>
                                    <select class="form-select" name="target_age_group" id="target_age_group">
                                        @foreach($target_age_groups as $group)
                                        <option value="{{ $group }}" {{ $group === old('target_age_group', $food->target_age_group) ? 'selected' : '' }}>{{ $group }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="mt-2 mb-3">
                                    <label for="origin_country" class="form-label">Country</label>
                                    <input type="text" class="form-control" id="origin_country" name="origin_country" value="{{ old('origin_country', $food->origin_country) }}" placeholder="PH">
                                </div>
                            </div>
                        </div>

                      
                        @foreach ($nutrients as $row) 
                        <div class="row">
                            <div class="col-3">
                                <div class="mt-2 mb-3">
                                    @if (!in_array($row->name, $excluded_top_level))
                                    <label for="{{ strtolower($row->name) }}" class="form-label">{{ $row->name }}</label>
                                    @php 
                                    $nutrient_data = nutrientData($food_nutrients, $row->name);
                                    @endphp
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        id="{{ strtolower($row->name) }}" 
                                        name="{{ strtolower($row->name) }}" 
                                        value="{{ $nutrient_data['value'] }}"
                                        placeholder="{{ $row->placeholder_text }}">

                                        <button type="button" class="btn btn-sm btn-secondary add-child" data-nutrientid="{{ $row->name }}">Add Child</button>

                                    @else 
                                    <span>{{ $row->name }}</span>
                                    @endif

                                    <div class="mt-1">
                                    @if ($row->hasChildren())
                                        @include('partials.nutrient-rows', ['row' => $row])
                                    @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach        
                                 
                        
                        <button type="submit" class="btn btn-primary float-end">Update Food</button>
                    </form>

                   
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col">

            


            </div>
        </div>
    </div>


    <div class="modal" tabindex="-1" id="modal-add-child">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add one-off child</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="child_name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="child_name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="save-child" type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>


    @include('handlebars.child-row')


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.8/handlebars.min.js"></script>

    <script>
        let currentButton;
        let currentElement;
        let currentParentName;
        let currentParentLowerName;

        let childRowTemplate = Handlebars.compile($('#child-row-template').html());
        const modal = new bootstrap.Modal('#modal-add-child');

        $('.add-child').click(function() {
            const self = $(this);
            currentButton = self;

            currentElement = self.siblings('input:eq(0)');
            currentParentName = self.siblings('label').text();
            currentParentLowerName = self.data('nutrientid');

            modal.show();
        });


        $('#save-child').click(function() {
            
            const name = $('#child_name').val();
            const parent_name = currentElement.attr('name').replace(currentParentLowerName, currentParentName);

            const html = childRowTemplate({
                parent_name,
                name
            });

            currentButton.after(html);
            modal.hide();

            $('#child_name').val('');
        });
    </script>
</body>
</html>