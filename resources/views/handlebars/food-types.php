<script type="text/x-handlebars-template" id="food-types-template">
    <option value="">--Select Food Type--</option>
    {{#each food_types}}
    <option value="{{id}}">{{name}}</option>
    {{/each}}
</script>