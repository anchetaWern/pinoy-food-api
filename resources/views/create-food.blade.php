<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Uploads</title>

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

        @if (!$food_upload)
        <div class="alert alert-warning">No food upload at the moment</div>
        @endif
        
        @if ($food_upload)
        
        <div class="clearfix">
            <div class="float-end">
                <div>Remaining: {{ $remaining }}</div>
                <div>{{ $food_count }}</div>
            </div>
            
        </div>
        

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
                        <img src="{{ asset($food_upload->title_image) }}" class="fixed-img">
                    </div>

                    <div class="tab-pane fade" id="nutrition" role="tabpanel" aria-labelledby="nutrition-tab">
                        <img src="{{ asset($food_upload->nutrition_label_image) }}" class="fixed-img">   
                    </div>

                    <div class="tab-pane fade" id="tab-ingredients" role="tabpanel" aria-labelledby="ingredients-tab">
                        @if ($food_upload->ingredients_image)
                        <img src="{{ asset($food_upload->ingredients_image) }}" class="fixed-img">
                        @endif
                    </div>

                    <div class="tab-pane fade" id="tab-barcode" role="tabpanel" aria-labelledby="barcode-tab">
                        
                        @if ($food_upload->barcode_image)
                        <img src="{{ asset($food_upload->barcode_image) }}" class="fixed-img">
                        @endif
                    </div>
                </div>

            </div>

            <div class="col-7">
                <div class="mt-3 mb-3">
                    <form action="/foods" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{ $food_upload->id }}">

                        <div class="row">
                            <div class="col-8">
                                <div class="mt-2 mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <input type="text" class="form-control" id="description" name="description" value="{{ old('description') }}" placeholder="Anchor milk">
                                </div>
                            </div>

                            <div class="col">
                                <div class="mt-2 mb-3">
                                    <label for="barcode" class="form-label">Barcode</label>
                                    <input type="text" class="form-control" id="barcode" name="barcode" value="{{ old('barcode') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mt-2 mb-3">
                                    <label for="ingredients" class="form-label">Ingredients</label>
                                    <textarea class="form-control" name="ingredients" id="ingredients">{{ old('ingredients') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mt-2 mb-3">
                                    <label for="allergen_information" class="form-label">Allergen Information</label>
                                    <textarea class="form-control" name="allergen_information" id="allergen_information">{{ old('allergen_information') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mt-2 mb-3">
                                    <label for="serving_size" class="form-label">Serving size</label>
                                    <input type="text" class="form-control" id="serving_size" name="serving_size" value="{{ old('serving_size') }}" placeholder="100g">
                                </div>
                            </div>

                            <div class="col">
                                <div class="mt-2 mb-3">
                                    <label for="servings_per_container" class="form-label">Servings per container</label>
                                    <input type="text" class="form-control" id="servings_per_container" name="servings_per_container" value="{{ old('servings_per_container') }}" placeholder="3">
                                </div>
                            </div>

                            <div class="col">
                                <div class="mt-2 mb-3">
                                    <label for="calories" class="form-label">Calories</label>
                                    <input type="text" class="form-control" id="calories" name="calories" value="{{ old('calories') }}" placeholder="100kcal">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <div class="mt-2 mb-3">
                                    <label for="food_type" class="form-label">Food Type</label>
                                    <select class="form-select" name="food_type" id="food_type">
                                        
                                    </select>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="mt-2 mb-3">
                                    <label for="food_subtype" class="form-label">Food Subtype</label>
                                    <select class="form-select" name="food_subtype" id="food_subtype">
                                        
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <div class="mt-2 mb-3">
                                    <label for="food_state" class="form-label">Food State</label>
                                    <select class="form-select" name="food_state" id="food_state">
                                        
                                    </select>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="mt-2 mb-3">
                                    <label for="food_substate" class="form-label">Food Substate</label>
                                    <select class="form-select" name="food_substate" id="food_substate">
                                        
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <div class="mt-2 mb-3">
                                    <label for="target_age_group" class="form-label">Target age group</label>
                                    <select class="form-select" name="target_age_group" id="target_age_group">
                                        @foreach($target_age_groups as $group)
                                        <option value="{{ $group }}" {{ $group === old('target_age_group', $default_age_group) ? 'selected' : '' }}>{{ $group }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="mt-2 mb-3">
                                    <label for="origin_country" class="form-label">Country</label>
                                    <input type="text" class="form-control" id="origin_country" name="origin_country" value="{{ old('origin_country') }}" placeholder="PH">
                                </div>
                            </div>
                        </div>

                        @foreach ($nutrients as $row) 
                        <div class="row">
                            <div class="col-3">
                                <div class="mt-2 mb-3">
                                    @if (!in_array($row->name, $excluded_top_level))
                                    <label for="{{ strtolower($row->name) }}" class="form-label">{{ $row->name }}</label>
                                    <input type="text" class="form-control" id="{{ strtolower($row->name) }}" name="{{ strtolower($row->name) }}" placeholder="{{ $row->placeholder_text }}">
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

                        
                        <button type="submit" id="save-food" class="btn btn-primary float-end">Save Food</button>
                    </form>

                    <form action="/food-labels/delay" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{ $food_upload->id }}">
                        <button type="submit" id="process-later" class="btn btn-warning float-start">Process later</button>
                    </form>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col">

            


            </div>
        </div>
        @endif
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

    @include('handlebars.food-types')
    @include('handlebars.food-subtypes')
    @include('handlebars.food-states')
    @include('handlebars.food-substates')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.8/handlebars.min.js"></script>

    <script>
        let currentButton;
        let currentElement;
        let currentParentName;
        let currentParentLowerName;

        const food_types = {!! json_encode($food_types) !!};
        const food_states = {!! json_encode($food_states) !!};
        

        const parent_food_types = food_types.filter(itm => {
            return itm.parent_id === null;
        });

        const parent_food_states = food_states.filter(itm => {
            return itm.parent_id === null;
        });

        const foodTypesTemplate = Handlebars.compile($('#food-types-template').html());
        const food_types_html = foodTypesTemplate({
            'food_types': parent_food_types,
        });

        const foodSubtypesTemplate = Handlebars.compile($('#food-subtypes-template').html());

        $('#food_type').html(food_types_html);

        $('#food_type').change(function() {
            const food_type_id = $(this).val();
           
            const subtypes = food_types.filter((itm) => {
                return itm.parent_id == food_type_id;
            });
            
            const food_subtypes_html = foodSubtypesTemplate({
                'food_subtypes': subtypes,
            });

            $('#food_subtype').html(food_subtypes_html);
        });

        const foodStatesTemplate = Handlebars.compile($('#food-states-template').html());
        const foodSubStatesTemplate = Handlebars.compile($('#food-substates-template').html());
        const food_states_html = foodStatesTemplate({
            'food_states': parent_food_states
        });
        $('#food_state').html(food_states_html);

        $('#food_state').change(function() {
            const food_state_id = $(this).val();
            const substates = food_states.filter((itm) => {
                return itm.parent_id == food_state_id;
            });
            
            const food_substate_html = foodSubStatesTemplate({
                'food_substates': substates,
            });

            $('#food_substate').html(food_substate_html);
        });

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