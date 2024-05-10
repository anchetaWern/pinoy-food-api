<script type="text/x-handlebars-template" id="child-row-template">
    <div class="row">
        <div class="col offset-md-1">
            <div class="mt-1 ml-5">
                <label for="{{name}}" class="form-label">{{name}}</label>
                <input type="text" class="form-control" id="{{name}}" placeholder="99g" name="{{parent_name}}[{{name}}]">
                <button type="button" class="btn btn-sm btn-secondary add-child" data-nutrientid="{{name}}">Add Child</button>
                
                <div class="mb-1">
                </div>
            </div>
        </div>
    </div>
</script>